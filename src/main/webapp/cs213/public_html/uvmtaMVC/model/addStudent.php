<?php
   include 'loginValid.php';
   require_once 'dbConnPDO.php';
   $db = getDB();

   if ( !isset($_GET['teacherId'] ) )
   {
      print "Server Error: Please try again later";
      exit;

   }

   $teacherId = valInt($_GET['teacherId']);
   $firstName = sanStr($_GET['firstName']);
   $lastName = sanStr($_GET['lastName']);
   $instrument = sanStr($_GET['instrument']);
   $gradYear = sanStr($_GET['gradYear']);
   $festivals = valInt($_GET['festivals']);
   $points = valInt($_GET['points']);
   $lastFestDate = sanStr($_GET['lastFestDate']);   
  //see if the student is already in the system with a teacher of "unknown"
  
  $query = "SELECT * FROM student WHERE teacherId=1 AND last = :lastName AND first = :firstName" .
     " AND instrument = :instrument AND gradYear = :gradYear";

   try {
   	$stmt = $db->prepare($query);
   	$stmt->bindValue(':lastName', $lastName);
   	$stmt->bindValue(':firstName', $firstName);
      $stmt->bindValue(':instrument', $instrument);
      $stmt->bindValue(':gradYear', $gradYear);
   	$stmt->execute();
   	$rows = $stmt->fetchAll();
   	$stmt->closeCursor();
   } catch (PDOException $e) {
   	print "Invalid query string: ".$e->getMessage();;
   }
   $rowCount = sizeOf($rows);
   if ( $rowCount > 0)
   {
      print "The student you are trying to add is already in the system and has participated in at least one festival. <br />";
      print "However, they currently are not assigned to a teacher.<br />";
      print "Click on a student from the list below to add them as your student!<br /><br />";    
      
      print "<select id='studentChoice'  size = '$rowCount' onclick = 'selectStudent()' />";
   	
      foreach ($rows as $row)
      {
		    print "<option value=\"" . $row['studentId'] . "\">" . $row['first'] . " " . $row['last'] . ", "
                 . $row['instrument'] . ", Grad Year: " . $row['gradYear'] . ", Festivals: " . $row['festivals'] . "</option> \n";     
      }
      print '</select>';
	}
   else
   {
         
		$query = "INSERT INTO student (first, last, teacherId, instrument, festivals, points, lastFestDate, gradYear)" .
               " values (:firstName, :lastName, :teacherId, :instrument, :festivals, :points, :lastFestDate, :gradYear)";
		try {
   		$stmt = $db->prepare($query);
   		$stmt->bindValue(':firstName', $firstName);
   		$stmt->bindValue(':lastName', $lastName);
   		$stmt->bindValue(':teacherId', $teacherId);
   		$stmt->bindValue(':instrument', $instrument);
   		$stmt->bindValue(':festivals', $festivals);
   		$stmt->bindValue(':points', $points);
         $stmt->bindValue(':lastFestDate', $lastFestDate);
         $stmt->bindValue(':gradYear', $gradYear);        
         $stmt->execute();
   		$stmt->closeCursor();
   		print "$firstName $lastName has been added!";
   	} catch (PDOException $e) {
   		print "Error - $firstName $lastName cannot be added! The teacher ID # '$teacherId' does not exist.";
   	}
}
?>
