<!-- ********************************
Name: Clayton Bond
Username: cloud101
Problem Set: PS1
Due Date: 11 15, 2019
******************************** -->

<?php

	$user = $_POST["user"];
	$db   = "cbdatabase";
	$host = "10.29.21.4";

	$dbuser = "root";
	$dbpass = "Forkbomb00";
	$database = "cbdatabase";
	$dbhost = "10.29.21.4";  

	$sql = "DELETE FROM UAFSBULK WHERE USER_ID = ?;";

     //  Connect
	$con =  mysqli_connect($dbhost, $dbuser, $dbpass, $database);

	// Prepare statements for querying ----------------------------------------------------
	$stmt = $con->prepare($sql);
	$stmt->bind_param("s", $user);
	$stmt->execute();

	header("Location: viewer.php");
	
	mysqli_close($con);


?>