<?php

if (!$_POST["view"] == "View Results")               // see if was "View Results" button
{
  setcookie ("finalVote", "true", time()+ 3600);     //expire after 1 hr (3600 secs
  session_start();
  $sessionId = session_id();// session_id

  if (!isset($_SESSION['voted']))
  {
     $_SESSION['voted'] = "false";
  }
  else
  {
     $_SESSION['voted'] = "true";
  }
  $voted = $_SESSION['voted'];
  $votedC = $_COOKIE['finalVote'];

}
else
{
   $voted = false;
   $votedC = false;
}
?>

  <!-- survey.php - A survey example -->

<html>
<head> <title> today.php </title>
   <style type = "text/css">
     div.cyan { background-color: lightcyan; border: 2px solid; text-align: center; width: 500px; margin: auto}
     div {border: 2px solid; text-align: center; width: 500px; margin: auto}
     strong {font-family: 'Arial'; font-size: 12pt}
     caption { font-size: 18pt}
     table { margin: auto}
     td {background-color: #cdcdcd}
   </style>
   
</head>
<body>
  
<?php
  $question = array (0,0,0,0,0,0,0);  
  prnt("<div class = 'cyan'><h2>Session and Cookie Information</h2>");
  print("Session Name (voted) = $voted <br/> Cookie Name (finalVote) = $votedC <br/>");
  print("Session id = \"$sessionId\" </div><br/>");
  if ($voted == "true" || $votedC == "true")
  {
     print "<div style = \"background-color: red\"><h1>You have already voted <h1></div>";
  }
  else
  {
     print "<div>";
     print "<h2>Survey Results <h2/>";
     
     if (file_exists("data/survey.dat"))
     {
        // The php File function - opens the file,
        // creates a string array and reads each line of the file into each element of the array,
        // then closes the file.   
        $file_lines = file("data/survey.dat");
        $question = explode(" ", $file_lines[0]); // splits the string of numeric data into an array 
     }
     if ($_POST["view"] != "View Results")
     {
        $question[0]++;
        if ($_POST["GovType"] == "dem")
        {
           $question[1]++;
        }
        if ( $_POST["GovType"] == "rep")
        {
           $question[2]++;
        }
        if ($_POST["ElectoralCollege"] == "y")
        {
           $question[3]++;
        }
        if ($_POST["ElectoralCollege"] == "n")
        {
           $question[4]++;
        }
        if ($_POST["abolish"] == "y" )
        {
           $question[5]++;
        }
        if ($_POST["abolish"] == "n" )
        {
           $question[6]++;
        }
     }
     print "<h3>Total Votes: $question[0] </h3>";
     print "<table cellpadding = '2' border = '1'>";
     print "<tr><td>The United States is what type of government?</td>";
     print "<td>Democracy</td><td>$question[1]</td><td>Republic</td><td>$question[2]</td></tr>";
     print "<tr><td>Do you know why the electoral college is used?</td>";
     print "<td>Yes</td><td>$question[3]</td><td>No</td><td>$question[4]</td></tr>";
     print "<tr><td>Should we abolish the electoral college system?</td>";
     print "<td>Yes</td><td>$question[5]</td><td>No</td><td>$question[6]</td></tr>";
     print "</table>";
     print "</div>";


     $outputFile = fopen("data/survey.dat", "w");  //open the file for writing (at beginning)
     $outputStr = implode(" ", $question);    //convert the array of numbers to a single string
     fwrite($outputFile, $outputStr);         // store the update survey results
     fclose($outputFile);
  }
?>
</body>
</html>
