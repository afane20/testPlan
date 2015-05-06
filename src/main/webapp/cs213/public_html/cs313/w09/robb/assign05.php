<form>
<table>
   <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Gender</th>
      <th>City</th>
      <th>State</th>
      <th>Birthdate</th>
      <th>Major Code</th>
      <th>Tools</th>
   </tr>
   <tr id="-1">
      <td>
         <input id="firstName" type="text" size="7"/>
      </td>
      <td>
         <input id="lastName" type="text" size="10"/>
      </td>
      <td>
         <input id="gender" type="text" size="1" maxlength="1"/>
      </td>
      <td>
         <input id="city" type="text" size="12"/>
      </td>
      <td>
         <input id="state" type="text" size="2" maxlength="2"/>
      </td>
      <td>
         <input id="birthDate" type="text" size="10"/>
      </td>
      <td>
         <input id="majorCode" type="text" size="3" maxlength="3"/>
      </td>
      <td>
         <input id="studentId" type="hidden" value="-1"/>
         <input id="add" type="button" value="add" onclick="addEntry();"/>
         <input id="save" type="button" value="save" onclick="saveData()" disabled="disabled"/>
         <input id="reset" type="reset" value="reset" onclick="resetForm()"/>
      </td>
   </tr>
<?php
   ($db = mysql_connect("jordan","ercanbracks","scotte")) or die("ERROR: Database connection failed!");
   mysql_select_db("treborus") or die("ERROR: Database selection failed!");
   
// sort by studentId in decending order, 
// so the entriesy that were just added are at the top
   $query = "SELECT * FROM students ORDER BY studentId DESC;";
   
   $data =  mysql_query($query) or die("query failed");
   
?>


<?php
   $array = mysql_fetch_array($data); 
   while ($values = array_values($array))
   {
      $onclick = ' onclick="mod(' . $values[0];
      for ($i = 1; $i < (mysql_num_fields($data)); $i++)
      {
         $onclick = $onclick . ", '" . $values[2 * $i + 1] . "'";
      }
      $onclick = $onclick . ')"';
      
      // allow the user to just click on the row to select/deselect 
      // instead of clicking the select button
      print '<tr id="' . $array['studentId'] . '">';
      for ($i = 1; $i < (mysql_num_fields($data)); $i++)
      {
         print "<td " . $onclick . ">" . $values[2 * $i + 1] . "</td>\n";
      }
      
      // make the buttons
      print '<td class="tools">';
      print '<input type="button" class="mod"';
      print 'value="select" ' . $onclick . '>';
      print "</input>\n";
      print '<input type="button" class="rm"';
      print 'value="delete" onclick="rm(' . $values[0] . ')">';
      print "</input>\n";
      print "</td>\n";
      print "</tr>\n";
      $array = mysql_fetch_array($data); 
   }

?>
</table>
</form>
