<?php

/*
 * CONTROLLER FOR TEACHER
 */

if (!$_session) {
    session_start();
}

if ($_SESSION['clientrights'] < 10) {
    $error = "Sorry but you do not currently have the rights to view this page. If you are logged in and you feel like you have reached this page in error please contact the website's adminitrator.";
    include '/home/ercanbracks/public_html/cs313/heidi/module/error.php';
    die;
}

include '/home/ercanbracks/public_html/cs313/heidi/database/conn.php';
include '/home/ercanbracks/public_html/cs313/heidi/teacher/model.php';
include '/home/ercanbracks/public_html/cs313/heidi/library.php';


$teacherId = $_SESSION['clientid'];

if ($_GET['action']) {
    $action = $_GET['action'];
} elseif ($_POST['action']) {
    $action = $_POST['action'];
}

if ($_GET['teacherid']) {
    $teacherId = $_GET['teacherid'];
} elseif ($_POST['teacherid']) {
    $teacherId = $_POST['teacherid'];
}

if ($_GET['studentid']) {
    $studentId = $_GET['studentid'];
} elseif ($_POST['studentid']) {
    $studentId = $_POST['studentid'];
}

if ($_GET['type']) {
    $type = $_GET['type'];
} elseif ($_POST['type']) {
    $type = $_POST['type'];
}

if ($_GET['firstname']) {
    $firstname = $_GET['firstname'];
} elseif ($_POST['firstname']) {
    $firstname = $_POST['firstname'];
}
if ($_GET['lastname']) {
    $lastname = $_GET['lastname'];
} elseif ($_POST['lastname']) {
    $lastname = $_POST['lastname'];
}
if ($_GET['birthdate']) {
    $birthdate = $_GET['birthdate'];
} elseif ($_POST['birthdate']) {
    $birthdate = $_POST['birthdate'];
}
if ($_GET['skilllevel']) {
    $skillLevel = $_GET['skilllevel'];
} elseif ($_POST['skilllevel']) {
    $skillLevel = $_POST['skilllevel'];
}
if ($_GET['instrument']) {
    $instrument = $_GET['instrument'];
} elseif ($_POST['instrument']) {
    $instrument = $_POST['instrument'];
}
if ($_GET['festivaldays']) {
    $festivalDays = $_GET['festivaldays'];
} elseif ($_POST['festivaldays']) {
    $festivalDays = $_POST['festivaldays'];
}


if ($_GET['locationid']) {
    $locationId = $_GET['locationid'];
} elseif ($_POST['locationid']) {
    $locationId = $_POST['locationid'];
}
if ($_GET['locationname']) {
    $locationName = $_GET['locationname'];
} elseif ($_POST['locationname']) {
    $locationName = $_POST['locationname'];
}
if ($_GET['timeslotid']) {
    $timeSlotId = $_GET['timeslotid'];
} elseif ($_POST['timeslotid']) {
    $timeSlotId = $_POST['timeslotid'];
}
if ($_GET['starttime']) {
    $startTime = $_GET['starttime'];
} elseif ($_POST['starttime']) {
    $startTime = $_POST['starttime'];
}
if ($_GET['endend']) {
    $endEnd = $_GET['endend'];
} elseif ($_POST['endend']) {
    $endEnd = $_POST['endend'];
}
if ($_GET['registrationid']) {
    $registrationId = $_GET['registrationid'];
} elseif ($_POST['registrationid']) {
    $registrationId = $_POST['registrationid'];
}






//===============================================================================

if ($action == 'profile') {

    $loginResult = array();
    $loginResult = getTeacherInfo($teacherId);
    //print_r($loginResult);

    if ($loginResult[0] > 0 && !empty($loginResult[4])) {
        $teacherId = $loginResult[0];
        $firstname = $loginResult[1];
        $lastname = $loginResult[2];
        $emailaddress = $loginResult[3];
        $phone = $loginResult[5];
        $mailingAddress = $loginResult[6];
        $numStudentsClearToRegister = $loginResult[7];
        $duesPaid = $loginResult[10];


        //echo "yup2";

        if ($type == 'edit') {
            include 'edit-profile.php';
        } else {
            include 'view-profile.php';
        }
    } else {
        //echo 'failed...';
        $error = "Sorry $firstname but there was a problem obtaining your information. Please try again.";
        include '/home/ercanbracks/public_html/cs313/heidi/module/error.php';
        die;
    }
}

