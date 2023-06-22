<!DOCTYPE html>
<html lang="en">

<!-- course-categories.html  11 Feb 2023 14:24:49 GMT -->

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

</head>

<body>

	<!-- Header START -->
	<?php include_once('common_ui/header.php'); ?>
	<!-- Header END -->

	<!-- **************** MAIN CONTENT START **************** -->
	<main>

		<!-- =======================
Page Banner START -->
		<section class="bg-light position-relative">

			<!-- Svg decoration -->
			<figure class="position-absolute bottom-0 start-0 d-none d-lg-block">
				<svg width="822.2px" height="301.9px" viewBox="0 0 822.2 301.9">
					<path class="fill-warning opacity-5"
						d="M752.5,51.9c-4.5,3.9-8.9,7.8-13.4,11.8c-51.5,45.3-104.8,92.2-171.7,101.4c-39.9,5.5-80.2-3.4-119.2-12.1 c-32.3-7.2-65.6-14.6-98.9-13.9c-66.5,1.3-128.9,35.2-175.7,64.6c-11.9,7.5-23.9,15.3-35.5,22.8c-40.5,26.4-82.5,53.8-128.4,70.7 c-2.1,0.8-4.2,1.5-6.2,2.2L0,301.9c3.3-1.1,6.7-2.3,10.2-3.5c46.1-17,88.1-44.4,128.7-70.9c11.6-7.6,23.6-15.4,35.4-22.8 c46.7-29.3,108.9-63.1,175.1-64.4c33.1-0.6,66.4,6.8,98.6,13.9c39.1,8.7,79.6,17.7,119.7,12.1C634.8,157,688.3,110,740,64.6 c4.5-3.9,9-7.9,13.4-11.8C773.8,35,797,16.4,822.2,1l-0.7-1C796.2,15.4,773,34,752.5,51.9z">
					</path>
				</svg>
			</figure>

			<div class="container position-relative">
				<div class="row">
					<div class="col-12">
						<div class="row align-items-center">

							<!-- Image -->
							<div class="col-6 col-md-3 text-center order-1">
								<img src="assets/images/element/category-1.svg" alt="">
							</div>

							<!-- Content -->
							<div class="col-md-6 px-md-5 text-center position-relative order-md-2 mb-5 mb-md-0">

								<!-- Svg decoration -->
								<figure class="position-absolute top-0 start-0">
									<svg width="22px" height="22px" viewBox="0 0 22 22">
										<polygon class="fill-orange"
											points="22,8.3 13.7,8.3 13.7,0 8.3,0 8.3,8.3 0,8.3 0,13.7 8.3,13.7 8.3,22 13.7,22 13.7,13.7 22,13.7 ">
										</polygon>
									</svg>
								</figure>

								<!-- Svg decoration -->
								<figure
									class="position-absolute top-0 start-50 translate-middle mt-n6 d-none d-md-block">
									<svg width="27px" height="27px">
										<path class="fill-purple"
											d="M13.122,5.946 L17.679,-0.001 L17.404,7.528 L24.661,5.946 L19.683,11.533 L26.244,15.056 L18.891,16.089 L21.686,23.068 L15.400,19.062 L13.122,26.232 L10.843,19.062 L4.557,23.068 L7.352,16.089 L-0.000,15.056 L6.561,11.533 L1.582,5.946 L8.839,7.528 L8.565,-0.001 L13.122,5.946 Z">
										</path>
									</svg>
								</figure>


								<!-- Title -->
								<h1 class="mb-3">Search the channel who can collaborate with you..</h1>
								<p class="mb-3">e.g. "Dhruv Rathee"</p>

								<!-- Search -->
								<form class="bg-body rounded p-2">
									<div class="input-group">
										<input class="form-control border-0 me-1" type="search"
											placeholder="Search channels.. ">
										<button type="button" class="btn btn-dark mb-0 rounded">Search</button>
									</div>
								</form>
							</div>

							<!-- Image -->
							<div class="col-6 col-md-3 text-center order-3">
								<img src="assets/images/element/category-2.svg" alt="">
							</div>

						</div> <!-- Row END -->
					</div>
				</div> <!-- Row END -->
			</div>
		</section>
		<!-- =======================
