tId = -1;
function validate(firstName, lastName, userName, email, streetAddr, city, zip)
{
   if (!firstName.value)
   {
      firstName.focus();
      alert("First name cannot be left blank.");
      return false;
   }   
   else if (!lastName.value)
   {
      lastName.focus();
      alert("Last name cannot be left blank.");
      return false;
   }
   else if (!userName.value.match(/\w{3,20}/))
   {
      userName.focus();
      alert("Username must must be between 3 and 20 charactors (letters and numbers only)");
      return false;
   }
   else if (!email.value.match(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/))
   {
      email.focus()
      alert("Email address is empty or invalid");
      return false;
   }
   else if (!streetAddr.value)
   {
      streetAddr.focus();
      alert("Street address cannot be left blank");
      return false;
   }
   else if (!city.value)
   {
      city.focus();
      alert("City cannot be left blank");
      return false;
   }
   else if (!zip.value.match(/\d{5}/))
   {
      zip.focus();
      alert("zip code must be 5 digits.");
      return false;
   }
   return true;
}
function updatePage(str)
{
   var result = document.getElementById("result");
   result.innerHTML = str; 
}
function getResult(url, query) 
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
      if (xmlHttp.readyState == 4)
      {
         if (xmlHttp.status == 200)
         {
            updatePage(xmlHttp.responseText);
         }
      }
   }
   
   xmlHttp.open("POST",url,true);
   xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

   xmlHttp.send(query);

}
function loadTeachers()
{
   getResult('http://157.201.194.254/~ercanbracks/cs313/w09/robb/teachers.php', "");
}

function select(teacherId)
{
   if (teacherId < 0)
      return;
   teacher = document.getElementById(teacherId);
   
   teacher.style.backgroundColor="yellow";
   if (tId >= 0)
   document.getElementById(tId).style.backgroundColor="LightSkyBlue";
      
   
   if (tId != teacherId)
   {
      tId = teacherId;
      document.getElementById("save").disabled = false;
      document.getElementById("firstName").value = teacher.cells[0].innerHTML;
      document.getElementById("lastName").value = teacher.cells[1].innerHTML;
      document.getElementById("userName").value = teacher.cells[2].innerHTML;
      document.getElementById("email").value = teacher.cells[3].innerHTML;
      document.getElementById("streetAddr").value = teacher.cells[4].innerHTML;
      document.getElementById("city").value = teacher.cells[5].innerHTML;
      document.getElementById("zip").value = teacher.cells[6].innerHTML;

   }
   else
   {
      document.getElementById("teachersForm").reset();
      document.getElementById("save").disabled = true;
      tId = -1;
   }

}

function addEntry()
{
   var firstName = document.getElementById("firstName");
   var lastName = document.getElementById("lastName");
   var userName = document.getElementById("userName");
   var email = document.getElementById("email");
   var streetAddr = document.getElementById("streetAddr");
   var city = document.getElementById("city");
   var zip = document.getElementById("zip");
   var now = new Date();
   if (validate(firstName, lastName, userName, email, streetAddr, city, zip))
   {
      var queryStr = "type=add"
                   + "&firstName=" + firstName.value
                   + "&lastName=" + lastName.value
                   + "&userName=" + userName.value
                   + "&email=" + email.value
                   + "&streetAddr=" + streetAddr.value
                   + "&city=" + city.value
                   + "&zip=" + zip.value
                   + "&time=" + now.getTime();
      getResult("http://157.201.194.254/~ercanbracks/cs313/w09/robb/teachers.php",queryStr);
   }
}
function saveData()
{
   var firstName = document.getElementById("firstName");
   var lastName = document.getElementById("lastName");
   var userName = document.getElementById("userName");
   var email = document.getElementById("email");
   var streetAddr = document.getElementById("streetAddr");
   var city = document.getElementById("city");
   var zip = document.getElementById("zip");
   var now = new Date();
   if (validate(firstName, lastName, userName, email, streetAddr, city, zip))
   {
      var queryStr = "type=mod"
            + "&teacherId=" + tId
            + "&firstName=" + firstName.value
            + "&lastName=" + lastName.value
            + "&userName=" + userName.value
            + "&email=" + email.value
            + "&streetAddr=" + streetAddr.value
            + "&city=" + city.value
            + "&zip=" + zip.value
            + "&time=" + now.getTime();
      getResult("http://157.201.194.254/~ercanbracks/cs313/w09/robb/teachers.php",queryStr);
   }
}
function rm(teacherId)
{
   var now = new Date();
   teacher = document.getElementById(teacherId);
   var queryStr = "type=rm"
         + "&teacherId=" + teacherId
         + "&time=" + now.getTime();
   teacher.style.backgroundColor="Red";
   teacher.style.color="LightSkyBlue";
   if (confirm("Are you sure you want to DELETE this teacher?"))
   {
      getResult("http://157.201.194.254/~ercanbracks/cs313/w09/robb/teachers.php",queryStr);
      sId = -1;
   }
   teacher.style.backgroundColor="LightSkyBlue";
   teacher.style.color="black";
   tId = -1;
      
}
