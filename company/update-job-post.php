<?php

//To Handle Session Variables on This Page
session_start();

if (empty($_SESSION['id_company'])) {
	header("Location: ../index.php");
	exit();
}

//Including Database Connection From misc/db.php file to avoid rewriting in all files
require_once("../misc/db.php");

//if user Actually clicked update profile button
if (isset($_POST)) {

	//Escape Special Characters
	$sponsorship_id = mysqli_real_escape_string($conn, $_POST['sponsorship_id']);
	$sponsorship_title = mysqli_real_escape_string($conn, $_POST['sponsorship_title']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$minimumsalary = mysqli_real_escape_string($conn, $_POST['minimumsalary']);
	$experience = mysqli_real_escape_string($conn, $_POST['experience']);
	$qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
	$service = mysqli_real_escape_string($conn, $_POST['product']);
	$adcatgory = mysqli_real_escape_string($conn, $_POST['category']);
	$adtype = mysqli_real_escape_string($conn, $_POST['adtype']);

	//Update User Details Query
	$sql = "UPDATE sponsorships SET sponsorship_title='$sponsorship_title', description='$description', minimumsalary='$minimumsalary', service=$service, adcategory=$adcatgory, adtype=$adtype ";

	$sql = $sql . " WHERE sponsorship_id=$sponsorship_id";

	if ($conn->query($sql) === TRUE) {
		$_SESSION['name'] = $companyname;
		//If data Updated successfully then redirect to dashboard
		header("Location: index.php");
		exit();
	} else {
		header('Content-Type: application/json; charset=utf-8');
		echo '{"code": 400,"status": "failed"}';
	}
	//Close database connection. Not compulsory but good practice.
	$conn->close();

} else {
	//redirect them back to dashboard page if they didn't click update button
	header("Location: edit-company.php");
	exit();
}