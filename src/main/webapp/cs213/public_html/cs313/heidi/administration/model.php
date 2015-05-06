<?php

//==================================
//=======MODEL FOR ADMIN============
//==================================


function createTeacherTable($query) {
    //------------------GETTING THE INFO / SENDING IT TO THE DATABASE / CHECKING FOR ERRORS  

    $specificsql = true;
    if (!isset($query)) {
        $query = "SELECT teacherId, firstName, lastName, email, phoneNumber, mailingAddress, duesPaid, rights, numStudentsClearToRegister FROM teacher ORDER BY teacherId";
        echo "<input type=\"hidden\"   value=\"SELECT * FROM teacher \" id=\"hiddenQuery\" >";
        $specificsql = false;
    }
    //$query = "SELECT * FROM students WHERE gender='M' ";
    $result = mysql_query($query);

    if (!$result) {
        echo "<br> <p>There was an error obtaining the list of teachers. Please try again. </p>";
        die;
    }

    //------------------get # of rows down
    $numRows = mysql_num_rows($result);

    if ($numRows == 0) {
        if ($specificsql) {
            echo "<br> <p>No teachers match that search.</p>";
        } else {
            echo "<br> <p >No teachers are currently registered. </p>";
        }
        die;
    }

    //------------------get # of colums across
    $numFields = mysql_num_fields($result);

    //echo $numRows . "    "; 
    //echo $numFields  . "    ";;
    //------------------BUILDING THE TABLE
    echo "<table>";
    echo '<tr>';
    echo "<th class=\"pointer\" onclick=\"orderBy('id')\">Teacher Id</th>
            <th class=\"pointer\" onclick=\"orderBy('first')\">First Name</th>
            <th class=\"pointer\" onclick=\"orderBy('last')\">Last Name</th>
            <th class=\"pointer\" onclick=\"orderBy('major')\">E-mail</th>
            <th class=\"pointer\" onclick=\"orderBy('birthdate')\">Phone</th>
            <th class=\"pointer\" onclick=\"orderBy('gender')\">Address</th>
            <th class=\"pointer\" onclick=\"orderBy('city')\">Dues Paid</th>
            <th class=\"pointer\" onclick=\"orderBy('state')\">Rights</th>
            <th class=\"pointer\" onclick=\"orderBy('studentsPaid')\">Students Paid</th>
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
            echo "<td>$row[$a]</td>";
        }
        echo "<td class=\"pointer\" onclick=\"selectUser('$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]', '$row[6]', '$row[7]', '$row[8]')\">Update</td>";
        echo "<td class=\"pointer red\" onclick=\"deleteUser('$row[0]', '$row[1]', '$row[2]')\">Delete</td>";
        echo '</tr>';
        $count++;
    }
    echo "</table>";
}

//==============================================================================

function createFestivalTable() {
    //------------------GETTING THE INFO / SENDING IT TO THE DATABASE / CHECKING FOR ERRORS  


    $query = "SELECT * FROM festival ORDER BY festivalId";

    $result = mysql_query($query);

    if (!$result) {
        echo "<br> <p>There was an error obtaining the list of festivals. Please try again. </p>";
        die;
    }

    //------------------get # of rows down
    $numRows = mysql_num_rows($result);

    if ($numRows == 0) {
        echo "<br> <p>There are currently no festivals in the system.</p>";
        die;
    }

    //------------------get # of colums across
    $numFields = mysql_num_fields($result);

    //echo $numRows . "    "; 
    //echo $numFields  . "    ";;
    //------------------BUILDING THE TABLE
    echo "<table>";
    echo '<tr>';
    echo "<th class=\"pointer\">Festival Id</th>
            <th class=\"pointer\">Festival Name</th>
            <th class=\"pointer\">Location</th>
            <th class=\"pointer\">Main Festival Day</th>
            <th class=\"pointer\">Alternate Festival Day</th>
            <th class=\"pointer\">Active</th>
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

        echo "<td>$row[0]</td>";
        echo "<td>$row[1]</td>";
        echo "<td>$row[2]</td>";
        echo "<td>$row[3]</td>";
        echo "<td>$row[6]</td>";
        echo "<td>$row[13]</td>";

        echo "<td class=\"pointer\" onclick=\"selectUser('$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]', '$row[6]', '$row[7]', '$row[8]', '$row[9]', '$row[10]', '$row[11]', '$row[12]', '$row[13]')\">Update</td>";
        echo "<td class=\"pointer red\" onclick=\"deleteUser('$row[0]', '$row[1]')\">Delete</td>";
        echo '</tr>';
        $count++;
    }
    echo "</table>";
}

//==============================================================================

