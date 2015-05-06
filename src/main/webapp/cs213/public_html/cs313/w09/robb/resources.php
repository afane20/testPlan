<?php
   ($db = mysql_connect("jordan","ercanbracks","scotte")) or die("ERROR: Database connection failed!");
   mysql_select_db("treborus") or die("ERROR: Database selection failed!");
   function queryError ($query, $data, $message)
   {
      if (!$data)
      {
         print "<p><b> $message </b><p>";
         print "<p> $query </p>";
         print "<p>" . mysql_error() . "</p>";
      }
   }
   if ($_REQUEST['type'] == 'add')
   {
      $bldg = $_REQUEST['bldg'];
      $room = $_REQUEST['room'];
      $numPanios = $_REQUEST['numPanios'];
      $query = "INSERT INTO FResources (bldg, room, numPanios)
                VALUES ('$bldg', $room, $numPanios);";
      $data = mysql_query($query);
      queryError($query, $data, "Add resource failed.");
   }
   else if ($_REQUEST['type'] == 'mod')
   {
      $resourceId = $_REQUEST['resourceId'];
      $bldg = $_REQUEST['bldg'];
      $room = $_REQUEST['room'];
      $numPanios = $_REQUEST['numPanios'];
      $query = "UPDATE FResources 
                SET bldg = '$bldg', room = $room,  numPanios = $numPanios
                WHERE resourceId = $resourceId;"; 
      $data = mysql_query($query);
      queryError($query, $data, "Save resource failed.");
   }

   $query = "SELECT * FROM FResources r ORDER BY bldg, room;";
   $data =  mysql_query($query);
   queryError ($query, $data,"resources query failed");

?>
<form id="resourcesForm"><table id="resources">
   <tr>
      <th>Bldg</th>
      <th>Room</th>
      <th style="font-size:75%"># of<br />Panios</th>
      <th></th>
   </tr>
   <tr>
      <td><input id="bldg" type="text" size="3" maxlength="3" /></td>
      <td><input id="room" type="text" size="3" maxlength="3" /></td>
      <td><input id="numPanios" type="text" size="1" maxlength="1" />
      </td>
      <td>
         <input id="add" type="button" value="add" onclick="addEntry();" />
         <input id="save" type="button" value="save" onclick="saveData();" disabled="disabled" />
      </td>
   </tr>
<?php
   while ($array = mysql_fetch_array($data))
   {

      // allow the user to just click on the row to select/deselect 
      // instead of clicking the select button
      print '<tr id="' . $array['resourceId'] . '">';
      for ($i = 1; $i < (mysql_num_fields($data)); $i++)
      {
         print "<td onclick='select(" . $array['resourceId'] . ")'>" . $array[$i] . "</td>\n";
      }
      
      // make the buttons
      print "<td class='tools' onclick='select(" . $array['resourceId'] . ")'>";
//       print '<input type="button" class="select"';
//       print 'value="select" onclick="select(' . $array['resourceId'] . ')">';
//       print "</input>\n";
//       print '<input type="button" class="rm"';
//       print 'value="delete" onclick="rm(' . $array['resourceId'] . ')">';
//       print "</input>\n";
      print "</td>\n";
      print "</tr>\n";
   }
   
?>
</table></form>