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
      $firstName = $_REQUEST['firstName'];
      $lastName = $_REQUEST['lastName'];
      $userName = $_REQUEST['userName'];
      $email = $_REQUEST['email'];
      $streetAddr = $_REQUEST['streetAddr'];
      $city = $_REQUEST['city'];
      $zip = $_REQUEST['zip'];
      
      $query = "INSERT INTO FTeachers (firstName, lastName, userName, email, 
                                       streetAddr, city, zip)
                VALUES ('$firstName', '$lastName', '$userName', '$email', 
                        '$streetAddr', '$city', '$zip');";
      $data =  mysql_query($query);
      queryError ($query, $data,"Add teacher failed.");
   
   
   }
   else if ($_REQUEST['type'] == 'mod')
   {
      $teacherId = $_REQUEST['teacherId'];
      $firstName = $_REQUEST['firstName'];
      $lastName = $_REQUEST['lastName'];
      $userName = $_REQUEST['userName'];
      $email = $_REQUEST['email'];
      $streetAddr = $_REQUEST['streetAddr'];
      $city = $_REQUEST['city'];
      $zip = $_REQUEST['zip'];
      
      $query = "UPDATE FTeachers
                SET firstName = '$firstName', lastName = '$lastName',
                    userName = '$userName', email = '$email',
                    streetAddr = '$streetAddr', city = '$city',
                    zip = $zip
                    WHERE teacherId = $teacherId;";
      $data =  mysql_query($query);
      queryError ($query, $data,"Save teacher failed.");
   }
   else if ($_REQUEST['type'] == "rm")
   {
      $teacherId = $_REQUEST['teacherId'];
      $query = "DELETE FROM FTeachers WHERE teacherId = $teacherId;"; 
      $data =  mysql_query($query);
      queryError ($query, $data,"Remove teacher failed.");
   }
   

   $query = "SELECT t.teacherId, t.firstName, t.lastName, t.userName, 
                    t.email, t.streetAddr, t.city, t.zip
             FROM FTeachers t;";
   $data =  mysql_query($query);
   queryError ($query, $data,"teacher query failed");
?>
<form id="teachersForm" onreset="select(tId)"><table id="teachers">
   <tr>
      <th colspan="2">Teacher Name</th>
      <th>Username</th>
      <th>Email Address</th>
      <th>Street Address</th>
      <th>City</th>
      <th>Zip</th>
      <th></th>
   </tr>
   <tr>
      <td><input id="firstName" type="text" size="8" /></td>
      <td><input id="lastName" type="text" size="10" /></td>
      <td><input id="userName" type="text" size="10" /></td>
      <td><input id="email" type="text" size="25" /></td>
      <td><input id="streetAddr" type="text" size="20" /></td>
      <td><input id="city" type="text" size="8" /></td>
      <td><input id="zip" type="text" size="4" /></td>
      <td>
         <input id="add" type="button" value="add" onclick="addEntry();"/>
         <input id="save" type="button" value="save" onclick="saveData();" disabled="disabled"/>
      </td>
   </tr>
<?php
   while ($array = mysql_fetch_array($data))
   {
      $onclick = ' onclick="select(' . $array[0];
      for ($i = 1; $i < (mysql_num_fields($data)); $i++)
      {
         $onclick = $onclick . ", '" . $array[$i] . "'";
      }
      $onclick = $onclick . ')"';
      
      // allow the user to just click on the row to select/deselect 
      // instead of clicking the select button
      print '<tr id="' . $array['teacherId'] . '">';
      for ($i = 1; $i < (mysql_num_fields($data)); $i++)
      {
         print '<td onclick="select(' . $array['teacherId'] . ')">' . $array[$i] . "</td>\n";
      }
      
      // make the buttons
      print "<td class='tools' onclick='select(" . $array['teacherId'] . ")'>";
//       print '<input type="button" class="select"';
//       print 'value="select" onclick="select(' . $array['teacherId'] . ')">';
//       print "</input>\n";
//       print '<input type="button" class="rm"';
//       print 'value="delete" onclick="rm(' . $array['teacherId'] . ')">';
//       print "</input>\n";
      print "</td>\n";
      print "</tr>\n";
   }
   
?>
</table></form><br />


</body>
</html>