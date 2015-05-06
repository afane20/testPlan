<?php
   include 'loginValid.php';

   if ( !isset($_GET['studentId'] ) )
   {
      print "Server Error: Please try again later";
      exit;
   }

   $studentId = $_GET['studentId'];
 
   require_once("dbConnect.php");

   $query = "UPDATE student SET teacherId = 1 WHERE studentId=$studentId;";
   $data = mysql_query( $query );
   
   if ( !$data )
   {
      print "Student can't be deleted. Did you forget to unregister the student?"; 
      exit;
   }

   print "Student has been deleted";
   mysql_close($database);
?>
