<?php

include_once("config.php");

function fetchChannel($channelID)
{
    //https://youtube.googleapis.com/youtube/v3/channels?part=snippet&id=UC0T6MVd3wQDB5ICAe45OxaQ&key=[YOUR_API_KEY]
    // https://www.googleapis.com/youtube/v3/search?&part=snippet&key=AIzaSyB78E8AD89lKhEEBYKZeyQbzRASL2Tkxts&q=tech%20channels&type=channel
    // https://www.googleapis.com/youtube/v3/channels?id=UC0T6MVd3wQDB5ICAe45OxaQ&part=snippet,contentDetails,statistics,status,topicDetails&key=AIzaSyB78E8AD89lKhEEBYKZeyQbzRASL2Tkxts
}
function adcategoryNumToString($adcatgory)
{
    $adcatgory = (int) $adcatgory;

    switch ($adcatgory) {
        case 0:
            return $adcatgory = "Technical";
        case 1:
            return $adcatgory = "Commercial"; // from 2086   ==> https://www.googleapis.com/youtube/v3/search?&part=snippet&key=AIzaSyB78E8AD89lKhEEBYKZeyQbzRASL2Tkxts&q=business%20channel&type=channel&maxResults=50&pageToken=CMIDEAA
        case 2:
            return $adcatgory = "Vlogger"; // from 3186 to 3485 ==> https://www.googleapis.com/youtube/v3/search?&part=snippet&key=AIzaSyB78E8AD89lKhEEBYKZeyQbzRASL2Tkxts&q=vloggers%20channels&type=channel&maxResults=50&pageToken=CKwCEAA
        case 3:
            return $adcatgory = "Educator"; // from 1094- IAS education
        case 4:
            return $adcatgory = "Photography & Videography";
        case 5:
            return $adcatgory = "Gaming"; // from 3486 to 3885 ==> https://www.googleapis.com/youtube/v3/search?&part=snippet&key=AIzaSyB78E8AD89lKhEEBYKZeyQbzRASL2Tkxts&q=gaming%20channels&type=channel&maxResults=50&pageToken=CJADEAA
        case 6:
            return $adcatgory = "Fitnes"; // from 1094 
        case 7:
            return $adcatgory = "News";
        // news channels --- from 3886 to 3985 ==> https://www.googleapis.com/youtube/v3/search?&part=snippet&key=AIzaSyB78E8AD89lKhEEBYKZeyQbzRASL2Tkxts&q=news%20channels&type=channel&maxResults=50&pageToken=CGQQAA
        case 8:
            return $adcatgory = "Comedy Shows";
        case 9:
            return $adcatgory = "Makeup";
        case 10:
            return $adcatgory = "Experiment";
        case 11:
            return $adcatgory = "Toy Reviews";
        case 12:
            return $adcatgory = "Food"; // from 2536 to 2885 ---- next search ==> https://www.googleapis.com/youtube/v3/search?&part=snippet&key=AIzaSyB78E8AD89lKhEEBYKZeyQbzRASL2Tkxts&q=food%20channel&type=channel&maxResults=50&pageToken=CN4CEAA
        case 13;
            return $adcatgory = "Clothe"; // from 2886 to 3185 ------- next search ==> https://www.googleapis.com/youtube/v3/search?&part=snippet&key=AIzaSyB78E8AD89lKhEEBYKZeyQbzRASL2Tkxts&q=clothe%20channel&type=channel&maxResults=50&pageToken=CKwCEAA
    }

    //return $adcatgory;
}

function adtypeNumToString($adtype)
{
    $adtype = (int) $adtype;
    $adtypeInString = "";

    switch ($adtype) {
        case 1:
            $adtypeInString = "Type 1";
            break;
        case 2:
            $adtypeInString = "Type 2";
            break;
        case 3:
            $adtypeInString = "Type 3";
            break;
        case 4:
            $adtypeInString = "Type 4";
            break;
        case 5:
            $adtypeInString = "Type 5";
            break;
        case 6:
            $adtypeInString = "Type 6";
            break;
    }

    return $adtypeInString;
}

