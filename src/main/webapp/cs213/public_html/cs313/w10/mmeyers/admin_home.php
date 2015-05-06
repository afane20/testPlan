<?php

require_once('app_top.php');

$user = validate_user(TRUE);

$javascripts = array('window', 'effects', 'admin_festival', 'datepicker', 'prototype-date-extensions', 'fabtabulous');
$stylesheets = array('default', 'alert', 'alphacube');

//$onload = 'load_festivals();load_teachers();load_locations();';

require_once('header.php');

?>

<div id="container"> 
    <div id="mainmenu"> 
        <ul id="tabs">
            <li><a href="admin_home.php#tab1">Festival Dates</a></li>
            <li><a href="admin_home.php#tab2">Teacher Dues</a></li>
            <li><a href="admin_home.php#tab3">Festival Locations</a></li>
            <li><a href="admin_home.php#tab4">Schedule</a></li>
        </ul>
    </div> 
    <div class="panel" id="tab1"> 
        <h2>Festival Dates</h2>
        <div id="festival_list">
           <?php require_once('festival_list.php'); ?>
        </div>
    </div> 
    <div class="panel" id="tab2"> 
        <h2>Teacher Dues</h2>
           <?php require_once('teacher_list.php'); ?>
        <div id="teacher_dues"></div>
    </div>
    <div class="panel" id="tab3">
        <h2>Locations</h2>
        <div id="locations">
           <?php require_once('location_list.php'); ?>
        </div>
    </div>
    <div class="panel" id="tab4">
        <h2>Schedule</h2>
        <div id="schedule_container">
           <?php require_once('admin_schedule.php'); ?>
        </div>
    </div>
</div>

<?php

require_once('footer.php');
require_once('app_bottom.php');