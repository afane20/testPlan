<?php
$teachers = db_query('select t.pk_teacher_id, t.first_name, t.last_name, tp.pk_teacher_payment_id from music_teacher t left join music_teacher_payment tp on tp.fk_teacher_id = t.pk_teacher_id');
?>
<table class="list">
<?php foreach ($teachers as $teacher): ?>
    <tr>
        <td><?=$teacher->first_name?></td>
        <td><?=$teacher->last_name?></td>
        <td><input type="checkbox" onclick="toggle_paid_dues(<?=$teacher->pk_teacher_id?>)" <?=$teacher->pk_teacher_payment_id != '' ? 'checked' : ''?>/> Paid Dues</td>
    </tr>
<?php endforeach; ?>
    <tr>
        <td><a class="button" href="javascript:show_add_teacher()">Add Teacher</a></td>
    </tr>
</table>