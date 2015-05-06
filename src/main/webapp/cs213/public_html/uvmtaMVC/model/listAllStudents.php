<?php
   include 'loginValid.php';

   require_once("dbConnect.php");

   $firstName = $_GET['firstName'];
   $lastName = $_GET['lastName'];
   $festivals = $_GET['festivals'];
   $points = $_GET['points'];
   $lastFestDate = $_GET['lastFest'];

   //$timeStamp = strtotime($lastFestDate);
   //$lastFestDate = date('Y-m-d',$timeStamp);

   $teacherId = $_GET['teacherId'];

   $query = "SELECT student.studentId, student.last, student.first, student.festivals, student.points,
             student.lastFestDate, student.teacherId, teacher.first, teacher.last 
             FROM student, teacher WHERE student.teacherId = teacher.teacherId ";

   if ($lastName != "" && $firstName != "")
   {
      $query = $query .  " AND student.last = '" . $lastName . "' AND student.first = '" . $firstName . "'";
   }
   else if ($firstName != "" && $lastName == "")
   {
      $query = $query .  " AND student.first = '" . $firstName . "'";
   }
   else if ($lastName != "" && $firstName == "")
   {
      $query = $query .  " AND student.last = '" . $lastName . "'";
   }
   else if ($teacherId != "")
   {
      $query = $query .  " AND student.teacherId = " . $teacherId;
   }
   else if ($festivals != "")
   {
      $query = $query .  " AND student.festivals = " . $festivals;      
   }
   else if ($points != "")
   {
      $query = $query .  " AND student.points = " . $points;
   }
   else if ($lastFestDate != "")
   {
      $query = $query .  " AND student.lastFestDate = '" . $lastFestDate . "'";
   }
   else
   {   
     // query to get ALL students in database
     $query = "SELECT student.studentId, student.last, student.first, student.festivals, student.points,
             student.lastFestDate, student.teacherId, teacher.first, teacher.last 
             FROM student, teacher WHERE student.teacherId = teacher.teacherId ";
   }

   $query = $query . " ORDER BY student." . $_GET["sortBy"];

   $data = mysql_query( $query );
   
   if ( !$data )
   {
      print "Invalid query string: ".mysql_error();
      exit;
   }
   
   $rowCount = mysql_num_rows( $data );
   $currentRow;
   mysql_close($database);   
?>
   <table rules = "cols" border="1">
    <tr class = "bgcolored">
       <td>Action</td>
       <td><input class = "button" type = "button" onclick="selectStudent('last')" value = "Last Name"/></td>
       <td><input class = "button" type = "button" onclick="selectStudent('first')" value = "First Name"/></td>
       <td><input class = "button" type = "button" onclick="selectStudent('festivals')" value = "Festivals"/></td>      
       <td><input class = "button" type = "button" onclick="selectStudent('points')" value = "Points"/></td>
       <td><input class = "button" type = "button" onclick="selectStudent('lastFestDate')" value = "Last Festival"/></td>
       <td><input class = "button" type = "button" onclick="selectStudent('teacherId')" value = "   Teacher  "/></td>
       <td>ID #</td>
       <td>Action</td>
     </tr>

 
 <?php
   for($row = 0; $row < $rowCount; $row++)
   {

      $currentRow = mysql_fetch_array( $data );
      $studentId = $currentRow['studentId'];
      $lastName = $currentRow[1];       // last - student
      $firstName = $currentRow[2];      // first - student
      $festivals = $currentRow['festivals']; // # of festivals participated in
      $points = $currentRow['points'];  // points 
      $lastFestDate = $currentRow[5];   // last festival date
      $teacherId = $currentRow[6];      // teacherId
      $teacherFirst = $currentRow[7];   // last - teacher
      $teacherLast = $currentRow[8];    // last - student
      if ($row % 2 == 0)                // highlight every other row
      {
         print "<tr>";
      }
      else
      {
         print "<tr style =\"background: #f8f8f8 \">";
      }
      print " <td><a href=\"javascript:modifyStudent($studentId,'$firstName','$lastName')\">Modify</a></td>";
      print "<td>$lastName</td>";
      print "<td>$firstName</td>";
      print "<td>$festivals</td>";
      print "<td>$points</td>";
      print "<td>$lastFestDate</td>";
      print "<td>$teacherFirst $teacherLast</td>";
      print "<td>$teacherId</td>";
      print " <td><a href=\"javascript:dropStudent($studentId,'$firstName','$lastName')\">Remove</a></td>";
      print "</tr> \n";
      
   }
?>
   </table>