function createTimeSlotsTable($query) {
    //------------------GETTING THE INFO / SENDING IT TO THE DATABASE / CHECKING FOR ERRORS  

    $specificsql = true;
    if (!isset($query)) {
        $query = "SELECT * FROM timeSlot ORDER BY startTime";
        echo "<input type=\"hidden\"   value=\"SELECT * FROM timeSlot \" id=\"hiddenQuery\" >";
        $specificsql = false;
    }




    //$query = "SELECT * FROM timeSlot ORDER BY startTime";

    $result = mysql_query($query);

    if (!$result) {
        echo "<br> <p>There was an error obtaining the list of time slots. Please try again. </p>";
        die;
    }

    //------------------get # of rows down
    $numRows = mysql_num_rows($result);

    if ($numRows == 0) {
        if ($specificsql) {
            echo "<br> <p>There are currently no time slots in the system that matched your search.</p>";
        } else {
            echo "<br> <p>There are currently no time slots in the system.</p>";
        }
        die;
    }

    //------------------get # of colums across
    $numFields = mysql_num_fields($result);

    //echo $numRows . "    "; 
    //echo $numFields  . "    ";;
    //------------------BUILDING THE TABLE
    echo "<table>";
    echo '<tr>';
    echo "<th class=\"pointer\">Time Slot Id</th>
            <th class=\"pointer\">Start Time</th>
            <th class=\"pointer\">End Time</th>
            <th class=\"pointer\">Skill Level</th>
            <th class=\"pointer\">Festival Day</th>
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

        echo "<td>$row[0]</td>";
        echo "<td>$row[1]</td>";
        echo "<td>$row[2]</td>";
        echo "<td>$row[3]</td>";
        echo "<td>$row[4]</td>";

        echo "<td class=\"pointer\" onclick=\"selectUser('$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]')\">Update</td>";
        echo "<td class=\"pointer red\" onclick=\"deleteUser('$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]')\">Delete</td>";
        echo '</tr>';
        $count++;
    }
    echo "</table>";
}

//==============================================================================

function createResourcesTable() {
    //------------------GETTING THE INFO / SENDING IT TO THE DATABASE / CHECKING FOR ERRORS  


    $query = "SELECT * FROM festivalResource ORDER BY locationId";

    $result = mysql_query($query);

    if (!$result) {
        echo "<br> <p>There was an error obtaining the list of festivals. Please try again. </p>";
        die;
    }

    //------------------get # of rows down
    $numRows = mysql_num_rows($result);

    if ($numRows == 0) {
        echo "<br> <p>There are currently no festivals resources in the system.</p>";
        die;
    }

    //------------------get # of colums across
    $numFields = mysql_num_fields($result);

    //echo $numRows . "    "; 
    //echo $numFields  . "    ";;
    //------------------BUILDING THE TABLE
    echo "<table>";
    echo '<tr>';
    echo "<th class=\"pointer\">Resource Id</th>
            <th class=\"pointer\">Location Name</th>
            <th class=\"pointer\">Festival Day</th>
            <th class=\"pointer\">Skill Level</th>
            <th class=\"pointer\">Instrument</th>
            <th class=\"pointer\">Type</th>
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

        echo "<td>$row[0]</td>";
        echo "<td>$row[1]</td>";
        echo "<td>$row[2]</td>";
        echo "<td>$row[3]</td>";
        echo "<td>$row[4]</td>";
        echo "<td>$row[5]</td>";

        echo "<td class=\"pointer\" onclick=\"selectUser('$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]')\">Update</td>";
        echo "<td class=\"pointer red\" onclick=\"deleteUser('$row[0]', '$row[1]')\">Delete</td>";
        echo '</tr>';
        $count++;
    }
    echo "</table>";
}

//==============================================================================

function checkActive() {
    $query = "SELECT * FROM festival WHERE active='true'";

    $result = mysql_query($query);

    if (!$result) {
        echo "<br> <p>There was an error obtaining the list of festivals. Please try again. </p>";
        die;
    }

    //------------------get # of rows down
    $numRows = mysql_num_rows($result);

    if ($numRows == 0) {
        return true;
        die;
    } else {
        return false;
    }
}

//==============================================================================

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

//==============================================================================

function customStudentTable($sql) {
    $result = mysql_query($sql);

    if (!$result) {
        echo "<br> <p>There was an error finding the students. Please contact the website administrator for assistance.</p>";
        die;
    }

    //------------------get # of rows down
    $numRows = mysql_num_rows($result);

    if ($numRows == 0) {
        echo "<br> <p>There are not any students that matched that search. </p>";
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

function createStudentTable() {
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

//==============================================================================

function customStudentRegistrationTable($sql) {
    
    $custom = true;
    
    if(!$sql){
        $sql = "SELECT registrationId, timeSlotId, locationId, teacherId, studentId, firstName, lastName, festivalDays, skillLevel, instrument, type, locationName, startTime, endEnd FROM musicRegistration";
        $custom = false;
        }
    
    $result = mysql_query($sql);

    if (!$result) {
        echo "<br> <p style >There was an error connecting with the database. Please contact the website administrator for assistance.</p>";
        die;
    }

    //------------------get # of rows down
    $numRows = mysql_num_rows($result);

    if ($numRows == 0) {
        if($custom){
        echo "<br> <p> None of the records match your search. </p>";
        } else {
            echo "<br> <p>There is currently no one registered for the festival. </p>";
        }
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