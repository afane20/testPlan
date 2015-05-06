<h2>Manage Students</h2>
<p style="font-style: italic;margin: -.5em 0 .5em 0;">(click a student to select)</p>
<?php
   function queryError ($query, $data, $message)
   {
      if (!$data)
      {
         print "<p><b> $message </b><p>";
         print "<pre> $query </pre>";
         print "<p>" . mysql_error() . "</p>";
      }
   }

   ($db = mysql_connect("jordan","ercanbracks","scotte")) or die("ERROR: Database connection failed!");
   mysql_select_db("treborus") or die("ERROR: Database selection failed!");
   $teacherId = $_REQUEST['teacherId'];
   $type = $_REQUEST['type'];
   if ($type == "add")
   {
      $firstName = $_REQUEST["firstName"];
      $lastName = $_REQUEST["lastName"];
      $instrument = $_REQUEST["instrument"];
      $level = $_REQUEST["level"];
      
      $query = "INSERT INTO FStudents (firstName, lastName, instrument, level)"
             . " VALUES ('$firstName', '$lastName', '$instrument', '$level');";
      $data = mysql_query($query);
      queryError($query, $data, "add student failed.");
      
      $query = "SELECT studentId FROM FStudents"
             . " WHERE firstName='$firstName' AND lastName='$lastName'"
             . " ORDER BY studentId DESC;";
      $data = mysql_query($query);
      queryError($query, $data,  "add student: get studentId failed");

      $array = mysql_fetch_array($data);
      $studentId = $array['studentId'];
      
      $query = "INSERT INTO FStudentTeacher (studentId, teacherId)
                VALUES ($studentId, $teacherId);";
      $data = mysql_query($query);
      queryError($query, $data,  "assign student to teacher failed");
   }
   else if ($type == "mod")
   {
      $studentId = $_REQUEST['studentId'];
      $firstName = $_REQUEST["firstName"];
      $lastName = $_REQUEST["lastName"];
      $instrument = $_REQUEST["instrument"];
      $level = $_REQUEST["level"];
      
      $query = "UPDATE FStudents 
                SET firstName = '$firstName', lastName = '$lastName',
                    instrument= '$instrument', level = '$level'
                WHERE studentId = $studentId;";
      $data = mysql_query($query);
      queryError($query, $data,  "Save student failed.");
   }
   else if ($type == "reg")
   {
     
      $studentId = $_REQUEST["studentId"];
      $slotId = $_REQUEST["slotId"];
     
      $query = "SELECT firstName, lastName, slotId
                FROM FStudents WHERE studentId = $studentId;";
      $data = mysql_query($query);
      queryError($query, $data, "student reg. select failed");
      $array = mysql_fetch_array($data);
      $firstName = $array['firstName'];
      $lastName = $array['lastName'];
      if ($array['slotId'])
      {
          print "<p style='font-weight: bold; color: red;'>"
          . "$firstName $lastName is already scheduled for a time. "
          . "Unschedule him/her first to switch times </p>";
      }
      else
      {
         $query = "UPDATE FStudents SET slotId = $slotId
                   WHERE studentId = $studentId;";
         $data = mysql_query($query);
         queryError($query, $data, "reg. student UPDATE failed.");

         $query = "UPDATE FTimeSlots SET studentId1 = $studentId
                   WHERE slotId = $slotId;";
         $data = mysql_query($query);
         queryError($query, $data, "reg. time slot UPDATE failed.");
      }
   }
   else if (($type == "unreg") || ($type == "rm"))
   {
      $studentId = $_REQUEST["studentId"];
      $query = "SELECT firstName, lastName, slotId
                FROM FStudents WHERE studentId = $studentId;";
      $data = mysql_query($query);
      queryError($query, $data, "student unreg. select failed");
      $array = mysql_fetch_array($data);
      $firstName = $array['firstName'];
      $lastName = $array['lastName'];
      $slotId = $array['slotId'];
      if ($slotId)
      {
         $query = "UPDATE FStudents SET slotId = NULL
                   WHERE studentId = $studentId;";
         $data = mysql_query($query);
         queryError($query, $data, "unreg. student UPDATE failed.");

         $query = "UPDATE FTimeSlots SET studentId1 = NULL
                   WHERE slotId = $slotId;";
         $data = mysql_query($query);
         queryError($query, $data, "unreg. time slot UPDATE failed.");
      }
   
      if ($type == "rm")
      {
         mysql_query("DELETE FROM FStudents WHERE studentId = $studentId") or die("remove failed");
      }
   }
   
