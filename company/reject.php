<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
//This is required if user tries to manually enter view-job-post.php in URL.
if (empty($_SESSION['id_company'])) {
  header("Location: ../index.php");
  exit();
}

//Including Database Connection From misc/db.php file to avoid rewriting in all files  
require_once("../misc/db.php");

$sql = "SELECT * FROM apply_sponsorships WHERE id_company='$_SESSION[id_company]' AND id_user='$_GET[id]' AND sponsorship_id='$_GET[sponsorship_id]'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
  header("Location: index.php");
  exit();
}


$sql = "UPDATE apply_sponsorships SET status='1' WHERE id_company='$_SESSION[id_company]' AND id_user='$_GET[id]' AND sponsorship_id='$_GET[sponsorship_id]'";
if ($conn->query($sql) === TRUE) {
  header("Location: job-applications.php");
  exit();
}

?>