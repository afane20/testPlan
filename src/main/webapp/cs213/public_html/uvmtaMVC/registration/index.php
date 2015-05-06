<?php
   include '../model/loginValid.php';
   session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Festival Registration</title>
<link rel="stylesheet" type="text/css" href="../css/uvmta.css" />
<link rel="stylesheet" type="text/css" href="css/registration.css" /> 

<script src = "../js/jquery.js"></script>
<script src = "../js/app.min.js"></script>
<script type="text/javascript" src = "../js/ajax.js"></script>
<script type="text/javascript" src = "../js/ajaxGetFestival.js"></script>
<script type="text/javascript" src = "../js/ajaxGetRegistration.js"></script>    
<script>
    $(window).resize(setHeight);
    setTimeout(setHeight, 1000);
    IEStyle();
</script>
<script type="text/javascript">    


function saveEditReg() {
   $('#editRegBox').hide();
}

function exitEditReg() {
   $('#editRegBox').hide();
}

      
function registrationList(sortBy)
{
    
   if (arguments.length == 0)
   {
      sortBy = "performanceDate,time";
   }
   var festivalId = document.getElementById("festivalId").innerHTML;

   if (festivalId != 0)  //don't request the registration list if no "active" festivals
   {
     var queryString = "?festivalId=" + festivalId + "&sortBy=" + sortBy;
     ajaxRequest("../model/registrationList.php",queryString,"registrationList",1); 
   }
}

function getStudent1()
{
   var queryString = "";
   ajaxRequest("../model/studentSelect.php?",queryString,"student1",1);
}

function getPartner()
{
   var queryString = "";
   ajaxRequest("../model/partnerSelect.php?",queryString,"partner",1);
}

// stores available slots in the "register edit" dialog.
function eAvailableSlots()
{
   var sortOrder = document.getElementById("eSlotSortOrder").value
   var level = document.getElementById("eLevel").value;
   var performanceType = document.getElementById("ePerformanceType").value;
   var instrument = document.getElementById("eInstrument").value;
   var festivalDay = document.getElementById("eFestivalDay").value;  // 1 = festival day, 2 = alternate day
   var festivalId = document.getElementById("festivalId").innerHTML;
   var queryString = "?level=" + level + "&performanceType=" + performanceType + "&festivalDay=" + festivalDay +
       "&festivalId=" + festivalId + "&instrument=" + instrument + "&sortOrder=" + sortOrder + "&selectTagId=eSlots";
   queryString = queryString.replace(/ /g, "+");
   ajaxRequest("../model/availableSlots.php",queryString,"eAvailableSlots",1);
}

// stores available slots in the "register dialog"
function availableSlots()
{
   var sortOrder = document.getElementById("slotSortOrder").value
   var level = document.getElementById("level").value;
   var performanceType = document.getElementById("performanceType").value;
   var instrument = document.getElementById("instrument").value;
   var festivalDay = document.getElementById("festivalDay").value;  // 1 = festival day, 2 = alternate day
   var festivalId = document.getElementById("festivalId").innerHTML;
   var queryString = "?level=" + level + "&performanceType=" + performanceType + "&festivalDay=" + festivalDay +
       "&festivalId=" + festivalId + "&instrument=" + instrument + "&sortOrder=" + sortOrder + "&selectTagId=slots";
   queryString = queryString.replace(/ /g, "+");
   ajaxRequest("../model/availableSlots.php",queryString,"availableSlots",1);
}

function modifyRegistration(registrationId,timeslotId,festivalDay)
{
   var e = document.getElementById("editRegBox");
   e.style.display='block';

   queryString = "?registrationId=" + registrationId + "&timeslotId=" + timeslotId + "&festivalDay=" + festivalDay;
   // will need to free up the above time slot
   ajaxGetRegistration("../model/getRegistrationRecord.php",queryString);  // database request for registration record
   setModifyVisibility();
   eAvailableSlots();
}

