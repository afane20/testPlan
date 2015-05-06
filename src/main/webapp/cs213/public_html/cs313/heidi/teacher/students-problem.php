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
                    }
                }
     
                ajaxObject.open("GET","index.php?action=displaystudents&teacherid=<?php echo $_SESSION['clientid']; ?>",true);
                ajaxObject.send(null);
            }
            
            function addStudent() {
                var first = document.getElementById("first").value;
                var last = document.getElementById("last").value;
                var birthdate = document.getElementById("birthdate").value;
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
            }
            
            
            
            window.addEvent('domready', function(){

                $$('input.DatePicker').each( function(el){
                    new DatePicker(el);
                });

            });


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

                <h1>Your Students</h1>

                <div id="addStudent-div">
                    <h2>Add a student</h2>
                    <label for="first" style="margin-right: 22px;">First Name:</label>
                    <label for="last" style="margin-right: 22px;">Last Name:</label>
                    <label for="birthdate" style="margin-right: 30px;">Birthdate:</label> <br>
                    <input type="text" name="first" id="first" size="15"> 
                    <input type="text"  name="last" id="last" size="15">
<!--                    <input type="date"  name="birthdate" id="birthdate" size="15">-->
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
                           }" tabindex="1" value="2000-04-25" />
                    <button type="button" class="button" onclick="addStudent()">Add</button>

                </div>

                <div id="message"></div>

                <div id="table">

                </div>


            </div>
        </div>

    </body>
</html>
