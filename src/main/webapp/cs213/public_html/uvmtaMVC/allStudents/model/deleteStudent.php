<?php 
	require_once "model.php";
	
	$studentId = $_POST['studentId'];
			
	echo deleteStudent($studentId);
	
?>