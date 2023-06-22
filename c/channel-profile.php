<?php

include_once("../misc/db.php");
include_once("../misc/config.php");

// to handle session variable oon this page
session_start();

$currentUser = $_SESSION['currentUser']; //abp

// we need basic detail about the channel
$queryBaicDetail = "SELECT `id_user`, `email`, `contactno`, `previous_sponsors`, `channel_category`, `sponsor_type`, `country`, 
			`channel_date`, `given_name`, `name`, `pictures`, `family_name`, `locale`,`primary_ac_id`, `email_verified`, 
			`registered_on` FROM `users` WHERE active=1 AND primary_ac_id='$currentUser'";

if ($result = $conn->query($queryBaicDetail)) {
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$email = $row['email'];
			$previous_sponsors = $row['previous_sponsors'];
			$channel_category = $row['channel_category'];
			$sponsor_type = $row['sponsor_type'];
			$country = $row['country'];
			$channel_date = $row['channel_date'];
			$name = $row['name'];
			$pictures = $row['pictures'];
			$locale = $row['locale'];
			$registered_on = $row['registered_on'];
		}
	} else {
		$_SESSION['currentUser'] = '';
		//header("Location: ../error-404.php");
		echo $_SESSION['currentUser'];
	}
} else {
	$_SESSION['script_error_code'] = "1000";
	header("Location: ../error-404.php");
}

include_once("../profile-functions/channel-all-sponsorships-functions.php");
include_once("../profile-functions/channel-clients-functions.php");
include_once("../profile-functions/channel-following-functions.php");
include_once("../profile-functions/channel-saved-brand-functions.php");
include_once("../profile-functions/channel-saved-sponsorship-functions.php");
?>

<!DOCTYPE html>
<html lang="en">

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
	<?php include_once("../common_ui/dark-mode.php"); ?>

	<!-- Favicon -->
	<link rel="shortcut icon" href="../assets/images/favicon.ico">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&amp;family=Roboto:wght@400;500;700&amp;display=swap">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="../assets/vendor/font-awesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/vendor/bootstrap-icons/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="../assets/vendor/apexcharts/css/apexcharts.css">
	<link rel="stylesheet" type="text/css" href="../assets/vendor/choices/css/choices.min.css">

	<!-- desgin for calendor -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

	<script src="../assets/vendor/choices/js/choices.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../assets/vendor/overlay-scrollbar/css/overlayscrollbars.min.csss	">
	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<script src="../assets/js/psw-meter.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.3.js"
		integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</head>

<body>

	<!-- Header START -->
	<?php include_once('../common_ui/header.php'); ?>
	<!-- Header END -->

	<!-- **************** MAIN CONTENT START **************** -->
	<main>
		<!-- =======================Page Banner START -->
		<section class="pt-0">
			<!-- Main banner background image -->
			<div class="container-fluid px-0">
				<div class="bg-blue h-100px h-md-200px rounded-0"
					style="background:url(../../assets/images/pattern/04.png) no-repeat center center; background-size:cover;">
				</div>
			</div>
			<div class="container mt-n4">
				<div class="row">
					<!-- Profile banner START -->
					<div class="col-12">
						<div class="card bg-transparent card-body p-0">
							<div class="row d-flex justify-content-between">
								<!-- Avatar -->
								<div class="col-auto mt-4 mt-md-0">
									<div class="avatar avatar-xxl mt-n3">
										<img class="avatar-img rounded-circle border border-white border-3 shadow"
											src="<?php echo str_ireplace("s96-c", "s500-c", $pictures); ?>" alt="">
									</div>
								</div>
								<!-- Profile info -->
								<div class="col d-md-flex justify-content-between align-items-center mt-4">
									<div>
										<h1 class="my-1 fs-4" id="username">
											<?php echo $name; ?> <i
												class="bi bi-patch-check-fill text-success small"></i>
										</h1>
										<p class="mb-0 h6 fw-light">
											<?php echo substr($previous_sponsors, 0, 100) . "..."; ?>
										</p>
										<ul class="list-inline mb-0" style="display:none">
											<li class="list-inline-item h6 fw-light me-3 mb-1 mb-sm-0"><i
													class="fas fa-star text-warning me-2"></i>4.5/5.0</li>
											<li class="list-inline-item h6 fw-light me-3 mb-1 mb-sm-0"><i
													class="fas fa-user-graduate text-orange me-2"></i>12k Enrolled
												Students</li>
											<li class="list-inline-item h6 fw-light me-3 mb-1 mb-sm-0"><i
													class="fas fa-book text-purple me-2"></i>25 Courses</li>
										</ul>
									</div>
									<!-- Button -->
									<div class="d-flex align-items-center mt-2 mt-md-0">
										<a href="<?php echo $domain; ?>/sponsorships.php"
											class="btn btn-success mb-0">Show Best
											sponsorships</a>
									</div>
								</div>
							</div>
						</div>
						<!-- Profile banner END -->

						<!-- Advanced filter responsive toggler START -->
						<!-- Divider -->
						<hr class="d-xl-none">
						<div class="col-12 col-xl-3 d-flex justify-content-between align-items-center">
							<a class="h6 mb-0 fw-bold d-xl-none" href="#">Menu</a>
							<button class="btn btn-primary d-xl-none" type="button" data-bs-toggle="offcanvas"
								data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
								<i class="fas fa-sliders-h"></i>
							</button>
						</div>
						<!-- Advanced filter responsive toggler END -->
					</div>
				</div>
			</div>
		</section>
		<!-- =======================
