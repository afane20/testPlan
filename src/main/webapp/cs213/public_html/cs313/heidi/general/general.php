<!--
assign 10 page for cs313  - template
-->
<!DOCTYPE html>
<html>
    <head>
        <title>UVMTA</title>
        <?php //include $_SERVER ['DOCUMENT_ROOT'] . '/~ercanbracks/cs313/heidi/module/head-info.php' ?>
        <?php include '/home/ercanbracks/public_html/cs313/heidi/module/head-info.php' ?>
        <script type="text/JavaScript">
            
        </script>

    </head>
    <body>
        <div id="wrapper">
            <header>
                <?php //include $_SERVER ['DOCUMENT_ROOT'] .'/cs313/heidi/module/header.php' ?>
                <?php include '/home/ercanbracks/public_html/cs313/heidi/module/header.php' ?>
                <?php //include 'module/header.php' ?>
            </header>
            <nav>
                <?php include '/home/ercanbracks/public_html/cs313/heidi/module/nav.php' ?>
            </nav>

            <div id="content">
                <div id="content-sample">
                <h1>UVMTA's Current Music Festival</h1>
                <img src="cartoonpianoboy.png" id="img-left" alt="pianoboy" width="400">
                <div id="div-right">
                    <?php if(!$message){?>
                    
                    
                    <h2><?php echo $name;?></h2>
                    
                    <h3>Location:</h3>
                    <p><?php echo $location;?></p>
                    
                    <h3>Main Festival Day:</h3>
                    <p><?php echo $mainDay;?></p>
                    <p><?php echo $mainTimeFrame;?></p>
                    <p><?php echo "Cost: ".$mainDayCost;?></p>
                    
                    
                    <h3>Alternate Festival Day:</h3>
                    <p><?php echo $altDay;?></p>
                    <p><?php echo $altTimeFrame;?></p>
                    <p><?php echo "Cost: ".$altDayCost;?></p>
                    
                    <h3>Early Registration:</h3>
                    <p><?php echo "Starts ".$earlyRegistrationDate;?></p>
                    <p><?php echo "Currently Open: ".$earlyRegistrationLive;?></p>
                    
                    <h3>Normal Registration:</h3>
                    <p><?php echo "Starts ".$normalRegistrationDate;?></p>
                    <p><?php echo "Currently Open: ".$normalRegistrationLive;?></p>

                    
                    
                    <?php } else {echo $message;}?>
                    
                </div>

                </div>
            </div>
        </div>

    </body>
</html>
