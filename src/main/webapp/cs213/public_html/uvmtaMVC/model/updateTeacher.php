<?php
   include 'loginValid.php';

   if ( !isset($_GET['teacherId'] ) )
   {
      print "Server Error: Please try again later";
      exit;
   }

   require_once("dbConnect.php");

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
   $username = $_GET['username'];
   $membershipCurrent = $_GET['membershipCurrent'];
   $membershipFees = $_GET['membershipFees'];
   $admin = $_GET['admin'];
   $earlyReg = $_GET['earlyReg'];
   $regFees = $_GET['regFees'];
   // if regFees has been set to zero than all the registration records for this teacher will be marked as paid.
   if ($regFees == 0)
   {
      # get the unpaid registration records for this teacher
      $query = "UPDATE registration SET regFeePaid = 'Y' WHERE teacherId = $teacherId";
      $data = mysql_query( $query );
   }

   $pwd = $_GET['pwd'];
   $pwdLength = strlen($pwd);
   // don't change the password unless data has been entered into the password field and the password is greater equal to two characters
   if ($pwd !== "" && $pwdLength >= 2)
   {
      $pwd = sha1($pwd);
      $query = "UPDATE teacher SET first='$firstName',last='$lastName',uvmtaId='$uvmtaId',street='$street',
            city='$city',state='$state',zip='$zip',phone='$phone',email='$email',
            pwd='$pwd',username='$username',membershipCurrent='$membershipCurrent',
            membershipFees=$membershipFees,regFees=$regFees,admin='$admin',earlyReg='$earlyReg'" .
            " WHERE teacherId=$teacherId;";
   }
   else
   {
     // don't change or update the password
     $query = "UPDATE teacher SET first='$firstName',last='$lastName',uvmtaId='$uvmtaId',street='$street',
            city='$city',state='$state',zip='$zip',phone='$phone',email='$email',
            username='$username',membershipCurrent='$membershipCurrent',
            membershipFees=$membershipFees,regFees=$regFees,admin='$admin',earlyReg='$earlyReg'" .
            " WHERE teacherId=$teacherId;";
   }

   $data = mysql_query( $query );
   
   if ( !$data )
   {

      print "Teacher didn't update! <br /> "; 
      print " Invalid query - $query";
      exit;
   }
   
   print "Teacher Update Successful!";
?>
