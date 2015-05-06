<?php

$location_id = get_post('location_id');

$locations = db_query('select * from music_location order by name');

if ($location_id == '')
{

   $location_id = $locations[0]->pk_location_id;
}
?>

<select id="which_location" name="which_location" onChange="load_location_schedule()">
   <?php foreach ($locations as $location): ?>
   <option value="<?=$location->pk_location_id?>" <?=$location->pk_location_id == $location_id ? 'checked="checked"' : ''?>>
      <?=$location->name?>
   </option>
   <?php endforeach; ?>
</select>

<div id="location_schedule">
   <?php require_once('location_schedule.php'); ?>
</div>