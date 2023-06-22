<?php

//To Handle Session Variables on This Page
session_start();

if (empty($_SESSION['currentUser'])) {
    header("Location: ../index.php");
    exit();
}

//Including Database Connection From misc/db.php file to avoid rewriting in all files
require_once("../misc/db.php");
require_once("../misc/functions.php");

$currentUser = $_SESSION['currentUser'];

if (isset($_POST) && $_POST['actionType']) {
    if ($_POST["actionType"] == "create") {
        //Escape Special Characters
        $title = substr(mysqli_real_escape_string($conn, $_POST['sponsorship_title']), 0, 255);
        $description = substr(mysqli_real_escape_string($conn, $_POST['sponsorship_description']), 0, 255);
        $category = (int) substr(mysqli_real_escape_string($conn, $_POST['sponsorship_category']), 0, 15);
        $type = (int) substr(mysqli_real_escape_string($conn, $_POST['sponsorship_type']), 0, 50);
        $price = (int) substr(mysqli_real_escape_string($conn, $_POST['offer_price']), 0, 50);
        $service = (int) substr(mysqli_real_escape_string($conn, $_POST['product_service']), 0, 50);

        $generateHash = new generateHash();
        $sponsorship_id = $generateHash->generateSponsorshipId($currentUser, random_bytes(80), random_bytes(60));

        $sql = $conn->prepare("INSERT INTO `sponsorships`(`sponsorship_id`,`id_company`, `sponsorship_title`, `description`, 
                                                            `offer_price`, `service`, `adtype`, `adcategory`) 
                                VALUES (?,?,?,?,?,?,?,?) ");
        $sql->bind_param("ssssiiii", $sponsorship_id, $currentUser, $title, $description, $price, $service, $type, $category);

        if ($sql->execute()) {
            header('Content-Type: application/json; charset=utf-8');
            echo '{"code": 200,"status": "success"}';
        } else {
            header('Content-Type: application/json; charset=utf-8');
            echo '{"code": 400,"status": "failed"}';
        }
    }

    if ($_POST["actionType"] == "update") {
        $sponsorship_id = substr(mysqli_real_escape_string($conn, $_POST['sponsorship_id']), 0, 50);
        $sponsorship_title = substr(mysqli_real_escape_string($conn, $_POST['sponsorship_title']), 0, 100);
        $description = substr(mysqli_real_escape_string($conn, $_POST['sponsorship_description']), 0, 300);
        $offer_price = (int) substr(mysqli_real_escape_string($conn, $_POST['offer_price']), 0, 9);
        $service = (int) substr(mysqli_real_escape_string($conn, $_POST['product_service']), 0, 1);
        $adtype = (int) substr(mysqli_real_escape_string($conn, $_POST['sponsorship_type']), 0, 1);
        $adcategory = (int) substr(mysqli_real_escape_string($conn, $_POST['sponsorship_category']), 0, 1);
        $delete = (int) substr(mysqli_real_escape_string($conn, $_POST['delete']), 0, 1);

        $var = $sponsorship_id . " title:" . $sponsorship_title . " desc:" . $description . " price:" . $offer_price . " product:" . $service . " cate:" . $adcategory . " type:" . $adtype . " del:" . $delete;

        $sql = $conn->prepare("UPDATE sponsorships SET sponsorship_title=?, description=?, offer_price=?, service=?, 
                                adtype=?, adcategory=?, active=? WHERE sponsorship_id=?");
        $sql->bind_param("ssiiiiis", $sponsorship_title, $description, $offer_price, $service, $adtype, $adcategory, $delete, $sponsorship_id);
        $sql->execute();

        if ($sql->affected_rows > 0) {
            header('Content-Type: application/json; charset=utf-8');
            echo '{"code": 500,"status": "success","message":"' . $sql->affected_rows . '"}';
        } else {
            header('Content-Type: application/json; charset=utf-8');
            echo '{"code": 600,"status": "' . $var . '","message":"' . $sql->affected_rows .
                '"}';
        }

    }


    if (isset($_POST["actionType"]) && $_POST["actionType"] == "updatePassword") {
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