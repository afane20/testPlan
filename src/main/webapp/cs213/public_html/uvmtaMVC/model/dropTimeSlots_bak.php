<?php
   include 'loginValid.php';

   require_once("dbConnect.php");

   $festivalId = $_GET['festivalId'];

   // query to see if valid to generate time slots
   $query = "SELECT currentFestival,festivalName,regOpen,regOpenEarly FROM festival
             WHERE festivalId = $festivalId";

   
   $data = mysql_query($query);

   $currentRow = mysql_fetch_array( $data );
   $currentFestival = $currentRow['currentFestival'];
   $festivalName = $currentRow['festivalName'];
   $regOpen = $currentRow['regOpen'];
   $regOpenEarly = $currentRow['regOpenEarly'];

   // Can't remove timeslots if 'Active' Festival is 'Open' for Registration
   if ($regOpen != "Y" && $regOpenEarly != "Y")
   {

         $query = "DELETE FROM registration WHERE festivalId = $festivalId";  // delete all registration records
         $data = mysql_query( $query );

         $query = "DELETE FROM timeslot WHERE festivalId = $festivalId";  // delete all timeslot records
         $data = mysql_query( $query );


         $query = "UPDATE resource SET timeslotsBuilt = 'N'"; 
         $data = mysql_query( $query );
         print "Timeslots removed successfully from $festivalName!";
   }
   else
   {
      print "Registration is Open.  Timeslots were NOT deleted!";
   }

?>
