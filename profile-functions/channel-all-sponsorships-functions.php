<?php

// this function will used to display bsic dashboard information
function basicStat($conn, $dataType, $currentUser)
{
    $query = "";
    $stat = 0;
    switch ($dataType) {
        case 'total':
            // select total number of application sent for sponsorships
            $query = "SELECT count(status) as stat from apply_sponsorships where id_user='$currentUser'";
            break;

        case 'accepted':
            // select total number of accepted application
            $query = "SELECT COUNT(status) as stat FROM apply_sponsorships WHERE id_user='$currentUser' and status=1";
            break;

        case 'rejected':
            // select total number of rejected application 
            $query = "SELECT COUNT(status) as stat FROM apply_sponsorships WHERE id_user='$currentUser' and status=0";
            break;

        case 'noresponse':
            // select total number of reviewing application
            $query = "SELECT COUNT(status) as stat FROM apply_sponsorships WHERE id_user='$currentUser' and status=2";
            break;
        case 'channel_following':
            // slecct tnumber of followings by the channel
            $query = "SELECT count(DISTINCT brand_id) as stat from channel_following where channel_user_id='$currentUser'";
            break;
        case 'brand_follownig':
            $query = "SELECT count(DISTINCT channel_user_id) as stat from brand_following where brand_id='$currentUser'";
            break;
        case 'saved_brand':
            $query = "SELECT count(DISTINCT saved_brand_id) as stat from saved_brand_profiles where saver_channel_id='$currentUser'";
            break;
        case 'saved_channel':
            $query = "SELECT count(DISTINCT saved_channel_id) as stat from saved_channel_profiles where saver_brand_id='$currentUser'";
            break;
        case 'total_company':
            $query = "SELECT COUNT(DISTINCT id_company) as stat FROM apply_sponsorships WHERE id_user='$currentUser'";
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

// deletes the request of sponsorships
function deleteRequest($conn, $currentUser, $idApply)
{

    $idApply = (int) $idApply;
    $queryBaicDetail = "DELETE FROM apply_sponsorships WHERE apply_sponsorships.id_apply='$idApply'";

    if ($result = $conn->query($queryBaicDetail)) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                //
            }
        }
    } else {
        $_SESSION['script_error_code'] = "1000";
        header("Location:../error-404.html");
    }
}

if (isset($_POST['actionType']) && $_POST['actionType'] === "deleteSponsorship") {
    deleteRequest($conn, $currentUser, $_POST['applyId']);
}


?>