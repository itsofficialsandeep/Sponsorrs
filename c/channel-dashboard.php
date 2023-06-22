<?php

include_once("../misc/db.php");

// get total expenses of last week
$sqlForWeek = $conn->prepare(
	"SELECT SUM(amount) AS amount 
							FROM payment_details
							WHERE timestamp							 
							BETWEEN 
								DATE_FORMAT(YEARWEEK(NOW() - INTERVAL 1 WEEK), '%Y-%m-%d') 
								AND 
								DATE_FORMAT(YEARWEEK(NOW() - INTERVAL 1 WEEK), '%Y-%m-%d') + INTERVAL 6 DAY
							AND payment_to_ac_id='$currentUser'"
);

$sqlForWeek->execute();
$weekResults = $sqlForWeek->get_result();
$weekResultsAssoc = $weekResults->fetch_assoc();

// get total expenses of last month
$sqlForMonth = $conn->prepare("SELECT SUM(amount) AS amount FROM payment_details WHERE timestamp BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 6 MONTH), '%Y-%m-01') AND DATE_FORMAT(NOW(), '%Y-%m-31') AND payment_to_ac_id='$currentUser'");
$sqlForMonth->execute();
$monthResults = $sqlForMonth->get_result();
$monthResultsAssoc = $monthResults->fetch_assoc();

// get total expenses of last year
$sqlForYear = $conn->prepare("SELECT SUM(amount) AS amount FROM payment_details WHERE timestamp BETWEEN DATE_FORMAT(NOW() - INTERVAL 1 YEAR, '%Y-01-01') AND DATE_FORMAT(NOW() - INTERVAL 1 YEAR, '%Y-12-31') AND payment_to_ac_id='$currentUser'");
$sqlForYear->execute();
$yearResults = $sqlForYear->get_result();
$yearResultsAssoc = $yearResults->fetch_assoc();

// get total expenses till date
$sqlForTotal = $conn->prepare("SELECT SUM(amount) AS amount FROM payment_details WHERE payment_to_ac_id='$currentUser'");
$sqlForTotal->execute();
$totalResults = $sqlForTotal->get_result();
$totalResultsAssoc = $totalResults->fetch_assoc();

//echo $monthResultsAssoc['amount'] . '--' . $yearResultsAssoc['amount'] . '--' . $weekResultsAssoc['amount'] . '--' . $totalResultsAssoc['amount'];

?>

