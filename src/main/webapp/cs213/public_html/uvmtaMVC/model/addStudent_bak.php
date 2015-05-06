<?php
   include 'loginValid.php';

   if ( !isset($_GET['teacherId'] ) )
   {
      print "Server Error: Please try again later";
      exit;

   }

   $teacherId = $_GET['teacherId'];
   $firstName = $_GET['firstName'];
   $lastName = $_GET['lastName'];
   $points = $_GET['points'];
   $festivals = 0;
   require_once("dbConnect.php");

  //see if the student is already in the system with a teacher of "unknown"
   $query = "SELECT * FROM student WHERE teacherId=1  AND last = '$lastName' AND first = '$firstName' ";
   $data = mysql_query( $query);
   if ( !$data )
   {
      print "Invalid query string: ".mysql_error();
      exit;
   }
   
   $rowCount = mysql_num_rows( $data );
   $currentRow;

   if ($rowCount > 0)
   {
?>
     <select id="studentChoice"  onclick = "selectStudent()" /> 
<?php
      for($row = 0; $row < $rowCount; $row++)
      {
         $currentRow = mysql_fetch_array( $data );
         print "<option value=\"".$currentRow['studentId']."\">".
            $currentRow['first']." , ".$currentRow['last']. ", festivals = " . $currentRow['festivals'] .
            "</option> \n";     
      }
 ?>
     </select>
<?php
exit;
}
?>
   
   
<?php   
   
   $query = "INSERT INTO student (first, last, teacherId, festivals, points, lastFestDate, registered)"
      . " values ('" . $firstName . "', '" . $lastName . "', " . $teacherId . "," . $festivals . "," . $points . ",' ' , 0)" ;

   if (mysql_query($query))
   {
      print "$firstName $lastName has been added!";   
   }
   else
   {
      print "Error - $firstName $lastName cannot be added! The teacher ID # '$teacherId' does not exist.";
   }

?>
