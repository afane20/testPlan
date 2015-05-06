<?php
include '../model/loginValid.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Resources</title>
  <link rel="stylesheet" href="../css/uvmta.css" />  
  <script src="../js/jquery.js"></script>
  <script type="text/javascript" src = "../js/ajax.js"></script>
  <script type="text/javascript" src = "js/resource.js"></script>
  <script src="../js/app.min.js"></script>
  <script>
    $(window).resize(setHeight);
    setTimeout(setHeight, 1000);
    IEStyle();
  </script>
  <script type="text/javascript">

  function resourceList(sortBy)
  {
    
    if(arguments.length == 0)
    {
       sortBy = "building";
    }
    var queryString = "?sortBy=" + sortBy;  
    ajaxRequest("../model/resourceList.php",queryString,"resourceListDiv",1);
    var menuItem = document.getElementById('miResources');
    menuItem.className = menuItem.className + "menuSelected";
    $('tr').click(editResource);

    
  }

  function dropResource()
  {
     var resourceId = document.getElementById('resourceId').value;
     var timeslotsBuilt = document.getElementById('timeslotsBuilt').value;
     var building = document.getElementById('building').value;
     var room = document.getElementById('room').value;
     
     if (timeslotsBuilt == "N")
     {
        response = confirm("Delete resource  '" + building + " " + room + "'   Resource ID = " + resourceId);
        if ( response == true)
        {
           var queryString = "?resourceId=" + resourceId + "&room=" + room + "&building=" + building
                           + "&timeslotsBuilt=" + timeslotsBuilt;
           ajaxRequest("../model/dropResource.php",queryString,"error",1);
           clearFormAndRefresh();
           $('#editBox').hide()
        }
    }
     else
     {
        alert("REMOVE is not allowed if timeslots have been generated for this resource!");
     }
  }


  function addResource()
  {

     var address = document.getElementById('address').value;
     var building = document.getElementById('building').value;
     var room = document.getElementById('room').value;
     var level = document.getElementById('level').value;
     var startTime = document.getElementById('startTime').value;
     var endTime = document.getElementById('endTime').value;
     var timeIncrement = document.getElementById('timeIncrement').value;
     var pianos = document.getElementById('pianos').value;
     var available = document.getElementById('available').value;
     var miscInfo = document.getElementById('miscInfo').value;
     var query = "&address=" + address + "&building=" + building + "&room=" + room +
             "&level=" + level + "&startTime=" + startTime + "&endTime=" + endTime +
             "&timeIncrement=" + timeIncrement + "&pianos=" + pianos + "&available=" + available + "&miscInfo=" + miscInfo;
     var query = query.replace(/ /g, "+");
     if (validateForm())
     {
        $('#editBox').hide()
        ajaxRequest("../model/addResource.php?", query,"error", 1)
        clearFormAndRefresh();
     }
  }


  function updateResource()
  {    
     var timeslotsBuilt = document.getElementById('timeslotsBuilt').value;
     if(timeslotsBuilt == "N")
     {
        var resourceId = document.getElementById('resourceId').value;
        var address = document.getElementById('address').value;
        var building = document.getElementById('building').value;
        var room = document.getElementById('room').value;
        var level = document.getElementById('level').value;
        var startTime = document.getElementById('startTime').value;
        var endTime = document.getElementById('endTime').value;
        var timeIncrement = document.getElementById('timeIncrement').value;
        var pianos = document.getElementById('pianos').value;
        var available = document.getElementById('available').value;
        var miscInfo = document.getElementById('miscInfo').value;
        var queryString = "resourceId=" + resourceId + "&address=" + address + "&building=" + building +
             "&room=" + room + "&level=" + level + "&startTime=" + startTime + "&endTime=" + endTime +
             "&timeIncrement=" + timeIncrement + "&pianos=" + pianos + "&available=" + available + "&miscInfo=" + miscInfo;
        queryString = queryString.replace(/ /g, "+");
        ajaxRequest("../model/updateResource.php?",queryString,"error",1);
        clearFormAndRefresh();
        $('#editBox').hide()             
     }     
     else
     {
         alert("MODIFY is not allowed, if timeslots have been generated for this resource!");
     }
  }

// reads the festivals and builds a select box with the festival name and if the active festival
function getFestivals()
{
   queryString = "";   // no query string needed
   ajaxRequest("../model/festivalSelect.php?",queryString,"festivalDropDown",1);   
}

// gets the selected festival and calls checkGenerate time slots
function selectFestival()
{
   var select = document.getElementById("festivalChoice");
   var festivalId = select.value;    // get festivalId of festival whose timeslots were selected to built
   checkGenerateTimeSlots(festivalId);
}

function checkGenerateTimeSlots(festivalId)
{
   var available = document.getElementById('available').value;
   if (available == "N")
   {
      alert("This resource is marked as \"Not Available\". \nTimeslots cannot be generated!");
      return;
   }

   var resourceId = document.getElementById('resourceId').value;
     // need code here to call "builtSlotsSelect.php"  and set the variable below correctly

   var queryString = "resourceId=" + resourceId + "&festivalId=" + festivalId;
   ajaxRequest("../model/builtSlotsSelect.php?",queryString,"okToBuildSlots",1);
   var okToGenerate = document.getElementById("okToBuildSlots").innerHTML;   
   generateTimeSlots(festivalId,resourceId,okToGenerate);
}

