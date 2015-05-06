<?php

require_once(dirname(__FILE__) . "/../mvc/Model.php");

class ArtistsModel extends Model {
   public function get_all() {
      $query = "SELECT id
                     , name
                FROM artists
                ORDER BY id";
      $result = $this->db->exec($query, array());
      return $result;
   }

   public function get_one($id) {
      $query = "SELECT id
                     , name
                FROM artists
                WHERE id = $1";
      $params = array($id);
      $result = $this->db->exec($query, $params)->fetch_one();
      return $result;
   }

   public function delete($id) {
      $query = "DELETE FROM artists
                WHERE id = $1";
      $params = array($id);
      return (boolean)$this->db->exec($query, $params);
   }

   public function insert($request) {
      $query = "INSERT INTO artists
                     ( id
                     , name)
                VALUES
                     (DEFAULT, $1)";
      $params = array($request['name']);

      return (boolean)$this->db->exec($query, $params);
   }

   public function update($id, $request) {
      $query = "UPDATE artists
                SET name = $2
                WHERE id = $1";
      $params = array($request['id'],
                      $request['name']);

      return (boolean)$this->db->exec($query, $params);
   }

}

?>
