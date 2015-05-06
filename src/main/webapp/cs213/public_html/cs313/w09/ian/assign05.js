//Global variable: Holds current update response
var gUpdateResponse = "";

//Global Variable: Holds Current Table Data
var gTableData = new Array();

//Global variable: sort column
var gSortCol = 1;

//Global variable: sort Direction
var gSortDir = 1;

function search()
{
  //insert search function here   
}

function clearFields()
{
   clearAllTB();
   document.getElementById("btnModify").disabled = false;
   document.getElementById("btnModify").value = "Modify";
   document.getElementById("btnRemove").disabled = false;
   document.getElementById("btnRemove").value = "Remove";
   document.getElementById("btnAdd").disabled = false;
   document.getElementById("btnAdd").value = "Add";
}

/******************************************************************************
* Function Name: resetFieldColor
* Purpose: Changes all input field classes back to white.
* Parameters: none
* Author: Ian Karlinsey
******************************************************************************/
function resetFieldColor()
{
   document.getElementById("txtFirstName").className="white";
   document.getElementById("txtLastName").className="white";
   document.getElementById("txtMajor").className="white";
   document.getElementById("txtGender").className="white";
   document.getElementById("txtCity").className="white";
   document.getElementById("txtState").className="white";
   document.getElementById("errorMsg").style.display = "none";
   document.getElementById("txtBirthYear").className="white";
   document.getElementById("txtBirthDay").className="white";
   document.getElementById("txtBirthMonth").className="white";
}

/******************************************************************************
* Function Name: validateFields
* Purpose: Validates all fields on the form making sure they have data.
* Parameters: none
* Author: Ian Karlinsey
******************************************************************************/
function validateFields()
{
   var retValue = true;
   var fldFirstName = document.getElementById("txtFirstName");
   var fldLastName = document.getElementById("txtLastName");
   var fldMajor = document.getElementById("txtMajor");
   var fldGender = document.getElementById("txtGender");
   var fldCity = document.getElementById("txtCity");
   var fldState = document.getElementById("txtState");
   var fldBirthYear = document.getElementById("txtBirthYear");
   var fldBirthMonth = document.getElementById("txtBirthMonth");
   var fldBirthDay = document.getElementById("txtBirthDay");

   if (fldBirthYear.value == "" )
   {
      fldBirthYearclassName="red";
      retValue = false;
   }

   if (parseInt(fldBirthMonth.value) > 12 || parseInt(fldBirthMonth.value) < 1)
   {
      fldBirthMonth.className="red";
      alert("Month must be a value between 1 and 12");
      retValue = false;
   }

   if (parseInt(fldBirthDay.value) > 31 || parseInt(fldBirthDay.value) < 1)
   {
      fldBirthDay.className="red";
      alert("Day must be a value between 1 and 31");
      retValue = false;
   }

   if (parseInt(fldBirthYear.value) > 2009 || parseInt(fldBirthYear.value) < 1900)
   {
      fldBirthYear.className="red";
      alert("Year must be a value between 1900 and 2009");
      retValue = false;
   }
 
   if (fldBirthMonth.value == "")
   {
      fldBirthMonth.className="red";
      retValue = false;
   }
   if (fldBirthDay.value == "")
   {
      fldBirthDay.className="red";
      retValue = false;
   }
   if (fldFirstName.value == "")
   {
      fldFirstName.className="red";
      retValue = false;
   }
   if (fldLastName.value == "")
   {
      fldLastName.className="red";
      retValue = false;
   }
   if (fldMajor.value == "")
   {
      fldMajor.className="red";
      retValue = false;
   }
   if (fldGender.value == "")
   {
      fldGender.className="red";
      retValue = false;
   }
   if (fldCity.value == "")
   {
      fldCity.className="red";
      retValue = false;
   }
   if (fldState.value == "")
   {
      fldState.className="red";
      retValue = false;
   }

   if(retValue)
   {
      document.getElementById("errorMsg").style.display = "none";
   }
   else
   {
      document.getElementById("errorMsg").style.display = "block";
   }
   return retValue;
}

