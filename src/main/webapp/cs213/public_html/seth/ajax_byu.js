
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

   return req;
}


function ajaxRequest(fileName, queryString, xhtmlElement, innerHTML)
{
 
   var url;
   var req = getAjaxObject();
   var elementId = xhtmlElement;
   if (req != null)
   {
      if (innerHTML)
      {
        req.onreadystatechange = function()
        {

           if (req.readyState == 4)    // if ajax request is complete
           {
              if (req.status == 200)          // if status is ok
              {
                document.getElementById(elementId).innerHTML = req.responseText;
              }
           }
        }
      }
      else
      {
        req.onreadystatechange = function()
        {
           if (req.readyState == 4)    // if ajax request is complete
           {
              if (req.status == 200)          // if status is ok
              {
                 document.getElementById(elementId).value = req.responseText;
              }
           }
        }
      }

      url = "http://localhost/~ercanbracks/seth/" + fileName + queryString;
      req.open("GET", url, true);  // async
      req.send(null);
  }
}

