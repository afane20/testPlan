<?php
   include 'loginValid.php';

   if ( !isset($_SESSION['teacherId'] ) )
   {
      print "Server Error: Please try again later";
      exit;
   }

   $festivalId = $_GET['festivalId'];
   $festivalName = $_GET['festivalName'];

   require_once("dbConnect.php");
   
   $query = "DELETE FROM festival WHERE festivalId=" . $festivalId . " AND currentFestival = 'N'";
   mysql_query($query);
   $rowsChanged = mysql_affected_rows();
   if ($rowsChanged != 0)
   {
      print "$festivalName has been deleted!";
   }
   else
   {
      print "Error Deleting $festivalName  - Your cannot delete the ACTIVE festival!";
   }

?>
