<?php
($db = mysql_connect("jordan","ercanbracks","scotte")) or die("ERROR: Database connection failed!");
   mysql_select_db("treborus") or die("ERROR: Database selection failed!");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
   <title>Register students for the Music Festival</title> 
   <link rel="stylesheet" href="../style.css"/>
   <script type="text/javascript" src="regStudents.js"></script>

</head>
<body onload="selectTeacher();">
<h1>UVMTA Music Festival: Student Registration</h1>
<form>
   <?php
      $query = "SELECT t.teacherId, t.lastName, t.firstName, t.userName"
             . " FROM FTeachers t ORDER BY t.firstName, t.lastName";
      ($data =  mysql_query($query)) or die("teacher query failed");
   ?>
   <h2>Select A Teacher:
   <select id="teacherList" onchange="selectTeacher();">
   <?php

      while ($array = mysql_fetch_array($data))
      {
         print "<option value='" . $array['teacherId'] . "'>";
         print $array['firstName'] . " " . $array['lastName'];
         print " (" . $array['userName'] .")";
         print "</option>";
      }
   ?>
   </select></h2>
   </form>
   <div id="result"></div>




<?php

?>
</body>
</html>
