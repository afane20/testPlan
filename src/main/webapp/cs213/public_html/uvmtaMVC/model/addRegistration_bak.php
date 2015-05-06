<?php
   include 'loginValid.php';
   require_once 'dbConnPDO.php';
   $db = getDB();

   if ( !isset($_SESSION['teacherId'] ) )
   {
      print "Server Error: Please try again later";
      exit;
   }
   
   $teacherId = valInt($_SESSION['teacherId']);
   $studentId = valInt($_GET['studentId']);
   $studentId2 = valInt($_GET['studentId2']);
   $timeslotId = valInt($_GET['timeslotId']);
   $performanceType = sanStr($_GET['performanceType']);
   $instrument = sanStr($_GET['instrument']);
   $level = valInt($_GET['level']);
   $festivalId = valInt($_GET['festivalId']);
   $performanceDay = $_GET['performanceDay'];
   $regFeePaid = 'N';   // set default to not paid
   
   if ($performanceDay == "1")
   {
      $performanceDate = $_GET['festivalDate'];
      $regFee = valFloat($_GET['regFee']);
   }
   else
   {
      $performanceDate = $_GET['alternateDate'];
      $regFee = valFloat($_GET['regFeeAlt']);
   }

   $query = "UPDATE timeslot SET scheduled = 1 WHERE timeslotId = :timeslotId AND scheduled = 0";
   
   try {
   	$stmt = $db->prepare($query);
   	$stmt->bindValue(':timeslotId', $timeslotId);
   	$stmt->execute();
   	$rowsChanged = $stmt->rowCount();
   	$stmt->closeCursor();
   	
   } catch (PDOException $e) {
   	$errorMessage = $e->Message();
   }
   
   if ($rowsChanged != 0)
   {
      $query = "INSERT INTO registration
             (studentId,timeslotId,performanceDate,type,teacherId,level,instrument,festivalId,regFeePaid,regFee) VALUES
             (:studentId, :timeslotId, :performanceDate, :performanceType, :teacherId, :level, :instrument, :festivalId, :regFeePaid, :regFee);";
 			
 			try {
 				$stmt = $db->prepare($query);
 				$stmt->bindValue(':studentId', $studentId);
 				$stmt->bindValue(':timeslotId', $timeslotId);
 				$stmt->bindValue(':performanceDate', $performanceDate);
 				$stmt->bindValue(':performanceType', $performanceType);
 				$stmt->bindValue(':teacherId', $teacherId);
 				$stmt->bindValue(':level', $level);
 				$stmt->bindValue(':instrument', $instrument);
 				$stmt->bindValue(':festivalId', $festivalId);
 				$stmt->bindValue(':regFeePaid', $regFeePaid);
 				$stmt->bindValue(':regFee', $regFee);
 				$stmt->execute();
 				$stmt->closeCursor();
 				print "Student has been registered ";	
 			} catch (PDOException $e) {
 				print "Student ID # $studentId could not be registered! - Database error!";
 				exit;
 			}
      
      if ($studentId2 != "" && $performanceType == "Duet")
      {
        $query = "INSERT INTO registration
             (studentId,timeslotId,performanceDate,type,teacherId,level,instrument,festivalId,regFeePaid,regFee) VALUES
             (:studentId2, :timeslotId, :performanceDate, :performanceType, :teacherId, :level, :instrument, :festivalId, :regFeePaid, :regFee);";
 
        try {
        	$stmt = $db->prepare($query);
         $stmt->bindValue(':studentId2', $studentId2);
        	$stmt->bindValue(':timeslotId', $timeslotId);
        	$stmt->bindValue(':performanceDate', $performanceDate);
        	$stmt->bindValue(':performanceType', $performanceType);
        	$stmt->bindValue(':teacherId', $teacherId);
        	$stmt->bindValue(':level', $level);
        	$stmt->bindValue(':instrument', $instrument);
        	$stmt->bindValue(':festivalId', $festivalId);
        	$stmt->bindValue(':regFeePaid', $regFeePaid);
        	$stmt->bindValue(':regFee', $regFee);
        	$stmt->execute();
        	$stmt->closeCursor();
        	print "and duet partner has been registered!";	
        } catch (PDOException $e) {
        	print "but duet partner - $studentId2 could not be registered! - Database error!";
        	exit;
        }
      }
   }
   else
   {
      Print "Student not registered. Time slot not available! Choose a different timeslot";
   }       
?>
