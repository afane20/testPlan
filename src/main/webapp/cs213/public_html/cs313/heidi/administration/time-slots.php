<!--
assign 10 page for cs313  - time slots
-->
<!DOCTYPE html>
<html>
    <head>
        <title>UVMTA</title>
        <?php include '/home/ercanbracks/public_html/cs313/heidi/module/head-info.php' ?>
        <script type="text/JavaScript">
            function getAllTimeSlots() {
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
                ajaxObject.open("GET","index.php?action=displaytimeslotstable",true);
                ajaxObject.send(null);
                
                
                var button = document.getElementById("search-button").innerHTML;
                var id = document.getElementById("timeSlotId");
                var startTime = document.getElementById("startTime");
                var endEnd = document.getElementById("endEnd");
                if(button == "Search"){
                    document.getElementById("search-add").style.backgroundColor = "#40E0D0";
                    button.innerHTML = "Search";
                    id.disabled=false;
                    id.style.backgroundColor="";
                    startTime.disabled=true;
                    startTime.style.backgroundColor="#bbb";
                    startTime.value="";
                    endEnd.disabled=true;
                    endEnd.style.backgroundColor="#bbb";
                    endEnd.value="";
                    
                    
                    document.getElementById("update-note").innerHTML = "";
          
                }
                
            }
            
            
            
            function move(type){
                var button = document.getElementById("search-button");
                var id = document.getElementById("timeSlotId");
                var startTime = document.getElementById("startTime");
                var endEnd = document.getElementById("endEnd");
                
                if(type == "search"){
                    document.getElementById("search-add").style.backgroundColor = "#40E0D0";
                    button.innerHTML = "Search";
                    id.disabled=false;
                    id.style.backgroundColor="";
                    startTime.disabled=true;
                    startTime.style.backgroundColor="#bbb";
                    startTime.value="";
                    endEnd.disabled=true;
                    endEnd.style.backgroundColor="#bbb";
                    endEnd.value="";
                    
                    
                    document.getElementById("update-note").innerHTML = "";
          
                } else if (type == "add") {
                    document.getElementById("search-add").style.backgroundColor = "#50A6C2";
                    button.innerHTML = "Add";
                    id.disabled=true;
                    id.style.backgroundColor="#bbb";
                    id.value="";
                    startTime.disabled=false;
                    startTime.style.backgroundColor="";
                    endEnd.disabled=false;
                    endEnd.style.backgroundColor="";
                    
                    
                    document.getElementById("update-note").innerHTML = "";
                } else {
                    //update
                    document.getElementById("search-add").style.backgroundColor = "#FFB6C1";
                    button.innerHTML = "Update";
                    id.value="";
                    id.style.backgroundColor="";
                    id.disabled=true;
                    startTime.disabled=false;
                    startTime.style.backgroundColor="";
                    endEnd.disabled=false;
                    endEnd.style.backgroundColor="";
                    document.getElementById("timeSlotId").value = "";
                    document.getElementById("startTime").value = "";
                    document.getElementById("endEnd").value = "";
                    document.getElementById("skillLevel").value = "beginner-intermediate";
                    document.getElementById("festivalDays").value = "main";
                    document.getElementById("update-note").innerHTML = "To update a record please select one of the records below.";
                }
            }
            
            function clearFields() {
                document.getElementById("timeSlotId").value = "";
                document.getElementById("startTime").value = "";
                document.getElementById("endEnd").value = "";
                document.getElementById("skillLevel").value = "all";
                document.getElementById("festivalDays").value = "main";
            }
            
            function addUpdateSearchTimeSlots() {
                var button = document.getElementById("search-button").innerHTML;
                
                var timeSlotId = document.getElementById("timeSlotId").value;
                var startTime = document.getElementById("startTime").value;
                var endEnd = document.getElementById("endEnd").value;
                var skillLevel = document.getElementById("skillLevel").value;
                var festivalDays = document.getElementById("festivalDays").value;
                
                var str = "";
                
                if(button == 'Update'){
                    str += "action=updatetimeslot";
                    
                    if(timeSlotId == "" || startTime == "" || endEnd == "" || skillLevel == "" || festivalDays == ""){
                        document.getElementById("update-note").innerHTML = "All fields are required.";
                        return;
                    }
                    
                } else if (button == 'Add'){
                    str += "action=addtimeslot";
                    
                    if(startTime == "" || endEnd == "" || skillLevel == "" || festivalDays == ""){
                        document.getElementById("update-note").innerHTML = "All fields are required. (Except for the ID)";
                        return;
                    }
                    
                } else {
                    //for the search
                    str += "action=searchtimeslot";
                }
                
                
                    
                str += '&timeslotid=' + timeSlotId + '&starttime=' + startTime + "&endend=" + endEnd + "&skilllevel=" + skillLevel + "&festivaldays=" + festivalDays;


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
     
                ajaxObject.open("GET","index.php?" + str,true);
                ajaxObject.send(null);
            }
            
            function deleteUser(timeSlotId, startTime, endEnd, skillLevel, festivalDays) {
                var check = window.confirm("Are you sure you want to delete the "  + startTime + " to " + endEnd + "  time slot for the " + skillLevel + " skill level on festival day: " + festivalDays + "?");
      
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
                    ajaxObject.open("GET","index.php?action=deletetimeslot&festivalid=&timeslotid=" + timeSlotId + "&starttime=" + startTime + "&endend=" + endEnd + "&skilllevel=" + skillLevel + "&festivaldays=" + festivalDays, true);
                    ajaxObject.send(null);
                }
        
            }
            
            function selectUser(timeSlotId, startTime, endEnd, skillLevel, festivalDays){
                var button = document.getElementById("search-button");
      
                document.getElementById("timeSlotId").value = timeSlotId;
                document.getElementById("startTime").value = startTime;
                document.getElementById("endEnd").value = endEnd;
                document.getElementById("skillLevel").value = skillLevel;
                document.getElementById("festivalDays").value = festivalDays;
     
                var id = document.getElementById("timeSlotId");
                document.getElementById("search-add").style.backgroundColor = "#FFB6C1";
                button.innerHTML = "Update";
                id.style.backgroundColor="";
                id.disabled=true;
                document.getElementById("update-note").innerHTML = "To update a record please select one of the records below.";
                window.scrollTo(800,200);
            }
            
            function deleteAll() {
                var check = window.confirm("Are you sure you want to delete all time slots? (This action can not be undone)");
      
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
                    ajaxObject.open("GET","index.php?action=deletealltimeslots", true);
                    ajaxObject.send(null);
                }
        
            }
            
        </script>

    </head>
    <body onload="getAllTimeSlots()">
        <div id="wrapper">
            <header>
                <?php include '/home/ercanbracks/public_html/cs313/heidi/module/header.php' ?>
            </header>
            <nav>
                <?php include '/home/ercanbracks/public_html/cs313/heidi/module/nav.php' ?>
            </nav>

            <div id="content">
                <h1>Festival Time-Slots</h1>
                <p>Time slots for "Beginning/Intermediate", "Advanced", and "All Levels" must be added in separately.</p>  

                <div id="change">
                    <div id="search-add">
                        <ul>
                            <li id="search" onclick="move('search')">Search</li>
                            <li id="update" onclick="move('update')">Update</li>
                            <li id="add" onclick="move('add')">Add</li>
                        </ul>

                        <!-- 
                        
                        timeSlotId
                        startTime
                        endEnd
                        skillLevel
                        festivalDays
                        
                        -->


                        <div>
                            <label for="timeSlotId" style="margin-right: 5px;">Time Slot Id:</label>
                            <label for="startTime" style="margin-right: 22px;">Start Time:</label>
                            <label for="endEnd" style="margin-right: 22px;">End Time:</label>
                            <label for="skillLevel" style="margin-right: 82px;">Skill level:</label>
                            <label for="festivalDays" style="margin-right: 30px;">Festival day:</label><br>
                            <input type="text" id="timeSlotId" size="13"> 
                            <input type="text"  id="startTime" size="14"> 
                            <input type="text" id="endEnd" size="14">
                            <select id="skillLevel">
                                <option value="all">All Levels Room</option>
                                <option value="beginner-intermediat">Beginner/Intermediat</option>
                                <option value="advanced"> Advanced </option>
                            </select>
                            <select id="festivalDays">
                                <option value="main">Main Day</option>
                                <option value="alternate">Alternate Day</option>
                            </select>

                            <br>




                            <button id="search-button" class="button" type="button" onclick="addUpdateSearchTimeSlots()">Search</button>
                            <button id="show-button" class="button" type="button" onclick="getAllTimeSlots()">Show All</button>
                            <button id="clear-button" class="button" type="button" onclick="clearFields()">Clear Fields</button>
                            <button id="clear-button" class="button" type="button" onclick="deleteAll()">Delete All Time Slots</button>
                            <p id="update-note"></p>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div id="message"></div>
                <div id="table" class="time-slots-table"></div>

            </div>
        </div>

    </body>
</html>
