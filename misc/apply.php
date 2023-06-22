<?php

//To Handle Session Variables on This Page
session_start();

if (empty($_SESSION['id_user'])) {
	header("Location: index.php");
	exit();
}

//Including Database Connection From misc/db.php file to avoid rewriting in all files
require_once("misc/db.php");

//If user Actually clicked apply button
if (isset($_GET)) {

	$sql = "SELECT * FROM sponsorships WHERE sponsorship_id='$_GET[id]'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$id_company = $row['id_company'];
	}

	//Check if user has applied to job post or not. If not then add his details to apply_sponsorships table.
	$sql1 = "SELECT * FROM apply_sponsorships WHERE id_user='$_SESSION[id_user]' AND sponsorship_id='$row[sponsorship_id]'";
	$result1 = $conn->query($sql1);
	if ($result1->num_rows == 0) {

		$sql = "INSERT INTO apply_job_post(sponsorship_id, id_company, id_user) VALUES ('$_GET[id]', '$id_company', '$_SESSION[id_user]')";

		if ($conn->query($sql) === TRUE) {
			$_SESSION['jobApplySuccess'] = true;
			header("Location: user/index.php");
			exit();
		} else {
			header('Content-Type: application/json; charset=utf-8');
			echo '{"code": 400,"status": "failed"}';
		}

		$conn->close();

	} else {
		header("Location: jobs.php");
		exit();
	}


} else {
	header("Location: jobs.php");
	exit();
}