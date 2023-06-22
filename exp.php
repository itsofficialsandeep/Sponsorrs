<?php

session_start();

if (isset($_SESSION['id_user']) || isset($_SESSION['id_company'])) {
  header("Location: index.php");
  exit();
}

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
  <link rel="stylesheet" href="css/AdminLTE.min.css">

  <meta name="google-signin-client_id"
    content="330753620578-cpd4l2mod2adti3vj39d99deo9targnk.apps.googleusercontent.com">

  <link rel="stylesheet" href="css/_all-skins.min.css">
  <!-- Custom -->
  <link rel="stylesheet" href="css/custom.css">
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

          <script src="https://apis.google.com/js/platform.js" async defer></script>
          <script src="https://accounts.google.com/gsi/client" async defer></script>
          <script>
            // webapge help   https://developers.google.com/identity/gsi/web/reference/js-reference#client_id
            window.onload = function () {
              var hash = window.location.hash;
              var token = hash.substring(hash.indexOf('access_token=') + 13, hash.indexOf('&'));
              if (token) {
                // Make API requests using the access token.
                console.log(token.toString);
              }

              $.ajax({
                type: "GET",
                url: "https://www.googleapis.com/youtube/v3/channels",
                data: {
                  part: "snippet,contentDetails,statistics",  //contentOwnerDetails,id,snippet,contentDetails,statistics,status
                  mine: true,
                  key: "AIzaSyDtNnCfUsHnnDc20U3hQ7_IOfq-RGVGAIg"
                },
                headers: {
                  Authorization: "Bearer " + token,
                  Accept: "application/json"
                },
                success: function (response) {
                  console.log(response);
                  alert(response.toString);
                },
                error: function (error) {
                  console.error(error);
                }
              });

            };

          </script>

          <!-- end of google login code -->
        </div>
      </nav>
    </header>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left: 0px;">

      <section class="content-header">
        <div class="container">
          <div id="loginbox" class="row latest-job margin-top-50 margin-bottom-20">
            <h1 class="text-center margin-bottom-20">Sign Up</h1>
            <div class="col-md-6 latest-job ">
              <div class="small-box bg-yellow padding-5">
                <div class="inner">
                  <h3 class="text-center">Candidates Login</h3>
                </div>
                <a href="login-candidates.php" class="small-box-footer">
                  Login <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-md-6 latest-job ">
              <div class="small-box bg-red padding-5">
                <div class="inner">
                  <h3 class="text-center">Company Login</h3>
                </div>
                <a href="login-company.php" class="small-box-footer">
                  Login <i class="fa fa-arrow-circle-right"></i>
                </a>
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
  <script src="js/adminlte.min.js"></script>
</body>

</html>