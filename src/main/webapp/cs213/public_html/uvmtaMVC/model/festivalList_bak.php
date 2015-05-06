<?php
   include 'loginValid.php';
   if ( !isset($_GET['teacherId'] ) )
   {
      print "Server Error: Please try again later";
      exit;
   }

   require_once("dbConnect.php");

   $query = "SELECT * FROM festival ORDER BY " . $_GET['sortBy'];

   $data = mysql_query( $query );
   
   if ( !$data )
   {
      print "Invalid query string: ".mysql_error();
      exit;
   }
   
   $rowCount = mysql_num_rows( $data );
   
?>
   
 <!--   <table class = "center "border="1">
   <tr class = "bgcolored">
      <td colspan = "1">Action</td>
      <td>Active Festival</td>
      <td>Festival Name</td>
      <td>Festival Date</td>
      <td>Alternate Date</td>
      <td>Reg. Fee</td>
      <td>Alt. Fee</td>
      <td>Registration Open</td>
      <td>Early Reg. Open</td>
      <td>Registration Ends</td>
      <td colspan = "3">Action</td>
   </tr>
   </table>      -->
<?php
   
   for($row = 0; $row < $rowCount; $row++)
   {
      $currentRow = mysql_fetch_array( $data );
      $festivalId = $currentRow['festivalId'];
      $currentFestival = $currentRow['currentFestival'];
      $festivalName = $currentRow['festivalName'];
      $festivalDate = $currentRow['festivalDate'];
      $alternateDate = $currentRow['alternateDate'];
      $regFee = $currentRow['regFee'];
      $regFeeAlt = $currentRow['regFeeAlt'];
      $regFee = sprintf("%.2f",$regFee);
      $regFeeAlt = sprintf("%.2f",$regFeeAlt);
      $regOpen = $currentRow['regOpen'];
      $regOpenEarly = $currentRow['regOpenEarly'];
      $regEndDate = $currentRow['regEnds'];

      print "<div class='tile'>";
      if ($currentFestival == "Y")
      {
         print "<span style = 'background-color: lightskyblue;'>&nbsp;Active Festival&nbsp;</span>";
      }
      else
      {
         print "  <a></a>";
      }
 
      print "  <header>";
      print "     <h2>" . $festivalName . "</h2><hr/>";
      print "     Festival Date: " . $festivalDate;
      print "     <br/>Alternate Date: " . $alternateDate;
      print "  </header>";
      print "  <section>";
      print "     <label>Fee:</label> \$" . $regFee;
      print "  </section>";
      print "  <section>";
      print "     <label>Alternate Fee:</label> \$" . $regFeeAlt;
      print "  </section>";
      print "  <footer>";
      print "     <p>";
      print "        Registration is " . ($regOpen == "Y" ? "open" : "closed") . "<br/>";
      print "        Early Registration is " . ($regOpenEarly == "Y" ? "open" : "closed");
      if ($regOpen == "Y")
      { 
         print "     <br/>Registration ends on " . $regEndDate; 
      }
      print "  </footer>";
      
      if ($currentFestival == "N" && $regOpen == "N" && $regOpenEarly == "N")
      {
          print " <button onclick=\"generateTimeSlots('room','all',$festivalId, '$festivalDate','$alternateDate')\">Build All Timeslots</button>";
          print " <button onclick=\"dropTimeSlots($festivalId)\" style = \"position:relative; left: 50px;\" >Remove All Timeslots</button>";
      }
      print "<button onclick = \"dropFestival($festivalId,'$festivalName','$currentFestival')\">Delete Festival</button>";
      print "<button  style = \"position:relative; left: 50px;\"
                onclick = \"$('#modifyBox').show(); modifyFestival($festivalId,'$festivalName','$festivalDate','$alternateDate',
                    $regFee,$regFeeAlt,'$regOpen','$regOpenEarly','$regEndDate', '$currentFestival')\">Modify Festival</button>";
      print "</div>";
   }
?>