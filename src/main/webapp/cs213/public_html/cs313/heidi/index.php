<?php

if (!$_session) {
    session_start(); 
}

/*
 * Controller for the site root
 */

if($_GET['action']) {
    $action = $_GET['action'];
} elseif ($_POST['action']) {
    $action = $_GET['action'];
}

if ($action == 'logout') {
    session_unset();
    include 'home.php';
    
}
else {
    //header('Location: /home.php');
    include 'home.php';
    }
?>