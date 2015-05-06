<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link type="text/css" href="css/bootstrap.min.css" />
        <link type="text/css" href="css/bootstrap-timepicker.min.css" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>
    </head>
    <body>
        <div class="bootstrap-timepicker pull-right">
            <input id="timepicker3" type="text" class="input-small">
        </div>
 
        <script type="text/javascript">
            $('#timepicker3').timepicker({
                minuteStep: 5,
                showInputs: false,
                disableFocus: true
            });
        </script>
    </body>
</html>