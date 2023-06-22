<?php
session_start();

require_once("misc/db.php");
require_once("misc/functions.php");

$id_company = $_GET['id'];

// the logged-in user
$currentUser = $_SESSION['currentUser'];
echo $_SESSION['currentUser'];

// logged-in users subcreation id
$subcreationID = $_SESSION['currentSubcreationId'];

// get company information
$query = "SELECT primary_ac_id,companyname,country,state,city,contactno,website,
				 email,aboutme,logo,createdAt,industry,benefit, intro_video, primary_ac.token_secret,
		 		IF(primary_ac_id 
					IN (
						SELECT DISTINCT saved_brand_id 
						FROM saved_brand_profiles 
						WHERE saver_channel_id = '$currentUser'
					),1,0
				) AS saved, 
				IF(primary_ac_id 
					IN (
						SELECT applied_brand_id 
						FROM apply_brands 
						WHERE applier_creator_id='$currentUser' 
						AND applier_subcreation_id='$subcreationID' 
						AND applier_creator_id='$currentUser'
					),1,0
				) AS applied 
		FROM company 
		LEFT JOIN primary_ac ON primary_ac.ac_id ='$currentUser' 
		WHERE primary_ac_id='$id_company'";

$result = $conn->query($query);

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();

	$primary_ac_id = $row['primary_ac_id'];
	$companyname = $row['companyname'];
	$country = $row['country'];
	$state = $row['state'];
	$city = $row['city'];
	$contactno = $row['contactno'];
	$website = $row['website'];
	$email = $row['email'];
	$aboutme = $row['aboutme'];
	$logo = $row['logo'];
	$createdAt = $row['createdAt'];
	$industry = $row['industry'];
	$saved = $row['saved'];
	$tokenSecret = $row['token_secret'];
	$applied = $row['applied'];
	$benefit = $row['benefit'];

}

// for APPLY button
$token = $primary_ac_id . "|" . $subcreationID . '|' . hash("sha512", $tokenSecret . $_SESSION['currentUser']);

// ecnrypt token
$openSSL = new OpenSSL('aes-256-gcm', hash("sha512", session_id()));
$token = $openSSL->encrypt($token);

// if the channel has already been applied then show "applied" text
$appliedOrNot = $applied == 1 ? 'Applied' : 'Apply';


// to save the creator [start]

if ($saved == 0) {
	$saved = '<i class="bi bi-bookmark me-2"></i>Save';
} else {
	$saved = '<i class="bi bi-bookmark-check-fill me-2"></i>Saved';
}
// to save the creator [end]


// get social links realated to this creator [start]
$query = "SELECT facebook, twitter, reddit, instagram, youtube_1, youtube_2, youtube_3, tiktok, pinterest, linkedin, snapchat, website FROM social_links WHERE channel_user_id='$username'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();

	$facebook = $row['facebook'];
	$twitter = $row['twitter'];
	$reddit = $row['reddit'];
	$instagram = $row['instagram'];
	$youtube_1 = $row['youtube_1'];
	$youtube_2 = $row['youtube_2'];
	$youtube_3 = $row['youtube_3'];
	$tiktok = $row['tiktok'];
	$pinterest = $row['pinterest'];
	$linkedin = $row['linkedin'];
	$snapchat = $row['snapchat'];
	$website = $row['website'];

} else {
	echo "something went wrong";
}

$createdAt = date("F jS, Y", strtotime($createdAt));

function contactBadgeFromArray($array, $string)
{

	if ($string == "email") {
		if (!$array) {
			echo '<a href="#" class="badge bg-primary bg-opacity-10 text-success m-1"><i class="fas fa-envelope mr-1"></i> No E-Mail found..</a>';
		} else {
			foreach ($array as $value) {
				echo '<a href="#" class="badge bg-primary bg-opacity-10 text-success m-1"><i class="fas fa-envelope mr-1"></i> ' . $value . '</a>';
			}
		}
	}
	if ($string == "phone") {
		if (!$array) {
			echo '<a href="#" class="badge bg-primary bg-opacity-10 text-orange m-1"><i class="fas fa-phone mr-1"></i> No phone number..</a>';
		} else {
			foreach ($array as $value) {
				echo '<a href="#" class="badge bg-primary bg-opacity-10 text-orange m-1"><i class="fas fa-phone mr-1"></i> ' . $value . '</a>';
			}
		}
	}
	if ($string == "social") {
		if (!$array) {
			echo '<a href="#" class="badge bg-primary bg-opacity-10 text-primary m-1"><i class="fas fa-globe mr-1"></i> No social handle from description </a>';
		} else {
			foreach ($array as $value) {
				echo '<a href="https://www.' . $value . '" class="badge bg-primary bg-opacity-10 text-primary m-1"><i class="fas fa-globe mr-1"></i> ' . $value . '</a>';
			}
		}
	}
}


function getVideos($playlistId, $channelId)
{
	$url = "//https://youtube.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=" . $playlistId . "&key=AIzaSyDtNnCfUsHnnDc20U3hQ7_IOfq-RGVGAIg"; // abp correct url before publish
	if ($jsonContent = file_get_contents($url)) {
		$jsonContent = json_decode($jsonContent, true);

		echo "<h4>Glipmse of our work..</h4>";
		for ($i = 0; $i < count($jsonContent["items"]); $i++) {
			$videoId = $jsonContent["items"][$i]["snippet"]["resourceId"]["videoId"];

			echo '<iframe style="border-radius: 6px;margin-right: 8px;" width="373"
												height="207" src="https://www.youtube.com/embed/' . $videoId . '">
											</iframe>';
		}
	} else {
		echo "<h5>Glipmse of our work..</h5>";
	}

}




?>

<!DOCTYPE html>
<html lang="en">

<!-- course-detail.html  11 Feb 2023 14:24:51 GMT -->