//===============================================================================
elseif ($action == 'Update Profile') {


    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $teacherId = $_POST['teacherid'];



    //check for errors
    if (empty($firstname) || empty($lastname) || empty($phone) || empty($address)) {
        $errors[0] = "Please don't leave any fields empty!";
    }




    //let user if there is an error
    if (!empty($errors)) {
        include 'edit-profile.php';
        exit;
    }



    //process if all is well


    $updateUserResult = updateUser($firstname, $lastname, $phone, $address, $teacherId);


    //confirm and inform the user
    if ($updateUserResult == 1) {

        $loginResult = array();
        $loginResult = getTeacherInfo($teacherId);

        if ($loginResult[0] > 0 && !empty($loginResult[4])) {
            $teacherId = $loginResult[0];
            $firstname = $loginResult[1];
            $lastname = $loginResult[2];
            $emailaddress = $loginResult[3];
            $phone = $loginResult[5];
            $mailingAddress = $loginResult[6];
            $numStudentsClearToRegister = $loginResult[7];
            $duesPaid = $loginResult[8];

            if ($duesPaid == 1) {
                $duesPaid = 'Yes';
            } else {
                $duesPaid = 'No';
            }
        }

        $message = "Your profile has been updated.";


        include 'view-profile.php';
        die;
    } else {

        $message = "Sorry $first $last, your information had some trouble and was not updated on the website. Please try again.";
        include 'edit-profile.php';
    }
}

//===============================================================================
elseif ($action == 'displaystudents') {

    $sql = "SELECT studentId, firstName, lastName, birthdate FROM student WHERE teacherId=$teacherId";

    $result = mysql_query($sql);

    if (!$result) {
        echo "<br> <p>There was an error finding your students. Please contact the website administrator for assistance.</p>";
        die;
    }

    //------------------get # of rows down
    $numRows = mysql_num_rows($result);

    if ($numRows == 0) {
        echo "<br> <p>Fill in the form above to add a student. </p>";
        die;
    }

    //------------------get # of colums across
    $numFields = mysql_num_fields($result);

    //echo $numRows . "    "; 
    //echo $numFields  . "    ";;
    //------------------BUILDING THE TABLE
    echo "<table>";
    echo '<tr>';
    echo "<th>Student ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Birthdate</th>
            <th></th>
            <th></th>";
    echo '</tr>';
    $count = 0;
    while ($row = mysql_fetch_array($result)) {
        if ($count % 2 == 0) {
            $alt = 'class="alt"';
        } else {
            $alt = "";
        }
        echo "<tr $alt>";
        for ($a = 0; $a < $numFields; $a++) {
            echo "<td $alt>$row[$a]</td>";
        }
        echo "<td class=\"pointer blue\" onclick=\"registerStudent('$row[0]', '$row[1]', '$row[2]')\">Register</td>";
        echo "<td class=\"pointer red\" onclick=\"deleteStudent('$row[0]', '$row[1]', '$row[2]')\">Delete</td>";
        echo '</tr>';

        $count++;
    }
    echo "</table>";
}


//===============================================================================
elseif ($action == 'addstudent') {
    $sql = "INSERT INTO student (teacherId, firstName, lastName, birthdate) VALUES($teacherId, '$firstname', '$lastname', '$birthdate')";
    $result = mysql_query($sql);

    if ($result == TRUE) {
        echo "<p>$firstname $lastname has been added.</p>";
        die;
    } else {
        $message = "Sorry $firstname but there was a problem adding $firstname $lastname. Please try again.";
        die;
    }
}

//===============================================================================
elseif ($action == "delete") {
    $query = "DELETE FROM student WHERE studentId=$studentId";
    //echo "$first $last is the name <br>";
    //echo $query;
    //die;

    $result = mysql_query($query);

    if (!$result) {
        echo "<br> <p>There was an error deleting $firstname $lastname, please try again.  </p>";
        die;
    } else {
        echo "<p> $firstname $lastname has been deleted. </p>";
    }

    die;
}

