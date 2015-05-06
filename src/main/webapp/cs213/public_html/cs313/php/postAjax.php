<?php
$hostname="157.201.194.254";
$mysql_login="Anonoymous";
$mysql_password="";
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

$query = $_POST["query"]; // $_REQUEST will work for post or get command
print "<br/>Query: <span style = \"border: medium solid thin; background-color: lightgrey;\">$query </span><br/>";
print "<br/>";    


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
