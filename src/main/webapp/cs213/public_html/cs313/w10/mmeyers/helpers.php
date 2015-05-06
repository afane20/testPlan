<?php

function db_query($query, $limit = 0)
{
    $result = mysql_query($query);

    if (!$result)
    {
        die('There was an error in the query: '.mysql_error());
    }

    if (mysql_num_rows($result) == 0)
    {
        return FALSE;
    }

    if ($limit == 1)
    {
        return mysql_fetch_object($result);
    }
    else
    {
        $rows = array();
        $count = 0;
        while ($row = mysql_fetch_object($result))
        {
            $rows[] = $row;
            if (++$count == $limit)
            {
                return $rows;
            }
        }
	    return $rows;
    }
}

function get_post($var)
{
    if (isset($_POST[$var]))
        return $_POST[$var];
    else
        return '';
}

function get_get_var($var)
{
    if (isset($_GET[$var]))
        return $_GET[$var];
    else
        return '';
}

function get_session($var)
{
    if (isset($_SESSION[$var]))
        return $_SESSION[$var];
    else
        return '';
}

function validate_user($admin = false)
{
    $user = get_session('user');

    if (!is_object($user) || $user->pk_teacher_id == '')
    {
        header("location: assign10.php?message=not_logged_in");
    }
    else
    {
        $authorized = TRUE;

        if ($admin == TRUE)
        {
            $authorized = $user->is_admin == 1;
        }

        if (!$authorized)
        {
            header("location: assign10.php?message=unauthorized");
        }
        else
        {
            return $user;
        }
    }
}

function login($username, $password)
{
    $user = db_query('select pk_teacher_id, concat(first_name, " ", last_name) as name, username, is_admin from music_teacher where username = "'.$username.'" and password="'.md5($password).'"', 1);
    if ($user === FALSE)
        return FALSE;
    else
    {
        $_SESSION['user'] = $user;
        if ($user->is_admin)
        {
            header("location: admin_home.php");
        }
        else
        {
            header("location: teacher_home.php");
        }
    }
}

function is_form_submitted()
{
    return count($_POST) > 0;
}

function logout()
{
    session_destroy();
    header("location: assign10.php");
}

function javascript_array($array)
{
    $string = "[";

    for ($i = 0; $i < count($array); $i++)
    {
        if ($i > 0)
            $string .= ',';
        $string .= "'".$array[$i]."'";
    }
    $string .= "]";
    return $string;
}

function common_lookup($category)
{
   $rows = db_query("select * from music_common_lookup where category = '$category'");
   return $rows;
}

function get_dropdown($name, $category)
{
   $string = '<select id="'.$name.'" name="'.$name.'">';
   $options = common_lookup($category);
   foreach ($options as $option)
   {
      $string .= '<option value="'.$option->value.'" '.(get_post($category) == $option->value ? 'checked' : '').'>'.$option->value.'</option>';
   }
   
   $string .= '</select>';
   return $string;
}

function festival_date_select()
{
   $string .= '<select name="date" id="date">';

   $festival = db_query('select * from music_festival', 1);

   $start = mktime(0, 0, 0, 
      date("m", strtotime($festival->date_start)),
      date("d", strtotime($festival->date_start)),
      date("y", strtotime($festival->date_start)));

   $end = mktime(0, 0, 0, 
      date("m", strtotime($festival->date_end)),
      date("d", strtotime($festival->date_end)),
      date("y", strtotime($festival->date_end)));

   while ($start != $end)
   {
      $string .= '<option value="'.date('M j, Y', $start).'">'.date('M j, Y', $start).'</option>';
      $start = mktime(0, 0, 0, 
         date("m", $start),
         date("d", $start)+1,
         date("y", $start));
   }
   $string .= '</select>';
   
   return $string;
}