function adserviceNumToString($service)
{
    if ($service == 1) {
        $service = "product";
    } else if ($service = 2) {
        $service = "service";
    }

    return $service;
}

function suggestionYoutubeCreator($conn, $channelCategory, $carouselHeading)
{

    if ($channelCategory == "any") {
        $sql = "SELECT DISTINCT `id`, `sr_no`, `sr_from_pre_table`, `snippettitle`, `snippetdescription`, `snippetcustomUrl`, `snippetpublishedAt`, `snippetthumbnailsdefaulturl`, `snippetcountry`, `contentDetailsrelatedPlaylistslikes`, `contentDetailsrelatedPlaylistsuploads`, `statisticsviewCount`, `statisticssubscriberCount`, `statisticshiddenSubscriberCount`, `statisticsvideoCount`, `statusprivacyStatus`, `statusisLinked`, `statuslongUploadsStatus`, `statusmadeForKids`, `channel_type`,  `searchable_text` FROM `channel_detail` ORDER BY statisticssubscriberCount DESC LIMIT 20";
    } else {
        $channelCategory = (int) $channelCategory;
        $sql = "SELECT DISTINCT `id`, `sr_no`, `sr_from_pre_table`, `snippettitle`, `snippetdescription`, `snippetcustomUrl`, `snippetpublishedAt`, `snippetthumbnailsdefaulturl`, `snippetcountry`, `contentDetailsrelatedPlaylistslikes`, `contentDetailsrelatedPlaylistsuploads`, `statisticsviewCount`, `statisticssubscriberCount`, `statisticshiddenSubscriberCount`, `statisticsvideoCount`, `statusprivacyStatus`, `statusisLinked`, `statuslongUploadsStatus`, `statusmadeForKids`, `channel_type`,  `searchable_text` FROM `channel_detail` WHERE channel_type=$channelCategory ORDER BY statisticssubscriberCount DESC LIMIT 20";
    }

    //echo $sql;
    //$sql = "SELECT * FROM channel_detail ORDER BY statisticssubscriberCount DESC LIMIT 20";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $active = 1;

        $randomForId = rand(5, 1000);

        echo '<div class="search-by">
        <h1>' . $carouselHeading . '</h1>
        <a href="" style="display: none;">All category <img style="width: 20px; margin-left: 20px;" src="/img/icon/arrow-right-icon.svg" alt=""></a>
         
        <!--Start carousel-->
          <div id="carouselExampleIndicators' . $randomForId . '" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
            <div class="carousel-inner text-center">';

        while ($row = $result->fetch_assoc()) {
            if ($active == 1) {
                echo '<div class="carousel-item active" style="padding-left:30px;">';
            } else if ($active == 6 || $active == 11 || $active == 16) {
                echo '<div class="carousel-item" style="padding-left:30px;">';
            }
            echo '<div class="card" style="width: 14rem; float: left;margin-left:10px;">
                        <img class="card-img-top" src="' . str_ireplace('88', '240', $row['snippetthumbnailsdefaulturl']) . '" width="88px" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">' . substr($row['snippettitle'], 0, 14) . '..</h5>
                            <h7 class="card-subtitle mb-2 text-dark"><small>' . adcategoryNumToString($row['channel_type']) . ' ∙ 
                            </small><a href="https:/www.youtube.com/' . $row['snippetcustomUrl'] . '" class="">' . substr($row['snippetcustomUrl'], 0, 14) . '</a></h7>                   
                            <p class="card-text mb-1 text-secondary"><small>' . substr($row['snippetdescription'], 0, 40) . '..</small></p>     
                            <p class="card-text mt-1 mb-1 text-dark">' . customNumberFormat($row['statisticssubscriberCount'], 1) . ' Subscriber</p>     
                            <a href="#" class="btn btn-success">Contact the Creator</a>
                        </div>
                     </div>';
            if ($active == 5 || $active == 10 || $active == 15 || $active == 20) {
                echo '</div>';
            }

            echo "<!--" . $active++ . "-->";
        }

        echo '    </div>
        <div class="carousel-nav">
          <a class="nav-item" role="button" data-bs-target="#carouselExampleIndicators' . $randomForId . '" data-bs-slide="prev"><img src="img/icon/prew-arrow.svg" alt=""></a>
          <a class="nav-item" role="button" data-bs-target="#carouselExampleIndicators' . $randomForId . '" data-bs-slide="next"><img src="img/icon/next-arrow.svg" alt=""></a>
        </div>
      </div>
    </div>';
    }
}


