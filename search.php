<?php
session_start();

if (!isset($_GET['searchtype'])) {
	header("Location: search.php?searchtype=creators");
	exit();
}

require_once("misc/db.php");
?>

<!DOCTYPE html>
<html lang="en">

<!-- course-grid-2.html  11 Feb 2023 14:24:51 GMT -->

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

		<!-- =======================
Page content START -->
		<section class="pt-0">
			<div class="container">

				<!-- Filter bar START for BRAND -->
				<form id="brand-form" class="bg-light border p-4 rounded-3 my-4 z-index-9 position-relative"
					method="GET" action="d" <?php $searchtype = $_GET['searchtype'];
					$display = $searchtype == "brands" ? "style='display:block'" : "style='display:none'";
					echo $display; ?>>
					<div class="row g-3">
						<!-- Input -->
						<div class="col-xl-3">
							<input class="form-control me-1" type="search" placeholder="Enter keyword"
								id="brand-keyword" name="brand-keyword" value="online education">
						</div>

						<!-- Select item -->
						<div class="col-xl-8">
							<div class="row g-3">
								<!-- Select items -->
								<div class="col-sm-6 col-md-3 pb-2 pb-md-0">
									<select class="form-select form-select-sm js-choice"
										aria-label=".form-select-sm example" id="brand-industry" name="brand-industry">
										<option value="">Industry</option>
										<option value="0" selected>Technology</option>
										<option value="1">Media</option>
										<option value="2">Advertising</option>
										<option value="3">Marketing</option>
										<option value="4">Stock market</option>
										<option value="5">Financial services</option>
										<option value="6">Education</option>
										<option value="7">Trade</option>
										<option value="8">Manufacturing</option>
										<option value="9">Health care</option>
										<option value="10">Food industry</option>
										<option value="11">E-commerce</option>
										<option value="12">Telecommunications</option>
										<option value="13">Electronics</option>
										<option value="14">Fintech</option>
										<option value="15">Energy</option>
										<option value="16">Economics</option>
										<option value="17">Agriculture</option>
										<option value="18">Construction</option>
										<option value="19">Mining</option>
										<option value="20">Retail</option>
										<option value="21">Infrastructure</option>
										<option value="22">Hospitality</option>
										<option value="23">Business Process</option>
										<option value="24">Otherr</option>

									</select>
								</div>

								<!-- Search item -->
								<div class="col-sm-6 col-md-3 pb-2 pb-md-0">
									<select class="form-select form-select-sm js-choice"
										aria-label=".form-select-sm example" id="brand-type" name="brand-type">
										<option value="">Sponso Type</option>
										<option value="1" selected>Brand sponsorships</option>
										<option value="2">Product sponsorships</option>
										<option value="3">Affiliate sponsorships</option>
										<option value="4">Event sponsorships</option>
										<option value="5">Channel sponsorships</option>
										<option value="6">Paid reviews</option>
										<option value="7">Sponsored giveaways</option>
										<option value="8">Brand ambassadorship</option>
										<option value="9">Sponsored trips or travel vlogs</option>
										<option value="10">Product comparisons</option>
										<option value="11">Sponsored social media posts</option>
										<option value="12">Sponsored written content</option>
										<option value="13">Branded merchandise collaborations</option>
										<option value="0">Other/All</option>
									</select>
								</div>

								<!-- Search item -->
								<div class="col-sm-6 col-md-3 pb-2 pb-md-0">
									<select class="form-select form-select-sm js-choice"
										aria-label=".form-select-sm example" id="brand-category" name="brand-category">
										<option value="">Category</option>
										<option value="0">Techincal</option>
										<option value="1">Commercial</option>
										<option value="2">Vlogger</option>
										<option value="3" selected>Education</option>
										<option value="4">Photogradphy</option>
										<option value="5">Gaming</option>
										<option value="6">Fitness</option>
										<option value="7">News</option>
										<option value="8">Comody Shows</option>
										<option value="9">Makeup</option>
										<option value="10">Experiment</option>
										<option value="11">Toy Review</option>
										<option value="12">Food</option>
										<option value="13">Clothe</option>
									</select>
								</div>

								<!-- Search item -->
								<div class="col-sm-6 col-md-3 pb-2 pb-md-0">
									<select class="form-select form-select-sm js-choice"
										aria-label=".form-select-sm example" id="brand-country" name="brand-country">
										<option value="">Country</option>
										<option value="India" data-id="101" selected>India</option>
										<?php
										$sql = "SELECT * FROM countries";
										$result = $conn->query($sql);

										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
												echo "<option value='" . $row['name'] . "' data-id='" . $row['id'] . "'>" . $row['name'] . "</option>";
											}
										} else
										?>
									</select>
								</div>
							</div> <!-- Row END -->
						</div>
						<!-- Button -->
						<div class="col-xl-1">
							<button type="button" class="btn btn-primary mb-0 rounded z-index-1 w-100"
								id="brand-submit"><i class="fas fa-search"></i></button>
						</div>
					</div> <!-- Row END -->
				</form>
				<!-- Filter bar END -->

				<!-- Filter bar START for SPONSORHIPS-->
				<form id="sponsorship-form" class="bg-light border p-4 rounded-3 my-4 z-index-9 position-relative"
					method="GET" action="d" <?php $st2 = $_GET['searchtype'] == "sponsorships" ? "style='display:block'" : "style='display:none'";
					echo $st2; ?>>
					<div class="row g-3">
						<!-- Input -->
						<div class="col-xl-3">
							<input class="form-control me-1" type="search" placeholder="Enter keyword"
								id="sponsorship-keyword" name="sponsorship-keyword" value="Online education">
						</div>

						<!-- Select item -->
						<div class="col-xl-8">
							<div class="row g-3">
								<!-- Select items -->
								<div class="col-sm-6 col-md-3 pb-2 pb-md-0">
									<select class="form-select form-select-sm js-choice"
										aria-label=".form-select-sm example" id="sponsorship-industry"
										name="sponsorship-industry">
										<option value="">Industry</option>
										<option value="0" selected>Technology</option>
										<option value="1">Media</option>
										<option value="2">Advertising</option>
										<option value="3">Marketing</option>
										<option value="4">Stock market</option>
										<option value="5">Financial services</option>
										<option value="6">Education</option>
										<option value="7">Trade</option>
										<option value="8">Manufacturing</option>
										<option value="9">Health care</option>
										<option value="10">Food industry</option>
										<option value="11">E-commerce</option>
										<option value="12">Telecommunications</option>
										<option value="13">Electronics</option>
										<option value="14">Fintech</option>
										<option value="15">Energy</option>
										<option value="16">Economics</option>
										<option value="17">Agriculture</option>
										<option value="18">Construction</option>
										<option value="19">Mining</option>
										<option value="20">Retail</option>
										<option value="21">Infrastructure</option>
										<option value="22">Hospitality</option>
										<option value="23">Business Process</option>
										<option value="24">Otherr</option>
									</select>
								</div>


								<!-- Search item -->
								<div class="col-sm-6 col-md-3 pb-2 pb-md-0">
									<select class="form-select form-select-sm js-choice"
										aria-label=".form-select-sm example" id="sponsorship-type"
										name="sponsorship-type">
										<option value="">Sponsorship Type</option>
										<option value="1" selected>Type 1</option>
										<option value="2">Type 2</option>
										<option value="3">Type 3</option>
										<option value="4">Type 4</option>
										<option value="5">Type 5</option>
									</select>
								</div>

								<!-- Search item -->
								<div class="col-sm-6 col-md-3 pb-2 pb-md-0">
									<select class="form-select form-select-sm js-choice"
										aria-label=".form-select-sm example" id="sponsorship-category"
										name="sponsorship-caetgory">
										<option value="">Category</option>
										<option value="0">Techincal</option>
										<option value="1">Commercial</option>
										<option value="2">Vlogger</option>
										<option value="3" selected>Educator</option>
										<option value="4">Photogradphy</option>
										<option value="5">Gaming</option>
										<option value="6">Fitness</option>
										<option value="7">News</option>
										<option value="8">Comedy Shows</option>
										<option value="9">Makeup</option>
										<option value="10">Experiment</option>
										<option value="11">Toy Review</option>
										<option value="12">Food</option>
										<option value="13">Clothe</option>
									</select>
								</div>

								<!-- Search item -->
								<div class="col-sm-6 col-md-3 pb-2 pb-md-0">
									<select class="form-select form-select-sm js-choice"
										aria-label=".form-select-sm example" id="sponsorship-country"
										name="sponsorship-country">
										<option value="">Country</option>
										<option value="India" data-id="101" selected>India</option>
										<?php
										$sql = "SELECT * FROM countries";
										$result = $conn->query($sql);

										if ($result->num_rows > 0) {

											while ($row = $result->fetch_assoc()) {
												echo "<option value='" . $row['name'] . "' data-id='" . $row['id'] . "'>" . $row['name'] . "</option>";
											}
										} else
										?>
									</select>
								</div>
							</div> <!-- Row END -->
						</div>
						<!-- Button -->
						<div class="col-xl-1">
							<button type="button" class="btn btn-primary mb-0 rounded z-index-1 w-100"
								id="sponsorship-submit"><i class="fas fa-search"></i></button>
						</div>
					</div> <!-- Row END -->
				</form>
				<!-- Filter bar END -->

				<!-- Filter bar START for CREATORS-->
				<form class="bg-light border p-4 rounded-3 my-4 z-index-9 position-relative" method="GET" action="d"
					<?php $st3 = $_GET['searchtype'] == "creators" ? "style='display:block'" : "style='display:none'";
					echo $st3; ?>>
					<div class="row g-3">
						<!-- Input -->
						<div class="col-xl-3">
							<input class="form-control me-1" type="search" placeholder="Enter keyword"
								value="explainers" id="creator-keyword" name="creator-keyword">
						</div>

						<!-- Select item -->
						<div class="col-xl-8">
							<div class="row g-3">
								<!-- Select items -->
								<div class="col-sm-6 col-md-3 pb-2 pb-md-0">
									<select class="form-select form-select-sm js-choice"
										aria-label=".form-select-sm example" id="creator-category"
										name="creator-category">
										<option value="">Channel Category</option>
										<option value="0" selected>Techincal</option>
										<option value="1">Commercial</option>
										<option value="2">Vlogger</option>
										<option value="3">Educator</option>
										<option value="4">Photogradphy</option>
										<option value="5">Gaming</option>
										<option value="6">Fitness</option>
										<option value="7">News</option>
										<option value="8">Comody Shows</option>
										<option value="9">Makeup</option>
										<option value="10">Experiment</option>
										<option value="11">Toy Review</option>
										<option value="12">Food</option>
										<option value="13">Clothe</option>
									</select>
								</div>

								<!-- Search item -->
								<div class="col-sm-6 col-md-3 pb-2 pb-md-0">
									<select class="form-select form-select-sm js-choice"
										aria-label=".form-select-sm example" id="creator-subscriber"
										name="creator-subscriber">
										<option value="">Subcriber</option>
										<option value="1" selected>High</option>
										<option value="2">Low</option>
									</select>
								</div>

								<!-- Search item -->
								<div class="col-sm-6 col-md-3 pb-2 pb-md-0">
									<select class="form-select form-select-sm js-choice"
										aria-label=".form-select-sm example" id="creator-sponsorshiptype"
										name="creator-sponsorshiptype">
										<option value="">Sposnorship Type</option>
										<option value="1" selected>Type 1</option>
										<option value="2">Type 2</option>
										<option value="3">Type 3</option>
										<option value="4">Type 4</option>
										<option value="5">Type 5</option>
									</select>
								</div>

								<!-- Search item -->
								<div class="col-sm-6 col-md-3 pb-2 pb-md-0">
									<select class="form-select form-select-sm js-choice"
										aria-label=".form-select-sm example" id="creator-country"
										name="creator-country">
										<option value="">Country</option>
										<option value="India" data-id="101" selected>India</option>
										<?php
										$sql = "SELECT * FROM countries";
										$result = $conn->query($sql);

										if ($result->num_rows > 0) {

											while ($row = $result->fetch_assoc()) {
												echo "<option value='" . $row['name'] . "' data-id='" . $row['id'] . "'>" . $row['name'] . "</option>";
											}
										} else
										?>
									</select>
								</div>
							</div> <!-- Row END -->
						</div>
						<!-- Button -->
						<div class="col-xl-1">
							<button type="button" class="btn btn-primary mb-0 rounded z-index-1 w-100"
								id="creator-submit"><i class="fas fa-search"></i></button>
						</div>
					</div> <!-- Row END -->
				</form>
				<!-- Filter bar END -->

				<!-- Filter bar START for COLLABORATORS-->
				<form class="bg-light border p-4 rounded-3 my-4 z-index-9 position-relative" method="GET" action="d"
					<?php $st4 = $_GET['searchtype'] == "collaborators" ? "style='display:block'" : "style='display:none'";
					echo $st4; ?>>
					<div class="row g-3">
						<!-- Input -->
						<div class="col-xl-3">
							<input class="form-control me-1" type="search" placeholder="Enter keyword"
								id="collaborators-keyword" name="collaborators-keyword">
						</div>

						<!-- Select item -->
						<div class="col-xl-8">
							<div class="row g-3">
								<!-- Select items -->
								<div class="col-sm-6 col-md-3 pb-2 pb-md-0">
									<select class="form-select form-select-sm js-choice"
										aria-label=".form-select-sm example" id="collaborators-category"
										name="collaborators-category">
										<option value="">Channel Category</option>
										<option value="0">Techincal</option>
										<option value="1">Commercial</option>
										<option value="2">Vlogger</option>
										<option value="3">Educator</option>
										<option value="4">Photogradphy</option>
										<option value="5">Gaming</option>
										<option value="6">Fitness</option>
										<option value="7">News</option>
										<option value="8">Comody Shows</option>
										<option value="9">Makeup</option>
										<option value="10">Experiment</option>
										<option value="11">Toy Review</option>
										<option value="12">Food</option>
										<option value="13">Clothe</option>
									</select>
								</div>

								<!-- Search item -->
								<div class="col-sm-6 col-md-3 pb-2 pb-md-0">
									<select class="form-select form-select-sm js-choice"
										aria-label=".form-select-sm example" id="collaborators-subscriber"
										name="collaborators-subscriber">
										<option value="">Subcriber</option>
										<option value="1">High</option>
										<option value="2">Low</option>
									</select>
								</div>

								<!-- Search item -->
								<div class="col-sm-6 col-md-3 pb-2 pb-md-0">
									<select class="form-select form-select-sm js-choice"
										aria-label=".form-select-sm example" id="collaborators-sponsorshiptype"
										name="collaborators-sponsorshiptype">
										<option value="">Sposnorship Type</option>
										<option value="1">Type 1</option>
										<option value="2">Type 2</option>
										<option value="3">Type 3</option>
										<option value="4">Type 4</option>
										<option value="5">Type 5</option>
									</select>
								</div>

								<!-- Search item -->
								<div class="col-sm-6 col-md-3 pb-2 pb-md-0">
									<select class="form-select form-select-sm js-choice"
										aria-label=".form-select-sm example" id="collaborators-country"
										name="collaborators-country">
										<option value="">Country</option>
										<?php
										$sql = "SELECT * FROM countries";
										$result = $conn->query($sql);

										if ($result->num_rows > 0) {

											while ($row = $result->fetch_assoc()) {
												echo "<option value='" . $row['name'] . "' data-id='" . $row['id'] . "'>" . $row['name'] . "</option>";
											}
										} else
										?>
									</select>
								</div>
							</div> <!-- Row END -->
						</div>
						<!-- Button -->
						<div class="col-xl-1">
							<button type="button" class="btn btn-primary mb-0 rounded z-index-1 w-100"
								id="collaborators-submit"><i class="fas fa-search"></i></button>
						</div>
					</div> <!-- Row END -->
				</form>
				<!-- Filter bar END -->


				<div class="row mt-3">
					<!-- Main content START -->
					<div class="col-12">

						<!-- Course Grid START -->
						<div class="row g-3" id="responseArea">

						</div>
						<!-- Course Grid END -->

						<!-- Pagination START -->
						<div class="col-12">
							<nav class="mt-4 d-flex justify-content-center" aria-label="navigation">
								<ul class="pagination pagination-primary-soft d-inline-block d-md-flex rounded mb-0">
									<li class="page-item mb-0 active" id="loadMore"><a class="page-link" href="#">Load
											More</a></li>
								</ul>
							</nav>
						</div>
						<!-- Pagination END -->
					</div>
					<!-- Main content END -->
				</div><!-- Row END -->
			</div>
		</section>
		<!-- =======================
