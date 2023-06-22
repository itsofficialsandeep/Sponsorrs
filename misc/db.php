<?php

//Your Mysql Config
$servername = "localhost";
$username = "root";
//$username = "sponsorr_HSUlFeOnGdaEbJuh";
$password = "";
//$password = "gCfUjCGWG4ZANA8";
$dbname = "sponsorrs";
//$dbname = "sponsorr_H47sFWkDoFhhgTbDPOKnyC";

//Create New Database Connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
if ($conn->connect_error) {
	die("Connection Failed: ");
}

// // CREATE CONNECTION
// $conn = mysqli_connect($servername,
// 	$username, $password, $dbname);

// // GET CONNECTION ERRORS
// if (!$conn) {
// 	die("Connection failed: " . mysqli_connect_error());
// }

// 	$conn = new PDO(
// 		"mysql:host=$servername;dbname=$dbname",
// 		$username, $password);

// 	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>