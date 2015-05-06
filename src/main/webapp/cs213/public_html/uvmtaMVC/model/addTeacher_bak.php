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
   $uvmtaId = $_GET['uvmtaId'];
   $street = $_GET['street'];
   $city = $_GET['city'];
   $state = $_GET['state'];
   $zip = $_GET['zip'];
   $phone = $_GET['phone'];
   $email = $_GET['email'];
   $password = sha1($_GET['pwd']);
   $username = $_GET['username'];
   $membershipCurrent = $_GET['membershipCurrent'];
   $membershipFees = $_GET['membershipFees'];
   $regFees = $_GET['regFees'];
   $admin = $_GET['admin'];
   $earlyReg = $_GET['earlyReg'];

   require_once("dbConnect.php");
   
   $query = "insert into teacher (first, last, uvmtaId, street, city, state, zip, phone, email, pwd, username,
               membershipCurrent, membershipFees, regFees, admin, earlyReg)"
      . " values ('" . $firstName . "', '" . $lastName . "', '" . $uvmtaId . "', '" . $street . "', '"
      . $city . "', '" . $state . "', '" . $zip . "', '" . $phone . "', '" . $email . "', '" . $password . "', '"
      . $username . "', '" . $membershipCurrent . "', " . $membershipFees . ", " . $regFees . ", '" . $admin . "', '" .$earlyReg . "');";
//print $query;
   $data = mysql_query( $query ); 
   if ( !$data )
   {
      print "Teacher could not be added! Please check your syntax.";
      exit;
   }
      
   print "Teacher has been added!";   
?>
