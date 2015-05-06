<?php
   include 'loginValid.php';

   if ( !isset($_SESSION['teacherId'] ) )
   {
      print "Server Error: Please try again later";
      exit;
   }

   $festivalId = $_GET['festivalId'];
   $festivalName = $_GET['festivalName'];
   $festivalDate = $_GET['festivalDate'];
   $altFestDate = $_GET['altFestDate'];
   $regFee = $_GET['regFee'];
   $regFeeAlt = $_GET['regFeeAlt'];
   $regOpen = $_GET['regOpen'];
   $regOpenEarly = $_GET['regOpenEarly'];
   $regEndDate = $_GET['regEndDate'];
   $currentFestival = $_GET['currentFestival'];

   require_once("dbConnect.php");

   $query = "UPDATE festival SET festivalName='$festivalName',festivalDate='$festivalDate',
                  alternateDate='$altFestDate',regFee=$regFee,regFeeAlt=$regFeeAlt," .
                  "regOpen='$regOpen',regOpenEarly='$regOpenEarly',regEnds='$regEndDate'," .
                  "currentFestival='$currentFestival'" . 
                  " WHERE festivalId=$festivalId";

   if (mysql_query($query))
   {
      print "$festivalName has been changed!";   
   }
   else
   {
      print "Error - $festivalName cannot be modified!";
   }

?>
