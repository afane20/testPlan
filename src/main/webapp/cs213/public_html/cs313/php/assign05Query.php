<?php
$hostname="157.201.194.254";
$mysql_login="Anonymous";
$mysql_password="";
$database="ercanbracks";

// connect to the database server
if (!($con = new mysqli($hostname, $mysql_login , $mysql_password, $database)))
{
   print "<error><br/>Can't connect to database server</error>";
   die("Can't connect to database server.");
}

$fname = $_GET["fname"];
$lname = $_GET["lname"];
$id = $_GET["studentid"];
$query = $_GET["query"];
/*
$stmt = $con->prepare("select * from students where StudentId = ?");
if (!$stmt)
{
   echo "prepare error";
}
$stmt->bind_param("i" ,$id);
if (!$stmt->execute())
{
   echo "execute failed";
}

$result = $stmt->get_result();  // php 5.3 or higher
print $stmt->affected_rows;
*/

// make the query

$result = $con->query($query);
if ($con->affected_rows == 0 || !$result )
{
   print "<error>Form is Incomplete or Student not found <br /></error>";
   $error = $result->error;
   print "<error>$error</error>";

}
else
{

   // Display the results
   print "<table> <caption> <h2> Student List </h2></caption>";
   print "<tr align = 'center'>";
   
   $numRows = $result->num_rows;
   $row = $result->fetch_array(MYSQLI_BOTH);
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
      $row = $result->fetch_array(MYSQLI_BOTH);
   }
   print "</table>";
}
?>