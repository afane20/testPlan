<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!--powers.php
       An example to illustrate loops and arithmetic
       -->
<?php
// produces a powers table for the numbers 1 through 10
// the square root and raises each number to powers for 2,3, and 4. 
function powers()
{
   for ($number = 1; $number <=10; $number++)
   {
      $root = sqrt($number);
      $square = pow($number, 2);
      $cube = pow($number, 3);
      $quad = pow($number, 4);
      print("<tr align = 'center'> <td> $number </td>");
      print("<td> $root </td> <td> $square </td>");
      print("<td> $cube </td> <td> $quad </td> </tr>");
   }
}

// compute the maximum of the two numbers
function max_abs($first, $second)
{
   $first = abs($first);
   $second = abs($second);
   if ($first >= $second)
      return $first;
   else
      return $second;
}

// sum all the numbers in the array
function summer ($list)
{
   $sum = 0;
   foreach($list as $value)
      $sum += $value;
   return $sum;
}
?>

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
   powers();
?>
</table>
<p>
<?php
   $max = max_abs(-200, -500);
   print ("<h2>The max is $max.</h2>");
   $list = array(1,2,3,4,5);
   $sum = summer($list);
   print ("<h3 style = 'color: blue'>The sum is $sum. <h3>");
?>
</p>
</body>
</html>

