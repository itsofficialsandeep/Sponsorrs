<?php
session_Start();

include("misc/db.php");
include("misc/config.php");


// routing to username to show profile page
//=====================================================================================================
$explode = explode("@", $_SERVER['REQUEST_URI']);
$username = $explode[1];

if (isset($username)) {
	// sanitize username
	$username = mysqli_real_escape_string($conn, substr(strtolower($username), 0, 30));

	// get the data about the loaded username
	$primaryData = $conn->prepare("SELECT ac_id,ac_type,primary_email,username,dp_username FROM primary_ac where username=? AND active=1");
	$primaryData->bind_param("s", $username);

	try {
		$primaryData->execute();
		$results = $primaryData->get_result();

		$totalResults = $results->num_rows;

		// if there is user
		if ($totalResults == 1) {
			$row = $results->fetch_assoc();

			session_start();

			if ($_SESSION['currentUsername'] == $row['username']) {
				$loggedInSameUser = TRUE;
			}

			// load only brand page if logged-in user is creator of vice-versa
			if ($_SESSION['userType'] == 1) {
				if ($row['ac_type'] == 2 || $loggedInSameUser) {
					$id_company = $row['ac_id']; // $id_company will be used by brand-details.php
					include_once("brand-details.php");
					exit();
				} else {
					header("Location: " . $domain);
				}
			} elseif ($_SESSION['userType'] == 2) {
				if ($row['ac_type'] == 1 || $loggedInSameUser) {
					// get the data about the loaded username
					$channelData = $conn->prepare("SELECT channel_id from users where primary_ac_id=?");
					$channelData->bind_param("s", $row['ac_id']);
					$channelData->execute();
					$channelDataResults = $channelData->get_result();

					$channelDataRow = $channelDataResults->fetch_assoc();
					$channel = $channelDataRow['channel_id']; // $channel will be used by channel-details.php

					include_once("channel-details.php");
					exit();
				} else {
					header("Location: " . $domain);
				}
			}
		} else {
			header("Location: " . $domain);
		}
	} catch (\Throwable $th) {
		echo "Something went wrong..";
	}
}


//===========================================================================================================================
//include_once("profile-functions/for-index.php");
include_once("misc/functions.php");

include("misc/db.php");

//abp uncomment the following

// // get total number of creators
// $result1 = $conn->query("SELECT COUNT(ac_id) as total_creator FROM `primary_ac` WHERE ac_type=0");

// while ($row = $result1->fetch_assoc()) {

// 	$total_creators = $row['total_creator'];
// }

// // get total number of brands
// $result2 = $conn->query("SELECT COUNT(ac_id) as total_brand FROM `primary_ac` WHERE ac_type=1");

// $total_brands = null;

// while ($row = $result2->fetch_assoc()) {
// 	$total_brands = $row['total_brand'];
// }

// // get total number of sponsorhips
// $result3 = $conn->query("SELECT COUNT(sponsorship_id) as total_sponsorships FROM sponsorships");

// $total_sponsorships = null;

// while ($row = $result3->fetch_assoc()) {
// 	$total_sponsorships = $row['total_sponsorships'];
// }

// //get total amount disbursed
// $result3 = $conn->query("SELECT SUM(amount) as total_amount from payment_details where status='captured'");

// $total_amount = null;

// if ($row = $result3->fetch_assoc()) {
// 	$total_amount = $row['total_amount'];
// }

// $dir = explode(",", "admin,assets,common_ui,company,css,docs,exp,img,js,login,misc,profile-functions,progress,sass,sql,sr,uploads,user,z1");
// if (in_array($username, $dir)) {} else {echo "Something went wrong";}


?>

<!DOCTYPE html>
<html lang="en">

<!-- index.html  11 Feb 2023 14:24:14 GMT -->

