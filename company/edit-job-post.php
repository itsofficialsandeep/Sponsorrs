<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
if (empty($_SESSION['id_company'])) {
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
    function gtag() { dataLayer.push(arguments); }
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



  <script src="../js/tinymce/tinymce.min.js"></script>

  <script>tinymce.init({ selector: '#description', height: 300 });</script>


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
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="edit-company.php"><i class="fa fa-tv"></i> My Company</a></li>
                    <li class="active"><a href="create-job-post.php"><i class="fa fa-file-o"></i> Create Job Post</a>
                    </li>
                    <li><a href="my-job-post.php"><i class="fa fa-file-o"></i> My Job Post</a></li>
                    <li><a href="job-applications.php"><i class="fa fa-file-o"></i> Job Application</a></li>
                    <li><a href="mailbox.php"><i class="fa fa-envelope"></i> Mailbox</a></li>
                    <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                    <li><a href="resume-database.php"><i class="fa fa-user"></i> Resume Database</a></li>
                    <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-9 bg-white padding-2">
              <h2><i>Edit Job Post</i></h2>
              <div class="row">
                <form method="post" action="update-job-post.php">
                  <?php
                  $sql = "SELECT * FROM sponsorships WHERE sponsorship_id=$_GET[id]";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      ?>
                      <div class="col-md-12 latest-job ">
                        <div class="form-group">
                          <input class="form-control input-lg" type="text" id="sponsorship_title" name="sponsorship_title"
                            placeholder="Job Title" value="<?php echo $row['sponsorship_title']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="country" class="form-label">You are sponsoring a:</label>
                          <select class="form-control input-lg form-select" id="country" required="" name="product">
                            <option value="1" <?php if ($row['service'] == 1) {
                              echo "selected";
                            } ?>>Product</option>
                            <option value="2" <?php if ($row['service'] == 2) {
                              echo "selected";
                            } ?>>Service</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="country" class="form-label">Category </label>
                          <select class="form-control input-lg form-select" id="country" required="" name="category">
                            <option value="1" <?php if ($row['adcategory'] == 1) {
                              echo "selected";
                            } ?>>Tech</option>
                            <option value="2" <?php if ($row['adcategory'] == 2) {
                              echo "selected";
                            } ?>>Commercial</option>
                            <option value="3" <?php if ($row['adcategory'] == 3) {
                              echo "selected";
                            } ?>>Other</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="country" class="form-label">Ad Type</label>
                          <select class="form-control input-lg form-select" id="country" required="" name="adtype">
                            <option value="1" <?php if ($row['adtype'] == 1) {
                              echo "selected";
                            } ?>>Type 1</option>
                            <option value="2" <?php if ($row['adtype'] == 2) {
                              echo "selected";
                            } ?>>Type 2</option>
                            <option value="3" <?php if ($row['adtype'] == 3) {
                              echo "selected";
                            } ?>>Type 3</option>
                            <option value="4" <?php if ($row['adtype'] == 4) {
                              echo "selected";
                            } ?>>Type 4</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <textarea class="form-control input-lg" id="description" name="description"
                            placeholder="Job Description"><?php echo $row['description']; ?></textarea>
                        </div>
                        <div class="form-group">
                          <input type="number" class="form-control  input-lg" id="minimumsalary" min="1000"
                            autocomplete="off" name="minimumsalary" placeholder="Minimum Salary" required=""
                            value="<?php echo $row['minimumsalary']; ?>">
                        </div>
                        <div class="form-group" style="display: none;">
                          <input type="number" class="form-control  input-lg" id="offer_price" name="sponsorship_id"
                            placeholder="Maximum Salary" required="" value="<?php echo $row['sponsorship_id']; ?>">
                        </div>
                        <div class="form-group" style="display: none;">
                          <input type="number" class="form-control  input-lg" id="experience" autocomplete="off"
                            name="experience" placeholder="Experience (in Years) Required" required="" value="1">
                        </div>
                        <div class="form-group" style="display: none;">
                          <input type="text" class="form-control  input-lg" id="qualification" name="qualification"
                            placeholder="Qualification Required" required="" value="1">
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-flat btn-success">Update</button>
                        </div>
                      </div>
                      <?php
                    }
                  }
                  ?>
                </form>
              </div>

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