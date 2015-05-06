<?php
  // converts the level number to corresponding string description
   function levelToString($level)
   {
      switch($level)
      {
         case '1':
            $level = "beginner";
            break;
         case '2':
            $level = "intermediate";
            break;
         case '4':
            $level = "pre-advanced";
            break;
         case '8':
            $level = "advanced";
            break;
         case '16':
            $level = "Jr";
            break;
         case '32':
            $level = "Sr";
            break;
      }
      return $level;
   }


   include "../model/loginValid.php";
   require_once("../model/dbConnect.php");

   $building = $_GET['building'];
   $room = $_GET['room'];
   $festivalId = 8;    ////////// need to fix the festival ID if I add "AND registration.festivalId = $festivalId" to query /////////////

   $query = "SELECT timeslot.building,timeslot.room,timeslot.time,student.first,student.last,
               registration.studentId,registration.type,registration.instrument,registration.level,
               registration.teacherId, registration.performanceDate
               FROM registration,timeslot,student WHERE registration.timeslotId = timeslot.timeslotId
               AND registration.studentId = student.studentId";

   if ($building != "")
   {
      $query = $query . " AND timeslot.building = '$building' ";
   }

   if ($room != "")    
   {
      $query = $query . " AND timeslot.room = '$room' ";
   }
   $query = $query . " ORDER BY performanceDate, building, room, time ";

   // print "$query";


   $data = mysql_query( $query );
   
   if ( !$data )
   {
      print "Invalid query string: ".mysql_error();
      exit;
   }
   
   $rowCount = mysql_num_rows( $data );
   

?>   
   <table class = "center" border = "1" rules = "cols">
   <tr class = "bgcolored">
      <td><input class = "button" type = "button" onclick="regList('building')" value = "building"/></td>
      <td><input class = "button" type = "button" onclick="regList('room')" value = "room #"/></td>
      <td>Date</td>
      <td>Time</td>
      <td>First Name</td>
      <td>Last Name</td>
      <td>Performance Level</td>
      <td>Instrument</td>
      <td>Type</td>
      <td>Teacher ID</td>
   </tr>     

<?php
   for($row = 0; $row < $rowCount; $row++)
   {
      $currentRow = mysql_fetch_array( $data );
      $building = $currentRow['building'];
      $room = $currentRow['room'];
      $level = $currentRow['level'];
      $levelName = levelToString($level);
      
      $time24 = $currentRow['time'];    // get 24 hr time
      $timeStamp = strToTime($time24);  // convert to timestamp
      $timeAmPm = date('h:i a',$timeStamp); // convert to am pm
      
      $firstName = $currentRow['first'];
      $lastName = $currentRow['last'];
      $instrument = $currentRow['instrument'];
      $performanceType = $currentRow['type'];
      $teacherId = $currentRow['teacherId'];
      $performanceDate = $currentRow['performanceDate'];
      if ($row % 2 == 0)                // highlight every other row
      {
         print "<tr>";
      }
      else
      {
         print "<tr style =\"background: #f8f8f8 \">";
      }

      print "<td>$building</td>";
      print "<td>$room</td>";
      print "<td>$performanceDate</td>";
      print "<td>$timeAmPm</td>";
      print "<td>$firstName</td>";
      print "<td>$lastName</td>";
      print "<td>$levelName</td>";
      print "<td>$instrument</td>";
      print "<td>$performanceType</td>";
      print "<td>$teacherId</td>";
      print "</tr>";      
   }
?>
   </table>
