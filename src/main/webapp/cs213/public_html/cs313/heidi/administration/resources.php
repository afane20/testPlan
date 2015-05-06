<!--
assign 10 page for cs313  - template
-->
<!DOCTYPE html>
<html>
    <head>
        <title>UVMTA</title>
        <?php include '/home/ercanbracks/public_html/cs313/heidi/module/head-info.php' ?>
        <script type="text/JavaScript">
            function getAllResources() {
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
                ajaxObject.open("GET","index.php?action=displayresourcestable",true);
                ajaxObject.send(null);
            }
            
            function move(type){
                var button = document.getElementById("search-button");
                var id = document.getElementById("locationId");
                if(type == "Add"){
                    document.getElementById("locationId").value = "";
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
                    document.getElementById("locationId").value = "";
                    document.getElementById("locationName").value = "";
                    document.getElementById("skillLevel").value = "all";
                    document.getElementById("instrument").value = "piano";
                    document.getElementById("festivalDays").value = "both";
                    document.getElementById("type").value = "solo";
                    
                    document.getElementById("update-note").innerHTML = 'To update a festival please click "update" on one of the records below.';
                }
            }
            
            function clearFields() {
                document.getElementById("locationId").value = "";
                document.getElementById("locationName").value = "";
                document.getElementById("skillLevel").value = "all";
                document.getElementById("instrument").value = "piano";
                document.getElementById("festivalDays").value = "both";
                document.getElementById("type").value = "solo";
            }
            
            function addUpdateFestival() {
                var button = document.getElementById("search-button").innerHTML;
                
                if(notValid()){
                    document.getElementById("update-note").innerHTML = 'All fields are required.';
                    return;
                }
                
                if(button == 'Update'){
                    update();
                    return;
                }
                
                
                var locationId = document.getElementById("locationId").value;
                var locationName = document.getElementById("locationName").value;
                var skillLevel = document.getElementById("skillLevel").value;
                var instrument = document.getElementById("instrument").value;
                var festivalDays = document.getElementById("festivalDays").value;
                var type = document.getElementById("type").value;
                    
                var str = '&locationid=' + locationId + '&locationname=' + locationName + "&skilllevel=" + skillLevel + "&instrument=" + instrument + "&festivaldays=" + festivalDays + '&type=' + type;


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
     
                ajaxObject.open("GET","index.php?action=addresource" + str,true);
                ajaxObject.send(null);
            }
            
            function deleteUser(id, name) {
                var check = window.confirm("Are you sure you want to delete" + name + "?");
      
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
                    ajaxObject.open("GET","index.php?action=deleteresource&locationid="+ id + "&locationname=" + name, true);
                    ajaxObject.send(null);
                }
        
            }
            
            function deleteAll() {
                var check = window.confirm("Are you sure you want to delete all resources? (This action can not be undone)");
      
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
                    ajaxObject.open("GET","index.php?action=deleteallresources", true);
                    ajaxObject.send(null);
                }
        
            }
            
             function notValid () {
                var locationName = document.getElementById("locationName").value;
                var skillLevel = document.getElementById("skillLevel").value;
                var instrument = document.getElementById("instrument").value;
                var festivalDays = document.getElementById("festivalDays").value;
                var type = document.getElementById("type").value;
                
                if (locationName == "" || skillLevel == "" || instrument == "" || festivalDays == "" || type == "") {
                    return true;
                } else {
                    return false;
                }
            }
            
            
            function selectUser(locationId, locationName, festivalDays, skillLevel, instrument, type){
                var button = document.getElementById("search-button");
      
                document.getElementById("locationId").value = locationId;
                document.getElementById("locationName").value = locationName;
                document.getElementById("skillLevel").value = skillLevel;
                document.getElementById("instrument").value = instrument;
                document.getElementById("festivalDays").value = festivalDays;
                document.getElementById("type").value = type;
     
                var id = document.getElementById("locationId");
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
      
                
                var locationId = document.getElementById("locationId").value;
                var locationName = document.getElementById("locationName").value;
                var skillLevel = document.getElementById("skillLevel").value;
                var instrument = document.getElementById("instrument").value;
                var festivalDays = document.getElementById("festivalDays").value;
                var type = document.getElementById("type").value;
               
                //for the update
                if (locationId == "") {
                    document.getElementById("update-note").innerHTML = "<p>Please select one of the records below to update it.</p>";
                    document.getElementById("update-note").style.display = "inherit";
                    return;   
                }
                if (notValid()) {
                    document.getElementById("update-note").innerHTML = "All fields are required.";
                    document.getElementById("update-note").style.display = "inherit";
                    return;
                        
                }
                var str = '&locationid=' + locationId + '&locationname=' + locationName + "&skilllevel=" + skillLevel + "&instrument=" + instrument + "&festivaldays=" + festivalDays + '&type=' + type; 
                
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
                ajaxObject.open("GET","index.php?action=updatefestivalresources"+str,true);
                ajaxObject.send(null);
            }
        </script>

    </head>
    <body onload="getAllResources()">
        <div id="wrapper">
            <header>
                <?php include '/home/ercanbracks/public_html/cs313/heidi/module/header.php' ?>
            </header>
            <nav>
                <?php include '/home/ercanbracks/public_html/cs313/heidi/module/nav.php' ?>
            </nav>

            <div id="content">
                <h1>Festival Resources (Room Locations)</h1>

                <div id="add-update-festivals-div">

                    <div id="change">
                        <div id="search-add">
                            <ul>
                                <li id="search" onclick="move('Add')">Add</li>
                                <li id="update" onclick="move('update')">Update</li>
                            </ul>
                            <!--
                            locationId
                            locationName
                            festivalDays
                            skillLevel
                            instrument
                            type
                            -->

                            <div>
                                <div>
                                    <div id="festivals-div-left">
                                        <label for="locationId">Location Id:</label> <br>
                                        <input type="text" id="locationId" size="50" disabled><br>
                                        <label for="locationName">Location Name:</label><br>
                                        <input type="text" id="locationName" size="50"><br>
                                        <label for="skillLevel">Festival Days:</label><br>
                                        <select id="festivalDays">
                                            <option value="both">Both Days</option>
                                            <option value="main">Main Day</option>
                                            <option value="alternate">Alternate Day</option>
                                        </select><br>

                                    </div>
                                    <div id="festivals-div-right">
                                        <label for="skillLevel">Skill Level:</label><br>
                                        <select id="skillLevel">
                                            <option value="all">All Levels Room</option>
                                            <option value="beginner-intermediate">Beginner/Intermediate</option>
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

                                    </div>
                                </div>

                                <br>
                                <button id="search-button" class="button" type="button" onclick="addUpdateFestival()">Add</button>
                                <button id="clear-button" class="button" type="button" onclick="clearFields()">Clear Fields</button>
                                <button id="delete-all-button" class="button" type="button" onclick="deleteAll()">Delete All Resources</button>
                                <p id="update-note"></p>
                            </div>
                        </div>


                    </div>

                    <div id="message"></div>

                    <div id="table" class="admin-festival-table">

                    </div>
                </div>

            </div>
        </div>

    </body>
</html>
