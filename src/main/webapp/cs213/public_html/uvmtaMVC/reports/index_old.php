<?php
include '../model/loginValid.php';
session_start();
?>

<html>
<head>
  <title>Resources</title>

  <link rel="stylesheet" type = "text/css" href="../css/uvmta.css" />
  <script src = "../js/ajax.js"></script>
  <script src = "../js/app.min.js"></script>

  <script type="text/javascript">

  function regList(sortBy)
  {
    if(arguments.length == 0)
    {
       sortBy = "building";
    }
    var building = document.getElementById("building").value;
    var room = document.getElementById("room").value;
    
    var queryString = "?sortBy=" + sortBy + "&building=" + building + "&room=" + room;  
    ajaxRequest("regReportList.php",queryString,"rList",1);
  }
  function printRegList(sortBy)
  {
    if(arguments.length == 0)
    {
       sortBy = "building";
    }
    var building = document.getElementById("building").value;
    var room = document.getElementById("room").value;
    
    var queryString = "?sortBy=" + sortBy + "&building=" + building + "&room=" + room;  
    var url = "printRegReport.php" + queryString;
    window.location.assign(url);
  }


  function clearForm()
  {
     document.getElementById('building').value = "";
     document.getElementById('room').value = "";
  }

  function clearFormAndRefresh()
  {
     clearForm();
     regList();
  }


  // displays an error in the "error message location i.e. <div id = "error">)
  function displayError(errMsg)
  {
     document.getElementById("error").innerHTML = errMsg;
  }

  function clearErrorField()
  {
    document.getElementById("error").innerHTML = "&nbsp;";
  }

  function validateForm()
  {

  }

</script>

</head>

<body onload = "regList('building')">
    <?php include("../menu.php");?>
     
<div  class = "content center" onmousedown = "clearErrorField()">
   <div class = "heading">Registration Report</div>
   <div id="regReport">
     <form>
         <br />
        <table>
        <tr class = "center">
          <td>Building</td>
          <td>Room #</td>
        </tr>
        <tr>
          <td><input type="text" id="building" size = "10" maxlength = "10" onfocus = "clearErrorField()"/></td>
          <td><input type="text" id="room" size = "10" maxlength = "10"/></td>
        </tr>
        </table>
        <br />

         <p class = "center">
         <input id = "showReport" class = "center" type="button" value="Show Report"
            onclick = "regList()" />
         <input id = "clear" class = "center" type="reset" value="Clear Form"
            onclick = "clearFormAndRefresh();" />
         <input id = "printReport" class = "center" type="button" value="Printable Judging Report"
            onclick = "printRegList()" />
        </p>
     </form>

     <hr />
     <h3 class = "center"> Registration List</h3>
 
   <div id = "error" style = "color: red"> &nbsp; </div>

   <div id = "rList" onmousedown = "clearErrorField()" >
   </div>

</div>
</body>
</html>   
