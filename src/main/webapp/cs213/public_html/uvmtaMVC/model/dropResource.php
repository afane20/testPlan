<?php
   include 'loginValid.php';

   if ( !isset($_GET['resourceId'] ) )
   {
      print "Server Error: Please try again later";
      exit;
   }

   $resourceId = $_GET['resourceId'];
   $building = $_GET['building'];
   $room = $_GET['room']; 
   $timeslotsBuilt = $_GET['timeslotsBuilt'];

   require_once("dbConnect.php");

   if ( $timeslotsBuilt == 'N')
   {
      $query = "DELETE FROM resource WHERE resourceId = $resourceId";
      if (mysql_query($query))
      {    
         print "The following resource '$building $room' had been deleted!";
      }
      else
      {
         print "Error removing resource '$building $room' -" . mysql_error();
      }
   }
   else
   {
     print "Cannot remove a resouce if timeslots are already built!"; 
   }

?>
