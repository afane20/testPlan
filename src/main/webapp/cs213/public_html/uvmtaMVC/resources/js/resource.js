/**********************************************************************
*  These strings must match the level string names in ResourceList.php
*  converts the string name to a number.
**********************************************************************/
function levelNameToNum(levelName)
{
   switch(levelName)
   {
      case "beginners":
         level = 1;
         break;
      case "early inter":
         level = 2;
         break;
      case "beginner/early inter":
         level = 3;
         break;
      case "intermediate":
         level = 4;
         break;      
      case "beg/early inter/inter":
         level = 7;
         break;       
      case "late intermediate":
         level = 8;
         break;
      case "inter/late inter":
         level = 12;
         break;                  
      case "pre-advanced only":
         level = 16;
         break;         
      case "advanced only":
         level = 32;
         break;        
      case "pre-advanced/advanced":
         level = 48;
         break;
      case "All levels":
         level = 63;
      default:
         level = 63;  // All Levels
   }
   return level;
}

/**********************************************************************
*  These strings must match the available string names in ResourceList.php
*  converts the available name to a single letter.
**********************************************************************/
function availableNameToLetter(availableName)
{
   switch(availableName)
   {
      case "Festival Day":
         available = 'F';
         break;
      case "Alternate":
         available = 'A';
         break;
      case "Both":
         available = 'B';
         break;
      case "No":
         available = 'N';
         break;
      default:
         available = 'F';
   }
   return available;
}

/***************************************************
* editResource()
*fills the input fields of editBox with data from selected row
****************************************************/
function editResource(){
   
   var inputs = $('#editBox > input');
   var cells = this.cells;
   document.getElementById('resourceId').value = cells[0].innerHTML;    
   document.getElementById('building').value = cells[1].innerHTML;
   document.getElementById('room').value = cells[2].innerHTML;
   levelName = cells[3].innerHTML;     // get level text
   level = levelNameToNum(levelName);  // convert to level number
   document.getElementById('level').value  = level;
   document.getElementById('startTime').value = cells[4].innerHTML;
   document.getElementById('endTime').value = cells[5].innerHTML;
   document.getElementById('timeIncrement').value = cells[6].innerHTML;
   document.getElementById('pianos').value = cells[7].innerHTML;
   availableName = cells[8].innerHTML;     // F = Festival Day, A = alternate, B = Both, N = No
   available = availableNameToLetter(availableName); // convert letter to text
   document.getElementById('available').value = available;
   document.getElementById('address').value = cells[9].innerHTML;
   document.getElementById('miscInfo').value = cells[10].innerHTML;
   document.getElementById('timeslotsBuilt').value = cells[11].innerHTML;


   showModifyForm();
   $('#boxTitle').html("Modify Resource: &nbsp;&nbsp;" + cells[1].innerHTML + " " + cells[2].innerHTML);
}

