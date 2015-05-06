<?php 
	require_once "model.php";
	
	header('Content-Type: application/json');
	
	$teacherId = $_GET['teacherId'];
	
	echo json_encode(getTeacher($teacherId));
	
 ?>