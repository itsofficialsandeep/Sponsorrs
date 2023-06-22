// it refers to => sponsorrs.com

//  when the search button is clicked on the home page then
// it will take you to the search.php file with the parameters

$("#search").click(function (e) {
  e.preventDefault();

  var category = $("#category").val();
  var searchType = $("#searchtype").val();

  switch (searchType) {
    case "0":
      searchType = "sponsorships";
      break;

    case "1":
      searchType = "brands";
      break;

    case "2":
      searchType = "creators";
      break;

    default:
      searchType = "sponsorships";
      break;
  }

  var url = "/search.php?searchtype=" + searchType + "&category=" + category;

  console.log(url);

  window.location.href = url;
});

// it will decide which form will be opened on the login page
$(document).ready(function () {
  $("#signupAsCompany, .signupAsCompany").click(function (e) {
    e.preventDefault();

    localStorage.setItem("formOpen", "company");
    signInTryAgain();
  });
  $("#signupAsCreator,.signupAsCreator").click(function (e) {
    localStorage.setItem("formOpen", "creator");
    e.preventDefault();
    signInTryAgain();
  });
  $("#signInAccount,.signInAccount").click(function (e) {
    localStorage.setItem("formOpen", "signin");
    e.preventDefault();
    signInTryAgain();
  });
});

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
      "330753620578-cpd4l2mod2adti3vj39d99deo9targnk.apps.googleusercontent.com",
    redirect_uri: "https://sponsorrs.com/account.php",
    response_type: "token",
    scope:
      "https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/youtube.readonly https://www.googleapis.com/auth/userinfo.email",
    include_granted_scopes: "true",
    state: "pass-through-value",
  };

  //sub for business news poin = '113346899649004252893
  // sub for google plus page = "110083525952718550385" "wood-art-0171@pages.plusgoogle.com"
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

