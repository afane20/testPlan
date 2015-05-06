function ajaxGetTeacher(fileName, queryString)
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
                var teacherRecord = response.split(',');
                
                var first = document.getElementById('firstName');
                if (first != null) {
                  document.getElementById('firstName').value = teacherRecord[0];
                };

                var last = document.getElementById('lastName');
                if (last != null) {
                  document.getElementById('lastName').value = teacherRecord[1];
                };

                var uvmta = document.getElementById('uvmtaId');
                if (uvmta != null) {
                  document.getElementById('uvmtaId').value = teacherRecord[2];
                };

                var street = document.getElementById('street');
                if (street != null) {
                  document.getElementById('street').value = teacherRecord[3];
                };

                var city = document.getElementById('city');
                if (city != null) {
                  document.getElementById('city').value = teacherRecord[4];
                };

                var state = document.getElementById('state');
                if (state != null) {
                  document.getElementById('state').value = teacherRecord[5];  
                };

                var zip = document.getElementById('zip');
                if (zip != null) {
                  document.getElementById('zip').value = teacherRecord[6]; 
                };

                var phone = document.getElementById('phone');
                if (phone != null) {
                  document.getElementById('phone').value = teacherRecord[7];
                };

                var email = document.getElementById('email');
                if (email != null) {
                  document.getElementById('email').value = teacherRecord[8];
                };
              //document.getElementById('pwd').value = teacherRecord[9]; 
                
                var pwd = document.getElementById('pwd');
                if (pwd != null) {
                  document.getElementById('pwd').value = "";  // we only want the admin to create a new password.
                };

                var username = document.getElementById('username');
                  if (username != null) {
                document.getElementById('username').value = teacherRecord[10];
                };

                var membership = document.getElementById('membershipCurrent');
                if (membership != null) {
                  document.getElementById('membershipCurrent').value = teacherRecord[11];
                };

                var membershipFee = document.getElementById('membershipFees');
                if (membershipFee != null) {
                  document.getElementById('membershipFees').value = teacherRecord[12] * 1;
                };

                var reg = document.getElementById('regFees');
                if (reg != null) {
                  document.getElementById('regFees').value = teacherRecord[13] * 1;
                };

                if (teacherRecord[11] == "Y")
                {
                   document.getElementById('membershipCurrent').selectedIndex = 1;
                }
                else
                {
                   document.getElementById('membershipCurrent').selectedIndex = 0;
                }
                
                if (teacherRecord[14] == "Y" && document.getElementById('admin') != null)
                {
                   document.getElementById('admin').selectedIndex = 1;  // set selected option to "admin"
                }
                else if (teacherRecord[14] == "N" && document.getElementById('admin') != null)
                {
                   document.getElementById('admin').selectedIndex = 0;  // set selected option to "not admin"
                }
                else if (document.getElementById('admin') != null)
                {
                    document.getElementById('admin').selectedIndex = 2;   // set selected to treasurer
                }
                
                if (teacherRecord[15] == "Y" && document.getElementById('earlyReg') != null)
                {

                   document.getElementById('earlyReg').selectedIndex = 1;
                }
                else if (document.getElementById('earlyReg') != null)
                {
                   document.getElementById('earlyReg').selectedIndex = 0;
                }
            }
            else
            {
                alert("There was a problem retrieving the data:\n" + req.statusText  );
            }
          }
      }
//    url = "http://" + window.location.hostname + "/~erbracks/uvmtaMVC/" + fileName + queryString;
      url = fileName + queryString;      
      req.open("GET", url, true);
      req.send(null);
   }

}