/******************************************************************************
* Function Name: removeRow 
* Purpose: Removes the selected row by sending a remove command to the database
* Parameters: none
* Author: Ian Karlinsey
******************************************************************************/
function removeRow()
{
   
   var TableList = document.getElementById("TableList");
   if (TableList.selectedIndex >= 0)
   {
      var cOptions = TableList.options;
      var tCols = gTableData[TableList.selectedIndex].split(",");
      var command = "remove&studentId=" + tCols[0];
      if (confirm("Delete entry with Student ID#" + tCols[0] + "?"))
      {
         sendCommand(command);
         document.getElementById("btnRemove").disabled = true;
         document.getElementById("btnRemove").value = "Removing...";
      }  
   }
   else
   {
      alert("You must select a row to remove.");
   }
}

/******************************************************************************
* Function Name: modifyRow 
* Purpose: Checks fields to see which ones have changed.  Sends studentID
* and anyfields to database for change.
* Parameters: none
* Author: Ian Karlinsey
******************************************************************************/
function modifyRow()
{
   var TableList = document.getElementById("TableList");
   if (TableList.selectedIndex >= 0)
   {  
      if(validateFields())
      {
         var command = "modify&";
         var cOptions = TableList.options;
         var tCols = gTableData[TableList.selectedIndex].split(",");
         var fldFirstName = document.getElementById("txtFirstName").value;
         var fldLastName = document.getElementById("txtLastName").value;
         var fldMajor = document.getElementById("txtMajor").value;
         var fldGender = document.getElementById("txtGender").value;
         var fldCity = document.getElementById("txtCity").value;
         var fldState = document.getElementById("txtState").value;
         var fldBirthYear = document.getElementById("txtBirthYear").value;
         var fldBirthMonth = document.getElementById("txtBirthMonth").value;
         var fldBirthDay = document.getElementById("txtBirthDay").value;
         var birthDate = fldBirthYear + "-" + fldBirthMonth + "-" + fldBirthDay;

         command = command + (fldFirstName == tCols[1] ? "" : "firstName=" + fldFirstName + "&");
         command = command + (fldLastName == tCols[2] ? "" : "lastName=" + fldLastName + "&");
         command = command + (fldMajor == tCols[3] ? "" : "major=" + fldMajor + "&");
         command = command + (birthDate == tCols[4] ? "" : "birthDate=" + birthDate + "&");
         command = command + (fldGender == tCols[5] ? "" : "gender=" + fldGender + "&");
         command = command + (fldCity == tCols[6] ? "" : "city=" + fldCity + "&");
         command = command + (fldState == tCols[7] ? "" : "state=" + fldState);
         if (command.length > 0 && command.substring(command.length - 1, command.length) == "&")
         {
            command = command.substring(0, command.length - 1);
         }
   
         if (command == "modify")
         {  
            alert("Nothing has changed!");
         }
         else
         {
            if (confirm("Modify entry with Student ID#" + tCols[0] + "?"))
            {
               document.getElementById("btnModify").disabled = true;
               document.getElementById("btnModify").value = "Modifying...";
               command = command + "&studentId=" + tCols[0];      
               sendCommand(command);
            }
         }
         resetFieldColor();
      }
   }
   else
   {
      alert("You must select a row to modify.");
   }
}

