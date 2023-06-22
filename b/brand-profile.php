<?php

include_once("../misc/db.php");
include_once("../misc/config.php");

// to handle session variable oon this page
session_start();

$currentUser = $_SESSION['currentUser'];

// we need basic detail about the channel
$queryBaicDetail = "SELECT companyname,aboutme,logo,createdAt,logo FROM `company` WHERE active=1 AND primary_ac_id='$currentUser'";

$name = 'Company Name';
$aboutme = 'Go to "Edit Profile" page to edit your company details';
$logo = "../assets/images/flaticon/office-building.png";
$createdAt = "DD/MM/YYYY";

if ($result = $conn->query($queryBaicDetail)) {
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$name = $row['companyname'];
		$aboutme = $row['aboutme'];
		$logo = $row['logo'];
		$createdAt = $row['createdAt'];
	}
} else {
	$_SESSION['script_error_code'] = "1000";
	header("Location: ../error-404.html");
}

?>

<!DOCTYPE html>
<html lang="en">

<!-- instructor-dashboard.html  11 Feb 2023 14:25:13 GMT -->

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
	<script src="../assets/js/jquery.min.js"></script>


</head>

<body>

	<!-- Header START -->
	<?php include_once('../common_ui/header.php'); ?>
	<!-- Header END -->

	<!-- **************** MAIN CONTENT START **************** -->
	<main>
		<!-- =======================
