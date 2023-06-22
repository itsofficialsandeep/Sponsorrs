$(document).on("click", "#saveCreators", function (e) {
  e.preventDefault();

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
      var selector = $(this);
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
            // $(selector).attr("class", "save bi bi-bookmark-fill text-primary");
            $(selector).html(
              '<i class="bi bi-bookmark-check-fill me-2"></i>Saved'
            );
            console.log(response);
          } else {
            //$(selector).attr("class", "save bi bi-bookmark text-primary");
            $(selector).html('<i class="bi bi-bookmark me-2"></i>Save');
          }
        },
        error: function (error) {
          console.error(error);
              Swal.fire({
                showConfirmButton: false,
                title: '<h5 class="fs-3">Sign-in to Save</h5>',
                html:
                  'Failed to save this creator',
              });
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
});
