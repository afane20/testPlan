function ajaxGetRegistration(fileName,queryString)
{
   var url;
   var req = getAjaxObject();
   if (req != null)
   {
       req.onreadystatechange = function()
       {
               
           if (req.readyState == 4)    // if ajax request is complete
           {
             if (req.status == 200)          // if status is ok
             {
                response = req.responseText;
                var regRecord = response.split(',');
                document.getElementById('eName').value = regRecord[0];
                document.getElementById('eName2').value = regRecord[1];
                document.getElementById("eStudentId").value = regRecord[2];
                document.getElementById("eStudentId2").value = regRecord[3];
                document.getElementById("eInstrument").value = regRecord[4];
                document.getElementById("ePerformanceType").value = regRecord[5];
                document.getElementById("eLevel").value = regRecord[6];
                document.getElementById("eFestivalDay").value = regRecord[7];
                document.getElementById("ePrevTimeSlotId").value = regRecord[8];
                document.getElementById("eRegistrationId").value = regRecord[9];
                document.getElementById("eRegistrationId2").value = regRecord[10];
            }
            else
            {
                alert("There was a problem retrieving the data:\n" + req.statusText  );
            }
          }
      }
      url = fileName + queryString;      
      req.open("GET", url, false);
      req.send(null);
   }

}
