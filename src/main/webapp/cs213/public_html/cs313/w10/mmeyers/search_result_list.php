
<table class="list">
<?php foreach ($students as $student): ?>
   <tr>
      <td><?=$student->first_name?></td>
      <td><?=$student->last_name?></td>
      <td><a class="button" href="javascript:select_student(<?=$student->pk_student_id?>, <?=$location_time_id?>)">Register</a></td>
   </tr>
<?php endforeach; ?>
</table>