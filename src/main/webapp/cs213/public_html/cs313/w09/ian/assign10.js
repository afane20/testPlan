var gStudents = new Array();
var gEvents = new Array();
var gMyTeacherId;
var gInstruments = new Array();
var gGeneric = new Array();

/******************************************************************************
* Function Name: sendCommand
* Purpose: Sends a command to the PHPserver
*          Valid Commands:
*             validate    checks a password against an email address
*             studentlist gets an updated student list table
*
* Parameters: command to be sent as a string, columns needed by command
*             columns should be listed in query form. I.E. StudentId=
* Author: Ian Karlinsey
******************************************************************************/
function sendCommand(pCommand, pTarget)
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
               
   var page = "http://157.201.194.254:8080/cs313/servlet/w09.festival.assign10?command=";
   var now = new Date();

   page = page + pCommand + "&date=" + now.getTime();


   if (page != "")
   {
      xmlReq.open('GET', page);

      xmlReq.onreadystatechange=function()
      {
         if(4 == xmlReq.readyState)
         {
            if (200==xmlReq.status) 
            { 
               //alert(xmlReq.responseText);
               var targetElement = document.getElementById(pTarget);
               var response = xmlReq.responseText;
               targetElement.innerHTML = response;
               var tEval = document.getElementById("tEval");
               if(tEval)
               {
                  eval(tEval.value);
                  //alert("executed: " + tEval.value);
               }
               else
               {
                  //alert("no evaluator");
               }
            }
         }
      }
      xmlReq.send(null);
   }  
}

/******************************************************************************
* Function Name: sendCommand
* Purpose: Sends a command to the PHPserver
*          Valid Commands:
*             validate    checks a password against an email address
*             studentlist gets an updated student list table
*
* Parameters: command to be sent as a string, columns needed by command
*             columns should be listed in query form. I.E. StudentId=
* Author: Ian Karlinsey
******************************************************************************/
function sendRequest(pCommand, pTarget)
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
               
   var page = "http://157.201.194.254:8080/cs313/servlet/w09.festival.assign10?command=";
   var now = new Date();
   page = page + pCommand + "&date=" + now.getTime();

   if (page != "")
   {
      xmlReq.open('GET', page);

      xmlReq.onreadystatechange=function()
      {
         if(4 == xmlReq.readyState)
         {
            if (200==xmlReq.status) 
            { 
               //alert(xmlReq.responseText);
               if(pTarget)
               {                                      
                  pTarget.length = 0;
                  var lResultStr = xmlReq.responseText;
                  var lResult = new Array();
                  if(lResultStr != "")
                  {
                     lResult = lResultStr.split(";");         
                     for(var i = 0; i < lResult.length; i++)
                     {
                        var temp = new Array();
                        temp = lResult[i].split(",");
                        pTarget[i] = temp;
                     }
                  }
               }
               var tEval = document.getElementById("tEval2");
               if(tEval)
               {
                  eval(tEval.value);
                  //alert("executed2: " + tEval.value);
               }
               else
               {
                  //alert("no evaluator2");
               }
            }
         }
      }
      xmlReq.send(null);
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
* Function Name: addRow
* Purpose: Adds rows to a table.  
* Parameters: pRow       Row to be added
*             pTable     Table as a DOM object
*             pPos       Position in the table
*
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
* Function Name: updateListDisplay
* Purpose: Populates a list
* Parameters: pListId       id of list to be populated
*             pSource       array of row arrays
*             pColWidths    array of corresponding desired column widths
*             pDelim        delimiting character to be used between columns
*             displayCols   array of column numbers to be displayed
*
* Author: Ian Karlinsey
******************************************************************************/
function updateListDisplay(pListId, pSource, pColWidths, pDelim, displayCols) 
{
   var targTable = document.getElementById(pListId);
 
   //remove current list box entries
   if(targTable.options.length > 0)
   {
      for( i = targTable.options.length - 1; i >= 0; i--)
      {
        targTable.remove(i);
     }
   }
    //go through each row, format it and add it to the table
   for(var i = 0; i < pSource.length; i++)
   {
      addRow(formatRow(pSource[i], pColWidths, pDelim, displayCols), targTable, i);
   }
}

/******************************************************************************
* Function Name: formatRow
* Purpose: Formats a row using a list of widths, and columns
* Parameters: pRowArray     array containing columns for the row
*             pColWidths    array containing column width for each column
*             pDelim        delimiting character to be used between columns
*             displayCols   array of column numbers to be displayed
*
* Author: Ian Karlinsey
******************************************************************************/
function formatRow(pRowArray, pColWidths, pDelim, displayCols)
{
   var retRow = "";
   //go through each column in the column list and format it
   for(var j = 0; j < displayCols.length; j++)
   {
      retRow = retRow + setw("" + pRowArray[displayCols[j]], pColWidths[j], false);
      if(j < displayCols.length - 1)
      {
         retRow = retRow + pDelim + " ";
      }
   }
   return retRow;
}

function updateStudents()
{
   var widths = [10,10];
   var cols = [2,1];
   updateListDisplay("StudentList", gStudents, widths, ",", cols);
}

function updateEvents()
{
   var widths = [10,7,7,12];
   var cols = [9,6,2,4];
   updateListDisplay("EventList", gEvents, widths, ",", cols);
}

function updateGeneric()
{
   var widths = [10];
   var cols = [1];
   updateListDisplay("drpGeneric", gGeneric, widths, ",", cols);
}





function tableToFields(global, fields, cols, index)
{
   for (var j = 0; j < fields.length; j++)
   {
      //alert("putting " + global[index][cols[j]] + " into " + fields[j]);  
      document.getElementById(fields[j]).value = global[index][cols[j]];   
   }
}

function selectItem(pListId, pIndex)
{
   document.getElementById(pListId).selectedIndex = pIndex;   
}

function getStateIndex(pAbbr)
{
   var index = 0;
   var states = new Array( "NONE", "AK", "AL", "AR", "AZ", "CA", "CO", "CT",
                           "DE", "FL", "GA", "HI", "IA", "ID", "IL", "IN",
                           "KS", "KY", "LA", "MA", "MD", "ME", "MI", "MN",
                           "MO", "MS", "MT", "NC", "ND", "NE", "NH", "NJ",
                           "NM", "NV", "NY", "OH", "OK", "OR", "PA", "RI",
                           "SC", "SD", "TN", "TX", "UT", "VA", "VI", "VT",
                           "WA", "WI", "WV", "WY");
   for(var j = 0; j < states.length; j++)
   {
      if(pAbbr == states[j])
      {
         index = j;
      }
   }
   return index;
}

/******************************************************************************
* Function Name: validateForm
* Purpose: checks text fields to make sure they are populated
* Parameters: pFormFields          array containing text boxes to check
*             pFormDescriptions    array containing descriptions of the text
*                                  boxes, as displayed to the user.
* Author: Ian Karlinsey
******************************************************************************/
function validateForm(pFormFields, pFormDescriptions)
{
   var retValue = true;
   for (var i = 0; i < pFormFields.length; i++)
   {
      if(document.getElementById(pFormFields[i]).value == "")
      {
         alert("You must provide a " + pFormDescriptions[i]);
         retValue = false;
         i = pFormFields.length;
      }
   }
   return retValue;
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

function menuShow(unorderedList)
{
   document.getElementById(unorderedList).className = "show";
}

function menuHide(unorderedList)
{
   document.getElementById(unorderedList).className = "hide";
}

