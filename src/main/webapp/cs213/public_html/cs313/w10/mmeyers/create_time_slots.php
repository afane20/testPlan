<?php

require_once('app_top.php');

$user = validate_user(TRUE);

$error = '';

$fields = array('location_id', 'date', 'start_time', 'end_time', 'slot_length');

$location_id = get_get_var('location_id');

if ($location_id == '')
   $location_id = get_post('location_id');


$location = db_query('select * from music_location where pk_location_id = '.$location_id, 1);

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
    else
    {
       if (get_post('start_time') >= get_post('end_time'))
       {
         $error = 'The end time must be after the beginning time.';
       }
    }

    if ($error == '')
    {
       $length = get_post('slot_length') / 60; 
       $current = get_post('start_time');
       $end = get_post('end_time');
       $date = get_post('date');
       $num = 0;
       while ($current < $end && $num < 100)
       {
         $hour = (int)$current;
         $minutes = ($current - $hour) * 60;
         db_query('insert into music_location_time values (null, "'.date('Y-m-d', strtotime($date)).'", "'.$hour.':'.$minutes.':00", '.$location_id.')');
         $current += $length;
         $num++;
       }
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
<h2>Add Time Slots</h2>
<p>Location: <?=$location->name?></p>

<form name="add_time_slot" action="javascript:submit_ajax_form('create_time_slots.php', <?= javascript_array($fields)?>, load_location_schedule)" method="post">
<input type="hidden" name="location_id" id="location_id" value="<?=$location_id?>" />

<table>
    <tr>
        <td colspan="2"><div id="form_errors" class="error" style="display: none;"><?=$error?></div></td>
    </tr>
    <tr>
        <td>Date:</td>
        <td>
            <?=festival_date_select()?>
        </td>
    </tr>
    <tr>
        <td>Start Time:</td>
        <td><?=get_time_dropdown('start_time')?></td>
    </tr>
    <tr>
        <td>End Time:</td>
        <td><?=get_time_dropdown('end_time')?></td>
    </tr>
    <tr>
        <td>Length for each time slot (minutes):</td>
        <td><input type="text" id="slot_length" name="slot_length" value="" /></td>
    </tr>
</table>
</form>
</div>

<?php

}
require_once('app_bottom.php');

function get_time_dropdown($name)
{
   $start = 6;
   $end = 24;
   
   $string = '<select id="'.$name.'" name="'.$name.'">';
   while ($start < $end)
   {
      $string .= '<option value="'.$start.'">'.($start % 12 == 0 ? 12 : $start % 12).':00 '.($start > 11 ? 'PM' : 'AM').'</option>';
      $start++;
   }
   $string .= '</select>';
   return $string;
}

