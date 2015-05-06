<?php

/*
 * CONTROLLER FOR ADMINISTRATOR
 */

if (!$_session) {
    session_start();
}

if ($_SESSION['clientrights'] < 20) {
    $error = "Sorry but you do not currently have the rights to view this page. If you are logged in and you feel like you have reached this page in error please contact the website's adminitrator.";
    include '/home/ercanbracks/public_html/cs313/heidi/module/error.php';
    die;
}

include '/home/ercanbracks/public_html/cs313/heidi/database/conn.php';
include '/home/ercanbracks/public_html/cs313/heidi/administration/model.php';
include '/home/ercanbracks/public_html/cs313/heidi/library.php';


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




if ($_GET['email']) {
    $emailaddress = $_GET['email'];
} elseif ($_POST['email']) {
    $emailaddress = $_POST['email'];
}

if ($_GET['phone']) {
    $phone = $_GET['phone'];
} elseif ($_POST['phone']) {
    $phone = $_POST['phone'];
}
if ($_GET['address']) {
    $mailingAddress = $_GET['address'];
} elseif ($_POST['address']) {
    $mailingAddress = $_POST['address'];
}
if ($_GET['numStudentsClearToRegister']) {
    $numStudentsClearToRegister = $_GET['numStudentsClearToRegister'];
} elseif ($_POST['numStudentsClearToRegister']) {
    $numStudentsClearToRegister = $_POST['numStudentsClearToRegister'];
}
if ($_GET['rights']) {
    $rights = $_GET['rights'];
} elseif ($_POST['rights']) {
    $rights = $_POST['rights'];
}
if ($_GET['duespaid']) {
    $duesPaid = $_GET['duespaid'];
} elseif ($_POST['duespaid']) {
    $duesPaid = $_POST['duespaid'];
}
//----------
if ($_GET['festivalid']) {
    $festivalId = $_GET['festivalid'];
} elseif ($_POST['festivalid']) {
    $festivalId = $_POST['festivalid'];
}
if ($_GET['name']) {
    $name = $_GET['name'];
} elseif ($_POST['name']) {
    $name = $_POST['name'];
}
if ($_GET['location']) {
    $location = $_GET['location'];
} elseif ($_POST['location']) {
    $location = $_POST['location'];
}
if ($_GET['mainday']) {
    $mainDay = $_GET['mainday'];
} elseif ($_POST['mainday']) {
    $mainDay = $_POST['mainday'];
}
if ($_GET['maintimeframe']) {
    $mainTimeFrame = $_GET['maintimeframe'];
} elseif ($_POST['maintimeframe']) {
    $mainTimeFrame = $_POST['maintimeframe'];
}
if ($_GET['maindaycost']) {
    $mainDayCost = $_GET['maindaycost'];
} elseif ($_POST['maindaycost']) {
    $mainDayCost = $_POST['maindaycost'];
}
if ($_GET['altday']) {
    $altDay = $_GET['altday'];
} elseif ($_POST['altday']) {
    $altDay = $_POST['altday'];
}
if ($_GET['alttimeframe']) {
    $altTimeFrame = $_GET['alttimeframe'];
} elseif ($_POST['alttimeframe']) {
    $altTimeFrame = $_POST['alttimeframe'];
}
if ($_GET['altdaycost']) {
    $altDayCost = $_GET['altdaycost'];
} elseif ($_POST['altdaycost']) {
    $altDayCost = $_POST['altdaycost'];
}
if ($_GET['earlyregistrationdate']) {
    $earlyRegistrationDate = $_GET['earlyregistrationdate'];
} elseif ($_POST['earlyregistrationdate']) {
    $earlyRegistrationDate = $_POST['earlyregistrationdate'];
}
if ($_GET['normalregistrationdate']) {
    $normalRegistrationDate = $_GET['normalregistrationdate'];
} elseif ($_POST['normalregistrationdate']) {
    $normalRegistrationDate = $_POST['normalregistrationdate'];
}
if ($_GET['earlyregistrationlive']) {
    $earlyRegistrationLive = $_GET['earlyregistrationlive'];
} elseif ($_POST['earlyregistrationlive']) {
    $earlyRegistrationLive = $_POST['earlyregistrationlive'];
}
if ($_GET['normalregistrationlive']) {
    $normalRegistrationLive = $_GET['normalregistrationlive'];
} elseif ($_POST['normalregistrationlive']) {
    $normalRegistrationLive = $_POST['normalregistrationlive'];
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
if ($_GET['type']) {
    $type = $_GET['type'];
} elseif ($_POST['type']) {
    $type = $_POST['type'];
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
if ($_GET['active']) {
    $active = $_GET['active'];
} elseif ($_POST['active']) {
    $active = $_POST['active'];
}
if ($_GET['registrationid']) {
    $registrationId = $_GET['registrationid'];
} elseif ($_POST['registrationid']) {
    $registrationId = $_POST['registrationid'];
}






//===============================================================================

if ($action == 'displayteacherstable') {
    createTeacherTable();
    die;
}

//===============================================================================
elseif ($action == "deleteteacher") {
    $query = "DELETE FROM teacher WHERE teacherId=$teacherId";
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
elseif ($action == "updateteacher") {
    $query = "UPDATE  teacher SET firstName=\"$firstname\", lastName=\"$lastname\", email=\"$emailaddress\", phoneNumber=\"$phone\", mailingAddress=\"$mailingAddress\", numStudentsClearToRegister=\"$numStudentsClearToRegister\", duesPaid=\"$duesPaid\", rights=\"$rights\" WHERE teacherId=\"$teacherId\";";

    $result = mysql_query($query);

    if (!$result) {
        echo "<br> <p> There was a problem connecting to the database. Please try again.</p>";
        die;
    } else {
        echo "<p> $firstname $lastname has been updated. </p>";
    }

    createTeacherTable();
}


//===============================================================================
elseif ($action == "searchteacher") {

    $teacherId = (int) $teacherId;
    $rights = (int) $rights;
    $numStudentsClearToRegister = (int) $numStudentsClearToRegister;

    if ($firstname == "") {
        $firstname = null;
    }if ($lastname == "") {
        $lastname = null;
    }if ($emailaddress == "") {
        $emailaddress = null;
    }if ($phone == "") {
        $phone = null;
    }if ($address == "") {
        $address = null;
    }if ($duesPaid == "") {
        $duesPaid = null;
    }



    $query = "SELECT teacherId, firstName, lastName, email, phoneNumber, mailingAddress, duesPaid, rights, numStudentsClearToRegister FROM teacher ";
    $firstround = true;
    if ($teacherId != 0) {
        $query .= "WHERE teacherId=$teacherId ";
        $firstround = false;
    }
    if (is_string($firstname)) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "firstName='$firstname' ";
    }
    if (is_string($lastname)) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "lastName='$lastname' ";
    }
    if (is_string($emailaddress)) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "email='$emailaddress' ";
    }
    if (is_string($phone)) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "phoneNumber='$phone' ";
    }
    if (is_string($mailingAddress)) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "mailingAddress='$mailingAddress' ";
    }
    if (is_string($duesPaid)) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "duesPaid='$duesPaid' ";
    }
    if ($rights != 0) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "rights='$rights' ";
    }
    if ($numStudentsClearToRegister != 0) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "numStudentsClearToRegister='$numStudentsClearToRegister' ";
    }


    //echo $query;

    echo "<input type=\"hidden\"   value=\"$query \" id=\"hiddenQuery\" >";

    createTeacherTable($query);
    die;
}



