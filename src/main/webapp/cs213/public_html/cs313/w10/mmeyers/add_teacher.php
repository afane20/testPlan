<?php

require_once('app_top.php');

$user = validate_user(TRUE);

$error = '';

if (is_form_submitted())
{
    if (get_post('first_name') == '' || get_post('last_name') == ''
            || get_post('username') == '' || get_post('password') == '')
    {
        $error = 'Please fill in every field';
    }
    else if (is_object(db_query('select username from music_teacher where username = "'.get_post('username').'"', 1)))
    {
        $error = 'This username is already taken';
    }

    if ($error == '')
    {
        $password = md5(get_post('password'));
        db_query('insert into music_teacher values (null, "'.get_post('first_name').'", "'.get_post('last_name').'", "'.get_post('username').'", "'.get_post('password').'", 0)');
        echo 'success;'.get_post('first_name').' '.get_post('last_name').' was added.';
    }
    else
    {
        echo 'error;'.$error;
    }
}
else
{
?>
<div align="center">
<h2>Add a teacher</h2>
<form name="add_teacher" action="javascript:submit_ajax_form('add_teacher.php', ['first_name', 'last_name', 'username', 'password'], load_teachers)" method="post">

<table>
    <tr>
        <td colspan="2"><div id="form_errors" class="error" style="display: none;"><?=$error?></div></td>
    </tr>
    <tr>
        <td>First Name:</td>
        <td><input type="text" id="first_name" name="first_name" value="<?=get_post('first_name')?>"/></td>
    </tr>
    <tr>
        <td>Last Name:</td>
        <td><input type="text" id="last_name" name="last_name" value="<?=get_post('last_name')?>"/> </td>
    </tr>
    <tr>
        <td>Username:</td>
        <td><input type="text" id="username" name="username" value="<?=get_post('username')?>"/></td>
    </tr>
    <tr>
        <td>Default Password:</td>
        <td><input type="text" id="password" name="password" value="<?=get_post('password')?>"/></td>
    </tr>
</table>
</form>
</div>

<?php

}
require_once('app_bottom.php');