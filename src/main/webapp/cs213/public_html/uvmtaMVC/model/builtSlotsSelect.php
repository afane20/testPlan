<?php
   include 'loginValid.php';

   if ( !isset($_SESSION['teacherId'] ) )
   {
      print "Server Error: Please try again later";
      exit;

   }

   $teacherId = $_SESSION['teacherId'];
   $resourceId = $_GET['resourceId'];
   $festivalId = $_GET['festivalId'];
   require_once("dbConnect.php");
   if ($resourceId == "all")
   {
      $query = "SELECT festivalId, resourceId FROM builtslots  WHERE festivalId = $festivalId";        
   }
   else
   {
      $query = "SELECT festivalId, resourceId FROM builtslots  WHERE resourceId = $resourceId AND festivalId = $festivalId";        
   }

   $data = mysql_query( $query );
   
   if ( !$data )
   {
      print "Invalid query string: ".mysql_error();
      exit;
   }
   
   $rowCount = mysql_num_rows( $data );
   if($rowCount == 0)
   {  
      print "Y";  // it's ok to generate - no records were found for this resource and festival id       
   }
   else
   {
      print "N"; //You may not build time slots for this festival.
   }
?>