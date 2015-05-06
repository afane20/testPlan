<!--
assign 10 page for cs313  - template
-->
<!DOCTYPE html>
<html>
    <head>
        <title>UVMTA</title>
        <?php include '/home/ercanbracks/public_html/cs313/heidi/module/head-info.php' ?>
        <script type="text/JavaScript">
            
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

                    <h1>Teacher Registration</h1>



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
                    <form action="." method="post" id="register_form">
                        <p>All fields are required</p>
                        <fieldset>
                            <label for="firstname">First Name:</label> <br>
                            <input type="text" required name="firstname" <?php echo "value=\"" . $_POST['firstname'] . "\""; ?> id="firstname" size="50" > <br>
                            <label for="lastname">Last Name:</label> <br>
                            <input type="text"  name="lastname" <?php echo "value=\"" . $_POST['lastname'] . "\""; ?> id="lastname" size="50"  > <br>
                            <label for="email">Email Address: (This will be your user name)</label> <br>     
                            <input type="text" required name="email" <?php echo "value=\"" . $_POST['email'] . "\""; ?> id="email" size="50" > <br>
                            
                            <label for="phone">Phone Number:</label>   <br>   
                            <input type="text" required name="phone" <?php echo "value=\"" . $_POST['phone'] . "\""; ?> id="phone" size="50" > <br>
                            
                            <label for="address">Full Mailing address:</label>   <br>   
                            <input type="text" required name="address" <?php echo "value=\"" . $_POST['address'] . "\""; ?> id="phone" size="50" > <br>
                            
                            <label for="password">Password:</label>  <br>
                            <input type="password" required name="password" id="password" size="50" > <br>
                            <label for="password2">Password Repeat:</label> <br>    
                            <input type="password"  required name="password2" id="password2" size="50" > <br>
                            
                            <label for="action"></label>
                            <input type="submit" name="action" id="action" class="button" value="Register">



                        </fieldset>

                    </form>

                </div>

            </div>
        </div>

    </body>
</html>
