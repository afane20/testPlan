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


   include "loginValid.php";
$database = mysql_connect("jordan", "ercanbracks","scotte");
   
   
   //check for database connection failures
   if ( !$database )
   {
      print "Database is offline";
      exit;
   }
   
   $myDatabase = mysql_select_db("uvmta");
   
   if ( !$myDatabase )
   {
      print "Database Could not be located!";
      exit;
   }
   $building = $_GET['building'];
   $room = $_GET['room'];
   $festivalId = 8;    ////////// need to fix the festival ID if I add "AND registration.festivalId = $festivalId" to query /////////////

   $query = "SELECT timeslot.building,timeslot.room,timeslot.time,student.first,student.last,
               registration.studentId,registration.type,registration.instrument,registration.level
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
   $query = $query . " ORDER BY room, time ";

   // print "$query";


   $data = mysql_query( $query );
   
   if ( !$data )
   {
      print "Invalid query string: ".mysql_error();
      exit;
   }
   
   $rowCount = mysql_num_rows( $data );
   

?>   
<html>
<head>
  <title> Printable Registration Report</title>
  <link rel="stylesheet" type="text/css" href="../uvmta.css" />
</head>
<body>
<table border = "0" style = "border-spacing:10px 50px" >

<?php
   for($row = 0; $row < $rowCount; $row++)
   {
      if ( $row % 5 == 0)
      {
         print("   <tr style = 'page-break-before:always; text-decoration: underline'>
                   <td class = 'print'>Building</td>
                   <td class = 'print'>Room</td>
                   <td class = 'print'>Time</td>
                   <td class = 'print'>First Name</td>
                   <td class = 'print'>Last Name</td>
                   <td class = 'print'>Performance Level</td>
                   <td class = 'print'>Instrument</td>
                   <td class = 'print'>Type</td>
                   </tr>
               ");
      }
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
      
      print "<tr>";
      print "<td class = 'print'>$building</td>";
      print "<td class = 'print'>$room</td>";
      print "<td class = 'print'>$timeAmPm</td>";
      print "<td class = 'print'>$firstName</td>";
      print "<td class = 'print'>$lastName</td>";
      print "<td class = 'print'>$levelName</td>";
      print "<td class = 'print'>$instrument</td>";
      print "<td class = 'print'>$performanceType</td>";
      print "</tr>";
      print "\n";
   }
?>
   </table>
</body>
</html>