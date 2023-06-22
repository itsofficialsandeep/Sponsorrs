<?php

include_once("../misc/db.php");

$sql = "SELECT DISTINCT idchannelId, type, sr_no FROM channel_list2 where type = 13 LIMIT 101";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    print_r($row);
    while ($row = $result->fetch_assoc()) {

        echo $row['idchannelId'] . "--" . $row['type'] . "--" . $row['sr_no'];

        $channel_id = $row['idchannelId'];
        // $channel_id = "UC0T6MVd3wQDB5ICAe45OxaQ"; // remove when doing actual 

        $sr_no = $row['sr_no'];
        $sr_no = (int) $sr_no;

        $channelType = $row['type'];

        //$content = file_get_contents("https://www.googleapis.com/youtube/v3/channels?id=".$channel_id."&part=snippet,contentDetails,statistics,status,topicDetails&key=AIzaSyB78E8AD89lKhEEBYKZeyQbzRASL2Tkxts");
        //$content = file_get_contents("scc.php");

        $decodedJSON = json_decode($content, true);

        $id_from_api = $decodedJSON["items"][0]["id"];

        echo "-->" . $channel_id . "--" . $id_from_api;

        if ($decodedJSON["pageInfo"]["totalResults"] == 1 && $channel_id == $id_from_api) {
            $title = addslashes($decodedJSON["items"][0]["snippet"]["title"]);

            $description = addslashes($decodedJSON["items"][0]["snippet"]["description"]);
            $customUrl = $decodedJSON["items"][0]["snippet"]["customUrl"];
            $publishedAt = $decodedJSON["items"][0]["snippet"]["publishedAt"];
            $thumbnailUrl = $decodedJSON["items"][0]["snippet"]["thumbnails"]["default"]["url"];
            $country = $decodedJSON["items"][0]["snippet"]["country"];

            $likes = $decodedJSON["items"][0]["contentDetails"]["relatedPlaylists"]["likes"];
            $uploads = $decodedJSON["items"][0]["contentDetails"]["relatedPlaylists"]["uploads"];

            $viewsCount = $decodedJSON["items"][0]["statistics"]["viewCount"];
            $viewsCount = (int) $viewsCount;

            $subscriberCount = $decodedJSON["items"][0]["statistics"]["subscriberCount"];
            $subscriberCount = (int) $subscriberCount;

            $hiddenSubscriberCount = $decodedJSON["items"][0]["statistics"]["hiddenSubscriberCount"];
            $hiddenSubscriberCount = (int) $hiddenSubscriberCount;

            $videoCount = $decodedJSON["items"][0]["statistics"]["videoCount"];
            $videoCount = (int) $videoCount;

            $privacyStatus = $decodedJSON["items"][0]["status"]["privacyStatus"];

            $isLinked = $decodedJSON["items"][0]["status"]["isLinked"];
            $isLinked = (int) $isLinked;

            $longUploadStatus = $decodedJSON["items"][0]["status"]["longUploadsStatus"];

            $madeForKids = $decodedJSON["items"][0]["status"]["madeForKids"];
            $madeForKids = (int) $madeForKids;

            $content = addslashes($content);

            echo "<br><br>-->" . $id_from_api . " --> " . $title . " --> " . $description . " --> " . $customUrl . " --> " . $publishedAt . " --> " . $country . " --> " . $likes . " --> " . $uploads . " --> " .
                $viewsCount . " --> " . $subscriberCount . " --> " . $hiddenSubscriberCount . " --> " . $videoCount . " --> " . $privacyStatus . " --> " . $isLinked . " --> " .
                $longUploadStatus . " --> " . (int) $madeForKids;

            $searchableText = $id_from_api . " --> " . $title . " --> " . $description . " --> " . $customUrl . " --> " . $publishedAt . " --> " . $country;

            $sql = "INSERT INTO `channel_detail`(`sr_from_pre_table`, `id`, `snippettitle`, `snippetdescription`, `snippetcustomUrl`, 
                                                        `snippetpublishedAt`, `snippetthumbnailsdefaulturl`, `snippetcountry`, `contentDetailsrelatedPlaylistslikes`, 
                                                        `contentDetailsrelatedPlaylistsuploads`, `statisticsviewCount`, `statisticssubscriberCount`, 
                                                        `statisticshiddenSubscriberCount`, `statisticsvideoCount`, `statusprivacyStatus`, `statusisLinked`, 
                                                        `statuslongUploadsStatus`, `statusmadeForKids`, `channel_type`, `searchable_text`) 
                                                        VALUES ($sr_no,'$channel_id','$title','$description','$customUrl','$publishedAt','$thumbnailUrl',
                                                        '$country','$likes','$uploads',$viewsCount,$subscriberCount,$hiddenSubscriberCount,$videoCount,
                                                        '$privacyStatus',$isLinked,'$longUploadStatus',$madeForKids,$channelType,'$searchableText')";
            $resultt = $conn->query($sql);

            if ($resultt) {
                echo "OK " . $sr_no;
            } else {
                echo "failed to insert row " . $sr_no;
            }
        } else {
            echo "more than two results";
            exit(); // if there are more than 1 channel data result in single api query
        }

    }
}

?>