Page Banner START -->
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
											src="<?php echo str_ireplace("s96-c", "s500-c", $logo); ?>" alt="">
									</div>
								</div>
								<!-- Profile info -->
								<div class="col d-md-flex justify-content-between align-items-center mt-4">
									<div>
										<h1 id="username" class="my-1 fs-4">
											<?php echo $name; ?> <i
												class="bi bi-patch-check-fill text-success small"></i>
										</h1>
										<p class="mb-0 h6 fw-light">
											<?php echo substr($aboutme, 0, 100) . "..."; ?>
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
										<a href="instructor-create-course.html" class="btn btn-success mb-0">Show Best
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
										echo $active; ?>" href="brand-profile.php?page=dashboard#username"><i
												class="bi bi-ui-checks-grid fa-fw me-2"></i>Dashboard</a>

										<a class="list-group-item <?php $active = $_GET['page'] == 'all_sponsorships' ? 'active' : '';
										echo $active; ?>" href="brand-profile.php?page=all_sponsorships#username"><i
												class="bi bi-badge-ad-fill fa-fw me-2"></i>All
											sponsorships</a>

										<a class="list-group-item <?php $active = $_GET['page'] == 'create_sponsorship' ? 'active' : '';
										echo $active; ?>" href="brand-profile.php?page=create_sponsorship#username"><i
												class="bi bi-plus-circle-dotted fa-fw me-2"></i>Create Sponsorship</a>

										<a class="list-group-item <?php $active = $_GET['page'] == 'all_requests' ? 'active' : '';
										echo $active; ?>" href="brand-profile.php?page=all_requests#username"><i
												class="bi bi-basket fa-fw me-2"></i>All
											Requests</a>

										<a class="list-group-item <?php $active = $_GET['page'] == 'all_clients' ? 'active' : '';
										echo $active; ?>" href="brand-profile.php?page=all_clients#username"><i
												class="bi bi-person-badge fa-fw me-2"></i>All
											clients</a>

										<a class="list-group-item <?php $active = $_GET['page'] == 'followings' ? 'active' : '';
										echo $active; ?>" href="brand-profile.php?page=followings#username"><i
												class="bi bi-person-plus fa-fw me-2"></i>Following</a>

										<a class="list-group-item <?php $active = $_GET['page'] == 'saved_creators' ? 'active' : '';
										echo $active; ?>" href="brand-profile.php?page=saved_creators#username"><i
												class="bi bi-people fa-fw me-2"></i>Saved
											Creators</a>

										<a class="list-group-item <?php $active = $_GET['page'] == 'edit_profile' ? 'active' : '';
										echo $active; ?>" href="brand-profile.php?page=edit_profile#username"><i
												class="bi bi-pencil-square fa-fw me-2"></i>Edit
											Profile</a>

										<a class="list-group-item <?php $active = $_GET['page'] == 'settings' ? 'active' : '';
										echo $active; ?>" href="brand-profile.php?page=settings#username"><i
												class="bi bi-gear fa-fw me-2"></i>Settings</a>
										<!-- 
										<a class="list-group-item <?php $active = $_GET['page'] == 'earnings' ? 'active' : '';
										echo $active; ?>" href="brand-profile.php?page=earnings"><i
												class="bi bi-currency-rupee fa-fw me-2"></i>Earnings</a> -->
										<a class="list-group-item <?php $active = $_GET['page'] == 'payments' ? 'active' : '';
										echo $active; ?>" href="brand-profile.php?page=payments#username"><i class="bi bi-wallet2"></i>Payments</a>
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
							include_once("../profile-functions/brand-all-dashboard-functions.php");
							include_once("brand-dashboard.php");
							break;
						case 'all_sponsorships':
							include_once("brand-all-sponsorships.php");
							break;
						case 'edit_sponsorships':
							include_once("brand-edit-sponsorships.php");
							break;
						case 'all_requests':
							include_once("brand-all-requests.php");
							break;
						case 'all_clients':
							//include_once("../profile-functions/brand-clients-functions.php");
							include_once("brand-clients.php");
							break;
						case 'followings':
							include_once("../profile-functions/brand-following-functions.php");
							include_once("brand-following.php");
							break;
						case 'saved_creators':
							include_once("../profile-functions/brand-saved-creators-functions.php");
							include_once("brand-saved-creators.php");
							break;
						case 'edit_profile':
							include_once("brand-edit-profile.php");
							break;
						case 'create_sponsorship':
							include_once("brand-create-sponsorship.php");
							break;
						case 'settings':
							include_once("brand-setting.php");
							break;
						case 'delete_profile':
							include_once("brand-delete-profile.php");
							break;
						case 'signout':
							header("Location: logout.php");
							break;
						case 'earnings':
							include_once("brand-earnings.php");
							break;
						case 'payments':
							include_once("brand-payments.php");
							break;
						default:
							include_once("brand-dashboard.php");
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

	<?php include_once("../common_ui/footer.php"); ?>

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
			echo '<script src="../assets/js/brand-all-sponsorship.js"></script>';
			break;
		case 'all_clients':
			echo '<script src="../assets/js/brand-all-requests-direct-client.js"></script>';
			echo '<script src="../assets/js/brand-all-requests-with-sponsorship-client.js"></script>';
			break;
		case 'all_requests':
			echo "<script src='https://checkout.razorpay.com/v1/checkout.js'></script>";
			echo '<script src="../assets/js/brand-all-requests-direct.js"></script>';
			echo '<script src="../assets/js/brand-all-requests-with-sponsorship.js"></script>';
			break;
		case 'followings':
			echo '<script src="../assets/js/brand-following.js"></script>';
			break;
		case 'saved_creators':
			echo '<script src="../assets/js/brand-saved-creators.js"></script>';
			break;
		case 'edit_profile':
			echo '<script src="../assets/js/brand-edit-profile.js"></script>';
			break;
		case 'settings':
			echo '<script src="../assets/js/brand-setting.js"></script>';
			break;
		case 'earnings':
			echo '<script src="../assets/js/brand-earnings.js"></script>';
			break;
		case 'payments':
			echo '<script src="../assets/js/brand-payment.js"></script>';
			break;
		case 'edit_sponsorships':
			echo '<script src="../assets/js/brand-create-update-sponsorship.js"></script>';
			break;
		case 'create_sponsorship':
			echo '<script src="../assets/js/brand-create-update-sponsorship.js"></script>';
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
		});
	</script>

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
		})
	</script>

	<script src="../assets/vendor/overlay-scrollbar/js/overlayscrollbars.min.jss"></script>

	<!-- for use in channel-settings.php-->
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script>
		$(function () {
			$("#channel-account-DateOfBirth").datepicker();
		});
	</script>

	<!-- Bootstrap JS -->
	<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script> -->
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>

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
		}
	</script>

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
		});
	</script>

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
		});
	</script>

</body>

</html>