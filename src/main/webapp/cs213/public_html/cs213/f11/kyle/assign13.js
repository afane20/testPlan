// Shorter to type than document.getElementById()
function getID(idStr)
{
  return document.getElementById(idStr);
}

// Get array of elements of a class
function getClass(classStr)
{
  var tl = document.getElementsByTagName("*");
  var cl = new Array();
  j = 0;
  for (var i = 0; i < tl.length; i++)
  {
    if (tl[i].className.indexOf(classStr) != -1)
    {
      cl[j] = tl[i];
      j++;
    }
  }
  return cl;
}

// Shorter to type than document.getElementsByTagName()
function getTag(tagStr)
{
  return document.getElementsByTagName(tagStr);
}

// Add a class to an object
function addClass(object, classStr)
{
  if (object.className.indexOf(classStr) == -1)
  {
    object.className += classStr;
  }
}

// Remove a class from an object
function removeClass(object, classStr)
{
  object.className = object.className.replace(classStr,"");
}

// Remove leading and trailing whitespace
function trim(str)
{
  return str.replace(/^\s*/, "").replace(/\s*$/, "");
}

var xmlhttp;

// Make preparing AJAX objects faster
function setupAJAX(requestObject, handler)
{
  if (window.XMLHttpRequest)    // Handle new and old browsers
    xmlhttp = new XMLHttpRequest();
  else
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

  xmlhttp.onreadystatechange = handler;
}

// Much shorter access to XML Elements
function getXMLByTag(requestObject, tagName)
{
  return requestObject.responseXML.documentElement.getElementsByTagName(tagName);
}

// Shorter access to the text node
function getXMLText(xmlElement)
{
  if (xmlElement == null || xmlElement.firstChild == null)
    return "";
  else
    return xmlElement.firstChild.nodeValue;
}

// Search for nodes with the tagName
function getXMLNodes(element, tagName)
{
  return element.getElementsByTagName(tagName);
}

// Get the text for the requested node (grabs first element)
function getXMLNodeText(element, tagName)
{
  return getXMLText(getXMLNodes(element,tagName)[0]);
}

// Sort the registry by performance time
function timeSort(a, b)
{
  var aTime = getXMLNodeText(a, "time");
  var bTime = getXMLNodeText(b, "time");
  var result;

  if ((aTime.indexOf("AM") != -1) && (bTime.indexOf("PM") != -1))
    result = -1;
  else if ((aTime.indexOf("PM") != -1) && (bTime.indexOf("AM") != -1))
    result = 1;
  // Modulus makes 12:00PM look like 00:00PM to fix the sort
  else if (aTime.substr(0,2) - bTime.substr(0,2) != 0)
    result = (aTime.substr(0,2) % 12) - (bTime.substr(0,2) % 12);
  else
    result = aTime.substr(3,2) - bTime.substr(3,2);

  // If the time is the same, sort by name (case insensitive)
  if (result == 0)
  {
    var aLastName = getXMLNodeText(a, "lastName").toLowerCase();
    var bLastName = getXMLNodeText(b, "lastName").toLowerCase();
    var aFirstName = getXMLNodeText(a, "firstName").toLowerCase();
    var bFirstName = getXMLNodeText(b, "firstName").toLowerCase();

    if (aLastName < bLastName)
      result = -1;
    else if (aLastName > bLastName)
      result = 1;
    else if (aFirstName < bFirstName)
      result = -1;
    else if (aFirstName > bFirstName)
      result = 1;
    // If the names are the same, use the student ID to sort
    else
      result = getXMLNodeText(a, "studentID") - getXMLNodeText(b, "studentID");
    // Otherwise, keep the value of 0 in result
  }

  return result;
}

