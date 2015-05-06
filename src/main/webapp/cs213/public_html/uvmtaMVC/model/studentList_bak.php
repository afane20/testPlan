<?php
   include 'loginValid.php';
   if ( !isset($_GET['teacherId'] ) )
   {
      print "Server Error: Please try again later";
      //   exit;

   }

   $teacherId = $_GET['teacherId'];

   require_once("dbConnect.php");

   $query = "SELECT * FROM student WHERE teacherId = " . $teacherId .
          " ORDER BY " . $_GET['sortBy'];

   $data = mysql_query( $query );
   
   if ( !$data )
   {
      print "Invalid query string: ".mysql_error();
      exit;
   }
   
   $rowCount = mysql_num_rows( $data );
   $currentRow;


?>
<div class="editBox" id="editBox">
<h2> Edit This Student </h2> <br/>
      <label>First Name:</label>
      <input type="text" text=""/>
      <br/>
      <label>Last Name:</label>
      <input type="text" text=""/>
      <br/>
      <label>Festivals:</label>
      <span>.</span>
      <br/>
      <label>Points:</label>
      <span>.</span>
      <br/>
      <label>Last Festival:</label>
      <span>.</span>
      <br/>
   <button onclick="saveEdit();">Save</button>
   <img src="close.png" onclick="exitEdit();"/>
</div>

 <table class = "center, tableData"border="1">
   <thead>
      <tr>
         <th><input class = "button" type = "button" onclick="studentList('first')" value = "First Name"/></th>
         <th><input class = "button" type = "button" onclick="studentList('last')" value = "Last Name"/></th>
         <th><input class = "button" type = "button" onclick="studentList('festivals')" value = "Festivals"/></th>
         <th><input class = "button" type = "button" onclick="studentList('points')" value = "Points"/></th>
         <th><input class = "button" type = "button" onclick="studentList('lastFestDate')" value = "Last Festival"/></th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody>     
<?php
   $odd = 1;
   for($row = 0; $row < $rowCount; $row++)
   {
      $currentRow = mysql_fetch_array( $data );
      $studentId = $currentRow['studentId'];
      $firstName = $currentRow['first'];
      $lastName = $currentRow['last'];
      $festivals = $currentRow['festivals'];
      $points = $currentRow['points'];
      $lastFestDate = $currentRow['lastFestDate'];
      print "<tr" . ($odd++ % 2 == 0 ? " class='altRow'":"") . ">";
      print "<td>$firstName</td>";
      print "<td>$lastName</td>";
      print "<td>$festivals</td>";
      print "<td>$points</td>";
      print "<td>$lastFestDate</td>";
      print " <td><a href=\"javascript:removeStudent($studentId,'$firstName','$lastName',$points)\">Remove</a></td>";
      print "</tr>";

      
   }
?>
      </tbody>
   </table>
