
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
              else
              {
                 alert("There was a problem retrieving the data:\n" + req.statusText  );
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
              else
              {
                 alert("There was a problem retrieving the data:\n" + req.statusText  );
              }
           }
        }
      }
//      url = "http://" + window.location.hostname + "/~ercanbracks/uvmtaMVC/" + fileName + queryString;
      url = fileName + queryString;
//    alert(url);
      req.open("GET", url, true);  // async
//      req.open("GET", url, false);   // sync
      req.send(null);

     // sample POST 
//      url = "http://157.201.194.254/~ercanbracks/uvmta/" + fileName;
//      req.open("POST", url, true);
//      req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//      req.setRequestHeader("Content-length", query.length);
//      req.setRequestHeader("Connection", "close");
//      req.send(queryString);
   }
}

