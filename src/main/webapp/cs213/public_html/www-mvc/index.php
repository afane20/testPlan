<?php

// get the uri components
$uri = $_SERVER['REQUEST_URI'];
print "uri = $uri <br />";
$parts = substr($_SERVER['REQUEST_URI'], 21);   // 18 ablack5 21 ercanbracks
print "parts = $parts <br />";
$parts = explode('?', $parts, 2);
print "parts[0] = $parts[0] <br />";
$nice = trim($parts[0], '/');
print " nice = $nice <br />";
$request = explode('/', $nice, 3);
print " Request = $request[0] <br />";

if (!empty($request[0])) {
   $controller = $request[0];
} else {
   $controller = "home";
}
print "Controller = $controller <br/>";

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
print "controller file = $controller_file <br/>";
if (file_exists($controller_file))
{
   require($controller_file);
   if (class_exists($controller))
   {     
      $controller = new $controller($view, $params, $format);
   }
   else
   {
      require("mvc/Controller.php");
      Controller::render404();
   }
}
else
{
   require("mvc/Controller.php");
   Controller::render404();
}

?>
