<?php
$hostname="157.201.194.254";
$mysql_login="Anonymous";
$mysql_password="";
$database="ercanbracks";
// This us using MYSQLI object oriented style

$mysqli = new mysqli($hostname,$mysql_login, $mysql_password, $database);
//$mysqli = mysqli_connect($hostname,$mysql_login, $mysql_password, $database);
//$mysqli = mysql_connect($hostname,$mysql_login, $mysql_password);
//if(IsSet($mysqli))
//{
//echo "ok1";
//}
//else
//{
//   echo "bad";
//}

if ($mysqli->connect_errno)
{
   echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else
{
   // echo $mysqli->host_info . "\n";
}


// Changing the selected database
if (!$mysqli->select_db($database))
{
   echo "Error selecting data base " . $database;
}
else
{
//   echo "changed database";
}

$query = $_GET["query"];
print "<br/>Query: <span style = \"border: medium solid thin; background-color: lightgrey;\">$query </span><br/>";
print "<br/>";    


// make the query
$result = $mysqli->query($query);
if (!$result)
{
    $error = $mysqli->error;
    print "<span style = \"width: 400px; color: red; border: medium solid thin\" >$error</span>";
}
else
{ 
   // Display the results
   print "<table> <caption> <h2> Query Results </h2></caption>";
   print "<tr align = 'center'>";
   
   $numRows = mysqli_num_rows($result);
   $row = $result->fetch_array(MYSQLI_BOTH);   // or default  $result->fetch_array()
   $numFields = $result->field_count;
   $keys = array_keys($row);

   // output field headings
   for ($i = 0; $i < $numFields; $i++)
   {
      print"<th style = 'text-decoration: underline'>" . $keys[2 * $i + 1] . "</th>";
   }
   print "</tr>";
        
   // output values
   for ($iRow = 0; $iRow < $numRows; $iRow++)
   {
      print "<tr align = 'center'> ";
      $values = array_values($row);
      for ($i = 0; $i < $numFields; $i++)
      {
         $value = htmlspecialchars($values[2 * $i + 1]);
         print "<th>" . $value . "</th>";
      }
      print "</tr>";
      $row = $result->fetch_array(MYSQL_BOTH);
   }
   print "</table>";
}

?>
