<?php

//Including Database Connection From misc/db.php file to avoid rewriting in all files
require_once("db.php");
require_once("functions.php");

//If user Actually clicked register button
if (isset($_POST)) {

	//Escape Special Characters In String First
	$previous_sponsor = mysqli_real_escape_string($conn, $_POST['previous_sponsor']);
	$channel_category = (int) mysqli_real_escape_string($conn, $_POST['channel_category']);
	$sponsor_type = (int) mysqli_real_escape_string($conn, $_POST['sponsor_type']);

	$password = mysqli_real_escape_string($conn, $_POST['creator_password']);
	$password = password_hash($password, PASSWORD_DEFAULT);

	$given_name = mysqli_real_escape_string($conn, $_POST['given_name']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$pictures = mysqli_real_escape_string($conn, $_POST['pictures']);
	$family_name = mysqli_real_escape_string($conn, $_POST['family_name']);
	$locale = mysqli_real_escape_string($conn, $_POST['locale']);
	$sub = mysqli_real_escape_string($conn, $_POST['sub']);
	$email_id = mysqli_real_escape_string($conn, $_POST['creator_email']);
	$channel_id = mysqli_real_escape_string($conn, $_POST['channel_id']);
	$email_verified = (int) mysqli_real_escape_string($conn, $_POST['email_verified']);

	$title = mysqli_real_escape_string($conn, $_POST['title']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$custom_url = mysqli_real_escape_string($conn, $_POST['customUrl']);
	$published_at = mysqli_real_escape_string($conn, $_POST['publishedAt']);
	$thumbnail_url = mysqli_real_escape_string($conn, $_POST['thumbnailUrl']);
	$country = mysqli_real_escape_string($conn, $_POST['country']);
	
	if(empty($country)){
	    $country = "-";
	}
	
	
	$likes = mysqli_real_escape_string($conn, $_POST['likes']);
	$uploads = mysqli_real_escape_string($conn, $_POST['uploads']);
	$viewsCount = mysqli_real_escape_string($conn, $_POST['viewsCount']);

	$subscriberCount = mysqli_real_escape_string($conn, $_POST['subscriberCount']);
	$hiddenSubscriberCount = mysqli_real_escape_string($conn, $_POST['hiddenSubscriberCount']);
	$videoCount = mysqli_real_escape_string($conn, $_POST['videoCount']);
	$privacyStatus = mysqli_real_escape_string($conn, $_POST['privacyStatus']);
	$isLinked = mysqli_real_escape_string($conn, $_POST['isLinked']);
	$longUploadStatus = mysqli_real_escape_string($conn, $_POST['longUploadStatus']);
	$madeForKids = mysqli_real_escape_string($conn, $_POST['madeForKids']);
	$channelContent = mysqli_real_escape_string($conn, $_POST['channelContent']);

	$primary_subcreation_url = "https://youtube.com/c/" . $channel_id;

	$genrateHash = new generateHash();
	$ac_id = $genrateHash->generatePrimaryACKey($email_id);

	$dp_username = substr($ac_id, 3, 25);
	$username = strtolower($dp_username);

	$token = $genrateHash->generateToeknSec($email_id);

	$ac_type = 1; // i means creator account
	$subcreation_type = 1; // subcreation type

	$primary_subcreation_id = $genrateHash->generateSubCreationId($primary_subcreation_url, $ac_id);

	// save into the primary_ac
	$sqlPrimaryAc = $conn->prepare("INSERT INTO `primary_ac`(`ac_id`, `ac_type`, `primary_email`, `username`, `dp_username`, 
											  `password`, `token_secret`) VALUES(?,?,?,?,?,?,?)");

	$sqlPrimaryAc->bind_param("sisssss", $ac_id, $ac_type, $email_id, $username, $dp_username, $password, $token);

	// save into the subcreation
	$sqlSubcreation = $conn->prepare("INSERT INTO `sub_creation`(`primary_ac`, `sub_creation_url`, `sub_creation_id`, `sub_creation_type`) VALUES(?,?,?,?)");

	$sqlSubcreation->bind_param("sssi", $ac_id, $primary_subcreation_url, $primary_subcreation_id, $subcreation_type);

	// save into users
	$sqlForUser = $conn->prepare("INSERT INTO users (email,primary_ac_id,previous_sponsors,
	channel_category,sponsor_type,given_name,name,pictures,family_name,locale,sub,channel_id,email_verified,primary_subcreation_url,primary_subcreation_id,username) 
	VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

	$sqlForUser->bind_param("sssiisssssssisss", $email_id, $ac_id, $previous_sponsor, $channel_category, $sponsor_type, $given_name, $name, $pictures, $family_name, $locale, $sub, $channel_id, $email_verified, $primary_subcreation_url, $primary_subcreation_id, $dp_username);

	// save into channel_details
	$searchableText = $channel_id . " --> " . $title . " --> " . $description . " --> " . $custom_url . " --> " . $published_at . " --> " . $country;
	$channelContent = addslashes($channelContent);

	$sqlForChannelDetail = $conn->prepare("INSERT INTO channel_detail (id, snippettitle, snippetdescription, snippetcustomUrl, snippetpublishedAt, snippetthumbnailsdefaulturl, snippetcountry, 
											contentDetailsrelatedPlaylistslikes, contentDetailsrelatedPlaylistsuploads, statisticsviewCount, statisticssubscriberCount, statisticshiddenSubscriberCount, 
											statisticsvideoCount, statusprivacyStatus, statusisLinked, statuslongUploadsStatus, statusmadeForKids, channel_type, searchable_text,owned_by) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$sqlForChannelDetail->bind_param(
		"sssssssssiiiisisiiss",
		$channel_id,
		$title,
		$description,
		$custom_url,
		$published_at,
		$thumbnail_url,
		$country,
		$likes,
		$uploads,
		$viewsCount,
		$subscriberCount,
		$hiddenSubscriberCount,
		$videoCount,
		$privacyStatus,
		$isLinked,
		$longUploadStatus,
		$madeForKids,
		$channel_category,
		$searchableText,
		$ac_id
	);

	try {
		// SQL QUERY
		$query = "SELECT sr_no FROM primary_ac WHERE primary_email='$email_id'";

		$result = $conn->query($query);

		// if there is no account associated with the give example create a new one 
		if ($result->num_rows == 0) {

			if ($sqlPrimaryAc->execute() && $sqlForUser->execute() && $sqlForChannelDetail->execute() && $sqlSubcreation->execute()) {

				session_start();
				$_SESSION['currentUsername'] = $username;
				$_SESSION['currentUser'] = $ac_id;
				$_SESSION['currentEmail'] = $email_id;
				$_SESSION['currentChannelId'] = $channel_id;
				$_SESSION['currentSubcreationId'] = $primary_subcreation_id;
				$_SESSION['userType'] = 1;

				$usersSql = "SELECT pictures FROM users  WHERE primary_ac_id='$ac_id'";
				$usersResult = $conn->query($usersSql);
				while ($userRow = $usersResult->fetch_assoc()) {
					$_SESSION['logo'] = $userRow['pictures'];

				}

				$message = new Message(1, true, "Account created successfully");
				echo $message->printMessage();

			} else {
				$message = new Message(2, false, "Failed to create account");
				echo $message->printMessage();
			}

			$_SESSION['registerCompleted'] = true;
		} else {
			if ($result->num_rows == 1) {
				$message = new Message(3, false, "Account already created");
				echo $message->printMessage();
			} else {
				$message = new Message(2, false, "Failed to create an account");
				echo $message->printMessage();

				$_SESSION['registerError'] = true;
			}
		}
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

} else {
	$message = new Message(4, false, "Something went wrong");
	echo $message->printMessage();
	exit();
}