<?php

/*
 * MODEL FOR TEACHER
 */

function getTeacherInfo($teacherId) {
    $sql = "SELECT * 
   FROM teacher 
   WHERE teacherId = '$teacherId'";

    $result = mysql_query($sql);
    $info = mysql_fetch_array($result);

    if (!empty($info) && $info[0] > 0) {
        return $info;
    } else {
        return FALSE;
    }
}

function updateUser($firstname, $lastname, $phone, $address, $teacherId) {
    $sql = "UPDATE teacher 
        SET firstName='$firstname', lastName='$lastname', phoneNumber='$phone', mailingAddress='$address' 
        WHERE teacherId ='$teacherId'";

    $result = mysql_query($sql);

    if ($result) {
        return 1;
    } else {
        return 0;
    }
}

function registrationMagic($resultTimeSlot, $resultResource, $resultRegistration, $festivalDays, $skillLevel, $instrument, $type, $studentId, $teacherId) {
    $numRowsTimeSlots = mysql_num_rows($resultTimeSlot);
    $numRowsResources = mysql_num_rows($resultResource);
    $numRowsRegistration = mysql_num_rows($resultRegistration);

    while ($rowTimeSlot = mysql_fetch_array($resultTimeSlot)) {
        $infoTimeSlot[] = $rowTimeSlot;
    }

    while ($rowResources = mysql_fetch_array($resultResource)) {
        $infoResource[] = $rowResources;
    }

    while ($rowRegistration = mysql_fetch_array($resultRegistration)) {
        $infoRegistration[] = $rowRegistration;
    }
//    echo "<br>TIME SLOT   num:$numRowsTimeSlots <br>";
//    print_r($infoTimeSlot);
//     echo "<br>RESOURCES   num: $numRowsResources<br>";
//    print_r($infoResource);
//     echo "<br>REGISTRATION   num: $numRowsRegistration<br>";
//    print_r($infoRegistration);
//    echo '<br><br><br>';

    $count = 0;
    echo '<table id="table-register-timeslot" class="admin-festival-table">';
    echo '<tr>';
    echo "<th>Festival Day</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Location</th>
            <th>Skill Level</th>
            <th>Instrument</th>
            <th>Type</th>
            <th></th>";
    echo '</tr>';




    for ($countTimeSlot = 0; $countTimeSlot < $numRowsTimeSlots; $countTimeSlot++) {
        $rowTimeSlot = $infoTimeSlot[$countTimeSlot];
        $idTimeSlot = $rowTimeSlot[0];
        $startTime = $rowTimeSlot[1];
        $endEnd = $rowTimeSlot[2];
        for ($countResources = 0; $countResources < $numRowsResources; $countResources++) {
            $rowResources = $infoResource[$countResources];
            $idResources = $rowResources[0];
            $locationName = $rowResources[1];
            $alreadyUsed = false;
            for ($countRegistration = 0; $countRegistration < $numRowsRegistration; $countRegistration++) {
                $rowRegistration = $infoRegistration[$countRegistration];
                $regIdTimeSlot = $rowRegistration[1];
                $regIdResources = $rowRegistration[2];
                $regFestivalDays = $rowRegistration[5];
                if ($idTimeSlot == $regIdTimeSlot && $idResources == $regIdResources && $regFestivalDays == $festivalDays) {
                    $alreadyUsed = true;
                }
            }
            if (!$alreadyUsed) {
                if ($count % 2 == 0) {
                    $alt = 'class="alt"';
                } else {
                    $alt = "";
                }
                $count++;
                //write the code for the inside of the table
                echo "<tr $alt><td>$festivalDays</td><td>$startTime</td><td>$endEnd</td><td>$locationName</td><td>$skillLevel</td><td>$instrument</td><td>$type</td><td class=\"pointer blue\" onclick=\"doRegister('$idTimeSlot','$idResources','$teacherId','$studentId','$festivalDays','$skillLevel','$instrument','$type','$startTime','$endEnd','$locationName')\">Register</td></tr>";
            }
        }
    }
}

function getNumberOfClearStudents($teacherId) {
    $query = "SELECT numStudentsClearToRegister FROM teacher WHERE teacherId=$teacherId";

    $result = mysql_query($query);
    $numRows = mysql_num_rows($result);

    if (!$result) {
        echo "<br> <p>There was an error connecting to the database. Please conntact the web adminitrator for assistance. </p>";
        die;
    }

    $row = mysql_fetch_array($result);
    return $row[0];
}

function earlyRegistrationOpen($festivalId) {
    $query = "SELECT earlyRegistrationLive FROM festival WHERE festivalId=$festivalId";

    $result = mysql_query($query);
    $numRows = mysql_num_rows($result);

    if (!$result || $numRows == 0) {
        echo "<br> <p>There was an error with the database. Please conntact the web adminitrator for assistance. </p>";
        die;
    }

    $row = mysql_fetch_array($result);
    return $row[0];
}

function normalRegistrationOpen($festivalId) {
    $query = "SELECT normalRegistrationLive FROM festival WHERE festivalId=$festivalId";

    $result = mysql_query($query);
    $numRows = mysql_num_rows($result);

    if (!$result || $numRows == 0) {
        echo "<br> <p>There was an error with the database. Please conntact the web adminitrator for assistance. </p>";
        die;
    }

    $row = mysql_fetch_array($result);
    return $row[0];
}

function getCurrentlyActiveFestival() {
    $query = "SELECT festivalId FROM festival WHERE active='true'";

    $result = mysql_query($query);

    if (!$result) {
        echo "<br> <p>There was an error connecting to the database. Please conntact the web adminitrator for assistance. </p>";
        die;
    }

    //------------------get # of rows down
    $numRows = mysql_num_rows($result);

    if ($numRows == 0) {
        return false;
        die;
    } else {
        $row = mysql_fetch_array($result);
        return $row[0];
    }
}

function getNumberStudentsRegistered($teacherId) {
    $query = "SELECT registrationId FROM musicRegistration WHERE teacherId='$teacherId'";

    $result = mysql_query($query);

    if (!$result) {
        echo "<br> <p>There was an error connecting to the database. Please conntact the web adminitrator for assistance. </p>";
        die;
    }

    //------------------get # of rows down
    $numRows = mysql_num_rows($result);

    
        return $numRows;
}

?>
