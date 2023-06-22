<?php

include_once("../misc/db.php");
include_once("../misc/functions.php");

if (isset($_POST['actionType'])) {
	session_start();

	$currentUser = $_SESSION['currentUser'];

	$actionType = $_POST['actionType'];

	// Get the information of the brand who has accepted to partner with the channel.
	if ($actionType == 3) {

		$total = 20;
		$from = $_POST['from'];
		$from = (int) $from;

		if (isset($_POST['text'])) {
			$text = substr($_POST['text'], 0, 100);
		}

		if ($_POST['filter'] == 1) { // Filter by name
			$sql = "SELECT payment_details.id, payment_details.amount,payment_details.currency,
                            payment_details.method,payment_details.created_at, dp_username 
                    FROM payment_details 
                    LEFT JOIN primary_ac 
                    ON primary_ac.ac_id=payment_details.payment_to_ac_id 
                    WHERE payment_from_ac_id='$currentUser' 
					ORDER BY created_at  
					DESC LIMIT $from,$total";
		}

		if ($result = $conn->query($sql)) {
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {

					$id = $row['id'];
					$amount = $row['amount'];
					$currency = $row['currency'];
					$method = $row['method'];
					$created_at = $row['created_at'];
					$dp_username = $row['dp_username'];

					echo '<tr>
							<!-- Table data -->
							<td>
								<h6 class="mt-2 mt-lg-0 mb-0"><a href="#">' . $id . '</a></h6>
							</td>

							<!-- Table data -->
							<td>' . $amount/100 . ' 
								<!-- Drop down with id -->
								<a href="#" class="h6 mb-0" role="button" id="dropdownShare" data-bs-toggle="dropdown"
									aria-expanded="false">
									<i class="bi bi-info-circle-fill"></i>
								</a>
								<ul class="dropdown-menu dropdown-w-sm dropdown-menu-end min-w-auto shadow rounded d-none"
									aria-labelledby="dropdownShare">
									<li>
										<div class="d-flex justify-content-between">
											<span class="small">Commission</span>
											<span class="h6 mb-0 small">0%</span>
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
								<span class="badge bg-info bg-opacity-10 text-info">' . $currency . '</span>
							</td>

                            <!-- Table data -->
							<td class="text-center text-sm-start">
								<a href="/@' . $dp_username . '"><span class=" bg-opacity-10">@' . substr($dp_username, 0, 10) . '..</span></a>
							</td>

                            <!-- Table data -->
							<td class="text-center text-sm-start">
								<span class="badge bg-success bg-opacity-10 text-success">Paid</span>
							</td>

							<!-- Table data -->
							<td>' . date("F jS, Y", strtotime($created_at)) . '</td>
						</tr>';
				}
			} else {
				echo "0";
			}
		} else {
			echo "0";
		}
	}
}

?>