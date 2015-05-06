<?php

/*
 * CONTROLLER FOR GENERAL
 */

if (!$_session) {
    session_start();
}



include '/home/ercanbracks/public_html/cs313/heidi/database/conn.php';
include '/home/ercanbracks/public_html/cs313/heidi/teacher/model.php';
include '/home/ercanbracks/public_html/cs313/heidi/library.php';

$name;
$location;
$mainDay;
$mainTimeFrame;
$mainDayCost;
$altDay;
$altTimeFrame;
$altDayCost;
$earlyRegistrationDate;
$normalRegistrationDate;
$earlyRegistrationLive;
$normalRegistrationLive;
$message;


$sql = "SELECT name, location, mainDay, mainTimeFrame, mainDayCost, altDay, altTimeFrame, altDayCost, earlyRegistrationDate, normalRegistrationDate, earlyRegistrationLive, normalRegistrationLive FROM festival WHERE active='true'";

$result = mysql_query($sql);

if (!$result) {
    $message = "<br> <p>There was an error finding the current festival. Please contact the website administrator for assistance.</p>";
}

//------------------get # of rows down
$numRows = mysql_num_rows($result);

if ($numRows == 0) {
    $message = "<br> <p>None of the festivals are currently active. Check back again later.</p>";
} else {
    $row = mysql_fetch_array($result);
    $name = $row[0];
    $location = $row[1];
    $mainDay = $row[2];
    $mainTimeFrame = $row[3];
    $mainDayCost = $row[4];
    $altDay = $row[5];
    $altTimeFrame = $row[6];
    $altDayCost = $row[7];
    $earlyRegistrationDate = $row[8];
    $normalRegistrationDate = $row[9];
    $earlyRegistrationLive = $row[10];
    $normalRegistrationLive = $row[11];
}

include 'general.php';
?>