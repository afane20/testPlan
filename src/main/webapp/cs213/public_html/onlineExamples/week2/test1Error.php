<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!-- test1.php - A trivial example to illustrate a php document -->
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
   $highs = rray("Mon" => 60, "Tue" => 71,     
               "Wed" => 67, "Thu" => 62,
               "Fri" => 65);
   $temp1 = $highs["Tue"];
   print "$temp1<br/>";
   $days = array_keys($highs)                
   $temps = array_values($highs);
   $ikey = $days[2];
   $ivalue = $temps[2];
   print "$days[4] $temps[4]<br/>";
   print "$ikey  $highs[Fri]<br/>";
   print "<br/>";

   while ($temperature = next($highs))    // next increments current ptr  then returns the value
      print "$temperature <br/>";

   reset($highs);                         // reset the current pointer

   while ($temp = each ($highs))          // each returns value then increments current ptr.
      print "$temp[key] $temp[value] <br/>";

   foreach ($temps as $temp1)             // get each value of the array "temps"
      print "$temp1 <br/>";

   foreach($highs as $day => $tempValue)  // get each key-value pair from the array "highs"
      print "The temperature on $day is $tempValue. <br/>";
?>
</p>
</body>
</html>

