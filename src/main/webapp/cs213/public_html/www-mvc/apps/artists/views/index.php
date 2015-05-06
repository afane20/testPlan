<h1>Artists Home</h1>
<a href="<?= $web_root ?>/artists/create">new</a>
<table>
   <tr>
      <th>Name</th>
      <th></th>
      <th></th>
   </tr>
   <?php foreach ($artists as $row): ?>
      <tr>
         <td><?= $row['name'] ?></td>
         <td><a href="<?= $web_root ?>/artists/edit/id/<?= $row['id'] ?>">edit</a></td>
         <td><a href="<?= $web_root ?>/artists/delete/id/<?= $row['id'] ?>">delete</a></td>
      </tr>
   <?php endforeach ?>
</table>
