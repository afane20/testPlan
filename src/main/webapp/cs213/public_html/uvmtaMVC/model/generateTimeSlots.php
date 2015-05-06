<?php

// converts the level number to corresponding string description
function levelToString($level)
{
   switch($level)
   {
      case 1:
         $roomLevel = "beginners";
         break;
      case 2:
         $roomLevel = "early inter";
         break;
      case 3:
         $roomLevel = "beginner/early inter";
         break;
      case 4:
         $roomLevel = "intermediate";
         break;
      case 7:
         $roomLevel = "beg/early inter/inter";
         break;
      case 8:
         $roomLevel = "late inter";
         break;
      case 12:
         $roomLevel = "inter / late inter";
         break;
      case 16:
         $roomLevel = "pre-advanced only";
         break;       
      case 32:
         $roomLevel = "advanced only";
         break;
      case 48:
         $roomLevel = "pre-advanced/advanced";
         break;
      case 63:
         $roomLevel = "All levels";        
   }
   return $roomLevel;
}
?>

<?php
   include 'loginValid.php';

   require_once("dbConnect.php");

   $sortBy = $_GET['sortBy'];
   $resourceId  = $_GET['resourceId'];   // "all" or a resource Id #
   $festivalId = $_GET['festivalId'];
   $festivalDate = $_GET['festivalDate'];
   $alternateDate = $_GET['alternateDate'];
   $numFestivals = 0; // assume we cannot generate timeslots

   // building "All" timeslots is only valid in non-current festivals
   if ($resourceId == "all")
   {   
      $query = "SELECT currentFestival,festivalId,regOpen,regOpenEarly FROM festival " .
               "WHERE festivalId = $festivalId && currentFestival = 'N'";  

      $data = mysql_query($query);
      if ($data)
      {
         $numFestivals = mysql_num_rows( $data );
      }
   }
   else
   {
      // Building timeslots for a single resource is valid on any festival.
      $query = "SELECT currentFestival,festivalId,regOpen,regOpenEarly, festivalDate, alternateDate FROM festival " .
               "WHERE festivalId = $festivalId";

      $data = mysql_query($query);

      if ($data)
      {
         $numFestivals = mysql_num_rows( $data );

         if ($NumFestivals == 1)
         {
            $currentRow = mysql_fetch_array($data);
            $festivalDate = $currentRow['festivalDate'];
            $alternateDate = $currentRow['alternateDate'];
         }
      }
      else
      {
         print "Festival not found - timeslots not generated";
      }
   }
   // if a valid festival is found, generate timeslots
  
   if ($numFestivals == 1)
   {
      if ($resourceId == "all")
      {
         $query = "DELETE FROM registration where festivalId = $festivalId";      // delete all registration records
         $data = mysql_query( $query );

         $query = "DELETE FROM timeslot where festivalId = $festivalId";          // delete all timeslot records before regenerating
         $data = mysql_query( $query );
      }
      // generate timeslots for resources available on festival day
      $noFestivalDayResources =  generateTimeSlots($resourceId,$sortBy,"F", $festivalId, $festivalDate, $alternateDate);
      // generate timeslots for resources available on alternate day
      $noAlternateDayResources = generateTimeSlots($resourceId,$sortBy,"A",$festivalId, $festivalDate, $alternateDate);
      // generate timeslots for resources available on both days
      $noBothDayResources  = generateTimeSlots($resourceId,$sortBy,"B",$festivalId, $festivalDate, $alternateDate); 
      if ($noFestivalDayResources == true && $noBothDayResources == true)
         print " No timeslots were generated for Festival day, no resources were available! <br/> ";
      if ($noAlternateDayResources == true && $noBothDayResources == true)
         print " No timeslots were generated for Alternate day, no resources were available! <br/>";
   }
   else
   {
      if ($resourceId == "all")
      {
        print "Error - Registration is Open or Festival is \"active\".  You cannot generate timeslots!!!";
      }
   }

  /******************************************************************************************
  * Input: resourceId -  "all"  generate time slots for all resources
  *                      integer - generate timeslots for the specifiec resource Id #
  * return - no resources were available to generate time shots
  ******************************************************************************************/
  function generateTimeSlots($resourceId,$sortBy, $whichDay, $festivalId, $festivalDate, $alternateDate)
  {
      if ($resourceId == "all")
      {
        $query = "SELECT * FROM resource WHERE available = '$whichDay' ORDER BY $sortBy";
      }
      else
      {
        $query = "SELECT * FROM resource WHERE available = '$whichDay' AND resourceId = $resourceId ORDER BY $sortBy";
      }

      $data = mysql_query( $query );
   
      if ( !$data )
      {
         print "Cannot access resources! " . mysql_error();
         exit;
      }
   
      $rowCount = mysql_num_rows( $data );

      if ($rowCount == 0)
      {
         $noAvailableResources = true;
      }  
      else
      {
         $noAvailableResources = false;
         for ($row = 0; $row < $rowCount; $row++)
         {
            $currentRow = mysql_fetch_array( $data );
            $resourceId = $currentRow['resourceId'];
            $address= $currentRow['address'];
            $building = $currentRow['building'];
            $room = $currentRow['room'];
            $level = $currentRow['level'];
            $startTime = $currentRow['startTime'];
            $endTime = $currentRow['endTime'];
            $timeIncrement = $currentRow['timeIncrement'];
            $pianos = $currentRow['pianos'];
            $available = $currentRow['available'];
      
            $levelName = levelToString($level);
            
            if ($whichDay == "F" || $whichDay == "B")
            {
               $festivalDay = 1;  // festival day
               $timeSlotDate = $festivalDate;

               $startDateTime = $timeSlotDate . " " . $startTime;   // add starting time to the festival date
               $endDateTime = $timeSlotDate . " " . $endTime;       // add ending time to the festival date
               $startTimeStamp = strToTime($startDateTime);         // convert string to a time stamp (seconds)
               $endTimeStamp = strToTime($endDateTime);             // convert to time stamp (seconds)

               for ($timeSlot = $startTimeStamp; $timeSlot < $endTimeStamp; $timeSlot += $timeIncrement * 60)
               {
                  $timeSlotTime = date('H:i',$timeSlot);  // create a 24 hour clock (time Only)
                  $query = "INSERT INTO timeslot (time,address,room,building,level,pianos,scheduled,festivalDay,festivalId)
                           VALUES ('$timeSlotTime','$address','$room','$building',$level,$pianos,0,$festivalDay,$festivalId)";     
                  $data1 = mysql_query( $query );
                  if ( !$data1 )
                  {
                     print "Error - Problem generating time slots for $building $room!";
                  }
               }
            }
            
            if ($whichDay == "A" || $whichDay == "B")
            {
               $festivalDay = 2;  // alternate day
               $timeSlotDate = $alternateDate;
            
               $startDateTime = $timeSlotDate . " " . $startTime;   // add starting time to the festival date
               $endDateTime = $timeSlotDate . " " . $endTime;       // add ending time to the festival date
               $startTimeStamp = strToTime($startDateTime);         // convert string to a time stamp (seconds)
               $endTimeStamp = strToTime($endDateTime);             // convert to time stamp (seconds)

               for ($timeSlot = $startTimeStamp; $timeSlot < $endTimeStamp; $timeSlot += $timeIncrement * 60)
               {
                  $timeSlotTime = date('H:i',$timeSlot);  // create a 24 hour clock (time Only)
                  $query = "INSERT INTO timeslot (time,address,room,building,level,pianos,scheduled,festivalDay,festivalId)
                           VALUES ('$timeSlotTime','$address','$room','$building',$level,$pianos,0,$festivalDay,$festivalId)";     
                  $data1 = mysql_query( $query );
                  if ( !$data1 )
                  {
                     print "Error - Problem generating time slots for $building $room!";
                  }
               }
            }
            // update the builtslots table to indicate time slots have been built for this
            // resource for the given festival.
            $query = "INSERT INTO builtslots (resourceId,festivalId)
                      VALUES ($resourceId,$festivalId)";
            $result = mysql_query( $query );
            if (!$result)
            {
               print "Error - Updating builtslots record!";
            }
            
            $query = "UPDATE resource SET timeslotsBuilt = 'Y' WHERE resourceId=$resourceId";
            $result = mysql_query( $query );
            if ( !$result )
            {
               print "Error - Updating Resource record - field named 'timeslotsBuilt'";
            }
         }
         if ($whichDay == "F")  print " Festival day timeslots generated successfully! <br/> ";
         if ($whichDay == "A")  print " Alternate day timeslots generated successfully! <br/> ";
         if ($whichDay == "B")  print " \"BOTH\" day timeslots generated successfully!";
      }
      return $noAvailableResources;
  }
 ?>
