<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!-- sorting.php - An example to illustrate several of the
     sorting functions -->
<html>
<head> <title> Sorting </title>
</head>
<body>
  <?php
     $original = array("Fred" => 31, "Al" => 27, "Gandalf" => "wizzard",
                  "Betty" => 42, "Frodo" => "hobbit");
  ?>

  <h4> Original Array </h4>
  <?php
    foreach ($original as $key => $value)
       print("[$key] => $value <br />");
  ?>

  <h4> Array sorted with sort </h4>
  <?php
    $new = $original;
    sort($new);
    foreach ($new as $key => $value)
       print("[$key] = $value <br />");
  ?>

  <h4> Array sorted with sort and SORT_STRING </h4>
  <?php
    $new = $original;
    sort($new, SORT_STRING);
    foreach ($new as $key => $value)
       print("[$key] = $value <br />");
  ?>

  <h4> Array sorted with rsort </h4>
  <?php
    $new = $original;
    rsort($new);
    foreach ($new as $key => $value)
       print("[$key] = $value <br />");
  ?>

  <h4> Array sorted with asort </h4>
  <?php
    $new = $original;
    asort($new);
    foreach ($new as $key => $value)
       print("[$key] = $value <br />");
  ?>

  <h4> Array sorted with arsort </h4>
  <?php
    $new = $original;
    arsort($new);
    foreach ($new as $key => $value)
       print("[$key] = $value <br />");
  ?>

  <h4> Array sorted with ksort </h4>
  <?php
    $new = $original;
    ksort($new);
    foreach ($new as $key => $value)
       print("[$key] = $value <br />");
  ?>

</body>
</html>

