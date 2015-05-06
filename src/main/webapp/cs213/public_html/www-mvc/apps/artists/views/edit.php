<h1><?= (isset($artists) ? "Editing" : "New") ?> Artists</h1>
<form method="get" action="<?= $web_root ?>/artists/<?= (isset($artists) ? "update" : "insert") ?>">
<table>
   <tr>
      <td>Name</td>
      <td><input type="text" name="name" value="<?= (isset($artists) ? $artists['name'] : "") ?>" /></td>
   </tr>
   <tr>
      <td colspan="2"><input type="submit" /></td>
      <?php if (isset($artists)): ?>
         <input type="hidden" name="id" value="<?= $artists['id'] ?>" />
      <?php endif ?>
   </tr>
</table>
</form>
<a href="<?= $web_root ?>/artists">Back to list</a>
