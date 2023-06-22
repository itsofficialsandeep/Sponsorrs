<?php

session_start();

require_once("misc/db.php");
require_once("misc/functions.php");
$limit = 4;

if (isset($_GET["page"])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}

$start_from = ($page - 1) * $limit;

/**
// $sql = "SELECT * FROM sponsorships LIMIT $start_from, $limit";
// $result = $conn->query($sql);
// if($result->num_rows > 0) {
// 	while($row = $result->fetch_assoc()) {
// 		$sql1 = "SELECT * FROM company WHERE id_company='$row[id_company]'";
//               $result1 = $conn->query($sql1);
//               if($result1->num_rows > 0) {
//                 while($row1 = $result1->fetch_assoc()) 
//                 {
//              ?>
*/


$sql = "SELECT * FROM sponsorships LEFT JOIN company ON `company`.`id_company`= `job_post`.`id_company` where minimumsalary >= 10000 LIMIT $start_from, $limit";
//$sql2 = "SELECT id_sponsorship FROM sponsorship_search WHERE MATCH(full_text) AGAINST('$q' IN NATURAL LANGUAGE MODE) LIMIT $start_from, $limit";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $sql1 = "SELECT * FROM company WHERE id_company='$row[id_company]'";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
      while ($row1 = $result1->fetch_assoc()) {
        ?>

        <div class="card mb-3"
          style="max-width: 685px; max-width: 685px; background: #fff; padding: 15px; border: 1px solid #efefef; box-shadow: 1px 1px 1px #b7b7b7; border-radius: 5px; margin-bottom: 10px;}">
          <div class="row no-gutters">
            <div class="col-md-3">
              <img src="uploads/logo/<?php echo $row1['logo']; ?>" class="card-img" alt="..." height="150px">
            </div>
            <div class="col-md-9">
              <div class="card-body">
                <h5 class="card-title" style="font-size: 22px;"><a
                    href="view-job-post.php?id=<?php echo $row['sponsorship_id']; ?>"><?php echo $row['sponsorship_title']; ?></a>
                  <span class="attachment-heading pull-right">$
                    <?php echo $row['offer_price']; ?>
                  </span></h5>
                <p class="card-text">
                  <?php echo $row['description']; ?>
                </p>
                <div class="d-flex justify-content-center">
                  <p class="card-text">
                    <?php echo adtypeNumToString($row['adtype']); ?> |
                    <?php echo adcategoryNumToString($row['adcategory']); ?> |
                    <?php echo adserviceNumToString($row['service']); ?>
                  </p>
                </div>
                <div class="d-flex justify-content-center">
                  <p class="card-text">
                    <?php echo $row['companyname']; ?> |
                    <?php echo $row1['city']; ?>
                  </p>
                </div>

              </div>
            </div>
          </div>
        </div>

      <?php
      }
    }
  }
}

$conn->close();