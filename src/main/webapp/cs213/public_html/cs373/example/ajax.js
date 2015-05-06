var http = getXmlHttpRequestObject();

function getXmlHttpRequestObject() 
{
  var xmlHttp = null;
  try
  {
    xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {
    try
    {
       xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e)
    {
       xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
  return xmlHttp;
}

function handleHttpResponse() 
{
  // 4 is the signal for finished
  if (http.readyState == 4) 
  {
    //var pic = document.getElementById( 'loading' ).style;
    //pic.display = "none";
    var html = document.getElementById('resultDiv');
    html.innerHTML = http.responseText;	
  }
}

function handleHttpResponseAdd() 
{
  // 4 is the signal for finished
  if (http.readyState == 4) 
  {
    var html = document.getElementById('resultDiv');
    html.innerHTML = http.responseText;
    document.getElementById('error').innerHTML = "Student Added Successfully!";
  }
}

function handleHttpResponseSingleLine() 
{
  // 4 is the signal for finished
  if (http.readyState == 4) 
  {
    //var pic = document.getElementById( 'loading' ).style;
    //pic.display = "none";
    var index = http.responseText.lastIndexOf("#");
    var id = http.responseText.substr(index + 1).replace(/^\s+/, '').replace(/\s+$/, '');
    var text = http.responseText.substr(0,index);
    var html = document.getElementById(id);
    
    html.innerHTML = text;	
  }
}

function getLoadInfo()
{
  var params = "action=load";
  if (http.readyState == 4 || http.readyState == 0) 
  {
    //var pic = document.getElementById( 'loading' ).style;
    //pic.display = "block";
    http.open("POST", "loadInfo.php", true);

    //Send the proper header information along with the request
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.setRequestHeader("Content-length", params.length);
    http.setRequestHeader("Connection", "close");

    http.onreadystatechange = handleHttpResponse; 
    http.send(params);
    return false;
  }
}

function queryData()
{
  var value;
  var checked = false;

  for (i=0;i<document.queryForm.queryType.length;i++)
  {
    if (document.queryForm.queryType[i].checked)
    {
      value = document.queryForm.queryType[i].value;
      checked = true;
    }
  }

  if (!checked)
  {
    document.getElementById('error').innerHTML = "Error: no subject selected.";
  }
  else
  {
    var params = "action=" + value;
    if (http.readyState == 4 || http.readyState == 0) 
    {
      //var pic = document.getElementById( 'loading' ).style;
      //pic.display = "block";
      http.open("POST", "loadInfo.php", true);

      //Send the proper header information along with the request
      http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      http.setRequestHeader("Content-length", params.length);
      http.setRequestHeader("Connection", "close");
	
      http.onreadystatechange = handleHttpResponse; 
      http.send(params);
    }
  }
}

function editAction(id)
{
  var el = document.getElementById(id);

  var params = "action=update";
  var fname = document.getElementById('fnameInput' + id).value.replace(/\s/g, '');
  var lname = document.getElementById('lnameInput' + id).value.replace(/\s/g, '');
  var major = document.getElementById('majorInput' + id).value.replace(/\s/g, '');
  var city = document.getElementById('cityInput' + id).value.replace(/\s/g, '');
  var state = document.getElementById('stateInput' + id).value.replace(/\s/g, '');

  if (fname == "" || fname == " " || lname == "" || lname == " ")
  {
    document.getElementById('error').innerHTML = "Error: student being edited is missing a first or last name.";
    return false;
  }
  else if (major == "" || major == " " || city == "" || city == " " || state == "" || state == " ")
  {
    document.getElementById('error').innerHTML = "Error: missing data.";
    return false;
  }
  else
  {
    params += "&id=" + id + "&fname=" + fname + "&lname=" + lname;
    params += "&major=" + major + "&city=" + city + "&state=" + state;
   
    if (http.readyState == 4 || http.readyState == 0) 
    {
      el.innerHTML = "Updating Data ... <img src='loading.gif' alt='loading' />";
      http.open("POST", "loadInfo.php", true);

      //Send the proper header information along with the request
      http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      http.setRequestHeader("Content-length", params.length);
      http.setRequestHeader("Connection", "close");
	
      http.onreadystatechange = handleHttpResponseSingleLine; 
      http.send(params);
      return false;
    }
  }
}

function editEntry(id)
{
  var fnameTd = document.getElementById('fname' + id);
  var fname = fnameTd.innerHTML;
  var lnameTd = document.getElementById('lname' + id);
  var lname = lnameTd.innerHTML;
  var majorTd = document.getElementById('major' + id);
  var major = majorTd.innerHTML;
  var cityTd = document.getElementById('city' + id);
  var city = cityTd.innerHTML;
  var stateTd = document.getElementById('state' + id);
  var state = stateTd.innerHTML;
  var modifyTd = document.getElementById('modify' + id);

  fnameTd.innerHTML = "<input type='text' maxlength='25' value='" + fname + "' id='fnameInput" + id + "' />";

  lnameTd.innerHTML = "<input type='text' maxlength='25' value='" + lname + "' id='lnameInput" + id + "' />";

  majorTd.innerHTML = "<input type='text' maxlength='3' value='" + major + "' id='majorInput" + id + "' />";

  modifyTd.innerHTML = "<input type='text' maxlength='25' value='" + city + "' id='cityInput" + id + "' />" + " <input type='text' maxlength='25' value='" + state + "' id='stateInput" + id + "' />" + " <input type='button' value='Change' onclick='editAction(" + id + ");' />";

  return true;
}

function info(id)
{
  var el = document.getElementById('info' + id);
  if (el.style.display == 'block')
  {
     el.style.display = 'none';
  }
  else
  {
    el.style.display = 'block';
  }
}

function displayAdd()
{
  var el = document.getElementById('addForm');
  var link = document.getElementById('addLink');
  if (el.style.display == 'block')
  {
    el.style.display = 'none';
    link.innerHTML = "Display Add Student";
  }
  else
  {
    el.style.display = 'block';
    link.innerHTML = "Hide Add Student";
  }
}

function dateKeyPress(e)
{
  var date = document.getElementById('newBirthDate');
  var thisKey;
	
  e = e || window.event;
	
  if (typeof e.charCode != "undefined")
  {
    thisKey = e.charCode;
  }
  else if (e.which)
  {
    thisKey = e.which;
  }
  else
  {
    thisKey = e.keyCode;
  }
		
  var charKey = String.fromCharCode(thisKey);
		
  if (/[0-9]/.test(charKey))
  {
    if (date.value.length == 4)
    {
      date.value = date.value + "-";
    }
    else if (date.value.length == 7)
    {
      date.value = date.value + "-";
    }
  }
}

function addAction()
{
  var error = document.getElementById('error');
  var fname = document.getElementById('newFName').value.replace(/\s/g,"");
  var lname = document.getElementById('newLName').value.replace(/\s/g,"");
  var major = document.getElementById('newMajor').value.replace(/\s/g,"");
  var date = document.getElementById('newBirthDate').value.replace(/\s/g,"");
  var gender = document.getElementById('newGender').value.replace(/\s/g,"");
  var city = document.getElementById('newCity').value.replace(/\s/g,"");
  var state = document.getElementById('newState').value.replace(/\s/g,"");

  if(fname == "" || lname == "")
  {
    error.innerHTML = "Need to have a name.";
    document.getElementById('newFName').focus();
    return false;
  }
  else if (!major.match(/\d{3}/) || major == "")
  {
    error.innerHTML = "Major needs to be three digits.";
    document.getElementById('newMajor').focus();
    return false;
  }
  else if (!date.match(/\d{4}-\d{2}-\d{2}/) || date == "")
  {
    error.innerHTML = "Birth date is not in correct format";
    document.getElementById('newBirthDate').focus();
    return false;
  }
  else if (!gender.match(/[m,f]/i) || gender == "")
  {
    error.innerHTML = "Gender must be M or F.";
    document.getElementById('newGender').focus();
    return false;
  }
  else if (city == "" || state == "")
  {
    error.innerHTML = "City and state need to have values.";
    document.getElementById('newCity').focus();
    return false;
  }

  // submit request
  displayAdd();
  document.getElementById('addForm').reset();

    var params = "action=add";
    params += "&fname=" + fname + "&lname=" + lname;
    params += "&major=" + major + "&city=" + city + "&state=" + state;
    params += "&date=" + date + "&gender=" + gender;
    if (http.readyState == 4 || http.readyState == 0) 
    {
      //var pic = document.getElementById( 'loading' ).style;
      //pic.display = "block";
      http.open("POST", "loadInfo.php", true);

      //Send the proper header information along with the request
      http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      http.setRequestHeader("Content-length", params.length);
      http.setRequestHeader("Connection", "close");
	
      http.onreadystatechange = handleHttpResponseAdd; 
      http.send(params);
    }

  return false
}

function deleteStudent(id)
{
   var response = confirm("Are you sure you want to delete this student?");

   if (response)
   {
      var params = "action=delete&id=" + id;
      if (http.readyState == 4 || http.readyState == 0) 
      {
         http.open("POST", "loadInfo.php", true);
         http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
         http.setRequestHeader("Content-length", params.length);
         http.setRequestHeader("Connection", "close");
	
         http.onreadystatechange = handleHttpResponse; 
         http.send(params);
      }
   }
}
