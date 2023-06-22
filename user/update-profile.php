<?php

//To Handle Session Variables on This Page
session_start();

if (empty($_SESSION['currentUser'])) {
	header("Location: ../index.php");
	exit();
}

//Including Database Connection From misc/db.php file to avoid rewriting in all files
require_once("../misc/db.php");

$currentUser = $_SESSION['currentUser'];

if (isset($_POST) && $_POST['actionType'] == 'checkUsername') {

	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$DPusername = strlen($username) > 4 && strlen($username) < 26 ? $username : false;

	$username = strtolower($DPusername);

	$sql = "SELECT username FROM primary_ac WHERE username = '$username'";
	$result = mysqli_query($conn, $sql);

	if (strlen($username) > 4 && strlen($username) < 26) {
		if ($result->num_rows > 0) {
			header('Content-Type: application/json; charset=utf-8');
			echo '{"code": 400,"message": "Not available"}';
		} else {
			header('Content-Type: application/json; charset=utf-8');
			echo '{"code": 200,"message": "This username is available"}';
		}
	} else {
		header('Content-Type: application/json; charset=utf-8');
		echo '{"code": 400,"status":"failed","message": "Username is greator or shorter than required"}';
	}

}
//if user Actually clicked update profile button
if (isset($_POST)) {
	if (isset($_POST["actionType"]) && $_POST["actionType"] == "updateBasicProfile") {
		//Escape Special Characters
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
		$phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
		$country = mysqli_real_escape_string($conn, $_POST['country']);
		$about_you = mysqli_real_escape_string($conn, $_POST['about_you']);
		$channel_category = mysqli_real_escape_string($conn, $_POST['channel_category']);
		$benefit = mysqli_real_escape_string($conn, $_POST['benefit']);
		$intro_video = mysqli_real_escape_string($conn, $_POST['intro_video']);

		$intro_video = substr($intro_video, stripos($intro_video, "v=") + 2, 11);

		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$DPusername = strlen($username) > 4 && strlen($username) < 26 ? $username : false;

		$username = strtolower($DPusername);

		$channel_category = (int) $channel_category;

		$sponsorship_type = mysqli_real_escape_string($conn, $_POST['sponsorship_type']);
		$sponsorship_type = (int) $sponsorship_type;

		if (!empty($username)) {

			// update username
			$sql = "UPDATE primary_ac SET username='$username', dp_username='$DPusername' WHERE ac_id='$currentUser'";

			if ($conn->query($sql) === TRUE) {
			    
			    // update username session
			    $_SESSION['currentUsername'] = $username;
			    
				//Update User Details Query
				$sql = "UPDATE users SET previous_sponsors='$about_you', channel_category=$channel_category, sponsor_type=$sponsorship_type, full_name='$fullname', contactno='$phone_number', country='$country', intro_video='$intro_video', benefit='$benefit' WHERE primary_ac_id='$currentUser'";

				// also update channel_category in channel details table
				$updateCategoryInChannelDetail = "UPDATE channel_detail SET channel_type=$channel_category WHERE owned_by='$currentUser'";
				$conn->query($updateCategoryInChannelDetail);

				if ($conn->query($sql) === TRUE) {
					$_SESSION['name'] = $email;
					//If data Updated successfully then redirect to dashboard
					echo "{'code': 200,'status': 'success'}";
					header("Location: index.php");
					exit();
				} else {
					header('Content-Type: application/json; charset=utf-8');
					echo '{"code": 400,"status": "failed"}';
				}
			} else {
				header('Content-Type: application/json; charset=utf-8');
				echo '{"code": 400,"status": "failed"}';
			}
		} else {
			header('Content-Type: application/json; charset=utf-8');
			echo '{"code": 400,"status": "failed"}';
		}


	}

	if (isset($_POST["actionType"]) and $_POST["actionType"] == "updateSocialProfile") {
		$facebook_username = mysqli_real_escape_string($conn, $_POST['facebook_username']);
		$twitter_username = mysqli_real_escape_string($conn, $_POST['twitter_username']);
		$instagram_username = mysqli_real_escape_string($conn, $_POST['instagram_username']);
		$youtube_username_1 = mysqli_real_escape_string($conn, $_POST['youtube_username_1']);
		$youtube_username_2 = mysqli_real_escape_string($conn, $_POST['youtube_username_2']);
		$youtube_username_3 = mysqli_real_escape_string($conn, $_POST['youtube_username_3']);
		$linkedin_username = mysqli_real_escape_string($conn, $_POST['linkedin_username']);
		$snapchat_username = mysqli_real_escape_string($conn, $_POST['snapchat_username']);
		$reddit_username = mysqli_real_escape_string($conn, $_POST['reddit_username']);
		$tiktok_username = mysqli_real_escape_string($conn, $_POST['tiktok_username']);
		$pinterest_username = mysqli_real_escape_string($conn, $_POST['pinterest_username']);
		$website = mysqli_real_escape_string($conn, $_POST['website']);

		// query to check if social link already exists
		$check_query = mysqli_query($conn, "SELECT channel_user_id FROM social_links where channel_user_id ='$currentUser'");

		if (mysqli_num_rows($check_query) == 0) {
			$sqlToInsert = $conn->prepare("INSERT INTO social_links (channel_user_id,facebook,twitter,reddit,instagram,youtube_1,youtube_2,youtube_3,
																	 tiktok,pinterest,linkedin,snapchat,website)
																	  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");

			$sqlToInsert->bind_param(
				"sssssssssssss",
				$currentUser,
				$facebook_username,
				$twitter_username,
				$reddit_username,
				$instagram_username,
				$youtube_username_1,
				$youtube_username_2,
				$youtube_username_3,
				$tiktok_username,
				$pinterest_username,
				$linkedin_username,
				$snapchat_username,
				$website

			);

			if ($sqlToInsert->execute()) {
				header('Content-Type: application/json; charset=utf-8');
				echo '{"code": 200,"status": "success", "message":"Successfully changed"}';
			} else {
				header('Content-Type: application/json; charset=utf-8');
				echo '{"code": 404,"status": "failed", "message":"Something went wrong.."}';
			}
		}

		if (mysqli_num_rows($check_query) == 1) {
			//Update User social link Query
			$sql = "UPDATE social_links SET facebook = '$facebook_username', twitter = '$twitter_username', reddit = '$reddit_username', instagram = '$instagram_username', 
				youtube_1 = '$youtube_username_1', youtube_2 = '$youtube_username_2', youtube_3 = '$youtube_username_3',
				tiktok = '$tiktok_username', pinterest = '$pinterest_username', linkedin = '$linkedin_username', snapchat = '$snapchat_username', 
                  website='$website' WHERE channel_user_id='$currentUser'";

			if ($conn->query($sql) === TRUE) {
				//If data Updated successfully then redirect to dashboard
				header('Content-Type: application/json; charset=utf-8');
				echo '{"code": 200,"status": "success", "message":"updated successfully"}';
			} else {
				header('Content-Type: application/json; charset=utf-8');
				echo '{"code": 404,"status": "failed", "message":"Something went wrong failed"}';
			}
		}

	}

	if (isset($_POST["actionType"]) and $_POST["actionType"] == "updatePassword") {
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
		$phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
		$country = mysqli_real_escape_string($conn, $_POST['country']);
		$about_you = mysqli_real_escape_string($conn, $_POST['about_you']);
		$channel_category = mysqli_real_escape_string($conn, $_POST['channel_category']);
		$channel_category = (int) $channel_category;

		$sponsorship_type = mysqli_real_escape_string($conn, $_POST['sponsorship_type']);
		$sponsorship_type = (int) $sponsorship_type;

		//Update User Details Query
		$sql = "UPDATE users SET previous_sponsors='$about_you', channel_category=$channel_category, sponsor_type=$sponsorship_type, full_name='$fullname', contactno='$phone_number', country='$country'  WHERE primary_ac_id='$currentUser'";

		if ($conn->query($sql) === TRUE) {
			//If data Updated successfully then redirect to dashboard
			header('Content-Type: application/json; charset=utf-8');
			echo trim('{"code": 200,"status": "success", "message":"updated successfully"}');
			exit();
		} else {
			header('Content-Type: application/json; charset=utf-8');
			echo '{"code": 400,"status": "failed"}';
		}

	}

} else {
	//redirect them back to dashboard page if they didn't click update button
	header("Location: edit-profile.php");
	exit();
}