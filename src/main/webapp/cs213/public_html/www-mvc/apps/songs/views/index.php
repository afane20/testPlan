<h1>Songs Home</h1>
<a href="<?= $web_root ?>/songs/create">new</a>
<table>
   <tr>
      <th>Name</th>
      <th>Artist</th>
      <th></th>
      <th></th>
   </tr>
   <?php foreach ($songs as $song): ?>
      <tr>
         <td><?= $song['name'] ?></td>
         <td><?= $song['artist'] ?></td>
         <td><a href="<?= $web_root ?>/songs/edit/id/<?= $song['id'] ?>">edit</a></td>
         <td><a href="<?= $web_root ?>/songs/delete/id/<?= $song['id'] ?>">delete</a></td>
      </tr>
   <?php endforeach ?>
</table>
