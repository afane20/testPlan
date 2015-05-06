function ajaxGetFestival(fileName, queryString)
{
   var url;
   var req = getAjaxObject();
   if (req != null)
   {
//     url = "http://" + window.location.hostname + "/~ercanbracks/uvmta/" + fileName + queryString;
       url = fileName + queryString;
       req.open("GET", url, false);    // Syncronous
       req.send(null);

       response = req.responseText;
       var festivalRecord = response.split(','); 
       document.getElementById('open').innerHTML = festivalRecord[0];
       document.getElementById('festivalId').innerHTML = festivalRecord[1];
       document.getElementById('festivalName').innerHTML = festivalRecord[2];
       document.getElementById('festivalDate').innerHTML = festivalRecord[3];
       document.getElementById('alternateDate').innerHTML = festivalRecord[4];
       document.getElementById('regFee').innerHTML = festivalRecord[5] * 1;  
       document.getElementById('regFeeAlt').innerHTML = festivalRecord[6] * 1; 
       document.getElementById('regOpen').innerHTML = festivalRecord[7];
       document.getElementById('regOpenEarly').innerHTML = festivalRecord[8];
       document.getElementById('regEnds').innerHTML = festivalRecord[9];
       document.getElementById('currentFestival').innerHTML = festivalRecord[10];
   }
}