/******************************************************************************
* Function Name: addRow
* Purpose: Adds a blank row to the list box
* Parameters: none
* Author: Ian Karlinsey
******************************************************************************/
function insertRow()
{
   if(validateFields())
   {
      var command = "add&";
      var TableList = document.getElementById("TableList");
      var cOptions = TableList.options;
      var fldFirstName = document.getElementById("txtFirstName").value;
      var fldLastName = document.getElementById("txtLastName").value;
      var fldMajor = document.getElementById("txtMajor").value;
      var fldGender = document.getElementById("txtGender").value;
      var fldCity = document.getElementById("txtCity").value;
      var fldState = document.getElementById("txtState").value;
      var fldBirthYear = document.getElementById("txtBirthYear").value;
      var fldBirthMonth = document.getElementById("txtBirthMonth").value;
      var fldBirthDay = document.getElementById("txtBirthDay").value;

      command = command + ("firstName=" + fldFirstName + "&");
      command = command + ("lastName=" + fldLastName + "&");
      command = command + ("major=" + fldMajor + "&");
      command = command + ("birthDate=" + fldBirthYear + "-" + 
                   fldBirthMonth + "-" + fldBirthDay + "&");
      command = command + ("gender=" + fldGender + "&");
      command = command + ("city=" + fldCity + "&");
      command = command + ("state=" + fldState);

      if(command.length > 0 && command.substring(command.length - 1, command.length) == "&")
      {
         command = command.substring(0, command.length - 1);
      }
      if (confirm("Add " + fldFirstName + " " + fldLastName + " to the database?"))
      {
         document.getElementById("btnAdd").disabled = true;
         document.getElementById("btnAdd").value = "Adding...";
         sendCommand(command);
         resetFieldColor();
      }
   }
}

/******************************************************************************
* Function Name: deleteRow
* Purpose: Sends a delete command to the php
* Parameters: studentId
* Author: Ian Karlinsey
******************************************************************************/
function deleteRow(studentId)
{
    sendCommand("remove&studentId=" + studentId); 
}

/******************************************************************************
* Function Name: sortByColumn
* Purpose: Constructs a string of columns to display in the table in the form of:
* Parameters: column number as an integer from 1 to 8
* Author: Ian Karlinsey
******************************************************************************/
function sortByColumn(pCol)
{
   clearAllTB();
   gSortCol = parseInt(pCol);
   if (gSortDir)
   {
      gSortDir = 0;
   }
   else
   {
      gSortDir = 1;
   }

   var temp = gTableData.sort(sortFirstName);
   gTableData = temp;
   updateTable();
}

/******************************************************************************
* Function Name: sortFirstName
* Purpose: Constructs a string of columns to display in the table in the form of:
* Parameters: Two Strings
* Author: Ian Karlinsey
******************************************************************************/
function sortFirstName(a, b)
{   
     var aCols = a.split(",");
     var bCols = b.split(",");
     var x = "";
     try
     {
        x = aCols[gSortCol].toLowerCase(); 
     }
     catch(ex)
     {    
     }

     var y = "";
     try
     {
        y = bCols[gSortCol].toLowerCase();
     }
     catch(ex)
     {
     }

     var result;
     if (gSortDir)
     {
        result = ((x < y) ? -1 : ((x > y) ? 1 : 0));
     }
     else
     {
        result = ((x > y) ? -1 : ((x < y) ? 1 : 0));
     }
     return result;
}

/******************************************************************************
* Function Name: buildRow
* Purpose: Constructs a string of columns to display in the table in the form of:
* Parameters: StudentId, FirstName, LastName, MajorCode, BirthDate, Gender, City, State
* Author: Ian Karlinsey
******************************************************************************/
function buildRow(StudentId, FirstName, LastName, MajorCode, BirthDate, Gender, City, State)
{
   var mRow = "";
   mRow = mRow + setw(StudentId, 5, 1) + " | ";
   mRow = mRow + setw(FirstName, 10, 0) + " | ";
   mRow = mRow + setw(LastName, 10, 0) + " | ";
   mRow = mRow + setw(MajorCode, 3, 1) + " | "; 
   mRow = mRow + setw(BirthDate, 10, 1) + " | ";
   mRow = mRow + setw(Gender, 1, 1)  + " | ";
   mRow = mRow + setw(City, 12, 0)  + " | ";
   mRow = mRow + setw(State, 2, 1);
   return mRow;
}

