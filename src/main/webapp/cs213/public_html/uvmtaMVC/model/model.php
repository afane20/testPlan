<?php
	
	require_once "../model/dbConnPDO.php";
	$db = getDB();
	
	function getTeachers() {
		$query = 'SELECT teacherId, first, last FROM teacher';
		
		print $query;
		
		try {
			$stmt = $db->prepare($query);
			$stmt->execute();
			$result = $stmt->fetchAll();
			$stmt->closeCursor();
			return $result;
		} catch (PDOException $e) {
			$errorMessage = $e->getMessage();
//			print $errorMessage;
			print "error";
		}
	}
	
	// Option for sorting ASC or DESC
	function getStudents($teacherId, $sort = 'last ASC') {
		$query = 'SELECT studentId, first, last, festivals, points FROM students ';
		if ($teacherId != -1) {
			$query += "WHERE teacherId = $teacherId ";
		}
		$query += "ORDER BY $sort";
		
		print $query;
		
		try {
			$stmt = $db->prepare($query);
			$stmt->execute();
			$result = $stmt->fetchAll();
			$stmt->closeCursor();
			return $result;
		} catch (PDOException $e) {
			$errorMessage = $e->getMessage();
		}
	}
	
?>