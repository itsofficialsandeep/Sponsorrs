<?php

//To Handle Session Variables on This Page
session_start();

if (empty($_SESSION['id_company'])) {
	header("Location: ../index.php");
	exit();
}

//Including Database Connection From misc/db.php file to avoid rewriting in all files
require_once("../misc/db.php");

//if user Actually clicked Add Post Button
if (isset($_POST)) {

	// New way using prepared statements. This is safe from SQL INJECTION. Should consider to update to this method when many people are using this method.

	$stmt = $conn->prepare("INSERT INTO job_post(id_company, sponsorship_title, description, minimumsalary, offer_price, experience, qualification, service, adtype, adcategory) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("isssssssss", $_SESSION['id_company'], $sponsorship_title, $description, $minimumsalary, $offer_price, $experience, $qualification, $service, $adtype, $adcatgory);

	$sponsorship_title = mysqli_real_escape_string($conn, $_POST['sponsorship_title']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$minimumsalary = mysqli_real_escape_string($conn, $_POST['minimumsalary']);
	$offer_price = mysqli_real_escape_string($conn, $_POST['offer_price']);
	$experience = mysqli_real_escape_string($conn, $_POST['experience']);
	$qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
	$service = mysqli_real_escape_string($conn, $_POST['product']);
	$adcatgory = mysqli_real_escape_string($conn, $_POST['category']);
	$adtype = mysqli_real_escape_string($conn, $_POST['adtype']);

	if ($service == 1) {
		$service = "product";
	} else if ($service = 2) {
		$service = "service";
	}

	switch ($adcatgory) {
		case 0:
			$adcatgory = "Technical";
		case 1:
			$adcatgory = "Commercial";
		case 2:
			$adcatgory = "Vlogger";
		case 3:
			$adcatgory = "Educator";
		case 4:
			$adcatgory = "Photography & Videography";
		case 5:
			$adcatgory = "Gaming";
		case 6:
			$adcatgory = "Fitnes";
		case 7:
			$adcatgory = "Political Satire";
		case 8:
			$adcatgory = "Comedy Shows";
		case 9:
			$adcatgory = "Makeup";
		case 10:
			$adcatgory = "Experiment";
		case 11:
			$adcatgory = "Toy Reviews";
		case 12:
			$adcatgory = "Food";
		case 13;
			$adcatgory = "Clothe";
	}

	switch ($adtype) {
		case 1:
			$adtype = "Type 1";
		case 2:
			$adtype = "Type 2";
		case 3:
			$adtype = "Type 3";
		case 4:
			$adtype = "Type 4";
		case 5:
			$adtype = "Type 5";
		case 6:
			$adtype = "Type 6";
	}


	$fullText = $sponsorship_title . " | " . strip_tags($description) . " | " . $minimumsalary . " | " . $service . " | " . $adcatgory . " | " . $adtype;

	// this part insert all data into a single column for full search
	$autoIncrementFromJobPost = $conn->query("SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'jobportal' AND   TABLE_NAME   = 'job_post';");
	while ($row = $autoIncrementFromJobPost->fetch_assoc()) {
		$incrementValue = $row['AUTO_INCREMENT'];
		$stmt2 = mysqli_query($conn, "INSERT INTO sponsorship_search (id_job,full_text) VALUES ($incrementValue, '$fullText')");
		echo $incrementValue . "*";
		echo $fullText;
		mysqli_error($conn);
	}

	if ($stmt->execute()) {
		//If data Inserted successfully then redirect to dashboard
		$_SESSION['jobPostSuccess'] = true;
		//header("Location: index.php");
		exit();
	} else {
		//If data failed to insert then show that error. Note: This condition should not come unless we as a developer make mistake or someone tries to hack their way in and mess up :D
		echo "Error ";
	}

	$stmt->close();

	//THIS IS NOT SAFE FROM SQL INJECTION BUT OK TO USE WITH SMALL TO MEDIUM SIZE AUDIENCE

	//Insert Job Post Query 
	// $sql = "INSERT INTO job_post(id_company, sponsorship_title, description, minimumsalary, offer_price, experience, qualification) VALUES ('$_SESSION[id_company]','$sponsorship_title', '$description', '$minimumsalary', '$offer_price', '$experience', '$qualification')";

	// if($conn->query($sql)===TRUE) {
	// 	//If data Inserted successfully then redirect to dashboard
	// 	$_SESSION['jobPostSuccess'] = true;
	// 	header("Location: dashboard.php");
	// 	exit();
	// } else {
	// 	//If data failed to insert then show that error. Note: This condition should not come unless we as a developer make mistake or someone tries to hack their way in and mess up :D
	//             header('Content-Type: application/json; charset=utf-8');
	// echo '{"code": 400,"status": "failed"}';
	// }

	//Close database connection. Not compulsory but good practice.
	$conn->close();

} else {
	//redirect them back to dashboard page if they didn't click Add Post button
	header("Location: create-job-post.php");
	exit();
}