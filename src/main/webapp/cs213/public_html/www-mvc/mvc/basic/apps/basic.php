<?php

require(dirname(__FILE__) . "/../../mvc/Controller.php");

class <CLASS_NAME> extends Controller {
   public function index($request) {
      $<CLASS_NAME>_model = $this->get_model("<CLASS_NAME>");
      $this-><CLASS_NAME> = $<CLASS_NAME>_model->get_all();
   }

   public function edit($request) {
      $id = $request['id'];
      $<CLASS_NAME>_model = $this->get_model("<CLASS_NAME>");
      $this-><CLASS_NAME> = $<CLASS_NAME>_model->get_one($id);
      $this->set_view("edit");
   }

   public function create($request) {
      $this->set_view("edit");
   }

   public function insert($request) {
      $<CLASS_NAME>_model = $this->get_model("<CLASS_NAME>");
      $<CLASS_NAME>_model->insert($request);
      $this->redirect($this->web_root . "/<CLASS_NAME>");
   }

   public function update($request) {
      $id = $request['id'];
      $<CLASS_NAME>_model = $this->get_model("<CLASS_NAME>");
      $<CLASS_NAME>_model->update($id, $request);
      $this->redirect($this->web_root . "/<CLASS_NAME>");
   }

   public function delete($request) {
      $id = $request['id'];
      $<CLASS_NAME>_model = $this->get_model("<CLASS_NAME>");
      $<CLASS_NAME>_model->delete($id);
      $this->redirect($this->web_root . "/<CLASS_NAME>");
   }
}

?>
