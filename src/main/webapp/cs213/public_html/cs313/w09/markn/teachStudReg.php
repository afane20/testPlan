<html>
	<head> <title> Festival </title>
	   <base href="http://157.201.194.254/~ercanbracks/cs313/w09/markn/" />
      <link rel = "stylesheet" type = "text/css" href = "exstyle.css" />
      <script type = "text/javascript" src = ""> </script>       
   </head>
   <body>
	<?php           
$db = mysql_connect("jordan", "ercanbracks", "scotte");
      if(!$db)
         exit("Error3, could not connect to MYSQL");
     
      // select markbn DB
      $er = mysql_select_db("markbn");
      if(!$er)
          exit("Error could not open markbn DB");          
            
      $studFirstName = $_GET["studFirstName"];
      $studLastName = $_GET["studLastName"];
      $instrument = $_GET["instrument"];
      $level = $_GET["level"];
      $resourceId = $_GET["resourceId"];
      $displayType = $_GET["displayType"];
      $executeType = $_GET["executeType"];
      $displayQuery = $_GET["displayQuery"];
      $teacherId = $_GET["teacherId"];
      
      if($executeType == "display")
      {      
         display($displayType, $displayQuery);
      }
      elseif($executeType == "updateStudent")
      {        
         $studId = getStudId($teacherId);         
         if(checkStudInDataBase($studId))
         {             
            updateStudentRecord($studId);
            updateResources($studId);
         }
         else
         {           
            createStudentRecord($teacherId);
            $studId = getStudId($teacherId);
            updateResources($studId);
         }
      }
      elseif($executeType == "unregisterStudent")
      {
         $studId = getStudId($teacherId);
         unRegisterStudent($studId);
      }      
      
      function unRegisterStudent($studId)
      {
         $query = "update FStudents set registered = false where studentId = " . $studId;
         mysql_query($query);
         $query = "select resourceId from FStudents where studentId = " . $studId;
         $result = mysql_query($query);
          $row = mysql_fetch_array($result);
          $values = array_values($row);
          $value = $values[1];
          updateResourcesUnregister($value);
         updateResources(0);
      }
      
      function getStudId($teacherId)
      {         
         global $studFirstName, $studLastName;
         $query = "select studentId from FStudents where firstName = '" . $studFirstName . "' and lastName = '" . $studLastName . "' and teacherId =" . $teacherId;
          $result = mysql_query($query);
          $row = mysql_fetch_array($result);
          $values = array_values($row);
          $value = $values[1];            
          return $value;
      }     
      
      function checkStudInDataBase($studId)
      {
                  
         $query = "select studentId from FStudents where studentId = " . $studId;
         
         $result = mysql_query($query);
         $numRows = mysql_num_rows($result);
      
         // is an admin
         if($numRows == 1)
            return true;         
         else
            return false;
      }
      
      function updateResources($studentId1)
      {
         global $resourceId;
         $query = "update FResources set studentId1=" . $studentId1 . " where resourceId = " . $resourceId;
          $result = mysql_query($query);
      }
      
      function updateResourcesUnregister($resourceId)
      {         
         $query = "update FResources set studentId1= 0 where resourceId = " . $resourceId;
          $result = mysql_query($query);
      }
      
      function updateStudentRecord($studId)
      {
         global $studLastName, $teacherId, $instrument, $studFirstName, $level, $resourceId;
         $query = "update FStudents set firstName ='" . $studFirstName . "', lastName='" . $studLastName . "', instrument ='" . $instrument . "', level='" . $level . "', teacherId=" . $teacherId . ", resourceId=" . $resourceId . ", registered = true where studentId=" . $studId;         
         $result = mysql_query($query);
      }
      
      function createStudentRecord($teacherId)
      {
         global $studLastName, $instrument, $studFirstName, $level, $resourceId;
         $query = "insert into FStudents(firstName,lastName,instrument,level,teacherId,resourceId, registered) values('" . $studFirstName . "','" . $studLastName . "','" . $instrument . "','" . $level . "'," . $teacherId . "," . $resourceId . ",true )";         
         $result = mysql_query($query);
      }

      function display($displayType, $displayQuery)
      {         
         $result = mysql_query($displayQuery);
         if($displayType == "display")
         {
             //Display results in a table
             print "<table border = 'border' class = 'one' cellspacing = '5' cellpadding = '5'><caption> <h4> Query Results </h> </caption>";
             print "<tr align = 'center'>";
             
             $num_rows = mysql_num_rows($result);
             $row = mysql_fetch_array($result);
             $num_fields = mysql_num_fields($result);
             
             $keys = array_keys($row);
             for($index = 0; $index < $num_fields; $index++)
                print "<th>" . $keys[2 * $index + 1] . "</th>";
                print "</tr>";
             
             for($row_num = 0; $row_num < $num_rows; $row_num++)
             {
                print "<tr align = 'center'>";
                $values = array_values($row);
                for($index = 0; $index < $num_fields; $index++)
                {
                   $value = htmlspecialchars($values[2 * $index + 1]);
                   print "<th>" . $value . "</th>";
                }
               print "</tr>";
               $row = mysql_fetch_array($result);
             }
             
             print "</table> </br>"; 
         }
         
         elseif($displayType == "list")
         { 
            $num_rows = mysql_num_rows($result);
            $row = mysql_fetch_array($result);
            $num_fields = mysql_num_fields($result);                 
             
            for($row_num = 0; $row_num < $num_rows; $row_num++)
            {          
               $values = array_values($row);
               for($index = 0; $index < $num_fields; $index++)
               {
                  $value = $values[2 * $index + 1];
                  $value = $value . ",";
                  print ($value);
               }          
              $row = mysql_fetch_array($result);
            }                  
         }
      }
      
?>
</body>
</html>