<!--
assign 10 page for cs313  - teacher page for admin
-->
<!DOCTYPE html>
<html>
    <head>
        <title>UVMTA</title>
        <?php include '/home/ercanbracks/public_html/cs313/heidi/module/head-info.php' ?>
        <script type="text/JavaScript">
            function getAllTeachers() {
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
                ajaxObject.open("GET","index.php?action=displayteacherstable",true);
                ajaxObject.send(null);
            }
  
            function move(type){
                var button = document.getElementById("search-button");
                var id = document.getElementById("teacherid");
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
                    document.getElementById("teacherid").value = "";
                    document.getElementById("firstname").value = "";
                    document.getElementById("lastname").value = "";
                    document.getElementById("email").value = "";
                    document.getElementById("phone").value = "";
                    document.getElementById("address").value = "";
                    document.getElementById("numStudentsClearToRegister").value = "";
                    document.getElementById("rights").value = "";
                    document.getElementById("duespaid").value = "";
                    document.getElementById("update-note").innerHTML = 'To update a teacher please click "update" on one of the records below.';
                }
            }
            
            
            function selectUser(id, first, last, email, phone, address, duesPaid, rights, numStudentsClearToRegister){
                var button = document.getElementById("search-button");
      
                document.getElementById("teacherid").value = id;
                document.getElementById("firstname").value = first;
                document.getElementById("lastname").value = last;
                document.getElementById("email").value = email;
                document.getElementById("phone").value = phone;
                document.getElementById("address").value = address;
                document.getElementById("numStudentsClearToRegister").value = numStudentsClearToRegister;
                document.getElementById("rights").value = rights;
                document.getElementById("duespaid").value = duesPaid;
     
                var id = document.getElementById("teacherid");
                document.getElementById("search-add").style.backgroundColor = "#FFB6C1";
                button.innerHTML = "Update";
                id.style.backgroundColor="";
                id.disabled=true;
                document.getElementById("update-note").innerHTML = "To update a record please select one of the records below.";
                window.scrollTo(800,200);
            }
            
            function deleteUser(id, first, last) {
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
                            getAllTeachers();
                        }
                    }
                    ajaxObject.open("GET","index.php?action=deleteteacher&teacherid="+ id + "&firstname=" + first + "&lastname=" + last, true);
                    ajaxObject.send(null);
                }
        
            }
            
            function searchAddUpdate() {
                document.getElementById("update-note").innerHTML = "";
                document.getElementById("update-note").style.display = "none";
      
                var button = document.getElementById("search-button");
                var id = document.getElementById("teacherid").value;
                var first = document.getElementById("firstname").value;
                var last = document.getElementById("lastname").value;
                var email = document.getElementById("email").value;
                var phone = document.getElementById("phone").value;
                var address = document.getElementById("address").value;
                var numStudentsClear = document.getElementById("numStudentsClearToRegister").value;
                var rights = document.getElementById("rights").value;
                var duesPaid = document.getElementById("duespaid").value;
      
                //============IF ELSE===============
                if (button.innerHTML == "Search") {
                    var str = "action=searchteacher&teacherid=" + id + "&firstname=" + first + "&lastname=" + last + "&email=" + email + "&phone=" + phone + "&address=" + address + "&numStudentsClearToRegister=" + numStudentsClear + "&rights=" + rights + "&duespaid=" + duesPaid; 
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
                    var str = "action=updateteacher&teacherid=" + id + "&firstname=" + first + "&lastname=" + last + "&email=" + email + "&phone=" + phone + "&address=" + address + "&numStudentsClearToRegister=" + numStudentsClear + "&rights=" + rights + "&duespaid=" + duesPaid; 
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
                document.getElementById("teacherid").value = "";
                document.getElementById("firstname").value = "";
                document.getElementById("lastname").value = "";
                document.getElementById("email").value = "";
                document.getElementById("phone").value = "";
                document.getElementById("address").value = "";
                document.getElementById("numStudentsClearToRegister").value = "";
                document.getElementById("rights").value = "";
                document.getElementById("duespaid").value = "";
            }
            
            function notValid () {
                var first = document.getElementById("firstname").value;
                var last = document.getElementById("lastname").value;
                var email = document.getElementById("email").value;
                var phone = document.getElementById("phone").value;
                var address = document.getElementById("address").value;
                var numStudentsClear = document.getElementById("numStudentsClearToRegister").value;
                var rights = document.getElementById("rights").value;
                var duesPaid = document.getElementById("duespaid").value;
                
                if (first == "" || last == "" || email == "" || phone == "" || address == "" || numStudentsClear == "" || rights == "" || duesPaid == "") {
                    return true;
                } else {
                    return false;
                }
            }
        </script>

    </head>
    <body onload="getAllTeachers()">
        <div id="wrapper">
            <header>
                <?php include '/home/ercanbracks/public_html/cs313/heidi/module/header.php' ?>
            </header>
            <nav>
                <?php include '/home/ercanbracks/public_html/cs313/heidi/module/nav.php' ?>
            </nav>

            <div id="content">
                <h1>Currently Registered Teachers</h1>

                <div id="change">
                    <div id="search-add">
                        <ul>
                            <li id="search" onclick="move('search')">Search</li>
                            <li id="update" onclick="move('update')">Update</li>
                        </ul>


                        <div>
                            <label for="teacherid" style="margin-right: 5px;">Teacher ID:</label>
                            <label for="firstname" style="margin-right: 22px;">First Name:</label>
                            <label for="lastname" style="margin-right: 22px;">Last Name:</label>
                            <label for="email" style="margin-right: 107px;">Email:</label>
                            <label for="phone" style="margin-right: 30px;">Phone:</label><br>
                            <input type="text" name="teacherid" id="teacherid" size="12"> 
                            <input type="text" name="firstname" id="firstname" size="15"> 
                            <input type="text"  name="lastname" id="lastname" size="15">
                            <input type="text"  name="email" id="email" size="25">
                            <input type="text"  name="phone" id="phone" size="11"><br>



                            <label for="address" style="margin-right: 109px;">Mailing Address:</label>
                            <label for="duespaid" style="margin-right: 5px;">Dues Paid:</label>
                            <label for="rights" style="margin-right: 36px;">Rights:</label>
                            <label for="numStudentsClearToRegister" style="margin-right: 20px;">Number of Student Clear to Register:</label><br>
                            <input type="text"  name="address" id="address" size="40">
            <!--                <input type="text"  name="duespaid" id="duespaid" size="11">-->

                            <select name="duespaid" id="duespaid" style="margin-right: 30px;">
                                <option value=""> </option>
                                <option value="Yes"> Yes</option>
                                <option value="No"> No </option>
                            </select>


<!--                <input type="text"  name="rights" id="rights" size="8">-->

                            <select name="rights" id="rights" width="8" style="margin-right: 10px;">
                                <option value=""></option>
                                <option value="10"> Teacher</option>
                                <option value="20"> Admin </option>
                            </select>

                            <input type="number"  name="numStudentsClearToRegister" id="numStudentsClearToRegister" size="5"> <br>


                            <button id="search-button" class="button" type="button" onclick="searchAddUpdate()">Search</button>
                            <button id="show-button" class="button" type="button" onclick="getAllTeachers()">Show All</button>
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