Page Banner END -->

		<!-- =======================
Page content START -->
		<section class="pt-0">
			<div class="container">
				<div class="row">
					<!-- Left sidebar START -->
					<div class="col-xl-3">
						<!-- Responsive offcanvas body START -->
						<div class="offcanvas-xl offcanvas-end" tabindex="-1" id="offcanvasSidebar">
							<!-- Offcanvas header -->
							<div class="offcanvas-header bg-light">
								<h5 class="offcanvas-title" id="offcanvasNavbarLabel">My profile</h5>
								<button type="button" class="btn-close" data-bs-dismiss="offcanvas"
									data-bs-target="#offcanvasSidebar" aria-label="Close"></button>
							</div>
							<!-- Offcanvas body -->
							<div class="offcanvas-body p-3 p-xl-0">
								<div class="bg-dark border rounded-3 pb-0 p-3 w-100">
									<!-- Dashboard menu -->
									<div class="list-group list-group-dark list-group-borderless">
										<a class="list-group-item <?php $active = $_GET['page'] == 'dashboard' ? 'active' : '';
										echo $active; ?>" href="channel-profile.php?page=dashboard#username"><i
												class="bi bi-ui-checks-grid fa-fw me-2"></i>Dashboard</a>

										<a class="list-group-item <?php $active = $_GET['page'] == 'all_sponsorships' ? 'active' : '';
										echo $active; ?>" href="channel-profile.php?page=all_sponsorships#username"><i
												class="bi bi-basket fa-fw me-2"></i>All
											sponsorships</a>

										<a class="list-group-item <?php $active = $_GET['page'] == 'all_clients' ? 'active' : '';
										echo $active; ?>" href="channel-profile.php?page=all_clients#username"><i
												class="bi bi-person-badge fa-fw me-2"></i>All
											clients</a>

										<a class="list-group-item <?php $active = $_GET['page'] == 'followings' ? 'active' : '';
										echo $active; ?>" href="channel-profile.php?page=followings#username"><i
												class="bi bi-person-plus fa-fw me-2"></i>Following</a>

										<a class="list-group-item <?php $active = $_GET['page'] == 'saved_brand' ? 'active' : '';
										echo $active; ?>" href="channel-profile.php?page=saved_brand#username"><i
												class="bi bi-people fa-fw me-2"></i>Saved
											Brands</a>

										<a class="list-group-item <?php $active = $_GET['page'] == 'saved_sponsorships' ? 'active' : '';
										echo $active; ?>" href="channel-profile.php?page=saved_sponsorships#username"><i
												class="bi bi-folder-check fa-fw me-2"></i>Saved
											sponsorships</a>

										<a class="list-group-item <?php $active = $_GET['page'] == 'edit_profile' ? 'active' : '';
										echo $active; ?>" href="channel-profile.php?page=edit_profile#username"><i
												class="bi bi-pencil-square fa-fw me-2"></i>Edit
											Profile</a>

										<a class="list-group-item <?php $active = $_GET['page'] == 'settings' ? 'active' : '';
										echo $active; ?>" href="channel-profile.php?page=settings#username"><i
												class="bi bi-gear fa-fw me-2"></i>Settings</a>
										<!-- 
										<a class="list-group-item <?php $active = $_GET['page'] == 'earnings' ? 'active' : '';
										echo $active; ?>" href="channel-profile.php?page=earnings"><i
												class="bi bi-currency-rupee fa-fw me-2"></i>Earnings</a> -->
										<a class="list-group-item <?php $active = $_GET['page'] == 'payments' ? 'active' : '';
										echo $active; ?>" href="channel-profile.php?page=payments#username"><i class="bi bi-wallet2"></i>Payments</a>
										<a class="list-group-item text-danger bg-danger-soft-hover"
											href="sign-in.php"><i class="fas fa-sign-out-alt fa-fw me-2"></i>Sign
											Out</a>
									</div>
								</div>
							</div>
						</div>
						<!-- Responsive offcanvas body END -->
					</div>
					<!-- Left sidebar END -->

					<!-- Main content START -->

					<?php
					switch ($_GET['page']) {
						case 'dashboard':
							include_once("channel-dashboard.php");
							break;
						case 'all_sponsorships':
							include_once("channel-all-sponsorships.php");
							break;
						case 'all_clients':
							include_once("channel-clients.php");
							break;
						case 'followings':
							include_once("channel-following.php");
							break;
						case 'saved_brand':
							include_once("channel-saved-brand.php");
							break;
						case 'saved_sponsorships':
							include_once("channel-saved-sponsorship.php");
							break;
						case 'edit_profile':
							include_once("channel-edit-profile.php");
							break;
						case 'settings':
							include_once("channel-setting.php");
							break;
						case 'delete_profile':
							include_once("channel-delete-profile.php");
							break;
						case 'signout':
							header("Location:logout.php");
							break;
						case 'earnings':
							include_once("channel-earnings.php");
							break;
						case 'payments':
							include_once("channel-payments.php");
							break;
						default:
							include_once("channel-dashboard.php");
							break;
					}

					?>

					<!-- Main content END -->
				</div><!-- Row END -->
			</div>
		</section>
		<!-- =======================
