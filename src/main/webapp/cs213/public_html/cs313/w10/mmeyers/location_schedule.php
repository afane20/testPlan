<?php
$schedule = db_query('select * from music_location_time mlt left join music_performance mp on mp.fk_location_time_id = mlt.pk_location_time_id where mlt.fk_location_id = '.$location_id.' order by mlt.date, mlt.time asc');
?>

<table class="list">
   <tr>
      <th></th>
      <th>Date</th>
      <th>Time</th>
      <th>Student</th>
   </tr>
<?php if ($schedule === FALSE): ?>
   <tr>
      <td colspan="4">There are not slots assigned for this location.</td>
   </tr>
<?php else: ?>
<?php foreach ($schedule as $time): ?>
   <tr>
      <td><a class="button" href="javascript:remove_slot()">Remove Slot</a></td>
      <td><?=date('M j, Y', strtotime($time->date))?></td>
      <td><?=$time->time?></td>
      <td>
         <?php if ($time->pk_performance_id != ''): ?>
            <?php $students = db_query('select * from music_student_performance msp join music_student ms on msp.fk_student_id = ms.pk_student_id where msp.fk_performance_id = '.$time->pk_performance_id);
                  $i = 0;
            ?>
            <?php foreach ($students as $student): ?>
               <?= $i++ == 0 ? '' : ', '?>
               <?=$student->first_name?> <?=$student->last_name?>
            <?php endforeach; ?>
            <a class="button" href="javascript:unregister(<?=$time->pk_performance_id?>)">Unregister</a>
         <?php endif; ?>
      </td>
   </tr>
<?php endforeach; ?>
<?php endif; ?>
</table>

<a class="button" href="javascript:create_slots(<?=$location_id?>)">Create Time Slots</a>
<a class="button" href="javascript:clear_location_times()">Clear Times</a>