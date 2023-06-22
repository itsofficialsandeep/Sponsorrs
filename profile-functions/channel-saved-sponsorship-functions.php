<?php
session_start();

include_once("../misc/db.php");
include_once("../misc/functions.php");

$currentUser = $_SESSION['currentUser'];

if (isset($_POST['actionType'])) {
    $actionType = $_POST['actionType'];

    if ($_POST['actionType'] == 1) { // unfollow brand
        $sponsorshipId = (int) $_POST['sponsorshipId'];

        $sql = "DELETE FROM saved_sponsorships WHERE saver_channel_id='$currentUser' AND saved_sponsorship_id='$sponsorshipId'";

        if ($result = $conn->query($sql)) {
            echo "Successfully removed";
        } else {
            echo "Failed to remove";
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
            $sql = "SELECT sponsorships.*, company.companyname, company.logo from sponsorships LEFT JOIN company on company.id_company=sponsorships.id_company
            WHERE sponsorships.sponsorship_id IN (SELECT saved_sponsorships.saved_sponsorship_id from saved_sponsorships
            WHERE saved_sponsorships.saver_channel_id='$currentUser') ORDER BY sponsorships.offer_price ASC LIMIT $from,$total";
        } elseif ($_POST['filter'] == 2) { // filter by location
            $sql = "SELECT sponsorships.*, company.companyname, company.logo from sponsorships LEFT JOIN company on company.id_company=sponsorships.id_company
            WHERE sponsorships.sponsorship_id IN (SELECT saved_sponsorships.saved_sponsorship_id from saved_sponsorships
            WHERE saved_sponsorships.saver_channel_id='$currentUser') ORDER BY sponsorships.adtype ASC LIMIT $from,$total";
        } elseif ($_POST['filter'] == 3) { // filter by industry
            $sql = "SELECT sponsorships.*, company.companyname, company.logo from sponsorships LEFT JOIN company on company.id_company=sponsorships.id_company
            WHERE sponsorships.sponsorship_id IN (SELECT saved_sponsorships.saved_sponsorship_id from saved_sponsorships
            WHERE saved_sponsorships.saver_channel_id='$currentUser') ORDER BY sponsorships.adcategory ASC LIMIT $from,$total";
        } elseif ($_POST['filter'] == 4) { // filter by industry
            $sql = "SELECT sponsorships.*, company.companyname, company.logo from sponsorships LEFT JOIN company on company.id_company=sponsorships.id_company
            WHERE sponsorships.sponsorship_id IN (SELECT saved_sponsorships.saved_sponsorship_id from saved_sponsorships
            WHERE saved_sponsorships.saver_channel_id='$currentUser') ORDER BY sponsorships.posted_on ASC LIMIT $from,$total";
        } elseif ($_POST['filter'] == 5) { // filter by industry
            $sql = "SELECT sponsorships.*, company.companyname, company.logo from sponsorships LEFT JOIN company on company.id_company=sponsorships.id_company
            WHERE sponsorships.sponsorship_id IN (SELECT saved_sponsorships.saved_sponsorship_id from saved_sponsorships
            WHERE saved_sponsorships.saver_channel_id='$currentUser') ORDER BY sponsorships.active ASC LIMIT $from,$total";
        } elseif ($_POST['filter'] == 6) { // filter by active sponsorships
            $sql = "SELECT sponsorships.*, company.companyname, company.logo from sponsorships LEFT JOIN company on company.id_company=sponsorships.id_company
            WHERE sponsorships.sponsorship_id IN (SELECT saved_sponsorships.saved_sponsorship_id from saved_sponsorships
            WHERE saved_sponsorships.saver_channel_id='$currentUser') ORDER BY company.companyname ASC LIMIT $from,$total";
        } elseif ($_POST['filter'] == 7) { // filter by company name
            $sql = "SELECT sponsorships.*, company.companyname, company.logo from sponsorships LEFT JOIN company on company.id_company=sponsorships.id_company
            WHERE sponsorships.sponsorship_id IN (SELECT saved_sponsorships.saved_sponsorship_id from saved_sponsorships
            WHERE saved_sponsorships.saver_channel_id='$currentUser') and (sponsorship_title LIKE '%$text%' OR description Like '%$text%') 
            ORDER BY sponsorship_title ASC LIMIT $from,$total";
        }

        if ($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $id_company = $row['id_company'];
                    $companyname = $row['companyname'];
                    $sponsorship_id = $row['sponsorship_id'];
                    $sponsorship_title = $row['sponsorship_title'];
                    $description = $row['description'];
                    $offer_price = $row['offer_price'];
                    $service = $row['service'];
                    $adtype = $row['adtype'];
                    $adcategory = $row['adcategory'];
                    $posted_on = $row['posted_on'];
                    $active = $row['active'];
                    $brand_logo = $row['logo'];

                    $active = $active == 1 ? '<a href="#" class="btn btn-success-soft btn-round me-1 mb-0" data-bs-toggle="tooltip"
									data-bs-placement="top" title="Apply"><i class=" bi bi-envelope-fill"></i> </a>' : '<a href="" class="btn btn-success-soft btn-round me-1 mb-0" data-bs-toggle="tooltip"
									data-bs-placement="top" title="Sponsorship Expired but you can click to search similar sponsorship"><i class=" bi bi-slash-circle"></i> </a>';
                    $service = $service == 1 ? "Service" : "Product";

                    echo '<tr id="' . $sponsorship_id . '" class="">
							<!-- Table data -->
							<td>
                                    <div class="d-flex align-items-center position-relative">
                                        <!-- Image -->
                                        <div class="avatar avatar-md mb-2 mb-md-0">
                                            <img src="' . $brand_logo . '" class="rounded" alt="">
                                        </div>
                                        <div class="mb-0 ms-2">
                                            <!-- Title -->
                                            <p class="mb-0"><a href="#" class="">' . substr($sponsorship_title, 0, 50) . '..</a></p>
                                            <!-- Address -->
                                            <span class="text-body small">' . substr($description, 0, 50) . '..</span>
                                        </div>
									</div>
							</td>

							<td>
                                    <div class="d-flex align-items-center position-relative">
                                        <div class="mb-0 ms-2">
                                            <!-- Title -->
                                            <p class="mb-0"><a href="#" class=""><i class=" opacity-50 text-warning bi bi-building"></i> ' . substr($companyname, 0, 15) . '..</a></p>
                                            <!-- Address -->
                                            <span class="text-body small"><i class=" opacity-50 text-warning bi bi-currency-rupee"></i>' . $offer_price . '</span>
                                        </div>
									</div>
							</td>
							<td>
                                    <div class="d-flex align-items-center position-relative">
                                        <div class="mb-0 ms-2">
                                            <!-- Title -->
                                            <p class="mb-0"><a href="#" class=""><i class=" opacity-50 text-warning bi bi-briefcase me-1 mt-1"></i>' . $service . '</a></p>
                                            <!-- Address -->
                                            <span class="text-body small"><a href="#" class=""><i class=" opacity-50 text-warning bi bi-badge-ad"></i> ' . substr(adtypeNumToString($adtype), 0, 15) . '..</a></span>
                                        </div>
									</div>
							</td>                                                        

							<td>
                                    <div class="d-flex align-items-center position-relative">
                                        <div class="mb-0 ms-2">
                                            <!-- Title -->
                                            <p class="mb-0"><a href="#" class=""><i class=" opacity-50 text-warning bi bi-tag me-1 mt-1"></i>' . substr(adcategoryNumToString($adcategory), 0, 15) . '..</a></p>
                                            <!-- Address -->
                                            <span class="text-body small"><a href="#" class=""><i class=" opacity-50 text-warning bi bi-calendar-date"></i> ' . substr(adtypeNumToString($posted_on), 0, 15) . '..</a></span>
                                        </div>
									</div>
							</td>   

							<!-- Table data -->
							<td>' . $active . '
								<button class="btn btn-danger-soft btn-round mb-0" data-bs-toggle="tooltip"
									data-bs-placement="top" title="Unsave it" id="b' . $sponsorship_id . '" value="#' . $sponsorship_id . '" onclick="removeRequest(this.value,' . $sponsorship_id . ')"><i class=" bi bi-trash-fill" ></i></button>
							</td>
						</tr>';
                }
            } else {
                echo '0';
                //echo '<tr><td colspan="8" class="text-center text-danger fs-6"><i class="bi bi-exclamation-triangle"></i> No Brand Found!</td></tr>';
            }
        } else {
            echo "something went wrong";
            $_SESSION['script_error_code'] = "1001";
            //header("Location:../error-404.html");
        }
    }
}

?>