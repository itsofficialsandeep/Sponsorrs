// don't forget to restrict youtube api to sponsorr.in only as it was exposed to js validator once.

defaultBox();

// $("#creator_signup_box").css("display", "block");    //none
// $("#company_signup_box").css("display", "none");    //delete
// $("#signinbox").css("display","none");
// $(".tryagain_signingup").css("display","none");

$("#companysignuptab").click(function (e) {
  $("#company_signup_box").css("display", "block"); //block
  $("#creator_signup_box").css("display", "none"); //none
  $("#signinbox").css("display", "none");
});

$("#creatorsignuptab").click(function (e) {
  $("#company_signup_box").css("display", "none"); //none
  $("#creator_signup_box").css("display", "block"); //block
  $("#signinbox").css("display", "none");
});

$("#defaultlogintab").click(function (e) {
  $("#company_signup_box").css("display", "none"); //none
  $("#creator_signup_box").css("display", "none"); //block
  $("#signinbox").css("display", "block");
});

// Parse query string to see if page request is coming from OAuth 2.0 server.
var params = {};
var regex = /([^&=]+)=([^&]*)/g,
  m;
while ((m = regex.exec(location.href))) {
  params[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
}
if (Object.keys(params).length > 0) {
  localStorage.setItem("authInfo", JSON.stringify(params));
}
// window.history.pushState({}, document.title, "/" + "profile.html");
let info = JSON.parse(localStorage.getItem("authInfo"));
console.log(info["access_token"]);
console.log(info["expires_in"]);

// declare variable to store information fetched by both api which will be required to create account
var title = "-";
var channelId = "-";
var description = "-";
var customUrl = "-";
var publishedAt = "-";
var thumbnailUrl = "-";
var country = "-";
var likes = "-";
var uploads = "-";
var viewsCount = "-";
var subscriberCount = "-";
var hiddenSubscriberCount = "-";
var videoCount = "-";
var privacyStatus = "-";
var isLinked = "-";
var longUploadStatus = "-";
var madeForKids = "-";
var channelContent = "-";

var given_name = "-";
var name = "-";
var pictures = "-";
var family_name = "-";
var locale = "-";
var sub = "-";
var email = "-";
var email_verified = "-";
var previous_sponsor = "-";

fetch("https://www.googleapis.com/oauth2/v3/userinfo", {
  async: false,
  headers: {
    Authorization: `Bearer ${info["access_token"]}`,
  },
})
  .then((data) => data.json())
  .then((info) => {
    console.log("2==" + JSON.stringify(info));
    localStorage.setItem("gid", JSON.stringify(info));

    given_name = info.given_name ? info.given_name : "-";
    name = info.name ? info.name : "-";
    pictures = info.picture ? info.picture : "-";
    family_name = info.family_name ? info.family_name : "-";
    locale = info.locale ? info.locale : "-";
    email = info.email ? info.email : "-";
    email_verified = info.email_verified ? 1 : 0;
    sub = info.sub ? info.sub : "-";

    //var i = result ? 1 : 0;     // convet=rt booelan into int
    //parseInt() // string to int

    //info.error   // invalid_request
    //info.error_description   // 'Invalid Credentials'
  });

var currentChannelData = localStorage.getItem("resgiteringChannel");

// make request to api for new channel resiteration
if (!currentChannelData) {
  $.ajax({
    async: false,
    type: "GET",
    url: "https://www.googleapis.com/youtube/v3/channels",
    data: {
      part: "contentOwnerDetails,id,snippet,contentDetails,statistics,status",
      mine: true,
      key: "AIzaSyC2Fx0YkEKet0JUrESSWBhKSTGMA3KPyik",
    },
    headers: {
      Authorization: `Bearer ${info["access_token"]}`,
      Accept: "application/json",
    },
    success: function (response) {
      console.log(response);

      var stringifyJSONResponse = JSON.stringify(response);
      
      console.log(stringifyJSONResponse);

      channelContent = stringifyJSONResponse;

      var responseObj = JSON.parse(stringifyJSONResponse);

      channelId = responseObj.items[0].id;
      title = responseObj.items[0].snippet.title;
      $("#channel_display_heading").append(title);

      console.log("title == " + title);

      description = responseObj.items[0].snippet.description;
      customUrl = responseObj.items[0].snippet.customUrl;

      if (!customUrl) {
        // do nothing
      } else {
        //saving the successfull channel request for later use
        //it will help unncesary request to the api
        localStorage.setItem("resgiteringChannel", stringifyJSONResponse);
      }

      publishedAt = responseObj.items[0].snippet.publishedAt;
      thumbnailUrl = responseObj.items[0].snippet.thumbnails.default.url;
      $("#channel_display_img").attr("src", thumbnailUrl);

      console.log("thumbnailUrl == " + thumbnailUrl);

      if (!responseObj.items[0].snippet.country) {
        country = "-";
      } else {
        country = responseObj.items[0].snippet.country;
      }

      likes = responseObj.items[0].contentDetails.relatedPlaylists.likes;
      uploads = responseObj.items[0].contentDetails.relatedPlaylists.uploads;

      viewsCount = responseObj.items[0].statistics.viewCount;
      viewsCount = parseInt(viewsCount);

      subscriberCount = responseObj.items[0].statistics.subscriberCount;
      subscriberCount = parseInt(subscriberCount);

      hiddenSubscriberCount =
        responseObj.items[0].statistics.hiddenSubscriberCount;
      hiddenSubscriberCount = hiddenSubscriberCount ? 1 : 0;
      console.log("hiddenSubscriberCount == " + hiddenSubscriberCount);

      videoCount = responseObj.items[0].statistics.videoCount;
      videoCount = parseInt(videoCount);

      privacyStatus = responseObj.items[0].status.privacyStatus;

      isLinked = responseObj.items[0].status.isLinked;
      isLinked = isLinked ? 1 : 0;

      longUploadStatus = responseObj.items[0].status.longUploadsStatus
        ? responseObj.items[0].status.longUploadsStatus
        : "-";

      madeForKids = responseObj.items[0].status.madeForKids;
      madeForKids = parseInt(madeForKids);
    },
    error: function (error) {
      //oauth2SignIn();
      console.error(error);
    },
  });

  // when channel data is avaiable in localstorage
} else {
  channelContent = currentChannelData;

  var responseObj = JSON.parse(channelContent);

  channelId = responseObj.items[0].id;
  title = responseObj.items[0].snippet.title;
  $("#channel_display_heading").append(title);

  console.log("title == " + title);

  description = responseObj.items[0].snippet.description;
  customUrl = responseObj.items[0].snippet.customUrl;

  publishedAt = responseObj.items[0].snippet.publishedAt;
  thumbnailUrl = responseObj.items[0].snippet.thumbnails.default.url;
  $("#channel_display_img").attr("src", thumbnailUrl);

  console.log("thumbnailUrl == " + thumbnailUrl);

  if (!responseObj.items[0].snippet.country) {
    country = "-";
  } else {
    country = responseObj.items[0].snippet.country;
  }

  likes = responseObj.items[0].contentDetails.relatedPlaylists.likes;
  uploads = responseObj.items[0].contentDetails.relatedPlaylists.uploads;

  viewsCount = responseObj.items[0].statistics.viewCount;
  viewsCount = parseInt(viewsCount);

  subscriberCount = responseObj.items[0].statistics.subscriberCount;
  subscriberCount = parseInt(subscriberCount);

  hiddenSubscriberCount = responseObj.items[0].statistics.hiddenSubscriberCount;
  hiddenSubscriberCount = hiddenSubscriberCount ? 1 : 0;
  console.log("hiddenSubscriberCount == " + hiddenSubscriberCount);

  videoCount = responseObj.items[0].statistics.videoCount;
  videoCount = parseInt(videoCount);

  privacyStatus = responseObj.items[0].status.privacyStatus;

  isLinked = responseObj.items[0].status.isLinked;
  isLinked = isLinked ? 1 : 0;

  longUploadStatus = responseObj.items[0].status.longUploadsStatus
    ? responseObj.items[0].status.longUploadsStatus
    : "-";

  madeForKids = responseObj.items[0].status.madeForKids;
  madeForKids = parseInt(madeForKids);
}

// creator form handling for creator
$(document).ready(function () {
  var formError = true; // form can only be submitted if this value is false

  var password;
  var confirm_passsword;
  var previous_sponsor;
  var channel_category;
  var sponsor_type;

  $("#creator_password,#creator_confirm_password").keyup(function () {
    password = $("#creator_password").val();
    confirm_passsword = $("#creator_confirm_password").val();
    if (password.toString() == confirm_passsword.toString()) {
      formError = false;
    } else {
      $("#alert_para")
        .text("Make sure password is same")
        .css("color", "red")
        .show()
        .fadeOut(4000);
      formError = true;
    }
  });

  $("#previous_sponsor").focusout(function (e) {
    previous_sponsor = $("#previous_sponsor").val();
    if (
      !previous_sponsor.toString() ||
      previous_sponsor.toString().length < 20
    ) {
      $("#alert_para")
        .text("Please write good pitching line in the highlighted box")
        .css("color", "red")
        .show()
        .fadeOut(4000);
      formError = true;
    } else {
      formError = false;
    }
  });

  $("#channel_category").focusout(function (e) {
    channel_category = $("#channel_category").val();
    if (channel_category.toString() == "-") {
      $("#alert_para")
        .text("Please choose a channel category.")
        .css("color", "red")
        .show()
        .fadeOut(4000);
      formError = true;
    } else {
      formError = false;
    }
  });

  $("#sponsor_type").focusout(function (e) {
    sponsor_type = $("#sponsor_type").val();
    if (sponsor_type.toString() == "-") {
      $("#alert_para")
        .text("Please choose a sponsor type.")
        .css("color", "red")
        .show()
        .fadeOut(4000);
      formError = true;
    } else {
      formError = false;
    }
  });

  $("#creator_form_submit").hover(function (event) {
    console.log(formError);
    if (formError) {
      $("#creator_form_submit").attr("disabled", "true");
    } else {
      $("#creator_form_submit").attr("disabled", "false");
    }
  });

  $("#creator_form_submit").click(function (event) {
    if (formError) {
      $("#alert_para")
        .text("There is error in form..please check")
        .css("color", "red")
        .show()
        .fadeOut(4000);
      $("#creator_form_submit").css("border", "1px solid red");
    } else {
      var formData = {
        creator_email: email,
        creator_password: $("#creator_password").val(),

        previous_sponsor: $("#previous_sponsor").val(),
        channel_category: $("#channel_category").val(),
        sponsor_type: $("#sponsor_type").val(),
        given_name: given_name,
        name: name,
        pictures: pictures,
        family_name: family_name,
        locale: locale,
        sub: sub,
        channel_id: channelId,
        email_verified: email_verified,

        title: title,
        description: description,
        customUrl: customUrl,
        publishedAt: publishedAt,
        thumbnailUrl: thumbnailUrl,
        country: country,
        likes: likes,
        uploads: uploads,
        viewsCount: viewsCount,
        subscriberCount: subscriberCount,
        hiddenSubscriberCount: hiddenSubscriberCount,
        videoCount: videoCount,
        privacyStatus: privacyStatus,
        isLinked: isLinked,
        longUploadStatus: longUploadStatus,
        madeForKids: madeForKids,
        channelContent: channelContent,
      };

      $.ajax({
        async: false,
        type: "POST",
        url: "http://localhost/tmisc/adduser2.php",
        data: formData,
        // headers: {
        //     Authorization: `Bearer ${info['access_token']}`,
        //     Accept: "application/json"
        // },
        success: function (response) {
          responseObj = JSON.parse(response.toString());
          if (responseObj.code == 1) {
            console.log("success status-" + responseObj.status.toString());
            window.location.assign("user/index.php");

            localStorage.getItem("resgiteringChannel");
          } else {
            if (responseObj.code == 3) {
              $("#signinbox").css("display", "block");
              $("#creator_signup_box,#company_signup_box").css(
                "display",
                "none"
              );
            }
            if (responseObj.code == 2) {
              $(".ori").css("display", "none");
              $(".tryagain_signingup").css("display", "block");
            }
          }
        },
        error: function (error) {
          //oauth2SignIn();
          console.error(error);
        },
      })
        .done(function (data) {
          console.log(data);
        })
        .fail(function (data) {});
    }
    //event.preventDefault();
  });
});

// creator form handling for company
$(document).ready(function () {
  var given_name = "-";
  var name = "-";
  var pictures = "-";
  var family_name = "-";
  var locale = "-";
  var sub = "-";
  var email = "-";
  var email_verified = false;
  var previous_sponsor = "-";

  var gidJSON = JSON.parse(localStorage.getItem("gid"));

  given_name = gidJSON.given_name ? gidJSON.given_name : "-";
  name = gidJSON.name ? gidJSON.name : "-";
  pictures = gidJSON.picture ? gidJSON.picture : "-";
  family_name = gidJSON.family_name ? gidJSON.family_name : "-";
  locale = gidJSON.locale ? gidJSON.locale : "-";
  email = gidJSON.email ? gidJSON.email : "-";
  email_verified = gidJSON.email_verified ? 1 : 0;
  sub = gidJSON.sub ? gidJSON.sub : "-";

  var company_name;
  var company_password;
  var company_confirm_passsword;
  var company_phone;
  var company_about;
  var industry_type;
  var company_country;

  $("#company_display_img").attr("src", gidJSON.picture);
  $("#company_email").text(gidJSON.email);

  var company_error = false; // form can only be submitted if this value is false

  $("#company_password,#company_confirm_password").focusout(function () {
    company_confirm_passsword = $("#creator_confirm_password").val();
    company_password = $("#company_password").val();

    if (company_password.toString() == company_confirm_passsword.toString()) {
      // company_error = false;
    } else {
      $("#company_alert_para")
        .text("Make sure password is same")
        .css("color", "red")
        .show()
        .fadeOut(4000);
      // company_error = true;
    }
  });

  $("#company_about").focusout(function (e) {
    company_about = $(this).val();
    console.log("1-" + company_error + "-" + company_about);

    if (!company_about.toString() || company_about.toString().length < 20) {
      $("#company_alert_para")
        .text("Please describe your company well.")
        .css("color", "red")
        .show()
        .fadeOut(4000);
      // company_error = true;
    } else {
      // company_error = false;
    }
  });

  $("#company_name").focusout(function (e) {
    company_name = $(this).val();
    console.log("2-" + company_error + "-" + company_name);

    if (!company_name) {
      $("#company_alert_para")
        .text("Please enter your company name.")
        .css("color", "red")
        .show()
        .fadeOut(4000);
      // company_error = true;
    } else {
      // company_error = false;
    }
  });

  $("#company_phone").focusout(function (e) {
    company_phone = $(this).val().toString();
    console.log("3-" + company_error + "-" + company_phone);

    if (
      !company_phone ||
      company_phone.length > 10 ||
      company_phone.length < 10
    ) {
      $("#company_alert_para")
        .text("Invalid Phone Number")
        .css("color", "red")
        .show()
        .fadeOut(4000);
      // company_error = true;
    } else {
      // company_error = false;
    }
  });

  $("#industry_type").focusout(function (e) {
    industry_type = $(this).val();
    console.log("4-" + company_error + "-" + industry_type);

    if (industry_type == "-") {
      $("#company_alert_para")
        .text("Please choose industry type..")
        .css("color", "red")
        .show()
        .fadeOut(4000);
      // company_error = true;
    } else {
      // company_error = false;
    }
  });

  $("#company_country").focusout(function (e) {
    company_country = $(this).val();
    console.log("5-" + company_error + "-" + company_country);

    if (company_country == "-") {
      $("#company_alert_para")
        .text("Pleae choose a country..")
        .css("color", "red")
        .show()
        .fadeOut(4000);
      // company_error = true;
    } else {
      // company_error = false;
    }
  });

  // $("#company_form_submit").hover(function (event) {
  //                         console.log(company_error);
  //     if (company_error) {
  //         $("#company_form_submit").attr("disabled","true");
  //         $('#company_alert_para').text("There is error in form..please check").css("color","red").show().fadeOut( 4000 );
  //     }else{
  //          $("#company_form_submit").attr("disabled","false");
  //     }
  // });

  $("#company_form_submit").click(function (event) {
    if (company_error) {
      $("#company_alert_para")
        .text("There is error in form..please check")
        .css("color", "red")
        .show()
        .fadeOut(4000);
      $("#company_form_submit").css("border", "1px solid red");
    } else {
      var companyFormData = {
        company_email: email,
        company_password: $("#company_password").val(),

        company_name: company_name,
        company_phone: company_phone,
        company_about: company_about,
        company_industry: industry_type,
        company_country: company_country,
        company_password: company_password,

        name: name,
        given_name: given_name,
        family_name: family_name,
        locale: locale,
        sub: sub,
        email_verified: email_verified,
        picture: pictures,
      };

      $.ajax({
        async: false,
        type: "POST",
        url: "misc/addcompany.php",
        data: companyFormData,
        // headers: {
        //     Authorization: `Bearer ${info['access_token']}`,
        //     Accept: "application/json"
        // },
        success: function (response) {
          console.log("companyFormData ==" + JSON.stringify(companyFormData));
          responseObj = JSON.parse(response.toString());
          if (responseObj.code == 9) {
            console.log("success status-" + responseObj.status.toString());
            window.location.assign("company/index.php");
          } else {
            $("#try_again_company_box").css("display", "block");
            $("default_company_submit_box").css("display", "none");
            $("#try_again_company_submit_button").onclick(function () {
              localStorage.setItem("formOpen", "company");
              signInTryAgain();
            });
          }
        },
        error: function (error) {
          //oauth2SignIn();
          console.error(error);
        },
      })
        .done(function (data) {
          console.log(data);
        })
        .fail(function (data) {});
    }
    //event.preventDefault();
  });
});
//form handling for company registration end

function decodeJwtResponse(token) {
  var base64Url = token.split(".")[1];
  var base64 = base64Url.replace(/-/g, "+").replace(/_/g, "/");
  var jsonPayload = decodeURIComponent(
    window
      .atob(base64)
      .split("")
      .map(function (c) {
        return "%" + ("00" + c.charCodeAt(0).toString(16)).slice(-2);
      })
      .join("")
  );

  return JSON.parse(jsonPayload);
}

function signInAsCreator() {
  $("#login_submit_as_creator").val("Processing...");
  $.ajax({
    async: false,
    type: "POST",
    url: "misc/checklogin.php",
    data: {
      loginAs: "creator",
      email: $("#login_email").val(),
      password: $("#login_password").val(),
    },
    success: function (response) {
      $("#login_submit_as_creator").val("Sign-In as Creator");
      //$("#login_submit_as_creator").removeAttr("disabled");
      responseObj = JSON.parse(response.toString());
      if (responseObj.code == 6 || responseObj.code == 7) {
        console.log("success status-" + responseObj.status.toString());
        window.location.assign("user/index.php");
      } else {
        if (responseObj.code == 5) {
          $("#alert_signinwithpassword").text(responseObj.message);
          $("#alert_signinwithpassword").css("display", "block");
          $("#creator_signup_box,#company_signup_box").css("display", "none");
        }
        if (responseObj.code == 8) {
          $("#alert_signinwithpassword").text(responseObj.message);
          $(".ori").css("display", "none");
          $(".tryagain_signingup").css("display", "none");
        }
        if (responseObj.code == 14) {
          $("#alert_signinwithpassword").text(responseObj.message);
          $(".ori").css("display", "none");
          $(".tryagain_signingup").css("display", "none");
        }
        if (responseObj.code == 20) {
          $("#alert_signinwithpassword").text(responseObj.message);
          $(".ori").css("display", "none");
          $(".tryagain_signingup").css("display", "none");
        }
      }
    },
  });
}

function signInAsCompany() {
  $("#login_submit_as_company").val("Processing...");
  //$("#login_submit_as_company").attr("disabled","true");
  $.ajax({
    async: false,
    type: "POST",
    url: "misc/checklogin.php",
    data: {
      loginAs: "company",
      email: $("#login_email").val(),
      password: $("#login_password").val(),
    },
    success: function (response) {
      $("#login_submit_as_company").val("Sign-In as company");
      // $("#login_submit_as_company").removeAttr("disabled");
      responseObj = JSON.parse(response.toString());
      if (responseObj.code == 12) {
        console.log("success status-" + responseObj.status.toString());
        window.location.assign("company/index.php");
      } else {
        if (responseObj.code == 10) {
          $("#alert_signinwithpassword").text(responseObj.message);
          $("#alert_signinwithpassword").show().fadeOut(4000);
          $("#creator_signup_box,#company_signup_box").css("display", "none");
        }
        if (responseObj.code == 11) {
          $("#alert_signinwithpassword")
            .text(responseObj.message)
            .show()
            .fadeOut(4000);
          $(".ori").css("display", "none");
          $(".tryagain_signingup").css("display", "none");
        }
        if (responseObj.code == 13) {
          $("#alert_signinwithpassword")
            .text(responseObj.message)
            .show()
            .fadeOut(4000);
          $(".ori").css("display", "none");
          $(".tryagain_signingup").css("display", "none");
        }
        if (responseObj.code == 15) {
          $("#alert_signinwithpassword")
            .text(responseObj.message)
            .show()
            .fadeOut(4000);
          $(".ori").css("display", "none");
          $(".tryagain_signingup").css("display", "none");
        }
        if (responseObj.code == 21) {
          $("#alert_signinwithpassword")
            .text(responseObj.message)
            .show()
            .fadeOut(4000);
          $(".ori").css("display", "none");
          $(".tryagain_signingup").css("display", "none");
        }
      }
    },
  });
}

function signInTryAgain() {
  // Google's OAuth 2.0 endpoint for requesting an access token
  var oauth2Endpoint = "https://accounts.google.com/o/oauth2/v2/auth";

  // Create <form> element to submit parameters to OAuth 2.0 endpoint.
  var form = document.createElement("form");
  form.setAttribute("method", "GET"); // Send as a GET request.
  form.setAttribute("action", oauth2Endpoint);

  // Parameters to pass to OAuth 2.0 endpoint.
  var params = {
    client_id:
      "397106461857-a6cs9umc5g8h1qfmtl04j0fapamtsefa.apps.googleusercontent.com",
    redirect_uri: "http://localhost/account.php",
    response_type: "token",
    scope:
      "https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/youtube.readonly https://www.googleapis.com/auth/userinfo.email",
    include_granted_scopes: "true",
    state: "pass-through-value",
  };


  // Add form parameters as hidden input values.
  for (var p in params) {
    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", p);
    input.setAttribute("value", params[p]);
    form.appendChild(input);
  }

  // Add form to page and submit it to open the OAuth 2.0 endpoint.
  document.body.appendChild(form);
  form.submit();
}

function defaultBox() {
  // const params = new Proxy(new URLSearchParams(window.location.search), {
  //   get: (searchParams, prop) => searchParams.get(prop),
  // });
  // // Get the value of "some_key" in eg "https://example.com/?some_key=some_value"
  // let value = params.activity; // "some_value"

  var value = localStorage.getItem("formOpen");

  console.log(value);
  if (value == "creator") {
    $("#company_signup_box").css("display", "none"); //none
    $("#creator_signup_box").css("display", "block"); //block
    $("#signinbox").css("display", "none");
  }
  if (value == "company") {
    $("#company_signup_box").css("display", "block"); //none
    $("#creator_signup_box").css("display", "none"); //block
    $("#signinbox").css("display", "none");
  }
  if (value == "signin" || !value) {
    $("#company_signup_box").css("display", "none"); //none
    $("#creator_signup_box").css("display", "none"); //block
    $("#signinbox").css("display", "block");
  }
}
