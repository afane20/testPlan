<?php 
	require_once "model.php";
	
	$teacherId = $_POST['teacherId'];
	$fields = $_POST['fields'];
	$values = $_POST['values'];
	
	$fields = explode(",", $fields);
	$values = explode(",", $values);
	
	$updateSuccessful = true;
	
	for ($i = 0; $i < count($fields); $i++) {
		if ($fields[$i] == "pwd") {
			$values[$i] = sha1($values[$i]);
		}
		$success = updateField($teacherId, $fields[$i], $values[$i]);
		if ($success == false) {
			$updateSuccessful = false;
		}
	}
		
	echo $updateSuccessful;
	
?>