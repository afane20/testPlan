<?php 
	require_once "model.php";
	
	$first = sanStr($_POST['first']);
	$last = sanStr($_POST['last']);
	$street = sanStr($_POST['street']);
	$city = sanStr($_POST['city']);
	$state = sanStr($_POST['state']);
	$zip = sanStr($_POST['zip']);
	$phone = sanStr($_POST['phone']);
	$email = $_POST['email'];
	$username = sanStr($_POST['username']);
	$pwd = sha1($_POST['pwd']);
	$uvmtaId = $_POST['uvmtaId'];
	$admin = sanStr($_POST['admin']);
	$earlyReg = sanStr($_POST['earlyReg']);
	$memCurr = sanStr($_POST['memCurr']);
	$memFees = $_POST['memFees'];
	$regFees = $_POST['regFees'];
	
	echo addTeacher($first, $last, $street, $city, $state, $zip, $phone, $email, $username, $pwd, $uvmtaId, $admin, $earlyReg, $memCurr, $memFees, $regFees);
	
?>