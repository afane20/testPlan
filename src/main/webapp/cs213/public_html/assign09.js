// assign09.js
// javascript for assignment 09

function ajax(country)
{
   var xmlhttp;
   if (window.XMLHttpRequest)
   {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
   }
   else
   {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   }
   
   xmlhttp.onreadystatechange = function()
   {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
      {
         document.getElementById("display").innerHTML = xmlhttp.responseText;
      }
   }

   xmlhttp.open("GET", "http://localhost:1024/~ercanbracks/" + country, true);
   xmlhttp.send();
}

function url3()
{
   var urlToSearch = document.getElementById("url").value;
   
   var xmlhttp;
   if (window.XMLHttpRequest)
   {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
   }
   else
   {// code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
   }

   xmlhttp.onreadystatechange = function()
   {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
      {
         document.getElementById("displayPart2").innerHTML = xmlhttp.responseText;
      }
   }

   xmlhttp.open("GET", urlToSearch, true);
   xmlhttp.send();
}