function generateTimeSlots(festivalId, resourceId, okToGenerate)
{
   if ( okToGenerate == "Y")
   {    
       var sortBy = 'building';

       var queryString = "?sortBy=" + sortBy + "&resourceId=" + resourceId + "&festivalId=" + festivalId;
       ajaxRequest("../model/generateTimeSlots.php",queryString,"error",1);

       clearFormAndRefresh();
       $('#editBox').hide()
       resourceList();       
   }
   else
   {
      alert("Timeslots have already been built for this resource!");
   }

   

}

  function showAddForm()
  {
     clearAddForm();
     document.getElementById('boxTitle').innerHTML = "Add a Resource";    
     document.getElementById('updateButton').style.display = "none";
     document.getElementById('addButton').style.display = "inline";
     document.getElementById('deleteButton').style.display = "none";
     //    document.getElementById('buildSlotsButton').style.display = "none";
      document.getElementById('festivalDropDown').style.display = "none";
     $('#editBox').show();
  }   

  function showModifyForm()
  {
     document.getElementById('boxTitle').innerHTML = "Modify a Resource";    
     document.getElementById('updateButton').style.display = "inline";
     document.getElementById('addButton').style.display = "none";
     document.getElementById('deleteButton').style.display = "inline";
     //    document.getElementById('buildSlotsButton').style.display = "inline";
       document.getElementById('festivalDropDown').style.display = "inline";
     $('#editBox').show();
     getFestivals();
  }  

  function clearAddForm()
  {
     document.getElementById('address').value = "";
     document.getElementById('building').value = "";
     document.getElementById('room').value = "";
     //   document.getElementById('level').value = "7";   // beg, early int, intermediate   
     //   document.getElementById('startTime').value = "08:00am";
     // document.getElementById('endTime').value = "05:00pm";
     document.getElementById('timeIncrement').value = 10;
     document.getElementById('pianos').value = 1;
     document.getElementById('available').value = "F";
     document.getElementById('miscInfo').value = "";
  }

  function clearFormAndRefresh()
  {
     clearAddForm();
     resourceList();
  }

 

  // displays an error in the "error message location i.e. <div id = "error">)
  function displayError(errMsg)
  {
     document.getElementById("error").innerHTML = errMsg;
  }

  function clearErrorField()
  {
    document.getElementById("error").innerHTML = "&nbsp;";
  }

  function validateForm()
  {
    if (document.getElementById("building").value != "" &&
        document.getElementById("level").value != "" &&
        document.getElementById("startTime").value != "" &&
        document.getElementById("endTime").value != "" &&
        document.getElementById("timeIncrement").value != "" &&
        document.getElementById("pianos").value != "" &&
        document.getElementById("available").value != "")
    {
       return true;
    }
    else
    {
       if (document.getElementById("building").value == "")
       {
          alert("Please enter the building name!");
          document.getElementById('building').focus();
       }
      return false;
    }  
  }

</script>
</head>

<body onload = "resourceList('building')">
<?php include("../menu.php"); ?>
    <p class = "center">
       <input id = "showFormA" class = "center" type="button"  value="Add Resource" onclick = "showAddForm()" />
    </p>
    <!-- div for error messages or user feedback -->
    <p class = "center" id = "error" style = "color: red"> &nbsp; </p>