// Handle the data returned by the AJAX request
function parseData()
{
  if (xmlhttp.readyState==4)
  {
    if (xmlhttp.status==200 && xmlhttp.responseXML != null)
    {
      var students = new Array();
      var tempList = getXMLByTag(xmlhttp,"student");

      var output = "No Data";

      if (tempList != null)
      {
        // Convert to an array (so we can use sort)
        for (var i = 0; i < tempList.length; i++)
        {
          students[i] = tempList[i];
        }

        // Sort the list by performance time
        students = students.sort(timeSort);

        var output = "<table>\n  <tr class=\"odd\">\n";
        output += "    <th>Performing</th><th>Name</th><th>Student ID</th>";
        output += "    <th>Skill</th><th>Instrument(s)</th><th>Location</th>";
        output += "    <th>Room</th><th>Time</th>\n";
        output += "  </tr>\n";

        for (var i = 0; i < students.length; i++)
        {
          var odd = "";
          if (i % 2)
            odd = " class=\"odd\"";

          var row = "";
          if (getXMLNodeText(students[i],"perfType") == "Duet")
            row = " rowspan=\"2\"";

          output += "  <tr" + odd + ">\n";
          output += "    <td" + row + ">" + getXMLNodeText(students[i],"perfType") + "</td>\n";

          output += "    <td>" + getXMLNodeText(students[i],"firstName") + " ";
          output += getXMLNodeText(students[i],"lastName") + "</td>\n";
          output += "    <td>" + getXMLNodeText(students[i],"studentID") + "</td>\n";
          output += "    <td" + row + ">" + getXMLNodeText(students[i],"skill") + "</td>\n";
          output += "    <td" + row + ">";
          var instStrs = getXMLNodeText(students[i],"instrument").split(",");
          var instSeparator = "";
          for (var j = 0; j < instStrs.length; j++)
          {
            if (j > 0 && (j % 2 == 0))
            {
              output += ",<br/>";
              instSeparator = "";
            }
            output += instSeparator + instStrs[j];
            instSeparator = ", ";
          }
          output += "</td>\n";
          output += "    <td" + row + ">" + getXMLNodeText(students[i],"location") + "</td>\n";
          output += "    <td" + row + ">" + getXMLNodeText(students[i],"room") + "</td>\n";
          output += "    <td" + row + ">" + getXMLNodeText(students[i],"time") + "</td>\n";
          output += "  </tr>\n";

          if (getXMLNodeText(students[i],"perfType") == "Duet")
          {
            output += "  <tr" + odd + ">\n";
            output += "    <td>" + getXMLNodeText(students[i],"firstName2") + " ";
            output += getXMLNodeText(students[i],"lastName2") + "</td>\n";
            output += "    <td>" + getXMLNodeText(students[i],"studentID2") + "</td>\n";
            output += "  </tr>\n";
          }
        }

        output += "</table>\n";
        getID("listing").innerHTML = output;
      }
    }
    else
    {
      var error = "ERROR: Failed to retrieve data from server.";
      addClass(getID("listing"),"error");
      getID("listing").innerHTML = error;
    }

    getID("register").disabled=false;
  }
}

// Load the data on page load
function loadPage()
{
  clearPage();
  getID("register").disabled=true;
  setupAJAX(xmlhttp,parseData);

  getID("listing").innerHTML="";
  // Random number prevents caching
  xmlhttp.open("GET","http://157.201.194.254/cgi-bin/ercanbracks/cs213/f11/kyle/assign13.pl?load="+Math.random(),true);
  xmlhttp.send(null);
}

// Reset the form
function clearPage()
{
  getID("perfType").value = "Solo";
  changeType("Solo");

  // Clear Errors
  var divs = getTag("div");
  for(var i = 0; i < divs.length; i++)
  {
    removeClass(divs[i],"empty");
  }
  getID("errorID1").style.display = "none";
  getID("errorID2").style.display = "none";
  getID("errorInst").style.display = "none";
  getID("errorRoom").style.display = "none";
  getID("errorTime").style.display = "none";
  getID("errorEmpty").style.display = "none";

  // Set the focus on the first name field
  getID("firstName").focus();
  getID("firstName").select();
}

// Submit the information to the server
function send()
{
  if (validate(true))
  {
    getID("register").disabled=true;
    setupAJAX(xmlhttp,parseData);

    var queryStr = "?perfType=" + getID("perfType").value;
    queryStr += "&firstName=" + getID("firstName").value;
    queryStr += "&lastName=" + getID("lastName").value;
    queryStr += "&studentID=" + getID("studentID").value;

    if (getID("perfType").value == "Duet")
    {
      queryStr += "&firstName2=" + getID("firstName2").value;
      queryStr += "&lastName2=" + getID("lastName2").value;
      queryStr += "&studentID2=" + getID("studentID2").value;
    }

    queryStr += "&skill=" + getID("skill").value;
    queryStr += "&instrument=";

    var list = getTag("input");
    var separator = "";
    for (var i = 0; i < list.length; i++)
    {
      if((list[i].name == "instrument") && list[i].checked)
      {
        queryStr += separator + list[i].value;
        separator = ",";
      }
    }

    queryStr += "&location=" + getID("location").value;
    queryStr += "&room=" + getID("room").value;
    queryStr += "&time=" + getID("time").value;
    queryStr += "&load=" + Math.random();

    queryStr=queryStr.replace(/ /g,"%20");
    var url="http://157.201.194.254/cgi-bin/ercanbracks/cs213/f11/kyle/assign13.pl"+queryStr;

    getID("listing").innerHTML="";
    xmlhttp.open("GET",url,true);
    xmlhttp.send(null);
  }
}

