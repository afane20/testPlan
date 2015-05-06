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
                        <fieldset>
                            <h3>First Name:</h3>
                            <p id="firstname"><?php echo $firstname; ?></p>
                            <h3>Last Name:</h3>
                            <p id="lastname" ><?php echo $lastname; ?></p>
                            <h3>Email Address: (This is your username)</h3>      
                            <p id="email" ><?php echo $emailaddress; ?></p> 
                            
                            <h3 for="phone">Phone Number:</h3>      
                            <p id="phone" ><?php echo $phone; ?></p> 
                            
                            <h3 for="address">Full Mailing address:</h3>      
                            <p id="phone"><?php echo $mailingAddress; ?></p> 
                            
                            <h3>Number of Students Cleared for Registration:</h3>      
                            <p id="numStudentsClearToRegister"><?php echo $numStudentsClearToRegister ?></p> 
              
                            <h3>Dues Paid?</h3>      
                            <p id="duesPaid"><?php echo $duesPaid; ?></p> 
                            
                            

                            

                            <input type="hidden"  name="teacherid" value="<?php echo $teacherId; ?>">
                            <input type="hidden"  name="type" value="edit" >
                            <input type="hidden"  name="action" value="profile">
                            
                            <input type="submit" name="button" id="action" value="Edit Profile">



<!-- value="<?php //$email ?>" -->
                        </fieldset>

                    </form>




                </div>

            </div>
        </div>

    </body>
</html>
