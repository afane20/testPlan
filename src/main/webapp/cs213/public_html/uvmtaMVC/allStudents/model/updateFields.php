<?php 
	require_once "model.php";
	
	$studentIds = $_POST['studentIds'];
	$fields = $_POST['fields'];
	$values = $_POST['values'];
		
	$studentIds = explode(",", $studentIds);
	$fields = explode(",", $fields);
	$values = explode(",", $values);
	
	$updateSuccessful = true;
	
	foreach ($studentIds as $studentId) {
		for ($i = 0; $i < count($fields); $i++) {
			$success = updateField($studentId, $fields[$i], $values[$i]);
			if ($success == false) {
				$updateSuccessful = false;
			}
		}
	}
		
	echo $updateSuccessful;
	
?>