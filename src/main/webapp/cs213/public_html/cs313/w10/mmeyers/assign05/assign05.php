<?php

$conn = mysql_connect('jordan', 'mmeyers3', '');

if (!$conn)
   die('Sorry, I could not connect to the database');

if (!mysql_select_db('mmeyers3', $conn))
{
   die('Could not connect to the database.');
}
$action = isset($_POST['action']) ? $_POST['action'] : '';

switch ($action)
{
   case 'select':
      get_data();
      break;
   case 'update':
      update_field($_POST['field'], $_POST['student_id'], $_POST['value']);
      break; 
   case 'get_options':
      get_options($_POST['field']);
      break;
   case 'delete':
      delete_student($_POST['student_id']);
      break;
   case 'add':
      add_student();

}

function get_options($field)
{
   $query = '';
   
   if ($field == 'gender')
      $query = 'select "Male" as value, "Male" as label union select "Female" as value, "Female" as label';
   else if ($field == 'major')
      $query = 'select pk_major_id as value, name as label from major';
   
   $result = mysql_query($query);
   if (!$result)
   {
      die('There was an error in the query: '.mysql_error());
   }
   
   $count = 0;
   while ($row = mysql_fetch_assoc($result)) 
   {
      echo ($count++ > 0 ? ',' : '').$row['value'].'=>'.$row['label'];
   }
}

function add_student()
{
   $query = 'insert into student ( i_number, first_name, last_name, birthday, gender, city, state, fk_major_id)
      values (0, "", "", "1970-01-01", "", "", "", (select pk_major_id from major limit 1))';
   if (!mysql_query($query))
      die("Error");
   else
      echo mysql_insert_id();
}

function delete_student($student_id)
{
   echo $student_id;
   mysql_query('delete from student_class where fk_student_id = '.$student_id);
   mysql_query('delete from student where pk_student_id = '.$student_id);
}

function update_field($field, $student_id, $value)
{
   if ($field == 'birthday')
   {
      $timestamp = strtotime($value);
      if (!$timestamp)
         die('Please enter a valid date');
      $value = date('Y-m-d', $timestamp);
   }
   else if ($field == 'major')
   {
      $field = 'fk_major_id';
   }
   
   $query = 'update student set '.$field.' = "'.$value.'" where pk_student_id = '.$student_id;
   
   if (mysql_query($query))
   {
      if ($field == 'fk_major_id')
      {
         $query = 'select name from major where pk_major_id = '.$value;
         $result = mysql_query($query);
         $row = mysql_fetch_assoc($result);
         $value = $row['name'];
      }
      echo $value;
   }
   else
   {
      echo 'Error.  Try again.';
   }
}

function get_data()
{

   print "Get_data";
   $numPerPage = 10;
   $page = isset($_POST['page']) ? $_POST['page'] : 0;

   $result = mysql_query('select count(*) as count from student');
   if (!$result)
   {
      die('I had an error');
   }
   $row = mysql_fetch_assoc($result);
   $numRecords = $row['count'];

   $result = mysql_query(
      'select s.pk_student_id as id, s.i_number, s.first_name, s.last_name, s.birthday, s.gender, s.city, s.state, m.name as major 
       from student s join major m on s.fk_major_id = m.pk_major_id order by s.last_name, s.first_name
       limit '.($page*$numPerPage).', '.$numPerPage);
   
   if (!$result)
   {
      echo 'Oops!  There\'s an error in the SQL.  Here\'s the message:<br>';
      echo mysql_error();
   }
   else
   {
      echo '<table id="students" class="results">';
      
      $i = 0;
      $num_cols = mysql_num_fields($result);
      $col_names = array();
      $num_rows = mysql_num_rows($result);
      echo '<tr><th></th>';
      while ($i < $num_cols) 
      {
         $meta = mysql_fetch_field($result, $i++);
         echo '<th>'.$meta->name.'</th>';
         $col_names[] = $meta->name;
      }
      echo '</tr>';
      
      while ($row = mysql_fetch_assoc($result)) 
      {
         echo '<tr id="student_'.$row['id'].'">';
         $i = 0;
         echo '<td><img src="delete.gif" onclick="delete_student('.$row['id'].')" /></td>';
         foreach ($row as $col)
         {
            echo '<td><div class="'.$col_names[$i].'" id="'.$col_names[$i].'_'.$row['id'].'">'.($col == '' ? 'Missing info' : $col).'</div></td>';
            $i++;
         }
         echo '</tr>';
      }
      if ($page > 0 || ($page * $numPerPage + $num_rows) < $numRecords)
      {
         echo '<tr>
                  <td colspan="'.($num_cols+1).'" align="right">';

         if ($page > 0)
         {
             echo '<a href="javascript:get_data('.($page-1).')" style="padding-right: 20px;">Previous</a>';
         }
         if (($page * $numPerPage + $num_rows) < $numRecords)
         {
             echo '<a href="javascript:get_data('.($page+1).')">Next</a>';
         }

         echo '   </td>
               </tr>';

      }

      echo '</table>';
   }
}

mysql_close($conn);