Page Banner END -->

		<!-- =======================
		Trending courses START -->
		<section class="pb-5 pt-0 pt-lg-5">
			<div class="container">
				<!-- Title -->
				<div class="row mb-4">
					<div class="col-lg-8 mx-auto text-center">
						<h2 class="fs-1">High paying brands for tech channels..</h2>
						<p class="mb-0" style="display: none;">Check out most 🔥 courses in the market</p>
					</div>
				</div>
				<div class="row">
					<!-- Slider START -->
					<div class="tiny-slider arrow-round arrow-blur arrow-hover">
						<div class="tiny-slider-inner pb-1" data-autoplay="false" data-arrow="true" data-edge="2"
							data-dots="false" data-items="4" data-items-lg="3" data-items-sm="1">
							<!-- Card item START -->
							<div>
								<div class="card action-trigger-hover border bg-transparent">
									<!-- Image -->
									<div><img
											src="https://yt3.ggpht.com/ytc/AL5GRJUDgCknslb3mVg0H39T2Hqa1GpieQ1me35l9Co-Qw=s100-c-k-c0x00ffffff-no-rj"
											class="card-img-top" alt="course image"></div>
									<!-- Ribbon -->
									<div class="ribbon mt-3"><span>Free</span></div>
									<!-- Card body -->
									<div class="card-body pb-0">
										<!-- Badge and favorite -->
										<div class="d-flex justify-content-between mb-3">
											<span class="hstack gap-2">
												<a href="#" class="badge bg-primary bg-opacity-10 text-primary">Type
													2</a>
												<a href="#" class="badge text-bg-dark">Commercial</a>
											</span>
											<a href="#" class="h6 fw-light mb-0"><i class="far fa-bookmark"></i></a>
										</div>
										<!-- Title -->
										<h6 class="card-title"><a href="#">The complete Digital Marketing Course - 8
												Course in 1</a></h6>
										<span class="small">This is sample discription of
											the
											advt.</span>
										<!-- Rating -->
										<div class="d-flex justify-content-between mb-2" style="margin-top: 5px;">
											<div class="hstack gap-2" style="display: none;">
												<p class="text-warning m-0">4.5<i
														class="fas fa-star text-warning ms-1"></i></p>
												<span class="small">(6500)</span>
											</div>
											<div class="hstack gap-2" style="display: none;">
												<p class="h6 fw-light mb-0 m-0">6500</p>
												<a href="#"
													class="badge bg-danger bg-opacity-10 text-dark">Commercial</a>
												<span class="small">(Student)</span>
											</div>
										</div>
										<!-- Time -->
										<div class="hstack gap-3">
											<span class="h6 fw-light mb-0"><i
													class="far fa-clock text-danger me-2"></i>6h
												56m</span> |
											<a href="#" class="badge bg-danger bg-opacity-10 text-dark">Ad:
												Commercial</a>
										</div>
									</div>
									<!-- Card footer -->
									<div class="card-footer pt-0 bg-transparent">
										<hr>
										<!-- Avatar and Price -->
										<div class="d-flex justify-content-between align-items-center">
											<!-- Avatar -->
											<div class="d-flex align-items-center">
												<div class="avatar avatar-sm">
													<img class="avatar-img rounded-1" src="assets/images/avatar/10.jpg"
														alt="avatar">
												</div>
												<p class="mb-0 ms-2"><a href="#" class="h6 fw-light mb-0">Larry
														Lawson</a></p>
											</div>
											<!-- Price -->
											<div>
												<h4 class="text-success mb-0 item-show">Free</h4>
												<a href="#" class="btn btn-sm btn-success-soft item-show-hover"><i
														class="fas fa-paper-plane me-2"></i>Get this</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Card item END -->

							<!-- Card item START -->
							<div>
								<div class="card action-trigger-hover border bg-transparent">
									<!-- Image -->
									<img src="assets/images/courses/4by3/15.jpg" class="card-img-top"
										alt="course image">
									<!-- Card body -->
									<div class="card-body pb-0">
										<!-- Badge and favorite -->
										<div class="d-flex justify-content-between mb-3">
											<span class="hstack gap-2">
												<a href="#"
													class="badge bg-primary bg-opacity-10 text-primary">Development</a>
												<a href="#" class="badge text-bg-dark">All level</a>
											</span>
											<a href="#" class="h6 fw-light mb-0"><i class="far fa-bookmark"></i></a>
										</div>
										<!-- Title -->
										<h6 class="card-title"><a href="#">Angular – The Complete Guide (2021
												Edition)</a></h6>
										<!-- Rating -->
										<div class="d-flex justify-content-between mb-2">
											<div class="hstack gap-2">
												<p class="text-warning m-0">4.0<i
														class="fas fa-star text-warning ms-1"></i></p>
												<span class="small">(3500)</span>
											</div>
											<div class="hstack gap-2">
												<p class="h6 fw-light mb-0 m-0">4500</p>
												<span class="small">(Student)</span>
											</div>
										</div>
										<!-- Time -->
										<div class="hstack gap-3">
											<span class="h6 fw-light mb-0"><i
													class="far fa-clock text-danger me-2"></i>12h
												45m</span>
											<span class="h6 fw-light mb-0"><i
													class="fas fa-table text-orange me-2"></i>65
												lectures</span>
										</div>
									</div>
									<!-- Card footer -->
									<div class="card-footer pt-0 bg-transparent">
										<hr>
										<!-- Avatar and Price -->
										<div class="d-flex justify-content-between align-items-center">
											<!-- Avatar -->
											<div class="d-flex align-items-center">
												<div class="avatar avatar-sm">
													<img class="avatar-img rounded-1" src="assets/images/avatar/04.jpg"
														alt="avatar">
												</div>
												<p class="mb-0 ms-2"><a href="#" class="h6 fw-light mb-0">Billy
														Vasquez</a></p>
											</div>
											<!-- Price -->
											<div>
												<h4 class="text-success mb-0 item-show">$255</h4>
												<a href="#" class="btn btn-sm btn-success-soft item-show-hover"><i
														class="fas fa-shopping-cart me-2"></i>Add to cart</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Card item END -->

							<!-- Card item START -->
							<div>
								<div class="card action-trigger-hover border bg-transparent">
									<!-- Image -->
									<img src="assets/images/courses/4by3/17.jpg" class="card-img-top"
										alt="course image">
									<!-- Card body -->
									<div class="card-body pb-0">
										<!-- Badge and favorite -->
										<div class="d-flex justify-content-between mb-3">
											<span class="hstack gap-2">
												<a href="#"
													class="badge bg-primary bg-opacity-10 text-primary">Design</a>
												<a href="#" class="badge text-bg-dark">Beginner</a>
											</span>
											<a href="#" class="h6 fw-light mb-0"><i class="far fa-bookmark"></i></a>
										</div>
										<!-- Title -->
										<h6 class="card-title"><a href="#">Time Management Mastery: Do More, Stress
												Less</a></h6>
										<!-- Rating -->
										<div class="d-flex justify-content-between mb-2">
											<div class="hstack gap-2">
												<p class="text-warning m-0">4.5<i
														class="fas fa-star text-warning ms-1"></i></p>
												<span class="small">(2000)</span>
											</div>
											<div class="hstack gap-2">
												<p class="h6 fw-light mb-0 m-0">8000</p>
												<span class="small">(Student)</span>
											</div>
										</div>
										<!-- Time -->
										<div class="hstack gap-3">
											<span class="h6 fw-light mb-0"><i
													class="far fa-clock text-danger me-2"></i>24h
												56m</span>
											<span class="h6 fw-light mb-0"><i
													class="fas fa-table text-orange me-2"></i>55
												lectures</span>
										</div>
									</div>
									<!-- Card footer -->
									<div class="card-footer pt-0 bg-transparent">
										<hr>
										<!-- Avatar and Price -->
										<div class="d-flex justify-content-between align-items-center">
											<!-- Avatar -->
											<div class="d-flex align-items-center">
												<div class="avatar avatar-sm">
													<img class="avatar-img rounded-1" src="assets/images/avatar/09.jpg"
														alt="avatar">
												</div>
												<p class="mb-0 ms-2"><a href="#" class="h6 fw-light mb-0">Lori
														Stevens</a></p>
											</div>
											<!-- Price -->
											<div>
												<h4 class="text-success mb-0 item-show">$500</h4>
												<a href="#" class="btn btn-sm btn-success-soft item-show-hover"><i
														class="fas fa-shopping-cart me-2"></i>Add to cart</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Card item END -->

							<!-- Card item START -->
							<div>
								<div class="card action-trigger-hover border bg-transparent">
									<!-- Image -->
									<img src="assets/images/courses/4by3/17.jpg" class="card-img-top"
										alt="course image">
									<!-- Card body -->
									<div class="card-body pb-0">
										<!-- Badge and favorite -->
										<div class="d-flex justify-content-between mb-3">
											<span class="hstack gap-2">
												<a href="#"
													class="badge bg-primary bg-opacity-10 text-primary">Design</a>
												<a href="#" class="badge text-bg-dark">Beginner</a>
											</span>
											<a href="#" class="h6 fw-light mb-0"><i class="far fa-bookmark"></i></a>
										</div>
										<!-- Title -->
										<h6 class="card-title"><a href="#">Time Management Mastery: Do More, Stress
												Less</a></h6>
										<!-- Rating -->
										<div class="d-flex justify-content-between mb-2">
											<div class="hstack gap-2">
												<p class="text-warning m-0">4.5<i
														class="fas fa-star text-warning ms-1"></i></p>
												<span class="small">(2000)</span>
											</div>
											<div class="hstack gap-2">
												<p class="h6 fw-light mb-0 m-0">8000</p>
												<span class="small">(Student)</span>
											</div>
										</div>
										<!-- Time -->
										<div class="hstack gap-3">
											<span class="h6 fw-light mb-0"><i
													class="far fa-clock text-danger me-2"></i>24h
												56m</span>
											<span class="h6 fw-light mb-0"><i
													class="fas fa-table text-orange me-2"></i>55
												lectures</span>
										</div>
									</div>
									<!-- Card footer -->
									<div class="card-footer pt-0 bg-transparent">
										<hr>
										<!-- Avatar and Price -->
										<div class="d-flex justify-content-between align-items-center">
											<!-- Avatar -->
											<div class="d-flex align-items-center">
												<div class="avatar avatar-sm">
													<img class="avatar-img rounded-1" src="assets/images/avatar/09.jpg"
														alt="avatar">
												</div>
												<p class="mb-0 ms-2"><a href="#" class="h6 fw-light mb-0">Lori
														Stevens</a></p>
											</div>
											<!-- Price -->
											<div>
												<h4 class="text-success mb-0 item-show">$500</h4>
												<a href="#" class="btn btn-sm btn-success-soft item-show-hover"><i
														class="fas fa-shopping-cart me-2"></i>Add to cart</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Card item END -->


							<!-- Card item START -->
							<div>
								<div class="card action-trigger-hover border bg-transparent">
									<!-- Image -->
									<img src="assets/images/courses/4by3/16.jpg" class="card-img-top"
										alt="course image">
									<!-- Card body -->
									<div class="card-body pb-0">
										<!-- Badge and favorite -->
										<div class="d-flex justify-content-between mb-3">
											<span class="hstack gap-2">
												<a href="#"
													class="badge bg-primary bg-opacity-10 text-primary">Design</a>
												<a href="#" class="badge text-bg-dark">Beginner</a>
											</span>
											<a href="#" class="h6 fw-light mb-0"><i class="far fa-bookmark"></i></a>
										</div>
										<!-- Title -->
										<h6 class="card-title"><a href="#">Time Management Mastery: Do More, Stress
												Less</a></h6>
										<!-- Rating -->
										<div class="d-flex justify-content-between mb-2">
											<div class="hstack gap-2">
												<p class="text-warning m-0">4.0<i
														class="fas fa-star text-warning ms-1"></i></p>
												<span class="small">(2000)</span>
											</div>
											<div class="hstack gap-2">
												<p class="h6 fw-light mb-0 m-0">1200</p>
												<span class="small">(Student)</span>
											</div>
										</div>
										<!-- Time -->
										<div class="hstack gap-3">
											<span class="h6 fw-light mb-0"><i
													class="far fa-clock text-danger me-2"></i>09h
												56m</span>
											<span class="h6 fw-light mb-0"><i
													class="fas fa-table text-orange me-2"></i>21
												lectures</span>
										</div>
									</div>
									<!-- Card footer -->
									<div class="card-footer pt-0 bg-transparent">
										<hr>
										<!-- Avatar and Price -->
										<div class="d-flex justify-content-between align-items-center">
											<!-- Avatar -->
											<div class="d-flex align-items-center">
												<div class="avatar avatar-sm">
													<img class="avatar-img rounded-1" src="assets/images/avatar/01.jpg"
														alt="avatar">
												</div>
												<p class="mb-0 ms-2"><a href="#" class="h6 fw-light mb-0">Frances
														Guerrero</a></p>
											</div>
											<!-- Price -->
											<div>
												<h4 class="text-success mb-0 item-show">$200</h4>
												<a href="#" class="btn btn-sm btn-success-soft item-show-hover"><i
														class="fas fa-shopping-cart me-2"></i>Add to cart</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Card item END -->
						</div>
					</div>
					<!-- Slider END -->
				</div>
			</div>
		</section>
		<!-- =======================
		Trending courses END -->

		<!-- =======================
				Trending courses START -->
		<section class="pb-5 pt-0 pt-lg-5">
			<div class="container">
				<!-- Title -->
				<div class="row mb-4">
					<div class="col-lg-8 mx-auto text-center">
						<h2 class="fs-1">High paying brand in all category..</h2>
						<p class="mb-0" style="display: none;">Check out most 🔥 courses in the market</p>
					</div>
				</div>
				<div class="row">
					<!-- Slider START -->
					<div class="tiny-slider arrow-round arrow-blur arrow-hover">
						<div class="tiny-slider-inner pb-1" data-autoplay="true" data-arrow="true" data-edge="2"
							data-dots="false" data-items="4" data-items-lg="3" data-items-sm="1">
							<!-- Card item START -->
							<div>
								<div class="card action-trigger-hover border bg-transparent">
									<!-- Image -->
									<div><img
											src="https://yt3.ggpht.com/ytc/AL5GRJUDgCknslb3mVg0H39T2Hqa1GpieQ1me35l9Co-Qw=s100-c-k-c0x00ffffff-no-rj"
											class="card-img-top" alt="course image"></div>
									<!-- Ribbon -->
									<div class="ribbon mt-3"><span>Free</span></div>
									<!-- Card body -->
									<div class="card-body pb-0">
										<!-- Badge and favorite -->
										<div class="d-flex justify-content-between mb-3">
											<span class="hstack gap-2">
												<a href="#" class="badge bg-primary bg-opacity-10 text-primary">Type
													2</a>
												<a href="#" class="badge text-bg-dark">Commercial</a>
											</span>
											<a href="#" class="h6 fw-light mb-0"><i class="far fa-bookmark"></i></a>
										</div>
										<!-- Title -->
										<h6 class="card-title"><a href="#">The complete Digital Marketing Course - 8
												Course in 1</a></h6>
										<span class="small">This is sample discription of
											the
											advt.</span>
										<!-- Rating -->
										<div class="d-flex justify-content-between mb-2" style="margin-top: 5px;">
											<div class="hstack gap-2" style="display: none;">
												<p class="text-warning m-0">4.5<i
														class="fas fa-star text-warning ms-1"></i></p>
												<span class="small">(6500)</span>
											</div>
											<div class="hstack gap-2" style="display: none;">
												<p class="h6 fw-light mb-0 m-0">6500</p>
												<a href="#"
													class="badge bg-danger bg-opacity-10 text-dark">Commercial</a>
												<span class="small">(Student)</span>
											</div>
										</div>
										<!-- Time -->
										<div class="hstack gap-3">
											<span class="h6 fw-light mb-0"><i
													class="far fa-clock text-danger me-2"></i>6h
												56m</span> |
											<a href="#" class="badge bg-danger bg-opacity-10 text-dark">Ad:
												Commercial</a>
										</div>
									</div>
									<!-- Card footer -->
									<div class="card-footer pt-0 bg-transparent">
										<hr>
										<!-- Avatar and Price -->
										<div class="d-flex justify-content-between align-items-center">
											<!-- Avatar -->
											<div class="d-flex align-items-center">
												<div class="avatar avatar-sm">
													<img class="avatar-img rounded-1" src="assets/images/avatar/10.jpg"
														alt="avatar">
												</div>
												<p class="mb-0 ms-2"><a href="#" class="h6 fw-light mb-0">Larry
														Lawson</a></p>
											</div>
											<!-- Price -->
											<div>
												<h4 class="text-success mb-0 item-show">Free</h4>
												<a href="#" class="btn btn-sm btn-success-soft item-show-hover"><i
														class="fas fa-paper-plane me-2"></i>Get this</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Card item END -->

							<!-- Card item START -->
							<div>
								<div class="card action-trigger-hover border bg-transparent">
									<!-- Image -->
									<img src="assets/images/courses/4by3/15.jpg" class="card-img-top"
										alt="course image">
									<!-- Card body -->
									<div class="card-body pb-0">
										<!-- Badge and favorite -->
										<div class="d-flex justify-content-between mb-3">
											<span class="hstack gap-2">
												<a href="#"
													class="badge bg-primary bg-opacity-10 text-primary">Development</a>
												<a href="#" class="badge text-bg-dark">All level</a>
											</span>
											<a href="#" class="h6 fw-light mb-0"><i class="far fa-bookmark"></i></a>
										</div>
										<!-- Title -->
										<h6 class="card-title"><a href="#">Angular – The Complete Guide (2021
												Edition)</a></h6>
										<!-- Rating -->
										<div class="d-flex justify-content-between mb-2">
											<div class="hstack gap-2">
												<p class="text-warning m-0">4.0<i
														class="fas fa-star text-warning ms-1"></i></p>
												<span class="small">(3500)</span>
											</div>
											<div class="hstack gap-2">
												<p class="h6 fw-light mb-0 m-0">4500</p>
												<span class="small">(Student)</span>
											</div>
										</div>
										<!-- Time -->
										<div class="hstack gap-3">
											<span class="h6 fw-light mb-0"><i
													class="far fa-clock text-danger me-2"></i>12h
												45m</span>
											<span class="h6 fw-light mb-0"><i
													class="fas fa-table text-orange me-2"></i>65
												lectures</span>
										</div>
									</div>
									<!-- Card footer -->
									<div class="card-footer pt-0 bg-transparent">
										<hr>
										<!-- Avatar and Price -->
										<div class="d-flex justify-content-between align-items-center">
											<!-- Avatar -->
											<div class="d-flex align-items-center">
												<div class="avatar avatar-sm">
													<img class="avatar-img rounded-1" src="assets/images/avatar/04.jpg"
														alt="avatar">
												</div>
												<p class="mb-0 ms-2"><a href="#" class="h6 fw-light mb-0">Billy
														Vasquez</a></p>
											</div>
											<!-- Price -->
											<div>
												<h4 class="text-success mb-0 item-show">$255</h4>
												<a href="#" class="btn btn-sm btn-success-soft item-show-hover"><i
														class="fas fa-shopping-cart me-2"></i>Add to cart</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Card item END -->

							<!-- Card item START -->
							<div>
								<div class="card action-trigger-hover border bg-transparent">
									<!-- Image -->
									<img src="assets/images/courses/4by3/17.jpg" class="card-img-top"
										alt="course image">
									<!-- Card body -->
									<div class="card-body pb-0">
										<!-- Badge and favorite -->
										<div class="d-flex justify-content-between mb-3">
											<span class="hstack gap-2">
												<a href="#"
													class="badge bg-primary bg-opacity-10 text-primary">Design</a>
												<a href="#" class="badge text-bg-dark">Beginner</a>
											</span>
											<a href="#" class="h6 fw-light mb-0"><i class="far fa-bookmark"></i></a>
										</div>
										<!-- Title -->
										<h6 class="card-title"><a href="#">Time Management Mastery: Do More, Stress
												Less</a></h6>
										<!-- Rating -->
										<div class="d-flex justify-content-between mb-2">
											<div class="hstack gap-2">
												<p class="text-warning m-0">4.5<i
														class="fas fa-star text-warning ms-1"></i></p>
												<span class="small">(2000)</span>
											</div>
											<div class="hstack gap-2">
												<p class="h6 fw-light mb-0 m-0">8000</p>
												<span class="small">(Student)</span>
											</div>
										</div>
										<!-- Time -->
										<div class="hstack gap-3">
											<span class="h6 fw-light mb-0"><i
													class="far fa-clock text-danger me-2"></i>24h
												56m</span>
											<span class="h6 fw-light mb-0"><i
													class="fas fa-table text-orange me-2"></i>55
												lectures</span>
										</div>
									</div>
									<!-- Card footer -->
									<div class="card-footer pt-0 bg-transparent">
										<hr>
										<!-- Avatar and Price -->
										<div class="d-flex justify-content-between align-items-center">
											<!-- Avatar -->
											<div class="d-flex align-items-center">
												<div class="avatar avatar-sm">
													<img class="avatar-img rounded-1" src="assets/images/avatar/09.jpg"
														alt="avatar">
												</div>
												<p class="mb-0 ms-2"><a href="#" class="h6 fw-light mb-0">Lori
														Stevens</a></p>
											</div>
											<!-- Price -->
											<div>
												<h4 class="text-success mb-0 item-show">$500</h4>
												<a href="#" class="btn btn-sm btn-success-soft item-show-hover"><i
														class="fas fa-shopping-cart me-2"></i>Add to cart</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Card item END -->

							<!-- Card item START -->
							<div>
								<div class="card action-trigger-hover border bg-transparent">
									<!-- Image -->
									<img src="assets/images/courses/4by3/17.jpg" class="card-img-top"
										alt="course image">
									<!-- Card body -->
									<div class="card-body pb-0">
										<!-- Badge and favorite -->
										<div class="d-flex justify-content-between mb-3">
											<span class="hstack gap-2">
												<a href="#"
													class="badge bg-primary bg-opacity-10 text-primary">Design</a>
												<a href="#" class="badge text-bg-dark">Beginner</a>
											</span>
											<a href="#" class="h6 fw-light mb-0"><i class="far fa-bookmark"></i></a>
										</div>
										<!-- Title -->
										<h6 class="card-title"><a href="#">Time Management Mastery: Do More, Stress
												Less</a></h6>
										<!-- Rating -->
										<div class="d-flex justify-content-between mb-2">
											<div class="hstack gap-2">
												<p class="text-warning m-0">4.5<i
														class="fas fa-star text-warning ms-1"></i></p>
												<span class="small">(2000)</span>
											</div>
											<div class="hstack gap-2">
												<p class="h6 fw-light mb-0 m-0">8000</p>
												<span class="small">(Student)</span>
											</div>
										</div>
										<!-- Time -->
										<div class="hstack gap-3">
											<span class="h6 fw-light mb-0"><i
													class="far fa-clock text-danger me-2"></i>24h
												56m</span>
											<span class="h6 fw-light mb-0"><i
													class="fas fa-table text-orange me-2"></i>55
												lectures</span>
										</div>
									</div>
									<!-- Card footer -->
									<div class="card-footer pt-0 bg-transparent">
										<hr>
										<!-- Avatar and Price -->
										<div class="d-flex justify-content-between align-items-center">
											<!-- Avatar -->
											<div class="d-flex align-items-center">
												<div class="avatar avatar-sm">
													<img class="avatar-img rounded-1" src="assets/images/avatar/09.jpg"
														alt="avatar">
												</div>
												<p class="mb-0 ms-2"><a href="#" class="h6 fw-light mb-0">Lori
														Stevens</a></p>
											</div>
											<!-- Price -->
											<div>
												<h4 class="text-success mb-0 item-show">$500</h4>
												<a href="#" class="btn btn-sm btn-success-soft item-show-hover"><i
														class="fas fa-shopping-cart me-2"></i>Add to cart</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Card item END -->


							<!-- Card item START -->
							<div>
								<div class="card action-trigger-hover border bg-transparent">
									<!-- Image -->
									<img src="assets/images/courses/4by3/16.jpg" class="card-img-top"
										alt="course image">
									<!-- Card body -->
									<div class="card-body pb-0">
										<!-- Badge and favorite -->
										<div class="d-flex justify-content-between mb-3">
											<span class="hstack gap-2">
												<a href="#"
													class="badge bg-primary bg-opacity-10 text-primary">Design</a>
												<a href="#" class="badge text-bg-dark">Beginner</a>
											</span>
											<a href="#" class="h6 fw-light mb-0"><i class="far fa-bookmark"></i></a>
										</div>
										<!-- Title -->
										<h6 class="card-title"><a href="#">Time Management Mastery: Do More, Stress
												Less</a></h6>
										<!-- Rating -->
										<div class="d-flex justify-content-between mb-2">
											<div class="hstack gap-2">
												<p class="text-warning m-0">4.0<i
														class="fas fa-star text-warning ms-1"></i></p>
												<span class="small">(2000)</span>
											</div>
											<div class="hstack gap-2">
												<p class="h6 fw-light mb-0 m-0">1200</p>
												<span class="small">(Student)</span>
											</div>
										</div>
										<!-- Time -->
										<div class="hstack gap-3">
											<span class="h6 fw-light mb-0"><i
													class="far fa-clock text-danger me-2"></i>09h
												56m</span>
											<span class="h6 fw-light mb-0"><i
													class="fas fa-table text-orange me-2"></i>21
												lectures</span>
										</div>
									</div>
									<!-- Card footer -->
									<div class="card-footer pt-0 bg-transparent">
										<hr>
										<!-- Avatar and Price -->
										<div class="d-flex justify-content-between align-items-center">
											<!-- Avatar -->
											<div class="d-flex align-items-center">
												<div class="avatar avatar-sm">
													<img class="avatar-img rounded-1" src="assets/images/avatar/01.jpg"
														alt="avatar">
												</div>
												<p class="mb-0 ms-2"><a href="#" class="h6 fw-light mb-0">Frances
														Guerrero</a></p>
											</div>
											<!-- Price -->
											<div>
												<h4 class="text-success mb-0 item-show">$200</h4>
												<a href="#" class="btn btn-sm btn-success-soft item-show-hover"><i
														class="fas fa-shopping-cart me-2"></i>Add to cart</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Card item END -->
						</div>
					</div>
					<!-- Slider END -->
				</div>
			</div>
		</section>
		<!-- =======================
				Trending courses END -->



		<!-- =======================
