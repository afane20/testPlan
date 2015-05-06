sId = -1;

function validate(firstName, lastName, instrument)
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
   else if (!instrument)
   {
      alert("Instrument cannot be left blank.");
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

function selectTeacher()
{

   var teacherList = document.getElementById("teacherList");
   teacherId = teacherList[teacherList.selectedIndex].value;
      
   
   var query="action=display&teacherId=" + teacherId;
   getResult('http://157.201.194.254/~ercanbracks/cs313/w09/robb/students.php', query);
   sId = -1;
}
function addEntry()
{ 
   var firstName = document.getElementById("firstName").value;
   var lastName = document.getElementById("lastName").value;
   var instrument = document.getElementById("instrument").value;
   var level = document.getElementById("levels");
   level = level[level.selectedIndex].value;
   var now = new Date();
   if (validate(firstName, lastName, instrument))
   {
      var queryStr = "type=add"
                   + "&teacherId=" + teacherId
                   + "&firstName=" + firstName
                   + "&lastName=" + lastName
                   + "&instrument=" + instrument
                   + "&level=" + level
                   + "&time=" + now.getTime();
      getResult("http://157.201.194.254/~ercanbracks/cs313/w09/robb/students.php",queryStr);
//       load();
   }
}
function select(studentId)
{
   if (studentId < 0)
      return;
   student = document.getElementById(studentId);
   
   student.style.backgroundColor="yellow";
   if (sId >= 0)
      document.getElementById(sId).style.backgroundColor="LightSkyBlue";
      
   if (sId != studentId)
   {
      sId = studentId;
      document.getElementById("save").disabled = false;
      document.getElementById("firstName").value = student.cells[0].innerHTML;
      document.getElementById("lastName").value = student.cells[1].innerHTML;
      document.getElementById("instrument").value = student.cells[2].innerHTML;
      document.getElementById("levels").value = student.cells[3].innerHTML;
   }
   else
   {
      document.getElementById("studentsForm").reset();
      document.getElementById("save").disabled = true;
      sId = -1;
   }
      
   if ((sId >= 0) && (document.getElementById(sId).cells[4].innerHTML == ""))
      document.getElementById("schedule").disabled = false;
   else
      document.getElementById("schedule").disabled = true;

}
function reg()
{
   var slotList = document.getElementById("slotList");
   var slotId = slotList[slotList.selectedIndex].value;
   
   if (sId < 0)
   {
      alert("select a student first");
   }
   else
   {
      var now = new Date();
      var queryStr = "type=reg"
                   + "&teacherId=" + teacherId
                   + "&slotId=" + slotId
                   + "&studentId=" + sId
                   + "&time=" + now.getTime();
      getResult("http://157.201.194.254/~ercanbracks/cs313/w09/robb/students.php",queryStr);
   }
}
function unreg(studentId)
{
      var now = new Date();
      student = document.getElementById(studentId);
      if (student.cells[4].innerHTML)
      {
         var queryStr = "type=unreg"
                     + "&teacherId=" + teacherId
                     + "&studentId=" + studentId
                     + "&time=" + now.getTime();
            getResult("http://157.201.194.254/~ercanbracks/cs313/w09/robb/students.php",queryStr);
      }
      else
      {
         alert("This student has not been registered for a time.");
      }
}
function rm(studentId)
{
      var now = new Date();
      student = document.getElementById(studentId);
      var queryStr = "type=rm"
                   + "&teacherId=" + teacherId
                   + "&studentId=" + studentId
                   + "&time=" + now.getTime();
      student.style.backgroundColor="Red";
      student.style.color="LightSkyBlue";
      if (confirm("Are you sure you want to DELETE this student?"))
      {
         getResult("http://157.201.194.254/~ercanbracks/cs313/w09/robb/students.php",queryStr);
         sId = -1;
      }
      student.style.backgroundColor="LightSkyBlue";
      student.style.color="black";
      
}
function save()
{
   var now = new Date();
   var firstName = document.getElementById("firstName").value;
   var lastName = document.getElementById("lastName").value;
   var instrument = document.getElementById("instrument").value;
   var level = document.getElementById("levels").value;
   
   
}
