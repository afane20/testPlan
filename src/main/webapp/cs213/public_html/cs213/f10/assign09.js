/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var req;			
function processReqChange()
{
 // only if req shows "complete"
   if (req.readyState == 4)
   {
     alert(req.readyState);
   //   alert(req.status);
   // only if "OK"
     if (req.status == 200)
     {
     // alert(req.status);
     // ...processing statements go here...
         var theText = req.responseText;
         document.getElementById("dataField").innerHTML = theText;
     }
     else
     {
        alert("There was a problem retrieving the XML data:\n" + req.statusText + " " + req.status);
        document.getElementById("dataField").innerHTML = "Server Error";
     }
   }
 }
 
function processReqChangeSite()
{
 // only if req shows "complete"
  
   if (req.readyState == 4)
   {
      //  alert(req.readyState);
   //   alert(req.status);
   // only if "OK"
     if (req.status == 200)
     {
      alert(req.status);
     // ...processing statements go here...
         var theText = req.responseText;
         alert(urlField);
         document.getElementById("urlField").innerHTML = theText;
     }
     else
     {
        alert("There was a problem retrieving the XML data:\n" + req.statusText + " " + req.status);
        document.getElementById("urlField").innerHTML = "Server Error";
     }
   }
 }

function getInfo(url, country)
{
 // branch for native XMLHttpRequest object
   if (window.XMLHttpRequest)
   {   
    	req = new XMLHttpRequest(); 
   }
 	  // branch for IE/Windows ActiveX version
   else if (window.ActiveXObject)
   {
       req = new ActiveXObject("Microsoft.XMLHTTP");
   } 
   if (req != null) 
   {
      if(country == true)
       {
          req.onreadystatechange = processReqChange;
          req.open("GET", url, true);
          req.send(null);
       }
       else
       {
          req.onreadystatechange = processReqChangeSite;
          req.open("GET", url, true);
          req.send(null);
       }
   }
   else 
   {
       alert("Brower doesn't support XMLHttp");
   }
}

function getData(country)
{
    getInfo("http://157.201.194.254/~ercanbracks/" + country + ".txt", true);
}

function getSite()
{   
    var site = document.getElementById("site").value;
    getInfo(site, false);
}

