<?php
   include 'loginValid.php';
   require_once 'dbConnPDO.php';
   $db = getDB();

   if ( !isset($_SESSION['teacherId'] ) )
   {
      print "Server Error: Please try again later";
      exit;
   }

   $festivalName = sanStr($_GET['festivalName']);
   $festivalDate = $_GET['festivalDate'];
   $altFestDate = $_GET['altFestDate'];
   $regFee = valFloat($_GET['regFee']);
   $regFeeAlt = valFloat($_GET['regFeeAlt']);
   $regOpen = sanStr($_GET['regOpen']);
   $regOpenEarly = sanStr($_GET['regOpenEarly']);
   $regEndDate = $_GET['regEndDate'];
   $currentFestival = sanStr($_GET['currentFestival']);

   $query = "INSERT INTO festival (festivalName, festivalDate, alternateDate, regFee, regFeeAlt,
             regOpen, regOpenEarly, regEnds, currentFestival) VALUES (:festivalName, :festivalDate, :altFestDate, :regFee, :regFeeAlt, :regOpen, :regOpenEarly, :regEndDate, :currentFestival)" ;
   	
   	try {
   		$stmt = $db->prepare($query);
   		$stmt->bindValue(':festivalName', $festivalName);
   		$stmt->bindValue(':festivalDate', $festivalDate);
   		$stmt->bindValue(':altFestDate', $altFestDate);
   		$stmt->bindValue(':regFee', $regFee);
   		$stmt->bindValue(':regFeeAlt', $regFeeAlt);
   		$stmt->bindValue(':regOpen', $regOpen);
   		$stmt->bindValue(':regOpenEarly', $regOpenEarly);
   		$stmt->bindValue(':regEndDate', $regEndDate);
   		$stmt->bindValue(':currentFestival', $currentFestival);
   		$stmt->execute();
   		$stmt->closeCursor();
   		
   		print "$festivalName has been added!";
   	} catch (PDOException $e) {
   		$errorMessage = $e->getMessage();
   		print "Error - $festivalName cannot be added!";
   	}

?>
