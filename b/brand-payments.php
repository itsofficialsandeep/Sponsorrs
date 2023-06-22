<?php

include_once("../misc/db.php");

// get total expenses of last week
$sqlForWeek = $conn->prepare(
	"SELECT SUM(amount) AS amount 
							FROM payment_details
							WHERE created_at							 
							BETWEEN 
								DATE_FORMAT(YEARWEEK(NOW() - INTERVAL 1 WEEK), '%Y-%m-%d') 
								AND 
								DATE_FORMAT(YEARWEEK(NOW() - INTERVAL 1 WEEK), '%Y-%m-%d') + INTERVAL 6 DAY
							AND payment_from_ac_id='$currentUser'"
);


$sqlForWeek->execute();
$weekResults = $sqlForWeek->get_result();
$weekResultsAssoc = $weekResults->fetch_assoc();

// get total expenses of last month
$sqlForMonth = $conn->prepare("SELECT SUM(amount) AS amount FROM payment_details WHERE timestamp BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 6 MONTH), '%Y-%m-01') AND DATE_FORMAT(NOW(), '%Y-%m-31') AND payment_from_ac_id='$currentUser'");
$sqlForMonth->execute();
$monthResults = $sqlForMonth->get_result();
$monthResultsAssoc = $monthResults->fetch_assoc();

// get total expenses of last year
$sqlForYear = $conn->prepare("SELECT SUM(amount) AS amount FROM payment_details WHERE timestamp BETWEEN DATE_FORMAT(NOW() - INTERVAL 1 YEAR, '%Y-01-01') AND DATE_FORMAT(NOW() - INTERVAL 1 YEAR, '%Y-12-31') AND payment_from_ac_id='$currentUser'");
$sqlForYear->execute();
$yearResults = $sqlForYear->get_result();
$yearResultsAssoc = $yearResults->fetch_assoc();

// get total expenses till date
$sqlForTotal = $conn->prepare("SELECT SUM(amount) AS amount FROM payment_details WHERE payment_from_ac_id='$currentUser'");
$sqlForTotal->execute();
$totalResults = $sqlForTotal->get_result();
$totalResultsAssoc = $totalResults->fetch_assoc();

//echo $monthResultsAssoc['amount'] . '--' . $yearResultsAssoc['amount'] . '--' . $weekResultsAssoc['amount'] . '--' . $totalResultsAssoc['amount'];

?>

