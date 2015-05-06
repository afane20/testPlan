<?php
   include 'loginValid.php';
   if (!isset($_Get['teacherId']))
   {
      //print "Server Error - Couldn't get Teacher";
      //exit;
   }

   require_once("dbConnect.php");

   $teacherId = $_GET['teacherId'];

   # get the unpaid registration records for this teacher
   $query = "SELECT regFee FROM registration WHERE teacherId =" . $teacherId . " AND regFeePaid = \"N\"";
   $data = mysql_query( $query );
   if ( !$data )
   {
       print "Invalid query string: ".mysql_error();
       exit;
   }

   $rowCount = mysql_num_rows( $data ); 
   $totalRegFees = 0;
   for($row = 0; $row < $rowCount; $row++)
   {
      $currentRow = mysql_fetch_array( $data );
      $totalRegFees = $totalRegFees + $currentRow['regFee'];
   }


   $query = "SELECT * FROM teacher where teacherId=" . $teacherId;
   $data = mysql_query( $query );
      
   if ( !$data )
   {
      print "Teacher not found - ".mysql_error();
      exit;
   }
   
   $rowCount = mysql_num_rows( $data );

   $currentRow = mysql_fetch_array( $data );
   $firstName = $currentRow['first'];
   $lastName = $currentRow['last'];
   $uvmtaId = $currentRow['uvmtaId'];
   $street = $currentRow['street'];
   $city = $currentRow['city'];
   $state = $currentRow['state'];
   $zip = $currentRow['zip'];
   $phone = $currentRow['phone'];
   $email = $currentRow['email'];
   $pwd = $currentRow['pwd'];
   $username = $currentRow['username'];
   $membershipCurrent = $currentRow['membershipCurrent'];
   $membershipFees = $currentRow['membershipFees'];
   # $regFees = $currentRow['regFees'];
   $regFees = $totalRegFees;  # computed from the registration records
   $admin = $currentRow['admin'];
   $earlyReg = $currentRow['earlyReg'];

   print "$firstName,$lastName,$uvmtaId,$street,$city,$state,$zip,$phone,$email,$pwd,$username,";
   print "$membershipCurrent,$membershipFees,$regFees,$admin,$earlyReg,";
?>

