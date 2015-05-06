<?php

abstract class Controller {
   public function __construct($view, $params, $format) {
      require("config.php");
      $this->web_root = $web_root;
      $this->format = $format;
      $this->view = $view;
      if (method_exists($this, $this->view)) {
         $this->$view($params);
         $this->render($this->view);
      } else {
         $this->render404();
      }
   }

   public function render($view) {
      $view_file = dirname(__FILE__) . "/../apps/" . get_class($this) . "/views/" . $view . ".php";
      if (file_exists($view_file)) {
         foreach (get_object_vars($this) as $var => $val) {
            $$var = $val;
         }
         if ($this->format == 'html') {
            include(dirname(__FILE__) . "/../html/open.html");
         }
         include($view_file);
         if ($this->format == 'html') {
            include(dirname(__FILE__) . "/../html/close.html");
         }
      }
   }

   public function set_view($view) {
      $this->view = $view;
   }

   public static function render404() {
      header("Status: 404 Not Found");
      include(dirname(__FILE__) . "/../html/open.html");
      include(dirname(__FILE__) . "/../html/404.html");
      include(dirname(__FILE__) . "/../html/close.html");
   }

   public function get_model($model) {
      require_once(dirname(__FILE__) . "/../model/$model.php");
      $model_class = ucwords($model) . "Model";
      return new $model_class();
   }

   public function redirect($url) {
      header("Location: $url");
   }

}

?>
