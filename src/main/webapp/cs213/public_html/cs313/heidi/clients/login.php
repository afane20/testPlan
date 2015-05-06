<!--
assign 10 page for cs313  - template
-->
<!DOCTYPE html>
<html>
    <head>
        <title>UVMTA</title>
        <?php include '/home/ercanbracks/public_html/cs313/heidi/module/head-info.php' ?>
        <script type="text/JavaScript">
          function ercanbrack() {
              document.getElementById('ercanbrack').innerHTML = "<h4>Account with Teacher rights:</h4><p>Username: teacher@test.com</p><p>password: 123</p><h4>Account with Admin rights:</h4><p>Username: admin@test.com</p><p>password: 123</p>"
          }  
        </script>

    </head>
    <body>
        <div id="wrapper">
            <header>
                <?php include '/home/ercanbracks/public_html/cs313/heidi/module/header.php' ?>
            </header>
            <nav>
                <?php include '/home/ercanbracks/public_html/cs313/heidi/module/nav.php' ?>
            </nav>

            <div id="content">
                <div>

                    <h1>Teacher Login</h1>




                    <?php
                    if (isset($message)) {
                        echo "<p class='errors'> $message </p>";
                    } elseif (!empty($errors)) {
                        echo '<ul class="errors">';
                        foreach ($errors as $error) {
                            echo "<li>$error</li>";
                        }
                        echo '</ul>';
                    }
                    ?>

                    <form action="." method="post" id="login_form">
                        <fieldset>
                            <label for="email">Email Address:</label>  <br>    
                            <input type="text" required name="email" <?php echo "value=\"" . $_POST['email'] . "\""; ?> id="email" size="50" > <br>
                            <label for="password">Password:</label>  <br>          
                            <input type="password" required name="password" id="password" size="50" > <br>


                        </fieldset>
                        <input type="submit" name="action" id="action" class="button" value="Login">
                        <button type="button"class="button" onclick="ercanbrack()" >Click Me Bro Ercanbrack</button>
                        <div id="ercanbrack"></div>
                    </form>




                </div>

            </div>
        </div>

    </body>
</html>
