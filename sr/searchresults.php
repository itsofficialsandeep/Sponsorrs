<?php
session_start();

include_once("../misc/db.php");
include_once("../misc/functions.php");

$searchResultType = $_POST['search_result_type'];
if (isset($_POST['search_result_type'])) {

	// search result type '1' means 
	// http://localhost/t/Sponsorrs/c/channel-profile.php?page=all_sponsorships
	// latest sponsorships
	if ($searchResultType == 1) {
		$currentUser = $_SESSION['currentUser'];
		$total = 20;
		$from = $_POST['from'];
		$from = (int) $from;

		if ($_POST['filter'] == 1) {
			$querySponsorshipDetail = "SELECT apply_sponsorships.*, sponsorships.sponsorship_title,sponsorships.offer_price,company.companyname 
									FROM apply_sponsorships LEFT JOIN sponsorships ON apply_sponsorships.id_sponsorship = sponsorships.sponsorship_id 
									LEFT JOIN company ON apply_sponsorships.id_company = company.id_company 
									WHERE apply_sponsorships.id_user='$currentUser' AND apply_sponsorships.status=1 ORDER BY STATUS ASC LIMIT $from,$total";
		} elseif ($_POST['filter'] == 0) {
			$querySponsorshipDetail = "SELECT apply_sponsorships.*, sponsorships.sponsorship_title,sponsorships.offer_price,company.companyname 
									FROM apply_sponsorships LEFT JOIN sponsorships ON apply_sponsorships.id_sponsorship = sponsorships.sponsorship_id 
									LEFT JOIN company ON apply_sponsorships.id_company = company.id_company 
									WHERE apply_sponsorships.id_user='$currentUser'  AND apply_sponsorships.status=0  ORDER BY STATUS ASC LIMIT $from,$total";
		} elseif ($_POST['filter'] == 2) {
			$querySponsorshipDetail = "SELECT apply_sponsorships.*, sponsorships.sponsorship_title,sponsorships.offer_price,company.companyname 
									FROM apply_sponsorships LEFT JOIN sponsorships ON apply_sponsorships.id_sponsorship = sponsorships.sponsorship_id 
									LEFT JOIN company ON apply_sponsorships.id_company = company.id_company 
									WHERE apply_sponsorships.id_user='$currentUser'  AND apply_sponsorships.status=2  ORDER BY STATUS ASC LIMIT $from,$total";
		} elseif ($_POST['filter'] == 3) {
			$querySponsorshipDetail = "SELECT apply_sponsorships.*, sponsorships.sponsorship_title,sponsorships.offer_price,company.companyname 
									FROM apply_sponsorships LEFT JOIN sponsorships ON apply_sponsorships.id_sponsorship = sponsorships.sponsorship_id 
									LEFT JOIN company ON apply_sponsorships.id_company = company.id_company 
									WHERE apply_sponsorships.id_user='$currentUser' ORDER BY STATUS ASC LIMIT $from,$total";
		} else {
			$querySponsorshipDetail = "SELECT apply_sponsorships.*, sponsorships.sponsorship_title,sponsorships.offer_price,company.companyname 
									FROM apply_sponsorships LEFT JOIN sponsorships ON apply_sponsorships.id_sponsorship = sponsorships.sponsorship_id 
									LEFT JOIN company ON apply_sponsorships.id_company = company.id_company 
									WHERE apply_sponsorships.id_user='$currentUser' ORDER BY STATUS ASC LIMIT $from,$total";
		}

		if ($result = $conn->query($querySponsorshipDetail)) {
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$id_apply = $row['id_apply'];
					$id_sponsorship = $row['id_sponsorship'];
					$id_company = $row['id_company'];
					$companyname = $row['companyname'];
					$status = $row['status'];
					$applied_on = $row['applied_on'];
					$sponsorship_title = $row['sponsorship_title'];
					$offer_price = $row['offer_price'];

					$action = "";

					if ($status == 0) {
						$statusBadge = "Rejected";
						$badgeColor = "bg-danger text-danger";
					}
					if ($status == 1) {
						$statusBadge = "Accepted";
						$badgeColor = "bg-success text-success";
					}
					if ($status == 2) {
						$statusBadge = "Sent";
						$badgeColor = "bg-warning text-warning";
						$action = '<button class="btn btn-sm btn-danger-soft btn-round mb-0 deleteSponsorshipButton" onclick="deleteRequest(this.value,' . $id_apply . ')" value="#' . $id_apply . '" ><i class="fas fa-fw fa-times"></i></button>';
					}



					echo '<tr id="' . $id_apply . '">
							<!-- Course item -->
							<td>
								<div class="d-flex align-items-center">
									<!-- Image -->
									<div class="w-60px">
										<img src="../assets/images/courses/4by3/08.jpg" class="rounded" alt="">
									</div>
									<div class="mb-0 ms-2">
										<!-- Title -->
										<h6><a href="#">' . $sponsorship_title . '</a></h6>
										<!-- Info -->
										<div class="d-sm-flex">
											<a href="' . $id_company . '"<p class="h6 fw-light mb-0 small me-3"><i class="fas fa-building text-orange me-2"></i>' . $companyname . '</p></a>
											
										</div>
									</div>
								</div>
							</td>
							<!-- Enrolled item -->
							<td class="text-center text-sm-start">' . date("d-M-Y", strtotime($applied_on)) . '</td>
							<!-- Status item -->
							<td>
								<div class="badge ' . $badgeColor . ' bg-opacity-10">' . $statusBadge . '</div>
							</td>
							<!-- Price item -->
							<td> Rs ' . $offer_price .'</td>
							<!-- Action item -->
							<td>
								' . $action . '
							</td>
						</tr>';
				}
			} else {
				echo '0';
			}
		} else {
			$_SESSION['script_error_code'] = "1001";
			//header("Location:../error-404.html");
		}
	}
}

?>