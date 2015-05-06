<?php
$festivals = db_query('select * from music_festival order by date_start');
?>

<table class="list">
    <tr>
        <th></th>
        <th>Start</th>
        <th>End</th>
    </tr>
<?php foreach ($festivals as $festival): ?>
    <tr>
        <td><a class="button" href="javascript:edit_festival()">Change Dates</a></td>
        <td><?=date('M j, Y', strtotime($festival->date_start))?></td>
        <td><?=date('M j, Y', strtotime($festival->date_end))?></td>
    </tr>
<?php endforeach; ?>
</table>