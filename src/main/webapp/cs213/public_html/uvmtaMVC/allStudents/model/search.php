<?php 
	require_once "model.php";
	
	header('Content-Type: application/json');
	
	$search = $_GET['search'];
		
	echo json_encode(searchStudents($search));
	
?>