<?php

// get the uri components
$parts = substr($_SERVER['REQUEST_URI'], 21);
$parts = explode('?', $parts, 2);
$nice = trim($parts[0], '/');
$request = explode('/', $nice, 3);

if (!empty($request[0])) {
   $controller = $request[0];
} else {
   $controller = "home";
}

if (!empty($request[1])) {
   $view = $request[1];
} else {
   $view = "index";
}

$params = array();
$format = "html";
if (!empty($request[2])) {
   $kvp = explode('/',$request[2]);
   for ($i = 0; $i < count($kvp); ++$i) {
      if ($kvp[$i] == "format") {
         $format = $kvp[++$i];
      } else {
         $params[$kvp[$i]] = (isset($kvp[++$i]) ? $kvp[$i] : "");
      }
   }
}
$params = array_merge($params, $_REQUEST);

$controller_file = "apps/$controller/$controller.php";
if (file_exists($controller_file)) {
   require($controller_file);
   if (class_exists($controller)) {
      $controller = new $controller($view, $params, $format);
   } else {
      require("mvc/Controller.php");
      Controller::render404();
   }
} else {
   require("mvc/Controller.php");
   Controller::render404();
}

?>
