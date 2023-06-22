<?php

include_once("../misc/db.php");
include_once("../misc/functions.php");

if (isset($_POST['actionType'])) {
	session_start();

	$currentUser = $_SESSION['currentUser'];

	$actionType = $_POST['actionType'];

	if (isset($_POST['actionType']) && $_POST['actionType'] == 1 && isset($_POST['applyId'])) {
		include_once("../misc/db.php");
		include_once("../misc/functions.php");

		$application_id = $_POST['applyId'];
		$application_id = trim($application_id, "#");

		$sql = "DELETE FROM brand_following WHERE channel_user_id='$application_id' AND brand_id='$currentUser'";

		if ($conn->query($sql) == TRUE) {
			$message = new message(200, "success", "Sucessfully deleted" );
			$message->printMessage();
		} else {
			$message = new message(400, "failed", "Sponsorship not deleted");
			$message->printMessage();
		}
	}


	// Get the information of the brand who has accepted to partner with the channel.
	if ($actionType == 3) {

		$total = 20;
		$from = $_POST['from'];
		$from = (int) $from;

		if (isset($_POST['text'])) {
			$text = substr($_POST['text'], 0, 100);
		}


		if ($_POST['filter'] == 1) { // Filter by name
			$sql = "SELECT id,snippetthumbnailsdefaulturl, owned_by, snippettitle, snippetdescription, statisticssubscriberCount, channel_type 
					FROM channel_detail 
					WHERE owned_by 
					IN ( 
						SELECT channel_user_id 
						FROM `brand_following` 
						WHERE brand_id='$currentUser' 
						) 
						ORDER BY statisticssubscriberCount 
						DESC LIMIT $from,$total";

		}
		// elseif ($_POST['filter'] == 2) { // filter by location
		// 	$sql = "SELECT company.id_company,company.logo,company.companyname,company.industry,company.country,
		// 	 COUNT(sponsorships.active) AS active_ads from company LEFT JOIN sponsorships on company.id_company = sponsorships.id_company 
		// 	 WHERE company.id_company in (SELECT DISTINCT brand_following.brand_id from brand_following 
		// 	 where brand_following.channel_user_id='$currentUser') and sponsorships.active=1 GROUP BY company.id_company ORDER BY company.country 
		// 	 ASC LIMIT $from,$total";
		// } elseif ($_POST['filter'] == 3) { // filter by industry
		// 	$sql = "SELECT company.id_company,company.logo,company.companyname,company.industry,company.country,
		// 	 COUNT(sponsorships.active) AS active_ads from company LEFT JOIN sponsorships on company.id_company = sponsorships.id_company 
		// 	 WHERE company.id_company in (SELECT DISTINCT brand_following.brand_id from brand_following 
		// 	 where brand_following.channel_user_id='$currentUser') and sponsorships.active=1 GROUP BY company.id_company ORDER BY company.industry 
		// 	 ASC LIMIT $from,$total";
		// } elseif ($_POST['filter'] == 4) { // filter by active sponsorships
		// 	$sql = "SELECT company.id_company,company.logo,company.companyname,company.industry,company.country,
		// 	 COUNT(sponsorships.active) AS active_ads from company LEFT JOIN sponsorships on company.id_company = sponsorships.id_company 
		// 	 WHERE company.id_company in (SELECT DISTINCT brand_following.brand_id from brand_following 
		// 	 where brand_following.channel_user_id='$currentUser') and sponsorships.active=1 GROUP BY company.id_company ORDER BY sponsorships.active 
		// 	 ASC LIMIT $from,$total";
		// } elseif ($_POST['filter'] == 5) { // filter by company name
		// 	$sql = "SELECT company.id_company,company.logo,company.companyname,company.industry,company.country, COUNT(sponsorships.active) AS active_ads 
		// 	from company LEFT JOIN sponsorships on company.id_company = sponsorships.id_company WHERE company.id_company in (SELECT DISTINCT brand_following.brand_id 
		// 	from brand_following where brand_following.channel_user_id='$currentUser') and sponsorships.active=1 and company.companyname LIKE '%$text%' GROUP BY company.id_company ORDER BY company.companyname";
		// }

		if ($result = $conn->query($sql)) {
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$owned_by = $row['owned_by'];
					$snippettitle = $row['snippettitle'];
					$snippetdescription = $row['snippetdescription'];
					$id = $row['id'];
					$channel_type = $row['channel_type'];
					$statisticssubscriberCount = $row['statisticssubscriberCount'];
					$snippetthumbnailsdefaulturl = $row['snippetthumbnailsdefaulturl'];
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
								<button class="btn btn-sm btn-danger-soft btn-round mb-0 deleteSponsorshipButton" onclick="deleteRequest(this.value)" data-sponsorship="' . $owned_by . '"  value="#' . $owned_by . '" ><i class="bi bi-person-dash-fill fs-6"></i></button>
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