//===============================================================================
else if ($action == 'displayfestivaltable') {
    createFestivalTable();
    die;
}

//===============================================================================
elseif ($action == 'addfestival') {
    if ($active == "true") {
        if (!checkActive()) {
            echo "<p>You can only have one active festival at a time. Please make the appropriate changes and try again.</p>";
            createFestivalTable();
            die;
        }
    }
    $sql = "INSERT INTO festival (name, location, mainDay, mainTimeFrame, mainDayCost, altDay, altTimeFrame, altDayCost, earlyRegistrationDate, normalRegistrationDate, earlyRegistrationLive, normalRegistrationLive, active) VALUES ('$name', '$location', '$mainDay', '$mainTimeFrame', '$mainDayCost', '$altDay', '$altTimeFrame', '$altDayCost', '$earlyRegistrationDate', '$normalRegistrationDate', '$earlyRegistrationLive', '$normalRegistrationLive', '$active')";

    $result = mysql_query($sql);

    if ($result == TRUE) {
        echo "<p>The $name has been added.</p>";
    } else {
        echo "<p>Sorry, but there was a problem adding the $name. Please try again.</p>";
    }
    createFestivalTable();
    die;
}
//===============================================================================
elseif ($action == 'updatefestival') {
    if ($active == "true") {
        if (!checkActive()) {

            $getFestivalIdResult = getCurrentlyActiveFestival();

            if ($getFestivalIdResult != $festivalId) {
                echo "<p>You can only have one active festival at a time. Please make the appropriate changes and try again.</p>";
                createFestivalTable();
                die;
            }
        }
    }

    $sql = "UPDATE festival 
        SET name='$name', location='$location', mainDay='$mainDay', mainTimeFrame='$mainTimeFrame', mainDayCost='$mainDayCost', altDay='$altDay', altTimeFrame='$altTimeFrame', altDayCost='$altDayCost', earlyRegistrationDate='$earlyRegistrationDate', normalRegistrationDate='$normalRegistrationDate', earlyRegistrationLive='$earlyRegistrationLive', normalRegistrationLive='$normalRegistrationLive', active='$active'
        WHERE festivalId ='$festivalId'";



    $result = mysql_query($sql);

    if ($result == TRUE) {
        echo "<p>The $name has been updated.</p>";
    } else {
        echo "<p>Sorry, but there was a problem updating the $name. Please try again.</p>";
    }
    createFestivalTable();
    die;
}
//===============================================================================
elseif ($action == "deletefestival") {
    $query = "DELETE FROM festival WHERE festivalId=$festivalId";
    //echo "$first $last is the name <br>";
    //echo $query;
    //die;

    $result = mysql_query($query);

    if (!$result) {
        echo "<br> <p>There was an error deleting $name, please try again.  </p>";
        die;
    } else {
        echo "<p> $name has been deleted. </p>";
    }
    createFestivalTable();
    die;
}
//===============================================================================
else if ($action == 'displayresourcestable') {
    createResourcesTable();
    die;
}
//===============================================================================
elseif ($action == 'addresource') {

    $sql = "INSERT INTO festivalResource (locationName, festivalDays, skillLevel, instrument, type) VALUES ('$locationName', '$festivalDays', '$skillLevel', '$instrument', '$type')";

    $result = mysql_query($sql);

    if ($result == TRUE) {
        echo "<p>$locationName has been added.</p>";
    } else {
        echo "<p>Sorry, but there was a problem adding $locationName. Please try again.</p>";
    }
    createResourcesTable();
    die;
}
//===============================================================================
elseif ($action == "deleteresource") {
    $query = "DELETE FROM festivalResource WHERE locationId=$locationId";
    //echo "$first $last is the name <br>";
    //echo $query;
    //die;

    $result = mysql_query($query);

    if (!$result) {
        echo "<br> <p>There was an error deleting $locationName, please try again.  </p>";
        die;
    } else {
        echo "<p> $locationName has been deleted. </p>";
    }
    createResourcesTable();
    die;
}

