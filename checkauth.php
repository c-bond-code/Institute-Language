<?php
  session_unset();
  session_destroy();

	$user = $_POST["txtUser"];
	$pass = $_POST["txtPass"];
	$db   = "cbdatabase";
	$host = "10.29.21.4";

  $dbuser = "Language";
	$dbpass = "qNYsStBG5ruvYUQ1Wh";
	$database = "cbdatabase";
	$dbhost = "10.29.21.4";

  $sql = "SELECT COUNT(*) AS TOTALCOUNT, TYPE FROM LANGUAGEBULK
          WHERE User_ID = ?
          AND Password = SHA2(?, 256)
          GROUP BY type";

 //  Connect
$con =  mysqli_connect($dbhost, $dbuser, $dbpass, $database);

// Prepare statements for querying ----------------------------------------------------
$stmt = $con->prepare($sql);
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$rs = $stmt->get_result();

// Iterate through result set ---------------------------------------------------------
if ( mysqli_num_rows($rs) > 0 ) {
  while ( $row = mysqli_fetch_assoc($rs) ) {
     $matching = $row["TOTALCOUNT"];

     if ( $matching == 1 ) {  // Logged in
         session_start();
         $_SESSION["type"] = $row["TYPE"];
         header("Location: viewer.php");

     } else { // Redirect
        header("Location: index.html"); 
        exit();
     }
  }
} else {
  header("Location: index.html");
  echo "Problem";
} 
// -------------------------------------------------------------------------------------

mysqli_close($con);

?>
