<h1><?= (isset($song) ? "Editing" : "New") ?> Song</h1>
<form method="get" action="<?= $web_root ?>/songs/<?= (isset($song) ? "update" : "insert") ?>">
<table>
   <tr>
      <td>Name</td>
      <td><input type="text" name="name" value="<?= (isset($song) ? $song['name'] : "") ?>" /></td>
   </tr>
   <tr>
      <td>Artist</td>
      <td>
         <select name="artist_id">
         <option value=""></option>
         <?php foreach ($artists as $artist): ?>
            <?php $selected = ((isset($song) && $song['artist_id'] == $artist['id']) ? 'selected="selected"' : "") ?>
            <option value="<?= $artist['id'] ?>" <?= $selected ?>><?= $artist['name'] ?></option>
         <?php endforeach ?>
         </select>
      </td>
   </tr>
   <tr>
      <td>Notes</td>
      <td><textarea name="notes"><?= (isset($song) ? $song['notes'] : "") ?></textarea></td>
   </tr>
   <tr>
      <td colspan="2"><input type="submit" /></td>
      <?php if (isset($song)): ?>
         <input type="hidden" name="id" value="<?= $song['id'] ?>" />
      <?php endif ?>
   </tr>
</table>
</form>
<a href="<?= $web_root ?>/songs">Back to list</a>
