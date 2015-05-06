<?php

require_once('app_top.php');

$user = validate_user();

$javascripts = array('window', 'effects', 'teacher', 'fabtabulous');
$stylesheets = array('default', 'alert', 'alphacube');

require_once('header.php');

?>


<div id="container"> 
    <div id="mainmenu"> 
        <ul id="tabs">
            <li><a href="teacher_home.php#tab1">Students</a></li>
            <li><a href="teacher_home.php#tab2">Schedule</a></li>
        </ul>
    </div> 
    <div class="panel" id="tab1">
        <h2>Home</h2>
        <div id="student_list">
           <?php require_once('student_list.php'); ?>
        </div>
        <a class="button" href="javascript:show_add_student()">Add Student</a>
    </div> 
    <div class="panel" id="tab2">
         <h2>Schedule</h2>
         <div id="schedule">
            <?php require_once('teacher_schedule.php'); ?>
         </div>
    </div>
</div>

<?php

require_once('footer.php');
require_once('app_bottom.php');