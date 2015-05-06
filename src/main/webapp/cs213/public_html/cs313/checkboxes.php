<?php
  $list  = $_REQUEST['purchase'];    // handles either $_POST or $_GET
?>

<html>
   <head>
     <title>Purchased items</title>
   </head>
   <body>
     <h1>Purchased Items</h1>
     <p>
       <?php
         print "<br />Displayed with foreach<br />";
         foreach ($list as $temp)
         {
           print "$temp<br />";
         }
         print "<br />Displayed with for loop<br />";
         for( $i = 0; $i < sizeof($list); $i++)
         {
            print "$list[$i]<br />";
         }
       ?>
     </p>
   </body>
</html>