<?php

//To Handle Session Variables on This Page
session_start();

if (empty($_SESSION['currentUser'])) {
    header("Location: ../index.php");
    exit();
}

// Include library files 
require '../exp/PHPMailer/Exception.php';
require '../exp/PHPMailer/PHPMailer.php';
require '../exp/PHPMailer/SMTP.php';

// Import PHPMailer classes into the global namespace 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require_once('../../sponsorrs_config/config.php');

//Including Database Connection From misc/db.php file to avoid rewriting in all files
require_once("../misc/db.php");
require_once("../misc/functions.php");
include_once("../pay/razorpay-php/Razorpay.php");

use message;
use Razorpay\Api\Errors\SignatureVerificationError;
use Razorpay\Api\Api;

$razorpay = new Api('rzp_test_kqdrez1FZqQ1qs', 'mA7pb3YTNtQW8AGLXxf0oa6O');

//if user Actually clicked update profile button
if (isset($_POST)) {
    if (isset($_POST["actionType"]) and $_POST["actionType"] == "updatePassword") {

        $check_query = mysqli_query($conn, "SELECT password FROM primary_ac where ac_id ='$currentUser'");

        $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
        $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
        $password = password_hash($confirm_password, PASSWORD_DEFAULT);

        if ($new_password != $current_password and !empty($confirm_password) and !empty($password) and !empty($current_password)) {
            if (!mysqli_num_rows($check_query) == 0) {
                while ($row = mysqli_fetch_assoc($check_query)) {
                    if (password_verify($current_password, $row['password'])) {
                        $query = mysqli_query($conn, "UPDATE primary_ac SET password = '$password' WHERE ac_id ='$currentUser'");
                        if ($query) {
                            $message = new message(200, "success", "updated successfully");
                            $message->printMessage();
                        } else {
                            $message = new message(404, "failed", "You are typing your current password wrong!");
                            $message->printMessage();
                        }
                    } else {
                        $message = new message(405, "failed", "You are typing your current password wrong!");
                        $message->printMessage();
                    }
                }
            } else {
                $message = new message(400, "failed", "Something went wrong. Please try again");
                $message->printMessage();
            }
        } else {
            $message = new message(400, "failed", "Something went wrong. Please try again");
            $message->printMessage();
        }
    } elseif ($_POST['actionType'] == 'updatePaymentInfo') {

        $currentUser = $_SESSION['currentUser'];
        $businessName = substr(mysqli_real_escape_string($conn, $_POST['businessname']), 0, 100);
        $businessType = substr(mysqli_real_escape_string($conn, $_POST['business_type']), 0, 19);
        $IFSC_code = substr(mysqli_real_escape_string($conn, $_POST['IFSC_code']), 0, 11);
        $accountNumber = substr(mysqli_real_escape_string($conn, $_POST['account_number']), 0, 20);
        $beneficiaryName = substr(mysqli_real_escape_string($conn, $_POST['beneficiary_name']), 0, 50);
        $gender = substr(mysqli_real_escape_string($conn, $_POST['gender']), 0, 1);
        $dateOfBirth = substr(mysqli_real_escape_string($conn, $_POST['DateOfBirth']), 0, 10);
        $email = substr(mysqli_real_escape_string($conn, $_POST['email']), 0, 50);
        $mobile = substr(mysqli_real_escape_string($conn, $_POST['mobile']), 0, 14);
        $address = substr(mysqli_real_escape_string($conn, $_POST['address']), 0, 300);
        $country = substr(mysqli_real_escape_string($conn, $_POST['country']), 0, 1);
        $city = substr(mysqli_real_escape_string($conn, $_POST['city']), 0, 1);

        $state = substr(mysqli_real_escape_string($conn, $_POST['state']), 0, 1);
        $zip = substr(mysqli_real_escape_string($conn, $_POST['zipCode']), 0, 9);
        $actionType = mysqli_real_escape_string($conn, $_POST['actionType']);

        $query = mysqli_query($conn, "SELECT email FROM payment_account_details WHERE ac_id = '$currentUser'");
        if (mysqli_num_rows($query) == 0) {

            // create a razarpay linked account
            $linked_account = createRzpLinkedAccount($businessName, $email, $mobile, $IFSC_code, $accountNumber, $beneficiaryName, "https://api.razorpay.com/v2/accounts");

            if (isset($linked_account->error->code) && $linked_account->error->code == "BAD_REQUEST_ERROR") {
                $message = new message(400, "failed", "failed to add account!");
                $message->printMessage();
            } elseif ($linked_account->status == "created") {

                // add account detaild tp db
                $sqlAccountDetail = $conn->prepare("INSERT INTO payment_account_details (
                                            business_name,business_type,ifsc_code,account_number,beneficiary_name,
                                            gender,dob,email,phone_number,address,country,state,city,zipcode,primary_ac_id,rzp_ac_id,ac_type)
                                            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

                $sqlAccountDetail->bind_param(
                    "sssisisssssssis",
                    $businessName,
                    $businessType,
                    $IFSC_code,
                    $accountNumber,
                    $beneficiaryName,
                    $gender,
                    $dateOfBirth,
                    $email,
                    $mobile,
                    $address,
                    $country,
                    $state,
                    $city,
                    $zip,
                    $currentUser,
                    $linked_account->id,
                    $ac_type
                );

                // add account detaild to db
                $sqlRzpAccountDetail = $conn->prepare("INSERT INTO `rzp_linked_accounts`(`id`, `entity`, `account_number`, 
                                                    `bank_name`, `branch_name`, `ifsc`, `contact_id`, `contact_type`, `type`, 
                                                    `status`, `created_at`, `primary_ac_id`,json_response)
                                            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");

                $sqlRzpAccountDetail->bind_param(
                    "ssssssssssiss",
                    $linked_account->id,
                    $linked_account->entity,
                    $linked_account->account_number,
                    $linked_account->bank_name,
                    $linked_account->branch_name,
                    $linked_account->ifsc,
                    $linked_account->contact_id,
                    $linked_account->contact_type,
                    $linked_account->type,
                    $linked_account->status,
                    $linked_account->created_at,
                    $linked_account->primary_ac_id,
                    json_encode($linked_account)
                );


                if ($sqlAccountDetail->execute() === FALSE or $sqlRzrAccountDetail->execute() === FALSE) {
                    $message = new message(400, "failed", "Something went wrong. Please try again");
                    $message->printMessage();
                } else {
                    $message = new message(200, "success", "Successfully added details!");
                    $message->printMessage();
                }
            }

        } else {
            // create a razarpay linked account
            $linked_account = createRzpLinkedAccount($businessName, $email, $mobile, $IFSC_code, $accountNumber, $beneficiaryName, "https://api.razorpay.com/v2/accounts" . $RzpLinkedAccountId);

            if (isset($linked_account->error->code) && $linked_account->error->code == "BAD_REQUEST_ERROR") {
                $message = new message(400, "failed", "failed to add account!");
                $message->printMessage();
            } elseif ($linked_account->status == "created") {

                $sqlAccountDetail = $conn->prepare("UPDATE payment_account_details SET business_name=?,business_type=?,ifsc_code=?,account_number=?,
                    beneficiary_name=?,gender=?,dob=?,email=?,phone_number=?,address=?,country=?,state=?,city=?,zipcode=? WHERE primary_ac_id=?");

                $sqlAccountDetail->bind_param(
                    "sssisisssssssii",
                    $businessName,
                    $businessType,
                    $IFSC_code,
                    $accountNumber,
                    $beneficiaryName,
                    $gender,
                    $dateOfBirth,
                    $email,
                    $mobile,
                    $address,
                    $country,
                    $state,
                    $city,
                    $zip,
                    $currentUser
                );

                // update table 'rzp_linked_accounts'
                $rzp_linked_accounts = $conn->prepare("UPDATE rzp_linked_accounts SET entity=?,account_number=?,bank_name=?,branch_name=?,
                                         ifsc=?,contact_id=?,contact_type=?,type=?,status=? WHERE id=?");

                $rzp_linked_accounts->bind_param(
                    "ssssssssss",
                    $linked_account->entity,
                    $linked_account->account_number,
                    $linked_account->bank_name,
                    $linked_account->branch_name,
                    $linked_account->ifsc,
                    $linked_account->contact_id,
                    $linked_account->contact_type,
                    $linked_account->type,
                    $linked_account->status
                );


                if ($sqlAccountDetail->execute() === FALSE or $rzp_linked_accounts->execute() === FALSE) {
                    $message = new message(400, "failed", "Something went wrong. Please try again");
                    $message->printMessage();
                } else {
                    $message = new message(200, "success", "Successfully updated details!");
                    $message->printMessage();
                }
            }
        }
    }
}

// this function will add bank ac to razorpay linked accounts
function createRzpLinkedAccount($businessName, $email, $phone, $IFSC_code, $accountNumber, $beneficiaryName, $url)
{
    $headr = array();
    $headr[] = 'Content-type: application/json';

    $body = json_encode('[ "type" => "route", "business_type" => "individual", "contact" => [ "name" => "' . $businessName . '",
                            "email" => "' . $email . '", "phone" => ' . $phone . ', ], "bank_account" => [ "name" => "' . $beneficiaryName . '", 
                            "ifsc" => "' . $IFSC_code . '", "account_number" => ' . $accountNumber . ']]');
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_USERPWD, 'rzp_test_kqdrez1FZqQ1qs' . ":" . 'mA7pb3YTNtQW8AGLXxf0oa6O');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);

    $result = curl_exec($ch);

    curl_close($ch);
    return $result;
}

