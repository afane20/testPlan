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
if (!($con = new mysqli($hostname, $mysql_login , $mysql_password, $database)))
{
   print "<br/><h2>Data Connection failed. </h2><br/>";
   die("<h2>Cannot connect to database server.</h2>");
}
else
{
   // select a database - not necessary unless you want to change the data base
   
   if (!$con->select_db($database))
   {
      print "<br/><h3>Error - Could not select '" . $database . "' database!</h3>";
      die("<h2>mysqli->select_db failed</h2>");
   }

}

$query = $_GET["query"];
print "<br/>Query: <span style = \"border: medium solid thin; background-color: lightgrey;\">$query </span>";
print "<br/><br/>";    


// make the query
$result = $con->query($query);
if (!$result)
{
   print "<br/> Syntax Error - query could not be executed <br/><br/>";
   $error =$con->error;
   print "<div style = \"width: 400px; color: red; border: medium solid thin\" >$error</div>";
}
else
{ 
   // Display the results
   print "<table> <caption> <h2> Query Results </h2></caption>";
   print "<tr align = 'center'>";
   
   $numRows = $result->num_rows;
   $row = $result->fetch_array(MYSQLI_BOTH);   // or default  $result->fetch_arr 
   $numFields = $result->field_count;
   $keys = array_keys($row);

   // output field headings
   for ($i = 0; $i < $numFields; $i++)
   {
      $field = $result->fetch_field_direct($i);   // get the field names from result set
      print "<th style = 'text-decoration: underline'>" . $field->name . "</th>";
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
      $row = $result->fetch_array(MYSQLI_BOTH);   // or default  $result->fetch_arr 
   }
   print "</table>";
}

?>

</p>
</body>
</html>
