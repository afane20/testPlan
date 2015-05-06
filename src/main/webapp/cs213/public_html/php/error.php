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
print "Today is:</b> "
   print date("l, F jS");
   print "<br/><br/>";
   phpinfo();
?>
</p>
</body>
</html>