<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-KRL58MWH94"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-KRL58MWH94');
</script>
	<title>Sponsorrs - Sponsorships for YouTube channels & Creators</title>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="https://sponsorrs.com">
	<meta name="description"
		content="Sponsorrs - Sponsorships for youtube channels. A marketplace for Content Creators and Brands.">

	<meta property="og:title" content="Sponsorrs - Sponsorships for YouTube channels & Creators">
	<meta property="og:description"
		content="Sponsorship platform for youtube channels. A marketplace for Content Creators and Brands.">
	<meta property="og:image" content="assets/images/flaticon/sponsorrs_rect.png">
	<meta name="google-site-verification" content="uMBXEgTmK556qxG6WN-WSLilK0s_BV00bIExkdOyygU" />

	<?php include_once("common_ui/dark-mode.php"); ?>

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/images/flaticon/sponsorrs_rect.png">

	<link rel="icon" href="assets/images/flaticon/sponsorrs_rect.png" type="image/x-icon">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&amp;family=Roboto:wght@400;500;700&amp;display=swap">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="assets/vendor/font-awesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-icons/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/tiny-slider/tiny-slider.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/glightbox/css/glightbox.css">

	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

	<!-- jQuery 3 -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>

	<!-- Header START -->
	<?php include_once('common_ui/header.php'); ?>
	<!-- Header END -->

	<!-- **************** MAIN CONTENT START **************** -->
	<main>

		<!-- ======================= Main Banner START -->
		<section class="position-relative overflow-hidden pt-5 pt-lg-3">

			<!-- Content START -->
			<div class="container">
				<!-- Title -->
				<div class="row align-items-center g-5">
					<!-- Left content START -->
					<div class="col-lg-5 col-xl-6 position-relative z-index-1 text-center text-lg-start mb-5 mb-sm-0">

						<!-- SVG -->
						<figure class="fill-success position-absolute top-0 start-50 translate-middle-x mt-n5 ms-5">
							<svg width="22px" height="21px">
								<path
									d="M10.717,4.757 L14.440,-0.001 L14.215,6.023 L20.142,4.757 L16.076,9.228 L21.435,12.046 L15.430,12.873 L17.713,18.457 L12.579,15.252 L10.717,20.988 L8.856,15.252 L3.722,18.457 L6.005,12.873 L-0.000,12.046 L5.359,9.228 L1.292,4.757 L7.220,6.023 L6.995,-0.001 L10.717,4.757 Z" />
							</svg>
						</figure>
						<!-- Title -->
						<h1 class="mb-0 display-6 mt-3">Limitless earning for
							<span class="position-relative">YouTubers
								<!-- SVG START -->
								<span class="position-absolute top-50 start-50 translate-middle ms-3 z-index-n1 d-none">
									<svg width="300px" height="62.1px" enable-background="new 0 0 366 62.1"
										viewBox="0 0 366 62.1" xmlns="http://www.w3.org/2000/svg">
										<path class="fill-warning"
											d="m322.5 25.3c0 1.4 2.9 0.8 3.1 1.6 0.8 1.1-1.1 1.3-0.6 2.4 13.3 0.9 26.9 1.7 40.2 4-2.5 0.7-4.9 1.6-7.3 1.1-4-0.9-8.2-1-12.2-1.2-8.5-0.5-16.9-1.9-25.5-1.7h-3.1c2.6 0.6 4.8 0.4 5.7 2.2-7.3 0.4-14.1-0.8-21.2-1.1-0.2 0.6-0.5 1.2-0.8 1.8 21.3 0.7 42.5 1.6 64.3 4.6-4.2 1.6-7.7 1-10.8 0.8-6.8-0.5-13.5-1.3-20.3-1.9-0.9-0.1-2.3-0.1-2.9 0.2-2.2 1.6-4.3 0.6-7 0.4 1.4-1 2.5 0.5 3.9-0.8-5.6-1-10.7 0.6-15.9 0s-10.5-0.6-16.6-0.8c2 1.6 4.6 1.3 6.2 1.4 4.9 0 9.9 0.8 14.8 0.7 5.3-0.1 10.4 0.5 15.5 0.9 3.2 0.3 6.7-0.1 9.9-0.4 1.1-0.1 0.5 0.3 0.6 0.6 0.5 0.9 2.2 0.8 3.6 0.8 5.1-0.1 10.1 0.6 14.8 1.5 0.8 0.1 1.5 0 1.7 0.7 0 0.7-0.8 0.6-1.5 0.8-3.9 1.2-7.4-0.2-11.1-0.2-2 0-4.3-1.5-6 0.5-0.3 0.4-1.4 0.1-2.2-0.1-4.5-0.8-9.1-0.5-13.8-1.5-2.3-0.5-5.6 0.1-8.4 0.5-4 0.5-8-0.7-12.1-0.9-3.4-0.2-7.1-0.5-10.5-0.7-7.1-0.3-14.2-1.2-22.3-0.4 4.9 1.1 9.4 1.2 13.8 1.2 9.7 0 19.2 2.3 28.9 1.6 7.3 3.2 15.9 1.5 23.8 2.9 4.9 0.8 10.1 0.8 15.2 1.2 0.5 0 0.8 0.3 1.1 0.9-20-2.1-40.2-1.4-60.8-3 4.9 2.1 10.8-0.3 15.3 2.7-8 1.9-15.8-0.9-23.5-0.1 2.8 1.4 7.1 1.1 9.3 3.3 0.5 0.5 0.2 1.1-1.2 1.3 2.3 1 3.4-2.1 5.7-0.4 0.2-0.6 0.2-1 0.3-1.5 0.8-0.3 2 0.8 1.5 1.5-0.2 0.1 0 0.3 0 0.5 18.7 0.4 37.3 1.7 56.2 3.6-1.7 1.1-2.8 1.2-4.2 1.1-7.1-0.5-14.1-0.9-21.2-1.4-3.1-0.2-6.3-0.4-9.4-0.4-7.6-0.2-15-0.7-22.4-1-9-0.4-17.9-0.1-26.9-0.1-1.2 0-2.9-0.4-3.9 1 14.8 0.3 29.7 0.6 44.4 1.1 14.8 0.6 29.9 1.3 44.2 4.2-4.3 1-8.8 0.9-13 0.5-5.3-0.5-10.5-1.1-15.8-1.2-11.4-0.3-22.9-0.9-34.3-1.2-17.6-0.4-35.4-0.3-53.1-0.4-10.8-0.1-21.7-0.2-32.5 0-17.8 0.4-35.7 0.2-53.5 0.5-13.1 0.3-26.3 0.1-39.4 0.5-11.1 0.3-22.4 0.6-33.6 1-13.1 0.6-26.1 0.2-39.3 0.4-3.9 0.1-7.6 0.2-11.8-0.2 0.9-1.2 2.3-1.3 3.9-1.3 8.4 0.2 16.6-0.4 24.9-0.9 3.9-0.2 7.9-0.4 11.9 0.2 2.5 0.4 5.3-0.3 8-0.4 7.3-0.4 14.7-0.7 22-0.9 11.9-0.5 23.7-1.2 35.6-0.8 7.7 0.2 15.3-0.6 22.9-0.1 2.3 0.2 4.3-0.5 6.5-1h-17.6c-9.6 0-19-0.1-28.6 0-8 0.1-16.1 0.3-24 0.8-2.6 0.2-5.4 0.1-8.2 0.1-10.1 0.3-20.1 0.6-30.2 0.5-5.4 0-10.7-0.1-15.9 0.6-2.3 0.3-4-1.3-6.5-0.6 0.2 0.4 0.5 0.9 0.6 1.5-1.9 0-4 0.4-4.9-0.1-4.2-2.2-9.4-1.5-14.1-2.3-1.7-0.3-3.7-0.1-4.3-1.5-0.5-1.3 1.9-1.5 2.6-2.6-4.2-1.4-4.6-5-8.5-7.2-1.5 0.2-0.9 2.8-4.2 1.3 0.3 2.4 4.5 3.9 2.8 6.4-2.3 0.3-3.2-0.8-4.2-1.7-2.5-4-5.1-8.4-5.1-12.7 0.2-6.8 0.2-13.8 3.6-20.4 0.3-0.5 0.3-1 0.8-1.4 0.9-0.9 1.2-2.4 3.6-2.1 2.2 0.2 2.5 1.5 2.6 2.6 0.2 1.4 1.5 1.8 3.2 2.5 0.9-1.4 0.5-2.9 2.6-3.7 0.2-0.1 0.3-0.4 0.3-0.4-3.1-2.2 1.2-2.2 2.3-3.3-3.1-1.8-4-4.3-3.7-7-1.5-0.3-3.1-0.4-4.5 0-1.7 0.6-2.2-0.5-2.9-1 0.6-0.5 0.8-1.1 2.2-1.3 7.6-0.9 15.2-1.7 22.9-2 20-0.7 39.9-0.9 59.9-1 11.9-0.1 23.8 0.4 35.6 1.1 3.6 0.2 7.1-0.9 10.7-0.5 7.9 0.9 15.8 0.3 23.8 0.5 7.3 0.1 14.4-0.6 21.7-0.1 12.2 0.9 24.4 0.3 36.7 0.6 9.4 0.3 18.9 0.4 28.2 1 11.9 0.7 23.8 1.3 35.6 2 11.1 0.6 22.4 0.5 33.3 2 7.1 1 14.4 1.1 21.3 2.4 4 0.7 8.2 1.6 12.4 1.9 2.2 0.2 0.9 1 1.5 1.5-4-0.8-8-0.8-12.1-1.4-4.3-0.7-8.5-1-12.8 0.4-2.9 1-6.3 0.2-9.3-0.1-10.2-1.1-20.6-1.6-30.8-2.4-12.1-0.9-24.3-1.4-36.4-2.1-9.9-0.6-20-0.5-29.9-1-11.4-0.6-22.7 0-34.2-0.5-6.3-0.3-12.3-0.3-18.5-0.4-4.2-0.1-8.4 1.3-12.8 0.3 0.6 0.2 1.2 0.7 1.9 0.7 10.5 0 20.9 1.9 31.6 1.7 6.5-0.1 13.1 0.2 19.8 0.8 3.2 0.3 6.3-0.4 9.7-0.1 7.6 0.7 15.5 0.5 23 0.8 12.4 0.5 24.7 0.4 37.1 1.1 13.3 0.7 26.8 2.1 39.9 4.1 6.2 0.9 12.7 1.5 19.2 1.7 0.6 0 1.1 0.1 1.5 0.5-4.6 0.1-9.3 0-13.9-0.5-0.6 1.1 1.4 0.9 1.5 1.9-9.7 1.6-19.6-1.4-29.4-0.1 2.2 1.4 5.1 1 7.4 1 7.3 0.1 14.1 1.3 21.2 1.9 2.8 0.3 5.9 0 8.5 0.8 1.5 0.5 4.6-1.1 4.9 1.3 4-0.7 7.3 1.5 11.1 1.2 4-0.3 7.7 0.6 11.6 1.1 0.8 0.1 2.2 0.3 2.3 1.1 0.2 1-1.1 1.2-2 1.5-3.4 1-6.7-0.4-10.1-0.4-0.9 0-2-0.2-2.9-0.2-9.4 0.1-18.8-1.3-28.3-1.8-6-0.4-12.1-0.9-18.1-1.3 0 0.2 0 0.4-0.2 0.6 6.1 0.5 12.1 1.4 18.3 0.7z" />
									</svg>
								</span>
								<!-- SVG END -->
							</span>
						</h1>

						<div class="col-lg-12">
							<div class="card card-body p-4 p-sm-2 position-relative">

								<!-- Form START -->
								<div class="row g-3 position-relative" method="GET">
									<div class="col-md-6 col-lg-12 col-xl-4">
										<label for="lname">Search:</label>
										<select name="search" class="form-control" id="searchtype">
											<option value="0">Sponsorships</option>
											<option value="1">Brands</option>
											<option value="2">Creators</option>
										</select>
									</div>
									<div class="col-md-6 col-lg-12 col-xl-4">
										<label for="lname">Type:</label>
										<select name="category" class="form-control" id="category">
											<option value="0">Technical</option>
											<option value="1">Commercial</option>
											<option value="2">Vlogger</option>
											<option value="3">Educator</option>
											<option value="4">Photography &amp; Videography</option>
											<option value="5">Gaming</option>
											<option value="6">Fitness</option>
											<option value="7">Politics</option>
											<option value="8">Comedy Shows</option>
											<option value="9">Makeup</option>
											<option value="10">Experiment</option>
											<option value="11">Toy Reviews</option>
											<option value="12">Foods</option>
											<option value="13">Clothe</option>
										</select>
									</div>
									<div class="col-md-4" style="height: 50px;margin-top: 38px;">
										<button id="search" style="width:100%; float: left;"
											class=" align-middle btn btn-primary mb-0"><i
												class="fas fa-search"></i></button>
									</div>
								</div>
								<!-- Form END -->
							</div>
						</div>

						<!-- Content -->
						<p class="my-4 lead">A marketplace for Content Creators and Brands.</p>

						<!-- Info -->
						<ul class="list-inline position-relative justify-content-center justify-content-lg-start mb-4">
							<li class="list-inline-item me-2"> <i class="bi bi-patch-check-fill h6 me-1"></i>Best match
							</li>
							<li class="list-inline-item me-2 d-none"> <i class="bi bi-patch-check-fill h6 me-1"></i>O%
								fee</li>
							<li class="list-inline-item"> <i class="bi bi-patch-check-fill h6 me-1"></i>Companies with
								high offers </li>
						</ul>

						<div class="d-sm-flex align-items-center justify-content-center justify-content-lg-start">
							<!-- Button -->
							<button href="#" class="btn btn-lg btn-success-soft me-2 mb-4 mb-sm-0"
								id="signInAccount">Sign-In</button>
							<button href="#" class="btn btn-lg btn-danger-soft me-2 mb-4 mb-sm-0"
								id="signupAsCreator">Sign-up as
								YouTuber</button>
							<button href="#" class="btn btn-lg btn-primary-soft me-2 mb-4 mb-sm-0"
								id="signupAsCompany">Sign-Up as
								Brand</button>

						</div>
					</div>
					<!-- Left content END -->

					<!-- Right content START -->
					<div class="col-lg-7 col-xl-6 text-center position-relative">


						<!-- SVG decoration -->
						<figure class="position-absolute bottom-0 start-50 translate-middle-x mb-n5 z-index-9">
							<svg width="686px" height="298px" viewBox="0 0 686 298">
								<path class="fill-body"
									d="M60.9,0L0.1,0C0,0,0,0,0,0.1c1.5,5,0,249.5,11.5,297.9c0,0,649.1,16.1,669-4.6c0,0,0,0,0,0c0.2-0.4,1.2-177.2,4.2-293.3 c0,0,0-0.1-0.1-0.1l-72.9,0c0,0-0.1,0-0.1,0c-0.8,3-43.3,162.3-105.9,209.1c0,0-111.4,87.2-309.9-6C195.9,203.1,66.1,143.2,60.9,0 C61,0,60.9,0,60.9,0z" />
							</svg>
						</figure>

						<!-- Icon logos START -->
						<div
							class="p-2 bg-white shadow rounded-3 position-absolute top-50 start-0 translate-middle-y mt-n7 d-none d-sm-block">
							<img src="assets/images/flaticon/vlog.png" alt="Icon" style="height:40px">
						</div>
						<div class="p-2 bg-white shadow rounded-3 position-absolute top-0 end-0 me-5">
							<img src="assets/images/flaticon/console.png" alt="Icon" style="height:40px">
						</div>
						<div
							class="p-2 bg-white shadow rounded-3 position-absolute top-50 end-0 translate-middle-y mt-5 ms-5 d-none d-lg-block z-index-9">
							<img src="assets/images/flaticon/finance.png" alt="Icon" style="height:40px">
						</div>
						<!-- Icon logos END -->

						<!-- Congratulations message -->
						<div
							class="p-3 bg-white border border-light shadow rounded-4 position-absolute bottom-0 start-0 z-index-9 d-none d-xl-block mb-5 ms-5">
							<div class="d-flex justify-content-between align-items-center">
								<!-- Icon -->
								<span class="icon-lg bg-success rounded-circle"><i
										class="fas fa-wallet text-white"></i></span>
								<!-- Info -->
								<div class="text-start ms-3">
									<h6 class="mb-0 text-success">Save money <span class="ms-4"><i
												class="fas fa-check-circle text-success"></i></span></h6>
									<p class="mb-0 small ">0% Fee for new* creators.</p>
								</div>
							</div>
						</div>
						<!-- Image -->
						<div class="position-relative">
							<img src="assets/images/flaticon/creator.webp" alt="">
						</div>
					</div>
					<!-- Right content END -->
				</div>
			</div>
			<!-- Content END -->
		</section>
		<!-- =======================