if (isset($_POST) && $_POST['actionType'] == 'mail') {

    $token = $_POST['token'];
    $currentUser = $_SESSION['currentUser'];
    $currentMail = $_SESSION['currentEmail'];
    $mail = $_POST['mail'];

    // Generate 8-digit OTP code
    $otp = rand(10000000, 99999999);
    $otpHash = hash('sha512', $otp);
    $_SESSION['otp_in_session'] = $otpHash;

    if (1) {

        // Create an instance; Pass `true` to enable exceptions 
        $mail = new PHPMailer;

        // Server settings 
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;    //Enable verbose debug output 
        //$mail->isSMTP(); // Set mailer to use SMTP 
        $mail->Host = 'mail.sponsorrs.com'; // Specify main and backup SMTP servers 
        $mail->SMTPAuth = true; // Enable SMTP authentication 
        $mail->Username = 'contact@sponsorrs.com'; // SMTP username 
        $mail->Password = MAILPASSWORD; // SMTP password 

        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted 
        $mail->Port = 465; // TCP port to connect to 

        // Sender info 
        $mail->setFrom('contact@sponsorrs.com', 'Sponsorrs.com'); //

        // Add a recipient 
        $mail->addAddress($currentMail);

        //$mail->addCC('cc@example.com'); 
        //$mail->addBCC('bcc@example.com'); 

        // Set email format to HTML 
        $mail->isHTML(true);

        // Mail subject 
        $mail->Subject = 'OTP to change email address';

        // Mail body content 
        $bodyContent = '<h1>' . $otp . '</h1>';
        $bodyContent .= '<p>Use the above otp to change your E-Mail address</p>';
        $mail->Body = $bodyContent;

        // Send email 
        if (!$mail->send()) {
            // echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            $message = new message(200, "success", "OTP sent successfully");
            $message->printMessage();
        } else {
            $message = new message(400, "success", "Something went wrong!");
            $message->printMessage();
        }

    }

}

if (isset($_POST) && $_POST['actionType'] == 'otp') {

    $token = $_POST['token'];
    $otp = $_POST['otp'];

    $otphash = hash('sha512', $otp);
    $userType = $_SESSION['userType'];
    $currentUser = $_SESSION['currentUser'];
    $mail = $_POST['newmail'];

    if (1) {
        if ($otphash == $_SESSION['otp_in_session']) {

            $mysql = $conn->prepare("UPDATE primary_ac SET primary_email=? WHERE ac_id=?");
            $mysql->bind_param("ss", $mail, $currentUser);

            $mysql->execute();

            if ($mysql->affected_rows > 0) {
                $message = new message(200, "success", "Email updated successfully");
                $message->printMessage();
            } else {
                $message = new message(300, "failed", "Failed to update email at the moment.");
                $message->printMessage();
            }

        } else {
            $message = new message(300, "failed", "OTP verification failed");
            $message->printMessage();
        }

    }

}