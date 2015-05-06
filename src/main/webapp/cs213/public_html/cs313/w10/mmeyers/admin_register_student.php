<?php

require_once('app_top.php');

$user = validate_user(TRUE);

$error = '';

$location_time_id = get_get_var('location_time_id');

if ($location_time_id == '')
   $location_time_id = get_post('location_time_id');


$location = db_query(
   'select * from music_location_time mlt join music_location ml on mlt.fk_location_id = ml.pk_location_id 
      where mlt.pk_location_time_id = '.$location_time_id, 1);

if (is_form_submitted())
{
    if ($error == '')
    {
        echo 'success;The time slots were added.';
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
<h2>Register a Student</h2>
<p>
   Location: <?=$location->name?><br/>
   Date: <?=date('M j, Y', strtotime($location->date))?><br/>
   Time: <?=$location->time?>
</p>

<form name="add_time_slot" action="javascript:search_students(<?=$location_time_id?>)" method="post">
<input type="hidden" name="location_id" id="location_id" value="<?=$location_id?>" />

<table>
    <tr>
        <td colspan="2"><div id="form_errors" class="error" style="display: none;"><?=$error?></div></td>
    </tr>
    <tr>
        <td>Search for a student:</td>
        <td><input type="text" id="search_student" /><input type="submit" value="Search" /></td>
    </tr>
    <tr>
        <td colspan="2">
         <div id="student_seach_result"></div>
        </td>
    </tr>
</table>
</form>
</div>

<?php

}
require_once('app_bottom.php');