Page content END -->

		<!-- =======================
Newsletter START -->
		<section class="pt-0">
			<div class="container position-relative overflow-hidden">
				<!-- SVG decoration -->
				<figure class="position-absolute top-50 start-50 translate-middle ms-3">
					<svg>
						<path class="fill-white opacity-2"
							d="m496 22.999c0 10.493-8.506 18.999-18.999 18.999s-19-8.506-19-18.999 8.507-18.999 19-18.999 18.999 8.506 18.999 18.999z" />
						<path class="fill-white opacity-2"
							d="m775 102.5c0 5.799-4.701 10.5-10.5 10.5-5.798 0-10.499-4.701-10.499-10.5 0-5.798 4.701-10.499 10.499-10.499 5.799 0 10.5 4.701 10.5 10.499z" />
						<path class="fill-white opacity-2"
							d="m192 102c0 6.626-5.373 11.999-12 11.999s-11.999-5.373-11.999-11.999c0-6.628 5.372-12 11.999-12s12 5.372 12 12z" />
						<path class="fill-white opacity-2"
							d="m20.499 10.25c0 5.66-4.589 10.249-10.25 10.249-5.66 0-10.249-4.589-10.249-10.249-0-5.661 4.589-10.25 10.249-10.25 5.661-0 10.25 4.589 10.25 10.25z" />
					</svg>
				</figure>
				<!-- Svg decoration -->
				<figure class="position-absolute bottom-0 end-0 mb-5 d-none d-sm-block">
					<svg class="rotate-130" width="258.7px" height="86.9px" viewBox="0 0 258.7 86.9">
						<path stroke="white" fill="none" stroke-width="2"
							d="M0,7.2c16,0,16,25.5,31.9,25.5c16,0,16-25.5,31.9-25.5c16,0,16,25.5,31.9,25.5c16,0,16-25.5,31.9-25.5 c16,0,16,25.5,31.9,25.5c16,0,16-25.5,31.9-25.5c16,0,16,25.5,31.9,25.5s16-25.5,31.9-25.5" />
						<path stroke="white" fill="none" stroke-width="2"
							d="M0,57c16,0,16,25.5,31.9,25.5c16,0,16-25.5,31.9-25.5c16,0,16,25.5,31.9,25.5c16,0,16-25.5,31.9-25.5 c16,0,16,25.5,31.9,25.5c16,0,16-25.5,31.9-25.5c16,0,16,25.5,31.9,25.5s16-25.5,31.9-25.5" />
					</svg>
				</figure>

				<div class="bg-grad-blue p-3 p-sm-5 rounded-3" style="display: none;">
					<div class="row justify-content-center position-relative">
						<!-- SVG decoration -->
						<figure class="position-absolute top-50 start-0 translate-middle-y">
							<svg width="141px" height="141px">
								<path class="fill-white opacity-1"
									d="M140.520,70.258 C140.520,109.064 109.062,140.519 70.258,140.519 C31.454,140.519 -0.004,109.064 -0.004,70.258 C-0.004,31.455 31.454,-0.003 70.258,-0.003 C109.062,-0.003 140.520,31.455 140.520,70.258 Z" />
							</svg>
						</figure>
						<!-- Newsletter -->
						<div class="col-12 position-relative my-2 my-sm-3">
							<div class="row align-items-center">
								<!-- Title -->
								<div class="col-lg-6">
									<h3 class="text-white mb-3 mb-lg-0">Are you ready for a more great Conversation?
									</h3>
								</div>
								<!-- Input item -->
								<div class="col-lg-6 text-lg-end">
									<form class="bg-body rounded p-2">
										<div class="input-group">
											<input class="form-control border-0 me-1" type="email"
												placeholder="Type your email here">
											<button type="button" class="btn btn-dark mb-0 rounded">Subscribe</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div> <!-- Row END -->
				</div>
			</div>
		</section>
		<!-- =======================
Newsletter END -->

	</main>
	<!-- **************** MAIN CONTENT END **************** -->

	<!-- =======================
Footer START -->
	<?php include("common_ui/footer.php"); ?>
	<!-- ====================== Footer END -->

	<!-- Back to top -->
	<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

	<!-- Bootstrap JS -->
	<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

	<!-- Vendors -->
	<script src="assets/vendor/choices/js/choices.min.js"></script>

	<!-- Template Functions -->
	<script src="assets/js/functions.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="assets/js/for-search.js"></script>
	<script src="assets/js/for-index.js"></script>

</body>

<!-- course-grid-2.html  11 Feb 2023 14:24:51 GMT -->

</html>