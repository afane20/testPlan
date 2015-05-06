<?php
	include '../model/loginValid.php';
	session_start();
	require_once '../menu.php';
	include "../model/dbConnPDO.php";
	require_once 'model/model.php';
//	$teachers = getTeachers();

	include "list.php";
 ?>