class suggest
{

    function suggestYoutubeCreator($conn, $channelCategory, $limit, $brandID)
    {

        if ($channelCategory == "any") {
            $sql = "SELECT DISTINCT `id`, `sr_no`, `sr_from_pre_table`, `snippettitle`, `snippetdescription`, `snippetcustomUrl`, `snippetpublishedAt`, `snippetthumbnailsdefaulturl`, `snippetcountry`, `contentDetailsrelatedPlaylistslikes`, `contentDetailsrelatedPlaylistsuploads`, `statisticsviewCount`, `statisticssubscriberCount`, `statisticshiddenSubscriberCount`, `statisticsvideoCount`, `statusprivacyStatus`, `statusisLinked`, `statuslongUploadsStatus`, `statusmadeForKids`, `channel_type`, `searchable_text` FROM `channel_detail` ORDER BY statisticssubscriberCount DESC LIMIT $limit";
        } else {
            $channelCategory = (int) $channelCategory;
            //$sql = "SELECT DISTINCT `id`, channel_detail.`sr_no`, `snippettitle`, `snippetdescription`, `snippetcustomUrl`, `snippetthumbnailsdefaulturl`, `statisticssubscriberCount`, `channel_type`, `owned_by` , primary_ac.token_secret, IF(id IN (SELECT DISTINCT saved_channel_id FROM saved_channel_profiles WHERE saver_brand_id = '$brandID'),1,0) as saved FROM `channel_detail` LEFT JOIN primary_ac on primary_ac.ac_id =channel_detail.owned_by WHERE channel_type=$channelCategory ORDER BY statisticssubscriberCount DESC LIMIT $limit";
            $sql = "SELECT DISTINCT 
                            `id`, channel_detail.`sr_no`, 
                            `snippettitle`, `snippetdescription`, 
                            `snippetcustomUrl`, `snippetthumbnailsdefaulturl`, 
                            `statisticssubscriberCount`, `channel_type`, `owned_by` 
                            , primary_ac.token_secret, sub_creation.sub_creation_id, 
                            IF(
                                channel_detail.owned_by IN (
                                    SELECT DISTINCT saved_channel_id 
                                    FROM saved_channel_profiles 
                                    WHERE saver_brand_id = '$brandID'
                                ),1,0
                            ) AS saved, 
                            IF( 
                                channel_detail.owned_by IN (
                                    SELECT applied_creator_id 
                                    FROM apply_creators 
                                    WHERE applier_brand_id='$brandID' 
                                        AND applied_subcreation_id=sub_creation.sub_creation_id 
                                        AND applied_creator_id=owned_by
                                    ),1,0
                            ) as applied 
                    FROM `channel_detail` 
                    LEFT JOIN primary_ac ON primary_ac.ac_id =channel_detail.owned_by 
                    LEFT JOIN sub_creation ON sub_creation.primary_ac = channel_detail.owned_by 
                    WHERE channel_type=$channelCategory # AND sub_creation.sub_creation_type=0 
                    ORDER BY statisticssubscriberCount DESC";
        }

        //echo $sql;
        //$sql = "SELECT * FROM channel_detail ORDER BY statisticssubscriberCount DESC LIMIT 20";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            session_status();

            $showSaveButton = isset($_SESSION['currentUser']) ? "d-block" : "d-none";

            while ($row = $result->fetch_assoc()) {

                // show dot at end if title > 14 characters
                $dot = strlen($row['snippettitle']) > 14 ? "..." : "";

                // prepare token for scurity check
                $token = $row['owned_by'] . "|" . $row['sub_creation_id'] . '|' . hash("sha512", $row['token_secret'] . $_SESSION['currentUser']);

                $openSSL = new OpenSSL('aes-256-gcm', hash("sha512", session_id()));
                $token = $openSSL->encrypt($token);

                $id = $openSSL->encrypt($row['id']);

                // if the channel is already saved then show different icon
                $savedOrUnsaved = $row['saved'] == 1 ? 'class="save bi bi-bookmark-fill text-primary"' : 'class="save bi bi-bookmark text-primary"';

                // if the channel has already been applied then show "applied" text
                $appliedOrNot = $row['applied'] == 1 ? 'Applied' : 'Apply';

                echo '<div class="col-sm-6 col-lg-4 col-xl-3">
								<div class="card shadow h-100" style="position:relative;">
                                    <div class="card-body pb-0 bg-opacity-50 bg-blur d-flex justify-content-between align-items-start">
                                        <img class="rounded" height="60px" src="' . str_ireplace('88', '60', $row['snippetthumbnailsdefaulturl']) . '">
                                        <div class="ml-2 flex-fill" style="margin-left:5px">
                                            <div class="d-flex justify-content-between mb-2">
                                                <a href="search.php?searchtype=creators&category=' . $row['channel_type'] . '" class="badge bg-purple bg-opacity-10 text-purple">' . substr(adcategoryNumToString($row['channel_type']), 0, 13) . '..</a>
                                                <div class="' . $showSaveButton . '"  class="h6 mb-0"><i ' . $savedOrUnsaved . ' id="' . $row['id'] . '" data-action="saveCreators" data-token="' . $token . '" data-id="#' . $row['id'] . '"></i></div>
                                            </div>                                        
                                            <span  data-token="' . $token . '" data-action="applyCreators" class="applyCreators badge btn-outline-purple d-flex btn btn-purple btn-sm justify-content-center">' . $appliedOrNot . '</span>
                                        </div>
                                    </div>
									<div class="card-body pb-0">
                                        <h6 class="card-title fw-normal"><a href="channel-details.php?channel=' . $id . '">' . substr($row['snippettitle'], 0, 14) . $dot . '</a></h6>
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

    function suggestSponsorships($conn, $adCategory, $limit, $currentChannel)
    {
        $currentChannel = $_SESSION['currentUser'];
        if ($adCategory == "any") {
            //  $sql = "SELECT sponsorships.*, companyname, logo from sponsorships LEFT JOIN company ON sponsorships.id_company=company.id_company WHERE adcategory=0 and sponsorships.active=1 ORDER BY offer_price limit $limit";

            $sql = "SELECT sponsorships.*, 
                           IF(sponsorships.sponsorship_id 
                                IN (
                                    SELECT saved_sponsorship_id 
                                    FROM saved_sponsorships 
                                    WHERE saver_channel_id='$currentChannel' ),1,0) 
                                AS saved, 
                                
                            IF (sponsorships.sponsorship_id 
                                IN (
                                    SELECT id_sponsorship 
                                    FROM `apply_sponsorships` 
                                    WHERE id_user='$currentChannel'
                                    ), 1, 0) 
                                AS applied, 
                            companyname, logo 
                    FROM sponsorships 
                    LEFT JOIN company 
                        ON sponsorships.id_company=company.id_company 
                    WHERE sponsorships.active=1 
                    ORDER BY offer_price 
                    LIMIT $limit";
        } else {
            $adCategory = (int) $adCategory;
            $sql = "SELECT sponsorships.*, 
                           IF(sponsorships.sponsorship_id 
                                IN (
                                    SELECT 
                                        saved_sponsorship_id 
                                    FROM saved_sponsorships 
                                    WHERE saver_channel_id='$currentChannel' ),1,0) 
                                AS saved, 
                                
                            IF (sponsorships.sponsorship_id 
                                IN (
                                    SELECT id_sponsorship 
                                    FROM `apply_sponsorships` 
                                    WHERE id_user='$currentChannel'
                                    ), 1, 0) 
                                AS applied, 
                            companyname, logo 
                    FROM sponsorships 
                    LEFT JOIN company 
                        ON sponsorships.id_company=company.id_company 
                    WHERE adcategory=$adCategory AND sponsorships.active=1 
                    ORDER BY offer_price 
                    LIMIT $limit";
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            $showSaveButton = !$currentChannel ? "d-block" : "d-none";

            while ($row = $result->fetch_assoc()) {

                // prepare token for scurity check
                $token = $row['id_company'] . "|" . $row['subcreation_id'] . "|" . $row['sponsorship_id'] . "|" . hash("sha512", tokenSecret($conn, $_SESSION['currentUser']) . $_SESSION['currentUser']);
                $openSSL = new OpenSSL('aes-256-gcm', hash("sha512", session_id()));
                $token = $openSSL->encrypt($token);

                $savedOrUnsaved = $row['saved'] == 1 ? 'class="save_sponsorships bi bi-bookmark-fill text-primary"' : 'class="save_sponsorships bi bi-bookmark text-primary"';

                if ($row['applied'] == 0) {
                    $showApplied = '    <div class="d-flex flex-column">
												<button  class="apply_sponsorships btn btn-sm btn-primary-soft" id="b' . $row['sponsorship_id'] . '" data-action="applySponsorships" data-token="' . $token . '" data-id="#b' . $row['sponsorship_id'] . '"><i class="fas fa-paper-plane me-2"></i>Apply</button>
											</div>';
                } else {
                    $showApplied = '    <div class="d-flex flex-column">
												<div class="btn btn-sm btn-danger-soft item-show"><i class="fas fa-paper-plane me-2"></i>Applied</div>
                                                <a href="c/channel-profile.php?page=all_sponsorships#username" class="btn btn-sm btn-danger-soft item-show-hover"><i class="bi bi-layout-text-window-reverse me-2"></i>Manage</a>
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

    }

    function suggestBrands($conn, $industry, $limit, $currentChannel)
    {

        global $domain;
        $currentChannel = $_SESSION['currentUser'];
        if ($industry == "any") {
            $sql = "SELECT company.*, IF( id_company IN (SELECT DISTINCT saved_brand_id FROM `saved_brand_profiles` where saver_channel_id='$currentChannel'),1,0) AS saved from company WHERE active=1 ORDER BY registered_on LIMIT $limit";
        } else {
            $industry = (int) $industry;

            // $sql = "SELECT company.*, IF( id_company IN (SELECT DISTINCT saved_brand_id FROM `saved_brand_profiles` where saver_channel_id='$currentChannel'),1,0) AS saved from company WHERE industry=$industry and active=1 ORDER BY registered_on LIMIT $limit"; //abp change value of saver_channel_id to $_SEEION['currentUser]
            $sql = "SELECT 
                        primary_ac_id,companyname,country,state,city,
                        contactno,website,email,aboutme,logo,createdAt,
                        industry,benefit, primary_ac.token_secret,
		                IF(primary_ac_id 
                            IN (
                                SELECT DISTINCT saved_brand_id 
                                FROM saved_brand_profiles 
                                WHERE saver_channel_id = '$currentChannel'
                                ),1,0
                        ) AS saved, 
			            IF(primary_ac_id 
                            IN (
                                SELECT applied_brand_id 
                                FROM apply_brands 
                                WHERE applier_creator_id='$currentChannel' 
                                AND applier_creator_id='$currentChannel'
                                ),1,0
                        ) AS applied 
                    FROM `company` 
                    LEFT JOIN primary_ac ON primary_ac.ac_id ='$currentChannel' 
                    WHERE industry=$industry 
                    AND company.active=1 
                    LIMIT 10"; // abp 
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            $showSaveButton = isset($_SESSION['currentUser']) ? "d-block" : "d-none";

            while ($row = $result->fetch_assoc()) {

                // prepare token for scurity check
                $token = $row['primary_ac_id'] . "|" . hash("sha512", tokenSecret($conn, $_SESSION['currentUser']) . $_SESSION['currentUser']);
                $openSSL = new OpenSSL('aes-256-gcm', hash("sha512", session_id()));
                $token = $openSSL->encrypt($token);

                $id = $openSSL->encrypt($row['primary_ac_id']);
                $did = $openSSL->decrypt($id);

                // if the channel is already saved then show different icon
                $savedOrUnsaved = $row['saved'] == 1 ? 'class="saveCompany bi bi-bookmark-fill text-primary"' : 'class="saveCompany bi bi-bookmark text-primary"';

                echo '	<div class="tns-item tns-slide-active" id="tns1-item0">
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
                                        <div class="h6 fw-light mt-3 d-block d-flex align-items-start"><i ' . $savedOrUnsaved . ' data-action="saveBrands" id="a3' . $row['primary_ac_id'] . '"
                                                data-token="' . $token . '" data-id="#a0"></i></div>
                                    </div>
                                    <!-- Title -->
                                    <h5 class="card-title"><a href="#">' . substr($row['companyname'], 0, 15) . '</a></h5>
                                    <span class="small">' . substr($row['aboutme'], 0, 75) . '..</span>
                                    <!-- Time -->
                                    <div class="hstack gap-3 mt-2">
                                        <small class="h6 fw-light mb-0"><i
                                                class="bi bi-calendar-date text-danger me-2"></i>' . date("M jS", strtotime("10/10/2023 10:10:10")) . '</small> ∙
                                        <a href="' . $domain . '/brand-details.php?id=' . $row['primary_ac_id'] . '"
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

    }
}



function customNumberFormat($n, $precision = 3)
{
    if ($n < 1000000) {
        // Anything less than a million
        $n_format = number_format($n);
    } else if ($n < 1000000000) {
        // Anything less than a billion
        $n_format = number_format($n / 1000000, $precision) . 'M';
    } else {
        // At least a billion
        $n_format = number_format($n / 1000000000, $precision) . 'B';
    }

    return $n_format;
}

function socialURLFromString2($URLString)
{

    $socialList = array();
    $domainList = array();

    $string = "instagram.com facebook.com twitter.com youtube.com TikTok.com Pinterest.com Snapchat.com LinkedIn.com";
    $domainList = explode(" ", $string);
    $stringLength = strlen($URLString);

    for ($i = 0; $i < count($domainList); $i++) {
        $posOfDomain = stripos($URLString, $domainList[$i]); //1
        $posOfSpace = 0;

        $a = $posOfDomain - 1;
        if ($posOfDomain !== false) {
            while ($URLString[$a] !== ' ' || $URLString[$a] == '\r') {
                $posOfSpace = $a;
                if ($a == $stringLength) {
                    break;
                }
                $a++;
            }

            $link = substr($URLString, $posOfDomain, ($posOfSpace + 1) - $posOfDomain);
            if (stripos($link, "\n")) {
                $link = substr($URLString, $posOfDomain, stripos($link, "\n"));
                array_push($socialList, substr($link, 0, ($posOfSpace + 1) - $posOfDomain));
            } elseif (stripos($link, "\r")) {
                $link = substr($URLString, $posOfDomain, stripos($link, "\r"));
                array_push($socialList, substr($link, 0, ($posOfSpace + 1) - $posOfDomain));
            }
        }
    }

    return $socialList;
}

function emailFromString($string)
{
    //$pattern = '/[a-z0-9_\-\+\.]+@[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i';
    preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $string, $matches);

    if (!$matches) {
        return false;
    } else {
        return $matches[0];
    }
}

function phoneFromString($string)
{
    // returns all results in array $matches
    preg_match_all('/[0-9]{3}[\-][0-9]{6}|[0-9]{3}[\s][0-9]{6}|[0-9]{3}[\s][0-9]{3}[\s][0-9]{4}|[0-9]{9}|[0-9]{3}[\-][0-9]{3}[\-][0-9]{4}/', $string, $matches);
    if (!$matches) {
        return false;
    } else {
        return $matches[0];
    }
}

function countryCodeToName($conn, $code)
{
    $code = strtoupper($code);
    $query = "select name from countries where sortname='$code'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
        }

        return $name;
    } else {
        return "-";
    }
}

function tokenSecret($conn, $currentUser)
{
    $query = "select token_secret from primary_ac where ac_id='$currentUser'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $token_secret = $row['token_secret'];
        }

        return $token_secret;
    } else {
        return "";
    }
}


function industryCodeToName($code)
{
    $industry = array("Technology", "Media", "Advertising", "Marketing", "Stock market", "Financial services", "Education", "Trade", "Manufacturing", "Health care", "Food industry", "E-commerce", "Telecommunication", "Electronics", "Fintech", "Energy", "Economics", "Agriculture", "Construction", "Mining", "Retail", "Infrastructure", "Hospitality", "Business Process", "Public sector", "Other");
    return $industry[$code];
}

class message
{
    public $code = null;
    public $status = null;
    public $message = null;

    function __construct($code, $status, $message)
    {
        $this->code = $code;
        $this->status = $status;
        $this->message = $message;
    }

    function printMessage()
    {
        header('Content-Type: application/json; charset=utf-8');
        echo trim('{"code": ' . $this->code . ',"status": "' . $this->status . '", "message":"' . $this->message . '"}');
        exit();
    }

}

class OpenSSL
{

    private $method; // Encryption method
    private $key; // Encryption key
    private $iv; // Initialization vector

    public function __construct($method, $key)
    {
        $this->method = $method;
        $this->key = $key;
        $this->iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->method));
    }