Page content END -->

	</main>
	<!-- **************** MAIN CONTENT END **************** -->

	<footer class="pt-5 bg-light">
		<div class="container">
			<!-- Row START -->
			<div class="row g-4">

				<!-- Widget 1 START -->
				<div class="col-lg-3">
					<!-- logo -->
					<a class="me-0" href="index-2.html">
						<img class="light-mode-item h-50px" src="../assets/images/sponsorrs.png" alt="logo">
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
							<a href="#"> <img src="../assets/images/client/google-play.svg" alt=""> </a>
						</div>
						<!-- App store button -->
						<div class="col-6 col-sm-4 col-md-3 col-lg-6">
							<a href="#"> <img src="../assets/images/client/app-store.svg" alt="app-store"> </a>
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
														src="../assets/images/flags/uk.svg" alt="">English</a></li>
											<li><a class="dropdown-item me-4" href="#"><img class="fa-fw me-2"
														src="../assets/images/flags/gr.svg" alt="">German </a></li>
											<li><a class="dropdown-item me-4" href="#"><img class="fa-fw me-2"
														src="../assets/images/flags/sp.svg" alt="">French</a></li>
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

	<!-- Back to top -->
	<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

	<!-- Bootstrap JS -->
	<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

	<!-- Vendors -->
	<script src="../assets/vendor/purecounterjs/dist/purecounter_vanilla.js"></script>
	<script src="../assets/vendor/apexcharts/js/apexcharts.min.js"></script>

	<!-- Template Functions -->
	<script src="../assets/js/functions.js"></script>

	<?php
	switch ($_GET['page']) {
		case 'all_sponsorships':
			echo '<script src="../assets/js/channel-all-sponsorship.js"></script>';
			break;
		case 'all_clients':
			echo '<script src="../assets/js/channel-all-requests-direct-client.js"></script>';
			echo '<script src="../assets/js/channel-all-requests-with-sponsorship-client.js"></script>';
			break;
		case 'followings':
			echo '<script src="../assets/js/channel-following.js"></script>';
			break;
		case 'saved_brand':
			echo '<script src="../assets/js/channel-saved-brand.js"></script>';
			break;
		case 'saved_sponsorships':
			echo '<script src="../assets/js/channel-saved-sponsorship.js"></script>';
			break;
		case 'edit_profile':
			echo '<script src="../assets/js/channel-edit-profile.js"></script>';
			break;
		case 'settings':
			echo '<script src="../assets/js/channel-setting.js"></script>';
			break;
		case 'earnings':
			echo '<script src="../assets/js/channel-earnings.js"></script>';
			break;
		case 'payments':
			echo '<script src="../assets/js/channel-payment.js"></script>';
			break;
	}
	?>



	<script>
		document.addEventListener('DOMContentLoaded', function () {
			if (typeof (Storage) !== 'undefined') {
				// See if there is a scroll pos and go there.
				var lastYPos = +localStorage.getItem('scrollYPos');
				if (lastYPos) {
					console.log('Setting scroll pos to:', lastYPos);
					window.scrollTo(0, lastYPos);
				}

				// On navigating away first save the position.
				var anchors = document.querySelectorAll('article a');

				var onNavClick = function () {
					console.log('Saving scroll pos to:', window.scrollY);
					localStorage.setItem('scrollYPos', window.scrollY);
				};

				for (var i = 0; i < anchors.length; i++) {
					anchors[i].addEventListener('click', onNavClick);
				}
			}
		});	</script>

	<script>

		// Run pswmeter with options
		const myPassMeter = passwordStrengthMeter({
			containerElement: '#pswmeter',
			passwordInput: '#psw-input',
			showMessage: true,
			messageContainer: '#pswmeter-message',
			messagesList: [
				'Write your password...',
				'Easy peasy!',
				'That is a simple one',
				'That is better',
				'Yeah! that password rocks ;)'
			],
			height: 8,
			borderRadius: 4,
			pswMinLength: 8,
			colorScore1: '#dc3545',
			colorScore2: '#f7c32e',
			colorScore3: '#4f9ef8',
			colorScore4: '#0cbc87'
		});

		myPassMeter.containerElement.addEventListener('onScore4', function () {
			$("#pswmeter-message").removeClass("text-danger").addClass("text-success");
		})	</script>

	<script src="../assets/vendor/overlay-scrollbar/js/overlayscrollbars.min.jss"></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script> -->
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>

	<!-- for use in channel-settings.php-->
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script>
		$(function () {
			$("#channel-account-DateOfBirth").datepicker();
		});	</script>

	<!-- for use in channel-settings.php-->
	<script type="text/javascript">
		function validatePhone(event) {

			//event.keycode will return unicode for characters and numbers like a, b, c, 5 etc.
			//event.which will return key for mouse events and other events like ctrl alt etc. 
			var key = window.event ? event.keyCode : event.which;

			if (event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39) {
				// 8 means Backspace
				//46 means Delete
				// 37 means left arrow
				// 39 means right arrow
				return true;
			} else if (key < 48 || key > 57) {
				// 48-57 is 0-9 numbers on your keyboard.
				return false;
			} else return true;
		}	</script>

	<script>
		$("#channel-account-country").on("change", function () {
			var id = $(this).find(':selected').attr("data-id");
			$("#channel-account-state").find('option:not(:first)').remove();
			if (id != '') {
				$.post("../../jp/misc/state.php", { id: id }).done(function (data) {
					$("#channel-account-state").append(data);
				});
				$('#channel-account-stateDiv').show();
			} else {
				$('#channel-account-stateDiv').hide();
				$('#channel-account-cityDiv').hide();
			}
		});	</script>

	<script>
		$("#channel-account-state").on("change", function () {
			var id = $(this).find(':selected').attr("data-id");
			$("#channel-account-city").find('option:not(:first)').remove();
			if (id != '') {
				$.post("../../jp/misc/city.php", { id: id }).done(function (data) {
					$("#channel-account-city").append(data);
				});
				$('#channel-account-cityDiv').show();
			} else {
				$('#channel-account-cityDiv').hide();
			}
		});	</script>


</body>

<!-- instructor-dashboard.html  11 Feb 2023 14:25:13 GMT -->

</html>