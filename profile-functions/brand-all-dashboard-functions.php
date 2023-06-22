<?php

// this function will used to display bsic dashboard information
function basicStat($conn, $dataType, $currentUser)
{
    $query = "";
    $stat = 0;
    switch ($dataType) {
        case 'total':
            // select total number of application recieved for sponsorships
            $query = "SELECT count(status) as stat from apply_sponsorships where id_company='$currentUser'";
            break;

        case 'accepted':
            // select total number of accepted application
            $query = "SELECT COUNT(status) as stat FROM apply_sponsorships WHERE id_company='$currentUser' and status=1";
            break;

        case 'rejected':
            // select total number of rejected application 
            $query = "SELECT COUNT(status) as stat FROM apply_sponsorships WHERE id_company='$currentUser' and status=0";
            break;

        case 'noresponse':
            // select total number of reviewing application
            $query = "SELECT COUNT(status) as stat FROM apply_sponsorships WHERE id_company='$currentUser' and status=2";
            break;
        case 'channel_following':
            // select tnumber of followings by the channel
            $query = "SELECT count(DISTINCT brand_id) as stat from brand_following where brand_id='$currentUser'";
            break;
        case 'brand_follownig':
            $query = "SELECT count(DISTINCT channel_user_id) as stat from brand_following where brand_id='$currentUser'";
            break;
        case 'saved_channel':
            $query = "SELECT count(DISTINCT saver_brand_id) as stat from saved_brand_profiles where saver_brand_id='$currentUser'";
            break;
        case 'total_creators':
            $query = "SELECT COUNT(DISTINCT applied_creator_id) as stat FROM apply_creators WHERE applier_brand_id='$currentUser'";
            echo $query;
            break;
        default:
            # code...
            break;
    }

    if ($result = $conn->query($query)) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $stat = $row['stat'];
            }
        }
    } else {
        $_SESSION['script_error_code'] = "1000";
        header("Location:../error-404.html");
    }

    return $stat;
}


if (isset($_POST['actionType']) && $_POST['actionType'] === "deleteSponsorship" && $_POST['applyId']) {
    include_once("../misc/db.php");
    include_once("../misc/functions.php");

    $sponsorshipid = $_POST['applyId'];
    $sponsorshipid = trim($sponsorshipid, "#");

    deleteRequest($conn, $sponsorshipid);
}

// deletes the request of sponsorships
function deleteRequest($conn, $sponsorship_id)
{
    $queryBaicDetail = "UPDATE sponsorships SET active=0 WHERE sponsorship_id ='$sponsorship_id'";

    if ($conn->query($queryBaicDetail)) {
        $message = new message(200, "success", "Sucessfully deleted" . $queryBaicDetail);
        $message->printMessage();
    } else {
        $message = new message(400, "failed", "Sponsorship not deleted");
        $message->printMessage();
    }
}

?>