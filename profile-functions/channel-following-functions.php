<?php
session_start();

include_once("../misc/db.php");
include_once("../misc/functions.php");

$currentUser = $_SESSION['currentUser'];

if (isset($_POST['actionType'])) {
	$actionType = $_POST['actionType'];

	if ($_POST['actionType'] == 1) { // unfollow brand
		$brand = (int) $_POST['brandId'];

		$sql = "DELETE FROM brand_following WHERE channel_user_id='$currentUser' AND brand_id='$brand'";

		if ($result = $conn->query($sql)) {
			echo "Successfully unfollow";
		} else {
			echo "Failed to unfollow";
			//$_SESSION['script_error_code'] = "1000";
			//header("Location:../error-404.html");
		}
	}


	// Get the information of the brand who has accepted to partner with the channel.
	if ($actionType == 3) {

		$total = 2;
		$from = $_POST['from'];
		$from = (int) $from;

		$sql = "";
		// $text = substr($_POST['text'], 0, 100);

		if ($_POST['filter'] == 1) { // Filter by name
			$sql = "SELECT company.id_company,company.logo,company.companyname,company.industry,company.country,
			 COUNT(sponsorships.active) AS active_ads from company LEFT JOIN sponsorships on company.id_company = sponsorships.id_company 
			 WHERE company.id_company in (SELECT DISTINCT brand_following.brand_id from brand_following 
			 where brand_following.channel_user_id='$currentUser') and sponsorships.active=1 GROUP BY company.id_company ORDER BY company.companyname 
			 ASC LIMIT $from,$total";

		} elseif ($_POST['filter'] == 2) { // filter by location
			$sql = "SELECT company.id_company,company.logo,company.companyname,company.industry,company.country,
			 COUNT(sponsorships.active) AS active_ads from company LEFT JOIN sponsorships on company.id_company = sponsorships.id_company 
			 WHERE company.id_company in (SELECT DISTINCT brand_following.brand_id from brand_following 
			 where brand_following.channel_user_id='$currentUser') and sponsorships.active=1 GROUP BY company.id_company ORDER BY company.country 
			 ASC LIMIT $from,$total";
		} elseif ($_POST['filter'] == 3) { // filter by industry
			$sql = "SELECT company.id_company,company.logo,company.companyname,company.industry,company.country,
			 COUNT(sponsorships.active) AS active_ads from company LEFT JOIN sponsorships on company.id_company = sponsorships.id_company 
			 WHERE company.id_company in (SELECT DISTINCT brand_following.brand_id from brand_following 
			 where brand_following.channel_user_id='$currentUser') and sponsorships.active=1 GROUP BY company.id_company ORDER BY company.industry 
			 ASC LIMIT $from,$total";
		} elseif ($_POST['filter'] == 4) { // filter by active sponsorships
			$sql = "SELECT company.id_company,company.logo,company.companyname,company.industry,company.country,
			 COUNT(sponsorships.active) AS active_ads from company LEFT JOIN sponsorships on company.id_company = sponsorships.id_company 
			 WHERE company.id_company in (SELECT DISTINCT brand_following.brand_id from brand_following 
			 where brand_following.channel_user_id='$currentUser') and sponsorships.active=1 GROUP BY company.id_company ORDER BY sponsorships.active 
			 ASC LIMIT $from,$total";
		} elseif ($_POST['filter'] == 5) { // filter by company name
			$sql = "SELECT company.id_company,company.logo,company.companyname,company.industry,company.country, COUNT(sponsorships.active) AS active_ads 
			from company LEFT JOIN sponsorships on company.id_company = sponsorships.id_company WHERE company.id_company in (SELECT DISTINCT brand_following.brand_id 
			from brand_following where brand_following.channel_user_id='$currentUser') and sponsorships.active=1 and company.companyname LIKE '%$text%' GROUP BY company.id_company ORDER BY company.companyname";
		}

		if ($result = $conn->query($sql)) {
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {

					$id_company = $row['id_company'];
					$companyname = $row['companyname'];
					$industry = $row['industry'];
					$country = $row['country'];
					$active_ads = $row['active_ads'];
					$logo = $row['logo'];

					echo '<tr id="' . $id_company . '">
							<!-- Table data -->
							<td><a href="">
								<div class="d-flex align-items-center position-relative">
									<!-- Image -->
									<div class="avatar avatar-md mb-2 mb-md-0">
										<img src="' . $logo . '" class="rounded" alt="">
									</div>
									<div class="mb-0 ms-2">
										<!-- Title -->
										<h6 class="mb-0"><a href="#" class="stretched-link">' . $companyname . ' </a></h6>
										<!-- Address -->
										<span class="text-body small"><i
												class="fas fa-fw fa-map-marker-alt me-1 mt-1"></i>' . $country . '</span>
									</div>
								</div></a>
							</td>

							<!-- Table data -->
							<td class="text-center text-sm-start" style="display:none">
								<div class=" overflow-hidden">
									<h6 class="mb-0">85%</h6>
									<div class="progress progress-sm bg-primary bg-opacity-10">
										<div class="progress-bar bg-primary aos" role="progressbar"
											data-aos="slide-right" data-aos-delay="200" data-aos-duration="1000"
											data-aos-easing="ease-in-out" style="width: 85%" aria-valuenow="85"
											aria-valuemin="0" aria-valuemax="100">
										</div>
									</div>
								</div>
							</td>

							<!-- Table data -->
							<td>' . $country . '</td>

							<!-- Table data -->
							<td>' . industryCodeToName($industry) . '</td>

							<!-- Table data -->
							<td> <a href=""><div class="badge bg-success text-success bg-opacity-10"> <b class="fs-6">' . $active_ads . '</b> Sponsorship(s)</div></a></td>

							<!-- Table data -->
							<td>
								<a href="#" class="btn btn-success-soft btn-round me-1 mb-0" data-bs-toggle="tooltip"
									data-bs-placement="top" title="Message"><i class="far fa-envelope"></i></a>
								<button class="btn btn-danger-soft btn-round mb-0" data-bs-toggle="tooltip"
									data-bs-placement="top" title="Unfollow" id="b' . $id_company . '" value="#' . $id_company . '" onclick="unfollowRequest(this.value,' . $id_company . ')"><i class="bi bi-person-dash-fill" ></i></button>
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