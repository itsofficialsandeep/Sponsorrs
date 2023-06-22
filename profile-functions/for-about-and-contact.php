<?php
include_once("../misc/functions.php");

session_start();

// apply creators
if (isset($_POST['message']) && !empty($_POST['message']) && strlen($_POST['message']) < 601 && isset($_POST['actionToken']) && $_POST['action'] == 1) {

    // $_POST['actionToken'] == ""

    if (1) {
        include("../misc/db.php");

        $message = $_POST['message'];
        $currentUser = $_SESSION['currentUser'];
        $name = $_SESSION['name'] = 'anonymous1234';

        $query = $conn->prepare("INSERT INTO `customer_feedback`(`ac_id`, `name`, `message`) VALUES (?,?,?)");
        $query->bind_param('sss', $currentUser, $name, $message);
        if ($query->execute()) {
            $message = new message(200, "success", "Feedback sent successfully");
            $message->printMessage();
        } else {
            $message = new message(400, "failed!", "Something went wrong!");
            $message->printMessage();
        }
        $query->close();
    } else {
        $message = new message(400, "failed..", "Something went wrong!");
        $message->printMessage();
    }
} else {
    $message = new message(400, "failed...", "Something went wrong!");
    $message->printMessage();
}

?>