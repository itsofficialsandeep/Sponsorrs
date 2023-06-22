<?php
session_start();
include_once("../misc/functions.php");
// save or unsave a channel
if (isset($_POST['ID']) && $_POST['actionType'] == 1) {

    include("../misc/db.php");

    $content = $_POST['ID'];

    $openSSL = new OpenSSL('aes-256-gcm', hash("sha512", session_id()));
    $content = $openSSL->decrypt($content);

    $content = explode("|", $content);
    $channel_id = $content[0];
    $token = $content[1];

    $currentUser = $_SESSION['currentUser'];

    $userToken = hash("sha512", tokenSecret($conn, $currentUser) . $_SESSION['currentUser']);

    if (1) { //abp change 1 with 

        // check if channel is already saved
        $result1 = $conn->prepare("SELECT sr_no FROM `saved_channel_profiles` WHERE saved_channel_id=? and saver_brand_id=?");
        $result1->bind_param('ss', $channel_id, $currentUser);
        $result1->execute();
        $result1->store_result();
        $totalResult = $result1->num_rows;

        $result1->close();
        // if channel is already saved then update
        if ($totalResult > 0) {
            $result2 = $conn->prepare("DELETE from `saved_channel_profiles` WHERE saved_channel_id=? and saver_brand_id=?");
            $result2->bind_param('ss', $channel_id, $currentUser);
            $result2->execute();

            $message = new message(400, "unsaved", "Unsaved the channel profile");
            $message->printMessage();
            $result2->close();

        } else if ($totalResult == 0) {
            $result3 = $conn->prepare("INSERT INTO `saved_channel_profiles` (`saved_channel_id`, `saver_brand_id`) VALUES (?,?)");
            $result3->bind_param('ss', $channel_id, $currentUser);
            $result3->execute();
            $result3->close();
            $message = new message(200, "saved", "Saved the channel");
            $message->printMessage();

        }

    }
}

// save sponsorship
if (isset($_POST['ID']) && $_POST['actionType'] == 2) {

    include("../misc/db.php");

    $content = $_POST['ID'];

    $openSSL = new OpenSSL('aes-256-gcm', hash("sha512", session_id()));
    $content = $openSSL->decrypt($content);

    $content = explode("|", $content);
    $companyID = $content[0];
    $subcreationId = $content[1];
    $sponsorship_id = $content[2];
    $token = $content[3];

    $currentUser = $_SESSION['currentUser'];

    $userToken = hash("sha512", tokenSecret($conn, $currentUser) . $_SESSION['currentUser']);

    if (1) { //abp change 1 with 

        // check if channel is already saved
        $result1 = $conn->prepare("SELECT sr_no FROM `saved_sponsorships` WHERE saved_sponsorship_id=? and saver_channel_id=?");
        $result1->bind_param('ss', $sponsorship_id, $currentUser);
        $result1->execute();
        $result1->store_result();
        $totalResult = $result1->num_rows;

        $result1->close();
        // if channel is already saved then update
        if ($totalResult > 0) {
            $result2 = $conn->prepare("DELETE from `saved_sponsorships` WHERE saved_sponsorship_id=? and saver_channel_id=?");
            $result2->bind_param('ss', $sponsorship_id, $currentUser);
            $result2->execute();

            $message = new message(400, "unsaved", "Unsaved the sponsorship" . $totalResult);
            $message->printMessage();
            $result2->close();

        } else if ($totalResult == 0) {
            $result3 = $conn->prepare("INSERT INTO `saved_sponsorships` (`saved_sponsorship_id`,`subcreation_id`, `saver_channel_id`) VALUES (?,?,?)");
            $result3->bind_param('sss', $sponsorship_id, $subcreationId, $currentUser);
            $result3->execute();
            $result3->close();
            $message = new message(200, "saved", "Saved the sponsorship");
            $message->printMessage();

        }

    }
}

