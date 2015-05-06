<?php
include '../model/loginValid.php';
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Festival</title>

    <link rel="stylesheet" href="../css/uvmta.css" />
    <script type="text/javascript" src = "../js/ajax.js"></script>
    <script src="../js/app.min.js"></script>
    <script src="../js/jquery.js"></script>
    <!--
     Date Picker Jquery Statements and style sheet
    -->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

   <script>
     $(function() {
           $( "#festivalDate" ).datepicker({dateFormat: 'yy-mm-dd'});
        });
     $(function() {
           $( "#alternateDate" ).datepicker({dateFormat: 'yy-mm-dd'});
        });
     $(function() {
           $( "#regEndDate" ).datepicker({dateFormat: 'yy-mm-dd'});
        });

     $(function() {
           $( "#eFestivalDate" ).datepicker({dateFormat: 'yy-mm-dd'});
        });
     $(function() {
           $( "#eAlternateDate" ).datepicker({dateFormat: 'yy-mm-dd'});
        });
     $(function() {
           $( "#eRegEndDate" ).datepicker({dateFormat: 'yy-mm-dd'});
        });

    </script>
    <script type="text/javascript">  
      function festivalList(sortBy)
      {
         if (arguments.length == 0)
         {
            sortBy = "festivalDate";
         }
         var queryString = "?teacherId=<?php print $_SESSION['teacherId'] ?>&sortBy=" + sortBy;
         ajaxRequest("../model/festivalList.php",queryString,"festivalList",1);
         var menuItem = document.getElementById('miFestivals');
         menuItem.className = menuItem.className + "menuSelected";
      }

      function addFestival()
      {
         var festivalName = document.getElementById('festivalName').value;
         var festivalDate = document.getElementById('festivalDate').value;
         var altFestDate = document.getElementById('alternateDate').value;
         var regFee = document.getElementById('regFee').value;
         var regFeeAlt = document.getElementById('regFeeAlt').value;

         var regEndDate = document.getElementById('regEndDate').value;
         var regOpen = document.getElementById('regOpen').value;
         var regOpenEarly = document.getElementById('regOpenEarly').value;
         var currentFestival = document.getElementById('currentFestival').value;
         var query="?teacherId=<?php print $_SESSION['teacherId'] ?>&festivalName=" + festivalName +
                "&festivalDate=" + festivalDate + "&altFestDate=" + altFestDate + "&regFee=" + regFee +
                 "&regFeeAlt=" + regFeeAlt + "&regOpen=" + regOpen + "&regOpenEarly=" + regOpenEarly +
                 "&regEndDate=" + regEndDate + "&currentFestival=" + currentFestival;
         var query = query.replace(/ /g, "+");

         if (validateForm())
         {
            ajaxRequest("../model/addFestival.php?", query, "error", 1);
            festivalList();
            clearForm();
            $('#editBox').hide()            
         }
      }


      function modifyFestival(festivalId,festivalName,festivalDate,alternateDate,regFee,regFeeAlt,
                              regOpen,regOpenEarly,regEndDate,currentFestival)
      {
         document.getElementById('eFestivalId').value = festivalId;
         document.getElementById('eFestivalName').value = festivalName;
         document.getElementById('eFestivalDate').value = festivalDate;
         document.getElementById('eAlternateDate').value = alternateDate;
         document.getElementById('eRegFee').value = regFee;
         document.getElementById('eRegFeeAlt').value = regFeeAlt;

         document.getElementById('eRegOpen').value = regOpen;
         document.getElementById('eRegOpenEarly').value = regOpenEarly;
         document.getElementById('eRegEndDate').value = regEndDate;
         document.getElementById('eCurrentFestival').value = currentFestival;
      }



      function updateFestival()
      {
         var festivalId = document.getElementById('eFestivalId').value;
         var festivalName = document.getElementById('eFestivalName').value;
         var festivalDate = document.getElementById('eFestivalDate').value;
         var altFestDate = document.getElementById('eAlternateDate').value;
         var regFee = document.getElementById('eRegFee').value;
         var regFeeAlt = document.getElementById('eRegFeeAlt').value;

         var regOpen = document.getElementById('eRegOpen').value;
         var regOpenEarly = document.getElementById('eRegOpenEarly').value;
         var regEndDate = document.getElementById('eRegEndDate').value;
         var currentFestival = document.getElementById('eCurrentFestival').value;
            
         var queryString = "?festivalId=" + festivalId + "&festivalName=" + festivalName +
                           "&festivalDate=" + festivalDate +
                           "&altFestDate=" + altFestDate + "&regFee=" + regFee + "&regFeeAlt=" + regFeeAlt +
                           "&regOpen=" + regOpen + "&regOpenEarly=" + regOpenEarly + "&regEndDate=" + regEndDate +
                           "&currentFestival=" + currentFestival;

         var queryString = queryString.replace(/ /g, "+");

         if (validateModifyForm())
         {
            ajaxRequest("../model/updateFestival.php", queryString,"error", 1);
            festivalList();
         }
         $('#modifyBox').hide()
         clearForm();
      }

      function dropFestival(festivalId,festivalName, currentFestival)
      {
         if (currentFestival == "Y")
         {
            alert("You cannot remove a festival marked as 'ACTIVE' festival.");
         }
         else
         {
            var warning = "Are you sure you want to remove '" + festivalName + "'? " +
                           "\nAll registered students will be unregistered!" +
                           "\nAll timeslots will be removed!"; 
            var response = confirm(warning);
            if (response == true)
            {
              // remove timeslots and registration records for this festival
              var queryString = "?festivalId=" + festivalId ;
              ajaxRequest("../model/dropTimeSlots.php",queryString,"error",1); 

              // remove the festival record 
              var queryString = "?teacherId=<?php print $_SESSION['teacherId'] ?>&festivalId=" + festivalId +
                                 "&festivalName=" + festivalName;
              ajaxRequest("../model/dropFestival.php",queryString,"error",1);              

            }
         }
         festivalList();
      }


      function generateTimeSlots(sortBy,resourceId,festivalId,festivalDate,alternateDate)
      {
        
         var queryString = "resourceId=" + resourceId + "&festivalId=" + festivalId;       
         ajaxRequest("../model/builtSlotsSelect.php?",queryString,"okToBuildSlots",1);
         var okToGenerate = document.getElementById("okToBuildSlots").innerHTML;
         if (okToGenerate == "N")
         {
            alert ("Timeslots have already been build for this festival!");
            return;
         }

         var response = confirm ( "Warning:\n\n To regenerate timeslots all currently registered students must be deleted!\n\n" +
                                  "Are you sure?" );
         if (response == true)
         {
            if(arguments.length == 0)
            {
               sortBy = "room";
            }
              var queryString = "?sortBy=" + sortBy + "&resourceId=" + resourceId +
                                "&festivalId=" + festivalId + "&festivalDate=" + festivalDate +
                                "&alternateDate=" + alternateDate;
              ajaxRequest("../model/generateTimeSlots.php",queryString,"error",1);
         }
      }

      function dropTimeSlots(festivalId)
      {
         var response = confirm ("This will remove ALL timeslots for all resources \n and all registration records for this festival. \n\n  Are you sure?");
         if (response == true)
         {
            var queryString = "?festivalId=" + festivalId ;
            ajaxRequest("../model/dropTimeSlots.php",queryString,"error",1);
         }
      }


      function clearForm()
      {
         document.getElementById('festivalName').value = "";
         document.getElementById('festivalDate').value = "";
         document.getElementById('alternateDate').value = "";
         document.getElementById('regEndDate').value = "";
         document.getElementById('regFee').value = "";
         document.getElementById('regFeeAlt').value = "";
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

      function validateDate()
      {
         var dateToCheck =  this.value;   
      }

      // validate the Add dialog box
      function validateForm()
      {
         if (document.getElementById("festivalName").value != "" &&
             document.getElementById("festivalDate").value != "" &&
             document.getElementById("alternateDate").value != "" &&
             document.getElementById("regFee").value != "" &&
             document.getElementById("regFeeAlt").value != "" )
         {
            return true;
         }
         else
         {
            alert("Please fill out all fields");
            document.getElementById("festivalName").focus();
            return false;
         }  
      }

      // validate the Modify dialog box
      function validateModifyForm()
      {
         if (document.getElementById("eFestivalName").value != "" &&
             document.getElementById("eFestivalDate").value != "" &&
             document.getElementById("eAlternateDate").value != "" &&
             document.getElementById("eRegFee").value != "" &&
             document.getElementById("eRegFeeAlt").value != "" )
         {
            return true;
         }
         else
         {
            alert("Please fill out all fields");
            document.getElementById("eFestivalName").focus();
            return false;
         }  
      }


    </script>
  </head>
  <body onload="festivalList()">
    <?php include("../menu.php"); ?>

    <div id="master scrollable">
      <div class="content" onmousedown = "clearErrorField()">
        <p class = "center">
          <button class='center' onclick="$('#editBox').show();">Add Festival</button>
        </p>
         
         <!-- Error messages and user feed back message go in the paragraph -->
         <p id = "error" class = "center" style = "color: red" onmousedown = "clearErrorField()">&nbsp;</p>    

         <div id="festivalList">
         </div>

       <div id="addFestival">
          <form id='editBox' class='editBox'>
            <h2> Add a Festival </h2>
            <img src="../close.png" onclick="$('#editBox').hide();"/>
            
              <label style = "visibility: hidden" >Festival Id </label>
              <input type="text" id="festivalId" size = "3" maxlength = "3"
                   style = "visibility: hidden"/>
              <label>Festival Name</label>
              <input type="text" id="festivalName" size = "26" maxlength = "26" onfocus = "clearErrorField()"/>
              <label>Festival Date</label>
              <input type="text" id="festivalDate" size = "12" maxlength = "12" onchange = "validateDate()"/>
              <label>Alternate Date</label>
              <input type="text" id="alternateDate" size = "12" maxlength = "12" onchange = "validateDate()" />
              <label>Festival Fee</label>
              <input type="text" id="regFee" size = "6" maxlength = "6" />
              <label>Alternate Fee</label>
              <input type="text" id="regFeeAlt" size = "6" maxlength = "6" />
              <label>Active Festival</label>
                   <select id = "currentFestival"  name="currentFestival">
                     <option value = "N" selected = "selected" >No</option>
                     <option value = "Y" >Yes</option>
                  </select>
              <label>Registration Open</label>
                   <select id = "regOpen"  name="regOpen">
                     <option value = "N" selected = "selected" >No</option>
                     <option value = "Y" >Yes</option>
                  </select>
              <label>Early Registration</label>
                 <select id = "regOpenEarly"  name="regOpenEarly">
                   <option value = "N" selected = "selected" >No</option>
                   <option value = "Y" >Yes</option>
                </select>
                
                <label>Registration Ends</label>
                <input type="text" id="regEndDate" size = "12" maxlength = "12" onchange = "validateDate()" />                     

             <p class = "center">
               <input id = "clear" class = "center" type="reset" value="Clear Form"  />
               <input id = "updateButton" class = "center" type="button" value="Add Festival"
                  onclick = "addFestival()"   style = "visibility: visible" />
            </p>
          </form>
         </div>

         <!--  Update festival form -->
         <div id="updateFestival">
          <form id='modifyBox' class='editBox'>
            <h2>Update Festival </h2>
            <img src="../close.png" onclick="$('#modifyBox').hide();"/>
            
              <label style = "visibility: hidden" >Festival Id </label>
              <input type="text" id="eFestivalId" size = "3" maxlength = "3"
                   style = "visibility: hidden"/>
              <label>Festival Name</label>
              <input type="text" id="eFestivalName" size = "26" maxlength = "26" onfocus = "clearErrorField()"/>
              <label>Festival Date</label>
              <input type="text" id="eFestivalDate" size = "12" maxlength = "12" onchange = "validateDate()"/>
              <label>Alternate Date</label>
              <input type="text" id="eAlternateDate" size = "12" maxlength = "12" onchange = "validateDate()" />
              <label>Festival Fee</label>
              <input type="text" id="eRegFee" size = "6" maxlength = "6" />
              <label>Alternate Fee</label>
              <input type="text" id="eRegFeeAlt" size = "6" maxlength = "6" />
              <label>Active Festival</label>
                   <select id = "eCurrentFestival"  name="currentFestival">
                     <option value = "N" selected = "selected" >No</option>
                     <option value = "Y" >Yes</option>
                  </select>
              <label>Registration Open</label>
                   <select id = "eRegOpen"  name="regOpen">
                     <option value = "N" selected = "selected" >No</option>
                     <option value = "Y" >Yes</option>
                  </select>
              <label>Early Registration</label>
                 <select id = "eRegOpenEarly"  name="regOpenEarly">
                   <option value = "N" selected = "selected" >No</option>
                   <option value = "Y" >Yes</option>
                </select>
                
                <label>Registration Ends</label>
                <input type="text" id="eRegEndDate" size = "12" maxlength = "12" onchange = "validateDate()" />                     

            <p class = "center">
               <input id = "updateButton" class = "center" type="button" value="Update Festival"
                  onclick = "updateFestival()"   style = "visibility: visible" />
               <input id = "clear" class = "center" type="reset" value="Clear Form" />
            </p>
          </form>
         </div>

         <span id = "okToBuildSlots" style = "display: none" >N</span>  <!-- use for communication by builtSlotsSelect.php -->

      </div>
    </div>
    <script type="text/javascript">
    </script>
  </body>
</html>