// This needs to update two registration records if it was a duet
function updateRegistration()
{
   var regOpen = document.getElementById("open").innerHTML;
   if (regOpen == "Open")
   {
     
      var studentId = document.getElementById("eStudentId").value;
      var studentId2 = document.getElementById("eStudentId2").value;
      var timeslotId = document.getElementById("eSlots").value;
      var prevTimeSlotId = document.getElementById("ePrevTimeSlotId").value;
      var performanceType = document.getElementById("ePerformanceType").value;
      var instrument = document.getElementById("eInstrument").value;
      var level = document.getElementById("eLevel").value;
      var performanceDay = document.getElementById("eFestivalDay").value;
      var festivalId = document.getElementById("festivalId").innerHTML;
      var festivalDate = document.getElementById("festivalDate").innerHTML;
      var alternateDate = document.getElementById("alternateDate").innerHTML;
      var regFee = document.getElementById("regFee").innerHTML;
      var regFeeAlt = document.getElementById("regFeeAlt").innerHTML;
      var registrationId = document.getElementById("eRegistrationId").value
      var registrationId2 = document.getElementById("eRegistrationId2").value         

      if (studentId != "" && timeslotId != "")
      {
         var queryString = "?registrationId=" + registrationId
                      + "&studentId=" + studentId
                      + "&studentId2=" + studentId2
                      + "&timeslotId=" + timeslotId
                      + "&prevTimeSlotId=" + prevTimeSlotId
                      + "&registrationId2=" + registrationId2
                      + "&performanceType=" + performanceType
                      + "&instrument=" + instrument
                      + "&level=" + level
                      + "&performanceDay=" + performanceDay
                      + "&festivalId=" + festivalId
                      + "&festivalDate=" + festivalDate
                      + "&alternateDate=" + alternateDate
                      + "&regFee=" + regFee
                      + "&regFeeAlt=" + regFeeAlt;
         queryString = queryString.replace(/ /g, "+");
         ajaxRequest("../model/updateRegistration.php",queryString,"error",1);  
         registrationList();
         //      availableSlots();
      }
      else if (studentId == "")
      {
         alert("Please select a student to register!");
      }
      else if (timeslotId == "")
      {
         alert ("No available time slots!");
      }
   }
   else
   {
      alert ("Registration is not open!");
   }
}


function addRegistration()
{
   var regOpen = document.getElementById("open").innerHTML;
   if (regOpen == "Open")
   {
     
      var studentId = document.getElementById("studentId").value;
      var studentId2 = document.getElementById("studentId2").value;
      var timeslotId = document.getElementById("slots").value;
      var performanceType = document.getElementById("performanceType").value;
      var instrument = document.getElementById("instrument").value;
      var level = document.getElementById("level").value;
      var performanceDay = document.getElementById("festivalDay").value;
      var festivalId = document.getElementById("festivalId").innerHTML;
      var festivalDate = document.getElementById("festivalDate").innerHTML;
      var alternateDate = document.getElementById("alternateDate").innerHTML;
      var regFee = document.getElementById("regFee").innerHTML;
      var regFeeAlt = document.getElementById("regFeeAlt").innerHTML;
      if (studentId != "" && timeslotId != "")
      {
         var queryString = "?studentId=" + studentId
                      + "&studentId2=" + studentId2
                      + "&timeslotId=" + timeslotId
                      + "&performanceType=" + performanceType
                      + "&instrument=" + instrument
                      + "&level=" + level
                      + "&performanceDay=" + performanceDay
                      + "&festivalId=" + festivalId
                      + "&festivalDate=" + festivalDate
                      + "&alternateDate=" + alternateDate
                      + "&regFee=" + regFee
                      + "&regFeeAlt=" + regFeeAlt;
         queryString = queryString.replace(/ /g, "+");
         ajaxRequest("../model/addRegistration.php",queryString,"error",1);  
         registrationList();
         availableSlots();
      }
      else if (studentId == "")
      {
         alert("Please select a student to register!");
      }
      else if (timeslotId == "")
      {
         alert ("No available time slots!");
      }
   }
   else
   {
      alert ("Registration is not open!");
   }
}

function dropRegistration()
{

   var prevTimeSlotId = document.getElementById("ePrevTimeSlotId").value;
   var name1 = document.getElementById("eName").value;
   var name2 = document.getElementById("eName2").value;
   var performanceType = document.getElementById("ePerformanceType").value;   
   var queryString = "?fullName=" + name1 + "&timeslotId=" + prevTimeSlotId;
   var message = name1;
   queryString = queryString.replace(/ /g, "+");
   if (performanceType == "Duet")
   {
      message = message + " and duet partner "  + name2;     
   }
   if (confirm ("Are you sure you want to unregister " + message + "!"))
   {
      ajaxRequest("../model/dropRegistration.php",queryString,"error",1);
   }
  
   registrationList();
   availableSlots();
}



