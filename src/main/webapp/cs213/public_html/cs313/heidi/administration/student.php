<!--
assign 10 page for cs313  - teacher page for admin
-->
<!DOCTYPE html>
<html>
    <head>
        <title>UVMTA</title>
        <?php include '/home/ercanbracks/public_html/cs313/heidi/module/head-info.php' ?>
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
                ajaxObject.open("GET","index.php?action=displaystudents",true);
                ajaxObject.send(null);
            }
  
            function move(type){
                var button = document.getElementById("search-button");
                var id = document.getElementById("studentId");
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
                    document.getElementById("studentId").value = "";
                    document.getElementById("firstName").value = "";
                    document.getElementById("lastName").value = "";
                    document.getElementById("birthdate").value = "";
                    document.getElementById("teacherId").value = "";
                    document.getElementById("update-note").innerHTML = 'To update a teacher please click "update" on one of the records below.';
                }
            }
            
            
            function selectStudent(id, first, last, birthdate, teacherId){
                var button = document.getElementById("search-button");
      
                document.getElementById("studentId").value = id;
                document.getElementById("firstName").value = first;
                document.getElementById("lastName").value = last;
                document.getElementById("birthdate").value = birthdate;
                document.getElementById("teacherId").value = teacherId;
     
                var id = document.getElementById("studentId");
                document.getElementById("search-add").style.backgroundColor = "#FFB6C1";
                button.innerHTML = "Update";
                id.style.backgroundColor="";
                id.disabled=true;
                document.getElementById("update-note").innerHTML = "To update a record please select one of the records below.";
                window.scrollTo(800,200);
            }
            
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
                            displayStudents()
                        }
                    }
                    ajaxObject.open("GET","index.php?action=deletestudent&studentid="+ id + "&firstname=" + first + "&lastname=" + last, true);
                    ajaxObject.send(null);
                }
        
            }
            
            function searchAddUpdate() {
                document.getElementById("update-note").innerHTML = "";
                document.getElementById("update-note").style.display = "none";
      
                var button = document.getElementById("search-button");
                var id = document.getElementById("studentId").value;
                var first = document.getElementById("firstName").value;
                var last = document.getElementById("lastName").value;
                var birthdate = document.getElementById("birthdate").value;
                var teacherId = document.getElementById("teacherId").value;
      
                //============IF ELSE===============
                if (button.innerHTML == "Search") {
                    
                    var str = "action=searchstudent&studentid=" + id + "&firstname=" + first + "&lastname=" + last + "&birthdate=" + birthdate + "&teacherid=" + teacherId; 
                
                }
            
                else {
                    //for the update
                    if (id == "") {
                        document.getElementById("update-note").innerHTML = "<p>Please select one of the records below to update it.</p>";
                        document.getElementById("update-note").style.display = "inherit";
                        return;   
                    }
                    if (notValid()) {
                        document.getElementById("update-note").innerHTML = "<p>All fields are required.</p>";
                        document.getElementById("update-note").style.display = "inherit";
                        return;
                        
                    }
                    
                    var str = "action=updatestudent&studentid=" + id + "&firstname=" + first + "&lastname=" + last + "&birthdate=" + birthdate + "&teacherid=" + teacherId; 
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
                document.getElementById("studentId").value = "";
                document.getElementById("firstName").value = "";
                document.getElementById("lastName").value = "";
                document.getElementById("birthdate").value = "";
                document.getElementById("teacherId").value = "";
            }
            
            function notValid () {
                var first = document.getElementById("firstName").value;
                var last = document.getElementById("lastName").value;
                var birthdate = document.getElementById("birthdate").value;
                var teacherId = document.getElementById("teacherId").value;
                
                if (first == "" || last == "" || birthdate == "" || teacherId == "") {
                    return true;
                } else {
                    return false;
                }
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
                <h1>Currently Added Students</h1>

                <div id="change">
                    <div id="search-add">
                        <ul>
                            <li id="search" onclick="move('search')">Search</li>
                            <li id="update" onclick="move('update')">Update</li>
                        </ul>


                        <div>
                            <label for="studentId" style="margin-right: 10px;">Student ID:</label>
                            <label for="firstName" style="margin-right: 20px;">First Name:</label>
                            <label for="lastName" style="margin-right: 20px;">Last Name:</label>
                            <label for="birthdate" style="margin-right: 80px;">Birthdate:</label>
                            <label for="teacherId" style="margin-right: 30px;">Teacher ID:</label><br>
                            <input type="text" id="studentId" size="12"> 
                            <input type="text" id="firstName" size="15"> 
                            <input type="text"  id="lastName" size="15">
                            <input type="text" id="birthdate" size="25">
                            <input type="text" id="teacherId" size="11"><br>




                            <button id="search-button" class="button" type="button" onclick="searchAddUpdate()">Search</button>
                            <button id="show-button" class="button" type="button" onclick="displayStudents()">Show All</button>
                            <button id="clear-button" class="button" type="button" onclick="clearFields()">Clear Fields</button>
                            <p id="update-note"></p>
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
