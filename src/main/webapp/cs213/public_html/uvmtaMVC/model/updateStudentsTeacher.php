<?php
   include 'loginValid.php';
   if ( !isset($_SESSION['teacherId'] ) )
   {
      print "Server Error: Please try again later";
      exit;
   }

   require_once("dbConnect.php");
   $studentId = $_GET['studentId'];
   $teacherId = $_SESSION['teacherId'];

   $query = "UPDATE student SET teacherId=$teacherId" .
            " WHERE studentId=$studentId";
  

   if (mysql_query($query))
   {
      print "Student was added successfully!";
   }
   else
   {
      
      print "Error - Update unsuccessful! A teacher with ID # '$teacherId' does not exist! <br /> "; 
      print " Invalid query - $query";
   }   

?>