?>


<?php
   // join data from FStudentTeacher, FStudents, FTimeSlots, and FResources tables
   // to get student data for the current teacher and the student' timeslot info
   $query = "SELECT s.studentId, s.firstName, s.lastName, s.instrument, s.level,
                    r.bldg, r.room, TIME_FORMAT(ts.apptTime, '%h:%i %p') AS apptTime
             FROM FStudentTeacher x, FStudents s 
             LEFT JOIN FTimeSlots ts ON s.slotId=ts.slotId 
             LEFT JOIN FResources r ON ts.resourceId=r.resourceId 
             WHERE x.teacherId = $teacherId AND x.studentId = s.studentId 
             ORDER BY s.firstName, s.lastName;";

   $data =  mysql_query($query);
   queryError($query, $data, "student query failed");

?>
<form id="studentsForm" onreset="select(sId);">
<table id="students">
   <tr>
      <th colspan="2">Student Name</th>
      <th>Instrument</th>
      <th>Level</th>
      <th>Time Slot</th>
      <th></th>
   </tr>
   <tr>
      <td>
         <input id="firstName" type="text" size="8" />
      </td>
      <td>
         <input id="lastName" type="text" size="12" />
      </td>
      <td>
         <input type="text" id="instrument" size="10" />
      </td>
      <td>
         <select id="levels">
            <option value="beginner">Beginner</option>
            <option value="intermediate">Intermediate</option>
            <option value="pre-advanced">Pre-Advanced</option>
            <option value="advanced">Advanced</option>
         </select>
      </td><td></td>
      <td>
         <input id="add" type="button" value="add" onclick="addEntry();" />
         <input id="save" type="button" value="save" onclick="saveData();" disabled="disabled" />
         <input id="resetForm" type="reset" value="reset" />
      </td>
   </tr>
<?php
   while ($array = mysql_fetch_array($data))
   {

      $studentId = $array['studentId'];
      // allow the user to just click on the row to select/deselect 
      // instead of clicking the select button
      print "<tr id='$studentId'>";
      for ($i = 1; $i < 5; $i++)
      {
         print "<td onclick='select( $studentId )'>" . $array[$i] . "</td>\n";
      }
      
      $bldg = $array['bldg'];
      $room = $array['room'];
      $apptTime = $array['apptTime'];
      if ($bldg)
      {
         print "<td onclick='select($studentId)'>$bldg $room $apptTime</td>\n";
      }
      else
      {
         print "<td onclick='select($studentId)'></td>\n";
      }

      // make the buttons
      print '<td class="tools">';
//       print '<input type="button" class="select"';
//       print 'value="select" onclick="select(' . $array['studentId'] . ')">';
//       print "</input>\n";
      print '<input type="button" class="unreg"';
      print 'value="unschedule" onclick="unreg(' . $array['studentId'] . ')"';
      if (!$array['apptTime'])
      {
         print ' disabled="disabled"';
      }
      print '>';
      print "</input>\n";
      print '<input type="button" class="rm"';
      print 'value="delete" onclick="rm(' . $array['studentId'] . ')">';
      print "</input>\n";
      print "</td>\n";
      print "</tr>\n";
   }
   
?>
</table></form><br />

<?php 
   $query = "SELECT ts.slotId, r.bldg, r.room, TIME_FORMAT(ts.apptTime, '%h:%i %p') AS apptTime
             FROM FTimeSlots ts, FResources r
             WHERE ts.resourceId = r.resourceId AND ts.studentId1 IS NULL
             ORDER BY ts.day, ts.apptTime, r.bldg, r.room;";
   $data =  mysql_query($query);
   queryError($query, $data, "timeSlot query failed");  
?>

<form><h2>
   Choose A Time Slot: 
   <select id="slotList">
   <?php
   while ($array = mysql_fetch_array($data))
   {
      print "<option value='" . $array['slotId'] . "'>";
      print $array['bldg'] . " " . $array['room'] ." " . $array['apptTime'];
      print "</option>";
   }

   ?>
   </select>
   <input type="button" id="schedule" value="schedule" disabled="disabled" onclick="reg()"></input>

</h2></form>