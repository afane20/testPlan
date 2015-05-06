<?php
   require_once("dbConnect.php");
   
   $username = $_POST['username'];
   $password = sha1($_POST['pwd']);

   $query = "SELECT teacherId, admin, first, last, membershipCurrent  FROM teacher WHERE username='" .
            $username . "' and pwd='" .
            $password . "';";
   $data = mysql_query( $query );

   //invalid query
   if ( !$data )
   {
      print $query;
      print "Invalid query string: ".mysql_error();
      exit;
   }
   $rowCount = mysql_num_rows( $data );
   $currentRow;
   $teacherId;

   if ($rowCount > 0)
   {
      $currentRow = mysql_fetch_array($data);
      $teacherId = $currentRow['teacherId'];
      $admin = $currentRow['admin'];
      $firstName = $currentRow['first'];
      $lastName = $currentRow['last'];
      $membershipCurrent = $currentRow['membershipCurrent'];
      session_start();
      $_SESSION['teacherId'] = $teacherId;
      $_SESSION['userName'] = $username;
      $_SESSION['firstName'] = $firstName;
      $_SESSION['lastName'] = $lastName;
      $_SESSION['membershipCurrent'] = $membershipCurrent;
      $_SESSION['admin'] = $admin;
      // $_SESSION['pwd'] = $password;

      if ($admin == 'Y')      // administrator
      {
         header('Location: ../students/');
      }
      else if ($admin == 'N') // teacher only 
      {
         header('Location: ../students/');
      }
      else if ($admin == 'T') // treasurer
      {
         header('Location: ../students/');
      }
   }
   else 
   {
      header('Location: ../login.php?error=1');
   }
?>
