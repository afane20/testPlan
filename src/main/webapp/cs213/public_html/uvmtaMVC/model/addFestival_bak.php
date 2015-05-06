<?php
   include 'loginValid.php';

   if ( !isset($_SESSION['teacherId'] ) )
   {
      print "Server Error: Please try again later";
      exit;
   }

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

   $query = "INSERT INTO festival (festivalName, festivalDate, alternateDate, regFee, regFeeAlt,
             regOpen, regOpenEarly, regEnds, currentFestival)"
             . " VALUES ('" . $festivalName . "','" . $festivalDate . "','" . $altFestDate . "'," . $regFee . "," .
             $regFeeAlt . ",'" . $regOpen ."','" . $regOpenEarly . "','" . $regEndDate . "','" . $currentFestival . "')" ;

   if (mysql_query($query))
   {
      print "$festivalName has been added!";   
   }
   else
   {
      print "Error - $festivalName cannot be added!";
   }

?>
