<?php
   include 'loginValid.php';
   require_once 'dbConnPDO.php';
   $db = getDB();

   $level = valInt($_GET['level']);
   $performanceType = sanStr($_GET['performanceType']);
   $instrument = sanStr($_GET['instrument']);
   $festivalDay = valInt($_GET['festivalDay']);
   $festivalId = valInt($_GET['festivalId']);
   $slotSortOrder = sanStr($_GET['sortOrder']);
   
   // How many pianos will be needed
   if ($performanceType == "Concerto") {
      $pianos = 2;
   } else if ($instrument == "piano" || $instrument == "voice") {
      $pianos = 1;
   } else {
      $pianos = 0;
   }

	 // Order by time or building, room, then time
   if ($slotSortOrder == "T") {
      $sortBy = "time";
   } else {
      $sortBy = "building,room,time";
   }

    $query = "SELECT timeslotId, time, room, building, level, pianos, scheduled FROM timeslot
             WHERE (level & :level) AND pianos >= :pianos AND scheduled = 0
             AND festivalDay = :festivalDay AND festivalId = :festivalId ORDER BY :sortBy";           
	try {
		$stmt = $db->prepare($query);
		$stmt->bindValue(':level', $level);
		$stmt->bindValue(':pianos', $pianos);
		$stmt->bindValue(':festivalDay', $festivalDay);
		$stmt->bindValue(':festivalId', $festivalId);
		$stmt->bindValue(':sortBy', $sortBy);
		$stmt->execute();
		$rows = $stmt->fetchAll();
		$stmt->closeCursor();
	} catch (PDOException $e) {
		print "No slots are available";
		exit;
	}
   print "<select id='slots' style = 'position: relative; top: 9px'>";

   
   foreach ($rows as $timeSlot) {
      $time24 = $timeSlot['time'];
      $timeStamp = strToTime($time24); // convert to timestamp
      $timeAmPm = date('h:i a',$timeStamp); // convert to am pm time

      print "<option value=\"" . $timeSlot['timeslotId'] . "\">" .
      $timeAmPm . " " . $timeSlot['room'] . " " .
      $timeSlot['building'] . "</option> \n";      
   }
   print "</select>";
?>

