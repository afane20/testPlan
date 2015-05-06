<?php

require(dirname(__FILE__) . "/MysqlConnection.php");

abstract class Model {
   public function __construct() {
      require("config.php");
      $this->db = new MysqlConnection($db_host, $db_user, $db_pass, $database);
   }
   public abstract function get_all();
   public abstract function get_one($id);
   public abstract function delete($id);
   public abstract function insert($request);
   public abstract function update($id, $request);
}

?>
