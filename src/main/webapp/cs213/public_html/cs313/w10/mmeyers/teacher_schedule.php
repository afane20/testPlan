<?php

$user = validate_user();

$scheduled_people = db_query("select ms.*, ml.name, mlt.date, mlt.time, mp.pk_performance_id from music_student ms left join music_student_performance msp on msp.fk_student_id = ms.pk_student_id left join music_performance mp on msp.fk_performance_id = mp.pk_performance_id left join music_location_time mlt on mp.fk_location_time_id = mlt.pk_location_time_id left join music_location ml on mlt.fk_location_id = ml.pk_location_id  where fk_teacher_id = ".$user->pk_teacher_id." order by ms.first_name, ms.last_name");

?>

<table>
   <tr>
      <th>Name</th>
      <th>Location</th>
      <th>Date</th>
      <th>Time</th>
   </tr>
<?php foreach ($scheduled_people as $row): ?>
   <tr>
      <td><?=$row->first_name?> <?= $row->last_name?></td>
      <?php if ($row->pk_performance_id == ''): ?>
      <td colspan="3"></td>
      <?php else: ?>
      <td><?=$row->name?></td>
      <td><?=date('M j, Y', strtotime($row->date))?></td>
      <td><?=$row->time?></td>
      <?php endif; ?>
      <td>
         <?php if ($row->pk_performance_id == ''): ?>
            <a class="button" href="javascript:register_student(<?=$row->pk_student_id?>)">Register Student</a>
         <?php else: ?>
            <a class="button" href="javascript:unregister(<?=$row->pk_performance_id?>)">Unregister</a>
         <?php endif; ?>
      </td>
   </tr>
<?php endforeach; ?>
</table>