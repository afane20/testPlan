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
   $building = "AUS";
   $room = "212C";

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
   
   $rowCount = mysql_num_rows( $data );  

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
      print "<br/><h1 class = 'center'>No Students are registered for this Resource!</h1>";
      exit;
   }
   $displayCnt = 30;       // maximum lines allowed per page
   $performanceDate = 0;
   $printCnt = 0;          // how may have been printed
   $prevPerformanceDate = 0;
   $prevTimeAmPm = 0;
 

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
      $uvmtaId = $currentRow['uvmtaId'];
      $performanceDate = $currentRow['performanceDate'];
      // don't add a page break that would split students onto two different pages if the performance times are the same (i.e duet)
      if ($printCnt == 0)
      {
         $length = strlen($timeAmPm);
         $pattern = substr($timeAmPm,$length - 2, $length);
      }
      
      if ($pattern != substr($timeAmPm, strlen($timeAmPm) - 2, strlen($timeAmPm)))
      {
          $printCnt = 0;
      }

      if ($prevPerformanceDate != 0 && $prevPerformanceDate != $performanceDate)
      {
         $printCnt = 0;
      }
      
      if ($printCnt >= $displayCnt && $prevTimeAmPm != $timeAmPm )
      {
         $printCnt = 0;
      }

      if ($printCnt == 0)
      {
         if ($prevPerformanceDate != 0)
         {
            print "</table>\n";
            print "<h3 style = 'page-break-before:always'></h3>";
            $length = strlen($timeAmPm);
            $pattern = substr($timeAmPm,$length - 2, $length);
         }
         
         $timestamp = strtotime($performanceDate);
         $displayDate = date('D,  M. j  Y',$timestamp);

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

      $printCnt++;
      $prevPerformanceDate = $performanceDate;  // save the day just displayed
      $prevTimeAmPm = $timeAmPm;
   }
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