<html>
	<head> <title> Festival </title>
	   <base href="http://157.201.194.254/~ercanbracks/cs313/w09/markn/" />
      <link rel = "stylesheet" type = "text/css" href = "http://157.201.194.254/~ercanbracks/cs313/w09/markn/exstyle.css" />
      <script type = "text/javascript" src = ""> </script>       
   </head>
   <body>
	<?php    
       
$db = mysql_connect("jordan", "ercanbracks", "scotte");
      if(!$db)
         exit("Error2, could not connect to MYSQL");
     
      // select markbn DB
      $er = mysql_select_db("markbn");
      if(!$er)
          exit("Error could not open markbn DB");          
      //Get query and clean it up       
       $displayType = $_GET["displayType"];
       //$updateQuery = $_GET["updateQuery"];
       $query = $_GET["query"];
             
       
       trim($query);
       $query = stripslashes($query);
       //Execute the query
       $result = mysql_query($query);
      if(!$result)
      {
         print "Error - The query couldn't be executed";
         $error = mysql_error();
         print "<p>" . $error . "</p>";
         exit;
      }
       
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
      
?>
</body>
</html>