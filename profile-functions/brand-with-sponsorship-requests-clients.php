<?php
session_start();

include_once("../misc/db.php");
include_once("../misc/functions.php");

if (isset($_POST['search_result_type'])) {
	$searchResultType = $_POST['search_result_type'];

	// search result type '1' means 
	// http://localhost/t/Sponsorrs/c/channel-profile.php?page=all_sponsorships
	// latest sponsorships
	if ($searchResultType == 1) {
		$currentUser = $_SESSION['currentUser'];
		$total = 20;
		$from = $_POST['from'];
		$from = (int) $from;

		if ($_POST['filter'] == 1) {
			$querySponsorshipDetail = "SELECT DISTINCT id_user, snippettitle,snippetthumbnailsdefaulturl, snippetdescription, 
														statisticssubscriberCount, channel_type, apply_sponsorships.id_apply,owned_by,
														id,status 
										FROM apply_sponsorships 
										LEFT JOIN channel_detail 
										ON apply_sponsorships.id_user=channel_detail.owned_by 
										WHERE id_company = '$currentUser' 
										AND status=1 
										GROUP BY id_user 
										DESC LIMIT $from,$total";
		}

		if ($result = $conn->query($querySponsorshipDetail)) {
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$owned_by = $row['owned_by'];
					$snippettitle = $row['snippettitle'];
					$snippetdescription = $row['snippetdescription'];
					$id = $row['id'];
					$channel_type = $row['channel_type'];
					$statisticssubscriberCount = $row['statisticssubscriberCount'];
					$snippetthumbnailsdefaulturl = $row['snippetthumbnailsdefaulturl'];
					$apply_id = $row['id_apply'];
					$status = $row['status'];
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
					// 	$action = '<button class="btn btn-sm btn-danger-soft btn-round mb-0 deleteSponsorshipButton" onclick="deleteApplication(this.value)" data-sponsorship="' . $apply_id . '"  value="#' . $apply_id . '" ><i class="bi bi-trash3-fill"></i></button>';
					// }

					echo '<tr data-pages="' . $from . '" id="' . $apply_id . '">
							<!-- Course item -->
							<td>
								<div class="d-flex align-items-center">
									<!-- Image -->
									<div class="w-60px">
										<img src="' . $snippetthumbnailsdefaulturl . '" class="rounded" alt="">
									</div>
									<div class="mb-0 ms-2">
										<!-- Title -->
										<h6><a href="#">' . substr(
							$snippettitle
							,
							0,
							15
						) . '</a></h6>
									</div>
								</div>
							</td>
							<td>
								' . substr($snippetdescription, 0, 50) . '
							</td>
							<!-- Enrolled item -->
							<td class="text-center text-sm-start">' . $channel_type . '</td>

							<td>
								' . $statisticssubscriberCount . '
							</td>
							<td>
								
							</td>

						</tr>';
				}
			} else {
				echo "0";
			}
		} else {
			$_SESSION['script_error_code'] = "1001";
			//header("Location:../error-404.html");
		}
	}
}

if (isset($_POST['actionType']) && $_POST['actionType'] === "deleteApplication" && $_POST['applyId']) {
	include_once("../misc/db.php");
	include_once("../misc/functions.php");

	$application_id = $_POST['applyId'];
	$application_id = trim($application_id, "#");

	deleteRequest($conn, $application_id);
}

// deletes the request of sponsorships
function deleteRequest($conn, $application_id)
{
	$queryBaicDetail = "UPDATE apply_sponsorships SET status=0 WHERE id_apply ='$application_id'";

	if ($conn->query($queryBaicDetail)) {
		$message = new message(200, "success", "Sucessfully deleted" . $queryBaicDetail);
		$message->printMessage();
	} else {
		$message = new message(400, "failed", "Sponsorship not deleted");
		$message->printMessage();
	}
}

?>