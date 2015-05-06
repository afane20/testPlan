<?php
   include 'loginValid.php';

   if ( !isset($_SESSION['teacherId'] ) )
   {
      print "Server Error: Please try again later";
      exit;

   }

 
   require_once("dbConnect.php");

   $query = "SELECT festivalId, festivalName, currentFestival FROM festival";
            
   $data = mysql_query( $query );
   
   if ( !$data )
   {
      print "Invalid query string: ".mysql_error();
      exit;
   }
   
   $rowCount = mysql_num_rows( $data ); 
   if ($rowCount == 1)
   {
      $currentRow = mysql_fetch_array( $data );
      $festivalId = $currentRow['festivalId'];
      print "<button id = 'buildSlotsButton' class = 'center' type='button'
             onclick = 'checkGenerateTimeSlots($festivalId)' style = 'display:inline'>Build Resource Timeslots</button>";
   }
   else
   {
      $currentRow;
      //     print "<button id = 'buildSlotsButton' class = 'center' type='button'
      //        onclick = '' style = 'display:inline'>Build Resource Timeslots</button>";
      print "<label>Build Resource Timeslots</label>";
      print "<select id = 'festivalChoice' size = '1' onchange = 'selectFestival()'/>";
      print "<option>Select a Festival</option>";

      for($row = 0; $row < $rowCount; $row++)
      {
         $currentRow = mysql_fetch_array( $data );
         $active = $currentRow['currentFestival'];
         if ($active == "Y")
            $active = " - Active";
         else
            $active = "";
         print "<option value=\"".$currentRow['festivalId']."\">" .
         $currentRow['festivalName'] . $active . "</option> \n";
      }
      print "</select>";
   }
?>