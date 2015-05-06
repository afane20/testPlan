<?php
   include 'loginValid.php';
   session_start();

   if ( !isset($_SESSION['teacherId'] ) )
   {
      print "Server Error: Please try again later";
      exit;
   }

   $teacherId = $_SESSION['teacherId'];

   require_once("dbConnect.php");
   
   $query = "SELECT earlyReg FROM teacher WHERE teacherId = $teacherId";
   $data = mysql_query( $query );

   $teacherEarlyReg = 'N';
   if ($data)
   {
      $currentRow = mysql_fetch_array($data);
      $teacherEarlyReg = $currentRow['earlyReg'];
   }

   $query = "SELECT festivalId, festivalName, festivalDate, alternateDate, regFee, regFeeAlt, regOpen," .
             "regOpenEarly, regEnds, currentFestival FROM festival WHERE currentFestival = 'Y'";
   $data = mysql_query( $query );

   
   if ( !$data )
   {
      print "Closed - No Festival currently defined in festival database!";
      //  print mysql_error();
      exit;
   }
   $rowCount = mysql_num_rows( $data );

   if ($rowCount > 0)
   {  
      $currentRow = mysql_fetch_array($data);
      $festivalId = $currentRow['festivalId'];
      $festivalName = $currentRow['festivalName'];
      $festivalDate = $currentRow['festivalDate'];
      $alternateDate = $currentRow['alternateDate'];
      $regFee = $currentRow['regFee'];
      $regFeeAlt = $currentRow['regFeeAlt'];
      $regOpen = $currentRow['regOpen'];
      $regOpenEarly = $currentRow['regOpenEarly'];
      $regEnds = $currentRow['regEnds'];
      $currentFestival = $currentRow['currentFestival'];

      if ($regOpen == 'Y' || $regOpenEarly == 'Y' && $teacherEarlyReg == 'Y')
      {
         $todays_date = date("Y-m-d");      // get todays date
         $today = strtotime($todays_date);  // convert to a timestamp
         $endDate = strToTime($regEnds);    // convert end registration date to time stamp

         if ($endDate >= $today)           // see if past ending registration date
         {
            print "Open";
         }
         else
         {
            print "Closed";
         }         
      }
      else
      {
         print "Closed";
      }
   }
   else
   {
      print "Closed";  
   }  
   print ",$festivalId,$festivalName,$festivalDate,$alternateDate,$regFee,";
   print "$regFeeAlt,$regOpen,$regOpenEarly,$regEnds,$currentFestival";

?>
