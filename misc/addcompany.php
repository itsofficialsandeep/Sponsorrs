<?php

//To Handle Session Variables on This Page
//session_start();

//Including Database Connection From misc/db.php file to avoid rewriting in all files
require_once("db.php");
require_once("functions.php");

//If user clicked register button
if (isset($_POST)) {


	//Escape Special Characters In String First
	$company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
	$company_phone = mysqli_real_escape_string($conn, $_POST['company_phone']);
	$company_about = mysqli_real_escape_string($conn, $_POST['company_about']);
	$email = mysqli_real_escape_string($conn, $_POST['company_email']);

	$password = mysqli_real_escape_string($conn, $_POST['company_password']);
	$password = password_hash($password, PASSWORD_DEFAULT);

	$company_country = mysqli_real_escape_string($conn, $_POST['company_country']);
	$company_industry = mysqli_real_escape_string($conn, $_POST['company_industry']);

	$company_industry = (int) $company_industry;

	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$given_name = mysqli_real_escape_string($conn, $_POST['given_name']);
	$family_name = mysqli_real_escape_string($conn, $_POST['family_name']);
	$locale = mysqli_real_escape_string($conn, $_POST['locale']);
	$sub = mysqli_real_escape_string($conn, $_POST['sub']);
	$email_verified = mysqli_real_escape_string($conn, $_POST['email_verified']);
	$picture = mysqli_real_escape_string($conn, $_POST['picture']);

	$genrateHash = new generateHash();
	$ac_id = $genrateHash->generatePrimaryACKey($email);

	$dp_username = substr($ac_id, 3, 25);

	$token = $genrateHash->generateToeknSec($email);

	$ac_type = 2; // i means creator account

	$username = strtolower($dp_username);

	// save into the primary_ac
	$sqlPrimaryAc = $conn->prepare("INSERT INTO `primary_ac`(`ac_id`, `ac_type`, `primary_email`, `username`, `dp_username`, 
											  `password`, `token_secret`) VALUES(?,?,?,?,?,?,?)");

	$sqlPrimaryAc->bind_param("sisssss", $ac_id, $ac_type, $email, $username, $dp_username, $password, $token);

	//save to company
	$sqlForCompany = $conn->prepare("INSERT INTO company (name, companyname, country, contactno, email, aboutme, logo, given_name, locale, sub, email_verified, industry, family_name) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");

	$sqlForCompany->bind_param("sssissssssiis", $name, $company_name, $company_country, $company_phone, $email, $company_about, $picture, $given_name, $locale, $sub, $email_verified, $company_industry, $family_name);


	try {
		// SQL QUERY
		$query = "SELECT sr_no FROM primary_ac WHERE primary_email='$email'";

		$result = $conn->query($query);

		// if there is no account associated with the give example create a new one 
		if ($result->num_rows == 0) {

			if ($sqlPrimaryAc->execute() && $sqlForCompany->execute()) {

				$usersSql = "SELECT logo FROM company  WHERE primary_ac_id='$ac_id'";
				$usersResult = $conn->query($usersSql);
				while ($userRow = $usersResult->fetch_assoc()) {
					$_SESSION['logo'] = $userRow['logo'];

				}

				session_start();
				$_SESSION['currentUsername'] = $username;
				$_SESSION['currentUser'] = $ac_id;
				$_SESSION['currentEmail'] = $email;
				$_SESSION['userType'] = 2;

				$message = new Message(9, true, "Account created successfully");
				echo $message->printMessage();

			} else {
				$message = new Message(2, false, "Failed to create account");
				echo $message->printMessage();
			}

		} else {
			if ($result->num_rows == 1) {
				$message = new Message(10, false, "Account already created");
				echo $message->printMessage();
			} else {
				$message = new Message(11, false, "Failed to create an account");
				echo $message->printMessage();

			}
		}
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		$message = new Message(11, false, $e->getMessage());
		echo $message->printMessage();
	}

	//Close database connection. Not compulsory but good practice.
	$conn->close();

} else {
	//redirect them back to register page if they didn't click register button
	header("Location: register-company.php");
	exit();
}