/******************************************************************************
* Function Name: addRow
* Purpose: Adds rows to a table.  
* Parameters: pRow to be added
* Author: Ian Karlinsey
******************************************************************************/
function addRow(pRow, pTable, pPos)
{
    var newOption = document.createElement('option');
    var browser=navigator.appName;
       
    if (browser=="Microsoft Internet Explorer")
    {
       newOption.value = pPos; 
       newOption.text = pRow;
    }
    else
    { 
       newOption.innerHTML = pRow;
    }
    try
    {
       pTable.options.add(newOption, pPos);
    }
    catch(ex)
    {
    }
}

/******************************************************************************
* Function Name: setw
*
* Purpose:  Sets the width of a string by either padding it with spaces or by
*           shortening it. The first parameter is the string, the second parameter
*           is the desired length and the third parameter should be a boolean
*           and dictates whether the spaces should be padded on the front of the
*           string or at the end.
*
* Parameters: String, DesiredLength, Padbefore?
*
* Author: Ian Karlinsey
******************************************************************************/
function setw(pStr, pLen, before)
{
   var browser=navigator.appName;
   var nbSpace = "&nbsp;";
   if (browser=="Microsoft Internet Explorer")
   {
      nbSpace = " ";  
   }
   var rStr = pStr;
   var spaceToAdd = 0;
   if (rStr.length > pLen)
   {
      rStr = rStr.substring(0,pLen);
   }
   else
   {
      spaceToAdd = pLen - rStr.length;
   }
   for(j = 0; j < spaceToAdd; j++)   
   {
      if(before)
      {  
         rStr = nbSpace + rStr;
      }
      else
      {
         rStr = "" + rStr + nbSpace;
      }
   }
   return rStr;
}

/******************************************************************************
* Function Name: sendCommand
* Purpose: Sends a command to the PHPserver
*          Valid Commands:
*             update      Gets a full updated list of the table
*             add         Adds a row to the table
*             modify      changes a table row
*             remove      Removes a table row
* Parameters: command to be sent as a string, columns needed by command
*             columns should be listed in query form. I.E. StudentId=
* Author: Ian Karlinsey
******************************************************************************/
function sendCommand(command)
{
   var xmlReq;

   try //figure out which browser is being used
   {
      // Firefox
      xmlReq=new XMLHttpRequest();
   }
   catch (e)
   {
      // Internet Explorer
      try
      {
         xmlReq=new ActiveXObject("Msxml2.XMLHTTP");
      }
      catch (e)
      {
          xmlReq=new ActiveXObject("Microsoft.XMLHTTP");
      }
   }

   var page = "http://157.201.194.254/~ercanbracks/cs313/w09/ian/assign05.php?command=";
   var now = new Date();

   page = page + command + "&date=" + now.getTime();


   if (page != "")
   {
      xmlReq.open('GET', page);

      xmlReq.onreadystatechange=function()
      {
         if(xmlReq.readyState==4)
         {
            parseResponse(xmlReq.responseText); 
         }
      }
      xmlReq.send(null);
   }  
}

/******************************************************************************
* Function Name: parseResponse
* Purpose: Parses reply from the server
* Parameters: server response
* Author: Ian Karlinsey
******************************************************************************/
function parseResponse(response)
{
   var rspCode = parseInt(response.substring(0,1)); //get response code     
   var errorCode;
   switch(rspCode)
   {
      case 1: //Table Update
        gUpdateResponse  = response.substring(1, response.length);
        gTableData = gUpdateResponse.split("\n"); 
        updateTable();
      break;
       
      case 2: //Row successfully deleted.
         alert(response.substring(1,response.length));
         document.getElementById("btnRemove").disabled = false;
         document.getElementById("btnRemove").value = "Remove";
         clearAllTB();
         sendCommand('update'); 
      break;   

      case 3: //Row modified.
         alert(response.substring(1,response.length));
         document.getElementById("btnModify").disabled = false;
         document.getElementById("btnModify").value = "Modify"; 
         clearAllTB();
         sendCommand('update');
      break;

      case 4: //Row Successfully added.
         alert(response.substring(1,response.length));
         document.getElementById("btnAdd").disabled = false;
         document.getElementById("btnAdd").value = "Add";
         clearAllTB();
         sendCommand('update'); 
      break;

      case 5: //Failure to connect to database
         errorCode = response.subString(1, response.length);
         alert("Failed to connect to the database:" + errorCode);
      break;
   }
}

