<?php
$user = validate_user();
$students = db_query('select * from music_student where fk_teacher_id = '.$user->pk_teacher_id);
?>
<table class="list">
    <tr>
        <th></th>
        <th>First Name</th>
        <th>Last Name</th>
    </tr>
<?php if ($students === FALSE): ?>
    <tr>
        <td colspan="3">Click Add Student below to add a student.</td>
    </tr>
<?php else: ?>
<?php foreach ($students as $student): ?>
   <tr>
      <td><a class="button" href="javascript:remove_student(<?=$student->pk_student_id?>)">Remove</a></td>
      <td><?=$student->first_name?></td>
      <td><?=$student->last_name?></td>
   </tr>
<?php endforeach; ?>
<?php endif; ?>
</table>