//===============================================================================
elseif ($action == "deleteallresources") {


    if (!checkActive()) {
        echo "<p>You can not delete all your resources when one of the festivals is active. Please make the appropriate changes and try again.</p>";
        createResourcesTable();
        die;
    }


    $query = "DELETE FROM festivalResource";
    //echo "$first $last is the name <br>";
    //echo $query;
    //die;

    $result = mysql_query($query);

    if (!$result) {
        echo "<br> <p>There was an error deleting the resources, please try again.  </p>";
        die;
    } else {
        echo "<p> All of the resources have been deleted. </p>";
    }
    createResourcesTable();
    die;
}

//===============================================================================
elseif ($action == 'updatefestivalresources') {

    $sql = "UPDATE festivalResource 
        SET locationName='$locationName', festivalDays='$festivalDays', skillLevel='$skillLevel', instrument='$instrument', type='$type'
        WHERE locationId ='$locationId'";



    $result = mysql_query($sql);

    if ($result == TRUE) {
        echo "<p>$locationName has been updated.</p>";
    } else {
        echo "<p>Sorry, but there was a problem updating $locationName. Please try again.</p>";
    }
    createResourcesTable();
    die;
}
//===============================================================================
else if ($action == 'displaytimeslotstable') {
    createTimeSlotsTable();
    die;
}
//===============================================================================
elseif ($action == 'addtimeslot') {

    $sql = "INSERT INTO timeSlot (startTime, endEnd, skillLevel, festivalDays) VALUES ('$startTime', '$endEnd', '$skillLevel', '$festivalDays')";

    $result = mysql_query($sql);

    if ($result == TRUE) {
        echo "<p>The $startTime to $endEnd time slot for the '$skillLevel' skill level on festival day: '$festivalDays', has been added.</p>";
    } else {
        echo "<p>Sorry, but there was a problem adding the $startTime to $endEnd time slot for the '$skillLevel' skill level on festival day: '$festivalDays'. Please try again.</p>";
    }
    createTimeSlotsTable();
    die;
}
//===============================================================================
elseif ($action == "deletetimeslot") {
    $query = "DELETE FROM timeSlot WHERE timeSlotId=$timeSlotId";
    //echo "$first $last is the name <br>";
    //echo $query;
    //die;

    $result = mysql_query($query);

    if (!$result) {
        echo "<br> <p>Sorry, but there was a problem deleting the $startTime to $endEnd time slot for the '$skillLevel' skill level on festival day: '$festivalDays'. Please try again.  </p>";
        die;
    } else {
        echo "<p> The $startTime to $endEnd time slot for the '$skillLevel' skill level on festival day: '$festivalDays' has been deleted. </p>";
    }

    die;
}
//===============================================================================
elseif ($action == 'updatetimeslot') {

    $sql = "UPDATE timeSlot 
        SET startTime='$startTime', endEnd='$endEnd', skillLevel='$skillLevel', festivalDays='$festivalDays'
        WHERE timeSlotId ='$timeSlotId'";



    $result = mysql_query($sql);

    if ($result == TRUE) {
        echo "<p>The $startTime to $endEnd time slot for the '$skillLevel' skill level on festival day: '$festivalDays' has been updated.</p>";
    } else {
        echo "<p>Sorry, but there was a problem updating the $startTime to $endEnd time slot for the '$skillLevel' skill level on festival day: '$festivalDays'. Please try again.</p>";
    }
    createTimeSlotsTable();
    die;
}

