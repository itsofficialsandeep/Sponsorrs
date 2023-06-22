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

    $sql = "SELECT username from primary_ac where username = '$username'";
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
    if (isset($_POST["actionType"]) and $_POST["actionType"] == "updateBasicProfile") {
        //Escape Special Characters
        $email = substr(mysqli_real_escape_string($conn, $_POST['email']), 0, 255);
        $companyname = substr(mysqli_real_escape_string($conn, $_POST['company_name']), 0, 255);
        $phone_number = substr(mysqli_real_escape_string($conn, $_POST['phone_number']), 0, 15);
        $country = substr(mysqli_real_escape_string($conn, $_POST['country']), 0, 50);
        $state = substr(mysqli_real_escape_string($conn, $_POST['state']), 0, 50);
        $city = substr(mysqli_real_escape_string($conn, $_POST['city']), 0, 50);
        $about_you = substr(mysqli_real_escape_string($conn, $_POST['about_you']), 0, 500);
        $industry = substr(mysqli_real_escape_string($conn, $_POST['company_industry']), 0, 2);
        $benefit = substr(mysqli_real_escape_string($conn, $_POST['benefit']), 0, 600);
        $intro_video = mysqli_real_escape_string($conn, $_POST['intro_video']);

        $intro_video = substr($intro_video, stripos($intro_video, "v=") + 2, 11);

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $DPusername = strlen($username) > 4 && strlen($username) < 26 ? $username : false;

        $username = strtolower($DPusername);

        $industry = (int) $industry;

        if (!empty($username)) {

            // update username
            $sql = "UPDATE primary_ac SET username='$username', dp_username='$DPusername' WHERE ac_id='$currentUser'";

            if ($conn->query($sql) === TRUE) {
                //Update User Details Query
                $sql = "UPDATE company SET companyname='$companyname',  country='$country',  state='$state',  city='$city',  contactno='$phone_number', email='$email', aboutme='$about_you', industry=$industry, benefit='$benefit', intro_video='$intro_video' WHERE primary_ac_id='$currentUser'";

                if ($conn->query($sql) === TRUE) {
                    $_SESSION['currentUsername'] = $username;

                    header('Content-Type: application/json; charset=utf-8');
                    echo '{"code": 200,"status": "success"}';
                    exit();
                } else {
                    header('Content-Type: application/json; charset=utf-8');
                    echo '{"code": 400,"status": "failed"}';
                }
            } else {
                header('Content-Type: application/json; charset=utf-8');
                echo '{"code": 400,"status": "failed"}';
            }
        }

    }


    if (isset($_POST["actionType"]) && $_POST["actionType"] == "updateSocialProfile") {
        $facebook_username = substr(mysqli_real_escape_string($conn, $_POST['facebook_username']), 0, 100);
        $twitter_username = substr(mysqli_real_escape_string($conn, $_POST['twitter_username']), 0, 50);
        $instagram_username = substr(mysqli_real_escape_string($conn, $_POST['instagram_username']), 0, 50);
        $youtube_username_1 = substr(mysqli_real_escape_string($conn, $_POST['youtube_username_1']), 0, 50);
        $youtube_username_2 = substr(mysqli_real_escape_string($conn, $_POST['youtube_username_2']), 0, 50);
        $youtube_username_3 = substr(mysqli_real_escape_string($conn, $_POST['youtube_username_3']), 0, 50);
        $linkedin_username = substr(mysqli_real_escape_string($conn, $_POST['linkedin_username']), 0, 50);
        $snapchat_username = substr(mysqli_real_escape_string($conn, $_POST['snapchat_username']), 0, 20);
        $reddit_username = substr(mysqli_real_escape_string($conn, $_POST['reddit_username']), 0, 50);
        $tiktok_username = substr(mysqli_real_escape_string($conn, $_POST['tiktok_username']), 0, 50);
        $pinterest_username = substr(mysqli_real_escape_string($conn, $_POST['pinterest_username']), 0, 50);
        $website = substr(mysqli_real_escape_string($conn, $_POST['website']), 0, 50);

        // query to check if social link already exists
        $check_query = mysqli_query($conn, "SELECT channel_user_id FROM social_links where channel_user_id ='$currentUser'");

        if (mysqli_num_rows($check_query) == 0) {
            $sqlToInsert = $conn->prepare("INSERT INTO social_links (channel_user_id,facebook,twitter,reddit,instagram,youtube_1,youtube_2,youtube_3,
																	 tiktok,pinterest,linkedin,website,snapchat)
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
                $website,
                $snapchat_username
            );

            if ($sqlToInsert->execute()) {
                header('Content-Type: application/json; charset=utf-8');
                echo '{"code": 404,"status": "failed", "message":"Something went wrong failed"}';
            }
        }

        // if user exists
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
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        //Update User Details Query
        $sql = "UPDATE primary_ac SET password='$password' WHERE primary_ac_id='$currentUser'";

        if ($conn->query($sql) === TRUE) {
            //If data Updated successfully then redirect to dashboard
            header('Content-Type: application/json; charset=utf-8');
            echo trim('"code": 200,"status": "success", "message":"updated successfully"');
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