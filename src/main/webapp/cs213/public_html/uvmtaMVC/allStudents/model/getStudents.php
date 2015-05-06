<?php 
	require_once "model.php";
	
	header('Content-Type: application/json');
	
	$teacherId = $_GET['teacherId'];
	$sort = $_GET['sort'];
	
	echo json_encode(getStudents($teacherId, $sort));
	
 ?>