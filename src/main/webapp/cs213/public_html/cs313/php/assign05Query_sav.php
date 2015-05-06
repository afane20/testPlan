<?php
$hostname="157.201.194.254";
$mysql_login="ercanbracks";
$mysql_password="scotte";
$database="ercanbracks";

// connect to the database server
if (!($db = mysql_connect($hostname, $mysql_login , $mysql_password)))
{
   print "<error><br/>Can't connect to database server</error>";
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
// make the query
$result = mysql_query($query);
if (mysql_affected_rows() == 0 || !$result )
{
   print "<error>Form is Incomplete or Student not found <br /></error>";
   $error = mysql_error();
//   print "<error>$error</error>";

}
else
{
     // Display the results
   print "<table> <caption> <h2> Student List </h2></caption>";
   print "<tr align = 'center'>";
   
   $numRows = mysql_num_rows($result);
   $row = mysql_fetch_array($result);
   $numFields = mysql_num_fields($result);
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
      $row = mysql_fetch_array($result);
   }
   print "</table>";
}
?>