<head>
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-KRL58MWH94"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());

		gtag('config', 'G-KRL58MWH94');
	</script>
	<title>Sponsorrs - Sponsorships for YouTube channels & Creators</title>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="https://sponsorrs.com">
	<meta name="description"
		content="Sponsorrs - Sponsorships for TouTube channels. Creators can apply for sponsorships created by brands. Easily accept payments in bank accounts.">

	<meta property="og:title" content="Sponsorrs - Sponsorships for YouTube channels & Creators">
	<meta property="og:description" content="Sponsorship platform for youtube channels">
	<meta property="og:image" content="assets/images/flaticon/sponsorrs_rect.png">
	<?php include_once("common_ui/dark-mode.php"); ?>

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">

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
	<link rel="stylesheet" type="text/css" href="assets/vendor/choices/css/choices.min.css">

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

		<!-- ======================= Page intro START -->
		<section class="bg-light py-0 py-sm-5">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<!-- Title -->
						<h1>
							<?php echo $companyname ?>
						</h1>
						<div class="d-flex justify-content-between ">
							<p class="d-flex" style="width:75%">
								<?php echo substr($aboutme, 0, 200) . ".."; ?>
							</p>

							<!-- Badge -->
							<button data-action="applyBrands" data-token="<?php echo $token; ?>"
								class="applyBrands me-2 btn btn-primary mb-3 rounded-2 fs-5" id="applyToChannel"><?php echo $appliedOrNot; ?></button>
							<button
								class="d-none me-2 btn btn-lg btn-warning mb-3 font-base py-2 px-4 rounded-2 d-inline-block">Follow</button>
							<button data-action="saveTheBrand" data-token="<?php echo $token; ?>" id="saveBrands"
								class="saveCompany btn btn-success mb-3 rounded-2 fs-5"><?php echo $saved; ?></button>
						</div>
						<!-- Content -->
						<ul class="list-inline mb-0">
							<li class="list-inline-item h6 me-3 mb-1 mb-sm-0"><i
									class="fas fa-birthday-cake text-primary me-2"></i><span
									class="small">Joined:</span>
								<?php echo $createdAt; ?>
							</li>
							<li class="list-inline-item h6 mb-0"><i class="fas fa-globe text-info me-2"></i><span
									class="small">Country:</span>
								<?php echo countryCodeToName($conn, $country); ?>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<!-- ======================= Page intro END -->

		<!-- =======================
