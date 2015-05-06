<?php

	/*
	 * MySQLi Connection
	 */
	$conn = mysql_connect("jordan", "ercanbracks", "scotte"); 
  
   //check for database connection failures
   if ( !$conn )
   {
      // print "MYSQL Database is offline - could not make a connection!";
      header('Location: ../login.php?error=2'); 
      exit;
   }
   else
   {  
      $myDatabase = mysql_select_db("uvmta");
      if ( !$myDatabase )
      {
         // print "UVMTA database could not be located!";
         header('Location: ../login.php?error=3');
         exit;
      }     
   }
?>
