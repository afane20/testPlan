<!--
assign 10 page for cs313  - template
-->
<!DOCTYPE html>
<html>
    <head>
        <title>UVMTA</title>
        <?php include '/home/ercanbracks/public_html/cs313/heidi/module/head-info.php' ?>
        <script type="text/JavaScript">
            function getAllFestivals() {
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
                ajaxObject.open("GET","index.php?action=displayfestivaltable",true);
                ajaxObject.send(null);
            }
            
            function move(type){
                var button = document.getElementById("search-button");
                var id = document.getElementById("festivalId");
                if(type == "Add"){
                    document.getElementById("search-add").style.backgroundColor = "#40E0D0";
                    button.innerHTML = "Add";
                    id.disabled=true;
                    id.style.backgroundColor="";
                    document.getElementById("update-note").innerHTML = "";
          
                } else {
                    document.getElementById("search-add").style.backgroundColor = "#FFB6C1";
                    button.innerHTML = "Update";
                    id.value="";
                    id.style.backgroundColor="";
                    id.disabled=true;
                    document.getElementById("festivalId").value = "";
                    document.getElementById("name").value = "";
                    document.getElementById("location").value = "";
                    document.getElementById("mainDay").value = "";
                    document.getElementById("mainTimeFrame").value = "";
                    document.getElementById("mainDayCost").value = "";
                    document.getElementById("altDay").value = "";
                    document.getElementById("altTimeFrame").value = "";
                    document.getElementById("altDayCost").value = "";
                    document.getElementById("earlyRegistrationDate").value = "";
                    document.getElementById("normalRegistrationDate").value = "";
                    document.getElementById("earlyRegistrationLive").value = "";
                    document.getElementById("normalRegistrationLive").value = "";
                    document.getElementById("active").value = "";
                    document.getElementById("update-note").innerHTML = 'To update a festival please click "update" on one of the records below.';
                }
            }
            
            function addFestival() {
                var button = document.getElementById("search-button").innerHTML;
                document.getElementById("update-note").style.display = ""
                
                if(button == 'Update'){
                    update();
                    return;
                }
                
                if (notValid()) {
                    document.getElementById("update-note").innerHTML = "<p>All fields are required.</p>";
                    document.getElementById("update-note").style.display = "inherit";
                    return;
                        
                }
                
                var festivalId = document.getElementById("festivalId").value;
                var name = document.getElementById("name").value;
                var location = document.getElementById("location").value;
                var mainDay = document.getElementById("mainDay").value;
                var mainTimeFrame = document.getElementById("mainTimeFrame").value;
                var mainDayCost = document.getElementById("mainDayCost").value;
                var altDay = document.getElementById("altDay").value;
                var altTimeFrame = document.getElementById("altTimeFrame").value;
                var altDayCost = document.getElementById("altDayCost").value;
                var earlyRegistrationDate = document.getElementById("earlyRegistrationDate").value;
                var normalRegistrationDate = document.getElementById("normalRegistrationDate").value;
                var earlyRegistrationLive = document.getElementById("earlyRegistrationLive").value;
                var normalRegistrationLive = document.getElementById("normalRegistrationLive").value;
                var active = document.getElementById("active").value;
                    
                var str = '&festivalid=' + festivalId + '&name=' + name + "&location=" + location + "&mainday=" + mainDay + "&maintimeframe=" + mainTimeFrame + '&maindaycost=' + mainDayCost + '&altday=' + altDay + '&alttimeframe=' + altTimeFrame + '&altdaycost=' + altDayCost + '&earlyregistrationdate=' + earlyRegistrationDate + "&normalregistrationdate=" + normalRegistrationDate + '&earlyregistrationlive=' + earlyRegistrationLive + '&normalregistrationlive=' + normalRegistrationLive + '&active=' + active;


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
     
                ajaxObject.open("GET","index.php?action=addfestival" + str,true);
                ajaxObject.send(null);
            }
            
            
            function selectUser(festivalId, name, location, mainDay, mainTimeFrame, mainDayCost, altDay, altTimeFrame, altDayCost, earlyRegistrationDate, normalRegistrationDate, earlyRegistrationLive, normalRegistrationLive, active){
                var button = document.getElementById("search-button");
      
                document.getElementById("festivalId").value = festivalId;
                document.getElementById("name").value = name;
                document.getElementById("location").value = location;
                document.getElementById("mainDay").value = mainDay;
                document.getElementById("mainTimeFrame").value = mainTimeFrame;
                document.getElementById("mainDayCost").value = mainDayCost;
                document.getElementById("altDay").value = altDay;
                document.getElementById("altTimeFrame").value = altTimeFrame;
                document.getElementById("altDayCost").value = altDayCost;
                document.getElementById("earlyRegistrationDate").value = earlyRegistrationDate;
                document.getElementById("normalRegistrationDate").value = normalRegistrationDate;
                document.getElementById("earlyRegistrationLive").value = earlyRegistrationLive;
                document.getElementById("normalRegistrationLive").value = normalRegistrationLive;
                document.getElementById("active").value = active;
     
                var id = document.getElementById("festivalId");
                document.getElementById("search-add").style.backgroundColor = "#FFB6C1";
                button.innerHTML = "Update";
                id.style.backgroundColor="";
                id.disabled=true;
                document.getElementById("update-note").innerHTML = "To update a record please select one of the records below.";
                window.scrollTo(800,200);
            }
            
            
            
            function update() {
                document.getElementById("update-note").innerHTML = "";
                document.getElementById("update-note").style.display = "none";
                
                if (document.getElementById("festivalId").value == ""){
                    document.getElementById("update-note").innerHTML = "This record has NOT been updated. In order to to update a record please you must select one of the records below.";
                    document.getElementById("update-note").style.display = "inherit";
                    return;
                }
      
                
                var festivalId = document.getElementById("festivalId").value;
                var name = document.getElementById("name").value;
                var location = document.getElementById("location").value;
                var mainDay = document.getElementById("mainDay").value;
                var mainTimeFrame = document.getElementById("mainTimeFrame").value;
                var mainDayCost = document.getElementById("mainDayCost").value;
                var altDay = document.getElementById("altDay").value;
                var altTimeFrame = document.getElementById("altTimeFrame").value;
                var altDayCost = document.getElementById("altDayCost").value;
                var earlyRegistrationDate = document.getElementById("earlyRegistrationDate").value;
                var normalRegistrationDate = document.getElementById("normalRegistrationDate").value;
                var earlyRegistrationLive = document.getElementById("earlyRegistrationLive").value;
                var normalRegistrationLive = document.getElementById("normalRegistrationLive").value;
                var active = document.getElementById("active").value;
               
                //for the update
                if (festivalId == "") {
                    document.getElementById("update-note").innerHTML = "<p>Please select one of the records below to update it.</p>";
                    document.getElementById("update-note").style.display = "inherit";
                    return;   
                }
                if (notValid()) {
                    document.getElementById("update-note").innerHTML = "<p>All fields are required.</p>";
                    document.getElementById("update-note").style.display = "inherit";
                    return;
                        
                }
                var str = '&festivalid=' + festivalId + '&name=' + name + "&location=" + location + "&mainday=" + mainDay + "&maintimeframe=" + mainTimeFrame + '&maindaycost=' + mainDayCost + '&altday=' + altDay + '&alttimeframe=' + altTimeFrame + '&altdaycost=' + altDayCost + '&earlyregistrationdate=' + earlyRegistrationDate + "&normalregistrationdate=" + normalRegistrationDate + '&earlyregistrationlive=' + earlyRegistrationLive + '&normalregistrationlive=' + normalRegistrationLive + '&active=' + active; 
                
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
                ajaxObject.open("GET","index.php?action=updatefestival"+str,true);
                ajaxObject.send(null);
            }
            
            function clearFields() {
                document.getElementById("festivalId").value = "";
                document.getElementById("name").value = "";
                document.getElementById("location").value = "";
                document.getElementById("mainDay").value = "";
                document.getElementById("mainTimeFrame").value = "";
                document.getElementById("mainDayCost").value = "";
                document.getElementById("altDay").value = "";
                document.getElementById("altTimeFrame").value = "";
                document.getElementById("altDayCost").value = "";
                document.getElementById("earlyRegistrationDate").value = "";
                document.getElementById("normalRegistrationDate").value = "";
                document.getElementById("earlyRegistrationLive").value = "";
                document.getElementById("normalRegistrationLive").value = "";
                document.getElementById("active").value = "";
            }
            
            function notValid () {
                var button = document.getElementById("search-button");
                var name = document.getElementById("name").value;
                var location = document.getElementById("location").value;
                var mainDay = document.getElementById("mainDay").value;
                var mainTimeFrame = document.getElementById("mainTimeFrame").value;
                var mainDayCost = document.getElementById("mainDayCost").value;
                var altDay = document.getElementById("altDay").value;
                var altTimeFrame = document.getElementById("altTimeFrame").value;
                var altDayCost = document.getElementById("altDayCost").value;
                var earlyRegistrationDate = document.getElementById("earlyRegistrationDate").value;
                var normalRegistrationDate = document.getElementById("normalRegistrationDate").value;
                var earlyRegistrationLive = document.getElementById("earlyRegistrationLive").value;
                var normalRegistrationLive = document.getElementById("normalRegistrationLive").value;
                var active = document.getElementById("active").value;
                
                if (button == "" || name == "" || location == "" || mainDay == "" || mainTimeFrame == "" || mainDayCost == "" || altDay == "" || altTimeFrame == "" || altDayCost == "" || earlyRegistrationDate == "" || normalRegistrationDate == "" || earlyRegistrationLive == "" || normalRegistrationLive == "" || active == "") {
                    return true;
                } else {
                    return false;
                }
            }
            
            function deleteUser(id, name) {
                var check = window.confirm("Are you sure you want to delete the" + name + "?");
      
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
                            document.getElementById("table").innerHTML = ajaxObject.responseText;
                        }
                    }
                    ajaxObject.open("GET","index.php?action=deletefestival&festivalid="+ id + "&name=" + name, true);
                    ajaxObject.send(null);
                }
        
            }
        </script>

    </head>
    <body onload="getAllFestivals()">
        <div id="wrapper">
            <header>
                <?php include '/home/ercanbracks/public_html/cs313/heidi/module/header.php' ?>
            </header>
            <nav>
                <?php include '/home/ercanbracks/public_html/cs313/heidi/module/nav.php' ?>
            </nav>

            <div id="content">
                <h1>UVMTA's Festivals</h1>

                <div id="add-update-festivals-div">

                    <div id="change">
                        <div id="search-add">
                            <ul>
                                <li id="search" onclick="move('Add')">Add</li>
                                <li id="update" onclick="move('update')">Update</li>
                            </ul>
                            <!--festivalId
                            name
                            location
                            mainDay
                            mainTimeFrame
                            mainDayCost
                            altDay
                            altTimeFrame
                            altDayCost
                            earlyRegistrationDate
                            normalRegistrationDate
                            earlyRegistrationLive
                            normalRegistrationLive
                            active-->

                            <div>
                                <div>
                                    <div id="festivals-div-left">
                                        <label for="festivalId">Festival Id:</label> <br>
                                        <input type="text" id="festivalId" size="50" disabled><br>
                                        <label for="name">Festival Name:</label><br>
                                        <input type="text" id="name" size="50"><br>
                                        <label for="location">Location:</label><br>
                                        <input type="text" id="location" size="50"><br>
                                        <label for="mainDay">Main Festival Day:</label><br>
                                        <input type="text" id="mainDay" size="50"><br>
                                        <label for="mainTimeFrame">Main Day Time Frame:</label><br>
                                        <input type="text" id="mainTimeFrame" size="50"><br>
                                        <label for="mainDayCost">Main Day Price</label><br>
                                        <input type="text" id="mainDayCost" size="50"><br>
                                        <label for="altDay">Alternate Festival Day:</label><br>
                                        <input type="text" id="altDay" size="50"><br>
                                    </div>
                                    <div id="festivals-div-right">
                                        <label for="altTimeFrame">Alternate Day Time Frame:</label><br>
                                        <input type="text" id="altTimeFrame" size="50"><br>
                                        <label for="altDayCost">Alternate Day Price:</label><br>
                                        <input type="text" id="altDayCost" size="50"><br>
                                        <label for="earlyRegistrationDate">Early Registration Date:</label><br>
                                        <input type="text" id="earlyRegistrationDate" size="50"><br>
                                        <label for="normalRegistrationDate">Normal Registration Date:</label><br>
                                        <input type="text" id="normalRegistrationDate" size="50"><br>
                                        <label for="earlyRegistrationLive">Early Registration Live:</label><br>
                                        <select id="earlyRegistrationLive">
                                            <option value=""> </option>
                                            <option value="true"> True</option>
                                            <option value="false"> False </option>
                                        </select><br>
                                        <label for="normalRegistrationLive">Normal Registration Live:</label><br>
                                        <select id="normalRegistrationLive">
                                            <option value=""> </option>
                                            <option value="true"> True</option>
                                            <option value="false"> False </option>
                                        </select><br>
                                        <label for="active">Active:</label><br>
                                        <select id="active">
                                            <option value=""> </option>
                                            <option value="true"> True</option>
                                            <option value="false"> False </option>
                                        </select><br>
                                    </div>
                                </div>

                                <br>
                                <button id="search-button" class="button" type="button" onclick="addFestival()">Add</button>
                                <button id="clear-button" class="button" type="button" onclick="clearFields()">Clear Fields</button>
                                <p id="update-note"></p>
                            </div>
                        </div>


                    </div>

                    <div id="message"></div>

                    <div id="table" class="admin-festival-table">

                    </div>
                </div>
                </div>   <!-- added 3 divs-->
            </div>

                </body>
                </html>
