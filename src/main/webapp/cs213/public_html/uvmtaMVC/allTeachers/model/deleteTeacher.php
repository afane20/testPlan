<?php 
	require_once "model.php";
	
	$teacherId = $_POST['teacherId'];
			
	if (teacherHasRegisteredStudents($teacherId)) {
		echo "Teacher has registered students and cannot be removed";
	} else {
		if (removeStudents($teacherId)) {
			if (deleteTeacher($teacherId)) {
				echo "Teacher was successfully removed from the database";
			} else {
				echo "Failed to removed teacher from the database";
			}
		} else {
			echo "Teacher's students could not be removed. Teacher was not removed from the database";
		}
	}
	
?>