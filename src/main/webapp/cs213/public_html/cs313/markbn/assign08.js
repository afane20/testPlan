function updateDisplay()
{
   ajaxUpdateDisplay();
}

function addClass(studId)
{
  var className;
  var instruction = "add";
  
  className = document.getElementById(studId + "availClasses").value;
  
  ajaxAddOrDrop(instruction, studId, className);
}

function dropClass(studId)
{
  var className;
  var instruction = "drop";
  
  className = document.getElementById(studId + "currentClasses").value;
  
  ajaxAddOrDrop(instruction, studId, className);
}

function ajaxAddOrDrop(instruction, studId, className)
{   
   xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
   {
  		alert ("Your browser does not support AJAX!");
  		return;
  	}        
	var url = "http://157.201.194.254:8080/cs313/servlet/w09.markbn.assign08?executeType=" + instruction;
   url = url + "&studId=" + studId + "&className=" + className;
	url=url+"&sid="+Math.random();

	xmlHttp.onreadystatechange=stateChange;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

function ajaxUpdateDisplay()
{   
   xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
   {
  		alert ("Your browser does not support AJAX!");
  		return;
  	} 
	         
	var url = "http://157.201.194.254:8080/cs313/servlet/w09.markbn.assign08?executeType=All";
	url=url+"&sid="+Math.random();

	xmlHttp.onreadystatechange=stateChangedUpdateDisplay;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

function ajaxInfoForStudent(studID)
{   
   xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
   {
  		alert ("Your browser does not support AJAX!");
  		return;
  	} 
	         
	var url = "" + query;
	url=url+"&sid="+Math.random();

	//xmlHttp.onreadystatechange=stateChanged;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

function stateChangedUpdateDisplay() 
{ 
	if (xmlHttp.readyState==4)
	{ 
	  var returnData = xmlHttp.responseText;      
     document.getElementById("display").innerHTML = returnData;
	}
}

function stateChangeInfoStudent() 
{ 
	if (xmlHttp.readyState==4)
	{ 
	  var returnData = xmlHttp.responseText;      
     document.getElementById("dbResponse").innerHTML = returnData;
	}
}

function stateChange() 
{ 
	if (xmlHttp.readyState==4)
	{ 
	  var returnData = xmlHttp.responseText;      
     document.getElementById("display").innerHTML = returnData;
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
