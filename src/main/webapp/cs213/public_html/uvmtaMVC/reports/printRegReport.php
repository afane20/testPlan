<?php

   include "../model/loginValid.php";

   require_once("../model/dbConnect.php");
   $myDatabase = mysql_select_db("uvmta");
   
   if ( !$myDatabase )
   {
      print "Database Could not be located!";
      exit;
   }
   $building = $_GET['building'];
   $room = $_GET['room'];
   $startTime = $_GET['startTime'];
   $endTime = $_GET['endTime'];
   $timeInc = $_GET['timeInc'];
   $resourceId = $_GET['resourceId'];

//  $festivalId = 8;    ////////// need to fix the festival ID if I add "AND registration.festivalId = $festivalId" to query /////////////

   $query = "SELECT timeslot.building,timeslot.room,timeslot.time,student.first,student.last,
               registration.studentId,registration.type,registration.instrument,registration.level,
               registration.teacherId,registration.performanceDate,teacher.uvmtaId 
               FROM registration,timeslot,student,teacher WHERE registration.timeslotId = timeslot.timeslotId
               AND registration.studentId = student.studentId AND teacher.teacherId = registration.teacherId";

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
   
   $rowCount = mysql_num_rows( $data );  // number of records returned
   $recordsFetched = 0;                  // number of records processed
?>
   
<html>
<head>
  <title>Registration Report</title>
  <link rel="stylesheet" type="text/css" href="css/reports.css" />
  <script src="../js/jquery.js"></script>   
</head>
<body>
<?php

   if ($rowCount == 0)
   {
      print "<br/><h1 class = 'center'>No Students are registered for $building  $room!</h1>";
      exit;
   }
   $displayCnt = 30;       // maximum lines allowed per page
   $performanceDate = 0;
   $printCnt = 0;          // how may have been printed
   $prevPerformanceDate = 0;
   $prevPerformanceType = 0;
   $resetLoop = false;
   $duetCnt = 0;          

   $startTimeStamp = strToTime($startTime);         // convert string to a time stamp (seconds)
   $endTimeStamp = strToTime($endTime);             // convert to time stamp (seconds)

   $currentRow = mysql_fetch_array( $data ); 

   for($rowTime = $startTimeStamp; $rowTime < $endTimeStamp; )
   {
 
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
      $uvmtaId = $currentRow['uvmtaId'];
      $performanceDate = $currentRow['performanceDate'];
      $printableTime = date('h:i a',$rowTime); // convert to am pm
      if ($printCnt == $displayCnt)
      {
         $printCnt = 0;
      }
      
      if ($printCnt == 0)
      {
         $length = strlen($printableTime);
         $pattern = substr($printableTime,$length - 2, $length);
      }
      // check for reaching Noon so you print another heading      
      if ($pattern != substr($printableTime, strlen($printableTime) - 2, strlen($printableTime)))
      {
          $printCnt = 0;
      }
   
      // If a different Day - print a new heading
      if ($prevPerformanceDate != 0 && $prevPerformanceDate != $performanceDate)
      {
         $resetLoop = true;
      }

 
      if ($printCnt == 0 && $duetCnt >= 1)
      {
            $rowTime -= $timeInc * 60;  // decrement so time is printed twice to handle duet special case
            $printCnt = -1;
            $duetCnt = 0;
      }
      
      if ($printCnt == 0)
      {
         if ($prevPerformanceDate != 0)
         {
            print "</table>\n";
            print "<h3 style = 'page-break-before:always'></h3>";
            $length = strlen($printableTime);
            $pattern = substr($printableTime,$length - 2, $length);
         }
             
         $dateTimeStamp = strtotime($performanceDate);
         $displayDate = date('D,  M. j  Y',$dateTimeStamp);

         print "<h3>$building $room<span style='position: relative; left: 200px'>$displayDate</span></h3>\n"; 
         print "<table cellpadding = '4px'>\n";
         print "  <tr style = 'text-decoration: underline'>
                   <th class = 'print'>Time</th>
                   <th class = 'print'>First Name</th>
                   <th class = 'print'>Last Name</th>
                   <th class = 'print'>Level</th>
                   <th class = 'print'>Instrument</th>
                   <th class = 'print'>Type</th>
                   <th class = 'print'>Teacher</th>
                   <th class = 'print'>Scores</th>
                  </tr>
               ";
      }

      if ($timeStamp == $rowTime)
      {
         print "<tr>";
         print "<td class = 'print'>$timeAmPm</td>";
         print "<td class = 'print'>$firstName</td>";
         print "<td class = 'print'>$lastName</td>";
         print "<td class = 'print'>$levelName</td>";
         print "<td class = 'print'>$instrument</td>";
         print "<td class = 'print'>$performanceType</td>";
         print "<td class = 'print'>$uvmtaId</td>";
         print "<td class = 'print'> </td>";   // print blank spot for score
         print "</tr>";
         print "\n";

         if ($performanceType == "Duet" && $duetCnt < 1)
         {
            $duetCnt++;
         }
         else
         {
            $duetCnt = 0;
         }
         
         // check for duet (i.e duet)
         if ($performanceType == "Duet" && $duetCnt == 1)
         {
            $rowTime -= $timeInc * 60;  // decrement so time is printed twice to handle duet special case
         }
  
         if ($recordsFetched < $rowCount)
         {
           $recordsFetched++; 
           $currentRow = mysql_fetch_array( $data );
         }
      }
      else
      {
       $printableTime = date('h:i a',$rowTime); // convert to am pm
        print "<tr><td>$printableTime</td></tr>";         // print an empty spot
      }

      $printCnt++;

      $prevPerformanceDate = $performanceDate;  // save the day just displayed
      $prevPerformanceType = $performanceType;
      $rowTime += $timeInc * 60;  // for loop increment

      if ($resetLoop && $rowTime == $endTimeStamp)
      {
         $rowTime = $startTimeStamp;
         $resetLoop = false;
      }
      
  } // end for

?>
</body>
</html>

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
?>