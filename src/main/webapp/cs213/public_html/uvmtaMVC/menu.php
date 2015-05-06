<!--Jquery UI-->
<link rel="stylesheet" href="../css/jquery-ui.min.css" />
<link rel="stylesheet" href="../css/jquery-ui.structure.min.css" />
<script src="../js/jqueryExt.js"></script>
<script src="../js/jquery-ui.min.js"></script>
<script src = "../js/app.min.js"></script> 

<script>
 $(window).resize(setHeight);
 setTimeout(setHeight, 1000);
 IEStyle();
 setTimeout(setDrag, 1000);
</script>

<header id="header">
   <div id="topbar">
      <section id="pageTitle">UVMTA Festival Application</section>
      <section id="profile">
         <?php 
            if ($_SESSION['teacherId'] != null) {
               print $_SESSION['firstName'] . " " . $_SESSION['lastName'];
               print "   <a href = \"../profile/\">My Profile</a>";
               print "   <a href = \"../logout.php\">Logout</a>";
            }
         ?>
      </section>
   </div>
   <div id="bottombar">
      <section id="menu">
         <?php
            if ($_SESSION['teacherId'] != null) {
               if ($_SESSION['admin'] != 'Y') {
                  print "<a href = \"../students/\" id='miStudents'>My Students</a>";
                  print "<a href = \"../registration/\" id='miRegistration'>Registration</a>";
               } else {
                  print "<a href = \"../festivals/\" id='miFestivals'>Festivals</a>";
                  print "<a href = \"../resources/ \" id='miResources'>Resources</a>";
                  print "<a href = \"../allStudents/ \" id='miAllStudents'>All Students</a>";
                  print "<a href = \"../allTeachers/\" id='miTeachers'>Teachers</a>";
                  print "<a href = \"../students/\" id='miStudents'>My Students</a>";
                  print "<a href = \"../registration/\" id='miRegistration'>Registration</a>";
                  print "<a href = \"../reports/\" id='miReport'>Report</a>";
               }
            }  
         ?>
      </section>
      <section id="searchBar">
      </section>
</header>
