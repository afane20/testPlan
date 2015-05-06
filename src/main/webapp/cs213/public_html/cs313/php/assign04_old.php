<?php
header('Content-type: text/html');
?>
<html>
<head>
<title>PHP Data Base</title>
</head>
<body>
<p>
<?php
$hostname="157.201.194.254";
$mysql_login="Anonymous";
$mysql_password= '';
$database="ercanbracks";

// connect to the database server
if (!($db = mysql_connect($hostname, $mysql_login , $mysql_password)))
{
   print "<br>Can't connect to database server";
   die("Can't connect to database server.");
}
else
{
   // select a database
   if (!(mysql_select_db($database)))
   {
      print "<br/> Error - Could not select 'ercanbracks' data base";
      die("Can't connect to database.");
   }
}

$query = $_GET["query"];
print "<br/>Query: <span style = \"border: medium solid thin; background-color: lightgrey;\">$query </span>";
print "<br/><br/>";    


// make the query
$result = mysql_query($query);
if (!$result)
{
   print "<br/> Syntax Error - query could not be executed <br/><br/>";
   $error = mysql_error();
   print "<div style = \"width: 400px; color: red; border: medium solid thin\" >$error</div>";
}
else
{ 
   // Display the results
   print "<table> <caption> <h2> Query Results </h2></caption>";
   print "<tr align = 'center'>";
   
   $numRows = mysql_num_rows($result);
   $row = mysql_fetch_array($result);
   $numFields = mysql_num_fields($result);
   $keys = array_keys($row);

   // output field headings
   for ($i = 0; $i < $numFields; $i++)
   {
      $fieldName = mysql_field_name($result, $i);   // get the field names from result set
      print "<th style = 'text-decoration: underline'>" . $fieldName . "</th>";
      //     print"<th style = 'text-decoration: underline'>" . $keys[2 * $i + 1] . "</th>";  // also gets field names;
   }
   print "</tr>";
        
   // output values
   for ($iRow = 0; $iRow < $numRows; $iRow++)
   {
      print "<tr align = 'center'> ";
      for ($i = 0; $i < $numFields; $i++)
      {
         $values = array_values($row);        
         $value = htmlspecialchars($values[2 * $i + 1]);  // get values from the array returned from the array_values() function
         //    $value = htmlspecialchars($row[$i]);       // get the values directly from the row array indexing by an integer
         print "<td>" . $value . "</td>";
      }
      print "</tr>\n";
      $row = mysql_fetch_array($result);
   }
   print "</table>";
}

?>

</p>
</body>
</html>
