<?php
   ($db = mysql_connect("jordan","ercanbracks","scotte")) or die("ERROR: Database connection failed!");
   mysql_select_db("treborus") or die("ERROR: Database selection failed!");
   $type = $_REQUEST["type"];
   if ($type == "rm")
   {
      print "rm\n";
      $studentId = $_REQUEST["studentId"];
      mysql_query("DELETE FROM students WHERE studentId = $studentId") or die("remove failed");
   }
   if ($type == "add")
   {
      print "add\n";
      $firstName = $_REQUEST["firstName"];
      $lastName = $_REQUEST["lastName"];
      $gender = $_REQUEST["gender"];
      $city = $_REQUEST["city"];
      $state = $_REQUEST["state"];
      $birthDate = $_REQUEST["birthDate"];
      $majorCode = $_REQUEST["majorCode"];
      $query = "INSERT INTO students (firstName, lastName, gender, city, 
                   state, birthDate, majorCode ) VALUES ( '$firstName', 
                   '$lastName', '$gender', '$city', '$state', '$birthDate', 
                   $majorCode );";
      print $query;
      mysql_query($query) or die("query failed");
   }
   if ($type == "mod")
   {
      $studentId = $_REQUEST["studentId"];
      $firstName = $_REQUEST["firstName"];
      $lastName = $_REQUEST["lastName"];
      $gender = $_REQUEST["gender"];
      $city = $_REQUEST["city"];
      $state = $_REQUEST["state"];
      $birthDate = $_REQUEST["birthDate"];
      $majorCode = $_REQUEST["majorCode"];
      
      $query = "UPDATE students SET firstName='$firstName', lastName='$lastName', 
                gender='$gender', city='$city', state='$state', birthDate='$birthDate',
                majorCode=$majorCode WHERE studentId=$studentId;";
      mysql_query($query) or die("query failed");
   }

 ?>