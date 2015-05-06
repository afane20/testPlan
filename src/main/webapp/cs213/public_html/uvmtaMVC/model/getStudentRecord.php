<?php
   include 'loginValid.php';
   if (!isset($_Get['studentId']))
   {
      //print "Server Error - Couldn't get Student";
      //exit;
   }

   require_once("dbConnect.php");

   $studentId = $_GET['studentId'];  
   $query = "SELECT first,last,teacherId,festivals,
             points,lastFestDate FROM student WHERE studentId=".$studentId;
   $data = mysql_query( $query );
      
   if ( !$data )
   {
      print "Student not found - ".mysql_error();
      exit;
   }
   
   $rowCount = mysql_num_rows( $data );

   $currentRow = mysql_fetch_array( $data );
   $firstName = $currentRow['first'];
   $lastName = $currentRow['last'];
   $festivals = $currentRow['festivals'];
   $points = $currentRow['points'];
   $lastFestDate = $currentRow['lastFestDate'];
   $teacherId = $currentRow['teacherId'];

   print "$firstName,$lastName,$festivals,$points,$lastFestDate,$teacherId";
?>

