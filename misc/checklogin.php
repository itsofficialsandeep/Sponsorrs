<?php

//To Handle Session Variables on This Page
session_start();

//Including Database Connection From misc/db.php file to avoid rewriting in all files
require_once("db.php");
require_once("functions.php");

//If user Actually clicked login button 
if (isset($_POST)) {

	//Escape Special Characters in String
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$sql = "SELECT password,ac_type, ac_id, primary_email,username, dp_username,token_secret,active FROM primary_ac WHERE primary_email='$email'";
	$result = $conn->query($sql);

	//if user table has this login details
	if ($result->num_rows == 1) {
		//output data
		while ($row = $result->fetch_assoc()) {

			if (password_verify($password, $row['password'])) {

				if ($row['active'] == 0) {

					$message = new Message(5, false, "Your Account Is Not Active.");
					echo $message->printMessage();

					exit();
				} else if ($row['active'] == 1) {

					if ($row['ac_type'] == 1) {
						$acId = $row['ac_id'];

						// get the channel id and subcreation id
						$usersSql = "SELECT channel_id, primary_subcreation_id,pictures FROM users  WHERE primary_ac_id='$acId'";
						$usersResult = $conn->query($usersSql);
						while ($userRow = $usersResult->fetch_assoc()) {
							$_SESSION['currentChannelId'] = $userRow['channel_id'];
							$_SESSION['currentSubcreationId'] = $userRow['primary_subcreation_id'];
							$_SESSION['logo'] = $userRow['pictures'];

						}

						$_SESSION['currentUsername'] = $row['username'];
						$_SESSION['currentUser'] = $row['ac_id'];
						$_SESSION['currentEmail'] = $row['primary_email'];
						$_SESSION['userType'] = 1;

						$message = new Message(61, true, "Login validated");
						echo $message->printMessage();
					}
					if ($row['ac_type'] == 2) {
						$acId = $row['ac_id'];

						// get logo of current user
						$usersSql = "SELECT logo FROM company  WHERE primary_ac_id='$acId'";
						$usersResult = $conn->query($usersSql);
						while ($userRow = $usersResult->fetch_assoc()) {
							$_SESSION['logo'] = $userRow['logo'];

						}

						$_SESSION['currentUsername'] = $row['username'];
						$_SESSION['currentUser'] = $row['ac_id'];
						$_SESSION['currentEmail'] = $row['primary_email'];
						$_SESSION['userType'] = 2;

						$message = new Message(62, true, "Login validated");
						echo $message->printMessage();

					}

				} else if ($row['active'] == 2) {
					$message = new Message(8, false, "Your Account Is Deactivated. Contact Admin To Reactivate.");
					echo $message->printMessage();
				}

				//Redirect them to user dashboard once logged in successfully	
			} else {
				$message = new Message(14, false, "Incorrect combination..Check your E-Mail and Password..");
				echo $message->printMessage();
			}
		}
	} elseif ($result->num_rows == 0) {
		$message = new Message(20, false, "No account found with this E-Mail");
		echo $message->printMessage();
	} else {
		$message = new Message(20, false, "Something went wrong with this E-Mail");
		echo $message->printMessage();
	}

} else {
	//redirect them back to login page if they didn't click login button
	$message = new Message(22, false, "Something went wrong...");
	echo $message->printMessage();
	exit();
}