Main Banner END -->

		<!-- =======================
Counter START -->
		<section class="py-0 py-xl-5">
			<div class="container">
				<div class="row g-4 d-flex justify-content-center">
					<!-- Counter item -->
					<div class="col-sm-6 col-xl-3">
						<div
							class="d-flex justify-content-center align-items-center p-4 bg-danger bg-opacity-15 rounded-3">
							<span class="display-6 lh-1 text-danger mb-0"><i class="bi bi-youtube"></i></span>
							<div class="ms-4 h6 fw-normal mb-0">
								<div class="d-flex">
									<h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0"
										data-purecounter-end="<?php echo 2; // print_r($total_creators); ?>"
										data-purecounter-delay="200">0</h5>
									<span class="mb-0 h5">+</span>
								</div>
								<p class="mb-0">Creators</p>
							</div>
						</div>
					</div>
					<!-- Counter item -->
					<div class="col-sm-6 col-xl-3">
						<div
							class="d-flex justify-content-center align-items-center p-4 bg-blue bg-opacity-10 rounded-3">
							<span class="display-6 lh-1 text-blue mb-0"><i class="fas fa-building"></i></span>
							<div class="ms-4 h6 fw-normal mb-0">
								<div class="d-flex">
									<h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0"
										data-purecounter-end="<?php echo 2; // print_r($total_brands); ?>"
										data-purecounter-delay="200">0</h5>
									<span class="mb-0 h5">+</span>
								</div>
								<p class="mb-0">Brands</p>
							</div>
						</div>
					</div>
					<!-- Counter item -->
					<div class="col-sm-6 col-xl-3">
						<div
							class="d-flex justify-content-center align-items-center p-4 bg-purple bg-opacity-10 rounded-3">
							<span class="display-6 lh-1 text-purple mb-0"><i class="bi bi-badge-ad-fill"></i></span>
							<div class="ms-4 h6 fw-normal mb-0">
								<div class="d-flex">
									<h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0"
										data-purecounter-end="<?php echo 1;
										print_r($total_sponsorships); ?>" data-purecounter-delay="200">0</h5>
									<span class="mb-0 h5">+</span>
								</div>
								<p class="mb-0">Sponsorships</p>
							</div>
						</div>
					</div>

					<!-- Counter item -->
					<div class="col-sm-6 col-xl-3 d-none">
						<div
							class="d-flex justify-content-center align-items-center p-4 bg-warning bg-opacity-10 rounded-3">
							<span class="display-6 lh-1 text-warning mb-0"><i class="fas fa-dollar-sign"></i></span>
							<div class="ms-4 h6 fw-normal mb-0">
								<div class="d-flex">
									<h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0"
										data-purecounter-end="<?php echo 0; //print_r($total_amount); ?>"
										data-purecounter-delay="300">0</h5>
									<span class="mb-0 h5"></span>
								</div>
								<p class="mb-0">Amount Disbursed</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- ======================= Counter END -->

		<div class="container <?php if (empty($_SESSION['currentUser'])) {
			echo "d-none";
		} ?>">
			<!-- ======================= Popular Creators START -->
			<section>
				<div class="container">
					<!-- Title -->
					<div class="row mb-4">
						<div class="col-lg-8 mx-auto text-center">
							<h2 class="fs-1">Most Popular Creators</h2>
							<p class="mb-0">Choose from thousand of creators who will display your brand..</p>
						</div>
					</div>

					<!-- Tabs START -->
					<ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-center mb-4 px-3"
						id="course-pills-tab" role="tablist">
						<!-- Tab item -->
						<li class="nav-item me-2 me-sm-5">
							<button class="nav-link mb-2 mb-md-0 active" id="course-pills-tab-1" data-bs-toggle="pill"
								data-bs-target="#course-pills-tabs-1" type="button" role="tab"
								aria-controls="course-pills-tabs-1" aria-selected="false">Technology</button>
						</li>
						<!-- Tab item -->
						<li class="nav-item me-2 me-sm-5">
							<button class="nav-link mb-2 mb-md-0" id="course-pills-tab-2" data-bs-toggle="pill"
								data-bs-target="#course-pills-tabs-2" type="button" role="tab"
								aria-controls="course-pills-tabs-2" aria-selected="false">Vlogging</button>
						</li>
						<!-- Tab item -->
						<li class="nav-item me-2 me-sm-5">
							<button class="nav-link mb-2 mb-md-0" id="course-pills-tab-3" data-bs-toggle="pill"
								data-bs-target="#course-pills-tabs-3" type="button" role="tab"
								aria-controls="course-pills-tabs-3" aria-selected="false">Education</button>
						</li>
						<!-- Tab item -->
						<li class="nav-item me-2 me-sm-5">
							<button class="nav-link mb-2 mb-md-0" id="course-pills-tab-4" data-bs-toggle="pill"
								data-bs-target="#course-pills-tabs-4" type="button" role="tab"
								aria-controls="course-pills-tabs-4" aria-selected="false">Gamings</button>
						</li>
						<!-- Tab item -->
						<li class="nav-item me-2 me-sm-5">
							<button class="nav-link mb-2 mb-md-0" id="course-pills-tab-5" data-bs-toggle="pill"
								data-bs-target="#course-pills-tabs-5" type="button" role="tab"
								aria-controls="course-pills-tabs-5" aria-selected="false">Fitness</button>
						</li>
						<!-- Tab item -->
						<li class="nav-item me-2 me-sm-5">
							<button class="nav-link mb-2 mb-md-0" id="course-pills-tab-5" data-bs-toggle="pill"
								data-bs-target="#course-pills-tabs-6" type="button" role="tab"
								aria-controls="course-pills-tabs-6" aria-selected="false">News/Politics</button>
						</li>
						<!-- Tab item -->
						<li class="nav-item me-2 me-sm-5">
							<button class="nav-link mb-2 mb-md-0" id="course-pills-tab-5" data-bs-toggle="pill"
								data-bs-target="#course-pills-tabs-7" type="button" role="tab"
								aria-controls="course-pills-tabs-7" aria-selected="false">Food</button>
						</li>
						<!-- Tab item -->
						<li class="nav-item me-2 me-sm-5">
							<button class="nav-link mb-2 mb-md-0" id="course-pills-tab-5" data-bs-toggle="pill"
								data-bs-target="#course-pills-tabs-8" type="button" role="tab"
								aria-controls="course-pills-tabs-8" aria-selected="false">Personal Care</button>
						</li>
					</ul>
					<!-- Tabs END -->

					<!-- Tabs content START -->
					<div class="tab-content" id="course-pills-tabContent">
						<!-- Content START -->
						<div class="tab-pane fade show active" id="course-pills-tabs-1" role="tabpanel"
							aria-labelledby="course-pills-tab-1">
							<div class="row g-4">
								<!-- Card item START -->
								<?php $suggest = new suggest();
								$suggest->suggestYoutubeCreator($conn, 0, 20, $_SESSION['currentUser']); ?>
								<!-- Card item END -->
							</div> <!-- Row END -->
						</div>
						<!-- Content END -->

						<!-- Content START -->
						<div class="tab-pane fade" id="course-pills-tabs-2" role="tabpanel"
							aria-labelledby="course-pills-tab-2">
							<div class="row g-4">
								<!-- Card item START -->
								<?php $suggest = new suggest();
								$suggest->suggestYoutubeCreator($conn, 2, 20, $_SESSION['currentUser']); ?>
								<!-- Card item END -->
							</div>
						</div>
						<!-- Content END -->

						<!-- Content START -->
						<div class="tab-pane fade" id="course-pills-tabs-3" role="tabpanel"
							aria-labelledby="course-pills-tab-3">
							<div class="row g-4">
								<!-- Card item START -->
								<?php $suggest = new suggest();
								$suggest->suggestYoutubeCreator($conn, 3, 20, $_SESSION['currentUser']); ?>
								<!-- Card item END -->
							</div>
						</div>
						<!-- Content END -->

						<!-- Content START -->
						<div class="tab-pane fade" id="course-pills-tabs-4" role="tabpanel"
							aria-labelledby="course-pills-tab-4">
							<div class="row g-4">
								<!-- Card item START -->
								<?php $suggest = new suggest();
								$suggest->suggestYoutubeCreator($conn, 5, 20, $_SESSION['currentUser']); ?>
								<!-- Card item END -->
							</div>
						</div>
						<!-- Content END -->

						<!-- Content START -->
						<div class="tab-pane fade" id="course-pills-tabs-5" role="tabpanel"
							aria-labelledby="course-pills-tab-5">
							<div class="row g-4">
								<!-- Card item START -->
								<?php $suggest = new suggest();
								$suggest->suggestYoutubeCreator($conn, 6, 20, $_SESSION['currentUser']); ?>
								<!-- Card item END -->
							</div>
						</div>
						<!-- Content END -->
						<!-- Content START -->
						<div class="tab-pane fade" id="course-pills-tabs-6" role="tabpanel"
							aria-labelledby="course-pills-tab-6">
							<div class="row g-4">
								<!-- Card item START -->
								<?php $suggest = new suggest();
								$suggest->suggestYoutubeCreator($conn, 7, 20, $_SESSION['currentUser']); ?>
								<!-- Card item END -->
							</div>
						</div>
						<!-- Content END -->
						<!-- Content START -->
						<div class="tab-pane fade" id="course-pills-tabs-7" role="tabpanel"
							aria-labelledby="course-pills-tab-7">
							<div class="row g-4">
								<!-- Card item START -->
								<?php $suggest = new suggest();
								$suggest->suggestYoutubeCreator($conn, 12, 20, $_SESSION['currentUser']); ?>
								<!-- Card item END -->
							</div>
						</div>
						<!-- Content END -->
						<!-- Content START -->
						<div class="tab-pane fade" id="course-pills-tabs-8" role="tabpanel"
							aria-labelledby="course-pills-tab-8">
							<div class="row g-4">
								<!-- Card item START -->
								<?php $suggest = new suggest();
								$suggest->suggestYoutubeCreator($conn, 13, 20, $_SESSION['currentUser']); ?>
								<!-- Card item END -->
							</div>
						</div>
						<!-- Content END -->
					</div>
					<!-- Tabs content END -->
				</div>
			</section>
			<!-- ======================= Popular Creators END -->

			<!-- ======================= Trending START -->
			<section class="pb-5 pt-0 pt-lg-5">
				<div class="container">
					<!-- Title -->
					<div class="row mb-4">
						<div class="col-lg-8 mx-auto text-center">
							<h2 class="fs-1">Popular brands ready to work with you..</h2>
							<p class="mb-0" style="display: none;">Check out most 🔥 in the market</p>
						</div>
					</div>
					<div class="row">
						<!-- Slider START -->
						<div class="tiny-slider arrow-round arrow-blur arrow-hover">
							<div class="tiny-slider-inner pb-1" data-autoplay="false" data-arrow="true" data-edge="2"
								data-dots="false" data-items="4" data-items-lg="3" data-items-sm="1">

								<!-- card item -->
								<?php $suggest = new suggest();
								$suggest->suggestBrands($conn, 0, 10, $_SESSION['currentUser']); ?>

							</div>
						</div>
						<!-- Slider END -->
					</div>
				</div>
			</section>
			<!-- ======================= Trending END -->

			<!-- ======================= Trending START -->
			<section class="pb-5 pt-0 pt-lg-5">
				<div class="container">
					<!-- Title -->
					<div class="row mb-4">
						<div class="col-lg-8 mx-auto text-center">
							<h2 class="fs-1">Latest sponsorships tailored for you..</h2>
							<p class="mb-0" style="display: none;">Check out most 🔥 in the market</p>
						</div>
					</div>
					<div class="row">
						<!-- Slider START -->
						<div class="tiny-slider arrow-round arrow-blur arrow-hover">
							<div class="tiny-slider-inner pb-1" data-autoplay="false" data-arrow="true" data-edge="2"
								data-dots="false" data-items="4" data-items-lg="3" data-items-sm="1">

								<!-- card item -->
								<?php
								$suggest = new suggest();
								$suggest->suggestSponsorships($conn, "any", 10, $_SESSION['currentUser']); ?>

							</div>
						</div>
						<!-- Slider END -->
					</div>
				</div>
			</section>
			<!-- ======================= Trending END -->
		</div>
		<!-- ======================= Action box START -->
		<section class="pt-0 pt-lg-5">
			<div class="container position-relative">
				<!-- SVG decoration START -->
				<figure class="position-absolute top-50 start-50 translate-middle ms-2">
					<svg>
						<path class="fill-white opacity-4"
							d="m496 22.999c0 10.493-8.506 18.999-18.999 18.999s-19-8.506-19-18.999 8.507-18.999 19-18.999 18.999 8.506 18.999 18.999z" />
						<path class="fill-white opacity-4"
							d="m775 102.5c0 5.799-4.701 10.5-10.5 10.5-5.798 0-10.499-4.701-10.499-10.5 0-5.798 4.701-10.499 10.499-10.499 5.799 0 10.5 4.701 10.5 10.499z" />
						<path class="fill-white opacity-4"
							d="m192 102c0 6.626-5.373 11.999-12 11.999s-11.999-5.373-11.999-11.999c0-6.628 5.372-12 11.999-12s12 5.372 12 12z" />
						<path class="fill-white opacity-4"
							d="m20.499 10.25c0 5.66-4.589 10.249-10.25 10.249-5.66 0-10.249-4.589-10.249-10.249-0-5.661 4.589-10.25 10.249-10.25 5.661-0 10.25 4.589 10.25 10.25z" />
					</svg>
				</figure>
				<!-- SVG decoration END -->

				<div class="row">
					<div class="col-12">
						<div class="bg-info p-4 p-sm-5 rounded-3">
							<div class="row position-relative">
								<!-- Svg decoration -->
								<figure
									class="fill-white opacity-1 position-absolute top-50 start-0 translate-middle-y">
									<svg width="141px" height="141px">
										<path
											d="M140.520,70.258 C140.520,109.064 109.062,140.519 70.258,140.519 C31.454,140.519 -0.004,109.064 -0.004,70.258 C-0.004,31.455 31.454,-0.003 70.258,-0.003 C109.062,-0.003 140.520,31.455 140.520,70.258 Z" />
									</svg>
								</figure>
								<!-- Action box -->
								<div class="col-11 mx-auto position-relative">
									<div class="row align-items-center">
										<!-- Title -->
										<div class="col-lg-7">
											<h3 class="text-white">Register your brand..</h3>
											<p class="text-white mb-3 mb-lg-0">Register your brand to showcase it to
												real audience via influencer.</p>
										</div>
										<!-- Content and input -->
										<div class="col-lg-5 text-lg-end">
											<a href="#" class="signInAccount btn btn-warning mb-0"><b>Register Now</b>
												for
												early Offers!</a>
										</div>
									</div>
								</div>
							</div> <!-- Row END -->
						</div>
					</div>
				</div> <!-- Row END -->
			</div>
		</section>
		<!-- ======================= Action box END -->

		<!-- ======================= Reviews START -->
		<section class="bg-light">
			<div class="container">
				<div class="row g-4 g-lg-5 align-items-center">
					<div class="col-xl-7 order-2 order-xl-1">
						<div class="row mt-0 mt-xl-5">
							<!-- Review -->
							<div class="col-md-7 position-relative mb-0 mt-0 mt-md-5">
								<!-- SVG -->
								<figure
									class="fill-danger opacity-2 position-absolute top-0 start-0 translate-middle mb-3">
									<svg width="211px" height="211px">
										<path
											d="M210.030,105.011 C210.030,163.014 163.010,210.029 105.012,210.029 C47.013,210.029 -0.005,163.014 -0.005,105.011 C-0.005,47.015 47.013,-0.004 105.012,-0.004 C163.010,-0.004 210.030,47.015 210.030,105.011 Z">
										</path>
									</svg>
								</figure>

								<div class="bg-body shadow text-center p-4 rounded-3 position-relative mb-5 mb-md-0">
									<!-- Avatar -->
									<div class="avatar avatar-xl mb-3">
										<img class="avatar-img rounded-circle"
											src="https://yt3.googleusercontent.com/aqXvNQzcaYA9Y60VceEpJ6i7yyl166i3chy9guZMVg9eoepZn4MZjju5CkIGBrEuX--Lj-dn=s176-c-k-c0x00ffffff-no-rj"
											alt="avatar">
									</div>
									<!-- Content -->
									<blockquote>
										<p>
											<span class="me-1 small"><i class="fas fa-quote-left"></i></span>
											Never saw such an amazing service which can help creator earn money very
											easily.
											<span class="ms-1 small"><i class="fas fa-quote-right"></i></span>
										</p>
									</blockquote>
									<!-- Rating -->
									<ul class="list-inline mb-2">
										<li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i>
										</li>
										<li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i>
										</li>
										<li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i>
										</li>
										<li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i>
										</li>
										<li class="list-inline-item me-0 small"><i
												class="fas fa-star-half-alt text-warning"></i></li>
									</ul>
									<!-- Info -->
									<h6 class="mb-0">Ritik Kumar</h6>
								</div>
							</div>

							<!-- Mentor list -->
							<!-- place "d-md-block" also in the following class because it was added before displaying none -->
							<div class="col-md-5 mt-5 mt-md-0 d-none">
								<div class="bg-body shadow p-4 rounded-3 d-inline-block position-relative">
									<!-- Icon -->
									<div
										class="icon-lg bg-warning rounded-circle position-absolute top-0 start-100 translate-middle">
										<i class="bi bi-shield-fill-check text-dark"></i>
									</div>
									<!-- Title -->
									<h6 class="mb-3">100+ Verified Mentors</h6>
									<!-- Mentor Item -->
									<div class="d-flex align-items-center mb-3">
										<!-- Avatar -->
										<div class="avatar avatar-sm">
											<img class="avatar-img rounded-1" src="assets/images/avatar/09.jpg"
												alt="avatar">
										</div>
										<!-- Info -->
										<div class="ms-2">
											<h6 class="mb-0">Lori Stevens</h6>
											<p class="mb-0 small">Tutor of physic</p>
										</div>
									</div>

									<!-- Mentor Item -->
									<div class="d-flex align-items-center mb-3">
										<!-- Avatar -->
										<div class="avatar avatar-sm">
											<img class="avatar-img rounded-1" src="assets/images/avatar/04.jpg"
												alt="avatar">
										</div>
										<!-- Info -->
										<div class="ms-2">
											<h6 class="mb-0">Billy Vasquez</h6>
											<p class="mb-0 small">Tutor of chemistry</p>
										</div>
									</div>

									<!-- Mentor Item -->
									<div class="d-flex align-items-center">
										<!-- Avatar -->
										<div class="avatar avatar-sm">
											<img class="avatar-img rounded-1" src="assets/images/avatar/02.jpg"
												alt="avatar">
										</div>
										<!-- Info -->
										<div class="ms-2">
											<h6 class="mb-0">Larry Lawson</h6>
											<p class="mb-0 small">Tutor of technology</p>
										</div>
									</div>
								</div>
							</div>
						</div> <!-- Row END -->

						<div class="row mt-5 mt-xl-0">
							<!-- Rating -->
							<div class="col-7 mt-0 mt-xl-5 text-end position-relative z-index-1 d-none d-md-block">
								<!-- SVG -->
								<figure
									class="fill-danger position-absolute top-0 start-50 mt-n7 ms-6 ps-3 pt-2 z-index-n1 d-none d-lg-block">
									<svg enable-background="new 0 0 160.7 159.8" height="180px">
										<path
											d="m153.2 114.5c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2-0.1-1.2 0.9-2.2 2.1-2.2z" />
										<path
											d="m116.4 114.5c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2s0.9-2.2 2.1-2.2z" />
										<path
											d="m134.8 114.5c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2s0.9-2.2 2.1-2.2z" />
										<path
											d="m135.1 96.9c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2s0.9-2.2 2.1-2.2z" />
										<path
											d="m153.5 96.9c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2-0.1-1.2 0.9-2.2 2.1-2.2z" />
										<path
											d="m98.3 96.9c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2s0.9-2.2 2.1-2.2z" />
										<ellipse cx="116.7" cy="99.1" rx="2.1" ry="2.2" />
										<path
											d="m153.2 149.8c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2-0.1-1.3 0.9-2.2 2.1-2.2z" />
										<path
											d="m135.1 132.2c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2 0-1.3 0.9-2.2 2.1-2.2z" />
										<path
											d="m153.5 132.2c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2-0.1-1.3 0.9-2.2 2.1-2.2z" />
										<path
											d="m80.2 79.3c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2s1-2.2 2.1-2.2z" />
										<path
											d="m117 79.3c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2s0.9-2.2 2.1-2.2z" />
										<path
											d="m98.6 79.3c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2s0.9-2.2 2.1-2.2z" />
										<path
											d="m135.4 79.3c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2s0.9-2.2 2.1-2.2z" />
										<path
											d="m153.8 79.3c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2s0.9-2.2 2.1-2.2z" />
										<path
											d="m80.6 61.7c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2-0.1-1.2 0.9-2.2 2.1-2.2z" />
										<ellipse cx="98.9" cy="63.9" rx="2.1" ry="2.2" />
										<path
											d="m117.3 61.7c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2s0.9-2.2 2.1-2.2z" />
										<ellipse cx="62.2" cy="63.9" rx="2.1" ry="2.2" />
										<ellipse cx="154.1" cy="63.9" rx="2.1" ry="2.2" />
										<path
											d="m135.7 61.7c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2s0.9-2.2 2.1-2.2z" />
										<path
											d="m154.4 44.1c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2s0.9-2.2 2.1-2.2z" />
										<path
											d="m80.9 44.1c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2-0.1-1.2 0.9-2.2 2.1-2.2z" />
										<path
											d="m44.1 44.1c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2-0.1-1.2 0.9-2.2 2.1-2.2z" />
										<path
											d="m99.2 44.1c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2s1-2.2 2.1-2.2z" />
										<ellipse cx="117.6" cy="46.3" rx="2.1" ry="2.2" />
										<path
											d="m136 44.1c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2s0.9-2.2 2.1-2.2z" />
										<path
											d="m62.5 44.1c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2-0.1-1.2 0.9-2.2 2.1-2.2z" />
										<path
											d="m154.7 26.5c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2s0.9-2.2 2.1-2.2z" />
										<path
											d="m62.8 26.5c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2-0.1-1.2 0.9-2.2 2.1-2.2z" />
										<ellipse cx="136.3" cy="28.6" rx="2.1" ry="2.2" />
										<path
											d="m99.6 26.5c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2-0.1-1.2 0.9-2.2 2.1-2.2z" />
										<path
											d="m117.9 26.5c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2s1-2.2 2.1-2.2z" />
										<path
											d="m81.2 26.5c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2-0.1-1.2 0.9-2.2 2.1-2.2z" />
										<path
											d="m26 26.5c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2c-1.2 0-2.1-1-2.1-2.2s0.9-2.2 2.1-2.2z" />
										<ellipse cx="44.4" cy="28.6" rx="2.1" ry="2.2" />
										<path
											d="m136.6 13.2c-1.2 0-2.1-1-2.1-2.2s1-2.2 2.1-2.2c1.2 0 2.1 1 2.1 2.2 0.1 1.2-0.9 2.2-2.1 2.2z" />
										<path
											d="m155 13.2c-1.2 0-2.1-1-2.1-2.2s1-2.2 2.1-2.2c1.2 0 2.1 1 2.1 2.2 0.1 1.2-0.9 2.2-2.1 2.2z" />
										<path
											d="m26.3 13.2c-1.2 0-2.1-1-2.1-2.2s1-2.2 2.1-2.2c1.2 0 2.1 1 2.1 2.2s-0.9 2.2-2.1 2.2z" />
										<path
											d="m81.5 13.2c-1.2 0-2.1-1-2.1-2.2s1-2.2 2.1-2.2c1.2 0 2.1 1 2.1 2.2s-0.9 2.2-2.1 2.2z" />
										<path
											d="m63.1 13.2c-1.2 0-2.1-1-2.1-2.2s1-2.2 2.1-2.2c1.2 0 2.1 1 2.1 2.2s-0.9 2.2-2.1 2.2z" />
										<path
											d="m44.7 13.2c-1.2 0-2.1-1-2.1-2.2s1-2.2 2.1-2.2c1.2 0 2.1 1 2.1 2.2s-0.9 2.2-2.1 2.2z" />
										<path
											d="m118.2 13.2c-1.2 0-2.1-1-2.1-2.2s1-2.2 2.1-2.2c1.2 0 2.1 1 2.1 2.2 0.1 1.2-0.9 2.2-2.1 2.2z" />
										<path
											d="m7.9 13.2c-1.2 0-2.1-1-2.1-2.2s1-2.2 2.1-2.2c1.2 0 2.1 1 2.1 2.2 0.1 1.2-0.9 2.2-2.1 2.2z" />
										<path
											d="m99.9 13.2c-1.2 0-2.1-1-2.1-2.2s1-2.2 2.1-2.2c1.2 0 2.1 1 2.1 2.2s-1 2.2-2.1 2.2z" />
									</svg>
								</figure>

								<a href="..."
									class="d-none p-3 bg-primary d-inline-block rounded-4 shadow-lg text-center"
									style="background:url(assets/images/pattern/02.png) no-repeat center center; background-size:cover;">
									<!-- Info -->
									<h5 class="text-white mb-0">4.5/5.0</h5>
									<!-- Rating -->
									<ul class="list-inline mb-2">
										<li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i>
										</li>
										<li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i>
										</li>
										<li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i>
										</li>
										<li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i>
										</li>
										<li class="list-inline-item me-0 small"><i
												class="fas fa-star-half-alt text-warning"></i></li>
									</ul>
									<p class="text-white mb-0">Based on 3265 ratings</p>
								</a>
							</div>

							<!-- Review -->
							<div class="col-md-5 mt-n6 mb-0 mb-md-5">
								<div class="bg-body shadow text-center p-4 rounded-3">
									<!-- Avatar -->
									<div class="avatar avatar-xl mb-3">
										<img class="avatar-img rounded-circle" src="assets/images/avatar/03.jpg"
											alt="avatar">
									</div>
									<!-- Content -->
									<blockquote>
										<p>
											<span class="me-1 small"><i class="fas fa-quote-left"></i></span>
											Now I can focus on my passion and have income from that..
											<span class="ms-1 small"><i class="fas fa-quote-right"></i></span>
										</p>
									</blockquote>
									<!-- Rating -->
									<ul class="list-inline mb-2">
										<li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i>
										</li>
										<li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i>
										</li>
										<li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i>
										</li>
										<li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i>
										</li>
										<li class="list-inline-item me-0 small"><i
												class="fas fa-star-half-alt text-warning"></i></li>
									</ul>
									<!-- Info -->
									<h6 class="mb-0">Dennis Barrett</h6>
								</div>
							</div>
						</div> <!-- Row END -->
					</div>
					<div class="col-xl-5 order-1 text-center text-xl-start">
						<!-- Title -->
						<h2 class="fs-1">Some valuable feedback from our users..</h2>
						<p>"Sponsorrs helped to save our valuable time and energy finding best
							creator to help our brand get advertised and becoming popular accross our city. Sponsorrs
							not just saved our time and energy but it also helped to save our money."</p>
						<a href="<?php echo $domain; ?>/why-choose-us.php" class="btn btn-warning mb-0 d-none">Why
							choose us?</a>
					</div>
				</div> <!-- Row END -->
			</div>
		</section>
		<!-- ======================= Reviews END -->


	</main>
	<!-- **************** MAIN CONTENT END **************** -->

	<!-- ======================= Footer START -->
	<?php include("common_ui/footer.php"); ?>
	<!-- ====================== Footer END -->

	<!-- Back to top -->
	<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

	<!-- Bootstrap JS -->
	<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

	<!-- Vendors -->
	<script src="assets/vendor/tiny-slider/tiny-slider.js"></script>
	<script src="assets/vendor/glightbox/js/glightbox.js"></script>
	<script src="assets/vendor/purecounterjs/dist/purecounter_vanilla.js"></script>
	<script src="assets/vendor/choices/js/choices.min.js"></script>
	<!-- Template Functions -->
	<script src="assets/js/functions.js"></script>
	<script src="assets/js/for-index.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script> -->
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>

</body>

</html>