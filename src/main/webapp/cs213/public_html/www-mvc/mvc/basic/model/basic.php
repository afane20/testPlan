<?php

require(dirname(__FILE__) . "/../mvc/Model.php");

class <MODEL_CLASS_NAME>Model extends Model {
   public function get_all() {
      $query = "SELECT<COMMA_SEP_FIELDS>
                FROM <TABLE_NAME>
                ORDER BY id";
      $result = $this->db->exec($query, array());
      return $result;
   }

   public function get_one($id) {
      $query = "SELECT<COMMA_SEP_FIELDS>
                FROM <TABLE_NAME>
                WHERE id = $1";
      $params = array($id);
      $result = $this->db->exec($query, $params)->fetch_one();
      return $result;
   }

   public function delete($id) {
      $query = "DELETE FROM <TABLE_NAME>
                WHERE id = $1";
      $params = array($id);
      return (boolean)$this->db->exec($query, $params);
   }

   public function insert($request) {
      $query = "INSERT INTO <TABLE_NAME>
                     (<COMMA_SEP_FIELDS>)
                VALUES
                     (DEFAULT, <DEFAULT_DOLLAR_PARAM>)";
      <PHP_ARRAY_PARAM_REQUEST>
      return (boolean)$this->db->exec($query, $params);
   }

   public function update($id, $request) {
      $query = "UPDATE <TABLE_NAME>
                SET<COMMA_SEP_SET_FIELDS>
                WHERE id = $1";
      <PHP_ARRAY_PARAM_REQUEST_W_ID>
      return (boolean)$this->db->exec($query, $params);
   }

}

?>