// Show or hide the second student
function changeType(type)
{
  var displayType = "none";
  if (type == "Duet")
    displayType = "block";

  // Hide or Show the second student's information
  var block = getClass("second");
  for (var i = 0; i < block.length; i++)
  {
    block[i].style.display = displayType;
  }
}
// Display the empty error when needed
function showEmptyError()
{
  var divs = getTag("div");
  var show = false;
  for(var i = 0; i < divs.length; i++)
  {
    if(divs[i].className.indexOf("empty") != -1)
    {
      show = true;
      break;
    }
  }

  if(show)
    getID("errorEmpty").style.display = "block";
  else
    getID("errorEmpty").style.display = "none";
}

// Validate the data in the form
function validate(checkAll,currField)
{
  var valid = true;

  // Mark all empty fields (used to verify the whole form)
  if(checkAll == true)
  {
    valid = true;
    var instrumentChosen = false;
    var inputs = getTag("input");
    for(var i = 0; i < inputs.length; i++)
    {
      // Only process info for the second student if "Duet" is selected
      if((inputs[i].type == "text") && (getID("perfType").value == "Duet" ||
          inputs[i].parentNode.className.indexOf("second") == -1))
      {
        inputs[i].value = trim(inputs[i].value);

        if(inputs[i].value == "")
        {
          addClass(inputs[i].parentNode,"empty");
          valid = false;
        }
        else
          removeClass(inputs[i].parentNode,"empty");
      }
      else if((inputs[i].name == "instrument") && inputs[i].checked)
      {
        instrumentChosen = true;
        getID("errorInst").style.display = "none";
      }
    }

    if(!instrumentChosen)
      getID("errorInst").style.display = "block";

    valid = valid && instrumentChosen;
  }
  // Called from onchange for a field
  else
  {
    currField.value = trim(currField.value);

    if(currField.value == "")
    {
      currField.parentNode.style.border="1px solid red";
      addClass(currField.parentNode,"empty");
      valid = false;
    }
    else
    {
      currField.parentNode.style.border="none";
      removeClass(currField.parentNode,"empty");
    }
  }
  showEmptyError();

  // Ensure valid inputs
  if((getID("studentID").value != "") &&
      (getID("studentID").value.search(/^\d{9}$/) < 0))
  {
    getID("errorID1").style.display = "block";
    valid = false;
  }
  else
    getID("errorID1").style.display = "none";

  if((getID("perfType").value == "Duet") && (getID("studentID2").value != "") &&
      (getID("studentID2").value.search(/^\d{9}$/) < 0))
  {
    getID("errorID2").style.display = "block";
    valid = false;
  }
  else
    getID("errorID2").style.display = "none";

  // Match three digits with an optional letter at the end
  if((getID("room").value != "") &&
      (getID("room").value.search(/^\d{3}[a-zA-Z]?$/) < 0))
  {
    getID("errorRoom").style.display = "block";
    valid = false;
  }
  else
    getID("errorRoom").style.display = "none";

  var timeStr = getID("time").value;
  if((timeStr != "") &&
      (timeStr.search(/^\d{2}:\d{2}(am|AM|pm|PM)$/) < 0))
  {
    getID("errorTime").innerHTML = "The time must be of the form \"hh:mmAM\" or \"hh:mmPM\".";
    getID("errorTime").style.display = "block";
    valid = false;
  }
  else if((timeStr != "") && ((timeStr.substr(0,2) < 1) || (timeStr.substr(0,2) > 12)
      || (timeStr.substr(3,2) > 59)))
  {
    getID("errorTime").innerHTML = "Invalid Time";
    getID("errorTime").style.display = "block";
    valid = false;
  }
  else
    getID("errorTime").style.display = "none";

  return valid;
}


