<?php


//------------------CONNECT TO THE DATABASE
$hostName = "157.201.194.254";
 $userName = "hhulbert";
 $password = "";
 if  ( !($db = mysql_connect($hostName, $userName , $password)) )
{
   print "<br>Error connecting to database";
   die("Error connecting to database");
}

//------------------SPECIFYING THE DATABASE
$database = "hhulbert";

  if ( !( mysql_select_db($database) ))
   {
      print "<br/> Error connecting to the hhulbert database";
      die("Error connecting to the hhulbert database");
   }
   
   //echo 'database';

?>
