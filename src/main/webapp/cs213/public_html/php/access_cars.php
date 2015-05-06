<!-- access_cars.php
     A PHP script to access the cars database
     through MySQL
     -->
<html>
<head>
<title> Access the cars database with MySQL </title>
</head>
<body>
<?php

// Connect to MySQL

$db = mysql_connect("localhost", "root", "");
if (!$db) {
     print "Error - Could not connect to MySQL";
     exit;
}

// Select the cars database

$er = mysql_select_db("cars");
if (!$er) {
    print "Error - Could not select the cars database";
    exit;
}

// Clean up the given query (delete leading and trailing whitespace)

trim($query);
print "<p> <b> The query is: </b> " . $query . "</p>";

// Execute the query

$result = mysql_query($query);
if (!$result) {
    print "Error - the query could not be executed";
    $error = mysql_error();
    print "<p>" . $error . "</p>";
    exit;
}

// Display the results in a table

print "<table><caption> <h2> Query Results </h2> </caption>";
print "<tr align = 'center'>";

// Get the number of rows in the result, as well as the first row
//  and the number of fields in the rows

$num_rows = mysql_num_rows($result);
$row = mysql_fetch_array($result);
$num_fields = sizeof($row);

// Produce the column labels

while ($next_element = each($row)){
    $next_element = each($row);
    $next_key = $next_element['key'];
    print "<th>" . $next_key . "</th>";
}

print "</tr>";

// Output the values of the fields in the row

for ($row_num = 0; $row_num < $num_rows; $row_num++) {
    reset($row); 
    print "<tr align = 'center'>";
    for ($field_num = 0; $field_num < $num_fields / 2; $field_num++)
        print "<th>" . $row[$field_num] . "</th> ";

    print "</tr>";
    $row = mysql_fetch_array($result);
}
print "</table>";
?>
</body>
</html>

