<!DOCTYPE html>
<html lang="en">

<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-KRL58MWH94"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-KRL58MWH94');
</script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">

  <style>
    #content,
    #authorize-button,
    #signout-button {
      display: none
    }
  </style>

  <title>YouTube Channel Data</title>
</head>

<body>
  <nav class="black">
    <div class="nav-wrapper">
      <div class="container">
        <a href="#!" class="brand-logo">YouTube Channel Data</a>
      </div>
    </div>
  </nav>
  <br>
  <section>
    <div class="container">
      <p>Log In With Google</p>
      <button class="btn red" id="authorize-button">Log In</button>
      <button class="btn red" id="signout-button">Log Out</button>
      <br>
      <div id="content">
        <div class="row">
          <div class="col s6">
            <form id="channel-form">
              <div class="input-field col s6">
                <input type="text" placeholder="Enter Channel Name" id="channel-input">
                <input type="submit" value="Get Channel Data" class="btn grey">
              </div>
            </form>
          </div>
          <div id="channel-data" class="col s6"></div>
        </div>
        <div class="row" id="video-container"></div>
      </div>
    </div>
  </section>

  <?php

  //  $response = file_get_contents('https://www.googleapis.com/youtube/v3/channels?id=UC_x5XG1OV2P6uZZ5FSM9Ttw&part=snippet&key=AIzaSyB78E8AD89lKhEEBYKZeyQbzRASL2Tkxts');
  $response = file_get_contents('https://www.googleapis.com/youtube/v3/channels?id=UC_x5XG1OV2P6uZZ5FSM9Ttw&part=snippet&key=AIzaSyB78E8AD89lKhEEBYKZeyQbzRASL2Tkxts');

  print_r($response);

  ?>


  snippet,contentDetails,fileDetails,player,processingDetails,recordingDetails,statistics,status,suggestions,topicDetails

  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
  <script src="main.js"></script>
  <script async defer src="https://apis.google.com/js/api.js" onload="this.onload=function(){};handleClientLoad()" onreadystatechange="if (this.readyState === 'complete') this.onload()">
  </script>
</body>

</html>