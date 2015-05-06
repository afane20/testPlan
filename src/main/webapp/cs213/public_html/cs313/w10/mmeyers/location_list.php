<?php
$locations = db_query('select * from music_location');
?>
<table class="list">
    <tr>
        <th></th>
        <th>Location Name</th>
        <th>Judge Level</th>
        <th>Judge Type</th>
        <th># of Pianos</th>
    </tr>
<?php foreach ($locations as $location): ?>
    <tr>
        <td><a href="javascript:remove_location(<?=$location->pk_location_id?>)" class="button">Remove</a></td>
        <td><?=$location->name?></td>
        <td><?=$location->judge_level?></td>
        <td><?=$location->judge_type?></td>
        <td><?=$location->num_pianos?></td>
    </tr>
<?php endforeach; ?>
    <tr>
        <td><a class="button" href="javascript:show_add_location()">Add Location</a></td>
    </tr>
</table>

<br><br>
After you add a location, you must refresh for it to show up in the registration.