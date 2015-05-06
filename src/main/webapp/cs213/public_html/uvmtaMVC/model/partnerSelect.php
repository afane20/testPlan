<?php
   include 'loginValid.php';

   if ( !isset($_SESSION['teacherId'] ) )
   {
      print "Server Error: Please try again later";
      exit;

   }

   $teacherId = $_SESSION['teacherId'];

   require_once("dbConnect.php");

   $query = "SELECT * FROM student where teacherId=" . $teacherId . " ORDER BY last;";
            
   $data = mysql_query( $query );
   
   if ( !$data )
   {
      print "Invalid query string: ".mysql_error();
      exit;
   }
   
   $rowCount = mysql_num_rows( $data );
   $currentRow;
   print "<select id = 'partnerChoice' size = '1' onclick = 'selectPartner()'/>";
   print "<option></option>";
   for($row = 0; $row < $rowCount; $row++)
   {
      $currentRow = mysql_fetch_array( $data );
      print "<option value=\"".$currentRow['studentId']."\">".
            $currentRow['first']. " , " . $currentRow['last'] . "</option> \n";
   }
   print "</select>";
?>