<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!--powers.php
       An example to illustrate loops and arithmetic
       -->
<html>
<head> <title> powers.php </title>
</head>
<body>
<table border = "border">
<caption> Powers table </caption>
<tr>
<th> Number </th>
<th> Square Root </th>
<th> Square </th>
<th> Cube </th>
<th> Quad </th>
</tr>
<?php
for ($number = 1; $number <=10; $number++) {
   $root = sqrt($number);
   $square = pow($number, 2);
   $cube = pow($number, 3);
   $quad = pow($number, 4);
   prit("<tr align = 'center'> <td> $number </td>");
   print("<td> $root </td> <td> $square </td>");
   print("<td> $cube </td> <td> $quad </td> </tr>");
}
?>
</table>
</body>
</html>