    public function encrypt($data)
    {
        $tag = null;
        $encrypted = openssl_encrypt($data, $this->method, $this->key, OPENSSL_RAW_DATA, $this->iv, $tag);
        return base64_encode($this->iv . $encrypted . $tag);
    }

    public function decrypt($data)
    {
        $data = base64_decode($data);
        $iv = substr($data, 0, openssl_cipher_iv_length($this->method));
        $tag = substr($data, -16);
        $encrypted = substr($data, openssl_cipher_iv_length($this->method), -16);
        return openssl_decrypt($encrypted, $this->method, $this->key, OPENSSL_RAW_DATA, $iv, $tag);
    }
}


class generateHash
{
    private $email = null;
    private $ai = null;
    public $hash = null;

    //  generating primary AC ID
    function generatePrimaryACKey($email)
    {
        $hash = sha1(hash("sha512", hrtime(true) . random_bytes(60) . random_bytes(20) . $email));
        return "ac_" . $hash;
    }

    function generateToeknSec($email)
    {
        $hash = sha1(hash("sha512", hrtime(true) . random_bytes(80) . random_bytes(20) . $email));
        return $hash;
    }

    //  generating subcreation ID
    function generateSubCreationId($subcreationURL, $primaryACKey)
    {
        $hash = sha1(hash("sha512", hrtime(true) . random_bytes(30) . random_bytes(30) . $subcreationURL, $primaryACKey));
        return "cr_" . $hash;
    }

