<?php
   include 'loginValid.php';


   require_once("dbConnect.php");
   $registrationId = $_GET['registrationId'];
   $timeslotId = $_GET['timeslotId'];
   $festivalDay = $_GET['festivalDay'];
 
   $query = "SELECT * FROM registration where timeslotId=" . $timeslotId;
   $data = mysql_query( $query );
      
   if ( !$data )
   {
      print "Registration record not found - ".mysql_error();
      exit;
   }
   
   $rowCount = mysql_num_rows( $data );

   $currentRow = mysql_fetch_array( $data );
   $registrationId = $currentRow['registrationId'];
   $performanceDate = $currentRow['performanceDate'];
   $timeslotId = $currentRow['timeslotId'];
   $performanceType = $currentRow['type'];
   $studentId = $currentRow['studentId'];
   $teacherId = $currentRow['teacherId'];
   $level = $currentRow['level'];
   $instrument = $currentRow['instrument'];
   $festivalId = $currentRow['festivalId'];
   $regFeePaid = $currentRow['regFeePaid'];
   $regFee = $currentRow['regFee'];
   $query = "SELECT first,last FROM student where studentId=" . $studentId;
   $data1 = mysql_query( $query ); 
   if ( !$data1 )
   {
       print "Registration record not found - ".mysql_error();
       exit;
   }
   $student = mysql_fetch_array( $data1 );
   $firstName = $student['first'];
   $lastName = $student['last'];
   $fullName = $firstName . " " . $lastName;
   $studentId2="";
   $firstName2 = "";
   $lastName2 = "";
   // If more that one it's a duet partner
   if ($rowCount > 1)
   {
      $currentRow = mysql_fetch_array( $data );
      $registrationId2 = $currentRow['registrationId'];
      $type = $currentRow['type'];
      $studentId2 = $currentRow['studentId'];

      $query = "SELECT first,last FROM student where studentId=" . $studentId2;
      $data1 = mysql_query( $query ); 
      if ( !$data1 )
      {
          print "Registration record not found - ".mysql_error();
          exit;
      }
      $student = mysql_fetch_array( $data1 );
      $firstName2 = $student['first'];
      $lastName2 = $student['last'];
      $fullName2 = $firstName2 . " " . $lastName2;
   }
   
   print "$fullName,$fullName2,$studentId,$studentId2,$instrument,$performanceType," . 
         "$level,$festivalDay,$timeslotId,$registrationId,$registrationId2";
?>
  