Page content START -->
		<section class="pb-0 py-lg-5">
			<div class="container">
				<div class="row">
					<!-- Main content START -->
					<div class="col-lg-8">
						<div class="card shadow rounded-2 p-0">
							<!-- Tabs START -->
							<div class="card-header border-bottom px-4 py-3 d-none">
								<ul class="nav nav-pills nav-tabs-line py-0" id="course-pills-tab" role="tablist">
									<!-- Tab item -->
									<li class="nav-item me-2 me-sm-4" role="presentation">
										<button class="nav-link mb-2 mb-md-0 active" id="course-pills-tab-1"
											data-bs-toggle="pill" data-bs-target="#course-pills-1" type="button"
											role="tab" aria-controls="course-pills-1"
											aria-selected="true">Overview</button>
									</li>
									<!-- Tab item -->
									<li class="nav-item me-2 me-sm-4" role="presentation">
										<button class="nav-link mb-2 mb-md-0" id="course-pills-tab-2"
											data-bs-toggle="pill" data-bs-target="#course-pills-2" type="button"
											role="tab" aria-controls="course-pills-2"
											aria-selected="false">Videos</button>
									</li>
									<!-- Tab item -->
									<li class="nav-item me-2 me-sm-4" role="presentation" style="display:none">
										<button class="nav-link mb-2 mb-md-0" id="course-pills-tab-4"
											data-bs-toggle="pill" data-bs-target="#course-pills-4" type="button"
											role="tab" aria-controls="course-pills-4"
											aria-selected="false">Reviews</button>
									</li>
									<!-- Tab item -->
									<li class="nav-item me-2 me-sm-4" role="presentation" style="display:none">
										<button class="nav-link mb-2 mb-md-0" id="course-pills-tab-5"
											data-bs-toggle="pill" data-bs-target="#course-pills-5" type="button"
											role="tab" aria-controls="course-pills-5" aria-selected="false">FAQs
										</button>
									</li>
									<!-- Tab item -->
									<li class="nav-item me-2 me-sm-4" role="presentation" style="display:none">
										<button class="nav-link mb-2 mb-md-0" id="course-pills-tab-6"
											data-bs-toggle="pill" data-bs-target="#course-pills-6" type="button"
											role="tab" aria-controls="course-pills-6"
											aria-selected="false">Comment</button>
									</li>
								</ul>
							</div>
							<!-- Tabs END -->

							<!-- Tab contents START -->
							<div class="card-body p-4">
								<div class="tab-content pt-2" id="course-pills-tabContent">
									<!-- Content START -->
									<div class="tab-pane fade show active" id="course-pills-1" role="tabpanel"
										aria-labelledby="course-pills-tab-1">
										<!-- Course detail START -->
										<div class="card mb-0 mb-md-4">
											<div class="row g-0 align-items-center">
												<div class="col-md-5">
													<!-- Image -->
													<img src="<?php echo str_ireplace('88', '500', $logo) ?>"
														class="img-fluid rounded-3" alt="instructor-image">
												</div>
												<div class="col-md-7">
													<!-- Card body -->
													<div class="card-body">
														<!-- Title -->
														<h3 class="card-title mb-0 d-inline-flex">
															<?php echo $companyname ?>
														</h3>
														<div class="dropdown list-inline-item" style="margin-left:20px">
															<!-- Share button -->
															<a href="#" class="btn btn-sm btn-light rounded small"
																role="button" id="dropdownShare"
																data-bs-toggle="dropdown" aria-expanded="false">
																<i class="fas fa-fw fa-share-alt"></i>
															</a>
															<!-- dropdown button -->
															<ul class="dropdown-menu dropdown-w-sm dropdown-menu-end min-w-auto shadow rounded"
																aria-labelledby="dropdownShare">
																<li><a class="dropdown-item" href="#"><i
																			class="bi bi-twitter text-twitter me-2"></i>Twitter</a>
																</li>
																<li><a class="dropdown-item"
																		href="https://www.facebook.com/sharer/sharer.php?u=https://www.sponsorrs.com/profile.php?p=<?php echo $dp_username; ?>"><i
																			class="fab fa-facebook text-facebook me-2"></i>Facebook</a>
																</li>
																<li><a class="dropdown-item"
																		href="https://twitter.com/intent/tweet?url=https://www.sponsorrs.com/profile.php?p=<?php echo $dp_username; ?>&text=Business profile of <?php echo $title; ?>"><i
																			class="fab fa-linkedin text-linkedin me-2"></i>LinkedIn</a>
																</li>
																<li><a class="dropdown-item"
																		href="https://www.linkedin.com/sharing/share-offsite/?url=https://www.sponsorrs.com/profile.php?p=<?php echo $dp_username; ?>"><i
																			class="fas fa-copy me-2 text-info"></i>Copy
																		link</a></li>
															</ul>
														</div>
														<p class="mb-2" style="display: none;">Instructor of Marketing
														</p>
														<hr>
														<ul class="list-inline d-flex align-item-center mt-3"
															style="height:30px">
															<div title="Industry of the brand"
																class="d-flex align-items-center me-3 mb-2  align-self-center ">
																<span
																	class="bg-opacity-15 text-primary  align-self-center"><i
																		class="icon-xl bi bi-building-fill"></i></span>
																<span class="fw-bolder h6 fw-light mb-0 ms-2">
																	<?php echo industryCodeToName($industry); ?>
																</span>
															</div>
														</ul>
														<hr>

														<!-- Social button -->
														<ul class="list-inline">
															<li class="list-inline-item me-3">
																<a href="<?php echo $twitter; ?>"
																	class="fs-5 text-twitter"><i
																		class="bi bi-twitter text-twitter fs-6"></i></a>
															</li>
															<li class="list-inline-item me-3">
																<a href="<?php echo $instagram; ?>"
																	class="fs-5 text-instagram"><i
																		class="bi bi-instagram text-instagram fs-6"></i></a>
															</li>
															<li class="list-inline-item me-3">
																<a href="<?php echo $facebook; ?>"
																	class="fs-5 text-facebook"><i
																		class="bi bi-facebook text-facebook fs-6"></i></a>
															</li>
															<li class="list-inline-item me-3">
																<a href="<?php echo $linkedin; ?>"
																	class="fs-5 text-linkedin"><i
																		class="bi bi-linkedin text-linkedin fs-6"></i></a>
															</li>
															<li class="list-inline-item">
																<a href="<?php echo $youtube_1; ?>"
																	class="fs-5 text-youtube"><i
																		class="bi bi-youtube text-youtube me-1 fs-6"></i></a>
															</li>
															<li class="list-inline-item">
																<a href="<?php echo $youtube_2; ?>"
																	class="fs-5 text-youtube"><i
																		class="bi bi-youtube text-youtube me-1 fs-6"></i></a>
															</li>
															<li class="list-inline-item">
																<a href="<?php echo $youtube_3; ?>"
																	class="fs-5 text-youtube"><i
																		class="bi bi-youtube text-youtube me-1 fs-6"></i></a>
															</li>
															<li class="list-inline-item">
																<a href="<?php echo $reddit; ?>"
																	class="fs-5 text-rddit"><i
																		class="bi bi-reddit text-reddit me-1 fs-6"></i></a>
															</li>

															<li class="list-inline-item">
																<a href="<?php echo $pinterest; ?>"
																	class="fs-5 text-pinterest"><i
																		class="bi bi-pinterest text-pinterest me-1 fs-6"></i></a>
															</li>
															<li class="list-inline-item">
																<a href="<?php echo $snapchat; ?>"
																	class="fs-5 text-snapchat"><i
																		class="bi bi-snapchat text-snapchat fs-6"></i></a>
															</li>
															<li class="list-inline-item">
																<a href="<?php echo $tiktok; ?>"
																	class="fs-5 text-tiktok"><i
																		class="bi bi-tiktok text-tiktok fs-6"></i></a>
															</li>
															<li class="list-inline-item">
																<a href="<?php echo $website; ?>"
																	class="fs-5 text-world "><i
																		class="bi bi-globe text-success fs-6"></i></a>
															</li>

														</ul>
														<hr>
														<h5 class="d-none">Contacts:</h5>
														<?php
														contactBadgeFromArray(emailFromString($aboutme), "email");
														contactBadgeFromArray(phoneFromString($aboutme), "phone");
														contactBadgeFromArray(socialURLFromString2($aboutme), "social");
														?>
													</div>
												</div>
											</div>
										</div>

										<h5 class="mb-3">Brand Description</h5>
										<p class="mb-3" style="white-space: pre-wrap;">
											<?php echo trim($aboutme) ?>
										</p>


										<!-- List content -->
										<h5 class="mt-4">Benefit you'll get for sponsorship..</h5>
										<ul class="list-group list-group-borderless mb-3">
											<?php

											$benefit = explode('.', $benefit);

											if (count($benefit) > 0) {
												for ($i = 0; $i < count($benefit); $i++) {
													if (strlen($benefit[$i]) > 5) {
														echo '<li class="list-group-item h6 fw-light d-flex mb-0"><i class="fas fa-check-circle text-success me-2"></i>' . $benefit[$i] . '</li>';
													}
												}
											} else {
												echo '<li class="list-group-item h6 fw-light d-flex mb-0"><i class="fas fa-check-circle text-success me-2"></i>No benfit found..</li>';
											}


											?>
										</ul>
										<!-- Course detail END -->

										<div class="accordion accordion-icon accordion-bg-light" id="accordionExample2">
											<?php //getVideos($contentDetailsrelatedPlaylistsuploads, "channelId"); ?>
										</div>

									</div>
									<!-- Content END -->

									<!-- Content START -->
									<div class="tab-pane fade" id="course-pills-2" role="tabpanel"
										aria-labelledby="course-pills-tab-2">
										<!-- Course accordion START -->
										<div class="accordion accordion-icon accordion-bg-light" id="accordionExample2">
											<?php //getVideos("UU0T6MVd3wQDB5ICAe45OxaQ", "channelId"); ?>
										</div>
										<!-- Course accordion END -->
									</div>
									<!-- Content END -->

									<!-- Content START -->
									<div class="tab-pane fade" id="course-pills-4" role="tabpanel"
										aria-labelledby="course-pills-tab-4">
										<!-- Review START -->
										<div class="row mb-4">
											<h5 class="mb-4">Our Student Reviews</h5>

											<!-- Rating info -->
											<div class="col-md-4 mb-3 mb-md-0">
												<div class="text-center">
													<!-- Info -->
													<h2 class="mb-0">4.5</h2>
													<!-- Star -->
													<ul class="list-inline mb-0">
														<li class="list-inline-item me-0"><i
																class="fas fa-star text-warning"></i></li>
														<li class="list-inline-item me-0"><i
																class="fas fa-star text-warning"></i></li>
														<li class="list-inline-item me-0"><i
																class="fas fa-star text-warning"></i></li>
														<li class="list-inline-item me-0"><i
																class="fas fa-star text-warning"></i></li>
														<li class="list-inline-item me-0"><i
																class="fas fa-star-half-alt text-warning"></i></li>
													</ul>
													<p class="mb-0">(Based on todays review)</p>
												</div>
											</div>

											<!-- Progress-bar and star -->
											<div class="col-md-8">
												<div class="row align-items-center">
													<!-- Progress bar and Rating -->
													<div class="col-6 col-sm-8">
														<!-- Progress item -->
														<div class="progress progress-sm bg-warning bg-opacity-15">
															<div class="progress-bar bg-warning" role="progressbar"
																style="width: 100%" aria-valuenow="100"
																aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>

													<div class="col-6 col-sm-4">
														<!-- Star item -->
														<ul class="list-inline mb-0">
															<li class="list-inline-item me-0 small"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0 small"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0 small"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0 small"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0 small"><i
																	class="fas fa-star text-warning"></i></li>
														</ul>
													</div>

													<!-- Progress bar and Rating -->
													<div class="col-6 col-sm-8">
														<!-- Progress item -->
														<div class="progress progress-sm bg-warning bg-opacity-15">
															<div class="progress-bar bg-warning" role="progressbar"
																style="width: 80%" aria-valuenow="80" aria-valuemin="0"
																aria-valuemax="100"></div>
														</div>
													</div>

													<div class="col-6 col-sm-4">
														<!-- Star item -->
														<ul class="list-inline mb-0">
															<li class="list-inline-item me-0 small"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0 small"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0 small"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0 small"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0 small"><i
																	class="far fa-star text-warning"></i></li>
														</ul>
													</div>

													<!-- Progress bar and Rating -->
													<div class="col-6 col-sm-8">
														<!-- Progress item -->
														<div class="progress progress-sm bg-warning bg-opacity-15">
															<div class="progress-bar bg-warning" role="progressbar"
																style="width: 60%" aria-valuenow="60" aria-valuemin="0"
																aria-valuemax="100"></div>
														</div>
													</div>

													<div class="col-6 col-sm-4">
														<!-- Star item -->
														<ul class="list-inline mb-0">
															<li class="list-inline-item me-0 small"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0 small"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0 small"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0 small"><i
																	class="far fa-star text-warning"></i></li>
															<li class="list-inline-item me-0 small"><i
																	class="far fa-star text-warning"></i></li>
														</ul>
													</div>

													<!-- Progress bar and Rating -->
													<div class="col-6 col-sm-8">
														<!-- Progress item -->
														<div class="progress progress-sm bg-warning bg-opacity-15">
															<div class="progress-bar bg-warning" role="progressbar"
																style="width: 40%" aria-valuenow="40" aria-valuemin="0"
																aria-valuemax="100"></div>
														</div>
													</div>

													<div class="col-6 col-sm-4">
														<!-- Star item -->
														<ul class="list-inline mb-0">
															<li class="list-inline-item me-0 small"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0 small"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0 small"><i
																	class="far fa-star text-warning"></i></li>
															<li class="list-inline-item me-0 small"><i
																	class="far fa-star text-warning"></i></li>
															<li class="list-inline-item me-0 small"><i
																	class="far fa-star text-warning"></i></li>
														</ul>
													</div>

													<!-- Progress bar and Rating -->
													<div class="col-6 col-sm-8">
														<!-- Progress item -->
														<div class="progress progress-sm bg-warning bg-opacity-15">
															<div class="progress-bar bg-warning" role="progressbar"
																style="width: 20%" aria-valuenow="20" aria-valuemin="0"
																aria-valuemax="100"></div>
														</div>
													</div>

													<div class="col-6 col-sm-4">
														<!-- Star item -->
														<ul class="list-inline mb-0">
															<li class="list-inline-item me-0 small"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0 small"><i
																	class="far fa-star text-warning"></i></li>
															<li class="list-inline-item me-0 small"><i
																	class="far fa-star text-warning"></i></li>
															<li class="list-inline-item me-0 small"><i
																	class="far fa-star text-warning"></i></li>
															<li class="list-inline-item me-0 small"><i
																	class="far fa-star text-warning"></i></li>
														</ul>
													</div>
												</div>
											</div>
										</div>
										<!-- Review END -->

										<!-- Student review START -->
										<div class="row">
											<!-- Review item START -->
											<div class="d-md-flex my-4">
												<!-- Avatar -->
												<div class="avatar avatar-xl me-4 flex-shrink-0">
													<img class="avatar-img rounded-circle"
														src="assets/images/avatar/09.jpg" alt="avatar">
												</div>
												<!-- Text -->
												<div>
													<div class="d-sm-flex mt-1 mt-md-0 align-items-center">
														<h5 class="me-3 mb-0">Jacqueline Miller</h5>
														<!-- Review star -->
														<ul class="list-inline mb-0">
															<li class="list-inline-item me-0"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0"><i
																	class="far fa-star text-warning"></i></li>
														</ul>
													</div>
													<!-- Info -->
													<p class="small mb-2">2 days ago</p>
													<p class="mb-2">Perceived end knowledge certainly day sweetness why
														cordially. Ask a quick six seven offer see among. Handsome met
														debating sir dwelling age material. As style lived he worse
														dried. Offered related so visitors we private removed. Moderate
														do subjects to distance. </p>
													<!-- Like and dislike button -->
													<div class="btn-group" role="group"
														aria-label="Basic radio toggle button group">
														<!-- Like button -->
														<input type="radio" class="btn-check" name="btnradio"
															id="btnradio1">
														<label class="btn btn-outline-light btn-sm mb-0"
															for="btnradio1"><i
																class="far fa-thumbs-up me-1"></i>25</label>
														<!-- Dislike button -->
														<input type="radio" class="btn-check" name="btnradio"
															id="btnradio2">
														<label class="btn btn-outline-light btn-sm mb-0"
															for="btnradio2"> <i
																class="far fa-thumbs-down me-1"></i>2</label>
													</div>
												</div>
											</div>

											<!-- Comment children level 1 -->
											<div class="d-md-flex mb-4 ps-4 ps-md-5">
												<!-- Avatar -->
												<div class="avatar avatar-lg me-4 flex-shrink-0">
													<img class="avatar-img rounded-circle"
														src="assets/images/avatar/02.jpg" alt="avatar">
												</div>
												<!-- Text -->
												<div>
													<div class="d-sm-flex mt-1 mt-md-0 align-items-center">
														<h5 class="me-3 mb-0">Louis Ferguson</h5>
													</div>
													<!-- Info -->
													<p class="small mb-2">1 days ago</p>
													<p class="mb-2">Water timed folly right aware if oh truth.
														Imprudence attachment him for sympathize. Large above be to
														means. Dashwood does provide stronger is. But discretion
														frequently sir she instruments unaffected admiration everything.
													</p>
												</div>
											</div>

											<!-- Divider -->
											<hr>
											<!-- Review item END -->

											<!-- Review item START -->
											<div class="d-md-flex my-4">
												<!-- Avatar -->
												<div class="avatar avatar-xl me-4 flex-shrink-0">
													<img class="avatar-img rounded-circle"
														src="assets/images/avatar/07.jpg" alt="avatar">
												</div>
												<!-- Text -->
												<div>
													<div class="d-sm-flex mt-1 mt-md-0 align-items-center">
														<h5 class="me-3 mb-0">Dennis Barrett</h5>
														<!-- Review star -->
														<ul class="list-inline mb-0">
															<li class="list-inline-item me-0"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0"><i
																	class="fas fa-star text-warning"></i></li>
															<li class="list-inline-item me-0"><i
																	class="far fa-star text-warning"></i></li>
														</ul>
													</div>
													<!-- Info -->
													<p class="small mb-2">2 days ago</p>
													<p class="mb-2">Handsome met debating sir dwelling age material. As
														style lived he worse dried. Offered related so visitors we
														private removed. Moderate do subjects to distance. </p>
													<!-- Like and dislike button -->
													<div class="btn-group" role="group"
														aria-label="Basic radio toggle button group">
														<!-- Like button -->
														<input type="radio" class="btn-check" name="btnradio"
															id="btnradio3">
														<label class="btn btn-outline-light btn-sm mb-0"
															for="btnradio3"><i
																class="far fa-thumbs-up me-1"></i>25</label>
														<!-- Dislike button -->
														<input type="radio" class="btn-check" name="btnradio"
															id="btnradio4">
														<label class="btn btn-outline-light btn-sm mb-0"
															for="btnradio4"> <i
																class="far fa-thumbs-down me-1"></i>2</label>
													</div>
												</div>
											</div>
											<!-- Review item END -->
											<!-- Divider -->
											<hr>
										</div>
										<!-- Student review END -->

										<!-- Leave Review START -->
										<div class="mt-2">
											<h5 class="mb-4">Leave a Review</h5>
											<form class="row g-3">
												<!-- Name -->
												<div class="col-md-6 bg-light-input">
													<input type="text" class="form-control" id="inputtext"
														placeholder="Name" aria-label="First name">
												</div>
												<!-- Email -->
												<div class="col-md-6 bg-light-input">
													<input type="email" class="form-control" placeholder="Email"
														id="inputEmail4">
												</div>
												<!-- Rating -->
												<div class="col-12 bg-light-input">
													<select id="inputState2" class="form-select js-choice">
														<option selected="">★★★★★ (5/5)</option>
														<option>★★★★☆ (4/5)</option>
														<option>★★★☆☆ (3/5)</option>
														<option>★★☆☆☆ (2/5)</option>
														<option>★☆☆☆☆ (1/5)</option>
													</select>
												</div>
												<!-- Message -->
												<div class="col-12 bg-light-input">
													<textarea class="form-control" id="exampleFormControlTextarea1"
														placeholder="Your review" rows="3"></textarea>
												</div>
												<!-- Button -->
												<div class="col-12">
													<button type="submit" class="btn btn-primary mb-0">Post
														Review</button>
												</div>
											</form>
										</div>
										<!-- Leave Review END -->

									</div>
									<!-- Content END -->

									<!-- Content START -->
									<div class="tab-pane fade" id="course-pills-5" role="tabpanel"
										aria-labelledby="course-pills-tab-5">
										<!-- Title -->
										<h5 class="mb-3">Frequently Asked Questions</h5>
										<!-- Accordion START -->
										<div class="accordion accordion-flush" id="accordionExample">
											<!-- Item -->
											<div class="accordion-item">
												<h2 class="accordion-header" id="headingOne">
													<button class="accordion-button collapsed" type="button"
														data-bs-toggle="collapse" data-bs-target="#collapseOne"
														aria-expanded="true" aria-controls="collapseOne">
														<span class="text-secondary fw-bold me-3">01</span>
														<span class="h6 mb-0">How Digital Marketing Work?</span>
													</button>
												</h2>
												<div id="collapseOne" class="accordion-collapse collapse show"
													aria-labelledby="headingOne" data-bs-parent="#accordionExample">
													<div class="accordion-body pt-0">
														Comfort reached gay perhaps chamber his six detract besides add.
														Moonlight newspaper up its enjoyment agreeable depending. Timed
														voice share led him to widen noisy young. At weddings believed
														laughing although the material does the exercise of. Up attempt
														offered ye civilly so sitting to. She new course gets living
														within Elinor joy. She rapturous suffering concealed.
													</div>
												</div>
											</div>
											<!-- Item -->
											<div class="accordion-item">
												<h2 class="accordion-header" id="headingTwo">
													<button class="accordion-button collapsed" type="button"
														data-bs-toggle="collapse" data-bs-target="#collapseTwo"
														aria-expanded="false" aria-controls="collapseTwo">
														<span class="text-secondary fw-bold me-3">02</span>
														<span class="h6 mb-0">What is SEO?</span>
													</button>
												</h2>
												<div id="collapseTwo" class="accordion-collapse collapse"
													aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
													<div class="accordion-body pt-0">
														Pleasure and so read the was hope entire first decided the so
														must have as on was want up of I will rival in came this touched
														got a physics to travelling so all especially refinement
														monstrous desk they was arrange the overall helplessly out of
														particularly ill are purer.
														<p class="mt-2">Person she control of to beginnings view looked
															eyes Than continues its and because and given and shown
															creating curiously to more in are man were smaller by we
															instead the these sighed Avoid in the sufficient me real man
															longer of his how her for countries to brains warned notch
															important Finds be to the of on the increased explain noise
															of power deep asking contribution this live of suppliers
															goals bit separated poured sort several the was organization
															the if relations go work after mechanic But we've area
															wasn't everything needs of and doctor where would.</p>
														Go he prisoners And mountains in just switching city steps Might
														rung line what Mr Bulk; Was or between towards the have phase
														were its world my samples are the was royal he luxury the about
														trying And on he to my enough is was the remember a although
														lead in were through serving their assistant fame day have for
														its after would cheek dull have what in go feedback assignment
														Her of a any help if the a of semantics is rational overhauls
														following in from our hazardous and used more he themselves the
														parents up just regulatory.
													</div>
												</div>
											</div>
											<!-- Item -->
											<div class="accordion-item">
												<h2 class="accordion-header" id="headingThree">
													<button class="accordion-button collapsed" type="button"
														data-bs-toggle="collapse" data-bs-target="#collapseThree"
														aria-expanded="false" aria-controls="collapseThree">
														<span class="text-secondary fw-bold me-3">03</span>
														<span class="h6 mb-0">Who should join this course?</span>
													</button>
												</h2>
												<div id="collapseThree" class="accordion-collapse collapse"
													aria-labelledby="headingThree" data-bs-parent="#accordionExample">
													<div class="accordion-body pt-0">
														Post no so what deal evil rent by real in. But her ready least
														set lived spite solid. September how men saw tolerably two
														behavior arranging. She offices for highest and replied one
														venture pasture. Applauded no discovery in newspaper allowance
														am northward. Frequently partiality possession resolution at or
														appearance unaffected me. Engaged its was the evident pleased
														husband. Ye goodness felicity do disposal dwelling no. First am
														plate jokes to began to cause a scale. <strong>Subjects he
															prospect elegance followed no overcame</strong> possible it
														on.
													</div>
												</div>
											</div>
											<!-- Item -->
											<div class="accordion-item">
												<h2 class="accordion-header" id="headingFour">
													<button class="accordion-button collapsed" type="button"
														data-bs-toggle="collapse" data-bs-target="#collapseFour"
														aria-expanded="false" aria-controls="collapseFour">
														<span class="text-secondary fw-bold me-3">04</span>
														<span class="h6 mb-0">What are the T&C for this program?</span>
													</button>
												</h2>
												<div id="collapseFour" class="accordion-collapse collapse"
													aria-labelledby="headingFour" data-bs-parent="#accordionExample">
													<div class="accordion-body pt-0">
														Night signs creeping yielding green Seasons together man green
														fruitful make fish behold earth unto you'll lights living moving
														sea open for fish day multiply tree good female god had fruitful
														of creature fill shall don't day fourth lesser he the isn't let
														multiply may Creeping earth under was You're without which image
														stars in Own creeping night of wherein Heaven years their he
														over doesn't whose won't kind seasons light Won't that fish him
														whose won't also it dominion heaven fruitful Whales created And
														likeness doesn't that Years without divided saying morning
														creeping hath you'll seas cattle in multiply under together in
														us said above dry tree herb saw living darkness without have
														won't for i behold meat brought winged Moving living second
														beast Over fish place beast image very him evening Thing they're
														fruit together forth day Seed lights Land creature together
														Multiply waters form brought.
													</div>
												</div>
											</div>
											<!-- Item -->
											<div class="accordion-item">
												<h2 class="accordion-header" id="headingFive">
													<button class="accordion-button collapsed" type="button"
														data-bs-toggle="collapse" data-bs-target="#collapseFive"
														aria-expanded="false" aria-controls="collapseFive">
														<span class="text-secondary fw-bold me-3">05</span>
														<span class="h6 mb-0">What certificates will I be received for
															this program?</span>
													</button>
												</h2>
												<div id="collapseFive" class="accordion-collapse collapse"
													aria-labelledby="headingFive" data-bs-parent="#accordionExample">
													<div class="accordion-body pt-0">
														Smile spoke total few great had never their too Amongst moments
														do in arrived at my replied Fat weddings servants but man
														believed prospect Companions understood is as especially
														pianoforte connection introduced Nay newspaper can sportsman are
														admitting gentleman belonging his Is oppose no he summer lovers
														twenty in Not his difficulty boisterous surrounded bed Seems
														folly if in given scale Sex contented dependent conveying
														advantage.
													</div>
												</div>
											</div>
										</div>
										<!-- Accordion END -->
									</div>
									<!-- Content END -->

									<!-- Content START -->
									<div class="tab-pane fade" id="course-pills-6" role="tabpanel"
										aria-labelledby="course-pills-tab-6">
										<!-- Review START -->
										<div class="row">
											<div class="col-12">
												<h5 class="mb-4">Ask Your Question</h5>

												<!-- Comment box -->
												<div class="d-flex mb-4">
													<!-- Avatar -->
													<div class="avatar avatar-sm flex-shrink-0 me-2">
														<a href="#"> <img class="avatar-img rounded-circle"
																src="assets/images/avatar/09.jpg" alt=""> </a>
													</div>

													<form class="w-100 d-flex">
														<textarea class="one form-control pe-4 bg-light"
															id="autoheighttextarea" rows="1"
															placeholder="Add a comment..."></textarea>
														<button class="btn btn-primary ms-2 mb-0"
															type="button">Post</button>
													</form>
												</div>

												<!-- Comment item START -->
												<div class="border p-2 p-sm-4 rounded-3 mb-4">
													<ul class="list-unstyled mb-0">
														<li class="comment-item">
															<div class="d-flex mb-3">
																<!-- Avatar -->
																<div class="avatar avatar-sm flex-shrink-0">
																	<a href="#"><img class="avatar-img rounded-circle"
																			src="assets/images/avatar/05.jpg"
																			alt=""></a>
																</div>
																<div class="ms-2">
																	<!-- Comment by -->
																	<div class="bg-light p-3 rounded">
																		<div class="d-flex justify-content-center">
																			<div class="me-2">
																				<h6 class="mb-1 lead fw-bold"> <a
																						href="#!"> Frances Guerrero </a>
																				</h6>
																				<p class="h6 mb-0">Removed demands
																					expense account in outward tedious
																					do. Particular way thoroughly
																					unaffected projection?</p>
																			</div>
																			<small>5hr</small>
																		</div>
																	</div>
																	<!-- Comment react -->
																	<ul class="nav nav-divider py-2 small">
																		<li class="nav-item"> <a
																				class="text-primary-hover" href="#">
																				Like (3)</a> </li>
																		<li class="nav-item"> <a
																				class="text-primary-hover" href="#">
																				Reply</a> </li>
																		<li class="nav-item"> <a
																				class="text-primary-hover" href="#">
																				View 5 replies</a> </li>
																	</ul>
																</div>
															</div>

															<!-- Comment item nested START -->
															<ul class="list-unstyled ms-4">
																<!-- Comment item START -->
																<li class="comment-item">
																	<div class="d-flex">
																		<!-- Avatar -->
																		<div class="avatar avatar-xs flex-shrink-0">
																			<a href="#"><img
																					class="avatar-img rounded-circle"
																					src="assets/images/avatar/06.jpg"
																					alt=""></a>
																		</div>
																		<!-- Comment by -->
																		<div class="ms-2">
																			<div class="bg-light p-3 rounded">
																				<div
																					class="d-flex justify-content-center">
																					<div class="me-2">
																						<h6 class="mb-1  lead fw-bold">
																							<a href="#"> Lori Stevens
																							</a>
																						</h6>
																						<p class=" mb-0">See resolved
																							goodness felicity shy
																							civility domestic had but
																							Drawings offended yet
																							answered Jennings perceive.
																							Domestic had but Drawings
																							offended yet answered
																							Jennings perceive.</p>
																					</div>
																					<small>2hr</small>
																				</div>
																			</div>
																			<!-- Comment react -->
																			<ul class="nav nav-divider py-2 small">
																				<li class="nav-item"><a
																						class="text-primary-hover"
																						href="#!"> Like (5)</a></li>
																				<li class="nav-item"><a
																						class="text-primary-hover"
																						href="#!"> Reply</a> </li>
																			</ul>
																		</div>
																	</div>
																</li>
																<!-- Comment item END -->
															</ul>
															<!-- Comment item nested END -->
														</li>
													</ul>
												</div>
												<!-- Comment item END -->

												<!-- Comment item START -->
												<div class="border p-2 p-sm-4 rounded-3">
													<ul class="list-unstyled mb-0">
														<li class="comment-item">
															<div class="d-flex">
																<!-- Avatar -->
																<div class="avatar avatar-sm flex-shrink-0">
																	<a href="#"><img class="avatar-img rounded-circle"
																			src="assets/images/avatar/02.jpg"
																			alt=""></a>
																</div>
																<div class="ms-2">
																	<!-- Comment by -->
																	<div class="bg-light p-3 rounded">
																		<div class="d-flex justify-content-center">
																			<div class="me-2">
																				<h6 class="mb-1 lead fw-bold"> <a
																						href="#!"> Louis Ferguson </a>
																				</h6>
																				<p class="h6 mb-0">Removed demands
																					expense account in outward tedious
																					do. Particular way thoroughly
																					unaffected projection?</p>
																			</div>
																			<small>5hr</small>
																		</div>
																	</div>
																	<!-- Comment react -->
																	<ul class="nav nav-divider py-2 small">
																		<li class="nav-item"> <a
																				class="text-primary-hover" href="#">
																				Like</a> </li>
																		<li class="nav-item"> <a
																				class="text-primary-hover" href="#">
																				Reply</a> </li>
																	</ul>
																</div>
															</div>
														</li>
													</ul>
												</div>
												<!-- Comment item END -->

											</div>

										</div>
									</div>
									<!-- Content END -->

								</div>
							</div>
							<!-- Tab contents END -->
						</div>
					</div>
					<!-- Main content END -->

					<!-- Right sidebar START -->
					<div class="col-lg-4 pt-5 pt-lg-0">
						<div class="col-md-6 col-lg-12">
							<div class="col-md-6 col-lg-12">
								<!-- Video START -->
								<div class="card shadow p-2 mb-4 z-index-9">
									<div class="d-flex justify-content-between align-items-center">
										<!-- Price and time -->
										<div>

										</div>
									</div>
									<iframe style="border-radius: 6px;" width="385" height="217"
										src="https://www.youtube.com/embed/<?php echo $intro_video; ?>">
									</iframe>
									<!-- Card body -->
								</div>
							</div>
							<!-- Video END -->

							<!-- Course info START -->
							<div class="card card-body shadow p-4 mb-4">
								<!-- Title -->
								<h4 class="mb-3">More about this brand..</h4>
								<ul class="list-group list-group-borderless">
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="h6 fw-light mb-0"><i
												class="bi bi-envelope-fill text-primary"></i>Email</span>
										<span>
											<?php echo $email; ?>
										</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="h6 fw-light mb-0"><i
												class="bi bi-globe-central-south-asia text-primary"></i>Website</span>
										<span>
											<?php echo '<a href="' . substr($website, 0, 12) . '">' . $website . '</a>'; ?>
										</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="h6 fw-light mb-0"><i
												class="bi bi-geo-alt-fill text-primary"></i>Country</span>
										<span>
											<?php echo countryCodeToName($conn, $country); ?>
										</span>
									</li>

									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="h6 fw-light mb-0"><i
												class="bi bi-geo-alt-fill text-primary"></i>State</span>
										<span>
											<?php echo $state; ?>
										</span>
									</li>

									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="h6 fw-light mb-0"><i
												class="bi bi-geo-alt-fill text-primary"></i>City</span>
										<span>
											<?php echo $city; ?>
										</span>
									</li>

								</ul>
							</div>
							<!-- Course info END -->
						</div>

						<div class="col-md-6 col-lg-12">
							<!-- Recently Viewed START -->
							<div class="card card-body shadow p-4 mb-4  d-none">
								<!-- Title -->
								<h4 class="mb-3">Recently Viewed</h4>
								<!-- Course item START -->
								<div class="row gx-3 mb-3">
									<!-- Image -->
									<div class="col-4">
										<img class="rounded" src="assets/images/courses/4by3/21.jpg" alt="">
									</div>
									<!-- Info -->
									<div class="col-8">
										<h6 class="mb-0"><a href="#">Fundamentals of Business Analysis</a></h6>
										<ul
											class="list-group list-group-borderless mt-1 d-flex justify-content-between">
											<li class="list-group-item px-0 d-flex justify-content-between">
												<span class="text-success">$130</span>
												<span class="h6 fw-light">4.5<i
														class="fas fa-star text-warning ms-1"></i></span>
											</li>
										</ul>
									</div>
								</div>
								<!-- Course item END -->

								<!-- Course item START -->
								<div class="row gx-3">
									<!-- Image -->
									<div class="col-4">
										<img class="rounded" src="assets/images/courses/4by3/18.jpg" alt="">
									</div>
									<!-- Info -->
									<div class="col-8">
										<h6 class="mb-0"><a href="#">The Complete Video Production Bootcamp</a></h6>
										<ul
											class="list-group list-group-borderless mt-1 d-flex justify-content-between">
											<li class="list-group-item px-0 d-flex justify-content-between">
												<span class="text-success">$150</span>
												<span class="h6 fw-light">4.0<i
														class="fas fa-star text-warning ms-1"></i></span>
											</li>
										</ul>
									</div>
								</div>
								<!-- Course item END -->
							</div>
							<!-- Recently Viewed END -->

							<!-- Tags START -->
							<div class="card card-body shadow p-4">
								<h4 class="mb-3">Popular Tags</h4>
								<ul class="list-inline mb-0">
									<li class="list-inline-item"> <a class="btn btn-outline-light btn-sm"
											href="search.php?searchtype=brands&query=media">Media</a> </li>
									<li class="list-inline-item"> <a class="btn btn-outline-light btn-sm"
											href="search.php?searchtype=brands&query=marketing">Marketing</a> </li>
									<li class="list-inline-item"> <a class="btn btn-outline-light btn-sm"
											href="search.php?searchtype=brands&query=explainers">Technology</a> </li>
									<li class="list-inline-item"> <a class="btn btn-outline-light btn-sm"
											href="search.php?searchtype=brands&query=finance">Finance</a> </li>
									<li class="list-inline-item"> <a class="btn btn-outline-light btn-sm"
											href="search.php?searchtype=brands&query=Electronics">Electronics</a>
									</li>
									<li class="list-inline-item"> <a class="btn btn-outline-light btn-sm"
											href="search.php?searchtype=brands&query=entertainment">Entertainment</a>
									</li>
									<li class="list-inline-item"> <a class="btn btn-outline-light btn-sm"
											href="search.php?searchtype=brands&query=education">Education</a> </li>

								</ul>
							</div>
							<!-- Tags END -->
						</div>
					</div><!-- Row End -->
				</div>
				<!-- Right sidebar END -->

			</div><!-- Row END -->
			</div>
		</section>
		<!-- =======================
