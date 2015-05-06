<?php
include '../model/loginValid.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Resources</title>
  <link rel="stylesheet" href="../css/uvmta.css" /> 
  <script src="../js/jquery.js"></script>
  <script type="text/javascript" src = "../js/ajax.js"></script>
  <script src="../js/app.min.js"></script>
  <script>
    $(window).resize(setHeight);
    setTimeout(setHeight, 1000);
    IEStyle();
  </script>
  <script type="text/javascript">

  function resourceList(sortBy)
  {
    
    if(arguments.length == 0)
    {
       sortBy = "building";
    }
    var queryString = "?sortBy=" + sortBy;  
    ajaxRequest("../model/resourceList.php",queryString,"resourceListDiv",1);
    var menuItem = document.getElementById('miReport');
    menuItem.className = menuItem.className + "menuSelected";
    $('tr').click(printRegList);
    
  }

function printRegList(sortBy)
{
   if(arguments.length == 0)
   {
      sortBy = "building";
   }
   var cells = this.cells;
   var resourceId = cells[0].innerHTML;
   var building =  cells[1].innerHTML;
   var room = cells[2].innerHTML;
   var startTime = cells[4].innerHTML;
   var endTime = cells[5].innerHTML;
   var timeInc = cells[6].innerHTML;
   
   
//   alert(resourceId + " " + building + " " + room + " " + startTime + " " + endTime + " " + timeInc);
   var queryString = "?sortBy=" + sortBy + "&building=" + building + "&room=" + room +
                     "&startTime=" + startTime + "&endTime=" + endTime + "&timeInc=" + timeInc + "&resourceId=" + resourceId;
   var url = "printRegReport.php" + queryString;
   window.location.assign(url);
}
</script>
<link rel="stylesheet" herf="css/reports.css" />
</head>

<body onload = "resourceList('building')">
<?php include("../menu.php"); ?>
<div id="master">
    <h1 class = "center">Registration Reporting</h1>
    <h2 class = "center">Click on the resource below for a printable registation list</h2>
    <div class="flex" id = "resourceListDiv" >
    </div>    

</div>


</body>
</html>   
