<?php

/*
 * CONTROLLER FOR CLIENTS
 */
if (!$_session) {
    session_start(); 
}

include '/home/ercanbracks/public_html/cs313/heidi/database/conn.php';
include '/home/ercanbracks/public_html/cs313/heidi/clients/model.php';
include '/home/ercanbracks/public_html/cs313/heidi/library.php';


if($_GET['action']) {
    $action = $_GET['action'];
} elseif ($_POST['action']) {
    $action = $_POST['action'];
}


//notice that registration in capitalized.
if ($action == 'Register') {
    //collect the data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $emailaddress = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    
    //echo "$firstname, $lastname, $emailaddress, $password bla $password2"; //for testcode
    
    
    //Validate inputs
//    $firstname = valString($firstname);
//    $lastname = valString($lastname);
//    $emailaddress = valEmail($emailaddress);
//    $password = valString($password);
//    
    
    $errors = array();
    
    if(empty($firstname) || empty($lastname) || empty($emailaddress) || empty($password) || empty($password2) ) {
        $errors[0] = 'All fields are required';
    } 
    if($password <> $password2) {
        $errors[1] = 'Passwords do not match';
    }
    
    if (checkEmail($emailaddress)) {
        $errors[2] = 'That email has already been used, use a different email';
    }

    //Notify the user if things are not right
    if(!empty($errors)) {
        include 'register.php';
        die;
    }
    
    //step 4 - proceed if only there are no problems
    
    
    
    //Process
    $regresult = regClient($firstname, $lastname, $emailaddress, $phone, $address, $password); 
    
    //echo $regresult . "     LALALA";

    //confirm and inform the user
 if($regresult == TRUE){
     //echo "yestestpage";
     
     $message = "Welcome $firstname! You are now registered.";
     include 'login.php';
     die;
 }else {
     //echo " notestpage";
     
     $message = "Sorry $firstname but there was a problem and the registration did not succeed. Please try again.";
     include 'register.php';
 }
 
 
 
 
}

//confirm and inform the user


 //-----------------END----------------------------

elseif ($action == 'Login') {
     //collect the data
    $emailaddress = $_POST['email'];
    $password = $_POST['password'];
    
    //Validate inputs
//    $emailaddress = valEmail($emailaddress);
//    $password = valString($password);
    
    
    $errors = array();
    
    if( empty($emailaddress) || empty($password) ) {
        $errors[0] = 'All fields are required';
    }
    
//    if (!checkEmailAndPassword($emailaddress, $password)) {
//        $errors[2] = 'Either the e-mail or the password is wrong';
//    }

    //Notify te user if things are not right
    if(!empty($errors)) {
        include 'login.php';
        die;
    }
    
    $loginResult = array();
    $loginResult = loginClient($emailaddress, $password);
    
    //echo $loginResult . "       result";
    
   
    
    if($loginResult[0] > 0 && !empty($loginResult[4])){
        $_SESSION['clientid'] = $loginResult[0];
        $_SESSION['clientfirst'] = $loginResult[1];
        $_SESSION['clientlast'] = $loginResult[2];
        $_SESSION['clientemail'] = $loginResult[3];
        $_SESSION['clientrights'] = $loginResult[4];
        $_SESSION['loginflag'] = TRUE;
        
        //echo "yup2";
        
        
        if($loginResult[4] > 0 && $loginResult[4] < 11){
            //echo 'worked rights 10!';
            header('Location: http://157.201.194.254/~ercanbracks/cs313/heidi/teacher/');
            die;
        } else {
            //echo 'worked rights 20!';
            header('Location: http://157.201.194.254/~ercanbracks/cs313/heidi/teacher/');
            die;
        }
     } else {
         //echo 'failed...';
     $message = "Sorry $firstname but there was a problem logging you in. Please try again.";
     include 'login.php';
     die;
 }
  
}

//-----------------END----------------------------



else {
    include 'register.php';
}
?>
