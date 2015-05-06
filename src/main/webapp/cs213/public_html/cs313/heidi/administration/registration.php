<!--
assign 10 page for cs313  - teacher page for admin
-->
<!DOCTYPE html>
<html>
    <head>
        <title>UVMTA</title>
        <?php include '/home/ercanbracks/public_html/cs313/heidi/module/head-info.php' ?>
        <script type="text/JavaScript">
            function displayRegistrated() {
                if (window.XMLHttpRequest)
                {  // code for IE7+, Firefox, Chrome, Opera, Safari
                    var ajaxObject = new XMLHttpRequest();
                }
                else
                {  // code for IE6, IE5
                    ajaxObject = new ActiveXObject("Microsoft.XMLHTTP");
                }    
                ajaxObject.onreadystatechange = function() {
                    if (ajaxObject.readyState  == 4 && ajaxObject.status == 200)
                    {
                        document.getElementById("table").innerHTML = ajaxObject.responseText;
                    }
                }
                ajaxObject.open("GET","index.php?action=showregistered",true);
                ajaxObject.send(null);
            }
  
            function move(type){
                var button = document.getElementById("search-button");
                var id = document.getElementById("registrationId");
                if(type == "search"){
                    document.getElementById("search-add").style.backgroundColor = "#40E0D0";
                    button.innerHTML = "Search";
                    id.disabled=false;
                    id.style.backgroundColor="";
                    document.getElementById("update-note").innerHTML = "";
          
                } else {
                    document.getElementById("search-add").style.backgroundColor = "#FFB6C1";
                    button.innerHTML = "Update";
                    id.value="";
                    id.style.backgroundColor="";
                    id.disabled=true;
                    document.getElementById("registrationId").value = "";
                    document.getElementById("timeSlotId").value = "";
                    document.getElementById("locationId").value = "";
                    document.getElementById("teacherId").value = "";
                    document.getElementById("studentId").value = "";
                    document.getElementById("firstName").value = "";
                    document.getElementById("lastName").value = "";
                    document.getElementById("festivalDays").value = "";
                    document.getElementById("skillLevel").value = "";
                    document.getElementById("instrument").value = "";
                    document.getElementById("type").value = "";
                    document.getElementById("locationName").value = "";
                    document.getElementById("startTime").value = "";
                    document.getElementById("endEnd").value = "";
                    document.getElementById("update-note").innerHTML = 'To update a teacher please click "update" on one of the records below.';
                }
            }
            
            
            function selectReg(registrationId, timeSlotId, locationId, teacherId, studentId, firstName, lastName, festivalDays, skillLevel, instrument, type, locationName, startTime, endEnd){
                
                var button = document.getElementById("search-button");
      
                document.getElementById("registrationId").value = registrationId;
                document.getElementById("timeSlotId").value = timeSlotId;
                document.getElementById("locationId").value = locationId;
                document.getElementById("teacherId").value = teacherId;
                document.getElementById("studentId").value = studentId;
                document.getElementById("firstName").value = firstName;
                document.getElementById("lastName").value = lastName;
                document.getElementById("festivalDays").value = festivalDays;
                document.getElementById("skillLevel").value = skillLevel;
                document.getElementById("instrument").value = instrument;
                document.getElementById("type").value = type;
                document.getElementById("locationName").value = locationName;
                document.getElementById("startTime").value = startTime;
                document.getElementById("endEnd").value = endEnd;
     
                var id = document.getElementById("registrationId");
                document.getElementById("search-add").style.backgroundColor = "#FFB6C1";
                button.innerHTML = "Update";
                id.style.backgroundColor="";
                id.disabled=true;
                document.getElementById("update-note").innerHTML = 'To update a teacher please click "update" on one of the records below.';
                window.scrollTo(800,200);
            }
            
            function deleteReg(id, first, last) {
                var check = window.confirm("Are you sure you want to delete " + first + " " + last + "'s time slot?");
      
                if (check){
                    if (window.XMLHttpRequest)
                    {  // code for IE7+, Firefox, Chrome, Opera, Safari
                        var ajaxObject = new XMLHttpRequest();
                    }
                    else
                    {  // code for IE6, IE5
                        ajaxObject = new ActiveXObject("Microsoft.XMLHTTP");
                    }    
                    ajaxObject.onreadystatechange = function() {
                        if (ajaxObject.readyState  == 4 && ajaxObject.status == 200)
                        {
                            document.getElementById("message").innerHTML = ajaxObject.responseText;
                            displayRegistrated()
                        }
                    }
                    ajaxObject.open("GET","index.php?action=deletestudenttimeslot&registrationid="+ id + "&firstname=" + first + "&lastname=" + last, true);
                    ajaxObject.send(null);
                }
        
            }
            
            function searchUpdateRegistration() {
                document.getElementById("update-note").innerHTML = "";
                document.getElementById("update-note").style.display = "none";
      
                var button = document.getElementById("search-button");
                
                var registrationId = document.getElementById("registrationId").value;
                var timeSlotId = document.getElementById("timeSlotId").value;
                var locationId = document.getElementById("locationId").value;
                var teacherId = document.getElementById("teacherId").value;
                var studentId = document.getElementById("studentId").value;
                var firstName = document.getElementById("firstName").value;
                var lastName = document.getElementById("lastName").value;
                var festivalDays = document.getElementById("festivalDays").value;
                var skillLevel = document.getElementById("skillLevel").value;
                var instrument = document.getElementById("instrument").value;
                var type = document.getElementById("type").value;
                var locationName = document.getElementById("locationName").value;
                var startTime = document.getElementById("startTime").value;
                var endEnd = document.getElementById("endEnd").value;
      
                //============IF ELSE===============
                if (button.innerHTML == "Search") {
                    
                    var str = "action=searchstudentregistration&registrationid=" + registrationId + "&timeslotid=" + timeSlotId + "&locationid=" + locationId + "&teacherid=" + teacherId + "&studentid=" + studentId + "&firstname=" + firstName + "&lastname=" + lastName + "&festivaldays=" + festivalDays + "&skilllevel=" + skillLevel + "&instrument=" + instrument + "&type=" + type + "&locationname=" + locationName + "&starttime=" + startTime + "&endend=" + endEnd; 
                
                }
            
                else {
                    //for the update
                    if (registrationId == "") {
                        document.getElementById("update-note").innerHTML = "<p>Please select one of the records below to update it.</p>";
                        document.getElementById("update-note").style.display = "inherit";
                        return;   
                    }
                    if (notValid()) {
                        document.getElementById("update-note").innerHTML = "<p>All fields are required.</p>";
                        document.getElementById("update-note").style.display = "inherit";
                        return;
                        
                    }
                    
                    var str = "action=updatestudentregistration&registrationid=" + registrationId + "&timeslotid=" + timeSlotId + "&locationid=" + locationId + "&teacherid=" + teacherId + "&studentid=" + studentId + "&firstname=" + firstName + "&lastname=" + lastName + "&festivaldays=" + festivalDays + "&skilllevel=" + skillLevel + "&instrument=" + instrument + "&type=" + type + "&locationname=" + locationName + "&starttime=" + startTime + "&endend=" + endEnd; 
                }
                //=====AJAX==================
                if (window.XMLHttpRequest)
                {  // code for IE7+, Firefox, Chrome, Opera, Safari
                    var ajaxObject = new XMLHttpRequest();
                }
                else
                {  // code for IE6, IE5
                    ajaxObject = new ActiveXObject("Microsoft.XMLHTTP");
                }    
                ajaxObject.onreadystatechange = function() {
                    if (ajaxObject.readyState  == 4 && ajaxObject.status == 200)
                    {
                        document.getElementById("table").innerHTML = ajaxObject.responseText;
                    }
                }
                ajaxObject.open("GET","index.php?"+str,true);
                ajaxObject.send(null);
            }
            
            function clearFields() {
                document.getElementById("registrationId").value = "";
                document.getElementById("timeSlotId").value = "";
                document.getElementById("locationId").value = "";
                document.getElementById("teacherId").value = "";
                document.getElementById("studentId").value = "";
                document.getElementById("firstName").value = "";
                document.getElementById("lastName").value = "";
                document.getElementById("festivalDays").value = "";
                document.getElementById("skillLevel").value = "";
                document.getElementById("instrument").value = "";
                document.getElementById("type").value = "";
                document.getElementById("locationName").value = "";
                document.getElementById("startTime").value = "";
                document.getElementById("endEnd").value = "";
            }
            
            function notValid () {
                var timeSlotId = document.getElementById("timeSlotId").value;
                var locationId = document.getElementById("locationId").value;
                var teacherId = document.getElementById("teacherId").value;
                var studentId = document.getElementById("studentId").value;
                var firstName = document.getElementById("firstName").value;
                var lastName = document.getElementById("lastName").value;
                var festivalDays = document.getElementById("festivalDays").value;
                var skillLevel = document.getElementById("skillLevel").value;
                var instrument = document.getElementById("instrument").value;
                var type = document.getElementById("type").value;
                var locationName = document.getElementById("locationName").value;
                var startTime = document.getElementById("startTime").value;
                var endEnd = document.getElementById("endEnd").value;
                
                if (timeSlotId == "" || locationId == "" || teacherId == "" || studentId == "" || firstName == "" || lastName == "" || festivalDays == "" || skillLevel == "" || instrument == "" || type == "" || locationName == "" || startTime == "" || endEnd == "") {
                    return true;
                } else {
                    return false;
                }
            }
        </script>

    </head>
    <body onload="displayRegistrated()">
        <div id="wrapper">
            <header>
                <?php include '/home/ercanbracks/public_html/cs313/heidi/module/header.php' ?>
            </header>
            <nav>
                <?php include '/home/ercanbracks/public_html/cs313/heidi/module/nav.php' ?>
            </nav>

            <div id="content">
                <h1>Currently Registered Time Slots</h1>

                <div id="add-update-festivals-div">
                    <div id="change">
                        <div id="search-add">
                            <ul>
                                <li id="search" onclick="move('search')">Search</li>
                                <li id="update" onclick="move('update')">Update</li>
                            </ul>
                            <!--
                            registrationId
                            timeSlotId
                            locationId
                            teacherId
                            studentId
                            firstName
                            lastName
                            festivalDays
                            skillLevel
                            instrument
                            type
                            locationName
                            startTime
                            endEnd
                            -->

                            <div>
                                <div>
                                    <div id="festivals-div-left">

                                        <label for="registrationId">Registration Id:</label><br>
                                        <input type="text" id="registrationId" size="50" ><br>
                                        <label for="timeSlotId">Time Slot Id:</label><br>
                                        <input type="text" id="timeSlotId" size="50" ><br>
                                        <label for="locationId">Location Id:</label><br>
                                        <input type="text" id="locationId" size="50" ><br>
                                        <label for="teacherId">Teacher Id:</label><br>
                                        <input type="text" id="teacherId" size="50" ><br>
                                        <label for="studentId">Student Id:</label><br>
                                        <input type="text" id="studentId" size="50" ><br>
                                        <label for="firstName">First Name:</label><br>
                                        <input type="text" id="firstName" size="50" ><br>
                                        <label for="lastName">Last Name:</label><br>
                                        <input type="text" id="lastName" size="50" ><br>
                                    </div>
                                    <div id="festivals-div-right">
                                        <label for="skillLevel">Festival Days:</label><br>
                                        <select id="festivalDays">
                                            <option value="main">Main Day</option>
                                            <option value="alternate">Alternate Day</option>
                                        </select><br>
                                        <label for="skillLevel">Skill Level:</label><br>
                                        <select id="skillLevel">
                                            <option value="all">All Levels Room</option>
                                            <option value="beginner-intermediat">Beginner/Intermediate</option>
                                            <option value="advanced"> Advanced </option>
                                        </select><br>
                                        <label for="instrument">Instrument:</label><br>
                                        <select id="instrument">
                                            <option value="piano">Piano</option>
                                            <option value="vocal">Vocal</option>
                                            <option value="string"> String </option>
                                            <option value="woodwind"> Woodwind </option>
                                            <option value="brass"> Brass </option>
                                            <option value="percussion"> Percussion </option>
                                        </select><br>
                                        <label for="type">Type of performance:</label><br>
                                        <select id="type">
                                            <option value="solo">Solo</option>
                                            <option value="duet">Duet</option>
                                            <option value="ensemble">Ensemble</option>
                                        </select><br>

                                        <label for="locationName">Location Name:</label><br>
                                        <input type="text" id="locationName" size="50" ><br>
                                        <label for="startTime">Start Time:</label><br>
                                        <input type="text" id="startTime" size="50" ><br>
                                        <label for="endEnd">End Time:</label><br>
                                        <input type="text" id="endEnd" size="50" ><br>

                                    </div>
                                </div>

                                <br>
                                <button id="search-button" class="button" type="button" onclick="searchUpdateRegistration()">Search</button>
                                <button id="clear-button" class="button" type="button" onclick="clearFields()">Clear Fields</button>
                                <button id="show-all-button" class="button" type="button" onclick="displayRegistrated()">Show All</button>
                                <button id="delete-all-button" class="button" type="button" onclick="deleteAll()">Delete All Registration</button>
                                <p id="update-note"></p>
                            </div>
                        </div>


                    </div>
                </div>
                <br>
                <br>
                <div id="message"></div>
                <div id="table" class="admin-teacher-table"></div>

            </div>
        </div>

    </body>
</html>
