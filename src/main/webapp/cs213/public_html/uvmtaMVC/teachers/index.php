<?php
include '../model/loginValid.php';
session_start();
?>

<!DOCTYPE html>

<html>
<head>
<title>Teachers</title>
<script type="text/javascript" src = "../js/ajax.js"></script>
<script type="text/javascript" src = "../js/ajaxGetTeacher.js"></script>
<script type="text/javascript" src = "../js/app.min.js"></script> 
<script src="../js/jquery.js"></script>
<script type="text/javascript">
  
function teacherList(sortBy,sortDir)
{  
   if (arguments.length == 0)
   {
      sortBy = "last";
      sortDir = "ASC"; 
   }
   else if (sortDir == undefined)
   {   
      sortDir = "ASC";
   }
   
   var queryString = "?teacherId=<?php print $_SESSION['teacherId'] ?>&sortBy=" + sortBy + "&sortDir=" + sortDir;
   ajaxRequest("../model/teacherList.php",queryString,"teacherList",1);
   var menuItem = document.getElementById('miTeachers');
   menuItem.className = menuItem.className + "menuSelected";
}

function dropTeacher( teacherId, firstName, lastName)
{
   var response = confirm("This will delete '" + firstName + " " + lastName
                          + "' from the database and assign all their students to the teacher named 'unknown', are you sure!!!");
   if (response == true)
   {
       var queryString = "?teacherId=" + teacherId;
       ajaxRequest("../model/dropTeacher.php",queryString,"error",1);
       teacherList();
   }
}

function addTeacher()
{
   $(".editBox").show();
   var lastName = document.getElementById('lastName').value;
   var firstName = document.getElementById('firstName').value;
   var uvmtaId = document.getElementById('uvmtaId').value;
   var street = document.getElementById('street').value;
   var city = document.getElementById('city').value;
   var state = document.getElementById('state').value;
   var zip = document.getElementById('zip').value;
   var phone = document.getElementById('phone').value;   
   var email = document.getElementById('email').value;
   var password = document.getElementById('pwd').value;
   var username = document.getElementById('username').value;
   var membershipCurrent = document.getElementById('membershipCurrent').value;
   var membershipFees = document.getElementById('membershipFees').value;   
   var regFees = document.getElementById('regFees').value;
   var admin = document.getElementById('admin').value;
   var earlyReg = document.getElementById('earlyReg').value;
 
   var query="teacherId=<?php print $_SESSION['teacherId'] ?>&lastName=" + lastName + "&firstName=" + firstName + "&uvmtaId=" + uvmtaId
      + "&street=" + street + "&city=" + city + "&state=" + state + "&zip=" + zip + "&phone=" + phone
      + "&email=" + email + "&pwd=" + password + "&username=" + username + "&membershipCurrent=" + membershipCurrent
      + "&membershipFees=" + membershipFees + "&regFees=" + regFees + "&admin=" + admin + "&earlyReg=" + earlyReg;
   var query = query.replace(/ /g, "+");
   //alert(queryString);   
   if (validateForm())
   {
      ajaxRequest("../model/addTeacher.php?", query,"error", 1);
      clearForm();
      teacherList();
   }
}


function modifyTeacher(teacherId)
{
   showForm();
   queryString="?teacherId=" + teacherId;
   document.getElementById('hideDiv').style.display = 'inline';
   document.getElementById('teacherId').value = teacherId;
   ajaxGetTeacher("../model/getTeacherRecord.php",queryString);  // database request for teacher record
   document.getElementById('top').focus();
   document.getElementById('phone').focus();  
   document.getElementById('addButton').style.visibility = "hidden";
   document.getElementById('updateButton').style.visibility = "visible";
}


function updateTeacher()
{
   var teacherId = document.getElementById('teacherId').value;
   var firstName = document.getElementById('firstName').value;
   var lastName = document.getElementById('lastName').value;
   var uvmtaId = document.getElementById('uvmtaId').value;
   var street = document.getElementById('street').value;
   var city = document.getElementById('city').value;
   var state = document.getElementById('state').value;
   var zip = document.getElementById('zip').value;
   var phone = document.getElementById('phone').value;   
   var email = document.getElementById('email').value;
   var pwd = document.getElementById('pwd').value;
   var username = document.getElementById('username').value;
   var membershipCurrent = document.getElementById('membershipCurrent').value;
   var membershipFees = document.getElementById('membershipFees').value;   
   var regFees = document.getElementById('regFees').value;
   var admin = document.getElementById('admin').value;
   var earlyReg = document.getElementById('earlyReg').value;
   var queryString = "?teacherId=" + teacherId +
            "&firstName=" + firstName +
            "&lastName=" + lastName +
            "&uvmtaId=" + uvmtaId +
            "&street=" + street +
            "&city=" + city +
            "&state=" + state +
            "&zip=" + zip +
            "&phone=" + phone +
            "&email=" + email +
            "&pwd=" + pwd +
            "&username=" + username +
            "&membershipCurrent=" + membershipCurrent +
            "&membershipFees=" + membershipFees +
            "&regFees=" + regFees +
            "&admin=" + admin +
            "&earlyReg=" + earlyReg;      

   queryString = queryString.replace(/ /g, "+");
   ajaxRequest("../model/updateTeacher.php",queryString,"error",1);
   teacherList();
   document.getElementById('addButton').style.visibility = "visible";
   document.getElementById('updateButton').style.visibility = "hidden";
   clearForm();
}

function showForm()
{
  $('.editBox').toggle();
}

