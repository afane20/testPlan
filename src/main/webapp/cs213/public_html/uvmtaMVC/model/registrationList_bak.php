<?php
   include 'loginValid.php';
   if ( !isset($_SESSION['teacherId'] ) )
   {
      print "Server Error: Please try again later";
      exit;

   }
   $teacherId = $_SESSION['teacherId'];

   require_once("dbConnect.php");

   $festivalId = $_GET['festivalId'];
   $sortBy = $_GET['sortBy'];

   $query = "SELECT student.first, student.last, " .
            "registration.timeslotId, registration.performanceDate, registration.registrationId, " .
            "registration.type, registration.level, registration.instrument, registration.teacherId, " .
            "registration.regFeePaid, registration.regFee, " .
            "timeslot.address,timeslot.room,timeslot.building,timeslot.festivalDay,timeslot.time " .
            "FROM registration, student, timeslot, festival WHERE student.teacherId = registration.teacherId " .
            "AND registration.timeslotId = timeslot.timeslotId " .
            "AND registration.festivalId = $festivalId " .
            "AND festival.currentFestival = \"Y\" " .
            "AND student.studentId = registration.studentId AND registration.teacherId=" . $teacherId .
            " ORDER BY " . $sortBy . ";";

   $data = mysql_query( $query );

   if ( !$data )
   {
      print "Invalid query string: ".mysql_error();
      exit;
   }
   
   $rowCount = mysql_num_rows( $data );

?>


<form id = "editRegForm">
    <div class="registerBox" style = "text-align: left" id="editRegBox">
    <h2>Modify Registration</h2> <br/>

    <label>Name: </label>
    <input type="text" id = "eName" disabled style = "display: inline"/>
    <input type="text" id = "eStudentId" name = "studentId" style = "display: none" />
    
    <label>Performance Type:</label>
    <select id = "ePerformanceType" name = "performanceType" disabled onchange = "setModifyVisibility();eAvailableSlots()">
      <option selected = "selected" value = "Solo">Solo</option>
      <option value = "Duet">Duet</option>
      <option value = "Concerto">Concerto</option>
    </select>

    <label id = "eStudentName2Label" style = "display: none" ><br/>Duet Partner:</label>

    <input type="text" id = "eName2" disabled style = " position: relative; left: 90px; display: none"  />
    <input type="text" id = "eStudentId2" style = "display: none"/>

    <br/>
    <label>Instrument:</label>
    <select id = "eInstrument" onchange = "eAvailableSlots()">
      <option selected = "selected" value = "Piano">Piano</option>
      <option value = "Voice">Voice</option>
      <option value = "String">String</option>
      <option value = "Organ">Organ </option>
      <option value = "Other">Other</option>
    </select>
    <br/>
    <label>Proficiency Level:</label>
    <select id = "eLevel" onchange = "eAvailableSlots()">
      <option value = "1" selected = "selected" >beginner</option>
      <option value = "2">intermediate</option>
      <option value = "4">pre-advanced</option>
      <option value = "8">advanced</option>
      <option value = "4">Jr</option>
      <!-- use 16 if must be different than pre-advanced -->
      <option value = "8">Sr</option>
      <!-- use 32 if must be different than advanced -->
    </select>
    <br/>
    <label>Performance Day:</label>
    <select id = "eFestivalDay"  onchange = "eAvailableSlots()">
      <option value = "1" selected = "selected">Festival Day</option>
      <option value = "2">Alternate Day</option>
    </select>
    <br/>
    <br/>
    <div>  
      <label>Timeslot sort order</label> <label>Performance Times</label>
    
      <select id = "eSlotSortOrder"  onchange = "eAvailableSlots()">
        <option value = "T">Sort by Time</option>
        <option value = "R">Sort by Room</option>
      </select>
      
      <!-- keep the previous timeslot ID so it can be released -->
      <input type="text" id = "ePrevTimeSlotId" style = "display: none" />
      <input type="text" id = "eRegistrationId" style = "display: none" />
      <input type="text" id = "eRegistrationId2" style = "display: none" />

      <!-- times loaded here from ajax request -->
      <span id="eAvailableSlots" style = "position: relative; top: -10px; left: 60px">
      </span>
    </div>

    <br/>
    <br/>
    <p>
      <input type="button" id = "registerStudent"  value="Update"
        onclick="validateUpdateRegister()" />
    </p>
   <p>
     <button id = "unregisterStudent" 
        onclick="dropRegistration()">Delete Registration</button>
   </p>
    <img src="../close.png" alt = "cancel" onclick="exitEditReg();"/>
  </div>

</form>

<br/>
<table class="tableData">
   <thead>
    <tr>
      <th onclick="registrationList('first')">First Name</th>
      <th onclick="registrationList('last')">Last Name</th>
      <th onclick="registrationList('performanceDate,time')">Time</th>
      <th onclick="registrationList('room')">Room</th>
      <th onclick="registrationList('building')">Location</th>
      <th onclick="registrationList('address')">Address</th>
      <th onclick="registrationList('performanceDate,time')">Date</th>
      <th onclick="registrationList('type')">Type</th>
      <th onclick="registrationList('Level')">Level</th>
      <th onclick="registrationList('Instrument')">Instrument</th>
      <th onclick="registrationList('regFee')">Reg. Fee</th>
      <th onclick="registrationList('regFeePaid')">Paid </th>
   </tr>
 </thead>
 <tbody id="tableBody">
<?php
   $totalFees = 0;
   $odd = 1;
   for($row = 0; $row < $rowCount; $row++)
   {
      $currentRow = mysql_fetch_array( $data );
      $registrationId = $currentRow['registrationId'];
      $timeslotId = $currentRow['timeslotId'];
      $festivalDay = $currentRow['festivalDay'];
      print "<tr" . ($odd++ %2 == 0 ? " class='altRow'" : "") . " onclick = \"modifyRegistration($registrationId,$timeslotId,$festivalDay)\" >";

      print "<td>".$currentRow['first']."</td>";
      print "<td>".$currentRow['last']."</td>";

      $time24 = $currentRow['time'];    // get 24 hr time
      $timeStamp = strToTime($time24);  // convert to timestamp
      $timeAmPm = date('h:i a',$timeStamp); // convert to am pm
      print "<td>$timeAmPm</td>";
      print "<td>".$currentRow['room']."</td>";
      print "<td>".$currentRow['building']."</td>";
      print "<td>".$currentRow['address']."</td>";
      print "<td>".$currentRow['performanceDate']."</td>";
      print "<td>".$currentRow['type']."</td>";   
      switch($currentRow['level'])
      {
         case '1':
            $level = "beginner";
            break;
         case '2':
            $level = "intermediate";
            break;
         case '4':
            $level = "pre-advanced";
            break;
         case '8':
            $level = "advanced";
            break;
         case '16':
            $level = "Jr";
            break;
         case '32':
            $level = "Sr";
            break;
      }
      print "<td>$level</td>";
      print "<td>".$currentRow['instrument']."</td>";
      $fee = $currentRow['regFee'];
      print "<td>$fee</td>";
      $regFeePaid = $currentRow['regFeePaid'];
      print "<td>$regFeePaid</td>";
      if ($regFeePaid == 'N')
      {
        $totalFees = $totalFees + $fee;
      }

      print "</tr>";
      
   }
   print  "</tbody></table>";
   print "<br/><span class = \"center regFee\" >Registration Fees: $ <span style = \"color: red\">$totalFees</span></span><br/>";
?>