// apply for sponsorships
if (isset($_POST['ID']) && $_POST['actionType'] == 3) {

    include("../misc/db.php");

    $content = $_POST['ID'];

    $openSSL = new OpenSSL('aes-256-gcm', hash("sha512", session_id()));
    $content = $openSSL->decrypt($content);

    $content = explode("|", $content);
    $companyID = $content[0];
    $subcreationId = $content[1];
    $sponsorship_id = $content[2];
    $token = $content[3];

    $currentUser = $_SESSION['currentUser'];

    $userToken = hash("sha512", tokenSecret($conn, $currentUser) . $_SESSION['currentUser']);

    if (1) { //abp change 1 with 

        // check if channel is already saved
        $result1 = $conn->prepare("SELECT sr_no FROM `apply_sponsorships` WHERE id_sponsorship=? and id_user=? and subcreation_id=?");
        $result1->bind_param('sss', $sponsorship_id, $currentUser, $subcreationId);
        $result1->execute();
        $result1->store_result();
        $totalResult = $result1->num_rows;

        $result1->close();
        if ($totalResult == 0) {

            $generateHash = new generateHash();
            $applicationId = $generateHash->generateSponsorshipApplyId($_SESSION['currentUser'], $sponsorship_id, $subcreationId);

            $result3 = $conn->prepare("INSERT INTO `apply_sponsorships`(`id_apply`, `id_sponsorship`, `subcreation_id`, `id_company`, `id_user`) VALUES (?,?,?,?,?)");
            $result3->bind_param('sssss', $applicationId, $sponsorship_id, $subcreationId, $companyID, $_SESSION['currentUser']);
            $result3->execute();
            $result3->close();

            $htmlUpdate = "<div class='btn btn-sm btn-danger-soft item-show'><i class='fas fa-paper-plane me-2'></i>Applied</div><div class='btn btn-sm btn-danger-soft item-show-hover'><i class='bi bi-layout-text-window-reverse me-2'></i>Manage</div>";

            echo $htmlUpdate;
            // echo "ok|" . $htmlUpdate;

            //echo '{"code":200, "message":"' . $htmlUpdate . '","status":"success"}';

            // $message = new message(200, "success", $htmlUpdate);
            // $message->printMessage();

        } else {
            $message = new message(400, "failed", "Somethingwent wrong!");
            $message->printMessage();
        }

    }
}


// save the brand
if (isset($_POST['ID']) && $_POST['actionType'] == 4) {

    include("../misc/db.php");

    $content = $_POST['ID'];

    $openSSL = new OpenSSL('aes-256-gcm', hash("sha512", session_id()));
    $content = $openSSL->decrypt($content);

    $content = explode("|", $content);
    $companyID = $content[0];
    $token = $content[1];

    $currentUser = $_SESSION['currentUser'];

    $userToken = hash("sha512", tokenSecret($conn, $currentUser) . $_SESSION['currentUser']);

    if (1) { //abp change 1 with 

        // check if channel is already saved
        $result1 = $conn->prepare("SELECT sr_no FROM `saved_brand_profiles` WHERE saved_brand_id=? and saver_channel_id=?");
        $result1->bind_param('ss', $companyID, $currentUser);
        $result1->execute();
        $result1->store_result();
        $totalResult = $result1->num_rows;

        if ($totalResult == 0) {

            $result2 = $conn->prepare("INSERT INTO `saved_brand_profiles`(`saved_brand_id`, `saver_channel_id`) VALUES (?,?)");
            $result2->bind_param('ss', $companyID, $currentUser);
            $result2->execute();
            $result2->close();

            $message = new message(200, "success", "Brand saved successfully..!");
            $message->printMessage();

        } else if ($totalResult > 0) {
            $result3 = $conn->prepare("DELETE from `saved_brand_profiles` WHERE saved_brand_id=? and saver_channel_id=?");
            $result3->bind_param('ss', $companyID, $currentUser);
            $result3->execute();


            $message = new message(400, "unsaved", "Unsaved the brand" . $totalResult);
            $message->printMessage();
            $result3->close();

        }

    }
}

