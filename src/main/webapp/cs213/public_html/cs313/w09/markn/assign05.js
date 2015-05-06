function addStudent()
{
   var studId = document.getElementById("studId").value;
   var firstName = document.getElementById("firstName").value;
   var lastName = document.getElementById("lastName").value;
   var major = document.getElementById("major").value;
   var birthdate = document.getElementById("birthdate").value;
   var gender = document.getElementById("gender").value;
   var city = document.getElementById("city").value;
   var state = document.getElementById("state").value;
   
   if((checkBirthday ()) && (genCheck()))
   {
      var query = "insert into students(studentId, firstName, lastName, major, birthdate, gender, city, state) values (" +
      studId + ',\'' +  firstName + '\',\'' + lastName +'\',' + major + ',\'' + birthdate + '\',\'' + gender + '\',\'' + city+ '\','   + state +')'; 
      
      ajaxDbCall(query);
      updateDisplay();
   }      
}

function genCheck()
{
   var gender = document.getElementById("gender").value;
   var pos = gender.search(/^[MF]$/);
   if (pos == 0)
   {
      document.getElementById("genError").style.visibility = "hidden";    
      return true;
   }
   else 
   {
      document.getElementById("genError").style.visibility = "visible";    
      return false;
   }
}

function checkBirthday()
{  
   var birthdate = document.getElementById("birthdate").value;
   var pos = birthdate.search(/^\d{2}\/\d{2}\/\d{2}$/);
   if (pos == 0)
   {
      document.getElementById("birthError").style.visibility = "hidden";    
      return true;
   }
   else
   {
      document.getElementById("birthError").style.visibility = "visible";    
      return false;
   }
}
function popById()
{
   var studId = document.getElementById("studId").value;
   var query = 'select* from students where studentId =' + studId;   
   xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
   {
  		alert ("Your browser does not support AJAX!");
  		return;
  	} 
	         
	var url = "http://157.201.194.254/~ercanbracks/cs313/w09/markn/assign05.php?query=" + query;
	url=url+"&sid="+Math.random() + "&type=string";
	xmlHttp.onreadystatechange=popByIdStateChange;	
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

function popByIdStateChange()
{
   if (xmlHttp.readyState==4)
	{ 
	   var returnData = xmlHttp.responseText;
      var returnArray = returnData.split(',');
      if(returnArray.length >=3)
      {      
   	   document.getElementById("firstName").value = returnArray[1];
   	   document.getElementById("lastName").value = returnArray[2];
   	   document.getElementById("major").value = returnArray[3];
   	   document.getElementById("birthdate").value = returnArray[4];
   	   document.getElementById("gender").value = returnArray[5];
   	   document.getElementById("city").value = returnArray[6];
   	   document.getElementById("state").value = returnArray[7];
      }
      else
      {
         document.getElementById("firstName").value = "";
   	   document.getElementById("lastName").value = "";
   	   document.getElementById("major").value = "";
   	   document.getElementById("birthdate").value = "";
   	   document.getElementById("gender").value = "";
   	   document.getElementById("city").value = "";
   	   document.getElementById("state").value = "";          
      }         
	}
}

function updateDisplay()
{
   var query = 'select* from students order by studentId';
   xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
   {
  		alert ("Your browser does not support AJAX!");
  		return;
  	} 
	         
	var url = "http://157.201.194.254/~ercanbracks/cs313/w09/markn/assign05.php?query=" + query;
	url=url+"&sid="+Math.random() + "&type=table";

	xmlHttp.onreadystatechange=stateChanged;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

function deleteStudent()
{
	var studId = document.getElementById("studId").value;	

	var query = "delete from students where studentId =" + studId;

	ajaxDbCall(query);
	updateDisplay();      
}

function modifyStudent()
{
	var studId = document.getElementById("studId").value;
	var firstName = document.getElementById("firstName").value;
	var lastName = document.getElementById("lastName").value;
	var major = document.getElementById("major").value;
	var birthdate = document.getElementById("birthdate").value;
	var gender = document.getElementById("gender").value;
	var city = document.getElementById("city").value;
	var state = document.getElementById("state").value;
    if((checkBirthday ()) && (genCheck()))
   {
   	var query = "update students set firstName=\'" + firstName + '\','
   		+ "lastName='" + lastName + '\',' + "major=" +  major + ',' + "birthdate=\'" + birthdate + '\',' 
   		+ "gender=\'" + gender + '\',' + "city=\'" + city + '\',' + "state=" + state + " where studentId=" + studId; 

   	ajaxDbCall(query);
   	updateDisplay();   
   }
}

function ajaxDbCall(query)
{   
   xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
   {
  		alert ("Your browser does not support AJAX!");
  		return;
  	} 
	         
	var url = "http://157.201.194.254/~ercanbracks/cs313/w09/markn/assign05.php?query=" + query;
	url=url+"&sid="+Math.random() + "&type=table";

	//xmlHttp.onreadystatechange=stateChanged;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

function stateChanged() 
{ 
	if (xmlHttp.readyState==4)
	{ 
	  var returnData = xmlHttp.responseText;      
     document.getElementById("dbResponse").innerHTML = returnData;
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