Categories START -->
		<section>
			<div class="container">
				<!-- Title -->
				<div class="row mb-4">
					<div class="col-lg-8 mx-auto text-center">
						<h2>Choose from different categories</h2>
						<p class="mb-0">Lets search every options that can help you grow</p>
					</div>
				</div>
				<div class="row g-4">
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3" style="width: 14%;">
						<div
							class="card card-body bg-success bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/rocket.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="#" class="stretched-link">Technology</a></h6>
							<h7 class="mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3" style="width: 14%;">
						<div
							class="card card-body bg-success bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto rounded-circle mb-3">
								<img src="assets/images/flaticon/finance.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="#" class="stretched-link">Finance</a></h6>
							<h7 class="mb-0">15 Courses</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3" style="width: 14%;">
						<div
							class="card card-body bg-success bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/vlog.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="#" class="stretched-link">Vlogging</a></h6>
							<h7 class="mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3" style="width: 14%;">
						<div
							class="card card-body bg-success bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/education.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="#" class="stretched-link">Education</a></h6>
							<h7 class="mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3" style="width: 14%;">
						<div
							class="card card-body bg-success bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/photography.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="#" class="stretched-link">Photography</a></h6>
							<h7 class="mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3" style="width: 14%;">
						<div
							class="card card-body bg-success bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/console.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="#" class="stretched-link">Gaming</a></h6>
							<h7 class="mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3" style="width: 14%;">
						<div
							class="card card-body bg-success bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/dumbbell.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="#" class="stretched-link">Fitness</a></h6>
							<h7 class="mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3" style="width: 14%;">
						<div
							class="card card-body bg-success bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/speech.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="#" class="stretched-link">Politics</a></h6>
							<h7 class="mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3" style="width: 14%;">
						<div
							class="card card-body bg-success bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/comedy.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="#" class="stretched-link">Comedy Shows</a></h6>
							<h7 class="mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3" style="width: 14%;">
						<div
							class="card card-body bg-success bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/make-up.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="#" class="stretched-link">Makeup</a></h6>
							<h7 class="mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3" style="width: 14%;">
						<div
							class="card card-body bg-success bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/flask-holder.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="#" class="stretched-link">Experiment</a></h6>
							<h7 class="mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3" style="width: 14%;">
						<div
							class="card card-body bg-success bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/diet.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="#" class="stretched-link">Food</a></h6>
							<h7 class="mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3" style="width: 14%;">
						<div
							class="card card-body bg-success bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/clothes.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="#" class="stretched-link">Clothe</a></h6>
							<h7 class="mb-0">15 brands</h7>
						</div>
					</div>
					<!-- Item -->
					<div class="col-sm-6 col-md-4 col-xl-3" style="width: 14%;">
						<div
							class="card card-body bg-success bg-opacity-10 text-center position-relative btn-transition p-2">
							<!-- Image -->
							<div class="icon-lg mx-auto mb-3">
								<img src="assets/images/flaticon/more.png" alt="">
							</div>
							<!-- Title -->
							<h6 class="mb-2"><a href="#" class="stretched-link">Other</a></h6>
							<h7 class="mb-0">15 brands</h7>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- =======================
