// update the main input displays
function ajaxUpdateDisplay(display)
{   
   xmlHttp=GetXmlHttpObject();
   var displayType = "display";
	if (xmlHttp==null)
   {
  		alert ("Your browser does not support AJAX!");
  		return;
  	} 
	         
	var url = "http://157.201.194.254/~ercanbracks/cs313/w09/markn/administration.php?displayType=" + displayType;
	url=url+"&sid="+Math.random();
   if(display == "teacherDisplay")
   {
      url = url+ "&query=select * from  FTeachers";
      xmlHttp.onreadystatechange=stateChangeTeacherDisplay;
      document.getElementById("teacherDisplay").style.display = '';
      document.getElementById("studentDisplay").style.display = 'none';
      document.getElementById("resourceDisplay").style.display = 'none';
      
      document.getElementById("teacherControl").style.display = '';
      document.getElementById("studentControl").style.display = 'none';
      document.getElementById("resourceControl").style.display = 'none';
      
     // document.getElementById("studentDisplay").innerHTML = "";
    //  document.getElementById("resourceDisplay").innerHTML = "";
    // el.style.display != 'none' 
   }
   else if(display == "studentDisplay")
   {
      url = url+ "&query=select * from  FStudents";
      xmlHttp.onreadystatechange=stateChangeStudentDisplay;
      document.getElementById("teacherDisplay").style.display = 'none';
      document.getElementById("studentDisplay").style.display = '';
      document.getElementById("resourceDisplay").style.display = 'none';
      
      document.getElementById("teacherControl").style.display = 'none';
      document.getElementById("studentControl").style.display = '';
      document.getElementById("resourceControl").style.display = 'none';
      
     //  document.getElementById("teacherDisplay").innerHTML = "";
     //  document.getElementById("resourceDisplay").innerHTML = "";
   }
   else if(display == "resourceDisplay")
   {
       url = url+ "&query=select * from  FResources";
      xmlHttp.onreadystatechange=stateChangeResourceDisplay;
      document.getElementById("teacherDisplay").style.display = 'none';
      document.getElementById("studentDisplay").style.display = 'none';
      document.getElementById("resourceDisplay").style.display = '';
      
      document.getElementById("teacherControl").style.display = 'none';
      document.getElementById("studentControl").style.display = 'none';
      document.getElementById("resourceControl").style.display = '';
      
     // document.getElementById("teacherDisplay").innerHTML = "";
     // document.getElementById("studentDisplay").innerHTML = "";
   }
   
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

function stateChangeTeacherDisplay() 
{ 
 
	if (xmlHttp.readyState==4)
	{ 
	  var returnData = xmlHttp.responseText;      
     document.getElementById("teacherDisplay").innerHTML = returnData;
	}
}

//---
function stateChangeStudentDisplay() 
{ 
	if (xmlHttp.readyState==4)
	{ 
	  var returnData = xmlHttp.responseText;      
     document.getElementById("studentDisplay").innerHTML = returnData;
	}
}

function stateChangeResourceDisplay() 
{ 
	if (xmlHttp.readyState==4)
	{ 
	  var returnData = xmlHttp.responseText;      
     document.getElementById("resourceDisplay").innerHTML = returnData;
	}
}

// Populate by resource Id
function popByResourceId()
{
   var resourceId = document.getElementById("resourceId").value;
   displayType = "list";
   query = "select * from FResources where resourceId = " + resourceId;
   xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
   {
  		alert ("Your browser does not support AJAX!");
  		return;
  	} 
	         
	var url = "http://157.201.194.254/~ercanbracks/cs313/w09/markn/administration.php?query=" + query + "&displayType=" + displayType;
	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=popByResourceIdStateChange;	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}
 
 // State change for ResourceId
function popByResourceIdStateChange()
{
   if (xmlHttp.readyState==4)
	{ 
	   var returnData = xmlHttp.responseText;
      var returnArray = returnData.split(',');
      if(returnArray.length >=2)
      {          
         document.getElementById("building").value = returnArray[1];
         document.getElementById("room").value = returnArray[2];
         document.getElementById("numPianos").value = returnArray[3];
         document.getElementById("day").value = returnArray[4];
         document.getElementById("time").value = returnArray[5];
         document.getElementById("studIdOne").value = returnArray[6];         
         document.getElementById("performType").value = returnArray[7];                       
      }
      else
      {/*
         //document.getElementById("resourceId").value = "";
         document.getElementById("building").value = "";
         document.getElementById("room").value = "";
         document.getElementById("numPianos").value = "";
         document.getElementById("day").value = "";
         document.getElementById("time").value = "";
         document.getElementById("studIdOne").value = "";
         document.getElementById("studIdTwo").value = "";
         document.getElementById("performType").value = ""; 
*/         
      }         
	}
}

// populate by studentId
function popByStudentId()
{
   var studId = document.getElementById("studentId").value;
   displayType = "list";
   query = "select * from FStudents where studentId = " + studId;
   xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
   {
  		alert ("Your browser does not support AJAX!");
  		return;
  	} 
	         
	var url = "http://157.201.194.254/~ercanbracks/cs313/w09/markn/administration.php?query=" + query + "&displayType=" + displayType;
	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=popByStudIdStateChange;	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

// state change for studId
function popByStudIdStateChange()
{
   if (xmlHttp.readyState==4)
	{ 
	   var returnData = xmlHttp.responseText;
      var returnArray = returnData.split(',');
      if(returnArray.length >=2)
      {          
         document.getElementById("studFirstName").value = returnArray[1];
         document.getElementById("studLastName").value = returnArray[2];
         document.getElementById("instrument").value = returnArray[3];
         document.getElementById("studLevel").value = returnArray[4];
         document.getElementById("studPoints").value = returnArray[5];
         document.getElementById("studRegistered").value = returnArray[6];
         document.getElementById("studTeacherId").value = returnArray[7];
         document.getElementById("studResourceId").value = returnArray[8];               
      }
      else
      {
         //document.getElementById("studentId").value = "";
         document.getElementById("studFirstName").value = "";
         document.getElementById("studLastName").value = "";
         document.getElementById("instrument").value = "";
         document.getElementById("studLevel").value = "";
         document.getElementById("studPoints").value = "";
         document.getElementById("studRegistered").value = "";
         document.getElementById("studTeacherId").value = ""; 
         document.getElementById("studResourceId").value = "";          
      }         
	}
}

// populate by teacher Id
function popByTeacherId()
{
   var teachId = document.getElementById("teacherId").value;
   displayType = "list";
   query = "select * from FTeachers where teacherId = " + teachId;
   xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
   {
  		alert ("Your browser does not support AJAX!");
  		return;
  	} 
	         
	var url = "http://157.201.194.254/~ercanbracks/cs313/w09/markn/administration.php?query=" + query + "&displayType=" + displayType;
	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=popByTeachIdStateChange;	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

// State change for teacher Id 
function popByTeachIdStateChange()
{
   if (xmlHttp.readyState==4)
	{ 
	   var returnData = xmlHttp.responseText;
      var returnArray = returnData.split(',');
      if(returnArray.length >=3)
      {  
         //document.getElementById("teacherId").value = returnArray[0];
         document.getElementById("teachFirstName").value = returnArray[1];
         document.getElementById("teachLastName").value = returnArray[2];
         document.getElementById("teachEmail").value = returnArray[3];
         document.getElementById("teachStreetAddr").value = returnArray[4];
         document.getElementById("teachCity").value = returnArray[5];
         document.getElementById("teachZip").value = returnArray[6];
         document.getElementById("annualFees").value = returnArray[7];
         document.getElementById("regFees").value = returnArray[8];
         document.getElementById("isAdmin").value = returnArray[9];
         document.getElementById("password").value = returnArray[10];
         document.getElementById("username").value = returnArray[11];         
      }
      else
      {
         //document.getElementById("teacherId").value = "";
         document.getElementById("teachFirstName").value = "";
         document.getElementById("teachLastName").value = "";
         document.getElementById("teachEmail").value = "";
         document.getElementById("teachStreetAddr").value = "";
         document.getElementById("teachCity").value = "";
         document.getElementById("teachZip").value = "";
         document.getElementById("annualFees").value = "";
         document.getElementById("regFees").value = "";
         document.getElementById("isAdmin").value = "";
         document.getElementById("password").value = "";
         document.getElementById("username").value = "";
      }         
	}
}

// Perform an update action on the teacher data
function ajaxTeacherUpdate(action)
{
   xmlHttp=GetXmlHttpObject();
   var displayType = "noDisplay";
	if (xmlHttp==null)
   {
  		alert ("Your browser does not support AJAX!");
  		return;
  	}
   
   var teachId = document.getElementById("teacherId").value;
   var teachFirstName = document.getElementById("teachFirstName").value;
   var teachLastName = document.getElementById("teachLastName").value;
   var teachEmail = document.getElementById("teachEmail").value;
   var teachStreetAddr = document.getElementById("teachStreetAddr").value;
   var teachCity = document.getElementById("teachCity").value;
   var teachZip = document.getElementById("teachZip").value;
   var annualFees = document.getElementById("annualFees").value;
   var regFees = document.getElementById("regFees").value;
   var isAdmin = document.getElementById("isAdmin").value;
   var password = document.getElementById("password").value;
   var username = document.getElementById("username").value;
   var query = "";
   
   if(action == "add")
   {
      query = "insert into FTeachers (teacherId, firstname, lastName, email, streetAddr, city, zip, annualFees, regFees, isAdmin, passwd, username) values(" + teachId + ",'" + teachFirstName + "','" + teachLastName + "','" + teachEmail + "','" + teachStreetAddr + "','" + teachCity + "'," + teachZip + "," + annualFees + "," + regFees + "," + isAdmin + ",'" + password + "','" + username + "')";
   }
   
   else if (action == "update")
   {
      query = "update FTeachers set teacherId=" + teachId + ",firstName='" + teachFirstName + "',lastName='" + teachLastName + "',email='" + teachEmail +"',streetAddr='" + teachStreetAddr + "',city='" + teachCity + "',zip=" + teachZip + ", annualFees=" + annualFees + ", regFees=" + regFees + ", isAdmin=" + isAdmin + ", passwd='" + password + "', username='" + username + "' where teacherId=" + teachId; 
   }
   else if (action == "delete")
   {
      query = "delete from FTeachers where teacherId =" + teachId;
   }
   
   var url = "http://157.201.194.254/~ercanbracks/cs313/w09/markn/administration.php?query=" + query + "&displayType=" + displayType;
	url=url+"&sid="+Math.random();   
   xmlHttp.onreadystatechange=stateChangeTeacherUpdate;	      
   xmlHttp.open("GET",url,true);
	xmlHttp.send(null);  
}

function stateChangeTeacherUpdate() 
{ 
 
	if (xmlHttp.readyState==4)
	{ 
	   ajaxUpdateDisplay("teacherDisplay");
	}
}

// perform an updat for student Data
function ajaxStudentUpdate(action)
{
   xmlHttp=GetXmlHttpObject();
   var displayType = "noDisplay";
	if (xmlHttp==null)
   {
  		alert ("Your browser does not support AJAX!");
  		return;
  	}

   var studentId = document.getElementById("studentId").value;
   var studFirstName = document.getElementById("studFirstName").value;
   var studLastName = document.getElementById("studLastName").value;
   var instrument = document.getElementById("instrument").value;
   var studLevel = document.getElementById("studLevel").value;
   var studPoints = document.getElementById("studPoints").value;
   var studRegistered = document.getElementById("studRegistered").value;
   var studTeacherId = document.getElementById("studTeacherId").value;
   var studResourceId = document.getElementById("studResourceId").value;
   var query = "";
   
   if(action == "add")
   {
      query = "insert into FStudents(studentId, firstName, lastName, instrument, level, totalPoints, registered, teacherId, resourceId) values("+studentId + ",'" + studFirstName + "','" + studLastName + "','" + instrument + "','" + studLevel + "'," + studPoints + "," + studRegistered + "," + studTeacherId + "," + studResourceId + ")"; 
   }
   
   else if (action == "update")
   {
      query = "update FStudents set studentId=" + studentId + ", firstName='" + studFirstName + "',lastName='" + studLastName + "',instrument='" + instrument + "', level='" + studLevel + "',totalPoints=" + studPoints + ",registered=" + studRegistered + ", teacherId=" + studTeacherId + ", resourceId=" + studResourceId + " where studentId = " + studentId; 
   }
   else if (action === "delete")
   {
      query = "delete from FStudents where studentId=" + studentId;
   }
   var url = "http://157.201.194.254/~ercanbracks/cs313/w09/markn/administration.php?query=" + query + "&displayType=" + displayType;
	url=url+"&sid="+Math.random();   
   xmlHttp.onreadystatechange=stateChangeStudentUpdate;	      
   xmlHttp.open("GET",url,true);
	xmlHttp.send(null);  
}

function stateChangeStudentUpdate() 
{ 
 
	if (xmlHttp.readyState==4)
	{ 
	   ajaxUpdateDisplay("studentDisplay");
	}
}

// perform an update action for resources.
function ajaxResourceUpdate(action)
{
   xmlHttp=GetXmlHttpObject();
   var displayType = "noDisplay";
	if (xmlHttp==null)
   {
  		alert ("Your browser does not support AJAX!");
  		return;
  	}

   var resourceId = document.getElementById("resourceId").value;
   var building = document.getElementById("building").value;
   var room = document.getElementById("room").value;
   var numPianos = document.getElementById("numPianos").value;
   var day = document.getElementById("day").value;
   var time = document.getElementById("time").value;
   var studIdOne = document.getElementById("studIdOne").value;   
   var performType = document.getElementById("performType").value;
   var query = "";
   
   if(action == "add")
   {
      query = "insert into FResources(resourceId, bldg, room, numPianos, day, apptTime, studentId1, performType) values(" + resourceId + ",'" + building + "','" + room + "'," + numPianos + ",'" + day + "','" + time + "'," + studIdOne + ",'" + performType + "')";
   }
   
   else if (action == "update")
   {
      query = "update FResources set resourceId=" + resourceId + ", bldg='" + building + "', room='" + room + "', numPianos=" + numPianos + ", day='" + day +"', apptTime ='" + time + "', studentId1=" + studIdOne + ", performType='" + performType + "'" + " where resourceId = " + resourceId; ;
   }
   else if (action === "delete")
   {
      query = "delete from FResources where ResourceId=" + resourceId;
   }
   
    var url = "http://157.201.194.254/~ercanbracks/cs313/w09/markn/administration.php?query=" + query + "&displayType=" + displayType;
	url=url+"&sid="+Math.random();    
   xmlHttp.onreadystatechange=stateChangeResourceUpdate;	      
   xmlHttp.open("GET",url,true);
	xmlHttp.send(null);  
   
}

function stateChangeResourceUpdate() 
{ 
 
	if (xmlHttp.readyState==4)
	{ 
	   ajaxUpdateDisplay("resourceDisplay");
	}
}

function GetXmlHttpObject()
{
	var xmlHttp=null;
	try
  	{
  	// Firefox, Opera 8.0+, Safari
  		xmlHttp=new XMLHttpRequest();
 	}
	catch (e)
  	{
  	// Internet Explorer
  		try
    	{
    		xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    	}
  		catch (e)
    	{
    		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    	}
  	}
	return xmlHttp;
}
