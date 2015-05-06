<?php

require_once('app_top.php');

$user = validate_user(TRUE);
$festival = db_query('select * from music_festival', 1);

$error = '';

if (is_form_submitted())
{
    $today = date('Y-m-d');

    $start = date('Y-m-d', strtotime(get_post('start')));
    $end = date('Y-m-d', strtotime(get_post('end')));

    if (get_post('start') == '' || get_post('end') == '')
    {
        $error = 'You must enter a date for the beginning and the end';
    }
    else if ($start < $today || $end < $today)
    {
        $error = 'The start date and the end date must be in the future';
    }
    else if ($end < $start)
    {
        $error = 'The end cannot be before the beginning';
    }

    if ($error == '')
    {
        db_query('update music_festival set date_start = "'.$start.'", date_end = "'.$end.'"');
        echo "success;The festival was updated";
    }
    else
    {
        echo "error;$error";
    }
}
else
{

?>

<h2>Change Dates</h2>
<div align="center">
<form name="edit_festival" action="javascript:submit_ajax_form('edit_festival.php', ['start', 'end'], load_festivals)" method="post">
<table>
    <tr>
        <td colspan="2"><div id="form_errors" class="error" style="display: none;"><?=$error?></div></td>
    </tr>
    <tr>
        <td>Starting Date:</td>
        <td><input name="start" id="start" class="datepicker" value="<?=get_post('start') != '' ? get_post('start') : date('m/d/Y', strtotime($festival->date_start)) ?>"/> </td>
    </tr>
    <tr>
        <td>Ending Date:</td>
        <td><input name="end" id="end" class="datepicker" value="<?=get_post('end') != '' ? get_post('end') : date('m/d/Y', strtotime($festival->date_end)) ?>"/> </td>
    </tr>
</table>
</form>
</div>
<?php

}

require_once('app_bottom.php');