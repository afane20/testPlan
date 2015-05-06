<?php
  mail($_POST['to'], $_POST['subject'], $_POST['body'], "From: ".$_POST['from']);
?>

<html>
   <head>
     <title>Email has been sent</title>
   </head>
   <body>
      <h1>Message Sent</h1>
      <p>
        Your message has been sent to 
        <?php
          $to = $_REQUEST['to'];     // $_REQUEST works with POST or GET because it contains variables from BOTH
          echo "$to"
        ?>
     </p>
       <p> <a href = "email.html">Back to Email Form</a> </p>
   </body>
</html>