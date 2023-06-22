<?php
session_start();

include_once("../misc/db.php");
include_once("../misc/functions.php");

if (isset($_POST['actionType'])) {
    $actionType = $_POST['actionType'];

    // Get the information of the brand who has accepted to partner with the channel.
    if ($actionType == 2) {

        $currentUser = $_SESSION['currentUser'];
        $total = 20;
        $from = $_POST['from'];
        $from = (int) $from;

        $queryClientsDetail = "";

        if ($_POST['filter'] == 1) {
            $queryClientsDetail = "SELECT DISTINCT apply_sponsorships.id_company, company.companyname, company.country, company.industry, company.logo, 
                                    company.website FROM apply_sponsorships LEFT JOIN company ON apply_sponsorships.id_company = company.id_company 
                                    WHERE apply_sponsorships.id_user='$currentUser' AND apply_sponsorships.status=1 ORDER BY company.companyname ASC LIMIT $from,$total";

        } elseif ($_POST['filter'] == 2) {
            $queryClientsDetail = "SELECT DISTINCT apply_sponsorships.id_company, company.companyname, company.country, company.industry, company.logo, 
                                    company.website FROM apply_sponsorships LEFT JOIN company ON apply_sponsorships.id_company = company.id_company 
                                    WHERE apply_sponsorships.id_user='$currentUser' AND apply_sponsorships.status=1 ORDER BY company.industry ASC LIMIT $from,$total";
        } elseif ($_POST['filter'] == 3) {
            $queryClientsDetail = "SELECT DISTINCT apply_sponsorships.id_company, company.companyname, company.country, company.industry, company.logo, 
                                    company.website FROM apply_sponsorships LEFT JOIN company ON apply_sponsorships.id_company = company.id_company 
                                    WHERE apply_sponsorships.id_user='$currentUser' AND apply_sponsorships.status=1 ORDER BY company.country ASC LIMIT $from,$total";
        }

        if ($result = $conn->query($queryClientsDetail)) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $id_company = $row['id_company'];
                    $companyname = $row['companyname'];
                    $country = $row['country'];
                    $industry = $row['industry'];
                    $logo = $row['logo'];
                    $website = $row['website'];

                    echo '<tr id="' . $id_company . '">
							<!-- Course item -->
							<td>
								<div class="d-flex align-items-center">
									<!-- Image -->
									<div class="w-60px">
										<img src="' . $logo . '" class="rounded" alt="">
									</div>
									<div class="mb-0 ms-2">
										<!-- Title -->
										<h6><a href="#">' . $companyname . '</a></h6>
										<!-- Info -->
										<div class="d-sm-flex">
											<a href="' . $id_company . '"<p class="h6 fw-light mb-0 small me-3"><i class="fas fa-building text-orange me-2"></i>' . $industry . '</p></a>
											
										</div>
									</div>
								</div>
							</td>
							<!-- Enrolled item -->
							<td class="text-center text-sm-start">' . $country . '</td>
							<!-- Status item -->
							<td>
								<div class="badge bg-success text-success bg-opacity-10">' . industryCodeToName(0) . '</div>
							</td>
							<!-- Action item -->
							<td>
								<div class="badge bg-success text-success bg-opacity-10"><a href="' . $website . '">' . substr($website, 0, 20) . '</a></div>
							</td>
							<td>
								<button class="btn btn-sm btn-danger-soft btn-round mb-0 deleteSponsorshipButton" onclick="deleteRequesttt(this.value,' . $id_company . ')" value="#' . $id_company . '" ><i class="fas fa-fw fa-envelope"></i></button>
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