/******************************************************************************
* Function Name: updateTable
* Purpose: updates the current table view from the global table data variable
*          gTableData
* Parameters: none
* Author: Ian Karlinsey
******************************************************************************/
function updateTable()
{   
   var tbl = document.getElementById("TableList");    

   for( i = tbl.options.length - 1; i >= 0; i--)
   {
      tbl.remove(i);
   }
   for( i = 0; i < (gTableData.length); i++)
   {
      var tCols = gTableData[i].split(",");
      if(tCols.length == 8)
      {
         var row = buildRow(tCols[0], tCols[1], tCols[2], tCols[3], tCols[4], tCols[5], tCols[6], tCols[7]);
         addRow(row, tbl, i);   
      }
   }
}

/******************************************************************************
* Function Name: getColumns
* Purpose: Loads column data from table into textboxes for editing
* Parameters: none
* Author: Ian Karlinsey
******************************************************************************/
function getColumns()
{
   resetFieldColor();   
   var TableList = document.getElementById("TableList");
   var cOptions = TableList.options;
   var tCols = gTableData[TableList.selectedIndex].split(",");
   document.getElementById("txtFirstName").value = tCols[1];
   document.getElementById("txtLastName").value = tCols[2];
   document.getElementById("txtMajor").value = tCols[3];
   document.getElementById("txtGender").value = tCols[5];
   document.getElementById("txtCity").value = tCols[6];
   document.getElementById("txtState").value = tCols[7];

   var tBirthDate = tCols[4].split("-");
   document.getElementById("txtBirthYear").value = tBirthDate[0];
   document.getElementById("txtBirthMonth").value = tBirthDate[1];
   document.getElementById("txtBirthDay").value = tBirthDate[2];
}

/******************************************************************************
* Function Name: clearTB
* Purpose: Clears a single text box on the page
* Parameters: id of the text box
* Author: Ian Karlinsey
******************************************************************************/
function clearTB(pTBName)
{
   document.getElementById(pTBName).value = "";
}

/******************************************************************************
* Function Name: clearAllTB
* Purpose: Clears all text boxes on the page
* Parameters: none
* Author: Ian Karlinsey
******************************************************************************/
function clearAllTB()
{
   resetFieldColor();
   clearTB("txtState");
   clearTB("txtCity");
   clearTB("txtGender");
   clearTB("txtMajor");
   clearTB("txtLastName");
   clearTB("txtFirstName");
   clearTB("txtBirthYear");
   clearTB("txtBirthMonth");
   clearTB("txtBirthDay");
}

/******************************************************************************
* Function Name: keypressNumbersOnly
* Purpose: Returns true only if it receives a key code event, and that
*          keycode corresponds to a number or other control characters
*          such as backspace, delete, etc.
* Parameters: keypressNumbersOnly(event)
* Example: onkeypress="return keypressNumbersOnly(event);"
* Author: Ian Karlinsey ©2009
******************************************************************************/
function keypressNumbersOnly(evt)
{
   var character = (evt.which) ? evt.which : event.keyCode;
   if (character > 31 && (character < 48 || character > 57))
   {
      return false;
   }
   return true;
}