//===============================================================================
elseif ($action == "deletealltimeslots") {

    if (!checkActive()) {
        echo "<p>You can not delete all your time slots when one of the festivals is active. Please make the appropriate changes and try again.</p>";
        createTimeSlotsTable();
        die;
    }



    $query = "DELETE FROM timeSlot";
    //echo "$first $last is the name <br>";
    //echo $query;
    //die;

    $result = mysql_query($query);

    if (!$result) {
        echo "<br> <p>There was an error deleting all the time slots, please try again.  </p>";
        die;
    } else {
        echo "<p> All of the time slots have been deleted. </p>";
    }
    createTimeSlotsTable();
    die;
}

//===============================================================================
elseif ($action == "searchtimeslot") {

    $timeSlotId = (int) $timeSlotId;

    if ($skillLevel == "") {
        $skillLevel = null;
    }if ($festivalDays == "") {
        $festivalDays = null;
    }



    $query = "SELECT * FROM timeSlot ";
    $firstround = true;
    if ($timeSlotId != 0) {
        $query .= "WHERE timeSlotId=$timeSlotId ";
        $firstround = false;
    }
    if (is_string($skillLevel)) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "skillLevel='$skillLevel' ";
    }
    if (is_string($festivalDays)) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "festivalDays='$festivalDays' ";
    }



    //echo $query;

    echo "<input type=\"hidden\"   value=\"$query \" id=\"hiddenQuery\" >";

    $query .= "ORDER BY startTime";

    createTimeSlotsTable($query);
    die;
}
//===============================================================================
elseif ($action == 'displaystudents') {

    $sql = "SELECT studentId, firstName, lastName, birthdate, teacherId FROM student";

    $result = mysql_query($sql);

    if (!$result) {
        echo "<br> <p>There was an error finding the students. Please contact the website administrator for assistance.</p>";
        die;
    }

    //------------------get # of rows down
    $numRows = mysql_num_rows($result);

    if ($numRows == 0) {
        echo "<br> <p>There are not currently any students added. </p>";
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
            <th>Teacher Id</th>
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
        echo "<td class=\"pointer\" onclick=\"selectStudent('$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]')\">Update</td>";
        echo "<td class=\"pointer red\" onclick=\"deleteStudent('$row[0]', '$row[1]', '$row[2]')\">Delete</td>";
        echo '</tr>';

        $count++;
    }
    echo "</table>";
}
//===============================================================================
elseif ($action == "searchstudent") {

    $studentId = (int) $studentId;
    $teacherId = (int) $teacherId;

    if ($firstname == "") {
        $firstname = null;
    }if ($lastname == "") {
        $lastname = null;
    }if ($birthdate == "") {
        $birthdate = null;
    }



    $query = "SELECT studentId, firstName, lastName, birthdate, teacherId FROM student ";
    $firstround = true;
    if ($teacherId != 0) {
        $query .= "WHERE teacherId=$teacherId ";
        $firstround = false;
    }
    if (is_string($firstname)) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "firstName='$firstname' ";
    }
    if (is_string($lastname)) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "lastName='$lastname' ";
    }
    if (is_string($birthdate)) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "birthdate='$birthdate' ";
    }
    if ($studentId != 0) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "studentId='$studentId' ";
    }


    //echo $query;

    echo "<input type=\"hidden\"   value=\"$query \" id=\"hiddenQuery\" >";

    customStudentTable($query);
    die;
}

