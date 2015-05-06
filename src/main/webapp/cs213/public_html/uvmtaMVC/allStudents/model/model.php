<?php
	include_once "../../model/dbConnPDO.php";
	
	function getTeachers() {
		$db = getDB();
		$query = 'SELECT teacherId, first, last FROM teacher ORDER BY last ASC';
		
		try {
			$stmt = $db->prepare($query);
			$stmt->execute();
			$result = $stmt->fetchAll();
			$stmt->closeCursor();
			return $result;
		} catch (PDOException $e) {
			$errorMessage = $e->getMessage();
			print $errorMessage;
		}
	}
	
	// Option for sorting ASC or DESC
	function getStudents($teacherId, $sort = 'last ASC') {
		$db = getDB();
		$query = 'SELECT * FROM student ';
		if ($teacherId != -1) {
			$query .= "WHERE teacherId = $teacherId ";
		}
		$query .= "ORDER BY $sort";
		
		try {
			$stmt = $db->prepare($query);
			$stmt->execute();
			$result = $stmt->fetchAll();
			$stmt->closeCursor();
			return $result;
		} catch (PDOException $e) {
			$errorMessage = $e->getMessage();
			print $errorMessage;
		}
	}
	
	// Add student to the database
	function addStudent($first, $last, $instrument, $gradYear, $festivals, $points, $lastFestDate, $teacherId) {
		$db = getDB();
		$query = "INSERT INTO student (first, last, instrument, gradYear, festivals, points, lastFestDate, teacherId)
													 values (:first, :last, :instrument, :gradYear, :festivals, :points, :lastFestDate, :teacherId)";
		try {
			$stmt = $db->prepare($query);
			$stmt->bindValue(':first', $first);
			$stmt->bindValue(':last', $last);
			$stmt->bindValue(':instrument', $instrument);
			$stmt->bindValue(':gradYear', $gradYear);
			$stmt->bindValue(':festivals', $festivals);
			$stmt->bindValue(':points', $points);
			$stmt->bindValue(':lastFestDate', $lastFestDate);
			$stmt->bindValue(':teacherId', $teacherId);
			$stmt->execute();
			$stmt->closeCursor();
			return "$first $last was successfully added to the database!";
		} catch (PDOException $e) {
			return "Error - $first $last could not be added!";
		}
	}
	
	function updateStudent($studentId, $first, $last, $instrument, $gradYear, $festivals, $points, $lastFestDate, $teacherId) {
		$db = getDB();
		$query = "UPDATE student SET first=:first, last=:last, instrument=:instrument, gradYear=:gradYear, festivals=:festivals, points=:points, lastFestDate=:lastFestDate, teacherId=:teacherId WHERE studentId=:studentId";
		try {
			$stmt = $db->prepare($query);
			$stmt->bindValue(':first', $first);
			$stmt->bindValue(':last', $last);
			$stmt->bindValue(':instrument', $instrument);
			$stmt->bindValue(':gradYear', $gradYear);
			$stmt->bindValue(':festivals', $festivals);
			$stmt->bindValue(':points', $points);
			$stmt->bindValue(':lastFestDate', $lastFestDate);
			$stmt->bindValue(':teacherId', $teacherId);
			$stmt->bindValue(':studentId', $studentId);
			$stmt->execute();
			$stmt->closeCursor();
			return "$first $last was successfully updated in the database!";
		} catch (PDOException $e) {
			return "Error - $first $last could not be updated!";
		}
	}
	
	function updateField($studentId, $field, $newValue) {
		$db = getDB();
		$query = "UPDATE student SET $field=:newValue WHERE studentId=:studentId";
		try {
			$stmt = $db->prepare($query);
			$stmt->bindValue(':newValue', $newValue);
			$stmt->bindValue(':studentId', $studentId);
			$stmt->execute();
			$stmt->closeCursor();
			return true;
		} catch (PDOException $e) {
			return false;
		}
	}
	
	// Delete student from the database
	function deleteStudent($studentId) {
		$db = getDB();
		$query = "DELETE FROM student WHERE studentId = :studentId";
		try {
			$stmt = $db->prepare($query);
			$stmt->bindValue(':studentId', $studentId);
			$stmt->execute();
			$stmt->closeCursor();
			return true;
		} catch (PDOException $e) {
			return false;
		}
	}	
	
	// Seach student
	function searchStudents($search) {
		$db = getDB();
		$query = "SELECT studentId, first, last, instrument, festivals, points, teacherId FROM student
							WHERE first LIKE :search OR last LIKE :search ORDER BY last ASC";
		try {
			$stmt = $db->prepare($query);
			$stmt->bindValue(':search', '%'.$search.'%');
			$stmt->execute();
			$result = $stmt->fetchAll();
			$stmt->closeCursor();
			return $result;
		} catch (PDOException $e) {
			$errorMessage = $e->getMessage();
			print $errorMessage;
		}
	}
	
//	function searchItems($moduleId, $search) {
//		global $db;
//		$query = 'SELECT i.id AS id, i.name AS name FROM item AS i
//							JOIN category AS c ON c.id = i.categoryId
//							JOIN module AS m ON m.id = c.moduleId
//							WHERE m.id = :moduleId AND i.name LIKE :search';
//		try {
//			$stmt = $db->prepare($query);
//			$stmt->bindValue(':moduleId', $moduleId);
//			$stmt->bindValue(':search', '%'.$search.'%');
//			$stmt->execute();
//			$result = $stmt->fetchAll();
//			$stmt->closeCursor();
//			return $result;
//		} catch (PDOException $e) {
//			$errorMessage = $e->getMessage();
//		}
//	}
	
?>