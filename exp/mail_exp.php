<?php
// Import PHPMailer classes into the global namespace 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Include library files 
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Create an instance; Pass `true` to enable exceptions 
$mail = new PHPMailer;

// Server settings 
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;    //Enable verbose debug output 
//$mail->isSMTP(); // Set mailer to use SMTP 
$mail->Host = 'mail.sponsorrs.com'; // Specify main and backup SMTP servers 
$mail->SMTPAuth = true; // Enable SMTP authentication 
$mail->Username = '	contact@sponsorrs.com'; // SMTP username 
$mail->Password = '#Sksandeepsharma25*'; // SMTP password 
$mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted 
$mail->Port = 465; // TCP port to connect to 

// Sender info 
$mail->setFrom('	contact@sponsorrs.com', 'sandeep from localhost');
$mail->addReplyTo('	contact@sponsorrs.com', 'SenderName');

// Add a recipient 
$mail->addAddress('sksandeepsharma25@gmail.com');

//$mail->addCC('cc@example.com'); 
//$mail->addBCC('bcc@example.com'); 

// Set email format to HTML 
$mail->isHTML(true);

// Mail subject 
$mail->Subject = 'Email from Localhost by CodexWorld';

// Mail body content 
$bodyContent = '<h1>How to Send Email from Localhost using PHP by CodexWorld</h1>';
$bodyContent .= '<p>This HTML email is sent from the localhost server using PHP by <b>CodexWorld</b></p>';
$mail->Body = $bodyContent;

// Send email 
if (!$mail->send()) {
     echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
 } else {
     echo 'Message has been sent.';
 }


?>








