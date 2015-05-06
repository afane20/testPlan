<h1><?= (isset($<CLASS_NAME>) ? "Editing" : "New") ?> <MODEL_CLASS_NAME></h1>
<form method="get" action="<?= $web_root ?>/<CLASS_NAME>/<?= (isset($<CLASS_NAME>) ? "update" : "insert") ?>">
<table>
<FIELD_ROWS>
   <tr>
      <td colspan="2"><input type="submit" /></td>
      <?php if (isset($<CLASS_NAME>)): ?>
         <input type="hidden" name="id" value="<?= $<CLASS_NAME>['id'] ?>" />
      <?php endif ?>
   </tr>
</table>
</form>
<a href="<?= $web_root ?>/<CLASS_NAME>">Back to list</a>