Categories END -->

		<!-- =======================
Language START -->
		<section>
			<div class="container">
				<!-- Title -->
				<div class="row mb-4 mx-auto text-center">
					<div class="col-12">
						<h2 class="mb-0">Choose Languages</h2>
					</div>
				</div>

				<div class="row g-4">
					<!-- Language item -->
					<div class="col-sm-6 col-md-4 col-lg-3">
						<div
							class="bg-light rounded-2 p-3 d-flex align-items-center position-relative justify-content-center">
							<img src="assets/images/flags/in.svg" class="me-3 h-40px" alt="">
							<h5 class="mb-0"><a href="#" class="stretched-link text-primary-hover"></a>Hindi</h5>
						</div>
					</div>
					<!-- Language item -->
					<div class="col-sm-6 col-md-4 col-lg-3">
						<div
							class="bg-light rounded-2 p-3 d-flex align-items-center position-relative justify-content-center">
							<img src="assets/images/flags/uk.svg" class="me-3 h-40px" alt="">
							<h5 class="mb-0"><a href="#" class="stretched-link text-primary-hover"></a>English</h5>
						</div>
					</div>
					<!-- Language item -->
					<div class="col-sm-6 col-md-4 col-lg-3">
						<div
							class="bg-light rounded-2 p-3 d-flex align-items-center position-relative justify-content-center">
							<img src="assets/images/flags/sp.svg" class="me-3 h-40px" alt="">
							<h5 class="mb-0"><a href="#" class="stretched-link text-primary-hover"></a>Spanish</h5>
						</div>
					</div>

					<!-- Language item -->
					<div class="col-sm-6 col-md-4 col-lg-3">
						<div
							class="bg-light rounded-2 p-3 d-flex align-items-center position-relative justify-content-center">
							<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Flag_of_Portugal.svg/600px-Flag_of_Portugal.svg.png?20210806190400"
								class="me-3 h-40px" alt="">
							<h5 class="mb-0"><a href="#" class="stretched-link text-primary-hover"></a>Portuguese</h5>
						</div>
					</div>

				</div>
			</div>
		</section>
		<!-- =======================
