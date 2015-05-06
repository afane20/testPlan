<?php

require_once('app_top.php');

$user = validate_user();

$error = '';
$fields = array('first_name', 'last_name');

if (is_form_submitted())
{
    if (get_post('first_name') == '' || get_post('last_name') == '')
    {
        $error = 'Please fill in every field';
    }

    if ($error == '')
    {
        db_query('insert into music_student values (null, "'.get_post('first_name').'", "'.get_post('last_name').'", '.$user->pk_teacher_id.')');
        echo 'success;The student was added';
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
<h2>Add a student</h2>
<form name="add_student" action="javascript:submit_ajax_form('add_student.php', <?= javascript_array($fields)?>, function() { load_students(); load_schedule();})" method="post">
<table>
    <tr>
        <td colspan="2" id="form_errors" class="error" style="display: none;"><?=$error?></td>
    <tr>
        <td>First Name:</td>
        <td><input type="text" id="first_name" name="first_name" value=""/></td>
    </tr>
    <tr>
        <td>Last Name:</td>
        <td><input type="text" id="last_name" name="last_name" value=""/> </td>
    </tr>
</table>
</form>
</div>
<?php
}

require_once('app_bottom.php');