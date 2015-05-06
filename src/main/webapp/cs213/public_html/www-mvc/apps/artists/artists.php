<?php

require(dirname(__FILE__) . "/../../mvc/Controller.php");

class artists extends Controller {
   public function index($request) {
      $artists_model = $this->get_model("artists");
      $this->artists = $artists_model->get_all();
   }

   public function edit($request) {
      $id = $request['id'];
      $artists_model = $this->get_model("artists");
      $this->artists = $artists_model->get_one($id);
      $this->set_view("edit");
   }

   public function create($request) {
      $this->set_view("edit");
   }

   public function insert($request) {
      $artists_model = $this->get_model("artists");
      $artists_model->insert($request);
      $this->redirect($this->web_root . "/artists");
   }

   public function update($request) {
      $id = $request['id'];
      $artists_model = $this->get_model("artists");
      $artists_model->update($id, $request);
      $this->redirect($this->web_root . "/artists");
   }

   public function delete($request) {
      $id = $request['id'];
      $artists_model = $this->get_model("artists");
      $artists_model->delete($id);
      $this->redirect($this->web_root . "/artists");
   }
}

?>
