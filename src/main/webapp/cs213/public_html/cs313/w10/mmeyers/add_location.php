<?php

require_once('app_top.php');

$user = validate_user(TRUE);

$error = '';

$fields = array('name', 'judge_level', 'judge_type', 'num_pianos');

if (is_form_submitted())
{
    $complete = true;
    foreach ($fields as $field)
    {
        if (get_post($field) == '')
            $complete = false;
    }

    if (!$complete)
        $error = 'Please fill in every field.';

    if ($error == '')
    {
        $qry_string = 'insert into music_location values (null, ';

        for ($i = 0; $i < count($fields); $i++)
        {
            if ($i > 0)
                $qry_string .= ', ';
            $qry_string .= '"'.get_post($fields[$i]).'"';
        }

        $qry_string .= ')';

        db_query($qry_string);
        echo 'success;'.get_post('name').' was added.';
    }
    else
    {
        echo 'error;'.$error;
    }
}
else
{
?>
<div align="center">
<h2>Add a location</h2>
<form name="add_location" action="javascript:submit_ajax_form('add_location.php', <?= javascript_array($fields)?>, function(){ load_locations(); load_location_schedule(); })" method="post">

<table>
    <tr>
        <td colspan="2"><div id="form_errors" class="error" style="display: none;"><?=$error?></div></td>
    </tr>
    <tr>
        <td>Location Name:</td>
        <td><input type="text" id="name" name="name" value="<?=get_post('name')?>"/></td>
    </tr>
    <tr>
        <td>Judge Level:</td>
        <td>
            <?=get_dropdown('judge_level', 'judge_level')?>
        </td>
        
    </tr>
    <tr>
        <td>Judge Type:</td>
        <td>
            <?=get_dropdown('judge_type', 'judge_type')?>
        </td>
    </tr>
    <tr>
        <td>Number of Pianos:</td>
        <td><input type="text" id="num_pianos" name="num_pianos" value="<?=get_post('num_pianos')?>"/></td>
    </tr>
</table>
</form>
</div>

<?php

}
require_once('app_bottom.php');