<?php
   include 'loginValid.php';

   if ( !isset($_SESSION['teacherId'] ) )
   {
      print "Server Error: Please try again later";
      exit;
   }

   $teacherId = $_GET['teacherId'];
   $currentPassword = sha1($_GET['pwd']);
   $newPassword = sha1($_GET['newpwd']);
   
   require_once("dbConnect.php");

   $query = "UPDATE teacher SET pwd='$newPassword'
             WHERE teacherId = '$teacherId' && pwd = '$currentPassword'";
if (mysql_query($query) && mysql_affected_rows() > 0 )
   {
      print "Password has been changed!";   
   }
   else
   {
      print "Error - Invalid original password!  Password was not changed!";
   }
?>