//============================================================================
$(document).on(
  "click",
  ".saveCompany, .applyBrands, .save_sponsorships,.saveTheSponsorship, .applyTheSponsorship, .apply_sponsorships, .save, .applyCreators",
  function (e) {
    e.preventDefault();

    console.log("init");

    // get the type of action
    var action = $(this).attr("data-action");

    //localStorage.setItem("isLogin", "false");
    localStorage.setItem("isLogin", "true");
    const isLogin = localStorage.getItem("isLogin");

    // if user is already logged in
    if (isLogin == "true") {
      // if user is saving Creators
      if (action == "saveCreators") {
        // get the required info to make the action successfull
        var selector = $(this).attr("data-id");
        var ID = $(this).attr("data-token");

        var saved_creator = {
          ID: ID,
          actionType: 1,
        };

        console.log("--" + ID);

        // call the server
        $.ajax({
          type: "POST",
          url: "/profile-functions/for-index.php",
          data: saved_creator,
          success: function (response) {
            console.log(response);
            if (response.code == 200) {
              $(selector).attr(
                "class",
                "save bi bi-bookmark-fill text-primary"
              );
              console.log(response);
            } else {
              $(selector).attr("class", "save bi bi-bookmark text-primary");
            }
          },
          error: function (error) {
            console.error(error);
          },
        });
      }

      // if user is saving Sponsorships
      if (action == "saveSponsorships") {
        // get the required info to make action successful
        var selector = $(this);
        var ID = $(this).attr("data-token");

        var saved_sponsorship = {
          ID: ID,
          actionType: 2,
        };

        //call the server
        $.ajax({
          type: "POST",
          url: "/profile-functions/for-index.php",
          data: saved_sponsorship,
          success: function (response) {
            console.log(response);
            if (response.code == 200) {
              $(selector).attr(
                "class",
                "save_sponsorships bi bi-bookmark-fill text-primary"
              );
              console.log(response);
            } else {
              $(selector).attr(
                "class",
                "save_sponsorships bi bi-bookmark text-primary"
              );
            }
          },
          error: function (error) {
            console.error(error);
          },
        });
      }

      // if user is saving Sponsorship
      // this is for particularly button on sponsorship-detail.php
      // which is present on the top-right side of the page

      if (action == "saveTheSponsorship") {
        // get the required info to make action successful
        var selector = $(this);
        var ID = $(this).attr("data-token");

        var saved_sponsorship = {
          ID: ID,
          actionType: 2,
        };

        //call the server
        $.ajax({
          type: "POST",
          url: "/profile-functions/for-index.php",
          data: saved_sponsorship,
          success: function (response) {
            console.log(response);
            if (response.code == 200) {
              $(selector).html(
                '<i class="bi bi-bookmark-check-fill me-2"></i>Saved'
              );
              console.log(response);
            } else {
              $(selector).html('<i class="bi bi-bookmark me-2"></i>Save');
            }
          },
          error: function (error) {
            console.error(error);
          },
        });
      }

      // if the user is saving brand
      if (action == "saveBrands") {
        // get the required info
        const selector5 = $(this);
        var ID = $(this).attr("data-token");

        var saved_creator = {
          ID: ID,
          actionType: 4,
        };

        // call the server
        $.ajax({
          type: "POST",
          url: "/profile-functions/for-index.php",
          data: saved_creator,
          success: function (response) {
            console.log(response);
            if (response.code == 200) {
              $(selector5).attr(
                "class",
                "saveCompany bi bi-bookmark-fill text-primary"
              );
              console.log(response);
            } else {
              $(selector5).attr(
                "class",
                "saveCompany bi bi-bookmark text-primary"
              );
            }
          },
          error: function (error) {
            console.error(error);
          },
        });
      }

      // if the user is saving brand [this is specifically for
      // the button that appear on the top-right side of the brand-detail.php]
      if (action == "saveTheBrand") {
        // get the required info
        const selector5 = $(this);
        var ID = $(this).attr("data-token");

        var saved_creator = {
          ID: ID,
          actionType: 4,
        };

        // call the server
        $.ajax({
          type: "POST",
          url: "/profile-functions/for-index.php",
          data: saved_creator,
          success: function (response) {
            console.log(response);
            if (response.code == 200) {
              $(selector5).html(
                '<i class="bi bi-bookmark-check-fill me-2"></i>Saved'
              );
              console.log(response);
            } else {
              $(selector5).html('<i class="bi bi-bookmark me-2"></i>Save');
            }
          },
          error: function (error) {
            console.error(error);
          },
        });
      }

      // if the user is apply for sponsorship
      if (action == "applySponsorships") {
        // get the required info
        const selector4 = $(this);
        var ID = $(this).attr("data-token");

        var saved_creator = {
          ID: ID,
          actionType: 3,
        };

        // call the server
        $.ajax({
          type: "POST",
          url: "/profile-functions/for-index.php",
          data: saved_creator,
          success: function (response) {
            console.log(response);
            $(selector4).parent().html(response);
          },
          error: function (error) {
            console.error(error);
          },
        });
      }

      // if the user is apply for sponsorship
      if (action == "applyTheSponsorship") {
        // get the required info
        const selector4 = $(this);
        var ID = $(this).attr("data-token");

        var saved_creator = {
          ID: ID,
          actionType: 3,
        };

        // call the server
        $.ajax({
          type: "POST",
          url: "/profile-functions/for-index.php",
          data: saved_creator,
          success: function (response) {
            console.log(response);
            $(selector4).text("Applied");
            if (response.code == 400) {
              $(selector4).text("Failed");
            }
          },
          error: function (error) {
            console.error(error);
          },
        });
      }

      // if user is applying Creators
      if (action == "applyCreators") {
        // get the required info to make the action successfull
        var selector = $(this);
        var ID = $(this).attr("data-token");

        console.log(ID);

        var saved_creator = {
          ID: ID,
          actionType: 5,
        };

        // call the server
        $.ajax({
          type: "POST",
          url: "/profile-functions/for-index.php",
          data: saved_creator,
          success: function (response) {
            console.log(response);
            if (response.code == 200) {
              $(selector).text("Applied");
            } else {
              $(selector).text("Apply");
            }
          },
          error: function (error) {
            console.error(error);
          },
        });
      }

      // if user is applying Creators
      if (action == "applyBrands") {
        // get the required info to make the action successfull
        var selector = $(this);
        var ID = $(this).attr("data-token");

        var saved_creator = {
          ID: ID,
          actionType: 6,
        };

        // call the server
        $.ajax({
          type: "POST",
          url: "/profile-functions/for-index.php",
          data: saved_creator,
          success: function (response) {
            console.log(response);
            if (response.code == 200) {
              $(selector).text("Applied");
              console.log(response);
            } else {
              $(selector).text("Apply");
            }
          },
          error: function (error) {
            console.error(error);
          },
        });
      }
    } else {
      // show dialog box when user is not loginned
      Swal.fire({
        showConfirmButton: false,
        title: '<h5 class="fs-3">Sign-in to Save</h5>',
        html:
          '<div class="col-12 position-relative z-index-1 text-center text-lg-start mb-5 mb-sm-0">' +
          '<div class="d-sm-flex align-items-center justify-content-center ">' +
          '<a href="account.php" class="btn btn-success-soft me-2 mb-4 mb-sm-0 signInAccount">Sign-In</a>' +
          "</div></div>",
      });
    }
  }
);
