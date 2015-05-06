<?php
  include '../model/loginValid.php';
  session_start();
  $teacherId =  $_SESSION['teacherId'];
  require_once("../model/dbConnect.php");

  $teacherId = $_SESSION['teacherId'];

  # get the unpaid registration records for this teacher
  $query = "SELECT regFee FROM registration WHERE teacherId =" . $teacherId . " AND regFeePaid = \"N\"";
  $data = mysql_query( $query );
  if ( !$data )
  {
     print "Invalid query string: ".mysql_error();
     exit;
  }

  $rowCount = mysql_num_rows( $data ); 
  $totalRegFees = 0;
  for($row = 0; $row < $rowCount; $row++)
  {
    $currentRow = mysql_fetch_array( $data );
    $totalRegFees = $totalRegFees + $currentRow['regFee'];
  }


  $query = "SELECT * FROM teacher where teacherId=" . $teacherId;
  $data = mysql_query( $query );
    
  if ( !$data )
  {
    print "Teacher not found - ".mysql_error();
    exit;
  }

  $rowCount = mysql_num_rows( $data );

  $currentRow = mysql_fetch_array( $data );
  $firstName = $currentRow['first'];
  $lastName = $currentRow['last'];
  $uvmtaId = $currentRow['uvmtaId'];
  $street = $currentRow['street'];
  $city = $currentRow['city'];
  $state = $currentRow['state'];
  $zip = $currentRow['zip'];
  $phone = $currentRow['phone'];
  $email = $currentRow['email'];
  $pwd = $currentRow['pwd'];
  $username = $currentRow['username'];
  $membershipCurrent = $currentRow['membershipCurrent'];
  $membershipFees = $currentRow['membershipFees'];
  # $regFees = $currentRow['regFees'];
  $regFees = $totalRegFees;  # computed from the registration records
  $admin = $currentRow['admin'];
  $earlyReg = $currentRow['earlyReg'];
?>  

