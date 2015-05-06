<?php 
	require_once "model.php";
	
	header('Content-Type: application/json');
	
	echo json_encode(getTeachers());
	
 ?>