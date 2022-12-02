<?php

	$user = $_POST["user"];
	$db   = "cbdatabase";
	$host = "10.29.21.4";

	$dbuser = "Language";
	$dbpass = "qNYsStBG5ruvYUQ1Wh";
	$database = "cbdatabase";
	$dbhost = "10.29.21.4";  

	$sql = "DELETE FROM LANGUAGEBULK WHERE USER_ID = ?;";

     //  Connect
	$con =  mysqli_connect($dbhost, $dbuser, $dbpass, $database);

	// Prepare statements for querying ----------------------------------------------------
	$stmt = $con->prepare($sql);
	$stmt->bind_param("s", $user);
	$stmt->execute();

	header("Location: viewer.php");
	
	mysqli_close($con);


?>