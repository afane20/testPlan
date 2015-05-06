<?php

   $command = $_GET["command"];
   $firstName = $_GET["firstName"];
   $lastName = $_GET["lastName"];
   $major = $_GET["major"];
   $birthDate = $_GET["birthDate"];
   $gender = $_GET["gender"];
   $city = $_GET["city"];
   $state = $_GET["state"];
   $studentId = $_GET["studentId"];

   dbConnect(); //Connect to mysql and select database

   switch ($command) //get requested command and execute it
   {
      case "update": //client wants an updated table
         cmdUpdate();    
      break;

      case "remove": //client wants to remove a row from the table
         cmdRemove($studentId);
      break;

      case "add": //client wants to add a row to the table
         cmdAdd($firstName, $lastName, $major, $birthDate, $gender, $city, $state);
      break;

      case "modify": //client wants to modify a row of the table
         cmdModify($studentId, $firstName, $lastName, $major, $birthDate, $gender, $city, $state);
      break;

   }

   mysql_close($link); //close database connection



   function cmdRemove($pStudentId)
   {
      $remove = "DELETE from Students WHERE StudentId=" . $pStudentId;

      if (mysql_query($remove))
      {
         print ("2" . "Removed Successfully");
      }
      else
      {
         print("2" . "FAILED TO REMOVE RECORD: " . mysql_error());
      }
   }

   function cmdModify($pStudentId, $pFirstName, $pLastName, $pMajor, $pBirthDate, $pGender, $pCity, $pState)
   {   
      $modify = "UPDATE Students SET ";
      $fields = "";
      $fields = $fields . ($pFirstName == "" ? "" : "FirstName='" . $pFirstName . "'");
      $fields = $fields . ($pLastName == "" ? "" : ", LastName='" . $pLastName . "'");
      $fields = $fields . ($pMajor == "" ? "" : ", MajorCode=" . $pMajor);
      $fields = $fields . ($pBirthDate == "" ? "" : ", BirthDate='" . $pBirthDate . "'");
      $fields = $fields . ($pGender == "" ? "" : ", Gender='" . $pGender . "'");
      $fields = $fields . ($pCity == "" ? "" : ", City='" . $pCity . "'");
      $fields = $fields . ($pState == "" ? "" : ", State='" . $pState . "'");
      if (substr($fields, 0, 1) == ",")
      {
         $fields = substr($fields, 1, strlen($fields) - 1);
      }
      $modify = $modify . $fields . " WHERE StudentId=" . $pStudentId; 

      if (mysql_query($modify))
      {
         print ("3" . "Modified Successfully");
      }
      else
      {
         print("3" . "FAILED TO MODIFY RECORD: " . mysql_error());
      }
   }

   function cmdAdd($pFirstName, $pLastName, $pMajor, $pBirthDate, $pGender, $pCity, $pState)
   {
      $insert = "INSERT INTO Students(FirstName, LastName, MajorCode, BirthDate, Gender, City, State) ";
      $insert = $insert . "VALUES('" . $pFirstName . "', '" . $pLastName . "', " . $pMajor;
      $insert = $insert . ", '" . $pBirthDate . "', '" . $pGender . "', '" . $pCity  . "', '" . $pState . "')";  
      if (mysql_query($insert))
      {
         print ("4" . "Added Successfully");
      }
      else
      {
         print("4" . "FAILED TO ADD RECORD: " . mysql_error());
      }
   }

   function cmdUpdate()
   {
      $query = "SELECT * FROM Students";
      $result = mysql_query($query);
      if(!$result)
      {
         print("5");
         print (mysqul_error());
      }
      else
      {
         print("1");
      }   
      $row = mysql_num_rows($result);
      $fields = mysql_num_fields($result);
      for ($i = 0; $i < $row; $i++)
      {
         $resultArray = mysql_fetch_array($result);
         for ($j = 0; $j < $fields; $j++)
         {
            print ("$resultArray[$j]");
            if (($j + 1) < $fields)
            {
               print (",");
            }
         }
         if (($i +1) < $row)
         {
            print("\n");
         }   
      }   
   }

   function dbConnect()
   {
      $link = mysql_connect("157.201.194.254", "ercanbracks", "scotte");
      if (!$link) 
      {
         die('Could not connect: ' . mysql_error());
      }

      $database = "ikarlins";
      mysql_select_db($database);
      return $link;
   }
?>
