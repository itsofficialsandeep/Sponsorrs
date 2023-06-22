<?php

$username = $_GET['channel'];
$query = "select * from channel_detail where snippetcustomUrl='$username'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$title = $row['snippettitle'];
		$description = $row['snippetdescription'];
		$publishedAt = $row['snippetpublishedAt'];
		$thumbnail = $row['snippetthumbnailsdefaulturl'];
		$country = $row['snippetcountry'];
		$viewCount = $row['statisticsviewCount'];
		$subscriberCount = $row['statisticssubscriberCount'];
		$videoCount = $row['statisticsvideoCount'];
		$privacyStatus = $row['statusprivacyStatus'];
		$forKids = $row['statusmadeForKids'];
		$owner = $row['owned_by'];
	}
}














?>

========================================================================================
<script type="text/javascript">
	
</script>