    // generating sponsorship ID
    function generateSponsorshipId($primaryACKey, $ai, $subcreationId)
    {
        $hash = sha1(hash("sha512", hrtime(true) . random_bytes(50) . random_bytes(50) . $ai . $primaryACKey . $subcreationId));
        return "sp_" . $hash;
    }


    // generating sponsorship apply ID
    function generateSponsorshipApplyId($primaryACKey, $sponsorshipId, $subcreationId)
    {
        $hash = sha1(hash("sha512", hrtime(true) . random_bytes(60) . random_bytes(60) . $sponsorshipId . $primaryACKey . $subcreationId));
        return "spA_" . $hash;
    }


    // generating creator apply ID [when a brand apply to creator]
    // @param creatorId of applier
    function generateCreatorApplyId($creatorId, $applierBrandId, $subcreationId)
    {
        $hash = sha1(hash("sha512", hrtime(true) . random_bytes(60) . random_bytes(60) . $applierBrandId . $creatorId . $subcreationId));
        return "crA_" . $hash;
    }

    function generateBrandApplyId($brandId, $applierCreatorId, $subcreationId)
    {
        $hash = sha1(hash("sha512", hrtime(true) . random_bytes(60) . random_bytes(60) . $applierCreatorId . $brandId . $subcreationId));
        return "brA_" . $hash;
    }
}
?>