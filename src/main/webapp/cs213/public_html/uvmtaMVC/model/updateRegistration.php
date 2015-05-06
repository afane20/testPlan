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
   $registrationId = valInt($_GET['registrationId']);   
   $registrationId2 = valInt($_GET['registrationId2']);   
   $studentId = valInt($_GET['studentId']);
   $studentId2 = valInt($_GET['studentId2']);
   $timeslotId = valInt($_GET['timeslotId']);
   $prevTimeSlotId = valInt($_GET['prevTimeSlotId']);

   $performanceType = sanStr($_GET['performanceType']);
   $instrument = sanStr($_GET['instrument']);
   $level = valInt($_GET['level']);
   $festivalId = valInt($_GET['festivalId']);
   $performanceDay = $_GET['performanceDay'];

   
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
   
   
      // update new timeslot
      $query = "UPDATE timeslot SET scheduled = 1 WHERE timeslotId = :timeslotId AND scheduled = 0";
        
      try
      {
   	   $stmt = $db->prepare($query);
   	   $stmt->bindValue(':timeslotId', $timeslotId);
   	   $stmt->execute();
   	   $rowsChanged = $stmt->rowCount();
   	   $stmt->closeCursor();
   	
      }
      catch (PDOException $e)
      {
   	   $errorMessage = $e->Message();
         print "Registration Update Failed - couldn't update time slot!";
         exit;
      }

      # if update to new timeslot is ok.  Then fee old timeslot and update registration records
      if ($rowsChanged != 0)
      {
        # free the old timeslot
        $query = "UPDATE timeslot SET scheduled = 0 WHERE timeslotId = :prevTimeSlotId AND scheduled = 1"; 
          try
          {
      	    $stmt = $db->prepare($query);
   	       $stmt->bindValue(':prevTimeSlotId', $prevTimeSlotId);
      	    $stmt->execute();
   	       $rowsChanged = $stmt->rowCount();
   	       $stmt->closeCursor();  	
          }
          catch (PDOException $e)
          {
   	       $errorMessage = $e->Message();
          }
          
         # update the 1st registration record 
         $query = "UPDATE registration SET studentId = :studentId, timeslotId = :timeslotId, performanceDate = :performanceDate,
             type = :performanceType, teacherId = :teacherId, level = :level, instrument = :instrument, festivalId = :festivalId,
             regFee = :regFee WHERE registrationId = :registrationId";
        
 			try
         {
 				$stmt = $db->prepare($query);
 				$stmt->bindValue(':studentId', $studentId);
 				$stmt->bindValue(':timeslotId', $timeslotId);
 				$stmt->bindValue(':performanceDate', $performanceDate);
 				$stmt->bindValue(':performanceType', $performanceType);
 				$stmt->bindValue(':teacherId', $teacherId);
 				$stmt->bindValue(':level', $level);
 				$stmt->bindValue(':instrument', $instrument);
 				$stmt->bindValue(':festivalId', $festivalId);
 				$stmt->bindValue(':regFee', $regFee);
            $stmt->bindValue(':registrationId',$registrationId);
 				$stmt->execute();
 				$stmt->closeCursor();
 				print "Student has been registered ";	
 			}
         catch (PDOException $e)
         {
 				print "Student ID # $studentId registration update failed! - Database error!";
 				exit;
 			}
    
         if ($studentId2 != "" && $performanceType == "Duet")
         {

            $query = "UPDATE registration SET studentId = :studentId2, timeslotId = :timeslotId, performanceDate = :performanceDate,
                     type = :performanceType, teacherId = :teacherId, level = :level, instrument = :instrument, festivalId = :festivalId,
                     regFee = :regFee WHERE registrationId = :registrationId2;";
 			   try
            {
 			 	   $stmt = $db->prepare($query);
 			   	$stmt->bindValue(':studentId2', $studentId2);
 				   $stmt->bindValue(':timeslotId', $timeslotId);
 				   $stmt->bindValue(':performanceDate', $performanceDate);
 				   $stmt->bindValue(':performanceType', $performanceType);
 				   $stmt->bindValue(':teacherId', $teacherId);
 			   	$stmt->bindValue(':level', $level);
 				   $stmt->bindValue(':instrument', $instrument);
 				   $stmt->bindValue(':festivalId', $festivalId);
 				   $stmt->bindValue(':regFee', $regFee);
               $stmt->bindValue(':registrationId2',$registrationId2);
 				   $stmt->execute();
 				   $stmt->closeCursor();
 			   	print "Student has been registered ";	
 			   }
            catch (PDOException $e)
            {
 			   	print "Student ID # $studentId2 registration update failed! - Database error!";
 				   exit;
 			   }
            
         }
      }
             
?>
