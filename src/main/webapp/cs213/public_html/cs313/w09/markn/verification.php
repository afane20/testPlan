<html>
	<head> <title> Festival </title>
	   <base href="http://157.201.194.254/~ercanbracks/cs313/w09/markn/" />
      <link rel = "stylesheet" type = "text/css" href = "exstyle.css" />
     
	<?php 
      
     // connect to database          
$db = mysql_connect("jordan", "ercanbracks", "scotte");
      if(!$db)
         exit("Error-1, could not connect to MYSQL");
     
      // select markbn DB
      $er = mysql_select_db("markbn");
      if(!$er)
          exit("Error could not open markbn DB");
    
      //Get form values
      $username = $_GET["username"];
      $password = $_GET["password"];
      
      // Check to see if user is a admin
      $query = "select * from FTeachers where isAdmin = true and username = '" . $username . "' and passwd = '" . $password . "'";
      $result = mysql_query($query);
      
      $numRows = mysql_num_rows($result);
      
      // is an admin
      if($numRows == 1)
      {
         adminDisplay();
      }
      
      else
      {
         $query = "select teacherId from FTeachers where isAdmin = false and username = '" . $username . "' and passwd = '" . $password . "'";
         $result = mysql_query($query);
         
         $numRows = mysql_num_rows($result);
         $row = mysql_fetch_array($result);
         $values = array_values($row);
         $value = $values[1];
         
         if($numRows == 1)
         {
           
            teacherDisplay($value);
         }
         else
         {
            ?> <h3> I'm sorry, but either your username or password are incorrect. </h3>
            <?php
         }
      }
      
  /******************************************************************************************************************
      * teacherDisplay - 
      *******************************************************************************************************************/
      // Start of teacher
      function teacherDisplay($result)
      {
         ?>
         <script type = "text/javascript" src = "teachStudReg.js"> </script>       
         </head>
      <body onload = "updateDisplays(<?php print($result) ?>)">
      
         <h1> Teacher's Page </h1>
         </br>
         <div class = "one" id = "sRegControl" >
            <h2> Festival Registration </h2>
            </br>         
            <table>
               <tr>                  
                  <td> First Name <input type = "text" id = "sFirstName" onblur = "" /> </td>
                  <td> Last Name <input type = "text" id = "sLastName" /> </td>
                  <td> Instrument <input type = "text" id = "sInstrument" /> </td>
                  <td> Level <input type = "text" id = "sLevel" /> </td>
                  <td> ResourceId <input type = "text" id = "sResourceId" /> </td>
               </tr>
               <tr>
               </tr>
               <tr>
                  <td> <input type = "button" name = "Register" value = "Register" onclick = "registerStudent(<?php print($result) ?>)"/> </td>
                  <td> <input type = "button" name = "Unregister" value = "Unregister" onclick = "unregisterStudent(<?php print($result) ?>)"/> </td>
                  
               </tr>
            </table>
         </div>
         </br>
          <div class = "scrollStudents" id = "studentDisplay">
         </div>
         
         </br>
         
          <div class = "scrollResources" id = "resourceDisplay">
         </div>                
         </br>
         
         <?php
      }
      
  /******************************************************************************************************************
      * adminDisplay
      *******************************************************************************************************************/
      function adminDisplay()
      {
         ?>
         <script type = "text/javascript" src = "administration.js"> </script>       
         </head>
      <body onload = "ajaxUpdateDisplay('teacherDisplay')">
      
         <h1> Administration Page </h1>
         </br>
         
         <p>
            <label> <input type = "button" name = "showTeacher" value = "Display Teachers" onclick = "ajaxUpdateDisplay('teacherDisplay')"/> </label>            
            <label> <input type = "button" name = "showTeacher" value = "Display Students" onclick = "ajaxUpdateDisplay('studentDisplay')"/> </label>
            <label> <input type = "button" name = "showTeacher" value = "Display Resources" onclick = "ajaxUpdateDisplay('resourceDisplay')"/> </label>
         </p>
         
         <div class = "hiddenDiv" id = "teacherControl" >
            <h2> Teacher information </h2>
            </br>         
            <table>
               <tr>
                  <td> Teacher ID <input type = "text" id = "teacherId" onblur = "popByTeacherId()" /> </td>
                  <td> &nbsp; First Name <input type = "text" id = "teachFirstName" /> </td>
                  <td> &nbsp; Last Name <input type = "text" id = "teachLastName" /> </td> 
                  <td> &nbsp; email <input type = "text" id = "teachEmail" /> </td>
                  <td> &nbsp; street address <input type = "text" id = "teachStreetAddr" /> </td>
               </tr>
               <tr>                                   
                  <td> &nbsp; city <input type = "text" id = "teachCity" /> </td>                  
                  <td> &nbsp; zip <input type = "text" id = "teachZip" /> </td>
                  <td> &nbsp; Annual Fees <input type = "text" id = "annualFees" /> </td>
                  <td> &nbsp; Regular Fees <input type = "text" id = "regFees" /> </td>
                  <td> &nbsp; Admin Rights <input type = "text" id = "isAdmin" /> </td>
               </tr>
               <tr>                                   
                  <td> &nbsp; Password <input type = "text" id = "password" /> </td>
                  <td> &nbsp; Username <input type = "text" id = "username" /> </td>
               </tr>
               <tr>
               </tr>
               <tr>
                  <td> <input type = "button" name = "update" value = "update" onclick = "ajaxTeacherUpdate('update')"/> </td>
                  <td> <input type = "button" name = "add" value = "Add" onclick = "ajaxTeacherUpdate('add')"/> </td>
                  <td> <input type = "button" name = "delete" value = "Delete" onclick = "ajaxTeacherUpdate('delete')"/> </td>
               </tr>
            </table>
         </div>
         <div><p></p></div>
                         
         <div class = "scrollHiddenTeachers" id = "teacherDisplay">
         </div>
         </label>
              
       
         <div class = "hiddenDiv" id = "studentControl">           
            <h2> Student information </h2>
            </br>         
            <table>
               <tr>
                  <td> Student ID <input type = "text" id = "studentId" onblur = "popByStudentId()" /> </td>
                  <td> &nbsp; First Name <input type = "text" id = "studFirstName" /> </td>
                  <td> &nbsp; Last Name <input type = "text" id = "studLastName" /> </td> 
                  <td> &nbsp; Instrument <input type = "text" id = "instrument" /> </td>
                  <td> &nbsp; level <input type = "text" id = "studLevel" /> </td>                 
               </tr>                        
               <tr>
                  <td> Points <input type = "text" id = "studPoints" /> </td>
                  <td> Registered <input type = "text" id = "studRegistered" /> </td>
                  <td> Teacher <input type = "text" id = "studTeacherId" /> </td>
                  <td> Resource <input type = "text" id = "studResourceId" /> </td>
               </tr>
               <tr>
                  <td> <input type = "button" name = "update" value = "Update" onclick = "ajaxStudentUpdate('update')"/> </td>
                  <td> <input type = "button" name = "add" value = "Add" onclick = "ajaxStudentUpdate('add')"/> </td>
                  <td> <input type = "button" name = "delete" value = "Delete" onclick = "ajaxStudentUpdate('delete')"/> </td>
               </tr>
            </table>
         </div>
         
         <div><p></p></div>
         <div class = "scrollHiddenStudents" id = "studentDisplay">
         </div>
         
                      
         
         <div class = "hiddenDiv" id = "resourceControl">           
            <h2> Resources </h2>
            </br>         
            <table>
               <tr>
                  <td> Resource ID <input type = "text" id = "resourceId" onblur = "popByResourceId()" /> </td>
                  <td> &nbsp; Building <input type = "text" id = "building" /> </td>
                  <td> &nbsp; Room <input type = "text" id = "room" /> </td>
                  <td> &nbsp; Number Pianos <input type = "text" id = "numPianos" /> </td>
                  <td> &nbsp; Day <input type = "text" id = "day" /> </td>
               </tr>
               <tr>                                   
                  <td> &nbsp; Time <input type = "text" id = "time" /> </td>
                  <td> &nbsp; ID 1 <input type = "text" id = "studIdOne" /> </td>                 
                  <td> &nbsp; Type <input type = "text" id = "performType" /> </td>
               </tr>             
               <tr>
               </tr>
               <tr>
                  <td> <input type = "button" name = "update" value = "update" onclick = "ajaxResourceUpdate('update')"/> </td>
                  <td> <input type = "button" name = "add" value = "Add" onclick = "ajaxResourceUpdate('add')"/> </td>
                  <td> <input type = "button" name = "delete" value = "Delete" onclick = "ajaxResourceUpdate('delete')"/> </td>
               </tr>
            </table>
         </div>
         <div><p></p></div>
         
         <div class = "scrollHiddenResources" id = "resourceDisplay">
         test
         </div>
         
         <?php         
      }
      
      
      
	?>
</body>
</html>