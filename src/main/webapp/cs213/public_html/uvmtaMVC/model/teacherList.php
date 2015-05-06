<?php
   include 'loginValid.php';

   if ( !isset($_GET['teacherId'] ) )
   {
      print "Server Error: Please try again later";
      //   exit;

   }

   $teacherId = $_GET['teacherId'];

   require_once("dbConnect.php");



   $query = "SELECT first,last,teacherId,uvmtaId,phone,email,membershipCurrent,membershipFees,
              regFees,admin,earlyReg FROM teacher" . " ORDER BY " . $_GET['sortBy'] . " " . $_GET['sortDir'];
   $data = mysql_query( $query );
   
   if ( !$data )
   {
      print "Invalid query string: ".mysql_error();
      exit;
   }
   $rowCount = mysql_num_rows( $data );
   $currentRow;
?>
   <table class = "tableData" border = "1">
   <tr class = "bgcolored">
      <td colspan = "1">Action</td>
      <td><input class = "button" type = "button" onclick="teacherList('teacherId')" value = "ID #"/></td>
      <td><input class = "button" type = "button" onclick="teacherList('last')" value = "Last Name"/></td>
      <td><input class = "button" type = "button" onclick="teacherList('first')" value = "First Name"/></td>
      <td><input class = "button" type = "button" onclick="teacherList('uvmtaId')" value = "UVMTA ID"/></td>
      <td>Phone</td>
      <td>Email</td>
      <td><input class = "button" type = "button" onclick="teacherList('membershipCurrent')" value = "M Current"/></td>
      <td><input class = "button" type = "button" onclick="teacherList('membershipFees')" value = "M Dues"/></td>
      <td><input class = "button" type = "button" onclick="teacherList('regFees')" value = "F Fees"/></td>
      <td><input class = "button" type = "button" onclick="teacherList('admin','DESC')" value = "Admin"/></td>
      <td><input class = "button" type = "button" onclick="teacherList('earlyReg','DESC')" value = "Early Reg"/></td>
      <td colspan = "1">Action</td>
   </tr>
   
<?php
   
   for($row = 0; $row < $rowCount; $row++)
   {
     
      $currentRow = mysql_fetch_array( $data );
      $firstName = $currentRow['first'];
      $lastName = $currentRow['last'];
      $teacherId = $currentRow['teacherId'];

      # Now query and get the unpaid registration records for the teacher
      $query = "SELECT regFee FROM registration WHERE teacherId =" . $teacherId . " AND regFeePaid = \"N\"";
      $regData = mysql_query( $query );    
      $numRows = mysql_num_rows( $regData );
      $totalRegFees = 0;
      
      for($rowNum = 0; $rowNum < $numRows; $rowNum++)
      {
         $record = mysql_fetch_array( $regData );
         $totalRegFees = $totalRegFees + $record['regFee'];
      }
 
      print "<tr"  . ($odd++ % 2 == 0 ? " class='altRow'":"") . ">";
      print "<td><a href=\"javascript:modifyTeacher($teacherId)\">Modify</a></td>";
      print "<td>".$currentRow['teacherId']."</td>";
      print "<td>$lastName</td>";
      print "<td>$firstName</td>";
      print "<td>".$currentRow['uvmtaId']."</td>";
      print "<td>".$currentRow['phone']."</td>";
      print "<td>".$currentRow['email']."</td>";
      print "<td>".$currentRow['membershipCurrent']."</td>";
      print "<td>".$currentRow['membershipFees']."</td>";   
      print "<td>".$totalRegFees."</td>";
      print "<td>".$currentRow['admin']."</td>";
      print "<td>".$currentRow['earlyReg']."</td>";

      print "<td><a href=\"javascript:dropTeacher($teacherId,'$firstName','$lastName')\">Remove</a></td>";
      print "</tr>";
      
   }
?>
   </table>
