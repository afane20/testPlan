<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//echo 'model';

function regClient($firstname, $lastname, $emailaddress, $phone, $address, $password) {
    //global $db;

    $sql = "INSERT INTO teacher (firstName, lastName, email, password, phoneNumber, mailingAddress, numStudentsClearToRegister, duesPaid, rights) VALUES('$firstname', '$lastname', '$emailaddress', '$password', '$phone', '$address', 0, 0, 10)";

    $result = mysql_query($sql);

    return $result;
}

function checkEmail($emailaddress) {
    $sql = "SELECT email FROM teacher WHERE email = '$emailaddress'";
    //echo $sql;
    $result = mysql_query($sql);
    //echo $result;
    
    $numRows = mysql_num_rows($result);
    
    if ($numRows >= 1) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function loginClient($emailaddress, $password){
 $sql = "SELECT teacherId, firstName, lastName, email, rights 
   FROM teacher 
   WHERE email = '$emailaddress' AND password = '$password'";

 $result = mysql_query($sql);
 $teacherlogin = mysql_fetch_array($result);
 print_r($teacherlogin);
 
// if($stmt = $connection_user->prepare($sql)){
//   $stmt->bind_param('ss', $emailaddress, $password);
//   $stmt->bind_result($clientid, $clientfirst, $clientlast, $clientemail, $clientrights);
//   $stmt->execute();
//   $stmt->fetch();
//   $clientlogin = array($clientid, $clientfirst, $clientlast, $clientemail, $clientrights);
//   $stmt->close();
// }
 
 // Check result and inform the controller
 if(!empty($teacherlogin) && $teacherlogin[0] > 0){
   return $teacherlogin;
 } else {
   return FALSE;
 }
}

?>
