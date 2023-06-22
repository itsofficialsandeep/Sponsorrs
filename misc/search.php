<?php

session_start();

require_once("misc/db.php");

$limit = 4;

if (isset($_GET["page"])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}

$start_from = ($page - 1) * $limit;


if (isset($_GET['filter']) && $_GET['filter'] == 'country') {

  $sql = "SELECT * FROM company WHERE country='$_GET[search]'";
  //$sql = "SELECT id_sponsorship FROM sponsorship_search WHERE MATCH(full_text) AGAINST('$_GET[search]' IN NATURAL LANGUAGE MODE) LIMIT $start_from, $limit";

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row1 = $result->fetch_assoc()) {
      $sql1 = "SELECT * FROM sponsorships WHERE id_job=(int)$row1[id_company] LIMIT $start_from, $limit";
      $result1 = $conn->query($sql1);
      if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
          ?>

                    <div class="card mb-3" style="max-width: 540px;">
                      <div class="row no-gutters">
                        <div class="col-md-4">
                          <img src="uploads/logo/<?php echo $row1['logo']; ?>" class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                            <h5 class="card-title"><a href="view-job-post.php?id=<?php echo $row['sponsorship_id']; ?>"><?php echo $row['sponsorship_title']; ?></a> <span class="attachment-heading pull-right">$
                                <?php echo $row['offer_price']; ?>/Month
                              </span></h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.
                              This content is a little bit longer.</p>
                            <div class="d-flex justify-content-center">
                              <p class="card-text"><small class="text-muted">
                                  <?php echo $row1['companyname']; ?> |
                                  <?php echo $row1['city']; ?>
                                </small></p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="attachment-block clearfix">
                      <img class="attachment-img" src="uploads/logo/<?php echo $row1['logo']; ?>" alt="Attachment Image">
                      <div class="attachment-pushed">
                        <h4 class="attachment-heading"><a href="view-job-post.php?id=<?php echo $row['sponsorship_id']; ?>"><?php echo $row['sponsorship_title']; ?></a> <span class="attachment-heading pull-right">$
                            <?php echo $row['offer_price']; ?>/Month
                          </span></h4>
                        <div class="attachment-text">
                          <div><strong>
                              <?php echo $row1['companyname']; ?> |
                              <?php echo $row1['city']; ?> | Experience
                              <?php echo $row['experience']; ?> Years
                            </strong></div>
                        </div>
                      </div>
                    </div>

                <?php
        }
      }
    }
  }


} else {

  if (isset($_GET['filter']) && $_GET['filter'] == 'searchBar') {

    $search = $_GET['search'];
    $sql = "SELECT id_sponsorship FROM sponsorship_search WHERE MATCH(full_text) AGAINST('$search' IN NATURAL LANGUAGE MODE) LIMIT $start_from, $limit";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $id_job = $row['id_job'];
        $id_job = (int) $id_job;
        $sql1 = "SELECT * FROM sponsorships LEFT JOIN company ON `company`.`id_company` = `job_post`.`id_company` WHERE job_post.sponsorship_id=$id_job";
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
                                    href="view-job-post.php?id=<?php echo $row1['sponsorship_id']; ?>"><?php echo $row1['sponsorship_title']; ?></a>
                                  <span class="attachment-heading pull-right">$
                                    <?php echo $row1['offer_price']; ?>
                                  </span></h5>
                                <p class="card-text">
                                  <?php echo $row1['description']; ?>
                                </p>
                                <div class="d-flex justify-content-center">
                                  <p class="card-text">
                                    <?php echo $row1['adtype']; ?> |
                                    <?php echo $row1['adcategory']; ?>
                                  </p>
                                </div>
                                <div class="d-flex justify-content-center">
                                  <p class="card-text">
                                    <?php echo $row1['companyname']; ?> |
                                    <?php echo $row1['city']; ?>
                                  </p>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- <div class="attachment-block clearfix">
                                                                              <img class="attachment-img" src="uploads/logo/<?php echo $row1['logo']; ?>" alt="Attachment Image">
                                                                              <div class="attachment-pushed">
                                                                                <h4 class="attachment-heading"><a href="view-job-post.php?id=<?php echo $row['sponsorship_id']; ?>"><?php echo $row['sponsorship_title']; ?></a> <span class="attachment-heading pull-right">$<?php echo $row['offer_price']; ?>/Month</span></h4>
                                                                                <div class="attachment-text">
                                                                                    <div><strong><?php echo $row1['companyname']; ?> | <?php echo $row1['city']; ?> | Experience <?php echo $row['experience']; ?> Years</strong></div>
                                                                                </div>
                                                                              </div>
                                                                            </div> -->

                    <?php
          }
        }
      }
    }

  } else if (isset($_GET['filter']) && $_GET['filter'] == 'experience') {

    $offer = $_GET['search'];
    $offer = (int) $offer;

    $sql = "SELECT * FROM sponsorships WHERE minimumsalary >= $offer LIMIT $start_from, $limit";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $sql1 = "SELECT * FROM company WHERE id_company='$row[id_company]'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
          while ($row1 = $result1->fetch_assoc()) {
            ?>

                            <!-- <div class="attachment-block clearfix">
                                                                                        <img class="attachment-img" src="uploads/logo/<?php echo $row1['logo']; ?>" alt="Attachment Image">
                                                                                        <div class="attachment-pushed">
                                                                                          <h4 class="attachment-heading"><a href="view-job-post.php?id=<?php echo $row['sponsorship_id']; ?>"><?php echo $row['sponsorship_title']; ?></a> <span class="attachment-heading pull-right">$<?php echo $row['offer_price']; ?>/Month</span></h4>
                                                                                          <div class="attachment-text">
                                                                                              <div><strong><?php echo $row1['companyname']; ?> | <?php echo $row1['city']; ?> | Experience <?php echo $row['experience']; ?> Years</strong></div>
                                                                                          </div>
                                                                                        </div>
                                                                                      </div> -->

                    <?php
          }
        }
      }
    }
  }
}




$conn->close();