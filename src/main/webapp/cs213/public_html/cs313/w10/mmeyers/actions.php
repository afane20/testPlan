<?php

require_once('app_top.php');

$user = validate_user();

$action = get_post('action');
if ($action == '')
    $action = get_get_var('action');
    
$action();

function load_students()
{
    require_once('student_list.php');
}

function load_festivals()
{
    require_once ('festival_list.php');
}

function load_teachers()
{
    require_once ('teacher_list.php');
}

function load_locations()
{
    require_once('location_list.php');
}

function load_location_schedule()
{
   $location_id = get_post('location_id');
   require_once('location_schedule.php');
}

function toggle_paid_dues()
{
    $teacher_id = get_post('teacher_id');

    $result = db_query('select count(*) as count from music_teacher_payment where fk_teacher_id = '.$teacher_id, 1);

    if ($result->count == 0)
    {
        // insert a row
        db_query('insert into music_teacher_payment values (null, '.$teacher_id.')');
    }
    else
    {
        // delete the row
        db_query('delete from music_teacher_payment where fk_teacher_id = '.$teacher_id);
    }
}

function remove_location()
{
   db_query("delete from music_location_time where fk_location_id = ".get_post("location_id"));
   db_query("delete from music_location where pk_location_id = ".get_post("location_id"));
}

function remove_student()
{
   db_query("delete from music_student where pk_student_id = ".get_post("student_id"));
}

function remove_location_time()
{
   db_query("delete from music_location_time where pk_location_time_id = ".get_post("location_time_id"));
}

function clear_location_times()
{
   db_query("delete from music_location_time where fk_location_id = ".get_post("location_id"));
}

function search_students()
{
   $term = get_post('name');
   $location_time_id = get_post('location_time_id');
   $students = db_query("SELECT music_student.*, MATCH(first_name, last_name) AGAINST('$term') as relevance 
                        FROM music_student WHERE MATCH(first_name, last_name) AGAINST('$term') order by relevance");
   
   require_once('search_result_list.php');
}

function register_student()
{
   $student_id = get_post("student_id");
   db_query("insert into music_performance values (null, ".get_post("location_time_id").", \"Solo\")");
   $performance_id = mysql_insert_id();
   db_query("insert into music_student_performance values (null, $performance_id, $student_id, \"Piano\")");
}

function unregister()
{
   $performance_id = get_post('performance_id');
   db_query("delete from music_student_performance where fk_performance_id = $performance_id");
   db_query("delete from music_performance where pk_performance_id = $performance_id");
}

function load_teacher_schedule()
{
   require_once("teacher_schedule.php");
}

function search_times()
{
   $performance_type = get_post("performance_type");
   $skill_level = get_post("skill_level");
   $instrument = get_post("instrument");
   $date = date('Y-m-d', strtotime(get_post("date")));

   $num_pianos;
   if ($performance_type == "Solo")
      $num_pianos = 1;
   else if ($performance_type == "Duet")
      $num_pianos = 2;

   $qry = 'select * from music_location_time mlt 
      join music_location ml on mlt.fk_location_id = ml.pk_location_id 
      where mlt.date = "'.$date.'" and ml.judge_level = "'.$skill_level.'" 
            and ml.judge_type = "'.$instrument.'" and ml.num_pianos >= '.$num_pianos;

   $times = db_query($qry);

   ?>
   <table class="list">
   <?php foreach ($times as $time): ?>
      <tr>
         <td><input type="radio" id="" name="" value="<?=$time->pk_location_time_id?>" onchange="select_time(<?=$time->pk_location_time_id?>)"/></td>
         <td><?=$time->name?></td>
         <td><?=$time->time?></td>
      </tr>
   <?php endforeach; ?>
   </table>
   <?php
   
}