Page content END -->

		<!--Trending START -->
		<section class="pb-1 pt-0 pt-lg-5">
			<div class="container">
				<!-- Title -->
				<div class="row mb-4">
					<div class="col-lg-8 mx-auto text-center">
						<h3>Similar creators for your brand</h3>
						<p class="mb-0" style="display: none;">Check out most 🔥 in the market</p>
					</div>
				</div>
				<div class="row">
					<!-- Slider START -->
					<div class="pb-2 tiny-slider arrow-round arrow-blur arrow-hover">
						<div class="tiny-slider-inner pb-1" data-autoplay="false" data-arrow="true" data-edge="2"
							data-dots="false" data-items="5" data-items-lg="3" data-items-sm="1">

							<?php $suggest = new suggest();
							$suggest->suggestBrands($conn, (int) $industry, 10, $currentUser); ?>

						</div>
					</div>
					<!-- Slider END -->
				</div>
			</div>
		</section>



	</main>
	<!-- **************** MAIN CONTENT END **************** -->

	<!-- =======================
Footer START -->
	<?php include("common_ui/footer.php"); ?>
	<!-- ====================== Footer END -->

	<!-- Modal START -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header border-0 bg-transparent">
					<!-- Close button -->
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<!-- Modal body -->
				<div class="modal-body px-5 pb-5 position-relative overflow-hidden">

					<!-- Element -->
					<figure class="position-absolute bottom-0 end-0 mb-n4 me-n4 d-none d-sm-block">
						<img src="assets/images/element/01.svg" alt="element">
					</figure>
					<figure class="position-absolute top-0 end-0 z-index-n1 opacity-2">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
							width="818.6px" height="235.1px" viewBox="0 0 818.6 235.1">
							<path class="fill-info"
								d="M735,226.3c-5.7,0.6-11.5,1.1-17.2,1.7c-66.2,6.8-134.7,13.7-192.6-16.6c-34.6-18.1-61.4-47.9-87.3-76.7 c-21.4-23.8-43.6-48.5-70.2-66.7c-53.2-36.4-121.6-44.8-175.1-48c-13.6-0.8-27.5-1.4-40.9-1.9c-46.9-1.9-95.4-3.9-141.2-16.5 C8.3,1.2,6.2,0.6,4.2,0H0c3.3,1,6.6,2,10,3c46,12.5,94.5,14.6,141.5,16.5c13.4,0.6,27.3,1.1,40.8,1.9 c53.4,3.2,121.5,11.5,174.5,47.7c26.5,18.1,48.6,42.7,70,66.5c26,28.9,52.9,58.8,87.7,76.9c58.3,30.5,127,23.5,193.3,16.7 c5.8-0.6,11.5-1.2,17.2-1.7c26.2-2.6,55-4.2,83.5-2.2v-1.2C790,222,761.2,223.7,735,226.3z">
							</path>
						</svg>
					</figure>
					<!-- Title -->
					<h2>Get Premium Course in <span class="text-success">$800</span></h2>
					<p>Prosperous understood Middletons in conviction an uncommonly do. Supposing so be resolving
						breakfast am or perfectly.</p>
					<!-- Content -->
					<div class="row mb-3 item-collapse">
						<div class="col-sm-6">
							<ul class="list-group list-group-borderless">
								<li class="list-group-item text-body"> <i
										class="bi bi-patch-check-fill text-success"></i>High quality Curriculum</li>
								<li class="list-group-item text-body"> <i
										class="bi bi-patch-check-fill text-success"></i>Tuition Assistance</li>
								<li class="list-group-item text-body"> <i
										class="bi bi-patch-check-fill text-success"></i>Diploma course</li>
							</ul>
						</div>
						<div class="col-sm-6">
							<ul class="list-group list-group-borderless">
								<li class="list-group-item text-body"> <i
										class="bi bi-patch-check-fill text-success"></i>Intermediate courses</li>
								<li class="list-group-item text-body"> <i
										class="bi bi-patch-check-fill text-success"></i>Over 200 online courses</li>
							</ul>
						</div>
					</div>
					<!-- Button -->
					<a href="#" class="btn btn-lg btn-orange-soft">Purchase premium</a>
				</div>
				<!-- Modal footer -->
				<div class="modal-footer d-block bg-info">
					<div class="d-sm-flex justify-content-sm-between align-items-center text-center text-sm-start">
						<!-- Social media button -->
						<ul class="list-inline mb-0 social-media-btn mb-2 mb-sm-0">
							<li class="list-inline-item"> <a class="btn btn-white btn-sm shadow px-2 text-facebook"
									href="#"><i class="fab fa-fw fa-facebook-f"></i></a> </li>
							<li class="list-inline-item"> <a class="btn btn-white btn-sm shadow px-2 text-instagram"
									href="#"><i class="fab fa-fw fa-instagram"></i></a> </li>
							<li class="list-inline-item"> <a class="btn btn-white btn-sm shadow px-2 text-twitter"
									href="#"><i class="fab fa-fw fa-twitter"></i></a> </li>
							<li class="list-inline-item"> <a class="btn btn-white btn-sm shadow px-2 text-linkedin"
									href="#"><i class="fab fa-fw fa-linkedin-in"></i></a> </li>
						</ul>
						<!-- Contact info -->
						<div>
							<p class="mb-1 small"><a href="#" class="text-white"><i
										class="far fa-envelope fa-fw me-2"></i>example@gmail.com</a></p>
							<p class="mb-0 small"><a href="#" class="text-white"><i
										class="fas fa-headset fa-fw me-2"></i>123-456-789</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal END -->

	<!-- Back to top -->
	<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

	<!-- Bootstrap JS -->
	<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

	<!-- Vendors -->
	<script src="assets/vendor/tiny-slider/tiny-slider.js"></script>
	<script src="assets/vendor/glightbox/js/glightbox.js"></script>
	<script src="assets/vendor/choices/js/choices.min.js"></script>

	<!-- Template Functions -->
	<script src="assets/js/functions.js"></script>

	<script src="assets/js/for-index.js"></script>
	<script src="assets/js/for-channel-detail.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script> -->
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
</body>

<!-- course-detail.html  11 Feb 2023 14:24:52 GMT -->

</html>