//===============================================================================
elseif ($action == "searchregistration") {
  
    //--check to make sure there is a festival that is active
    
    $festivalId = getCurrentlyActiveFestival();
    if(!$festivalId){
        echo "<p style=\"margin-top:10px;margin-bottom:10px;\">The are currently no active festivals. Please wait until the festival is active and registration is open before registering your students.</p>";
        die;
    }
    
    //--check to make sure registration is open
    // --------------------CAN REGISTER EARLY IF MORE THEN 8 STUDENTS ARE PAID FOR
    
    
    $numStudentsClear = getNumberOfClearStudents($teacherId);
    $earlyRegistrationLive = earlyRegistrationOpen($festivalId);
    $normalRegistrationLive = normalRegistrationOpen($festivalId);
    $canRegister = true;
    
//    echo "num clear: $numStudentsClear <br>";
//    echo "early: $earlyRegistrationLive <br>";
//    echo "norm: $normalRegistrationLive <br>";
    
    
    if($numStudentsClear >= 8){
        if($earlyRegistrationLive != 'true'){
            $canRegister = false;
        }
        if($normalRegistrationLive == 'true'){
            $canRegister = true;
        }
    } else {
        if($normalRegistrationLive != 'true'){
            $canRegister = false;
        }
    }
    
//    echo "can register? $canRegister <br>";
    
    
    if(!$canRegister) {
        echo "<p style=\"margin-top:10px;margin-bottom:10px;\">You are currently not eligable to register. Please try again after registration has opened.</p>";
        die;
    }
    
    
    
    
    //--continue if its ok===========================
    
    
    if ($festivalDays == "") {
        $festivalDays = null;
    }if ($skillLevel == "") {
        $skillLevel = null;
    }if ($instrument == "") {
        $instrument = null;
    }if ($type == "") {
        $type = null;
    }



    $timeSlotQuery = "SELECT * FROM timeSlot ";
    $firstroundTimeSlot = true;
    if (is_string($skillLevel)) {
        if ($firstroundTimeSlot) {
            $timeSlotQuery .= "WHERE ";
            $firstroundTimeSlot = false;
        } else {
            $timeSlotQuery .= "AND ";
        }
        $timeSlotQuery .= "skillLevel='$skillLevel' ";
    }
    if (is_string($festivalDays)) {
        if ($firstroundTimeSlot) {
            $timeSlotQuery .= "WHERE ";
            $firstroundTimeSlot = false;
        } else {
            $timeSlotQuery .= "AND ";
        }
        $timeSlotQuery .= "festivalDays='$festivalDays' ";
    }




    $resourceQuery = "SELECT * FROM festivalResource ";
    $firstroundResource = true;
    if (is_string($skillLevel)) {
        if ($firstroundResource) {
            $resourceQuery .= "WHERE ";
            $firstroundResource = false;
        } else {
            $resourceQuery .= "AND ";
        }
        $resourceQuery .= "skillLevel='$skillLevel' ";
    }
    if (is_string($festivalDays)) {
        if ($firstroundResource) {
            $resourceQuery .= "WHERE ";
            $firstroundResource = false;
        } else {
            $resourceQuery .= "AND ";
        }
        $resourceQuery .= "(festivalDays='$festivalDays' OR festivalDays='both') ";
    }
    if (is_string($instrument)) {
        if ($firstroundResource) {
            $resourceQuery .= "WHERE ";
            $firstroundResource = false;
        } else {
            $resourceQuery .= "AND ";
        }
        $resourceQuery .= "instrument='$instrument' ";
    }
    if (is_string($type)) {
        if ($firstroundResource) {
            $resourceQuery .= "WHERE ";
            $firstroundResource = false;
        } else {
            $resourceQuery .= "AND ";
        }
        $resourceQuery .= "type='$type' ";
    }



    $registrationQuery = "SELECT * FROM musicRegistration ";
    if (is_string($festivalDays)) {
        $registrationQuery .= "WHERE ";

        $registrationQuery .= "festivalDays='$festivalDays' ";
    }

    $resultTimeSlot = mysql_query($timeSlotQuery);
    $resultResource = mysql_query($resourceQuery);
    $resultRegistration = mysql_query($registrationQuery);
    
    
    registrationMagic($resultTimeSlot,$resultResource,$resultRegistration, $festivalDays, $skillLevel, $instrument, $type, $studentId, $teacherId);
    
    
    
//    echo "$timeSlotQuery <br>$resourceQuery <br> $registrationQuery <br>";
//    
//    
//    $resultTimeSlot = mysql_query($timeSlotQuery);
//    $resultResource = mysql_query($resourceQuery);
//    $resultRegistration = mysql_query($registrationQuery);
//    $numRowsTimeSlots = mysql_num_rows($resultTimeSlot);
//    $numRowsResources = mysql_num_rows($resultResource);
//    $numRowsRegistration = mysql_num_rows($resultRegistration);
//    
//    
//    echo "- $numRowsTimeSlots - $numRowsResources - $numRowsRegistration -";
//
//    echo '<br>time slots <br>';
//    while ($temp1 = mysql_fetch_array($resultTimeSlot)) {
//        print_r($temp1);
//        for ($a = 0; $a < $numRowsTimeSlots; $a++) {
//            echo "<td $alt>$temp1[$a]</td>";
//        }
//    }
//    echo '<br>resources<br>';
//    while ($temp2 = mysql_fetch_array($resultResource)) {
//        print_r($temp2);
//        for ($a = 0; $a < $numRowsResources; $a++) {
//            echo "<td $alt>$temp2[$a]</td>";
//        }
//    }
//    echo '<br>registration<br>';
//    while ($temp3 = mysql_fetch_array($resultRegistration)) {
//        print_r($temp3);
//        for ($a = 0; $a < $numRowsRegistration; $a++) {
//            echo "<td $alt>$temp3[$a]</td>";
//        }
//    }
}
//===============================================================================
elseif ($action == "doregister") {
    
    //--checks to see if they have paid for the right number of students
    $numStudentsClear = getNumberOfClearStudents($teacherId);
    $numRegisteredCurrently = getNumberStudentsRegistered($teacherId);
    
    if (($numRegisteredCurrently) >= $numStudentsClear){
        echo "<p style=\"margin-top:10px;margin-bottom:10px;\">You have only paid for $numStudentsClear students to register. You will need to pay for additional students before you can register them. Please contact us if you have any questions or concerns or if you feel you have reached this message in error.</p>";
        die;
    }
    
    //--proceeds if all is good
    
    $sql = "INSERT INTO musicRegistration (timeSlotId, locationId, teacherId, studentId, festivalDays, skillLevel, instrument, type, startTime, endEnd, firstName, lastName, locationName) VALUES($timeSlotId, $locationId, $teacherId, $studentId, '$festivalDays', '$skillLevel', '$instrument', '$type', '$startTime', '$endEnd', '$firstname', '$lastname', '$locationName')";
    $result = mysql_query($sql);

    if ($result == TRUE) {
        echo "<p>$firstname $lastname has been registered for the festival.</p>";
        die;
    } else {
        $message = "Sorry but there was a problem registering $firstname $lastname for the festival. Please try again.";
        die;
    }
}
//===============================================================================
elseif ($action == 'showregistered') {
     $sql = "SELECT firstName, lastName, startTime, endEnd, locationName, festivalDays, skillLevel, instrument, type, registrationId FROM musicRegistration WHERE teacherId=$teacherId";

    $result = mysql_query($sql);

    if (!$result) {
        echo "<br> <p>There was an error finding your students that are registered. Please contact the website administrator for assistance.</p>";
        die;
    }

    //------------------get # of rows down
    $numRows = mysql_num_rows($result);

    if ($numRows == 0) {
        echo "<br> <p>You do not currently have any students that are registered for the festival. </p>";
        die;
    }

    //------------------get # of colums across
    $numFields = mysql_num_fields($result);

    //echo $numRows . "    "; 
    //echo $numFields  . "    ";;
    //------------------BUILDING THE TABLE
    echo "<table id=\"table-registered\" class=\"admin-festival-table\">";
    echo '<tr>';
    echo "<th>First Name</th>
            <th>Last Name</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Location</th>
            <th>Festival Day</th>
            <th>Skill Level</th>
            <th>Instrument</th>
            <th>Type</th>
            <th></th>";
    echo '</tr>';
    $count = 0;
    while ($row = mysql_fetch_array($result)) {
        if ($count % 2 == 0) {
            $alt = 'class="alt"';
        } else {
            $alt = "";
        }
        echo "<tr $alt>";
        for ($a = 0; $a < ($numFields - 1); $a++) {
            echo "<td $alt>$row[$a]</td>";
        }
        echo "<td class=\"pointer red\" onclick=\"unRegister('$row[9]','$row[0]','$row[1]')\">Unregister</td>";
        echo '</tr>';

        $count++;
    }
    echo "</table>";
    
}

//===============================================================================
elseif ($action == "unregister") {
    $query = "DELETE FROM musicRegistration WHERE registrationId=$registrationId";
    //echo "$first $last is the name <br>";
    //echo $query;
    //die;

    $result = mysql_query($query);

    if (!$result) {
        echo "<br> <p>There was an error deleting $firstname $lastname's registered time, please try again.  </p>";
        die;
    } else {
        echo "<p> $firstname $lastname's registered time has been deleted. </p>";
    }

    die;
}
//===============================================================================
else {
    include 'students.php';
}
    
    
    
    
    
    
    
    
    
    
    
    
    



