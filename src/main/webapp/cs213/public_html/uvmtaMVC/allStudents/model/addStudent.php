<?php 
	require_once "model.php";
	
	$first = sanStr($_POST['first']);
	$last = sanStr($_POST['last']);
	$instrument = sanStr($_POST['instrument']);
	$gradYear = $_POST['gradYear'];
	$festivals = $_POST['festivals'];
	$points = $_POST['points'];
	$lastFestDate = $_POST['lastFestDate'];
	$teacherId = $_POST['teacherId'];
		
	echo addStudent($first, $last, $instrument, $gradYear, $festivals, $points, $lastFestDate, $teacherId);
	
?>