function loadAll()
{

   IsFestivalRegistrationOpen();
   registrationList();
   availableSlots();
}

function IsFestivalRegistrationOpen()
{
   var queryString = "";
   ajaxGetFestival("../model/isRegistrationOpen.php",queryString);
}

function selectPartner()
{
   var select = document.getElementById("partnerChoice");
   var studentId = select.value;
   var studentName = select.options[select.selectedIndex].text;
   document.getElementById("studentName2").value = studentName;
   document.getElementById("studentId2").value = studentId;   
}

function selectStudent()
{ 
   var select = document.getElementById("studentChoice");
   var studentId = select.value;
   var studentName = select.options[select.selectedIndex].text;
   document.getElementById("studentName").value = studentName;
   document.getElementById("studentId").value = studentId;
}

function hideDuetName()
{
   document.getElementById("studentName2").style.display = "none";
   document.getElementById("studentName2Label").style.display = "none";
   document.getElementById("partner").style.display = "none";
   document.getElementById("studentId2").value = "";
}


function setModifyVisibility()
{
  if (document.getElementById("ePerformanceType").value == "Duet")   // duet
   {    
      document.getElementById("eStudentName2Label").style.display = "inline";
      document.getElementById("eName2").style.display = "inline";
   }
   else
   {
      document.getElementById("eStudentName2Label").style.display = "none";
      document.getElementById("eName2").style.display = "none";
//      document.getElementById("studentId2").value = "";
   }

}

function setVisibility()
{
   if (document.getElementById("performanceType").value == "Duet")   // duet
   {    
      getPartner();
      document.getElementById("studentName2Label").style.display = "inline";
      document.getElementById("partner").style.display = "inline";
   }
   else
   {
      document.getElementById("studentName2Label").style.display = "none";
      document.getElementById("partner").style.display = "none";
      document.getElementById("studentId").value = "";
   }
}

function clearErrorField()
{
   document.getElementById("error").innerHTML = "&nbsp;";
}

function clearForm()
{
   document.getElementById("registerForm").reset();
   document.getElementById("studentId").value = "";
   document.getElementById("studentId2").value = "";
}


function registerDialog()
{
   document.getElementById("studentId").value = "";
   document.getElementById("studentId2").value = "";
   document.getElementById("performanceType").value = "Solo";
   hideDuetName();
   getStudent1();
   var e = document.getElementById("registerBox");
   e.style.display='block';
}

// validate the update register box
function validateUpdateRegister()
{
   if (document.getElementById("eStudentId").value == "")
   {
      alert("Select a student!");
      return false;
   }
   else if (document.getElementById("ePerformanceType").value == "Duet" &&
            document.getElementById("eStudentId2").value == "")
   {
      alert("Enter the Duet Partner!");
      return false;
   }
   else if (document.getElementById("eSlots").value == "-1")
   {
      alert("Select a timeslot!");
      return false;
   }
   else
   {
       registerUpdate();
   }
}

function registerUpdate()
{
   $('#editRegBox').hide(); 
   updateRegistration();
}

function validateRegister()
{
   if (document.getElementById("studentId").value == "")
   {
      alert("Select a student!");
      return false;
   }
   else if (document.getElementById("performanceType").value == "Duet" &&
            document.getElementById("studentId2").value == "")
   {
      alert("Enter the Duet Partner!");
      return false;
   }
   else if (document.getElementById("slots").value == "-1")
   {
      alert("Select a timeslot!");
      return false;
   }
   else
   {
      register();
   }
}

function register()
{
   $('#registerBox').hide();
   addRegistration();
}

function exitRegister()
{
   $('#registerBox').hide();
}

$(function(){
       var menuItem = document.getElementById('miRegistration');
     menuItem.className = menuItem.className + "menuSelected";

});
   
</script>
     
</head>

