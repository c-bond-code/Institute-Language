
<?php

	$db   = "cbdatabase";
	$host = "10.29.21.4";

	$dbuser = "Language";
	$dbpass = "qNYsStBG5ruvYUQ1Wh";
	$database = "cbdatabase";
	$dbhost = "10.29.21.4";  

	$fName = $_POST["FName"];
	$lName = $_POST["LName"];
	$userID = $_POST["userID"];
	$pass = $_POST["password"];
	$email = $_POST["email"] . "@tech.edu";
	$major = $_POST["major"];
	$type = $_POST["type"];


	$sql = "INSERT INTO LANGUAGEBULK (
			FIRST_NAME,
			LAST_NAME,
			USER_ID,
			PASSWORD,
			EMAIL,
			MAJOR,
			TYPE
			) VALUES ( ?, ?, ?, SHA2(?, 256), ?, ?, ? );";

	//  Connect
	$con =  mysqli_connect($dbhost, $dbuser, $dbpass, $database);

	// Prepare statements for querying ----------------------------------------------------
	$stmt = $con->prepare($sql);
	$stmt->bind_param("sssssss", $fName, $lName, $userID, $pass, $email, $major, $type);
	$stmt->execute();

	header("Location: viewer.php");

	mysqli_close($con);

?>