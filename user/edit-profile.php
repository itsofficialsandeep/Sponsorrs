<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
if (empty($_SESSION['id_user'])) {
  header("Location: ../index.php");
  exit();
}

require_once("../misc/db.php");
?>
<!DOCTYPE html>
<html>

<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-KRL58MWH94"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-KRL58MWH94');
</script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Job Portal</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/AdminLTE.min.css">
  <link rel="stylesheet" href="../css/_all-skins.min.css">
  <!-- Custom -->
  <link rel="stylesheet" href="../css/custom.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-green sidebar-mini">
  <div class="wrapper">

    <header class="main-header">

      <!-- Logo -->
      <a href="index.php" class="logo logo-bg">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>J</b>P</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Job</b> Portal</span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li>
              <a href="../jobs.php">Jobs</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left: 0px;">

      <section id="candidates" class="content-header">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Welcome <b>
                      <?php echo $_SESSION['name']; ?>
                    </b></h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="edit-profile.php"><i class="fa fa-user"></i> Edit Profile</a></li>
                    <li><a href="index.php"><i class="fa fa-address-card-o"></i> My Applications</a></li>
                    <li><a href="../jobs.php"><i class="fa fa-list-ul"></i> Jobs</a></li>
                    <li><a href="mailbox.php"><i class="fa fa-envelope"></i> Mailbox</a></li>
                    <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                    <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-9 bg-white padding-2">
              <h2><i>Edit Profile</i></h2>
              <form action="update-profile.php" method="post" enctype="multipart/form-data" class="form-floating">
                <?php
                //Sql to get logged in user details.
                $sql = "SELECT * FROM users WHERE id_user='$_SESSION[id_user]'";
                $result = $conn->query($sql);

                //If user exists then show his details.
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="row">
                          <div class="col-md-6 latest-job ">
                            <div class="form-group">
                              <label for="stream">Prevoius Sponsors</label>
                              <input type="text" class="form-control input-lg" id="stream" name="previous_sponsor"
                                placeholder="stream" value="<?php echo $row['previous_sponsors']; ?>">
                            </div>
                            <div class="form-group">
                              <label for="country" class="form-label">Channel Category</label>
                              <select class="form-control input-lg form-select" id="country" required="" name="channel_type">
                                <option value="1" <?php if ($row['channel_category'] == 1) {
                                  echo "selected";
                                } ?>>Entertainment
                                </option>
                                <option value="2" <?php if ($row['channel_category'] == 2) {
                                  echo "selected";
                                } ?>>Education
                                </option>
                                <option value="3" <?php if ($row['channel_category'] == 3) {
                                  echo "selected";
                                } ?>>Tech and Science
                                </option>
                                <option value="4" <?php if ($row['channel_category'] == 4) {
                                  echo "selected";
                                } ?>>Vlog</option>
                                <option value="5" <?php if ($row['channel_category'] == 5) {
                                  echo "selected";
                                } ?>>Product/Service
                                  Review</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="country" class="form-label">Sponsor Type</label>
                              <select class="form-control input-lg form-select" id="country" required="" name="sponsor_type">
                                <option value="1" <?php if ($row['sponsor_type'] == 1) {
                                  echo "selected";
                                } ?>>Type 1</option>
                                <option value="2" <?php if ($row['sponsor_type'] == 2) {
                                  echo "selected";
                                } ?>>Type 2</option>
                                <option value="3" <?php if ($row['sponsor_type'] == 3) {
                                  echo "selected";
                                } ?>>Type 3</option>
                                <option value="4" <?php if ($row['sponsor_type'] == 4) {
                                  echo "selected";
                                } ?>>Type 4</option>
                                <option value="5" <?php if ($row['sponsor_type'] == 5) {
                                  echo "selected";
                                } ?>>Type 5</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="email">Email address</label>
                              <input type="email" class="form-control input-lg" id="email" placeholder="Email"
                                value="<?php echo $row['email']; ?>" readonly>
                            </div>
                            <div class="form-group">
                              <label for="fname">Channel Name</label>
                              <input type="text" class="form-control input-lg" id="fname" name="channel_name"
                                placeholder="First Name" value="<?php echo $row['channel_name']; ?>" required="" readonly>
                            </div>
                            <div class="form-group">
                              <button type="submit" class="btn btn-flat btn-success">Update Profile</button>
                            </div>
                          </div>

                          <div class="col-md-6 latest-job ">
                            <div class="form-group float-left">
                              <label for="lname">Chanel Username</label>
                              <input type="text" class="form-control input-lg" id="lname" name="channel_username"
                                placeholder="Last Name" value="<?php echo $row['channel_username']; ?>" required="" readonly>
                            </div>
                            <div class="form-group float-right">
                              <label for="address">Total Subscriber</label>
                              <input type="text" id="address" name="sub_count" class="form-control input-lg"
                                placeholder="Address" value="<?php echo $row['total_sub']; ?>" readonly>
                            </div>
                            <div class="form-group">
                              <label for="city">Total Videos</label>
                              <input type="text" class="form-control input-lg" id="city" name="video_count"
                                value="<?php echo $row['total_videos']; ?>" placeholder="city" readonly>
                            </div>
                            <div class="form-group">
                              <label for="state">Total Views</label>
                              <input type="text" class="form-control input-lg" id="state" name="total_views" placeholder="state"
                                value="<?php echo $row['total_views']; ?>" readonly>
                            </div>
                            <div class="form-group">
                              <label for="contactno">Total Comment</label>
                              <input type="text" class="form-control input-lg" id="contactno" name="comment_count"
                                placeholder="Contact Number" value="<?php echo $row['comment_count']; ?>" readonly>
                            </div>
                            <div class="form-group">
                              <label for="qualification">Channel Description</label>
                              <input type="text" class="form-control input-lg" id="qualification" name="channel_about"
                                placeholder="Highest Qualification" value="<?php echo $row['channel_about']; ?>" readonly>
                            </div>
                            <div class="form-group" style="display: none;">
                              <label>Upload/Change Resume</label>
                              <input type="file" name="resume" class="btn btn-default">
                            </div>
                          </div>
                        </div>
                      <?php
                  }
                }
                ?>
              </form>
              <?php if (isset($_SESSION['uploadError'])) { ?>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <?php echo $_SESSION['uploadError']; ?>
                    </div>
                  </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </section>



    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer" style="margin-left: 0px;">
      <div class="text-center">
        <strong>Copyright &copy; 2016-2017 <a href="learningfromscratch.online">Job Portal</a>.</strong> All rights
        reserved.
      </div>
    </footer>

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../js/adminlte.min.js"></script>
</body>

</html>