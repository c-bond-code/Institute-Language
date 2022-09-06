<?php

	$db   = "cbdatabase";
 	$host = "10.29.21.4";

 	$dbuser = "root";
 	$dbpass = "Forkbomb00";
 	$database = "cbdatabase";
 	$dbhost = "10.29.21.4"; 

	$user = $_POST["userNum"];
	$fName = $_POST["FName"];
	$lName = $_POST["LName"];
	$userID = $_POST["userID"];
	$pass = $_POST["password"];
	$email = $_POST["email"] . "@tech.edu";
	$major = $_POST["major"];
	$type = $_POST["type"];

	$sql = "UPDATE UAFSBULK
			SET FIRST_NAME = ?, LAST_NAME = ?, USER_ID = ?, EMAIL = ?, MAJOR = ?, TYPE = ?
            WHERE USER_ID = ?;";

    //  Connect
	$con =  mysqli_connect($dbhost, $dbuser, $dbpass, $database);

	// Prepare statements for querying -----------------------------------------------------
	$stmt = $con->prepare($sql);
	$stmt->bind_param("sssssss", $fName, $lName, $userID, $email, $major, $type, $user);
	$stmt->execute();
	// -------------------------------------------------------------------------------------

	header("Location: viewer.php");

	mysqli_close($con);


?>