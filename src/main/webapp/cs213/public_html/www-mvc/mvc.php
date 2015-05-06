#!/usr/bin/php
<?php
if (count($argv) < 2) {
   die ("Usage: mvc.php table_name\n");
}

require("mvc/MysqlConnection.php");
require("mvc/config.php");
$db = new MysqlConnection($db_host, $db_user, $db_pass, $database);

$class = strtolower($argv[1]);
$table = strtolower($argv[1]);
$model = ucwords($class);

$replace['CLASS_NAME'] = $class;
$replace['COMMA_SEP_FIELDS'] = '';
$replace['COMMA_SEP_SET_FIELDS'] = '';
$replace['DEFAULT_DOLLAR_PARAM'] = '';
$replace['FIELD_NAME'] = '';
$replace['FIELD_NAME_NICE'] = '';
$replace['FIELD_ROWS'] = '';
$replace['MODEL_CLASS_NAME'] = $model;
$replace['PHP_ARRAY_PARAM_REQUEST'] = '$params = array(';
$replace['PHP_ARRAY_PARAM_REQUEST_W_ID'] = '$params = array(';
$replace['ROW_HEADERS'] = '';
$replace['ROW_VALUES'] = '';
$replace['TABLE_NAME'] = $class;

mkdir("apps/$class") or die("directory already exists");
mkdir("apps/$class/views");

$model_template = file_get_contents(dirname(__FILE__) . "/mvc/basic/model/basic.php");
$control_template = file_get_contents(dirname(__FILE__) . "/mvc/basic/apps/basic.php");
$index_template = file_get_contents(dirname(__FILE__) . "/mvc/basic/apps/views/index.php");
$edit_template = file_get_contents(dirname(__FILE__) . "/mvc/basic/apps/views/edit.php");

$char_template = file_get_contents(dirname(__FILE__) . "/mvc/basic/apps/views/input_text.php");
$text_template = file_get_contents(dirname(__FILE__) . "/mvc/basic/apps/views/textarea.php");

$table_desc = $db->desc($table);
$i = 0;
foreach ($table_desc as $sql_field) {
   ++$i;
   $field_name = $sql_field['Field'];
   $field_name_nice = ucwords(str_replace("_", " ", $field_name));
   $field_type = $sql_field['Type'];

   $replace['COMMA_SEP_FIELDS'] .= 
      " " . $sql_field['Field'] . "\n                     ,";

   $replace['PHP_ARRAY_PARAM_REQUEST_W_ID'] .=
      "\$request['$field_name'],\n                      ";

   if ($field_name != 'id') {
      $replace['ROW_VALUES'] .= 
         "         <td><?= \$row['$field_name'] ?></td>\n";
      $replace['ROW_HEADERS'] .= 
         "      <th>$field_name_nice</th>\n";

      $replace['COMMA_SEP_SET_FIELDS'] .= 
         " " . $sql_field['Field'] . " = \$$i \n                  ,";

      $replace['PHP_ARRAY_PARAM_REQUEST'] .=
         "\$request['$field_name'],\n                      ";

      $replace['DEFAULT_DOLLAR_PARAM'] .= "\$" . ($i - 1) . ", ";

      $replace['FIELD_NAME'] = $field_name;
      $replace['FIELD_NAME_NICE'] = $field_name_nice;
      if ($field_type == "text") {
         $replace['FIELD_ROWS'] .= replace_fields($replace, $text_template);
      } else {
         $replace['FIELD_ROWS'] .= replace_fields($replace, $char_template);
      }
   }

}

$replace['FIELD_ROWS'] = rtrim($replace['FIELD_ROWS'], "\n");
$replace['ROW_HEADERS'] = rtrim($replace['ROW_HEADERS'], "\n");
$replace['ROW_VALUES'] = rtrim($replace['ROW_VALUES'], "\n");

$replace['COMMA_SEP_FIELDS'] = rtrim($replace['COMMA_SEP_FIELDS'], " ,\n");

$replace['COMMA_SEP_SET_FIELDS'] = rtrim($replace['COMMA_SEP_SET_FIELDS'], " ,\n");

$replace['DEFAULT_DOLLAR_PARAM'] = rtrim($replace['DEFAULT_DOLLAR_PARAM'], " ,");

$replace['PHP_ARRAY_PARAM_REQUEST'] = rtrim($replace['PHP_ARRAY_PARAM_REQUEST'], " ,\n");
$replace['PHP_ARRAY_PARAM_REQUEST'] .= ");\n";

$replace['PHP_ARRAY_PARAM_REQUEST_W_ID'] = rtrim($replace['PHP_ARRAY_PARAM_REQUEST_W_ID'], " ,\n");
$replace['PHP_ARRAY_PARAM_REQUEST_W_ID'] .= ");\n";

$model_file = replace_fields($replace, $model_template);
$control_file = replace_fields($replace, $control_template);
$index_file = replace_fields($replace, $index_template);
$edit_file = replace_fields($replace, $edit_template);

file_put_contents(dirname(__FILE__) . "/model/$class.php", $model_file);
file_put_contents(dirname(__FILE__) . "/apps/$class/$class.php", $control_file);
file_put_contents(dirname(__FILE__) . "/apps/$class/views/index.php", $index_file);
file_put_contents(dirname(__FILE__) . "/apps/$class/views/edit.php", $edit_file);

function replace_fields($fields, $string) {
   foreach ($fields as $ml => $value) {
      $string = str_replace("<$ml>", $value, $string);
   }
   return $string;
}

?>
