<?php 
	require_once "model.php";
	
	header('Content-Type: application/json');
	
	$sort = $_GET['sort'];
	
	echo json_encode(getTeachers($sort));
	
 ?>