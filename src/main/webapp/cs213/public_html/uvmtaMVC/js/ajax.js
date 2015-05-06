function getAjaxObject()
{
   var req;
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
   if (req == null)
   {
     alert("Your browser does not support Asyncronous JavaScript technology");
   }
   return req;
}

function ajaxRequest(fileName, queryString, xhtmlElement, innerHTML)
{

   var url;
   var req = getAjaxObject();
   var elementId = xhtmlElement;

// url = "http://" + window.location.hostname + "/~ercanbracks/uvmtaMVC/" + fileName + queryString;
   url = fileName + queryString;
   req.open("GET", url, false);   // Syncronous request doesn't need a callback handler
   req.send(null); 
   if (req != null)
   {
      if (innerHTML)
      {
        document.getElementById(elementId).innerHTML = req.responseText;
      }
      else
      {
          document.getElementById(elementId).value = req.responseText;
      }
   }
}