/******************************************************************************
* Function Name: keypressGender
* Purpose: Returns true only if it receives a key code event, and that
*          keycode corresponds to F f M m or other control characters
*          such as backspace, delete, etc.
* Parameters: keypressNumbersOnly(event)
* Example: onkeypress="return keypressGender(event);"
* Author: Ian Karlinsey ©2009
******************************************************************************/
function keypressGender(evt)
{
   var character = (evt.which) ? evt.which : event.keyCode;
   if (character < 32 || character == 77 || character == 109 || 
       character == 102 || character == 70)
   {
      return true;
   }

   return false;
}

/******************************************************************************
* Function Name: keypressLettersOnly
* Purpose: Returns true only if it receives a key code event, and that
*          keycode corresponds to a letter or other control characters
*          such as backspace, delete, etc.
* Parameters: keypressLettersOnly(event)
* Example: onkeypress="return keypressLettersOnly(event);"
* Author: Ian Karlinsey ©2009
******************************************************************************/
function keypressLettersOnly(evt)
{
   var character = (evt.which) ? evt.which : event.keyCode;
   if (character < 31 || (character > 64 && character < 91) || 
         (character > 96 && character < 123))
   {
      return true;
   }
   return false;
}

/******************************************************************************
* Function Name: keypressLettersSpaceOnly
* Purpose: Returns true only if it receives a key code event, and that
*          keycode corresponds to a letter or other control characters
*          such as backspace, delete, etc.
* Parameters: keypressLettersOnly(event)
* Example: onkeypress="return keypressLettersOnly(event);"
* Author: Ian Karlinsey ©2009
******************************************************************************/
function keypressLettersSpaceOnly(evt)
{
   var character = (evt.which) ? evt.which : event.keyCode;
   if (character < 31 || (character > 64 && character < 91) || 
         (character > 96 && character < 123) ||
         character == 32)
   {
      return true;
   }
   return false;
}

/******************************************************************************
* Function Name: autoTabForward
* Purpose: Sets focus to the forwardTab form element if the current element
*          recieves a backspace keystroke and its value is empty. Should be
*          used with onkeydown event.
* Parameters: autoTabForward(Event evt, String nextElement)
* Example: onkeydown="autoTabForward(event, 'phoneSuffix');"
* Author: Ian Karlinsey ©2008
******************************************************************************/
function autoTabForward(evt, nextElement)
{
   var character = (evt.which) ? evt.which : event.keyCode;

   //firefox uses .target
   var callingObject = evt.target;

   //internet explorer uses .srcElement
   if (typeof(callingObject) == "undefined")
   {
      callingObject = evt.srcElement;
   }

   if (character > 47 && character < 58)
   {
      if (String(callingObject.value).length >=
          callingObject.getAttribute("maxlength"))
      {
        document.getElementById(nextElement).select();
      }
   }
}

/******************************************************************************
* Function Name: autoTabBackward
* Purpose: Sets focus to the previousElement form element if the current
*          element is empty and the backspace key is pressed.
* Parameters: autoTabBackward(Event evt, String previousElement)
* Example: onkeyup="autoTabBackward(event, 'phoneSuffix');"
* Author: Ian Karlinsey ©2008
******************************************************************************/
function autoTabBackward(evt, previousElement)
{
   var character = (evt.which) ? evt.which : event.keyCode;

   //firefox uses .target
   var callingObject = evt.target;

   //internet explorer uses .srcElement
   if (typeof(callingObject) == "undefined")
   {
      callingObject = evt.srcElement;
   }

   if (character == 8)
   {
      if (String(callingObject.value).length == 0)
      {
         var prevElem = document.getElementById(previousElement);

         //force cursor to the end of the textbox
         if (navigator.userAgent.indexOf("MSIE") > 1)
         {
           var sRange = prevElem.createTextRange();
           sRange.moveEnd("textedit");
           sRange.moveStart("textedit");
           sRange.select();
         }

         prevElem.focus();
      }
   }
}
