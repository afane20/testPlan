function validate(firstName, lastName, gender, city, state, birthDate, majorCode)
{
   if (!firstName)
   {
      alert("First name cannot be left blank.");
      return false;
   }   
   else if (!lastName)
   {
      alert("Last name cannot be left blank.");
      return false;
   }
   else if ((gender != 'M') && (gender != 'F'))
   {
      alert("Gender must be either 'M' or 'F'.");
      return false;
   }
   else if (!city)
   {
      alert("City cannot be left blank.");
      return false;
   }
   else if (!/[A-Z]{2}/.test(state))
   {
      alert("State must be two capital letters.");
      return false;
   }
   else if (!/\d{4}-\d{2}-\d{2}/.test(birthDate))
   {
      alert("Birthdate must be in the form yyyy-mm-dd.");
      return false;
   }
   else if (!/\d{3}/.test(majorCode))
   {
      alert("Major code must be 3 digits.");
      return false;      
   }
   return true;
}
function updatePage(str)
{
   var result = document.getElementById("result");
   result.innerHTML = str; 
}
function resetForm()
{
   document.getElementById("save").disabled = true;
   var studentId = document.getElementById("studentId").value;
   document.getElementById(studentId).style.backgroundColor="LightSkyBlue";
   document.getElementById("studentId").value = -1;
   document.getElementById("firstName").value = "";
   document.getElementById("lastName").value = "";
   document.getElementById("gender").value = "";
   document.getElementById("city").value = "";
   document.getElementById("state").value = "";
   document.getElementById("birthDate").value = "";
   document.getElementById("majorCode").value = "";
}
function load()
{
   getResult("http://157.201.194.254/~ercanbracks/cs313/w09/robb/assign05.php","");

}

function getQueryString()
{
   var query = document.getElementById("query").value;
   query = "query=" + query;
   return query; 
}
function getResult(url, query, noUpdate) 
{
   var xmlHttp;
   try
   {
      xmlHttp=new XMLHttpRequest();
   }
   catch (e)
   {
      try
      {
         xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      }
      catch (e)
      {
         try
         {
            xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
         }
         catch (e)
         {
            alert("Your browser does not support AJAX!");
            return false;
         }
      }
   }

   xmlHttp.onreadystatechange = function()
   {
      if(xmlHttp.readyState == 4)
      {
         updatePage(xmlHttp.responseText);
      }
   }
   if (noUpdate)
   {
         xmlHttp.onreadystatechange = function(){ }
   }
   
   xmlHttp.open("POST",url,true);
   xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//    xmlHttp.setRequestHeader("Content-length", query.length);
//    xmlHttp.setRequestHeader("Connection", "close");

   xmlHttp.send(query);

}
function addEntry()
{ 
   var firstName = document.getElementById("firstName").value;
   var lastName = document.getElementById("lastName").value;
   var gender = document.getElementById("gender").value;
   var city = document.getElementById("city").value;
   var state = document.getElementById("state").value;
   var birthDate = document.getElementById("birthDate").value;
   var majorCode = document.getElementById("majorCode").value;
   var now = new Date();
   if (validate(firstName, lastName, gender, city, state, birthDate, majorCode))
   {
      var queryStr = "type=add"
                   + "&firstName=" + firstName
                   + "&lastName=" + lastName
                   + "&gender=" + gender
                   + "&city=" + city
                   + "&state=" + state
                   + "&birthDate=" + birthDate
                   + "&majorCode=" + majorCode
                   + "&time=" + now.getTime();
      getResult("http://157.201.194.254/~ercanbracks/cs313/w09/robb/modifyStudents.php",queryStr,true);
      load();
   }
}
function rm(studentId)
{
   var oldId = document.getElementById("studentId").value;
   document.getElementById(oldId).style.backgroundColor="LightSkyBlue";
   document.getElementById(studentId).style.backgroundColor="red";
   var now = new Date();
   if (confirm("Are you sure you want to delete this row?"))
   {
      var queryStr = "type=rm&studentId=" + studentId +"&time=" + now.getTime();
      getResult("http://157.201.194.254/~ercanbracks/cs313/w09/robb/modifyStudents.php", queryStr, true);
      load();
   }
   document.getElementById(studentId).style.backgroundColor="LightSkyBlue";
   if (oldId >= 0)
   {
      document.getElementById(oldId).style.backgroundColor="yellow";
   }
}
function mod(studentId, firstName, lastName, gender, city, state, birthDate, majorCode)
{
   var oldId = document.getElementById("studentId").value;
   document.getElementById("studentId").value = studentId;
   document.getElementById("firstName").value = firstName;
   document.getElementById("lastName").value = lastName;
   document.getElementById("gender").value = gender;
   document.getElementById("city").value = city;
   document.getElementById("state").value = state;
   document.getElementById("birthDate").value = birthDate;
   document.getElementById("majorCode").value = majorCode;
   document.getElementById("save").disabled = false;
   document.getElementById(oldId).style.backgroundColor="LightSkyBlue";
   document.getElementById(studentId).style.backgroundColor="yellow";
   if (studentId == oldId)
   {
      resetForm();
   } 

}


function saveData()
{
   var studentId = document.getElementById("studentId").value;
   var firstName = document.getElementById("firstName").value;
   var lastName = document.getElementById("lastName").value;
   var gender = document.getElementById("gender").value;
   var city = document.getElementById("city").value;
   var state = document.getElementById("state").value;
   var birthDate = document.getElementById("birthDate").value;
   var majorCode = document.getElementById("majorCode").value;
   var now = new Date();
   
   if (validate(firstName, lastName, gender, city, state, birthDate, majorCode))
   {
      var queryStr = "type=mod"
                   + "&studentId=" + studentId
                   + "&firstName=" + firstName
                   + "&lastName=" + lastName
                   + "&gender=" + gender
                   + "&city=" + city
                   + "&state=" + state
                   + "&birthDate=" + birthDate
                   + "&majorCode=" + majorCode
                   + "&time=" + now.getTime();;
      getResult("http://157.201.194.254/~ercanbracks/cs313/w09/robb/modifyStudents.php",queryStr,true);
      load();
   }
//    document.getElementById(studentId).style.backgroundColor="red";
}

