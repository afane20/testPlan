<?='<?xml version="1.0" encoding="UTF-8"?>'?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
    <head>
        <base href="<?=SITE_URL?>" />
        <title>Assignment 10</title>
        <link href="styles.css" rel="stylesheet" type="text/css" />
        <link href="datepicker.css" rel="stylesheet" type="text/css" />
        <?php foreach ($stylesheets as $style): ?>
        <link href="<?=$style?>.css" rel="stylesheet" type="text/css" />
        <?php endforeach; ?>
        <script type="text/javascript" src="prototype.js"></script>
        <script type="text/javascript" src="common.js"></script>
        <?php foreach ($javascripts as $js): ?>
        <script type="text/javascript" src="<?=$js?>.js"></script>
        <?php endforeach; ?>
        <script type="text/javascript">
            var site_url = "<?=SITE_URL?>";            
        </script>
    </head>
    <body onload="<?=isset($onload) ? $onload : ''?>">
        <div id="popup_message" style="display: none;"></div>
        <div id="header">
            <h1>Piano Festival</h1>
            <?php if (is_object($user)): ?>
            <div align="right">
            Welcome <?=$user->name?>!
            <?php if (basename($_SERVER['PHP_SELF']) == 'admin_home.php'): ?>
            <a class="button" href="teacher_home.php">Teacher Home</a>
            <?php elseif (basename($_SERVER['PHP_SELF']) == 'teacher_home.php' && $user->is_admin == 1): ?>
            <a class="button" href="admin_home.php">Admin Home</a>
            <?php endif; ?>
            <a class="button" href="<?=SITE_URL?>actions.php?action=logout">Logout</a>
            </div>
            <?php endif; ?>
        </div>
        <div id="content">
