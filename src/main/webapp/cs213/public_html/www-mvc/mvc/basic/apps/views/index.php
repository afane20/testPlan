<h1><MODEL_CLASS_NAME> Home</h1>
<a href="<?= $web_root ?>/<CLASS_NAME>/create">new</a>
<table>
   <tr>
<ROW_HEADERS>
      <th></th>
      <th></th>
   </tr>
   <?php foreach ($<CLASS_NAME> as $row): ?>
      <tr>
<ROW_VALUES>
         <td><a href="<?= $web_root ?>/<CLASS_NAME>/edit/id/<?= $row['id'] ?>">edit</a></td>
         <td><a href="<?= $web_root ?>/<CLASS_NAME>/delete/id/<?= $row['id'] ?>">delete</a></td>
      </tr>
   <?php endforeach ?>
</table>
