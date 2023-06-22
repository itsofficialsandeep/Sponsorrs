<?php
session_start();

include_once("misc/functions.php");
include("misc/db.php");

use suggest;

?>

<!DOCTYPE html>
<html lang="en">


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
	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<!-- Dark mode -->
	<script>
		const storedTheme = localStorage.getItem('theme')

		const getPreferredTheme = () => {
			if (storedTheme) {
				return storedTheme
			}
			return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
		}

		const setTheme = function (theme) {
			if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
				document.documentElement.setAttribute('data-bs-theme', 'dark')
			} else {
				document.documentElement.setAttribute('data-bs-theme', theme)
			}
		}

		setTheme(getPreferredTheme())

		const showActiveTheme = theme => {
			const activeThemeIcon = document.querySelector('.theme-icon-active use')
			const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
			const svgOfActiveBtn = btnToActive.querySelector('.mode-switch use').getAttribute('href')

			document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
				element.classList.remove('active')
			})

			btnToActive.classList.add('active')
			activeThemeIcon.setAttribute('href', svgOfActiveBtn)
		}

		window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
			if (storedTheme !== 'light' || storedTheme !== 'dark') {
				setTheme(getPreferredTheme())
			}
		})

		window.addEventListener('DOMContentLoaded', () => {
			showActiveTheme(getPreferredTheme())

			document.querySelectorAll('[data-bs-theme-value]')
				.forEach(toggle => {
					toggle.addEventListener('click', () => {
						const theme = toggle.getAttribute('data-bs-theme-value')
						localStorage.setItem('theme', theme)
						setTheme(theme)
						showActiveTheme(theme)
					})
				})
		})
	</script>

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&amp;family=Roboto:wght@400;500;700&amp;display=swap"
		rel="stylesheet">

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



		<section class="bg-success bg-opacity-25 position-relative">

			<!-- Svg decoration -->
			<figure class="position-absolute bottom-0 start-0 d-none d-lg-block">

			</figure>

			<div class="container position-relative">
				<div class="row">
					<div class="col-12">
						<div class="row align-items-center">

							<!-- Image -->
							<div class="col-6 col-md-3 text-center order-1">
								<img src="assets/images/element/brand.png" alt="">
							</div>

							<!-- Content -->
							<div class="col-md-6 px-md-5 text-center position-relative order-md-2 mb-5 mb-md-0">

								<!-- png decoration -->
								<figure class="position-absolute top-0 start-0">
									<img width="27px" height="27px" src="assets/images/flaticon/brand.png">
								</figure>

								<!-- png decoration -->
								<figure
									class="position-absolute top-0 start-50 translate-middle mt-n6 d-none d-md-block">
									<img width="27px" height="27px" src="assets/images/flaticon/megaphone.png">
								</figure>

								<!-- png decoration -->
								<figure class="position-absolute top-10 end-0 translate-right mt-n10 d-md-block">
									<img width="27px" height="27px" src="assets/images/flaticon/flyers.png">
								</figure>


								<!-- Title -->
								<h1 class="mb-3">Find sponsorships that meet your need..</h1>
								<p class="mb-3 d-none">e.g. "Ku Ku FM"</p>

								<!-- Search -->
								<form class="bg-body rounded p-2" action="search.php?searchtype=sponsorships&"
									method="get">
									<div class="input-group">
										<input class="form-control border-0 me-1" type="text"
											placeholder="Search creators.. e.g. 'Ku Ku Fm'" name="query" value="">
										<input type="hidden" name="searchtype" value="creators" />
										<input type="submit" class="btn btn-success mb-0 rounded">
									</div>
								</form>
							</div>

							<!-- Image -->
							<div class="col-6 col-md-3 text-center order-3">
								<img src="assets/images/element/sponsorship.png" alt="">
							</div>

						</div> <!-- Row END -->
					</div>
				</div> <!-- Row END -->
			</div>
		</section>

		<section class="pb-0 pt-5 pt-lg-5">
			<div class="container">
				<!-- Title -->
				<div class="row mb-4">
					<div class="col-lg-8 mx-auto text-center">
						<h2 class="fs-2">Latest sponsorships tailored for you..</h2>
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
							$suggest->suggestSponsorships($conn, "any", 10, $_SESSION['currentUser']); ?>

						</div>
					</div>
					<!-- Slider END -->
				</div>
			</div>
		</section>

		<section class="pb-0 pt-5 pt-lg-5 d-none">
			<div class="container">
				<!-- Title -->
				<div class="row mb-4">
					<div class="col-lg-8 mx-auto text-center">
						<h2 class="fs-2">Latest sponsorships in finance category..</h2>
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
							$suggest->suggestSponsorships($conn, 1, 10, $_SESSION['currentUser']); ?>

						</div>
					</div>
					<!-- Slider END -->
				</div>
			</div>
		</section>

		<section class="pb-0 pt-5 pt-lg-5 d-none">
			<div class="container">
				<!-- Title -->
				<div class="row mb-4">
					<div class="col-lg-8 mx-auto text-center">
						<h2 class="fs-2">Latest sponsorships in food category..</h2>
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
							$suggest->suggestSponsorships($conn, 6, 10, $_SESSION['currentUser']); ?>

						</div>
					</div>
					<!-- Slider END -->
				</div>
			</div>
		</section>

		<section class="pb-0 pt-5 pt-lg-5 d-none">
			<div class="container">
				<!-- Title -->
				<div class="row mb-4">
					<div class="col-lg-8 mx-auto text-center">
						<h2 class="fs-2">Latest sponsorships in clothe category..</h2>
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
							$suggest->suggestSponsorships($conn, 1, 13, $_SESSION['currentUser']); ?>

						</div>
					</div>
					<!-- Slider END -->
				</div>
			</div>
		</section>

		<section>
			<div class="container">
				<!-- Title -->
				<div class="row mb-4">
					<div class="col-lg-8 mx-auto text-center">
						<h2>Search by type of Categories</h2>
					</div>
				</div>
				<div class="row g-4">
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3 col-lg-3">
						<div
							class="card card-body bg-primary bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/rocket.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="search.php?searchtype=sponsorships&adcategory=0"
									class="stretched-link">Technology</a></h6>
							<h7 class="d-none mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3 col-lg-3">
						<div
							class="card card-body bg-primary bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto rounded-circle mb-3">
								<img src="assets/images/flaticon/finance.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="search.php?searchtype=sponsorships&adcategory=1"
									class="stretched-link">Finance</a>
							</h6>
							<h7 class="d-none mb-0">15 Courses</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3 col-lg-3">
						<div
							class="card card-body bg-primary bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/vlog.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="search.php?searchtype=sponsorships&adcategory=2"
									class="stretched-link">Vlogging</a>
							</h6>
							<h7 class="d-none mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3 col-lg-3">
						<div
							class="card card-body bg-primary bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/education.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="search.php?searchtype=sponsorships&adcategory=3"
									class="stretched-link">Education</a>
							</h6>
							<h7 class="d-none mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3 col-lg-3">
						<div
							class="card card-body bg-primary bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/photography.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="search.php?searchtype=sponsorships&adcategory=4"
									class="stretched-link">Photography</a></h6>
							<h7 class="d-none mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3 col-lg-3">
						<div
							class="card card-body bg-primary bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/console.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="search.php?searchtype=sponsorships&adcategory=5"
									class="stretched-link">Gaming</a>
							</h6>
							<h7 class="d-none mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3 col-lg-3">
						<div
							class="card card-body bg-primary bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/dumbbell.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="search.php?searchtype=sponsorships&adcategory=6"
									class="stretched-link">Fitness</a>
							</h6>
							<h7 class="d-none mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3 col-lg-3">
						<div
							class="card card-body bg-primary bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/speech.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="search.php?searchtype=sponsorships&adcategory=7"
									class="stretched-link">Politics</a>
							</h6>
							<h7 class="d-none mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3 col-lg-3">
						<div
							class="card card-body bg-primary bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/comedy.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="search.php?searchtype=sponsorships&adcategory=8"
									class="stretched-link">Comedy
									Shows</a></h6>
							<h7 class="d-none mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3 col-lg-3">
						<div
							class="card card-body bg-primary bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/make-up.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="search.php?searchtype=sponsorships&adcategory=9"
									class="stretched-link">Makeup</a>
							</h6>
							<h7 class="d-none mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3 col-lg-3">
						<div
							class="card card-body bg-primary bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/flask-holder.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="search.php?searchtype=sponsorships&adcategory=10"
									class="stretched-link">Experiment</a></h6>
							<h7 class="d-none mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3 col-lg-3">
						<div
							class="card card-body bg-primary bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/diet.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="search.php?searchtype=sponsorships&adcategory=12"
									class="stretched-link">Food</a>
							</h6>
							<h7 class="d-none mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3 col-lg-3">
						<div
							class="card card-body bg-primary bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/clothes.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="search.php?searchtype=sponsorships&adcategory=13"
									class="stretched-link">Clothe</a>
							</h6>
							<h7 class="d-none mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3 col-lg-3">
						<div
							class="card card-body bg-primary bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/more.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="search.php?searchtype=creators" class="stretched-link">Other</a>
							</h6>
							<h7 class="d-none mb-0">15 brands</h7>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section>
			<div class="container">
				<!-- Title -->
				<div class="row mb-4">
					<div class="col-lg-8 mx-auto text-center">
						<h2>Search by industry</h2>
					</div>
				</div>
				<div class="row g-4">

					<!-- different industries -->
					<?php
					for ($i = 0; $i < 26; $i++) {
						$industry = industryCodeToName($i);

						echo '<div class="col-sm-6 col-md-4 col-xl-3 col-lg-3">
                    <div class="card card-body bg-primary bg-opacity-10 text-center position-relative btn-transition p-2">
                      <!-- Image -->
                      <div class="icon-lg mx-auto mb-3">
                        <img src="assets/images/flaticon/industry/' . $i . '.png" alt="">
                      </div>
                      <!-- Title -->
                      <h6 class="mb-2"><a href="search.php?searchtype=sponsorships&industry=' . $i . '"
                          class="stretched-link">' . $industry . '</a></h6>
                      <h7 class="d-none mb-0">15 brands</h7>
                    </div>
                </div>';
					}

					?>
				</div>
			</div>
		</section>

		<section>
			<div class="container">
				<!-- Title -->
				<div class="row mb-4 mx-auto text-center">
					<div class="col-12">
						<h2 class="mb-0">Search by Language</h2>
					</div>
				</div>

				<div class="row g-4">
					<!-- Language item -->
					<div class="col-sm-6 col-md-4 col-lg-3">
						<div
							class="bg-light rounded-2 p-3 d-flex align-items-center position-relative justify-content-center">
							<img src="assets/images/flags/in.svg" class="me-3 h-40px" alt="">
							<h5 class="mb-0"><a href="search.php?searchtype=sponsorships&language=hindi"
									class="stretched-link text-primary-hover"></a>Hindi</h5>
						</div>
					</div>
					<!-- Language item -->
					<div class="col-sm-6 col-md-4 col-lg-3">
						<div
							class="bg-light rounded-2 p-3 d-flex align-items-center position-relative justify-content-center">
							<img src="assets/images/flags/uk.svg" class="me-3 h-40px" alt="">
							<h5 class="mb-0"><a href="search.php?searchtype=sponsorships&language=english"
									class="stretched-link text-primary-hover"></a>English</h5>
						</div>
					</div>
					<!-- Language item -->
					<div class="col-sm-6 col-md-4 col-lg-3">
						<div
							class="bg-light rounded-2 p-3 d-flex align-items-center position-relative justify-content-center">
							<img src="assets/images/flags/sp.svg" class="me-3 h-40px" alt="">
							<h5 class="mb-0"><a href="search.php?searchtype=sponsorships&language=spanish"
									class="stretched-link text-primary-hover"></a>Spanish</h5>
						</div>
					</div>

					<!-- Language item -->
					<div class="col-sm-6 col-md-4 col-lg-3">
						<div
							class="bg-light rounded-2 p-3 d-flex align-items-center position-relative justify-content-center">
							<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Flag_of_Portugal.svg/600px-Flag_of_Portugal.svg.png?20210806190400"
								class="me-3 h-40px" alt="">
							<h5 class="mb-0"><a href="search.php?searchtype=sponsorships&language=portuguese"
									class="stretched-link text-primary-hover"></a>Portuguese</h5>
						</div>
					</div>

				</div>
			</div>
		</section>


		<section>
			<div class="container">
				<div class="row g-4">
					<!-- Action box item -->
					<div class="col-lg-6 position-relative overflow-hidden">
						<div class="bg-primary bg-opacity-10 rounded-3 p-5 h-100">
							<!-- Image -->
							<div class="position-absolute bottom-0 end-0 me-3">
								<img src="assets/images/element/brand.png" class="h-100px h-sm-200px" alt="">
							</div>
							<!-- Content -->
							<div class="row">
								<div class="col-sm-8 position-relative">
									<h3 class="mb-1">Promote your brand</h3>
									<p class="mb-3 h5 fw-light lead">Reach the best YouTubers who can promote your brand
										to perfect audience.</p>
									<a href="#" class="btn btn-primary mb-0 signupAsCompany">Sign-Up as Brand</a>
								</div>
							</div>
						</div>
					</div>

					<!-- Action box item -->
					<div class="col-lg-6 position-relative overflow-hidden">
						<div class="bg-secondary rounded-3 bg-opacity-10 p-5 h-100">
							<!-- Image -->
							<div class="position-absolute bottom-0 end-0 me-3">
								<img src="assets/images/element/sponsorship.png" class="h-100px h-sm-200px" alt="">
							</div>
							<!-- Content -->
							<div class="row">
								<div class="col-sm-8 position-relative">
									<h3 class="mb-1">Get the best sponsorship</h3>
									<p class="mb-3 h5 fw-light lead">Reach the right brand to get the high paying
										sponsorship.</p>
									<a href="#" class="btn btn-warning mb-0 signupAsCreator">Sign-Up as YouTuber</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>


	</main>
	<!-- **************** MAIN CONTENT END **************** -->

	<!-- =======================
  Footer START -->
	<footer class="pt-5 bg-light">
		<div class="container">
			<!-- Row START -->
			<div class="row g-4">

				<!-- Widget 1 START -->
				<div class="col-lg-3">
					<!-- logo -->
					<a class="me-0" href="index-2.html">
						<img class="light-mode-item h-40px" src="assets/images/logo.svg" alt="logo">
						<img class="dark-mode-item h-40px" src="assets/images/sponsorrs.png" alt="logo">
					</a>
					<p class="my-3">Sponsorrs is a match making (sponsorship) platform for YouTubers and brand
						companies. It help YouTubers and brands save their time, energy and money.</p>
					<!-- Social media icon -->
					<ul class="list-inline mb-0 mt-3">
						<li class="list-inline-item"> <a class="btn btn-white btn-sm shadow px-2 text-facebook"
								href="https://www.facebook.com/sponsorrs"><i class="fab fa-fw fa-facebook-f"></i></a>
						</li>
						<li class="list-inline-item"> <a class="btn btn-white btn-sm shadow px-2 text-instagram"
								href="https://www.instagram.com/sponsorrs"><i class="fab fa-fw fa-instagram"></i></a>
						</li>
						<li class="list-inline-item"> <a class="btn btn-white btn-sm shadow px-2 text-twitter"
								href="https://www.twitter.com/sponsorrs"><i class="fab fa-fw fa-twitter"></i></a> </li>
						<li style="display: none;" class="list-inline-item"> <a
								class="btn btn-white btn-sm shadow px-2 text-linkedin" href="#"><i
									class="fab fa-fw fa-linkedin-in"></i></a> </li>
					</ul>
				</div>
				<!-- Widget 1 END -->

				<!-- Widget 2 START -->
				<div class="col-lg-6">
					<div class="row g-4">
						<!-- Link block -->
						<div class="col-6 col-md-4">
							<h5 class="mb-2 mb-md-4">Creators</h5>
							<ul class="nav flex-column">
								<li class="nav-item"><a class="nav-link" href="#">IT</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Entertainment</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Finance</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Education</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Comedy</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Vlogging</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Gaming</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Makeup & Personal</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Clothing</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Manufacturing</a></li>
								<li class="nav-item"><a class="nav-link" href="#">News and Politics</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Cartoons</a></li>

							</ul>
						</div>

						<!-- Link block -->
						<div class="col-6 col-md-4">
							<h5 class="mb-2 mb-md-4">Brands</h5>
							<ul class="nav flex-column">
								<li class="nav-item"><a class="nav-link" href="#">IT</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Entertainment</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Finance</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Education</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Sports</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Gaming</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Makeup & Personal</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Clothing</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Manufacturing</a></li>
								<li class="nav-item"><a class="nav-link" href="#">News and Politics</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Cartoons</a></li>

							</ul>
						</div>
						<!-- Link block -->
						<div class="col-6 col-md-4">
							<h5 class="mb-2 mb-md-4">Sponsorrs</h5>
							<ul class="nav flex-column">
								<li class="nav-item"><a class="nav-link" href="#">About us</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Contact us</a></li>
								<li class="nav-item"><a class="nav-link" href="#">News and Blogs</a></li>
								<li class="nav-item"><a class="nav-link" href="#">FAQ</a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- Widget 2 END -->

				<!-- Widget 3 START -->
				<div class="col-lg-3">
					<h5 class="mb-2 mb-md-4">Contact</h5>
					<!-- Time -->
					<p class="mb-2">
						Toll free:<span class="h6 fw-light ms-2">+1234 568 963</span>
						<span class="d-block small">(9:AM to 8:PM IST)</span>
					</p>

					<p class="mb-0">Email:<span class="h6 fw-light ms-2">contact@sponsorrs.com</span></p>

					<div class="row g-2 mt-2" style="display: none;">
						<!-- Google play store button -->
						<div class="col-6 col-sm-4 col-md-3 col-lg-6">
							<a href="#"> <img src="assets/images/client/google-play.svg" alt=""> </a>
						</div>
						<!-- App store button -->
						<div class="col-6 col-sm-4 col-md-3 col-lg-6">
							<a href="#"> <img src="assets/images/client/app-store.svg" alt="app-store"> </a>
						</div>
					</div> <!-- Row END -->
				</div>
				<!-- Widget 3 END -->
			</div><!-- Row END -->

			<!-- Divider -->
			<hr class="mt-4 mb-0">

			<!-- Bottom footer -->
			<div class="py-3">
				<div class="container px-0">
					<div class="d-lg-flex justify-content-between align-items-center py-3 text-center text-md-left">
						<!-- copyright text -->
						<div class="text-primary-hover"> Copyrights <a href="https://www.webestica.com/" target="_blank"
								class="text-body">©2023 Sponsorrs</a>. All rights reserved. </div>
						<!-- copyright links-->
						<div class="justify-content-center mt-3 mt-lg-0">
							<ul class="nav list-inline justify-content-center mb-0">
								<li class="list-inline-item">
									<!-- Language selector -->
									<div class="dropup mt-0 text-center text-sm-end">
										<a class="dropdown-toggle nav-link" href="#" role="button" id="languageSwitcher"
											data-bs-toggle="dropdown" aria-expanded="false">
											<i class="fas fa-globe me-2"></i>Language
										</a>
										<ul class="dropdown-menu min-w-auto" aria-labelledby="languageSwitcher">
											<li><a class="dropdown-item me-4" href="#"><img class="fa-fw me-2"
														src="assets/images/flags/uk.svg" alt="">English</a></li>
											<li><a class="dropdown-item me-4" href="#"><img class="fa-fw me-2"
														src="assets/images/flags/gr.svg" alt="">German </a></li>
											<li><a class="dropdown-item me-4" href="#"><img class="fa-fw me-2"
														src="assets/images/flags/sp.svg" alt="">French</a></li>
										</ul>
									</div>
								</li>
								<li class="list-inline-item"><a class="nav-link" href="#">Terms of use</a></li>
								<li class="list-inline-item"><a class="nav-link pe-0" href="#">Privacy policy</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- =======================
  Footer END -->

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

</body>

<!-- course-categories.html  11 Feb 2023 14:24:51 GMT -->

</html>