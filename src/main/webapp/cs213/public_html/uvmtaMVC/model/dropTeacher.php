<?php
   include 'loginValid.php';

   if ( !isset($_GET['teacherId'] ) )
   {
      print "Server Error: Please try again later";
      exit;
   }

   $teacherId = $_GET['teacherId'];

   require_once("dbConnect.php");

   $query = "DELETE FROM teacher WHERE teacherId=".
            $teacherId . ";";
   
   $data = mysql_query( $query );
   
   if ( !$data )
   {
      print "Teacher can't be deleted! "; 
      exit;
   }

   print "Teacher has been deleted!  ";
   $unknown = 1;     // Id number for the teacher names "unknown"
   // before deleting, set all this teachers students to have teacher Unknown
   $query = "UPDATE student SET teacherId=$unknown" .
            " WHERE teacherId = $teacherId";

   if (mysql_query($query))
   {
      print "their students have been set to teacher named 'Unknown' (Teacher Id #1).";
   }
   

?>
