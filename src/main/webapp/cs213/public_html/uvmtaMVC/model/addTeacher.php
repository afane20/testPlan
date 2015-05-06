<?php
   include 'loginValid.php';
   require_once 'dbConnPDO.php';
   $db = getDB();

   if ( !isset($_GET['teacherId'] ) )
   {
      print "Server Error: Please try again later";
      exit;

   }

   $teacherId = valInt($_GET['teacherId']);
   $firstName = sanStr($_GET['firstName']);
   $lastName = sanStr($_GET['lastName']);
   $uvmtaId = sanStr($_GET['uvmtaId']);
   $street = sanStr($_GET['street']);
   $city = sanStr($_GET['city']);
   $state = sanStr($_GET['state']);
   $zip = sanStr($_GET['zip']);
   $phone = sanStr($_GET['phone']);
   $email = sanStr($_GET['email']);
   $password = sha1($_GET['pwd']);
   $username = sanStr($_GET['username']);
   $membershipCurrent = sanStr($_GET['membershipCurrent']);
   $membershipFees = valFloat($_GET['membershipFees']);
   $regFees = valFloat($_GET['regFees']);
   $admin = sanStr($_GET['admin']);
   $earlyReg = sanStr($_GET['earlyReg']);
   
   $query = "insert into teacher (first, last, uvmtaId, street, city, state, zip, phone, email, pwd, username,
               membershipCurrent, membershipFees, regFees, admin, earlyReg) values (:firstName, :lastName, :uvmtaId, :street, :city, :state, :zip, :phone, :email, :password, :username, :membershipCurrent, :membershipFees, :regFees, :admin, :earlyReg);";

	try {
		$stmt = $db->prepare($query);
		$stmt->bindValue(':firstName', $firstName);
		$stmt->bindValue(':lastName', $lastName);
		$stmt->bindValue(':uvmtaId', $uvmtaId);
		$stmt->bindValue(':street', $street);
		$stmt->bindValue(':city', $city);
		$stmt->bindValue(':state', $state);
		$stmt->bindValue(':zip', $zip);
		$stmt->bindValue(':phone', $phone);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':password', $password);
		$stmt->bindValue(':username', $username);
		$stmt->bindValue(':membershipCurrent', $membershipCurrent);
		$stmt->bindValue(':membershipFees', $membershipFees);
		$stmt->bindValue(':regFees', $regFees);
		$stmt->bindValue(':admin', $admin);
		$stmt->bindValue(':earlyReg', $earlyReg);
		$stmt->execute();
		$stmt->closeCursor();
		print "Teacher has been added!";
	} catch (PDOException $e) {
		print "Teacher could not be added! Please check your syntax.";
	}  
?>
