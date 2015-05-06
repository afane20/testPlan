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
            clearDuplicateDiv();
            queryString = "?studentId=" + studentId;
            queryString = queryString.replace(/ /g, "+");
            ajaxRequest("../model/updateStudentsTeacher.php",queryString,"error",1);   
            studentList();
            document.getElementById("firstName").value = "";
            document.getElementById("lastName").value = "";
         }
         function checkStudent()
         {

            var lastName = document.getElementById('lastName').value;
            var firstName = document.getElementById('firstName').value;  
            var queryString = "?firstName=" + firstName + "&lastName=" + lastName;
            ajaxRequest("../model/selectUnknown.php",queryString,"duplicateStudent",1);
         }

         function selectStudent()
         {
            var select = document.getElementById("studentChoice");
            var studentId = select.value;
            if (studentId == 0)
            {
                addStudent();
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


         function removeStudent( studentId, firstName, lastName, points)
         {
            var response = confirm("Remove '" + firstName + " " + lastName + "' from your teaching list!");
            var queryString = "?studentId=" + studentId + "&firstName=" + firstName + "&lastName=" + lastName;
            if (response == true)
            {
          
               if (points == 0)
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

         function addStudent()
         {
            var lastName = document.getElementById('lastName').value;
            var firstName = document.getElementById('firstName').value;
	    alert (firstName); 
           var points = 0;
            var query="teacherId=<?php print $_SESSION['teacherId'] ?>&lastName=" + lastName + "&firstName=" + firstName + "&points=" + points;
            var query = query.replace(/ /g, "+");
            
            if (lastName != "" && firstName != "")
            {
               ajaxRequest("../model/addStudent.php?", query,"error", 1)   
               document.getElementById("firstName").value = "";
               document.getElementById("lastName").value = "";
               studentList();
            }
            else
            {
               if (firstName == "")
               {
                  alert("Please enter the students first name!");
                  document.getElementById('firstName').focus();
               }
               else
               {
                  alert("Please enter the students last name!");
                  document.getElementById('lastName').focus();
               }
            }
            document.getElementById("duplicateStudent").innerHTML = "&nbsp;";
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
      <div id = "duplicateStudent" style = "color: red; font-size: 12pt; text-align: center; width: 900px">
      </div>
      <div  class="tableData" id="studentList" onmousedown = "clearErrorField()">
      </div>
      <div id="addStudent" onmousedown = "clearErrorField()">
         <h3>Add a student</h3>
         <label>First Name</label>
         <input type="text" id="firstName" onfocus = "clearErrorField()"/><br/>
         <label>Last Name</label>
         <input type="text" id="lastName" /><br/>
         
         <input class = "center" type="button" value="Add Student" onclick="checkStudent()" />
         <span class = "center" id = "error" style = "color: red">&nbsp;</span>     
      </div>
      
   </div>
  
</body>
</html>
