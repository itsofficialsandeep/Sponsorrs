// creator form handling for company
$(document).ready(function () {
  var full_name = "-";
  var email = "-";
  var phone_number = "-";

  var country = "-";
  var about_you = "-";
  var channel_category;
  var sponsorship_type = "-";
  var form_error = 0;

  // $("#password,#confirm_password").focusout(function(){
  //      confirm_passsword = $("#creator_confirm_password").val();
  //      password = $("#password").val();

  //     if((password.toString() == confirm_passsword.toString()) ){
  //         // form_error = false;
  //     }else{
  //         $('#alert_para').text("Make sure password is same").fadeOut( 4000 );
  //         // form_error = true;
  //     }
  // });

  $("#full-name").focusout(function (e) {
    full_name = $(this).val();
    console.log("1-" + form_error + "-" + full_name);

    if (!full_name.toString() || full_name.toString().length > 50) {
      $("#alert-text-full-name")
        .addClass("d-block")
        .removeClass("d-none")
        .fadeOut(4000);
      // form_error = true;
    }
  });

  $("#phone-number").focusout(function (e) {
    phone_number = $(this).val();
    console.log("2-" + form_error + "-" + phone_number);

    if (!phone_number || phone_number.length > 14 || phone_number.length < 10) {
      $("#alert-text-phone-number")
        .addClass("d-block")
        .removeClass("d-none")
        .fadeOut(4000);
      // form_error = true;
    } else {
      // form_error = false;
    }
  });

  $("#country").focusout(function (e) {
    country = $(this).val().toString();
    console.log("3-" + form_error + "-" + country);

    if (!country) {
      $("#alert-text-country")
        .addClass("d-block")
        .removeClass("d-none")
        .fadeOut(4000);
      // form_error = true;
    } else {
      // form_error = false;
    }
  });

  $("#about-you").focusout(function (e) {
    about_you = $(this).val();
    console.log("4-" + form_error + "-" + about_you);

    if (!about_you) {
      $("#alert-text-about-you")
        .addClass("d-block")
        .removeClass("d-none")
        .fadeOut(4000);
      // form_error = true;
    } else {
      // form_error = false;
    }
  });

  $("#channel-category").focusout(function (e) {
    channel_category = $(this).val();
    console.log("5-" + form_error + "-" + channel_category);

    if (channel_category == "-") {
      $("#alert-text-channel-category")
        .addClass("d-block")
        .removeClass("d-none")
        .fadeOut(4000);
      // form_error = true;
    } else {
      // form_error = false;
    }
  });

  $("#sponsorship-type").focusout(function (e) {
    sponsorship_type = $(this).val();
    console.log("5-" + form_error + "-" + sponsorship_type);

    if (sponsorship_type == "-") {
      $("#alert-text-sponsorship-type")
        .addClass("d-block")
        .removeClass("d-none")
        .fadeOut(4000);
      // form_error = true;
    } else {
      // form_error = false;
    }
  });

  // vasic detail updation
  $("#submit-basic-detail").click(function (event) {
    sponsorship_type = $("#sponsorship-type").val();
    channel_category = $("#channel-category").val();
    about_you = $("#about-you").val();
    country = $("#country").val();
    full_name = $("#full-name").val();
    phone_number = $("#phone-number").val();
    email = $("#email").val();
    username = $("#new-username").val();
    intro_video = $("#intro-video").val();
    benefit = $("#benefit").val();

    var FormData = {
      email: email,
      fullname: full_name,
      phone_number: phone_number,
      about_you: about_you,
      country: country,
      channel_category: channel_category,
      sponsorship_type: sponsorship_type,
      intro_video: intro_video,
      benefit: benefit,
      username: username,
      actionType: "updateBasicProfile",
    };

    $.ajax({
      dataType: "json",
      type: "POST",
      url: "../user/update-profile.php",
      data: FormData,
      success: function (response) {
        console.log(response);
        responseObj = response;
        if (responseObj.code == 200) {
          console.log("success status-" + responseObj.status.toString());
          //window.location.assign("company/index.php");
        } else {
          console.log("success status-" + responseObj.status.toString());
        }
      },
      error: function (error) {
        //oauth2SignIn();
        console.error(error);
      },
    });
  });

  $("#new-username").keyup(function (e) {
    var username = $("#new-username").val();

    var formData = {
      username: username,
      actionType: "checkUsername",
    };

    $.ajax({
      type: "POST",
      url: "../../user/update-profile.php",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.code == 200) {
          $("#alert-text-username")
            .removeClass("d-none")
            .removeClass("text-danger")
            .addClass("text-success")
            .text(response.message);
        } else {
          $("#alert-text-username")
            .removeClass("d-none")
            .removeClass("text-success")
            .addClass("text-danger")
            .text(response.message);
        }
      },
      beforeSend: function (params) {},
      error: function (error) {
        //console.error(error);
        $("#alert-text-username")
          .removeClass("d-none")
          .removeClass("text-success")
          .addClass("text-danger")
          .text("Something went wrong");
      },
    });
  });

  $("#submit-social").click(function (event) {
    var facebook_username = $("#facebook-username").val();
    var twitter_username = $("#twitter-username").val();
    var instagram_username = $("#instagram-username").val();
    var youtube_username_1 = $("#youtube-channel-1").val();
    var youtube_username_2 = $("#youtube-channel-2").val();
    var youtube_username_3 = $("#youtube-channel-3").val();
    var linkedin_username = $("#linkedin-username").val();
    var snapchat_username = $("#snapchat-username").val();
    var reddit_username = $("#reddit-username").val();
    var tiktok_username = $("#tiktok-username").val();
    var pinterest_username = $("#pinterest-username").val();
    var website = $("#website").val();

    var FormData = {
      email: email,
      facebook_username: facebook_username,
      twitter_username: twitter_username,
      instagram_username: instagram_username,
      youtube_username_1: youtube_username_1,
      youtube_username_2: youtube_username_2,
      youtube_username_3: youtube_username_3,
      linkedin_username: linkedin_username,
      snapchat_username: snapchat_username,
      reddit_username: reddit_username,
      tiktok_username: tiktok_username,
      pinterest_username: pinterest_username,
      website: website,
      actionType: "updateSocialProfile",
    };

    $("#submit-social").focusout(function () {
      $(this)
        .removeClass("btn-primary")
        .removeClass("btn-success")
        .addClass("btn-primary")
        .val("Save changes");
    });

    $.ajax({
      type: "POST",
      url: "../user/update-profile.php",
      data: FormData,
      success: function (responseObj) {
        if (responseObj.code == 200) {
          console.log("success status-" + responseObj.message);
          $("#submit-social")
            .removeClass("btn-warning")
            .addClass("btn-success")
            .val("Changes saved");
        } else {
          console.log("success status-" + responseObj.message);
        }
      },
      beforeSend: function (params) {
        $("#submit-social")
          .removeClass("btn-primary")
          .addClass("btn-warning")
          .val("Please wait...");
      },
      error: function (error) {
        //oauth2SignIn();
        console.error(error);
      },
    });
  });
});
//form handling for company registration end
