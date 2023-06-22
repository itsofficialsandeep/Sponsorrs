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
            $querySponsorshipDetail = "SELECT sponsorship_id, posted_on, sponsorship_title, description,id_company 
                                        FROM `sponsorships` 
										WHERE active=1 
                                            AND id_company='$currentUser' 
                                        ORDER BY posted_on 
                                        ASC LIMIT $from,$total";
        }

        if ($result = $conn->query($querySponsorshipDetail)) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $sponsorship_id = $row['sponsorship_id'];
                    $posted_on = $row['posted_on'];
                    $sponsorship_title = $row['sponsorship_title'];
                    $description = $row['description'];
                    $id_company = $row['id_company'];

                    $action = "";

                    // if ($status == 0) {
                    // 	$statusBadge = "Rejected";
                    // 	$badgeColor = "bg-danger text-danger";
                    // }
                    // if ($status == 1) {
                    // 	$statusBadge = "Accepted";
                    // 	$badgeColor = "bg-success text-success";
                    // }
                    // if ($status == 2) {
                    // 	$statusBadge = "Sent";
                    // 	$badgeColor = "bg-warning text-warning";
                    // 	$action = '<button class="btn btn-sm btn-danger-soft btn-round mb-0 deleteSponsorshipButton" onclick="deleteRequest(this.value,' . $id_apply . ')" value="#' . $id_apply . '" ><i class="fas fa-fw fa-times"></i></button>';
                    // }

                    echo '<tr data-pages="' . $from . '" id="' . $sponsorship_id . '">
							<!-- Course item -->
							<td>
								<div class="d-flex align-items-center">
									<!-- Image -->
									<div class="w-60px">
										<img src="../assets/images/courses/4by3/08.jpg" class="rounded" alt="">
									</div>
									<div class="mb-0 ms-2">
										<!-- Title -->
										<h6><a href="brand-profile.php?page=edit_sponsorships&sp=' . $sponsorship_id . '">' . substr($sponsorship_title, 0, 15) . '</a></h6>
									</div>
								</div>
							</td>
							<td>
								' . substr($description, 0, 50) . '
							</td>
							<!-- Enrolled item -->
							<td class="text-center text-sm-start">' . date("d-M-Y", strtotime($posted_on)) . '</td>
							<!-- Action item -->
							<td>
								<button class="btn btn-sm btn-danger-soft btn-round mb-0 deleteSponsorshipButton" onclick="deleteRequest(this.value)" data-sponsorship="' . $sponsorship_id . '"  value="#' . $sponsorship_id . '" ><i class="fas fa-fw fa-times"></i></button>
							</td>
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