<body onload="loadAll()">
  <?php include("../menu.php"); ?>
   <div class="fullscreen, master">
      
      <h3 class = "center" style = "color: Brown" >Registration is <span id = "open">Open</span></h3>
      <h5 class = "center" style = "color: Brown" >Registration Closes <span id = "regEnds"></h5></span>

       <!-- The following DIV is for getting festival information -->
      <div style = "display:none; visibility: hidden">
        <table border = "border" class = "center">
          <tr>
             <td>Festival ID</td>
             <td>Festival Name</td>
             <td>Festival Date</td>
             <td>Alternate Date</td>
             <td>R Fee</td>
             <td>A Fee</td>
             <td>Open</td>
             <td>Open Early</td>
             <td>Active</td>
          </tr>
          <tr>
             <td id = "festivalId"> </td>
             <td id = "festivalName"> </td>
             <td id = "festivalDate"> </td>
             <td id = "alternateDate"> </td>
             <td id = "regFee"> </td>
             <td id = "regFeeAlt"> </td>
             <td id = "regOpen"> </td>
             <td id = "regOpenEarly"> </td>
             <td id = "currentFestival"></td>
          </tr>
        </table>
     </div>
   <p class = "center">
   <button  onclick = "registerDialog()" onmouseover = "clearErrorField()">Register</button>
   </p>

   <p class = "center" id = "error" style = "color: red">&nbsp;</p>   
   <form id = "registerForm">
      <div class="registerBox" id="registerBox">
          <h2>Register a Student</h2> <br/>

          <label>Name:</label>
          <input type="text" id = "studentName" name = "studentName" style = "display: none"/>
          <input type="text" id = "studentId" name = "studentId" style = "display: none" />

           <!-- This paragraph is filled in by an ajax call and stores the teachers students in a select box -->
           <p id="student1"  style = "display: inline" onmousedown = "clearErrorField()">
           </p>

           <label>Performance Type:</label> 
           <select id = "performanceType" name = "performanceType" onchange = "setVisibility();availableSlots()">
              <option selected = "selected" value = "Solo">Solo</option>
              <option value = "Duet">Duet</option>
              <option value = "Concerto">Concerto</option>
           </select>
                          
           <label id = "studentName2Label" style = "display: none"><br/>Duet Partner: </label>

           <input type="text" style = "display: none" id = "studentName2" name = "studentName2" />
           <input type="text" id = "studentId2" style = "display: none"/>
   
           <!-- This paragraph is filled in by an ajax call; It store the teachers students in a select box -->
           <p id="partner" style = "display: none; position: relative; left: 88px" onmousedown = "clearErrorField()">
           </p>
   
          <br/>
          <label>Instrument:</label>
          <select id = "instrument" name = "instrument" onchange = "availableSlots()">
              <option selected = "selected" value = "Piano">Piano</option>
              <option value = "Voice">Voice</option>
              <option value = "String">String</option>
              <option value = "Organ">Organ </option>
              <option value = "Other">Other</option>
           </select>
          <br/>
           <label>Proficiency Level:</label>
           <select id = "level" name = "level" onchange = "availableSlots()">
               <option value = "1">beginner</option>
               <option value = "2">early intermediate</option>
               <option value = "4">intermediate</option>
               <option value = "8">late intermediate</option>                                                 
               <option value = "16">pre-advanced</option>
               <option value = "32">advanced</option>
               <option value = "16">Jr</option>  <!-- use 64 if must be different than pre-advanced -->
               <option value = "32">Sr</option>  <!-- use 128 if must be different than advanced -->
           </select>
           <br/>
           <label>Performance Day:</label>
           <select id = "festivalDay" name = "festivalDay" onchange = "availableSlots()">
              <option value = "1">Festival Day</option>
              <option value = "2">Alternate Day</option>
           </select>
           <br/>
           <br/>
           <label>Timeslot sort order</label><label>Performance Times</label>
           <div>                                                               
              <select id = "slotSortOrder"  onchange = "availableSlots()">
                 <option value = "T">Sort by Time</option>
                 <option value = "R">Sort by Room</option>
              </select>
              <!-- times loaded here from ajax request -->
              <span id="availableSlots" style = "position: relative; top: -10px; left: 60px">
              </span>

           </div>
          <br/>
          <br/>                                                      
          <p class = "center">
              <input type="button" id = "registerStudent"  value="Register Student"
                onclick="validateRegister()" />
    <!--
              <input type="reset" value="Clear Form" style = "position: relative; left: 50px" onclick = "hideDuetName(); clearForm();"/>
    -->                                                            
          </p>
          <img src="../close.png" alt = "cancel" onclick="exitRegister();"/>
          
     </div>

   </form>

   <h1 class = "center">Registered Students</h1><br/>

   <div  class="flex" id="registrationList" >
   </div>

</body>
</html>
