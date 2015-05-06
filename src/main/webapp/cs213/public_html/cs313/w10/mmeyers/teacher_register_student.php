<?php

require_once('app_top.php');

$user = validate_user(TRUE);

$error = '';

$fields = array('performance_type', 'skill_level', 'instrument', 'date', 'location_time_id', 'student_id');

if (is_form_submitted())
{
    $complete = true;
    foreach ($fields as $field)
    {
        if (get_post($field) == '')
            $complete = false;
    }

    if (!$complete)
        $error = 'Please fill in every field.';

    if ($error == '')
    {
      db_query('insert into music_performance values (null, '.get_post('location_time_id').', "'.get_post('performance_type').'")');
      $performance_id = mysql_insert_id();
      db_query('insert into music_student_performance values (null, '.$performance_id.', '.get_post('student_id').', "'.get_post('instrument').'")');

      echo 'success;The student was registered.';
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
<h2>Register</h2>
<form name="register_student" action="javascript:submit_ajax_form('teacher_register_student.php', <?= javascript_array($fields)?>, function() { load_schedule() })" method="post">
<input type="hidden" name="location_time_id" id="location_time_id" value="">
<input type="hidden" name="student_id" id="student_id" value="<?=get_get_var('student_id')?>">
<table>
    <tr>
        <td colspan="2"><div id="form_errors" class="error" style="display: none;"><?=$error?></div></td>
    </tr>
    <tr>
        <td>Performance Type:</td>
        <td><?=get_dropdown('performance_type', 'performance_type')?></td>
    </tr>
    <tr>
        <td>Skill Level:</td>
        <td>
            <?=get_dropdown('skill_level', 'judge_level')?>
        </td>
    </tr>
    <tr>
        <td>Instrument:</td>
        <td>
            <?=get_dropdown('instrument', 'instruments')?>
        </td>
    </tr>
    <tr>
        <td>Date</td>
        <td><?=festival_date_select()?></td>
    </tr>
    <tr>
        <td colspan="2" align="center"><a class="button" href="javascript:search_times()">Search Times</td>
    </tr>
    <tr>
        <td colspan="2">
           <div id="possible_times"></div>
        </td>
    </tr>
   
</table>
</form>
</div>

<?php

}
require_once('app_bottom.php');

