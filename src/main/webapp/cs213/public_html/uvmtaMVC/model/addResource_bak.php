<?php
   include 'loginValid.php';

   $address = $_GET['address'];
   $building = $_GET['building'];
   $room = $_GET['room'];
   $level = $_GET['level'];
   $startTime = $_GET['startTime'];
   $endTime = $_GET['endTime'];
   $timeIncrement = $_GET['timeIncrement'];
   $pianos = $_GET['pianos'];
   $available = $_GET['available'];
   $miscInfo = $_GET['miscInfo'];
 
   require_once("dbConnect.php");
   
   $query = "INSERT INTO resource (address,building,room,level,
                                   startTime,endTime,timeIncrement,pianos,available,timeslotsBuilt,miscInfo)"
             ." VALUES (" .
                        "\"" . $address . "\", \"" . $building . "\", \"" .
                        $room . "\", " . $level . ", \"" . 
                        $startTime . "\", \"" . $endTime . "\", " .
                        $timeIncrement . ", " . $pianos . ", \"" .
                        $available . "\", \"N\", \"" . $miscInfo . "\");";
   $data = mysql_query( $query );
   if ( !$data )
   {
      print "Database error - Resource could not be created!";
      exit;
   }
   else
  {
     print "Resource $building $room was added successfully!";
  }
?>