// apply creators
if (isset($_POST['ID']) && $_POST['actionType'] == 5) {

    include("../misc/db.php");

    $content = $_POST['ID'];

    $openSSL = new OpenSSL('aes-256-gcm', hash("sha512", session_id()));
    $content = $openSSL->decrypt($content);

    $content = explode("|", $content);
    $applied_creator_id = $content[0];
    $subcreationID = $content[1];
    $token = $content[2];

    $status = 1;

    $currentUser = $_SESSION['currentUser'];

    $hash = new generateHash();
    $creatorApplyId = $hash->generateCreatorApplyId($applied_creator_id, $currentUser, $subcreationID);

    $userToken = hash("sha512", tokenSecret($conn, $currentUser) . $_SESSION['currentUser']);

    if (1) { //abp change 1 with 

        $result1 = $conn->prepare("SELECT sr_no from `apply_creators` WHERE applier_brand_id=? and applied_creator_id=? and applied_subcreation_id=?");
        $result1->bind_param('sss', $currentUser, $applied_creator_id, $subcreationID);
        $result1->execute();
        $result1->store_result();
        $totalResult = $result1->num_rows;

        $result1->close();
        // if channel is already applied then update
        if ($totalResult > 0) {
            $result2 = $conn->prepare("DELETE from `apply_creators` WHERE applier_brand_id=? and applied_creator_id=? and applied_subcreation_id=?");
            $result2->bind_param('sss', $currentUser, $applied_creator_id, $subcreationID);
            $result2->execute();

            $message = new message(400, "deleted", "Application successfuly deleted");
            $message->printMessage();
            $result2->close();

        } else if ($totalResult == 0) {
            $result3 = $conn->prepare("INSERT INTO `apply_creators`(`apply_id`, `applier_brand_id`, `applied_creator_id`, `applied_subcreation_id`, `status`) VALUES (?,?,?,?,?)");
            $result3->bind_param('ssssi', $creatorApplyId, $currentUser, $applied_creator_id, $subcreationID, $status);
            $result3->execute();
            $result3->close();
            $message = new message(200, "applied", "successfuly applied..");
            $message->printMessage();

        }

    }

}


// apply brands
if (isset($_POST['ID']) && $_POST['actionType'] == 6) {

    include("../misc/db.php");

    $content = $_POST['ID'];

    $openSSL = new OpenSSL('aes-256-gcm', hash("sha512", session_id()));
    $content = $openSSL->decrypt($content);

    $content = explode("|", $content);
    $applied_brand_id = $content[0];
    $token = $content[2];
    $subcreationID = $content[1];
    $status = 1;

    $currentUser = $_SESSION['currentUser'];

    $hash = new generateHash();
    $brandApplyId = $hash->generateBrandApplyId($applied_brand_id, $currentUser, $subcreationID);

    $userToken = hash("sha512", tokenSecret($conn, $currentUser) . $_SESSION['currentUser']);

    if (1) { //abp change 1 with 

        $result1 = $conn->prepare("SELECT sr_no from `apply_brands` WHERE applier_creator_id=? and applied_brand_id=? and applier_subcreation_id=?");
        $result1->bind_param('sss', $currentUser, $applied_brand_id, $subcreationID);
        $result1->execute();
        $result1->store_result();
        $totalResult = $result1->num_rows;

        $result1->close();
        // if channel is already applied then update
        if ($totalResult > 0) {
            $result2 = $conn->prepare("DELETE from `apply_brands` WHERE applier_creator_id=? and applied_brand_id=? and applier_subcreation_id=?");
            $result2->bind_param('sss', $currentUser, $applied_brand_id, $subcreationID);
            $result2->execute();

            $message = new message(400, "deleted", "Application successfuly deleted" . $totalResult);
            $message->printMessage();
            $result2->close();

        } else if ($totalResult == 0) {
            $result3 = $conn->prepare("INSERT INTO `apply_brands`(`apply_id`, `applier_creator_id`, `applied_brand_id`, `applier_subcreation_id`, `status`) VALUES (?,?,?,?,?)");
            $result3->bind_param('ssssi', $brandApplyId, $currentUser, $applied_brand_id, $subcreationID, $status);
            $result3->execute();
            $result3->close();
            $message = new message(200, "applied", "successfuly applied");
            $message->printMessage();

        }

    }
}

?>