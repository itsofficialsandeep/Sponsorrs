<?php
session_start();

include_once("../misc/db.php");
include_once("../misc/functions.php");

if (isset($_POST['search_result_type'])) {
	$searchResultType = $_POST['search_result_type'];

	// search result type '1' means 
	// http://localhost/t/Sponsorrs/c/channel-profile.php?page=all_sponsorships
	// latest sponsorships
	if ($searchResultType == 2) {
		$currentUser = $_SESSION['currentUser'];
		$total = 20;
		$from = $_POST['from'];
		$from = (int) $from;

		if ($_POST['filter'] == 1) {
			$querySponsorshipDetail = "SELECT id,snippetthumbnailsdefaulturl, owned_by, snippettitle, snippetdescription, statisticssubscriberCount, channel_type, 
												apply_brands.apply_id 
										FROM channel_detail 
										LEFT JOIN apply_brands 
											ON apply_brands.applier_creator_id=channel_detail.owned_by 
										WHERE owned_by 
										IN (
											SELECT applier_creator_id 
											FROM apply_brands 
											WHERE applied_brand_id = '$currentUser'
											AND status = 2
										) 
										ORDER BY statisticssubscriberCount 
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
					$apply_id = $row['apply_id'];
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

					echo '<tr data-pages="' . $from . '" id="' . $owned_by . '">
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
								<button class="btn btn-sm btn-success-soft btn-round mb-0 addRequest deleteSponsorshipButton" onclick="addRequest(this.value,this)" data-sponsorshipapplyid="' . $apply_id . '"  value="#' . $owned_by . '"  title="Accept"><i class="bi bi-plus-circle-fill fs-6"></i></button>
								<button class="btn btn-sm btn-danger-soft btn-round mb-0 deleteRequest deleteSponsorshipButton" onclick="deleteRequest(this.value,this)" data-sponsorshipapplyid="' . $apply_id . '"  value="#' . $owned_by . '"  title="Reject"><i class="bi bi-trash3-fill fs-6"></i></button>
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

if (isset($_POST['actionType']) && $_POST['actionType'] === "deleteApplication" && isset($_POST['applyId'])) {
	include_once("../misc/db.php");
	include_once("../misc/functions.php");

	$application_id = $_POST['applyId'];
	$application_id = trim($application_id, "#");

	deleteRequest($conn, $application_id);
}

// deletes the request of sponsorships
function deleteRequest($conn, $application_id)
{
	$sql = "UPDATE apply_brands SET status=0 WHERE apply_id ='$application_id'";

	if ($conn->query($sql)) {
		$message = new message(200, "success", "Sucessfully deleted" . $sql);
		$message->printMessage();
	} else {
		$message = new message(400, "failed", "Sponsorship not deleted");
		$message->printMessage();
	}
}


if (isset($_POST['actionType']) && $_POST['actionType'] === "addApplication" && isset($_POST['applyId'])) {
	include_once("../misc/db.php");
	include_once("../misc/functions.php");

	$application_id = $_POST['applyId'];

	addRequest($conn, $application_id);
}

// deletes the request of sponsorships
function addRequest($conn, $application_id)
{
	$sql = "UPDATE apply_brands SET status=1 WHERE apply_id ='$application_id'";
	$conn->query($sql);

	if (mysqli_affected_rows($conn) > 0) {
		$message = new message(500, "success", "Sucessfully added" . $sql);
		$message->printMessage();
	} else {
		$message = new message(600, "failed", "Sponsorship not added " . $application_id);
		$message->printMessage();
	}
}
?>