<?php
$festivalDate = "2010-10-04";
$festivalDate = "06/18/1954";
$startTime = " 22:30";
$dateTime = $festivalDate . $startTime;
print($dateTime . "\n");


$regEnds = "2014-08-5";
$exp_date = strToTime($regEnds);

$todays_date = date("Y-m-d");

print " <br/>Reg ends: $regEnds";
print " Timestamp - $exp_date";
print "<br/>Current date: $todays_date \n";
$today = strtotime($todays_date);
print "  Timestamp - $today ";

$expiration_date = strtotime($exp_date);
if ($exp_date >= $today)
{
   $valid = " still open";
}
else
{
   $valid = " closed";
}

print "<br>$valid";
   
$displayTime = date('m-d-Y h:i A',$timeStamp);
print "<br>$displayTime";

?>