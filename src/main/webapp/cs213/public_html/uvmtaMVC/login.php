<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="css/uvmta.css" />
  <script type="text/javascript">
    function validate()
    {
       var password = document.getElementById('pwd').value;
       var username = document.getElementById('username').value;
       if (password == "" || username =="")
       {
          document.getElementById('username').focus();
          return false;
       }
       else
          return true;
    }   
  </script>
</head>
<body onload = "document.getElementById('username').focus()">
<?php include("menu.php"); ?>
<div class="login">
     <form method="POST" action="model/loginCheck.php" onsubmit = "return validate();">
        <h2>Login</h2>
        
        <label>User Name:</label>
        <input type="text" name="username" id="username" size = "20" maxlength =
                onblur = "document.getElementById('loginError').style.visibility = 'hidden'" /><br/>
        
        <label>Password:</label>
        <input type="password" name="pwd" id="pwd" size = "20" maxlength = "16"/>
      
        <p>
           <input style = "text-align: center" type="submit" value="Login" />
           <input type="hidden" name="url" id = "url" value="<?php print $_GET['url'] ?>" /><br/>
      <?php

       $loginError = $_GET['error'];
        if ($loginError == 1)
        {
        ?>
             <div id = "loginError" style = "font-size: medium; color: red; visibility: visible" >
                Invalid Username or Password!</div>
        <?php               
        }
        else if ($loginError == 2)
        {
        ?>
             <div id = "loginError" style = "font-size: medium; color: red; visibility: visible" >
               MYSQL Database Connection Error - UVMTA application not available!</div>
        <?php                        
        }
        else if ($loginError == 3)
        {
        ?>
             <div id = "loginError" style = "font-size: medium; color: red; visibility: visible" >
               MYSQL Select Database error - UVMTA application not available!</div>
        <?php                        
        }
        else
        {
        ?>
             <div id = "loginError" style = "font-size: medium; color: red; visibility: hidden" >
                Invalid Username or Password!</div>
        <?php
        }
        ?>

         </p>
    </form>
</div>
</body>
</html>