<div id="addResource">
 <form id="editBox" class="editBox">
   <img src="../close.png" onclick="$('#editBox').hide()"/>
   <h2 id = "boxTitle"> Add a Resource </h2>
      <label style = "visibility: hidden" >Resource Id </label>
      <input type="text" id="resourceId" size = "3" maxlength = "3"
              style = "visibility: hidden"/>
      <label>Building / Home</label>
      <input type="text" id="building" size = "10" maxlength = "10" onfocus = "clearErrorField()"/>
      <label>Room #</label>
      <input type="text" id="room" size = "10" maxlength = "10"/>
      <label>Performance Level</label>
          <select id = "level" name = "level">
              <option value = "1">beginners only</option>
              <option value = "2">early intermediate only</option>
              <option value = "3">beginners & early intermediate</option>
              <option value = "4">intermediate only</option>
              <option value = "7" selected = "selected" >beginner & early inter & inter</option>
              <option value = "8">late intermediate only</option>
              <option value = "12">intermediate & late intermediate</option>
              <option value = "16">pre-advanced only</option>
              <option value = "32">advanced only</option>
              <option value = "48">pre-advanced & advanced</option>
              <option value = "63">All Levels</option>
          </select>
      <label>Start Time</label>
          <select id = "startTime">
              <option value = "8:00am" selected = "selected" > 8:00am</option>
              <option value = "8:30am" >8:30am</option>
              <option value = "9:00am" >9:00am</option>
              <option value = "9:30am" >9:30am</option>
              <option value = "10:00am" >10:00am</option>
              <option value = "10:30am" >10:30am</option>
              <option value = "11:00am" >11:00am</option>
              <option value = "11:30am" >11:30am</option>
              <option value = "12:00pm" >12:00pm</option>
              <option value = "12:30pm" >12:30pm</option>
              <option value = "1:00pm" >1:00pm</option>
              <option value = "1:30pm" >1:30pm</option>
              <option value = "2:00pm" >2:00pm</option>
              <option value = "2:30pm" >2:30pm</option>
              <option value = "3:00pm" >3:00pm</option>
              <option value = "3:30pm" >3:30pm</option>
              <option value = "4:00pm" >4:00pm</option>
              <option value = "5:00pm" >5:00pm</option>
              <option value = "5:30pm" >5:30pm</option>
              <option value = "6:00pm" >6:00pm</option>
              <option value = "6:30pm" >6:30pm</option>
              <option value = "7:00pm" >7:00pm</option>
              <option value = "7:30pm" >7:30pm</option>
              <option value = "8:00pm" >8:00pm</option>
              <option value = "8:30pm" >8:30pm</option>
              <option value = "9:00pm" >9:00pm</option>
          </select>

      <label>End Time</label>
          <select id = "endTime">
              <option value = "8:00am"> 8:00am</option>
              <option value = "8:30am" >8:30am</option>
              <option value = "9:00am" >9:00am</option>
              <option value = "9:30am" >9:30am</option>
              <option value = "10:00am" >10:00am</option>
              <option value = "10:30am" >10:30am</option>
              <option value = "11:00am" >11:00am</option>
              <option value = "11:30am" >11:30am</option>
              <option value = "12:00pm" >12:00pm</option>
              <option value = "12:30pm" >12:30pm</option>
              <option value = "1:00pm" >1:00pm</option>
              <option value = "1:30pm" >1:30pm</option>
              <option value = "2:00pm" >2:00pm</option>
              <option value = "2:30pm" >2:30pm</option>
              <option value = "3:00pm" >3:00pm</option>
              <option value = "3:30pm" >3:30pm</option>
              <option value = "4:00pm" >4:00pm</option>
              <option value = "5:00pm" selected = "selected">5:00pm</option>
              <option value = "5:30pm" >5:30pm</option>
              <option value = "6:00pm" >6:00pm</option>
              <option value = "6:30pm" >6:30pm</option>
              <option value = "7:00pm" >7:00pm</option>
              <option value = "7:30pm" >7:30pm</option>
              <option value = "8:00pm" >8:00pm</option>
              <option value = "8:30pm" >8:30pm</option>
              <option value = "9:00pm" >9:00pm</option>
          </select>            

      <label>Timeslot Inc</label>
          <select id = "timeIncrement"  name = "timeIncrement">
              <option value = "5" > 5 min</option>
              <option value = "6" >6 min</option>
              <option value = "7" >7 min</option>
              <option value = "10" selected = "selected" >10 min</option>
              <option value = "12" >12 min</option>
              <option value = "15" >15 min</option>
              <option value = "20" >20 min</option>
              <option value = "30" >30 min</option>
              <option value = "60" >60 min</option>
          </select>

      <label># Pianos</label>
          <select id = "pianos"  name = "pianos">
              <option value = "0" >0</option>
              <option value = "1" selected = "selected">1</option>
              <option value = "2" >2</option>
          </select>
        
         <label>Building / Home Address</label>
          <textarea id="address" rows = "2" cols = "30"></textarea>
         <label>Miscellaneous Information</label>
          <textarea id="miscInfo" rows = "2" cols = "30"></textarea>
         <label>Resource Available</label>
            <select id = "available" name="available">
               <option value = "F" selected = "selected" >Festival Day</option>
               <option value = "A" >Alternate Day</option>
               <option value = "B" >Both Days</option>
               <option value = "N" >Not Available</option>
            </select>
     <input type="text" id="timeslotsBuilt" style = "display:none"/>
  
     <button id = "addButton" class = "center" type="button" value="Add Resource"
                  onclick = "addResource()" style = "display: inline;">Add Resource</button>
<!--
     <button id = "buildSlotsButton" class = "center" type="button" value="Build Timeslots"
                  onclick = "" style = "display: none">Build Resource Timeslots</button>
-->
     <span id = "festivalDropDown" style = "display: none" >Build Time Slots</span>

     <span id = "okToBuildSlots" style = "display: none">N</span>  <!-- for commuincation only - never visible -->

     <button id = "updateButton" class = "center" type="button" value="Modify Resource"
                  onclick = "updateResource()" style = "display: none">Modify Resource</button>
     <button id = "deleteButton" class = "center" type="button" value="Delete Resource"
                   onclick = "dropResource()"  style = "display: none">Delete Resource</button>
 </form>
</div> <!-- end hidden div-->

<div class="flex" id = "resourceListDiv" onmousedown = "clearErrorField()" ></div>

</body>
</html>   
