<?php
   include 'loginValid.php';

   $resourceId = $_GET['resourceId'];
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

   $query = "UPDATE resource SET address='$address',building='$building'," .
                        "room='$room',level=$level,startTime='$startTime'," .
                        "endTime='$endTime',timeIncrement=$timeIncrement,pianos=$pianos," .
                        "available='$available',miscInfo='$miscInfo'" .
                      " WHERE resourceId=$resourceId";
   if (mysql_query($query))
   {
      print "Resource $building $room has been changed!";
   }
   else
   {
      print "Error - Resource $building $room was not modified!";
   }

?>
