<?php
include '../model/loginValid.php';
session_start();

?>

<!DOCTYPE html> 
<html>
   <head>
      <title>Students</title>
      <link rel="stylesheet" href="../css/uvmta.css" />
      <script src = "../js/ajax.js"></script>
      <script src = "../js/app.min.js"></script> 
      <script type="text/javascript">

         function updateStudent(studentId)
         {
            clearAddForm();
            clearDuplicateDiv();
            queryString = "?studentId=" + studentId;
            queryString = queryString.replace(/ /g, "+");
            ajaxRequest("../model/updateStudentsTeacher.php",queryString,"error",1);   
            studentList();
         }

         function addStudent()
         {
            var lastName = document.getElementById('lastName').value;
            var firstName = document.getElementById('firstName').value;
            var instrument = document.getElementById('instrument').value;
            var gradYear = document.getElementById('gradYear').value;
            var festivals = document.getElementById('festivals').value;
            var points = document.getElementById('points').value;
            var lastFestDate = document.getElementById('lastFestDate').value;
            var query="teacherId=<?php print $_SESSION['teacherId'] ?>&lastName=" + lastName + "&firstName=" + firstName
                        + "&instrument=" + instrument + "&gradYear=" + gradYear +
                        "&festivals=" + festivals + "&points=" + points + "&lastFestDate=" + lastFestDate;
            var query = query.replace(/ /g, "+");
            
            ajaxRequest("../model/addStudent.php?", query,"error", 1)   

            // clear form after the add
            clearAddForm();
            clearDuplicateDiv();
            studentList();
         }

         function selectStudent()
         {
            var select = document.getElementById("studentChoice");
            var studentId = select.value;
            if (studentId == 0)
            {
               alert ("Student was not added!");
            }
            else
            { 
               updateStudent(studentId);
            }
         }

         function membershipCurrent()
         {
            <?php
            if( $_SESSION['membershipCurrent'] != 'Y')
            {
            ?>
                 alert("You cannot register for festival until your UVMTA membership is current!");
            <?php     
            }
            ?>  
         }

            
         function studentList(sortBy)
         {
            if (arguments.length == 0)
            {
               sortBy = "last";
            }  
            var queryString = "?teacherId=<?php print $_SESSION['teacherId'] ?>&sortBy=" + sortBy;
            ajaxRequest("../model/studentList.php",queryString,"studentList",1);
            
            var menuItem = document.getElementById('miStudents');
            menuItem.className = menuItem.className + "menuSelected";

            $('tr').click(editStudent);
         }


         function removeStudent( studentId, firstName, lastName, festivals)
         {
            var response = confirm("Remove '" + firstName + " " + lastName + "' from your teaching list!");
            var queryString = "?studentId=" + studentId + "&firstName=" + firstName + "&lastName=" + lastName;
            if (response == true)
            {
               // don't delete if festivals is > 0. Set the students teacher to unknown
               if (festivals == 0)
               {

                  ajaxRequest("../model/dropStudent.php",queryString,"error",1);
               }
               else
               {
                  ajaxRequest("../model/clearStudentsTeacher.php",queryString,"error",1);
               }
            }
            studentList();
         }

         function dropStudent( studentId, firstName, lastName)
         {
           var response = confirm("Remove " + firstName + " " + lastName);
           if (response == true)
            {
               var queryString = "?studentId=" + studentId;
               ajaxRequest("../model/dropStudent.php",queryString,"error",1);
            }
            studentList();
         }

         

         function addDialog()
         {
            var e = document.getElementById("addBox");
            e.style.display='block';
         }

         function saveAdd()
         {
            $('#addBox').hide();
            addStudent();
          }
         
         function exitAdd()
         {
            $('#addBox').hide();
         }

         function clearAddForm()
         {
            document.getElementById("firstName").value = "";
            document.getElementById("lastName").value = "";
            document.getElementById("gradYear").value = "";
            document.getElementById("festivals").value = 0;
            document.getElementById("points").value = 0;
            document.getElementById("lastFestDate").value = "";            
         }

         function clearDuplicateDiv()
         {
            document.getElementById("duplicateStudent").innerHTML = "&nbsp;";
            document.getElementById("firstName").select();
         }

         function clearErrorField()
         {
            document.getElementById("error").innerHTML = "&nbsp;";
         }

      </script>

   </head>

<body onload="studentList()">
   <?php include("../menu.php");?>
   <div class="center" id="master">

      <div id="addStudent">
         <input class = "center" type="button" onmouseover = "clearErrorField()" value="Add Student" onclick="addDialog()" />
         <br/>
         <span class = "center" id = "error" style = "color: red">&nbsp;</span>    
      </div>
         
      <br/>
         
      <div id = "duplicateStudent" style = "color: red; font-size: 12pt; text-align: center; width: 900px">
      </div>
            
      <div  class="tableData" id="studentList" onmousedown = "clearErrorField()">
      </div>
  
   </div>

   <div class="editBox" id="addBox">
       <h2> Add a Student </h2> <br/>
       <label>First Name:</label>
       <input id = "firstName" type="text" text=""/> <br/>

       <label>Last Name:</label>
       <input id = "lastName" type="text" text=""/> <br/>
       <label>Instrument:</label>
       <select id = "instrument" name = "instrument" >
          <option selected = "selected" value = "Piano">Piano</option>
          <option value = "Voice">Voice</option>
          <option value = "String">String</option>
          <option value = "Organ">Organ</option>
          <option value = "Other">Other</option>
       </select>
       <br/>
       <label>H.S. Grad: </label>
       <input id ="gradYear" type="text"  text=""/> <br/>
   
       <!-- Festivals, Points, Last Festival, should be "disabled" after 1st
            Festival so teacher can no longer modify these fields -->
       <label>Festivals:</label>
       <input id ="festivals" type = "text"  text="" /> <br/>
    
       <label>Points:</label>
       <input id = "points" type = "text" text=""/> <br/>
  
       <label>Last Festival:</label>
       <input id = "lastFestDate" type = "text"  text="" /> <br/>
    
       <button onclick="saveAdd();">Save</button>
       <img src="close.png" onclick="exitAdd();"/>
   </div>
  
</body>
</html>
