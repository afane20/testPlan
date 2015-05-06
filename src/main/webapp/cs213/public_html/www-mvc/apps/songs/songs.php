<?php

require_once(dirname(__FILE__) . "/../../mvc/Controller.php");

class songs extends Controller {
   public function index($request) {
      $songs_model = $this->get_model("songs");
      $this->songs = $songs_model->get_all();
   }

   public function edit($request) {
      $id = $request['id'];

      $songs_model = $this->get_model("songs");
      $this->song = $songs_model->get_one($id);

      $artists_model = $this->get_model("artists");
      $this->artists = $artists_model->get_all();

      $this->set_view("edit");
   }

   public function create($request) {
      $artists_model = $this->get_model("artists");
      $this->artists = $artists_model->get_all();
      $this->set_view("edit");
   }

   public function insert($request) {
      $songs_model = $this->get_model("songs");
      $songs_model->insert($request);
      $this->redirect($this->web_root . "/songs");
   }

   public function update($request) {
      $id = $request['id'];
      $songs_model = $this->get_model("songs");
      $songs_model->update($id, $request);
      $this->redirect($this->web_root . "/songs");
   }

   public function delete($request) {
      $id = $request['id'];
      $songs_model = $this->get_model("songs");
      $songs_model->delete($id);
      $this->redirect($this->web_root . "/songs");
   }
}

?>