Language END -->

		<!-- =======================
Action box START -->
		<section>
			<div class="container">
				<div class="row g-4">
					<!-- Action box item -->
					<div class="col-lg-6 position-relative overflow-hidden">
						<div class="bg-primary bg-opacity-10 rounded-3 p-5 h-100">
							<!-- Image -->
							<div class="position-absolute bottom-0 end-0 me-3">
								<img src="assets/images/element/08.svg" class="h-100px h-sm-200px" alt="">
							</div>
							<!-- Content -->
							<div class="row">
								<div class="col-sm-8 position-relative">
									<h3 class="mb-1">Promote your brand</h3>
									<p class="mb-3 h5 fw-light lead">Reach the best YouTubers who can promote your brand
										for less fee.</p>
									<a href="#" class="btn btn-primary mb-0">Sign-Up as Brand</a>
								</div>
							</div>
						</div>
					</div>

					<!-- Action box item -->
					<div class="col-lg-6 position-relative overflow-hidden">
						<div class="bg-secondary rounded-3 bg-opacity-10 p-5 h-100">
							<!-- Image -->
							<div class="position-absolute bottom-0 end-0 me-3">
								<img src="assets/images/element/15.svg" class="h-100px h-sm-200px" alt="">
							</div>
							<!-- Content -->
							<div class="row">
								<div class="col-sm-8 position-relative">
									<h3 class="mb-1">Get the best sponsorship</h3>
									<p class="mb-3 h5 fw-light lead">Reach the right brand to get the high paying
										sponsorship.</p>
									<a href="#" class="btn btn-warning mb-0">Sign-Up as YouTuber</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- =======================
Action box END -->

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

</body>

<!-- course-categories.html  11 Feb 2023 14:24:51 GMT -->

</html>