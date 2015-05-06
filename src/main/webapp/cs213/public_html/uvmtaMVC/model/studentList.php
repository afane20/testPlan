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

<div class="editBox draggable" id="editBox">
  <h2> Edit This Student </h2><br/>
  <label>First Name:</label>
  <input id = "eFirstName" type="text" text=""/>
  <label>Last Name:</label>
  <input id = "eLastName" type="text" text=""/>
  <label>Instrument:</label>
  <select id = "eInstrument" name = "instrument" >
     <option selected = "selected" value = "Piano">Piano</option>
     <option value = "Voice">Voice</option>
     <option value = "String">String</option>
     <option value = "Organ">Organ</option>
     <option value = "Other">Other</option>
  </select>
  <label>H.S. Grad Year: </label>       
  <input id ="eGradYear" type="text"  text=""/>

  <label>Last Festival:</label>
  <input id = "eLastFestDate" type = "text"  text="" />
  <!-- Festivals, Points, Last Festival, should be "disabled" after 1st
   Festival so teacher can no longer modify these fields -->
  <label>Festivals:</label>
  <input id ="eFestivals" type = "text"  text="" />
  <!--
  <br/>
  <label>Points:</label> 
  -->
  <input id = "ePoints" style = "display: none" type = "text" value = "0"/>     
  <input id = "eStudentId" type="text" text="" style = "display:none"/>
  <button id="delete" onclick="removeStudent()">Delete</button>
  <button id="update" onclick="saveEdit();">Update</button>
  <img src="close.png" onclick="exitEdit();"/>
</div>
<!--<header class="dataHeader">
  <ul>
    <li onclick="studentList('first')">First Name</li>
    <li onclick="studentList('last')">Last Name</li>
    <li onclick="studentList('instrument')">Instrument</li>
    <li onclick="studentList('festivals')">Festivals</li>
    <li onclick="studentList('points')">Points</li>
    <li onclick="studentList('lastFestDate')">Last Fest</li>
    <li onclick="studentList('gradYear')">Grad. Year</li>
  </ul>
</header>-->
<table class = "tableData">
  <thead>      
    <tr class="dataHeader">
      <th onclick="studentList('first')">First Name</th>
      <th onclick="studentList('last')">Last Name</th>
      <th onclick="studentList('instrument')">Instrument</th>
      <th onclick="studentList('festivals')">Festivals</th>
      <th onclick="studentList('points')">Points</th>
      <th onclick="studentList('lastFestDate')">Last Festival</th>
      <th onclick="studentList('gradYear')">Grad. Year</th>
    </tr>
  </thead>
  <tbody id="tableBody">
  <?php
   $odd = 1;
   for($row = 0; $row < $rowCount; $row++)
   {
      $currentRow = mysql_fetch_array( $data );
      $studentId = $currentRow['studentId'];
      $firstName = $currentRow['first'];
      $lastName = $currentRow['last'];
      $instrument = $currentRow['instrument'];
      $festivals = $currentRow['festivals'];
      $points = $currentRow['points'];
      $lastFestDate = $currentRow['lastFestDate'];
      $gradYear = $currentRow['gradYear'];
      print "<tr" . ($odd++ % 2 == 0 ? " class='altRow'":"") . " >";
      print "<td style = 'display:none'>$studentId</td>";
      print "<td>$firstName</td>";
      print "<td>$lastName</td>";
      print "<td>$instrument</td>";
      print "<td>$festivals</td>";
      print "<td>$points</td>";
      print "<td>$lastFestDate</td>";
      print "<td>$gradYear</td>";
      print "</tr>";      
   }
  ?>
  </tbody>
</table>

