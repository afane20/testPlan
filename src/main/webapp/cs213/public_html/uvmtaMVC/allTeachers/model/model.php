<?php
	include_once "../../model/dbConnPDO.php";
	
	function getTeacher($teacherId) {
		$db = getDB();
		$query = "SELECT * FROM teacher WHERE teacherId = :teacherId";
		
		try {
			$stmt = $db->prepare($query);
			$stmt->bindValue(':teacherId', $teacherId);
			$stmt->execute();
			$result = $stmt->fetchAll();
			$stmt->closeCursor();
			return $result;
		} catch (PDOException $e) {
			$errorMessage = $e->getMessage();
			print $errorMessage;
		}
	}
	
	function getTeachers($sort = 'last ASC') {
		$db = getDB();
		$query = "SELECT * FROM teacher ORDER BY $sort";
		
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
	
	// Add new teacher to the database
	function addTeacher($first, $last, $street, $city, $state, $zip, $phone, $email, $username, $pwd, $uvmtaId, $admin, $earlyReg, $memCurr, $memFees, $regFees) {
		$db = getDB();
		$query = "INSERT INTO teacher (first, last, street, city, state, zip, phone, email, username, pwd, uvmtaId, admin, earlyReg, membershipCurrent, membershipFees, regFees) VALUES (:first, :last, :street, :city, :state, :zip, :phone, :email, :username, :pwd, :uvmtaId, :admin, :earlyReg, :memCurr, :memFees, :regFees)";
		try {
			$stmt = $db->prepare($query);
			$stmt->bindValue(':first', $first);
			$stmt->bindValue(':last', $last);
			$stmt->bindValue(':street', $street);
			$stmt->bindValue(':city', $city);
			$stmt->bindValue(':state', $state);
			$stmt->bindValue(':zip', $zip);
			$stmt->bindValue(':phone', $phone);
			$stmt->bindValue(':email', $email);
			$stmt->bindValue(':username', $username);
			$stmt->bindValue(':pwd', $pwd);
			$stmt->bindValue(':uvmtaId', $uvmtaId);
			$stmt->bindValue(':admin', $admin);
			$stmt->bindValue(':earlyReg', $earlyReg);
			$stmt->bindValue(':memCurr', $memCurr);
			$stmt->bindValue(':memFees', $memFees);
			$stmt->bindValue(':regFees', $regFees);
			$stmt->execute();
			$stmt->closeCursor();
			return true;
		} catch (PDOException $e) {
			return false;
		}
	}
		
	function updateField($teacherId, $field, $newValue) {
		$db = getDB();
		$query = "UPDATE teacher SET $field=:newValue WHERE teacherId=:teacherId";
		try {
			$stmt = $db->prepare($query);
			$stmt->bindValue(':newValue', $newValue);
			$stmt->bindValue(':teacherId', $teacherId);
			$stmt->execute();
			$stmt->closeCursor();
			return true;
		} catch (PDOException $e) {
			return false;
		}
	}
	
	// Return whether or not the teacher has registered students
	function teacherHasRegisteredStudents($teacherId) {
		$db = getDB();
		$query = "SELECT studentId FROM registration WHERE teacherId = :teacherId";
		try {
			$stmt = $db->prepare($query);
			$stmt->bindValue(':teacherId', $teacherId);
			$stmt->execute();
			$result = $stmt->fetchAll();
			$stmt->closeCursor();
			if (count($result) == 0) {
				return false;
			} else {
				return true;
			}
		} catch (PDOException $e) {
			return true;
		}
	}
	
	// Remove all students from specified teacher
	function removeStudents($teacherId) {
		$db = getDB();
		$query = "UPDATE student SET teacherId=1 WHERE teacherId = :teacherId";
		try {
			$stmt = $db->prepare($query);
			$stmt->bindValue(':teacherId', $teacherId);
			$stmt->execute();
			$stmt->closeCursor();
			return true;
		} catch (PDOException $e) {
			return false;
		}
	}
	
	// Remove teacher from database
	function deleteTeacher($teacherId) {
		$db = getDB();
		$query = "DELETE FROM teacher WHERE teacherId = :teacherId";
		try {
			$stmt = $db->prepare($query);
			$stmt->bindValue(':teacherId', $teacherId);
			$stmt->execute();
			$stmt->closeCursor();
			return true;
		} catch (PDOException $e) {
			return false;
		}
	}
	
	// Search student
//	function searchStudents($search) {
//		$db = getDB();
//		$query = "SELECT studentId, first, last, instrument, festivals, points, teacherId FROM student
//							WHERE first LIKE :search OR last LIKE :search ORDER BY last ASC";
//		try {
//			$stmt = $db->prepare($query);
//			$stmt->bindValue(':search', '%'.$search.'%');
//			$stmt->execute();
//			$result = $stmt->fetchAll();
//			$stmt->closeCursor();
//			return $result;
//		} catch (PDOException $e) {
//			$errorMessage = $e->getMessage();
//			print $errorMessage;
//		}
//	}
	
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