<div class="col-xl-9">

	<!-- Chart START -->
	<div class="row mt-5 mb-3">
		<div class="col-12">
			<h3 class="mt-1 mb-3">Expenses</h3>
			<div class="card card-body bg-transparent border p-4 ">
				<div class="row g-4">
					<!-- Content -->
					<div class="col-sm-6 col-md-3">
						<span class="badge text-bg-dark">Last week</span>
						<h4 class="text-primary my-2">
							<?php echo "$ " . $weekResultsAssoc['amount']; ?>
						</h4>
						<p class="mb-0 d-none"><span class="text-success me-1">0.20%<i
									class="bi bi-arrow-up"></i></span>vs
							last month</p>
					</div>
					<!-- Content -->
					<div class="col-sm-6 col-md-3">
						<span class="badge text-bg-dark">Last Month</span>
						<h4 class="my-2 text-primary">
							<?php echo "$ " . $monthResultsAssoc['amount']; ?>
						</h4>
						<p class="mb-0 d-none"><span class="text-danger me-1">0.10%<i
									class="bi bi-arrow-down"></i></span>Then
							last month</p>
					</div>
					<!-- Content -->
					<div class="col-sm-6 col-md-3">
						<span class="badge text-bg-dark">Last Year</span>
						<h4 class="my-2 text-primary">
							<?php echo "$ " . $yearResultsAssoc['amount']; ?>
						</h4>
						<p class="mb-0 d-none"><span class="text-danger me-1">0.10%<i
									class="bi bi-arrow-down"></i></span>Then
							last month</p>
					</div>
					<!-- Content -->
					<div class="col-sm-6 col-md-3">
						<span class="badge text-bg-dark">Till Now</span>
						<h4 class="my-2 text-primary">
							<?php echo "$ " . $totalResultsAssoc['amount']; ?>
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
	<!-- Payout box START -->
	<div class="row g-4 mb-4 d-none">
		<!-- Box item -->
		<div class="col-sm-6 col-md-4">
			<div class="border p-3 rounded-3 h-100">
				<div class="d-flex mb-1 justify-content-between align-items-center">
					<h6 class="mb-0">Last month payout</h6>
					<span class="badge bg-success bg-opacity-10 text-success ms-2 mb-0">Paid</span>
				</div>
				<h2 class="mb-2 mt-2">$12,825</h2>
				<a href="#">View transaction</a>
			</div>
		</div>

		<!-- Box item -->
		<div class="col-sm-6 col-md-4">
			<div class="border p-3 rounded-3 h-100">
				<h6 class="mb-0">This month earning</h6>
				<h2 class="mb-2 mt-2">$15,356</h2>
				<p class="mb-0">Expected payout on 05/01/2023</p>
			</div>
		</div>

		<!-- Box item -->
		<div class="col-sm-6 col-md-4">
			<div class="bg-primary bg-opacity-10 h-100 p-3 rounded-3">
				<h6 class="mb-0">Balance</h6>
				<h2 class="mb-2 mt-2">$8,485</h2>
				<a href="#" class="btn btn-sm btn-primary mb-0">Withdraw Earning</a>
			</div>
		</div>
	</div>
	<!-- Payout box END -->

	<div class="card bg-transparent border rounded-3">
		<!-- Card header START -->
		<div class="card-header bg-transparent border-bottom">
			<h3 class="mb-0">Payouts</h3>
		</div>
		<!-- Card header END -->

		<!-- Card body START -->
		<div class="card-body">

			<!-- Title and select START -->
			<div class="row g-3 align-items-center justify-content-between mb-4  d-none">
				<!-- Content -->
				<div class="col-md-8">
					<form class="rounded position-relative">
						<input class="form-control pe-5 bg-transparent" type="search" placeholder="Search"
							aria-label="Search">
						<button
							class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset"
							type="submit">
							<i class="fas fa-search fs-6 "></i>
						</button>
					</form>
				</div>

				<!-- Select option -->
				<div class="col-md-3">
					<!-- Short by filter -->
					<form>
						<div class="choices" data-type="select-one" tabindex="0" role="combobox"
							aria-autocomplete="list" aria-haspopup="true" aria-expanded="false">
							<div class="choices__inner"><select
									class="form-select js-choice border-0 z-index-9 bg-transparent choices__input"
									aria-label=".form-select-sm" hidden="" tabindex="-1" data-choice="active">
									<option value="" data-custom-properties="[object Object]">Sort by</option>
								</select>
								<div class="choices__list choices__list--single">
									<div class="choices__item choices__placeholder choices__item--selectable"
										data-item="" data-id="1" data-value="" data-custom-properties="[object Object]"
										aria-selected="true">Sort by</div>
								</div>
							</div>
							<div class="choices__list choices__list--dropdown" aria-expanded="false"><input
									type="search" name="search_terms" class="choices__input choices__input--cloned"
									autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox"
									aria-autocomplete="list" aria-label="Sort by" placeholder="">
								<div class="choices__list" role="listbox">
									<div id="choices--dk7w-item-choice-4"
										class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted"
										role="option" data-choice="" data-id="4" data-value=""
										data-select-text="Press to select" data-choice-selectable=""
										aria-selected="true">Sort by</div>
									<div id="choices--dk7w-item-choice-1"
										class="choices__item choices__item--choice choices__item--selectable"
										role="option" data-choice="" data-id="1" data-value="Free"
										data-select-text="Press to select" data-choice-selectable="">Free</div>
									<div id="choices--dk7w-item-choice-2"
										class="choices__item choices__item--choice choices__item--selectable"
										role="option" data-choice="" data-id="2" data-value="Newest"
										data-select-text="Press to select" data-choice-selectable="">Newest</div>
									<div id="choices--dk7w-item-choice-3"
										class="choices__item choices__item--choice choices__item--selectable"
										role="option" data-choice="" data-id="3" data-value="Oldest"
										data-select-text="Press to select" data-choice-selectable="">Oldest</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- Title and select END -->

			<!-- Payout list table START -->
			<div class="table-responsive border-0">
				<table class="table table-dark-gray align-middle p-4 mb-0 table-hover">
					<!-- Table head -->
					<thead>
						<tr>
							<th scope="col" class="border-0 rounded-start">Payout</th>
							<th scope="col" class="border-0">Amount</th>
							<th scope="col" class="border-0">Currency</th>
							<th scope="col" class="border-0">To</th>
							<th scope="col" class="border-0">Status</th>
							<th scope="col" class="border-0 rounded-end">Date</th>
						</tr>
					</thead>
					<!-- Table body START -->
					<tbody id="payment-response-area">

						<!-- Table item -->
						<tr>
							<!-- Table data -->
							<td>
								<h6 class="mt-2 mt-lg-0 mb-0"><a href="#">Successful payout #102356</a></h6>
							</td>

							<!-- Table data -->
							<td>$3,999
								<!-- Drop down with id -->
								<a href="#" class="h6 mb-0" role="button" id="dropdownShare" data-bs-toggle="dropdown"
									aria-expanded="false">
									<i class="bi bi-info-circle-fill"></i>
								</a>
								<ul class="dropdown-menu dropdown-w-sm dropdown-menu-end min-w-auto shadow rounded"
									aria-labelledby="dropdownShare">
									<li>
										<div class="d-flex justify-content-between">
											<span class="small">Commission</span>
											<span class="h6 mb-0 small">$86</span>
										</div>
										<hr class="my-1">
									</li>
									<!-- Divider -->

									<li>
										<div class="d-flex justify-content-between">
											<span class="me-4 small">Us royalty withholding</span>
											<span class="text-danger small">-$0.00</span>
										</div>
										<hr class="my-1">
									</li>

									<li>
										<div class="d-flex justify-content-between">
											<span class="small">Earning</span>
											<span class="h6 mb-0 small">$86</span>
										</div>
									</li>
								</ul>
							</td>

							<!-- Table data -->
							<td class="text-center text-sm-start">
								<span class="badge bg-success bg-opacity-10 text-success">Paid</span>
							</td>

							<!-- Table data -->
							<td>18/1/2023</td>
						</tr>

						<!-- Table item -->
						<tr>
							<!-- Table data -->
							<td>
								<!-- Title -->
								<h6 class="mt-2 mt-lg-0 mb-0"><a href="#">Successful payout #102589</a></h6>
							</td>

							<!-- Table data -->
							<td>$4,875
								<!-- Drop down with id -->
								<a href="#" class="h6 mb-0" role="button" id="dropdownShare1" data-bs-toggle="dropdown"
									aria-expanded="false">
									<i class="bi bi-info-circle-fill"></i>
								</a>
								<ul class="dropdown-menu dropdown-w-sm dropdown-menu-end min-w-auto shadow rounded"
									aria-labelledby="dropdownShare1">
									<li>
										<div class="d-flex justify-content-between">
											<span class="small">Commission</span>
											<span class="h6 mb-0 small">$86</span>
										</div>
										<hr class="my-1">
									</li>
									<!-- Divider -->

									<li>
										<div class="d-flex justify-content-between">
											<span class="me-4 small">Us royalty withholding</span>
											<span class="text-danger small">-$0.00</span>
										</div>
										<hr class="my-1">
									</li>

									<li>
										<div class="d-flex justify-content-between">
											<span class="small">Earning</span>
											<span class="h6 mb-0 small">$86</span>
										</div>
									</li>
								</ul>
							</td>

							<!-- Table data -->
							<td class="text-center text-sm-start">
								<span class="badge bg-success bg-opacity-10 text-success">Paid</span>
							</td>

							<!-- Table data -->
							<td>12/1/2023</td>
						</tr>

						<!-- Table item -->
						<tr>
							<!-- Table data -->
							<td>
								<h6 class="mt-2 mt-lg-0 mb-0"><a href="#">Successful payout #108645</a></h6>
							</td>

							<!-- Table data -->
							<td>$1,800
								<!-- Drop down with id -->
								<a href="#" class="h6 mb-0" role="button" id="dropdownShare2" data-bs-toggle="dropdown"
									aria-expanded="false">
									<i class="bi bi-info-circle-fill"></i>
								</a>
								<ul class="dropdown-menu dropdown-w-sm dropdown-menu-end min-w-auto shadow rounded"
									aria-labelledby="dropdownShare2">
									<li>
										<div class="d-flex justify-content-between">
											<span class="small">Commission</span>
											<span class="h6 mb-0 small">$86</span>
										</div>
										<hr class="my-1">
									</li>
									<!-- Divider -->

									<li>
										<div class="d-flex justify-content-between">
											<span class="me-4 small">Us royalty withholding</span>
											<span class="text-danger small">-$0.00</span>
										</div>
										<hr class="my-1">
									</li>

									<li>
										<div class="d-flex justify-content-between">
											<span class="small">Earning</span>
											<span class="h6 mb-0 small">$86</span>
										</div>
									</li>
								</ul>
							</td>

							<!-- Table data -->
							<td class="text-center text-sm-start">
								<span class="badge bg-danger bg-opacity-10 text-danger">Cancelled </span>
							</td>

							<!-- Table data -->
							<td>22/1/2023</td>
						</tr>

						<!-- Table item -->
						<tr>
							<!-- Table data -->
							<td>
								<h6 class="mt-2 mt-lg-0 mb-0"><a href="#">Successful payout #108645</a></h6>
							</td>

							<!-- Table data -->
							<td>$6,800
								<!-- Drop down with id -->
								<a href="#" class="h6 mb-0" role="button" id="dropdownShare3" data-bs-toggle="dropdown"
									aria-expanded="false">
									<i class="bi bi-info-circle-fill"></i>
								</a>
								<ul class="dropdown-menu dropdown-w-sm dropdown-menu-end min-w-auto shadow rounded"
									aria-labelledby="dropdownShare3">
									<li>
										<div class="d-flex justify-content-between">
											<span class="small">Commission</span>
											<span class="h6 mb-0 small">$86</span>
										</div>
										<hr class="my-1">
									</li>
									<!-- Divider -->

									<li>
										<div class="d-flex justify-content-between">
											<span class="me-4 small">Us royalty withholding</span>
											<span class="text-danger small">-$0.00</span>
										</div>
										<hr class="my-1">
									</li>

									<li>
										<div class="d-flex justify-content-between">
											<span class="small">Earning</span>
											<span class="h6 mb-0 small">$86</span>
										</div>
									</li>
								</ul>
							</td>

							<!-- Table data -->
							<td class="text-center text-sm-start">
								<span class="badge bg-success bg-opacity-10 text-success">Paid</span>
							</td>

							<!-- Table data -->
							<td>28/1/2023</td>
						</tr>

						<!-- Table item -->
						<tr>
							<!-- Table data -->
							<td>
								<!-- Title -->
								<h6 class="mt-2 mt-lg-0 mb-0"><a href="#">Successful payout #108645</a></h6>
							</td>

							<!-- Table data -->
							<td>$3,576
								<!-- Drop down with id -->
								<a href="#" class="h6 mb-0" role="button" id="dropdownShare4" data-bs-toggle="dropdown"
									aria-expanded="false">
									<i class="bi bi-info-circle-fill"></i>
								</a>
								<ul class="dropdown-menu dropdown-w-sm dropdown-menu-end min-w-auto shadow rounded"
									aria-labelledby="dropdownShare4">
									<li>
										<div class="d-flex justify-content-between">
											<span class="small">Commission</span>
											<span class="h6 mb-0 small">$86</span>
										</div>
										<hr class="my-1">
									</li>
									<!-- Divider -->

									<li>
										<div class="d-flex justify-content-between">
											<span class="me-4 small">Us royalty withholding</span>
											<span class="text-danger small">-$0.00</span>
										</div>
										<hr class="my-1">
									</li>

									<li>
										<div class="d-flex justify-content-between">
											<span class="small">Earning</span>
											<span class="h6 mb-0 small">$86</span>
										</div>
									</li>
								</ul>
							</td>

							<!-- Table data -->
							<td class="text-center text-sm-start">
								<span class="badge bg-orange bg-opacity-10 text-orange">Pending</span>
							</td>

							<!-- Table data -->
							<td>12/1/2023</td>
						</tr>
					</tbody>
					<!-- Table body END -->
				</table>
			</div>
			<!-- Payout list table END -->

			<!-- Pagination START -->
			<div class="d-sm-flex justify-content-sm-center align-items-sm-center mt-4 mt-sm-3">
				<button class="border border-primary bg-primary p-2 rounded text-white" id="payment-load-more">Load
					More</button>
			</div>

		</div>
		<!-- Card body START -->
	</div>
	<!-- Payout END -->
</div>