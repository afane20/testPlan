<?php
   include 'loginValid.php';
   require_once 'dbConnPDO.php';
   $db = getDB();

   $address = sanStr($_GET['address']);
   $building = sanStr($_GET['building']);
   $room = sanStr($_GET['room']);
   $level = valInt($_GET['level']);
   $startTime = sanStr($_GET['startTime']);
   $endTime = sanStr($_GET['endTime']);
   $timeIncrement = valInt($_GET['timeIncrement']);
   $pianos = valInt($_GET['pianos']);
   $available = sanStr($_GET['available']);
   $miscInfo = sanStr($_GET['miscInfo']);
   
   $query = 'INSERT INTO resource (address, building, room, level, startTime, endTime, timeIncrement, pianos, available, timeslotsBuilt, miscInfo) VALUES (:address, :building, :room, :level, :startTime, :endTime, :timeIncrement, :pianos, :available, "N", :miscInfo);';
   
   try {
   	$stmt = $db->prepare($query);
   	$stmt->bindValue(':address', $address);
   	$stmt->bindValue(':building', $building);
   	$stmt->bindValue(':room', $room);
   	$stmt->bindValue(':level', $level);
   	$stmt->bindValue(':startTime', $startTime);
   	$stmt->bindValue(':endTime', $endTime);
   	$stmt->bindValue(':timeIncrement', $timeIncrement);
   	$stmt->bindValue(':pianos', $pianos);
   	$stmt->bindValue(':available', $available);
   	$stmt->bindValue(':miscInfo', $miscInfo);
   	$stmt->execute();
   	$stmt->closeCursor();
   	print "Resource $building $room was added successfully!";
   } catch (PDOException $e) {
   	print "Database error - Resource could not be created!";
   	exit;
   }
?>
