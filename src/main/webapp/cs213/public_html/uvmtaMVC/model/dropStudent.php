<?php
   include 'loginValid.php';

   if ( !isset($_GET['studentId'] ) )
   {
      print "Server Error: Please try again later";
      exit;
   }

   $studentId = $_GET['studentId'];
   $firstName = $_GET['firstName'];
   $lastName = $_GET['lastName'];
   
   require_once("dbConnect.php");
   
   $query = "DELETE FROM student WHERE studentId=" . $studentId;

   if (mysql_query($query))
   {
      print "$firstName $lastName has been deleted!";
   }
   else
   {
      print "Error Deleting Student ID # $studentId  - Database error:" . mysql_error();
   }

?>
