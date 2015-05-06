<!--
assign 10 page for cs313  - template
-->
<!DOCTYPE html>
<html>
    <head>
        <title>UVMTA</title>
        <?php include '/home/ercanbracks/public_html/cs313/heidi/module/head-info.php' ?>
        <script  src="datepicker.js" type="text/JavaScript"></script>
        <script src="mootools.js" type="text/javascript"></script>
        <script type="text/JavaScript">
            
            function displayStudents() {
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
                        showRegistered();
                    }
                }
        
                ajaxObject.open("GET","index.php?action=displaystudents&teacherid=<?php echo $_SESSION['clientid']; ?>",true);
                ajaxObject.send(null);
                
                
            }
            
            function addStudent() {
                var first = document.getElementById("first").value;
                var last = document.getElementById("last").value;
                var birthdate = document.getElementById("new_day").value;
                
                if (first == '' || last == '' || birthdate == '') {
                    document.getElementById("message").innerHTML = "All fields are required";
                    return;
                }
                
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
                        displayStudents();
                    }
                }
     
                ajaxObject.open("GET","index.php?action=addstudent&teacherid=<?php echo $_SESSION['clientid']; ?>&firstname=" + first + "&lastname=" + last + "&birthdate=" + birthdate,true);
                ajaxObject.send(null);
                
                document.getElementById("message2").innerHTML = '';
            }
            
            
            
            window.addEvent('domready', function(){

                $$('input.DatePicker').each( function(el){
                    new DatePicker(el);
                });

            });
            
            function deleteStudent(id, first, last) {
                var check = window.confirm("Are you sure you want to delete " + first + " " + last + "?");
      
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
                            displayStudents();
                        }
                    }
                    ajaxObject.open("GET","index.php?action=delete&studentid="+ id + "&firstname=" + first + "&lastname=" + last, true);
                    ajaxObject.send(null);
                }
        
            }

            function registerStudent(id, firstname, lastname) {
                document.getElementById("register-student-h2").innerHTML = "Registration for: " + firstname + " " + lastname;
                document.getElementById("register-student-id").value = id;
                document.getElementById("register-student-firstname").value = firstname;
                document.getElementById("register-student-lastname").value = lastname;
                document.getElementById("register-student-div").style.display = 'inherit';
                document.getElementById("message").innerHTML = "";
            }
            
            function doneRegisterStudent() {
                document.getElementById("register-student-div").style.display = '';
                document.getElementById("registration-table").style.innerHTML = '';
            }
            
            function searchRegistration() {
                var festivalDays = document.getElementById("festivalDays").value;
                var skillLevel = document.getElementById("skillLevel").value;
                var instrument = document.getElementById("instrument").value;
                var type = document.getElementById("type").value;
                var studentId = document.getElementById("register-student-id").value; 
                
                var str = "&festivaldays=" + festivalDays + "&skilllevel=" + skillLevel + "&instrument=" + instrument + "&type=" + type + "&studentid=" + studentId;
                
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
                        document.getElementById("registration-table").innerHTML = ajaxObject.responseText;
                    }
                }
                ajaxObject.open("GET","index.php?action=searchregistration" + str, true);
                ajaxObject.send(null);
            }
            
            function doRegister(idTimeSlot, idResources, teacherId, studentId, festivalDays, skillLevel, instrument, type, startTime, endEnd, locationName){
                doneRegisterStudent();
                document.getElementById("registration-table").innerHTML = "";
                var firstname = document.getElementById("register-student-firstname").value;
                var lastname = document.getElementById("register-student-lastname").value;
                
                var str = "&timeslotid=" + idTimeSlot + "&locationid=" + idResources + "&teacherid=" + teacherId + "&studentid=" + studentId + "&festivaldays=" + festivalDays + "&skilllevel=" + skillLevel + "&instrument=" + instrument + "&type=" + type + "&starttime=" + startTime + "&endend=" + endEnd + "&firstname=" + firstname + "&lastname=" + lastname + "&locationname=" + locationName;
            
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
                        document.getElementById("message2").innerHTML = ajaxObject.responseText;
                        showRegistered();
                    }
                }
     
                ajaxObject.open("GET","index.php?action=doregister" + str,true);
                ajaxObject.send(null);
    



            }
            
            
            function showRegistered() {
                
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
                        document.getElementById("table-show-registered-students").innerHTML = ajaxObject.responseText;
                    }
                }
     
                ajaxObject.open("GET","index.php?action=showregistered&teacherid=<?php echo $_SESSION['clientid']; ?>",true);
                ajaxObject.send(null);
                
            }
            
            function unRegister(registrationId, firstName, lastName){
                var check = window.confirm("Are you sure you want to delete " + firstName + " " + lastName + "'s time slot?");
                if (!check){
                    return;
                }
                
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
                        document.getElementById("message2").innerHTML = ajaxObject.responseText;
                        showRegistered();
                    }
                }
     
                ajaxObject.open("GET","index.php?action=unregister&registrationid=" + registrationId + "&firstname=" + firstName + "&lastname=" + lastName,true);
                ajaxObject.send(null);
            }

        </script>

    </head>
    <body onload="displayStudents()">
        <div id="wrapper">
            <header>
                <?php include '/home/ercanbracks/public_html/cs313/heidi/module/header.php' ?>
            </header>
            <nav>
                <?php include '/home/ercanbracks/public_html/cs313/heidi/module/nav.php' ?>
            </nav>

            <div id="content">

                <h1>Your Students:</h1>

                <div id="addStudent-div">
                    <h2>Add a student</h2>
                    <label for="first" style="margin-right: 22px;">First Name:</label>
                    <label for="last" style="margin-right: 22px;">Last Name:</label>
                    <br>
                    <input type="text" name="first" id="first" size="15"> 
                    <input type="text"  name="last" id="last" size="15"> <br>
