<?php

include_once("../misc/db.php");
include_once("../misc/functions.php");
$actionType = $conn->real_escape_string(substr($_POST['actionType'], 0, 1));

if (1) { //abp validate token here

    $query = $conn->real_escape_string(substr($_POST['query'], 0, 100));
    $industry = (int) $conn->real_escape_string(substr($_POST['industry'], 0, 1));
    $type = (int) $conn->real_escape_string(substr($_POST['type'], 0, 1));
    $category = (int) $conn->real_escape_string(substr($_POST['category'], 0, 1));
    $country = $conn->real_escape_string(substr($_POST['country'], 0, 40));
    $subscriber = (int) $conn->real_escape_string(substr($_POST['subscriber'], 0, 1));

    $currentUser = $_SESSION['currentUser'];

    // for Brands
    if ($actionType == 1) {
        $from = $conn->real_escape_string(substr($_POST['searchResultStartIndexForBrand'], 0, 3));

        if (!$currentUser) {
            $query = $conn->prepare("SELECT company.*, 
                    IF( id_company IN (SELECT DISTINCT saved_brand_id FROM `saved_brand_profiles` where saver_channel_id=NULL),1,0) 
                    AS saved from company WHERE active=1 and (industry=? or id_company in (SELECT id_company FROM `sponsorships` 
                    where adtype=? or adcategory=?) or country=? 
                    or MATCH(company.name,company.companyname,company.country,company.state,company.city,company.contactno,company.website,company.email,company.aboutme) AGAINST('$query')) 
                    ORDER BY registered_on LIMIT ?,20");

            $query->bind_param('iiisi', $industry, $type, $category, $country, $from);
        } else {
            $query = $conn->prepare("SELECT company.*, 
                    IF( id_company IN (SELECT DISTINCT saved_brand_id FROM `saved_brand_profiles` where saver_channel_id=?),1,0) 
                    AS saved from company WHERE active=1 and (industry=? or id_company in (SELECT id_company FROM `sponsorships` 
                    where adtype=? or adcategory=?) or country=? 
                    or MATCH(company.name,company.companyname,company.country,company.state,company.city,company.contactno,company.website,company.email,company.aboutme) AGAINST('$query')) 
                    ORDER BY registered_on LIMIT ?,20");

            $query->bind_param('siiisi', $currentUser, $industry, $type, $category, $country, $from);
        }


        $query->execute();
        $result = $query->get_result();
        if ($result->num_rows > 0) {

            $showSaveButton = isset($_SESSION['currentUser']) ? "d-block" : "d-none";

            while ($row = $result->fetch_assoc()) {

                // prepare token for scurity check
                $token = $row['id_company'] . "|" . hash("sha512", tokenSecret($conn, $_SESSION['currentUser']) . $_SESSION['currentUser']);

                // if the channel is already saved then show different icon
                $savedOrUnsaved = $row['saved'] == 1 ? 'class="saveCompany bi bi-bookmark-fill text-primary"' : 'class="saveCompany bi bi-bookmark text-primary"';

                echo '	<div class="col-3" >
                            <div class="card action-trigger-hover border bg-transparent"
                                style="1px 1px 3px #efefef">
                                <!-- Image -->
                                <div><img src="assets/images/courses/4by3/gradient3.png" class="card-img-top"
                                        alt="course image"></div>
                                <!-- Card body -->
                                <div class="card-body pb-0" style="margin-top:-59px">

                                    <!-- Badge and favorite -->
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="s">
                                            <img class="rounded-1" height="52px"
                                                src="' . $row['logo'] . '"
                                                alt="avatar">
                                        </div>
                                        <span class="hstack gap-2 mt-3 d-flex align-items-start">

                                            <a href="search.php?searchtype=sponsorships&amp;adcategory=0"
                                                class="badge text-bg-dark">' . substr(industryCodeToName($row['industry']), 0, 15) . '</a>
                                        </span>
                                        <div class="h6 fw-light mt-3 d-block d-flex align-items-start"><i ' . $savedOrUnsaved . ' data-action="saveBrands" id="a3' . $row['id_company'] . '"
                                                data-token="' . $token . '" data-id="#a0"></i></div>
                                    </div>
                                    <!-- Title -->
                                    <h5 class="card-title"><a href="#">' . substr($row['companyname'], 0, 15) . '</a></h5>
                                    <span class="small">' . substr($row['aboutme'], 0, 75) . '..</span>
                                    <!-- Time -->
                                    <div class="hstack gap-3 mt-2">
                                        <small class="h6 fw-light mb-0"><i
                                                class="bi bi-calendar-date text-danger me-2"></i>' . date("M jS", strtotime($row['registered_on'])) . '</small> ∙
                                        <a href="b/brand-detail.php?id=' . $row['id_company'] . '"
                                            class="btn btn-sm btn-primary-soft"><i
                                                class="bi bi-layout-text-window-reverse me-2"></i>Contact</a>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }
        } else {
            echo '<div class="col-sm-6 col-lg-4 col-xl-3 tns-item tns-slide-active " id="tns5-item0"><a href="" >
                    <div class="card shadow h-100  d-flex justify-content-center">
                        <div class="pb-0 bg-opacity-50 d-flex justify-content-center">
                            <img style="height:60px" src="assets/images/flaticon/no-results.png">
                        </div>
                        <h6 class="d-flex justify-content-center mt-3">No results found</h6>
                    </div>
                </a></div>';
        }

        // for sponsorship
    } elseif ($actionType == 2) {
        $from = $conn->real_escape_string(substr($_POST['searchResultStartIndexForSponsorship'], 0, 3));

        if (!$currentUser) {
            $query = $conn->prepare("SELECT sponsorships.*, IF(sponsorships.sponsorship_id IN (SELECT saved_sponsorship_id 
                    from saved_sponsorships where saver_channel_id=? ),1,0) as saved, 
                    IF (sponsorships.sponsorship_id IN (SELECT id_sponsorship FROM `apply_sponsorships` 
                    WHERE id_user=?), 1, 0) as applied, companyname, logo from sponsorships LEFT JOIN company 
                    ON sponsorships.id_company=company.id_company WHERE adcategory=? and sponsorships.active=1 
                    and ( sponsorships.id_company in (SELECT company.id_company WHERE company.industry=? or company.country=?) 
                    or adtype=? or adcategory=?) ORDER BY offer_price limit ?,20");

            $query->bind_param('ssiisiii', $currentUser, $currentUser, $category, $industry, $country, $type, $category, $from);
        } else {
            $query = $conn->prepare("SELECT sponsorships.*, IF(sponsorships.sponsorship_id IN (SELECT saved_sponsorship_id 
                    from saved_sponsorships where saver_channel_id=? ),1,0) as saved, 
                    IF (sponsorships.sponsorship_id IN (SELECT id_sponsorship FROM `apply_sponsorships` 
                    WHERE id_user=?), 1, 0) as applied, companyname, logo from sponsorships LEFT JOIN company 
                    ON sponsorships.id_company=company.id_company WHERE adcategory=? and sponsorships.active=1 
                    and ( sponsorships.id_company in (SELECT company.id_company WHERE company.industry=? or company.country=?) 
                    or adtype=? or adcategory=?) OR MATCH(sponsorship_title,description,offer_price) AGAINST( ? IN NATURAL LANGUAGE MODE) ORDER BY offer_price limit ?,20");

            $query->bind_param('ssiisiisi', $currentUser, $currentUser, $category, $industry, $country, $type, $category, $keyword, $from);
        }

        $query->execute();
        $result = $query->get_result();
        if ($result->num_rows > 0) {

            $showSaveButton = !$currentChannel ? "d-block" : "d-none";

            while ($row = $result->fetch_assoc()) {

                // prepare token for scurity check
                $token = $row['id_company'] . "|" . $row['subcreation_id'] . "|" . $row['sponsorship_id'] . "|" . hash("sha512", tokenSecret($conn, $_SESSION['currentUser']) . $_SESSION['currentUser']);

                // if the channel is already saved then show different icon
                $savedOrUnsaved = $row['saved'] == 1 ? 'class="save_sponsorships bi bi-bookmark-fill text-primary"' : 'class="save_sponsorships bi bi-bookmark text-primary"';


                if ($row['applied'] == 0) {
                    $showApplied = '        <div class="d-flex flex-column">
												<button  class="apply_sponsorships btn btn-sm btn-primary-soft" id="b' . $row['sponsorship_id'] . '" data-action="applySponsorships" data-token="' . $token . '" data-id="#b' . $row['sponsorship_id'] . '"><i class="fas fa-paper-plane me-2"></i>Apply</button>
											</div>';
                } else {
                    $showApplied = '        <div class="d-flex flex-column">
												<div class="btn btn-sm btn-danger-soft item-show"><i class="fas fa-paper-plane me-2"></i>Applied</div>
                                                <a href="c/channel-dashboard.php?page=all-sponsorships" class="btn btn-sm btn-danger-soft item-show-hover"><i class="bi bi-layout-text-window-reverse me-2"></i>Manage</a>
											</div>';
                }

                echo '	<div>
								<div class="card action-trigger-hover border bg-transparent"
									style="1px 1px 3px #efefef">
									<!-- Image -->
									<div><img src="assets/images/courses/4by3/gradient.png" class="card-img-top"
											alt="course image"></div>
									<!-- Ribbon -->
									<div class="ribbon mt-3 d-none"><span>Free</span></div>
									<!-- Card body -->
									<div class="card-body pb-0" style="margin-top:-78px">
										<h5 class="card-title"><a href="#">' . substr($row['companyname'], 0, 60) . '</a></h5>
										<!-- Badge and favorite -->
										<div class="d-flex justify-content-between mb-3">
											<span class="hstack gap-2">
												<a href="search.php?searchtype=sponsorships&adcategory=' . $row['adcategory'] . '" class="badge bg-primary bg-opacity-25 ">' . substr(adserviceNumToString($row['service']), 0, 15) . '</a>
												<a href="search.php?searchtype=sponsorships&adcategory=' . $row['adcategory'] . '" class="badge text-bg-dark">' . substr(adcategoryNumToString($row['adcategory']), 0, 15) . '</a>
											</span>
											<div class="h6 fw-light mb-0 ' . $showSaveButton . '"><i ' . $savedOrUnsaved . ' id="a' . $row['sponsorship_id'] . '" data-action="saveSponsorships" data-token="' . $token . '" data-id="#a' . $row['sponsorship_id'] . '"></i></div>
										</div>
										<!-- Title -->
										<h6 class="card-title"><a href="#">' . substr($row['sponsorship_title'], 0, 50) . '</a></h6>
										<span class="small">' . substr($row['description'], 0, 70) . '..</span>
										<!-- Time -->
										<div class="hstack gap-3 mt-2">
											<small class="h6 fw-light mb-0"><i class="bi bi-calendar-date text-danger me-2"></i>' . date("M jS", strtotime($row['posted_on'])) . '</small> ∙
											<a href="search.php?searchtype=sponsorships&adtype=' . $row['adtype'] . '" class="badge bg-success bg-opacity-10 text-success"><b>Ad:</b>
												' . substr(adtypeNumToString($row['adtype']), 0, 15) . '</a>
										</div>
									</div>
									<!-- Card footer -->
									<div class="card-footer pt-0 bg-transparent">
										<hr style="margin:5px 0px 10px 0px">
										<!-- Avatar and Price -->
										<div class="d-flex justify-content-between align-items-center mt-1">
											<!-- Avatar -->
											<div class="d-flex align-items-center">
												<div class="avatar avatar-sm">
													<img class="avatar-img rounded-1" height="40px"
														src="' . $row['logo'] . '" alt="avatar">
												</div>
                                                <div>
                                                    <h6 class="text-primary mb-0 ms-3">Rs ' . customNumberFormat($row['offer_price'], 3) . '</h6>
                                                    <span class="small ms-3 d-none">
                                                    ' . date("M jS", strtotime($row['posted_on'])) . '
                                                    </span>
                                                </div>
											</div>
                                            ' . $showApplied . '

										</div>
									</div>
								</div>
							</div>';
            }
        } else {
            echo '<div class="col-sm-6 col-lg-4 col-xl-3 tns-item tns-slide-active " id="tns5-item0"><a href="" >
                    <div class="card shadow h-100  d-flex justify-content-center">
                        <div class="pb-0 bg-opacity-50 d-flex justify-content-center">
                            <img style="height:60px" src="assets/images/flaticon/no-results.png">
                        </div>
                        <h6 class="d-flex justify-content-center mt-3">No results found</h6>
                    </div>
                </a></div>';
        }

        // for Creators
    } elseif ($actionType == 3) {
        $from = $conn->real_escape_string(substr($_POST['searchResultStartIndexForCreator'], 0, 3));

        if ($subscriber = 2) {
            $order = "ASC";
        } else {
            $order = "DESC";
        }

        if (!$currentUser) {
            $query = $conn->prepare("SELECT DISTINCT `id`, channel_detail.`sr_no`, `snippettitle`, `snippetdescription`, `snippetcustomUrl`, 
                        `snippetthumbnailsdefaulturl`, `statisticssubscriberCount`, `channel_type`, `owned_by` , primary_ac.token_secret, 
                        IF(id IN (SELECT DISTINCT saved_channel_id FROM saved_channel_profiles WHERE saver_brand_id = NULL),1,0) 
                        as saved FROM `channel_detail` LEFT JOIN primary_ac on primary_ac.ac_id =channel_detail.owned_by 
                        WHERE channel_type=? or owned_by IN ( SELECT primary_ac_id from users WHERE channel_category=? or sponsor_type=?) 
                        ORDER BY statisticssubscriberCount DESC LIMIT ?,20");

            $query->bind_param('iiiii', $type, $category, $category, $type, $from);

        } else {
            // $query = $conn->prepare("SELECT DISTINCT `id`, channel_detail.`sr_no`, `snippettitle`, `snippetdescription`, `snippetcustomUrl`, 
            //             `snippetthumbnailsdefaulturl`, `statisticssubscriberCount`, `channel_type`, `owned_by` , primary_ac.token_secret, 
            //             IF(id IN (SELECT DISTINCT saved_channel_id FROM saved_channel_profiles WHERE saver_brand_id = ?),1,0) 
            //             as saved FROM `channel_detail` LEFT JOIN primary_ac on primary_ac.ac_id =channel_detail.owned_by 
            //             WHERE (channel_type=? and owned_by IN ( SELECT primary_ac_id from users WHERE channel_category=? and sponsor_type=? and country=?))
            //             or MATCH(snippettitle,snippetdescription,snippetcustomUrl,snippetcountry) AGAINST (? IN NATURAL LANGUAGE MODE)
            //             ORDER BY statisticssubscriberCount DESC LIMIT ?,20");

            //$query->bind_param('siiissi', $currentUser, $category, $category, $type, $country, $keyword, $from);

            $query = $conn->prepare("SELECT DISTINCT `id`, channel_detail.`sr_no`, `snippettitle`, `snippetdescription`, `snippetcustomUrl`,
                     `snippetthumbnailsdefaulturl`, `statisticssubscriberCount`, `channel_type`, `owned_by` , primary_ac.token_secret,
                     IF(id IN (SELECT DISTINCT saved_channel_id FROM saved_channel_profiles WHERE saver_brand_id = ?),1,0) AS saved 
                     FROM `channel_detail` LEFT JOIN primary_ac on primary_ac.ac_id =channel_detail.owned_by 
                     WHERE ((channel_type=? OR ? IS NULL) and owned_by IN ( SELECT primary_ac_id from users 
                     WHERE (channel_category=? OR ? IS NULL) and (sponsor_type=? OR ? IS NULL) and (country=? OR ? IS NULL))) 
                     OR MATCH(snippettitle,snippetdescription,snippetcustomUrl,snippetcountry) AGAINST (? IN NATURAL LANGUAGE MODE) 
                     ORDER BY statisticssubscriberCount $order LIMIT ?,20");

            $query->bind_param('siiiiiisssi', $currentUser, $category, $category, $category, $category, $type, $type, $country, $country, $keyword, $from);
        }

        $query->execute();
        $result = $query->get_result();
        if ($result->num_rows > 0) {

            session_status();

            $showSaveButton = isset($_SESSION['currentUser']) ? "d-block" : "d-none";

            while ($row = $result->fetch_assoc()) {

                // show dot at end if title > 14 characters
                $dot = strlen($row['snippettitle']) > 14 ? "..." : "";

                // prepare token for scurity check
                $token = $row['id'] . "|" . hash("sha512", $row['token_secret'] . $_SESSION['currentUser']);

                // if the channel is already saved then show different icon
                $savedOrUnsaved = $row['saved'] == 1 ? 'class="save bi bi-bookmark-fill text-primary"' : 'class="save bi bi-bookmark text-primary"';

                echo '<div class="col-sm-6 col-lg-4 col-xl-3">
								<div class="card shadow h-100" style="position:relative;">
                                    <div class="card-body pb-0 bg-opacity-50 bg-blur d-flex justify-content-between align-items-start">
                                        <img class="rounded" height="60px" src="' . str_ireplace('88', '60', $row['snippetthumbnailsdefaulturl']) . '">
                                        <div class="ml-2 flex-fill" style="margin-left:5px">
                                            <div class="d-flex justify-content-between mb-2">
                                                <a href="search.php?searchtype=creators&category=' . $row['channel_type'] . '" class="badge bg-purple bg-opacity-10 text-purple">' . substr(adcategoryNumToString($row['channel_type']), 0, 13) . '..</a>
                                                <div class="' . $showSaveButton . '"  class="h6 mb-0"><i ' . $savedOrUnsaved . ' id="' . $row['id'] . '" data-action="saveCreators" data-token="' . $token . '" data-id="#' . $row['id'] . '"></i></div>
                                            </div>                                        
                                            <h6 class="card-title fw-normal"><a href="creator-detail.php?creator=' . $row['owned_by'] . '">' . substr($row['snippettitle'], 0, 14) . $dot . '</a></h6>
                                        </div>
                                    </div>
									<div class="card-body pb-0">
										<small class="mb-2 text-truncate-2">' . substr($row['snippetdescription'], 0, 49) . '..</small>
									</div>
									<!-- Card footer -->
									<div class="card-footer pt-0 pb-2">
										<hr style="margin:0px 0px 5px 0px">
										<div class="d-flex justify-content-between">
											<span class="h6 fw-light mb-0"><a class="text-primary" href="' . $row['snippetcustomUrl'] . ' " class="mb-2 text-truncate-2">' . substr($row['snippetcustomUrl'], 0, 14) . '</a></span>
											<span class="h6 fw-light mb-0"><i
													class="fas fa-users text-info me-2"></i>' . customNumberFormat($row['statisticssubscriberCount'], 1) . '+</span>
										</div>
									</div>
								</div>
							</div>';
            }
        } else {
            echo '<div class="col-sm-6 col-lg-4 col-xl-3 tns-item tns-slide-active " id="tns5-item0"><a href="" >
                    <div class="card shadow h-100  d-flex justify-content-center">
                        <div class="pb-0 bg-opacity-50 d-flex justify-content-center">
                            <img style="height:60px" src="assets/images/flaticon/no-results.png">
                        </div>
                        <h6 class="d-flex justify-content-center mt-3">No results found</h6>
                    </div>
                </a></div>';
        }
    }

}
?>