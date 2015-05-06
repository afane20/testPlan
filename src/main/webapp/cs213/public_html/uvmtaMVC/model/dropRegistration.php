<?php
   include 'loginValid.php';

   $fullName = $_GET['fullName'];
   $timeslotId = $_GET['timeslotId'];

   require_once("dbConnect.php");

   // Delete registration record and update times slot so it's not scheduled
   $query = "DELETE FROM registration WHERE timeslotId=$timeslotId";
   $query2 = "UPDATE timeslot SET scheduled = 0 WHERE timeslotId=$timeslotId";  
   if (mysql_query($query))
   {    
      print "$fullName is no longer registered!";
      mysql_query($query2);  // make timeslot available again
   }
   else
   {
      print "Error removing $fullName from registration -  Database error:" . mysql_error();
   }

?>
