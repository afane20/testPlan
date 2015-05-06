<?php
   include 'loginValid.php';

   if ( !isset($_GET['studentId'] ) )
   {
      print "Server Error: Please try again later";
      exit;
   }

   require_once("dbConnect.php");
   $gradYear = $_GET['gradYear'];
   $teacherId = $_GET['teacherId'];
   $firstName = $_GET['firstName'];

   $lastName = $_GET['lastName'];
   $instrument = $_GET['instrument'];
   $festivals = $_GET['festivals'];
   $gradYear = $_GET['gradYear'];
   $points = $_GET['points'];
   $lastFestDate = $_GET['lastFestDate'];
   $studentId = $_GET['studentId'];

   $query = "UPDATE student SET first='$firstName',last='$lastName',festivals=$festivals,
            points=$points,lastFestDate='$lastFestDate',instrument='$instrument',gradYear='$gradYear',
            teacherId=$teacherId  WHERE studentId=$studentId";
   if (mysql_query($query))
   {
      print "Student Update Successful!";
   }
   else
   {
      
      print "Error - Update unsuccessful! A teacher with ID # '$teacherId' does not exist! <br /> "; 
      print " Invalid query - $query";
   }   

?>