<!--                    <input type="date"  name="birthdate" id="birthdate" size="15">-->
                    <label for="new_day" style="margin-right: 30px;">Birthdate:</label>
                    <input id="new_day" name="new_day" type="text" class="DatePicker" alt="{
                           dayChars:3,
                           dayNames:['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                           daysInMonth:[31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
                           format:'yyyy-mm-dd',
                           monthNames:['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                           startDay:1,
                           yearOrder:'desc',
                           yearRange:90,
                           yearStart:2007
                           }" tabindex="1" value="2000-04-25" > <br>
                    <button type="button" class="button" onclick="addStudent()">Add</button>

                </div>

                <div id="message"></div>

                <div id="table"></div>

                <h1>Your Student's Registration:</h1>


                <div id="register-student-div">
                    <h2 id="register-student-h2"></h2>
                    <input type="hidden" id="register-student-id">
                    <input type="hidden" id="register-student-firstname">
                    <input type="hidden" id="register-student-lastname">

                    <label for="festivalDays" style="margin-right: 18px">Festival Days:</label>
                    <label for="skillLevel" style="margin-right: 85px">Skill Level:</label>
                    <label for="instrument" style="margin-right: 20px">Instrument:</label>
                    <label for="type" style="margin-right: 10px">Type of performance:</label> <br>


                    <select id="festivalDays" style="margin-right: 10px">
                        <option value="main">Main Day</option>
                        <option value="alternate">Alternate Day</option>
                    </select>                    
                    <select id="skillLevel" style="margin-right: 10px">
                        <option value="beginner-intermediat">Beginner/Intermediate</option>
                        <option value="advanced"> Advanced </option>
                        <option value="all">All Levels Room</option>
                    </select>
                    <select id="instrument" style="margin-right: 10px">
                        <option value="piano">Piano</option>
                        <option value="vocal">Vocal</option>
                        <option value="string"> String </option>
                        <option value="woodwind"> Woodwind </option>
                        <option value="brass"> Brass </option>
                        <option value="percussion"> Percussion </option>
                    </select>
                    <select id="type" style="margin-right: 10px">
                        <option value="solo">Solo</option>
                        <option value="duet">Duet</option>
                        <option value="ensemble">Ensemble</option>
                    </select> <br>
                    <button type="button" class="button" onclick="searchRegistration()">Search</button>
                    <button type="button" class="button" onclick="doneRegisterStudent()">Cancel</button>

                    <div id="registration-table"></div>
                </div>

                <div id="message2"></div>

                <div id="table-show-registered-students"></div>




            </div>
        </div>

    </body>
</html>