//===============================================================================
elseif ($action == "updatestudent") {
    $query = "UPDATE  student SET firstName=\"$firstname\", lastName=\"$lastname\", birthdate=\"$birthdate\", teacherId=\"$teacherId\" WHERE studentId=\"$studentId\";";

    $result = mysql_query($query);

    if (!$result) {
        echo "<br> <p>There was an error connecting to the database, try again.</p>";
        die;
    } else {
        echo "<p> $firstname $lastname has been updated. </p>";
    }

    createStudentTable();
}
//===============================================================================
elseif ($action == "deletestudent") {
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
elseif ($action == 'showregistered') {
     $sql = "SELECT registrationId, timeSlotId, locationId, teacherId, studentId, firstName, lastName, festivalDays, skillLevel, instrument, type, locationName, startTime, endEnd FROM musicRegistration";

    $result = mysql_query($sql);

    if (!$result) {
        echo "<br> <p style >There was an error connecting with the database. Please contact the website administrator for assistance.</p>";
        die;
    }

    //------------------get # of rows down
    $numRows = mysql_num_rows($result);

    if ($numRows == 0) {
        echo "<br> <p> There is currently no one registered for the festival. </p>";
        die;
    }

    //------------------get # of colums across
    $numFields = mysql_num_fields($result);

    //echo $numRows . "    "; 
    //echo $numFields  . "    ";;
    //------------------BUILDING THE TABLE
    echo "<table class=\"admin-festival-table registered\">";
    echo '<tr>';
    echo "<th>Regis Id</th>
            <th>Time Slot Id</th>
            <th>Locat Id</th>
            <th>Teac Id</th>
            <th>Stud Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Fest Days</th>
            <th>Skill Level</th>
            <th>Instr</th>
            <th>Type</th>
            <th>Location</th>
            <th>Start</th>
            <th>End</th>
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
        for ($a = 0; $a < ($numFields); $a++) {
            echo "<td $alt>$row[$a]</td>";
        }
        echo "<td class=\"pointer\" onclick=\"selectReg('$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','$row[6]','$row[7]','$row[8]','$row[9]','$row[10]','$row[11]','$row[12]','$row[13]')\">Update</td>";
        echo "<td class=\"pointer red\" onclick=\"deleteReg('$row[0]','$row[5]','$row[6]')\">Delete</td>";
        echo '</tr>';

        $count++;
    }
    echo "</table>";
    
}
//===============================================================================
elseif ($action == "deletestudenttimeslot") {
    $query = "DELETE FROM musicRegistration WHERE registrationId=$registrationId";
    //echo "$first $last is the name <br>";
    //echo $query;
    //die;

    $result = mysql_query($query);

    if (!$result) {
        echo "<br> <p>There was an error deleting $firstname $lastname's time slot, please try again.  </p>";
        die;
    } else {
        echo "<p> $firstname $lastname's time slot has been deleted. </p>";
    }

    die;
}

