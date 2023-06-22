<?php include_once "../config.php"; ?>
<!DOCTYPE html>
<html lang="en">

<!-- error-404.html  11 Feb 2023 14:25:12 GMT -->

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

	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo $domain; ?>assets/css/style.css">

</head>

<body>

	<!-- Header START -->
	<?php include_once('common_ui/header.php'); ?>
	<!-- Header END -->

	<!-- **************** MAIN CONTENT START **************** -->
	<main>
		<div class="col-12 d-flex justify-content-center">
			<div class="alert alert-success alert-dismissible fade show mt-2 mb-0 rounded-3" role="alert">
				<!-- Info -->
				<i class="bi bi-exclamation-circle-fill" style="margin-right: 20px;"></i>If you are already logged-in
				then you can use <a href="https://sponsorrs.com/contact-us.php">Contact Us Page</a>
				to help us solve the problem. Otherwise you can mail us on contact@sponsorrs.com
			</div>
		</div>
		<section class="pt-5">
			<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<!-- Image -->
						<img src="assets/images/element/error404-01.svg" class="h-200px h-md-400px mb-4" alt="">
						<!-- Title -->
						<h1 class="display-1 text-danger mb-0">404</h1>
						<!-- Subtitle -->
						<h2>Oh no, something went wrong!</h2>
						<!-- info -->
						<p class="mb-4">Either something went wrong or this page doesn't exist anymore.</p>
						<!-- Button -->
						<a href="index.html" class="btn btn-primary mb-0">Take me to Homepage</a>
					</div>
				</div>
			</div>
		</section>
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

	<!-- Template Functions -->
	<script src="assets/js/functions.js"></script>

</body>

<!-- error-404.html  11 Feb 2023 14:25:13 GMT -->

</html>