function clearForm()
{
   document.getElementById('lastName').value = "";
   document.getElementById('firstName').value = "";
   document.getElementById('uvmtaId').value = "";
   document.getElementById('street').value = "";
   document.getElementById('city').value = "";
   document.getElementById('state').value = "";
   document.getElementById('zip').value = "";
   document.getElementById('phone').value = "";
   document.getElementById('email').value = "";
   document.getElementById('pwd').value = "";
   document.getElementById('username').value = "";
   document.getElementById('membershipFees').value = "0";
   document.getElementById('regFees').value = "0";
   document.getElementById('membershipCurrent').selectedIndex = 1;
   document.getElementById('admin').selectedIndex = 0;
   document.getElementById('earlyReg').selectedIndex = 0;  
   document.getElementById('teacherId').value ="";
}
function resetButtonVisibility()
{
   document.getElementById('addButton').style.visibility = "visible";
   document.getElementById('updateButton').style.visibility = "hidden";   

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

function saveFestFees()
{
   regFees = document.getElementById("regFees").value;  //save in global variable for validateFees()
}

// check to be sure the registation fees are only set to zero.
function validateFees()
{
   if (document.getElementById("regFees").value != 0)
   {
      alert("The administrator may only change this value to zero which indicates that registration fees are all paid.");
      document.getElementById("regFees").value = regFees;
      return false;
   }
   else
   {
      var response = confirm("Warning: Setting the Festival Fees to zero is not reversible." +
                             "  Are you sure you want to indicate this teacher is all paid up.");
      if (response == true)
      {
         document.getElementById("regFees").value = 0;
         return true;
      }
      else
      {
         document.getElementById("regFees").value = regFees;
         return false;
      }
   }
}

function validateForm()
{

   if (document.getElementById("firstName").value != "" &&
       document.getElementById("lastName").value != "" &&
       document.getElementById("pwd").value != "" &&
       document.getElementById("username").value != "")
   {
      return (validateFees());
   }
   else
   {
      if (document.getElementById("firstName").value == "")
      {
         alert("Please enter the Teacher's first name!");
         document.getElementById('firstName').focus();
      }
      else if (document.getElementById("lastName").value == "")
      {
         alert("Please enter the Teacher's last name!");
         document.getElementById('lastName').focus();
      }
      else if (document.getElementById("pwd").value == "")
      {
         alert("Please enter a password!");
         document.getElementById('pwd').focus();
      }
      else if (document.getElementById("username").value == "")
      {
         alert("Please enter a username!");
         document.getElementById('username').focus();
      }

      return false;
   }  
}

</script>

<link rel="stylesheet" type="text/css" href="../css/uvmta.css" />
</head>

<body onload="teacherList()">
<?php include("../menu.php"); ?>

<div id="master">
  <div class="content center" onmousedown = "clearErrorField()">
     <div class="tableData" id="teacherList" onmousedown = "clearErrorField()"></div>
     <div id="addTeacher">
      <form class="editBox" id="editBox">
        <img src="../close.png" onclick="showForm()"/>
        <h2> Add a Teacher </h2>
        <div class="container">
          <label>FirstName</label><input type="text" id="firstName" maxlength = "20" onfocus = "clearErrorField()"/>
          <label>LastName</label><input type="text" id="lastName" maxlength = "26"/>
          <label>UVMTA ID</label><input type="text" id="uvmtaId" maxlength = "8" />
        </div> <hr/>
        <div class="container">
          <label>Street</label><input type="text" id="street" maxlength = "50" />
          <label>City</label><input type="text" id="city" maxlength = "30" />
          <label>State</label>
          <select id = "state" name="state">
            <option value ="ID" selected = "selected">ID</option>
            <option value ="UT">UT</option>
          </select>
          <label>Zip</label><input type="text" id="zip" maxlength = "10" />
          <label>Phone</label>           <input type="text" id="phone" maxlength = "12" />
          <label>E-mail</label>           <input type="text" id="email"  maxlength = "50" />
        </div> <hr/>
        <div class="container">
          <label>Dues Owed</label>           <input type="text" id="membershipFees" value = "0.0" maxLength = "6" />
          <label>Festival Fees</label><input type="text" id="regFees" value = "0.0" maxLength = "6"
                      onfocus = "saveFestFees()"  onchange = "validateFees()"/>
          <label>Membership Current</label>     
          <select id = "membershipCurrent" name="membershipCurrent">
            <option value ="N">No</option>
            <option value ="Y" selected = "selected" >Yes</option>
          </select>
          <label>User Name</label>  <input type="text" id="username"  maxLength = "16" />
          <label>Password</label> <input type="text" id="pwd"  maxLength = "20" />
          <label>Admin</label>
          <select id = "admin"  name="admin">
            <option value = "N" selected = "selected" >No</option>
            <option value = "Y" >Yes</option>
            <option value = "T" >Treasurer</option>
          </select>
          <label>Early Reg</label>
          <select id = "earlyReg"  name="earlyReg">
            <option value = "N" selected = "selected" >No</option>
            <option value = "Y" >Yes</option>
          </select>
          <label>Teacher ID#</label>
          <input type="text" id = "teacherId" disabled = "disabled" size = "8" maxLength = "8" />
          <button id = "addButton" class = "center" type="button"
          onclick = "addTeacher()" style = "visibility: visible">Add Teacher</button>
          <button id = "clear" class = "center" type="reset"
          onclick = "resetButtonVisibility(); clearForm()">Clear Form</button>
          <button id = "updateButton" class = "center" type="button" 
          onclick = "updateTeacher()"   style = "visibility: hidden">Update Teacher</button>
        </div>
      </form>
      <p class = "center">
        <input id = "showFormA" type="button" value="Add Teacher" onclick = "showForm();"/>
      </p>
      <div id = "error" style = "color: red" >&nbsp;</div>
    </div>
  </div>
</div>
</body>
</html>