//===============================================================================
elseif ($action == "updatestudentregistration") {
    
//    echo '$timeSlotId'.": $timeSlotId <br>";
//    echo '$locationId'.": $locationId <br>";
//    echo '$teacherId'.": $teacherId <br>";
//    echo '$studentId'.": $studentId <br>";
//    echo '$firstname'.": $firstname <br>";
//    echo '$lastname'.": $lastname <br>";
//    echo '$festivalDays'.": $festivalDays <br>";
//    echo '$skillLevel'.": $skillLevel <br>";
//    echo '$instrument'.": $instrument <br>";
//    echo '$type'.": $type <br>";
//    echo '$locationName'.": $locationName <br>";
//    echo '$startTime'.": $startTime <br>";
//    echo '$endEnd'.": $endEnd <br>";
//    echo '$registrationId'.": $registrationId <br>";
//    
    
    
    
    $query = "UPDATE  musicRegistration SET timeSlotId=$timeSlotId, locationId=$locationId, teacherId=$teacherId, studentId=$studentId, firstName='$firstname', lastName='$lastname', festivalDays='$festivalDays', skillLevel='$skillLevel', instrument='$instrument', type='$type', locationName='$locationName', startTime='$startTime', endEnd='$endEnd' WHERE registrationId=$registrationId;";

    $result = mysql_query($query);

    if (!$result) {
        echo "<br> <p> There was an error updating $firstname $lastname's time slot. Please try again,</p>";
    } else {
        echo "<p> $firstname $lastname's time slot has been updated. </p>";
    }
    
    customStudentRegistrationTable();

}
//===============================================================================
elseif ($action == "searchstudentregistration") {

    
    $registrationId = (int) $registrationId;
    $timeSlotId = (int) $timeSlotId;
    $locationId = (int) $locationId;
    $teacherId = (int) $teacherId;
    $studentId = (int) $studentId;

    if ($firstname == "") {
        $firstname = null;
    }if ($lastname == "") {
        $lastname = null;
    }if ($festivalDays == "") {
        $festivalDays = null;
    }if ($skillLevel == "") {
        $skillLevel = null;
    }if ($instrument == "") {
        $instrument = null;
    }if ($type == "") {
        $type = null;
    }if ($locationName == "") {
        $locationName = null;
    }if ($startTime == "") {
        $startTime = null;
    }if ($endEnd == "") {
        $endEnd = null;
    }



    $query = "SELECT registrationId, timeSlotId, locationId, teacherId, studentId, firstName, lastName, festivalDays, skillLevel, instrument, type, locationName, startTime, endEnd FROM musicRegistration ";
    $firstround = true;
    if ($teacherId != 0) {
        $query .= "WHERE teacherId=$teacherId ";
        $firstround = false;
    }
    if ($registrationId != 0) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "registrationId='$registrationId' ";
    }
    if ($timeSlotId != 0) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "timeSlotId='$timeSlotId' ";
    }
    if ($locationId != 0) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "locationId='$locationId' ";
    }
    if ($studentId != 0) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "studentId='$studentId' ";
    }
    if (is_string($firstname)) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "firstName='$firstname' ";
    }
    if (is_string($lastname)) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "lastName='$lastname' ";
    }
    if (is_string($festivalDays)) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "festivalDays='$festivalDays' ";
    }
    if (is_string($skillLevel)) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "skillLevel='$skillLevel' ";
    }
    if (is_string($instrument)) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "instrument='$instrument' ";
    }
    if (is_string($type)) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "type='$type' ";
    }
    if (is_string($locationName)) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "locationName='$locationName' ";
    }
    if (is_string($startTime)) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "startTime='$startTime' ";
    }
    if (is_string($endEnd)) {
        if ($firstround) {
            $query .= "WHERE ";
            $firstround = false;
        } else {
            $query .= "AND ";
        }
        $query .= "endEnd='$endEnd' ";
    }
    
    


    //echo $query;

    echo "<input type=\"hidden\"   value=\"$query \" id=\"hiddenQuery\" >";

    customStudentRegistrationTable($query);
    die;
}

//===============================================================================
//===============================================================================
elseif ($action == "teacherpage") {
    include 'teacher.php';
} elseif ($action == "festivalspage") {
    include 'festival.php';
}
//elseif ($action == "judgespage") {
//    include 'judge.php';
//}
elseif ($action == "registrationspage") {
    include 'registration.php';
} elseif ($action == "resourcespage") {
    include 'resources.php';
} elseif ($action == "studentpage") {
    include 'student.php';
} elseif ($action == "timeslots") {
    include 'time-slots.php';
}
//===============================================================================
else {
    include 'festival.php';
}
    
    
    
    
    
    
    
    
    
    
    
    
    



