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

                    <h2><?php echo $_SESSION['clientfirst'] . " " . $_SESSION['clientlast']; ?>'s Profile</h2>



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
                    <form action="." method="post" id="profile_update_form">
                        <p>All fields are required</p>
                        <fieldset>
                            <label for="firstname">First Name:</label> <br>
                            <input type="text" required name="firstname" <?php echo "value=\"" . $firstname . "\""; ?> id="firstname" size="50" > <br>
                            <label for="lastname">Last Name:</label> <br>
                            <input type="text"  name="lastname" <?php echo "value=\"" . $lastname . "\""; ?> id="lastname" size="50"  > <br>
                            <label for="email">Email Address: (This is your username)</label> <br>     
                            <input type="text" required name="email" <?php echo "value=\"" . $emailaddress . "\""; ?> id="email" size="50" readonly> <br>
                            
                            <label for="phone">Phone Number:</label>   <br>   
                            <input type="text" required name="phone" <?php echo "value=\"" . $phone . "\""; ?> id="phone" size="50" > <br>
                            
                            <label for="address">Full Mailing address:</label>   <br>   
                            <input type="text" required name="address" <?php echo "value=\"" . $mailingAddress . "\""; ?> id="phone" size="50" > <br>
                            
                            <label for="numStudentsClearToRegister">Number of Students Cleared for Registration:</label>   <br>   
                            <input type="text" required name="numStudentsClearToRegister" <?php echo "value=\"" . $numStudentsClearToRegister . "\""; ?> id="numStudentsClearToRegister" size="50" readonly> <br>
              
                            <label for="duesPaid">Dues Paid?</label>   <br>   
                            <input type="text" required name="duesPaid" <?php echo "value=\"" . $duesPaid . "\""; ?> id="duesPaid" size="50" readonly> <br>
                            
                            

                            

                            <input type="hidden"  name="teacherid" value="<?php echo $teacherId; ?>" id="teacherid" > <br>

                            <label for="action"></label>
                            <input type="submit" name="action" id="action" value="Update Profile">



<!-- value="<?php //$email ?>" -->
                        </fieldset>

                    </form>




                </div>

            </div>
        </div>

    </body>
</html>
