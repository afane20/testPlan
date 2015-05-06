<?php

require_once(dirname(__FILE__) . "/../mvc/Model.php");

class SongsModel extends Model {
   public function get_all() {
      $query = "SELECT songs.id
                     , songs.name
                     , songs.artist_id
                     , songs.notes
                     , artists.name artist
                FROM songs
                LEFT JOIN artists on artists.id = artist_id
                ORDER BY artists.name
                       , songs.name";
      $result = $this->db->exec($query, array());
      return $result;
   }

   public function get_one($id) {
      $query = "SELECT songs.id
                     , songs.name
                     , songs.artist_id
                     , songs.notes
                     , artists.name artist
                FROM songs
                LEFT JOIN artists on artists.id = artist_id
                WHERE songs.id = $1";
      $params = array($id);
      $result = $this->db->exec($query, $params)->fetch_one();
      return $result;
   }

   public function delete($id) {
      $query = "DELETE FROM songs
                WHERE id = $1";
      $params = array($id);
      return (boolean)$this->db->exec($query, $params);
   }

   public function insert($request) {
      $query = "INSERT INTO songs
                  ( id
                  , name
                  , artist_id
                  , notes)
                VALUES
                  ( DEFAULT
                  , $1
                  , $2
                  , $3)";
      $params = array($request['name'],
                      $request['artist_id'],
                      $request['notes']);
      return (boolean)$this->db->exec($query, $params);
   }

   public function update($id, $request) {
      $query = "UPDATE songs
                SET name = $2
                  , artist_id = $3
                  , notes = $4
                WHERE id = $1";
      $params = array($request['id'],
                      $request['name'],
                      $request['artist_id'],
                      $request['notes']);
      return (boolean)$this->db->exec($query, $params);
   }

}

?>
