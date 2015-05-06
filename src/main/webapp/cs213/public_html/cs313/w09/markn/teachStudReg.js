function unregisterStudent(teacherId)
{
   
   xmlHttp4=GetXmlHttpObject();
	if (xmlHttp4==null)
   {
  		alert ("Your browser does not support AJAX!");
  		return;
  	} 
   var firstName = document.getElementById("sFirstName").value;
   var lastName = document.getElementById("sLastName").value;
   var instrument = document.getElementById("sInstrument").value;
   var level = document.getElementById("sLevel").value;
   var resourceId = document.getElementById("sResourceId").value;
   
   var url = "http://157.201.194.254/~ercanbracks/cs313/w09/markn/teachStudReg.php?displayType=''&executeType=unregisterStudent&studFirstName=" + firstName + "&studLastName=" + lastName + "&instrument=" + instrument + "&level=" + level + "&resourceId=" + resourceId + "&teacherId=" + teacherId
	url=url+"&sid="+Math.random();  
	xmlHttp4.open("GET",url,true);
	xmlHttp4.send(null);
   updateDisplays(teacherId);
   updateDisplays(teacherId);
}

function registerStudent(teacherId)
{
   
   xmlHttp3=GetXmlHttpObject();
	if (xmlHttp3==null)
   {
  		alert ("Your browser does not support AJAX!");
  		return;
  	} 
   var firstName = document.getElementById("sFirstName").value;
   var lastName = document.getElementById("sLastName").value;
   var instrument = document.getElementById("sInstrument").value;
   var level = document.getElementById("sLevel").value;
   var resourceId = document.getElementById("sResourceId").value;
   
   var url = "http://157.201.194.254/~ercanbracks/cs313/w09/markn/teachStudReg.php?displayType=''&executeType=updateStudent&studFirstName=" + firstName + "&studLastName=" + lastName + "&instrument=" + instrument + "&level=" + level + "&resourceId=" + resourceId + "&teacherId=" + teacherId
	url=url+"&sid="+Math.random();   
	xmlHttp3.open("GET",url,true);
	xmlHttp3.send(null);
   updateDisplays(teacherId);
   updateDisplays(teacherId);
}

function updateDisplays(teacherId)
{
   ajaxUpdateDisplayStudents(teacherId);
   ajaxUpdateDisplayResources(teacherId);
}
function ajaxUpdateDisplayStudents(teacherId)
{   
   xmlHttp=GetXmlHttpObject();
   var displayType = "display";
	if (xmlHttp==null)
   {
  		alert ("Your browser does not support AJAX!");
  		return;
  	} 
	         
	var url = "http://157.201.194.254/~ercanbracks/cs313/w09/markn/teachStudReg.php?displayType=" + displayType +"&executeType=display&userName=''&passwored=''&studFirstName=''&studLastName=''&instrument=''&level=''&resourceId=''&teacherid=''";
	url=url+"&sid="+Math.random();
   
   url = url+ "&displayQuery=select * from  FStudents where teacherId = " + teacherId;
   xmlHttp.onreadystatechange=stateChangeStudentDisplay;       
   
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

function ajaxUpdateDisplayResources(teacherId)
{   
   xmlHttp2=GetXmlHttpObject();
   var displayType = "display";
	if (xmlHttp2==null)
   {
  		alert ("Your browser does not support AJAX!");
  		return;
  	} 
	         
	var url = "http://157.201.194.254/~ercanbracks/cs313/w09/markn/teachStudReg.php?displayType=" + displayType +"&executeType=display&userName=''&passwored=''&studFirstName=''&studLastName=''&instrument=''&level=''&resourceId=''&teacherid=''" ;
	url=url+"&sid="+Math.random();
   
   url = url+ "&displayQuery=select * from  FResources where studentId1 = 0";
      xmlHttp2.onreadystatechange=stateChangeResourceDisplay;  
   
	xmlHttp2.open("GET",url,true);
	xmlHttp2.send(null);
}

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
 
	if (xmlHttp2.readyState==4)
	{ 
	  var returnData = xmlHttp2.responseText;      
     document.getElementById("resourceDisplay").innerHTML = returnData;
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