<!DOCTYPE html">
<html>
<head>
  <title><?php print $firstName . " " . $lastName?></title>
  <script type="text/javascript" src = "../js/ajax.js"></script>
  <script type="text/javascript" src = "../js/ajaxGetTeacher.js"></script>
  <script src="../js/app.min.js"></script>
  <script src="../js/jquery.js"></script>
  <style>
    td {padding: 5px;}
  </style>
  <script type="text/javascript">
    function getNewPassword()
    {
      document.getElementById("pwdForm").style.display = "block";
      document.getElementById("changePwd").style.visibility = "hidden";   
      document.getElementById("oldPassword").value = "";
      document.getElementById("newPassword").value = "";
      document.getElementById("confirmPassword").value = "";
      document.getElementById("oldPassword").focus();
      document.getElementById("oldPassword").select();
    }
    function cancelPasswordEntry()
    {
      document.getElementById("pwdForm").style.visibility = "hidden";
      document.getElementById("changePwd").style.visibility = "visible";   
      document.getElementById("oldPassword").value = "";
      document.getElementById("newPassword").value = "";
      document.getElementById("confirmPassword").value = "";
    }
    function verifyPassword(teacherId)
    {

     var oldPassword = document.getElementById("oldPassword").value;
     var newPassword = document.getElementById("newPassword").value;
     var confirmPassword = document.getElementById("confirmPassword").value;

     if (confirmPassword != newPassword || confirmPassword == "")
     {
      alert("Passwords Don't match! Re-enter passwords!");
      document.getElementById("confirmPassword").value = "";
      document.getElementById("newPassword").focus();
      document.getElementById("newPassword").select();
      }
      else
      {
      // code to encrypt password goes here!!
      var queryString = "?teacherId=" + teacherId + "&pwd=" + oldPassword + "&newpwd=" + newPassword;
      ajaxRequest("../model/updatePassword.php",queryString,"error",1);
      document.getElementById('pwdForm').style.visibility = "hidden";
      document.getElementById("changePwd").style.visibility = "visible";   
      }

    }


    function modifyTeacher(teacherId)
    {
      queryString="?teacherId=" + teacherId;
      document.getElementById('teacherId').value = teacherId;
      ajaxGetTeacher("../model/getTeacherRecord.php",queryString);  // database request for teacher record
      //document.getElementById('top').focus();
      //document.getElementById('phone').focus();  
      //document.getElementById('updateButton').style.visibility = "visible";
      $('#myProfile').click(showEdit);
    }

    function updateTeacher()
    {
     var response = confirm("Your profile will be updated!  Are you sure?");
     if (response == true)
     { 
      var elements = ['firstName','lastName','uvmtaId','street','city','state',
                      'zip','phone','email','pwd','username','membershipCurrent',
                      'membershipFees','regFees','admin','earlyReg'];

      //prime the pump
      var queryString = "?teacherId" + "=" + document.getElementById('teacherId').value;
      
      //loop through each field and add it to the query string
      for (var i = 0; i < elements.length; i++) {
        var x = document.getElementById(elements[i]);
        //make sure we're not trying to grab from a box that doesn't exist.
        if (x != null) {
          queryString += "&" + elements[i] + "=" + x.value;
        } else {
          alert(elements[i] + "doesn't exist");
          return;
        };
      };

      // var teacherId = document.getElementById('teacherId').value;
      // var firstName = document.getElementById('firstName').value;
      // var lastName = document.getElementById('lastName').value;
      // var uvmtaId = document.getElementById('uvmtaId').value;
      // var street = document.getElementById('street').value;
      // var city = document.getElementById('city').value;
      // var state = document.getElementById('state').value;
      // var zip = document.getElementById('zip').value;
      // var phone = document.getElementById('phone').value;   
      // var email = document.getElementById('email').value;
      // var pwd = document.getElementById('pwd').value;
      // var username = document.getElementById('username').value;
      // var membershipCurrent = document.getElementById('membershipCurrent').value;
      // var membershipFees = document.getElementById('membershipFees').value;   
      // var regFees = document.getElementById('regFees').value;
      // var admin = document.getElementById('admin').value;
      // var earlyReg = document.getElementById('earlyReg').value;  
      // var queryString = "?teacherId=" + teacherId +
      // "&firstName=" + firstName +
      // "&lastName=" + lastName +
      // "&uvmtaId=" + uvmtaId +
      // "&street=" + street +
      // "&city=" + city +
      // "&state=" + state +
      // "&zip=" + zip +
      // "&phone=" + phone +
      // "&email=" + email +
      // "&pwd=" + pwd +
      // "&username=" + username +
      // "&membershipCurrent=" + membershipCurrent +
      // "&membershipFees=" + membershipFees +
      // "&regFees=" + regFees +
      // "&admin=" + admin +
      // "&earlyReg=" + earlyReg;


      queryString = queryString.replace(/ /g, "+");
      ajaxRequest("../model/updateTeacher.php",queryString,"error",1);
      $('.editBox').hide();
      location.reload(true);
      }
      else
      {
        modifyTeacher(<?php print($teacherId)?>)
      }
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
     //cancelPasswordEntry();
     if (document.getElementById("firstName").value != "" &&
       document.getElementById("lastName").value != "" &&
       document.getElementById("username").value != "" )
     {
      updateTeacher();
    }
    else
    {
      if (document.getElementById("firstName").value == "")
      {
       alert("Please your first name!");
       document.getElementById('firstName').focus();
     }
     else if (document.getElementById("lastName").value == "")
     {
       alert("Please your last name!");
       document.getElementById('lastName').focus();
     }
     else if (document.getElementById("username").value == "")
     {
       alert("Please enter your UVMTA user name!");
       document.getElementById('username').focus();
     }
     return false;
    }  
    }
  </script>

<link rel="stylesheet" type="text/css" href="../css/uvmta.css" />
</head>