<div class="col-xl-9">

	<!-- Counter boxes START -->
	<div class="row ">
		<h3 class="mb-3">Sponsorships requests</h3>
		<!-- Counter item -->
		<div class="col-sm-6 col-lg-4">
			<div class="d-flex justify-content-center align-items-center p-4 bg-warning bg-opacity-15 rounded-3">
				<span class="display-6 text-warning mb-0"><i class="bi bi-send-fill"></i></span>
				<div class="ms-4">
					<div class="d-flex">
						<h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0"
							data-purecounter-end="<?php echo basicStat($conn, "total", $currentUser); ?>"
							data-purecounter-delay="200">0</h5>
					</div>
					<span class="mb-0 h6 fw-light">Total request sent</span>
				</div>
			</div>
		</div>
		<!-- Counter item -->
		<div class="col-sm-6 col-lg-4">
			<div class="d-flex justify-content-center align-items-center p-4 bg-purple bg-opacity-10 rounded-3">
				<span class="display-6 text-purple mb-0"><i class="fas fa-user-graduate fa-fw"></i></span>
				<div class="ms-4">
					<div class="d-flex">
						<h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0"
							data-purecounter-end="<?php echo basicStat($conn, "noresponse", $currentUser); ?>"
							data-purecounter-delay="200">0</h5>
					</div>
					<span class="mb-0 h6 fw-light">No-Response request</span>
				</div>
			</div>
		</div>
		<!-- Counter item -->
		<div class="col-sm-6 col-lg-4 mt-2">
			<div class="d-flex justify-content-center align-items-center p-4 bg-danger bg-opacity-10 rounded-3">
				<span class="display-6 text-info mb-0"><i class="bi bi-reply-fill"></i></span>
				<div class="ms-4">
					<div class="d-flex">
						<h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0"
							data-purecounter-end="<?php echo basicStat($conn, "accepted", $currentUser); ?>"
							data-purecounter-delay="300">0</h5>
					</div>
					<span class="mb-0 h6 fw-light">Accepted request(s)</span>
				</div>
			</div>
		</div>
		<!-- </div> -->
		<!-- Counter item -->
		<div class="col-sm-6 col-lg-4">
			<div class="d-flex justify-content-center align-items-center p-4 bg-info bg-opacity-10 rounded-3">
				<span class="display-6 text-info mb-0"><i class="bi bi-slash-circle-fill"></i></span>
				<div class="ms-4">
					<div class="d-flex">
						<h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0"
							data-purecounter-end="<?php echo basicStat($conn, "rejected", $currentUser); ?>"
							data-purecounter-delay="300">0</h5>

					</div>
					<span class="mb-0 h6 fw-light">Rejected request(s)</span>
				</div>
			</div>
		</div>
		<!-- Counter item -->
		<div class="col-sm-6 col-lg-4">
			<div class="d-flex justify-content-center align-items-center p-4 bg-warning bg-opacity-10 rounded-3">
				<span class="display-6 text-info mb-0"><i class="bi bi-building"></i></span>
				<div class="ms-4">
					<div class="d-flex">
						<h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0"
							data-purecounter-end="<?php echo basicStat($conn, "total_company", $currentUser); ?>"
							data-purecounter-delay="300">0</h5>

					</div>
					<span class="mb-0 h6 fw-light">Brand you apporached</span>
				</div>
			</div>
		</div>
		<!-- </div> -->
	</div>

	<!-- Counter boxes END -->

	<!-- Counter boxes START -->
	<div class="row mt-5">
		<h3 class="mb-3">Other</h3>
		<!-- Counter item -->
		<a href="" class="col-sm-6 col-lg-4">
			<div class="d-flex justify-content-center align-items-center p-4 bg-warning bg-opacity-15 rounded-3">
				<span class="display-6 text-warning mb-0"><i class="bi bi-building"></i></span>
				<div class="ms-4">
					<div class="d-flex">
						<h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0"
							data-purecounter-end="<?php echo basicStat($conn, "saved_brand", $currentUser); ?>"
							data-purecounter-delay="200">0</h5>
					</div>
					<span class="mb-0 h6 fw-light">Total brand saved</span>
				</div>
			</div>
		</a>
		<!-- Counter item -->
		<div class="col-sm-6 col-lg-4">
			<div class="d-flex justify-content-center align-items-center p-4 bg-purple bg-opacity-10 rounded-3">
				<span class="display-6 text-purple mb-0"><i class="bi bi-building"></i></span>
				<div class="ms-4">
					<div class="d-flex">
						<h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0"
							data-purecounter-end="<?php echo basicStat($conn, "channel_following", $currentUser); ?>"
							data-purecounter-delay="200">0</h5>

					</div>
					<span class="mb-0 h6 fw-light">Following Brand(s)</span>
				</div>
			</div>
		</div>

	</div>
	<!-- Counter boxes END -->



	<!-- Chart START -->
	<div class="row mt-5">
		<div class="col-12">
			<h3 class="mt-1 mb-3">Earnings</h3>
			<div class="card card-body bg-transparent border p-4 ">
				<div class="row g-4">
					<!-- Content -->
					<div class="col-sm-6 col-md-3">
						<span class="badge text-bg-dark">Last week</span>
						<h4 class="text-primary my-2">
							<?php echo "$" . $weekResultsAssoc['amount']; ?>
						</h4>
						<p class="mb-0 d-none"><span class="text-success me-1">0.20%<i
									class="bi bi-arrow-up"></i></span>vs
							last month</p>
					</div>
					<!-- Content -->
					<div class="col-sm-6 col-md-3">
						<span class="badge text-bg-dark">Last Month</span>
						<h4 class="my-2 text-primary ">
							<?php echo "$" . $monthResultsAssoc['amount']; ?>
						</h4>
						<p class="mb-0 d-none"><span class="text-danger me-1">0.10%<i
									class="bi bi-arrow-down"></i></span>Then
							last month</p>
					</div>
					<!-- Content -->
					<div class="col-sm-6 col-md-3">
						<span class="badge text-bg-dark">Last Year</span>
						<h4 class="my-2 text-primary ">
							<?php echo "$" . $yearResultsAssoc['amount']; ?>
						</h4>
						<p class="mb-0 d-none"><span class="text-danger me-1">0.10%<i
									class="bi bi-arrow-down"></i></span>Then
							last month</p>
					</div>
					<!-- Content -->
					<div class="col-sm-6 col-md-3">
						<span class="badge text-bg-dark">Till Now</span>
						<h4 class="my-2 text-primary ">
							<?php echo "$" . $totalResultsAssoc['amount']; ?>
						</h4>
						<p class="mb-0 d-none"><span class="text-danger me-1">0.10%<i
									class="bi bi-arrow-down"></i></span>Then
							last month</p>
					</div>
				</div>

				<!-- Apex chart -->
				<div class="d-none" id="ChartPayout"></div>

			</div>
		</div>
	</div>
	<!-- Chart END -->
</div>