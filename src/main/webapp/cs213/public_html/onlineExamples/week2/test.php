<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!-- today.php - A trivial example to illustrate a php document -->
<html>
<head> <title> today.php </title>
</head>
<body>
<p>
<?php
   print "<b>Welcome to my home page <br /> <br />";
   print "Today is:</b> ";
   print date("l, F jS");
   print "<br />";
   print "<hr/>";
   $highs = array("Mon" => 74, "Tue" => 70,
               "Wed" => 67, "Thu" => 62,
               "Fri" => 65);

   print "\n$highs[Mon]\n";   // since no dollar sign it coerces "Fri" to a string.
   $days = array_keys($highs);
   $temps = array_values($highs);
   print "$days[0]<br/>";
   print "$temps[0]<br/>";
?>
</p>
</body>
</html>