<body onload="modifyTeacher(<?php print($teacherId)?>)">
  <?php include("../menu.php"); ?>
  <p class = "center" id = "error" style = "color: red" >&nbsp;</p>
  <div class="editBox" onmousedown = "clearErrorField()">
    <div id="addTeacher">
      <form>
        <header>
          <h2>Update Profile</h2>
          <hr/>
        </header>
        <img src="../close.png" onclick="$('.editBox').hide();"/>
        <label>FirstName</label>
        <input type="text" id="firstName" size = "30" maxlength = "20" onfocus = "clearErrorField()"/>
            <label>LastName</label>
            <input type="text" id="lastName" size = "20" maxlength = "26"/>
            <label>Street</label>
            <input type="text" id="street" size = "30" maxlength = "50" />
            <label>City</label>
            <input type="text" id="city" size = "25" maxlength = "30" />
            <label>State</label>
            <select id = "state" name="state">
                <option value ="ID" selected = "selected">ID</option>
                <option value ="UT">UT</option>
              </select>
              <label>Zip</label>
            <input type="text" id="zip" size = "5" maxlength = "10" />
            <label>Phone</label>
           <input type="text" id="phone" size = "13" maxlength = "12" />
           <label>E-mail</label>
           <input type="text" id="email" size = "40" maxlength = "50" />
           <label>Dues Owed</label>
           <input type="text" id="membershipFees" disabled = "disabled" value = "0.0" size = "6" maxLength = "6" />
           <label>Festival Fees</label>
           <input type="text" id="regFees" disabled = "disabled" value = "0.0" size = "6" maxLength = "6" />
           <label>Membership Current</label>
            <select id = "membershipCurrent" disabled = "disabled" name="membershipCurrent">
             <option value ="N">No</option>
             <option value ="Y" selected = "selected" >Yes</option>
            </select>
            <label>User Name</label>
        <input type="text" id="username" size = "16" maxLength = "16" />
        <label>UVMTA ID</label>
        <input type="text" id = "uvmtaId" disabled = "disabled" size = "8" maxLength = "8" />
        <label>Teacher ID#</label>
        <input type="text" id = "teacherId" disabled = "disabled" size = "8" maxLength = "8" />
        <div style="display:none;">
          <label>Admin</label>
          <select id = "admin"  name="admin" disabled = "disabled">
            <option value = "N" selected = "selected" >No</option>
            <option value = "Y" >Yes</option>
          </select>
          <label>Early Reg</label>
          <select id = "earlyReg"  name="earlyReg">
           <option value = "N" selected = "selected" >No</option>
           <option value = "Y" >Yes</option>
          </select>
        </div>
  <footer>
    <br/>
    <input type="password" id="pwd" size = "20" maxLength = "20" style = "visibility: hidden;" />
    <input id = "updateButton" type="button" value="Update Profile"
    onclick = "validateForm()"  />
    <input id = "changepwd" class = "center" type="button" value="Change Password"
    onclick = "getNewPassword()"  />
 </footer>
</form>
</div>

</div>
<div id = "pwdForm">
 <table class = "center" border="1">
   <tr>
    <td style="background-color: lightgrey">Current Password:</td>
    <td><input type="password" name="oldPassword" id="oldPassword" size = "20" maxlength = "20" />
    </td>
  </tr>
  <tr>
    <td style="background-color: lightcyan">New Password:</td>
    <td><input type="password" name="newPassword" id="newPassword" size = "20" maxlength = "20"/></td>
  </tr>
  <tr>
    <td style="background-color: lightcyan">Confirm New Password:</td>
    <td><input type="password" name="confirmPassword" id="confirmPassword"
     size = "20" maxlength = "20"/>
   </td>
 </tr>
</table>
<p class = "center">
 <input type="button" name="verifyPassword" id="verifyPassword" class = "center"
 size = "20" maxlength = "20" onclick = "verifyPassword(<?php print($teacherId)?>)" value = "Submit"/>
 <input type="button" name="verifyPassword" id="verifyPassword" class = "center"
 size = "20" maxlength = "20" onclick = "cancelPasswordEntry() " value = "cancel"/>
</p>
</div>

<div id="myProfile">
  <header>
    <?php print "<h2>" . $firstName . " " . $lastName . "</h2>";?>
  </header>
  <section>
  <?php print "<label>Steet</label>" . $street . "<br/>"; 
  print "<label>Address</label>" . $city . ", " . $state . " " . $zip . "<br/>"; 
  print "<label>Username</label>" . $username . "<br/>";
  print "<label>UVMTA ID</label>" . $uvmtaId . "<br/>"; 
  print "<label>Email</label>" .$email . "<br/>"; 
  print "<label>Festival Fees</label> $" . $regFees . "<br/>";
  print "<label>Membership Fees</label> $" . $membershipFees . "<br/>";
  print "<span>Membership is " . ($membershipCurrent != "N"? "" : "not ") . "current</span>";
    ?>
  </section>
  <footer>
    <span class="clickable">Edit</span>
  </footer>
</div>
</body>
</html>
