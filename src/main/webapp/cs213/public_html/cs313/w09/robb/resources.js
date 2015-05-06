rId = -1;
function validate(bldg, room, numPanios)
{
   if (!bldg.value.match(/[A-Za-z]{3}/))
   {
      bldg.focus();
      alert("Building is required and must be a 3-letter building abbriviation.");
      return false;
   }   
   else if (!room.value.match(/\d{1,3}/))
   {
      room.focus();
      alert("Room number must be 1-3 digits.");
      return false;
   }
   else if (!numPanios.value.match(/[0-4]/))
   {
      numPanios.focus();
      alert("numPanios must be between 0 and 4.");
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
function loadResources()
{
   getResult('http://157.201.194.254/~ercanbracks/cs313/w09/robb/resources.php', "");
}
function addEntry()
{
   var bldg = document.getElementById('bldg');
   var room = document.getElementById('room');
   var numPanios = document.getElementById('numPanios');
   var now = new Date();
   if (validate(bldg, room, numPanios))
   {
      var queryStr = "type=add"
                   + "&bldg=" + bldg.value
                   + "&room=" + room.value
                   + "&numPanios=" + numPanios.value
                   + "&time=" + now.getTime();
      getResult("http://157.201.194.254/~ercanbracks/cs313/w09/robb/resources.php",queryStr);
   }
}
function select(resourceId)
{
   if (resourceId < 0)
   return;
   resource = document.getElementById(resourceId);
   
   resource.style.backgroundColor="yellow";
   if (rId >= 0)
      document.getElementById(rId).style.backgroundColor="LightSkyBlue";
      
   if (rId != resourceId)
   {
      rId = resourceId;
      document.getElementById("save").disabled = false;
      document.getElementById("bldg").value = resource.cells[0].innerHTML;
      document.getElementById("room").value = resource.cells[1].innerHTML;
      document.getElementById("numPanios").value = resource.cells[2].innerHTML;

   }
   else
   {
      document.getElementById("resourcesForm").reset();
      document.getElementById("save").disabled = true;
      rId = -1;
   }

}
function saveData()
{
   var now = new Date();
   var bldg = document.getElementById("bldg");
   var room = document.getElementById("room");
   var numPanios = document.getElementById("numPanios");
   if (validate(bldg, room, numPanios))
   {
      var queryStr = "type=mod"
            + "&resourceId=" + rId
            + "&bldg=" + bldg.value
            + "&room=" + room.value
            + "&numPanios=" + numPanios.value
            + "&time=" + now.getTime();
      getResult("http://157.201.194.254/~ercanbracks/cs313/w09/robb/resources.php", queryStr);
   }
}


