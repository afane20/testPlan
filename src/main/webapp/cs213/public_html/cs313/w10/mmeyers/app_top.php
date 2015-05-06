<?php

// site url
define('SITE_URL', 'http://157.201.194.254/~ercanbracks/cs313/w10/mmeyers/');
//define('SITE_URL', 'http://localhost:8080/~ercanbracks/cs313/w10/mmeyers/');

// Database connection
$conn = mysql_connect('jordan', 'mmeyers3', '');

// check the connection
if (!$conn)
   die('Sorry, I could not connect to the database');

// make sure we were able to connect to the database
if (!mysql_select_db('mmeyers3', $conn))
{
   die('Could not connect to the database.');
}
    
require_once('helpers.php');

session_start();

$javascripts = array();
