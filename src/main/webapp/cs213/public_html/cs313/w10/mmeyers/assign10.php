<?php
require_once('app_top.php');

$submitted = is_form_submitted();
$message = get_get_var('message');

if ($submitted)
{
    $username = get_post('username');
    $password = get_post('password');

    if (!login($username, $password))
    {
        $message = 'Could not log in.  Please try again';
    }


}

if ($message == 'not_logged_in')
    $message = 'You must login to see this page';

$onload = '$(\'username\').focus()';

require_once('header.php');
?>

<div align="center">
    <form action="assign10.php" method="post">
        <table class="login">
            <tr>
                <td colspan="2">
                    Please login to access your account.<br/>
                    <table>
                        <tr>
                            <td colspan="2"><b>Admin Account:</b><br/></td>
                            <td colspan="2"><b>Teacher Account:</b><br/></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 15px;">Username: </td>
                            <td>admin</td>
                            <td style="padding-left: 15px;">Username: </td>
                            <td>teacher</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 15px;">Password: </td>
                            <td>admin</td>
                            <td style="padding-left: 15px;">Password: </td>
                            <td>teacher</td>
                        </tr>
                    </table>

                </td>
            </tr>
            <tr>
                <td colspan="2" class="error" style="<?=$message == '' ? 'display:none;' : ''?>">
                    <?php if ($message != ''): ?>
                        <?=$message?>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Username: </td>
                <td><input class="login" id="username" type="text" name="username" /></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td><input class="login" type="password" name="password" /></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input class="button" type="submit" value="Login" /></td>
            </tr>
        </table>
    </form>
</div>
<?php

require_once('footer.php');
require_once('app_bottom.php');