// password change event

$("#confirm-password").keyup(function (e) {
  if ($("#confirm-password").val() == $("#psw-input").val()) {
    $("#match-alert").css("display", "block");
  } else {
    $("#match-alert").css("display", "none");
  }
  console.assert("matching");
});

$("#submit-change-password").click(function (event) {
  var current_password = $("#current-password").val();
  var new_password = $("#psw-input").val();
  var confirm_passsword = $("#confirm-password").val();

  var FormData = {
    current_password: current_password,
    new_password: new_password,
    confirm_password: confirm_passsword,
    actionType: "updatePassword",
  };

  $("#submit-change-password").focusout(function (e) {
    $("#submit-change-password")
      .removeClass("btn-primary")
      .removeClass("btn-warning")
      .removeClass("btn-success")
      .addClass("btn-primary")
      .text("Change password");
  });

  $.ajax({
    type: "POST",
    url: "../profile-functions/channel-setting-functions.php",
    data: FormData,
    success: function (response) {
      responseObj = JSON.parse(JSON.stringify(response));
      console.log(response);

      if (responseObj.code == 200) {
        console.log("success status-" + responseObj.status);
        $("#submit-change-password")
          .removeClass("btn-warning")
          .addClass("btn-success")
          .text("Password changed..!");

        $("#current-password").val("");
        $("#psw-input").val("");
        $("#confirm-password").val("");

        $("#match-alert").css("display", "none");
      } else if (responseObj.code == 405 || responseObj.code == 404) {
        $("#submit-change-password").text(responseObj.message);

        // clear all fields
        $("#current-password").val("");
        $("#psw-input").val("");
        $("#confirm-password").val("");
      }
    },
    beforeSend: function (params) {
      $("#submit-change-password")
        .removeClass("btn-primary")
        .addClass("btn-warning")
        .val("Please wait...");
    },
    error: function (error) {
      console.error(error);
    },
  });
});

//================================================================
// Payment account settings

$("#channel-account-submit").click(function (event) {
  event.preventDefault();

  console.log("clicked");

  var channel_account_businessname = $("#channel-account-businessname").val();
  var channel_account_business_type = $("#channel-account-business-type").val();
  var channel_account_IFSC_code = $("#channel-account-IFSC-code").val();
  var channel_account_account_number = $(
    "#channel-account-account-number"
  ).val();
  var channel_account_confirm_account_number = $(
    "#channel-account-confirm-account-number"
  ).val();
  var channel_account_beneficiary_name = $(
    "#channel-account-beneficiary-name"
  ).val();
  var channel_account_gender = $("input[name='gender']:checked").val();
  var channel_account_DateOfBirth = $("#channel-account-DateOfBirth").val();
  var channel_account_email = $("#channel-account-email").val();
  var channel_account_phoneNumber = $("#channel-account-phoneNumber").val();
  var channel_account_address = $("#channel-account-address").val();
  var channel_account_country = $("#channel-account-country").val();
  var channel_account_state = $("#channel-account-state").val();
  var channel_account_city = $("#channel-account-city").val();
  var channel_account_zipCode = $("#channel-account-zipCode").val();

  if (
    channel_account_businessname.length > 100 ||
    channel_account_businessname.length < 3 ||
    channel_account_IFSC_code.length != 11 ||
    channel_account_account_number.length > 20 ||
    channel_account_confirm_account_number.length > 20 ||
    channel_account_beneficiary_name.length > 50 ||
    channel_account_email.length > 50 ||
    channel_account_phoneNumber.length > 14 ||
    channel_account_country.length < 2 ||
    channel_account_address.length > 300 ||
    channel_account_zipCode.length < 6 ||
    channel_account_zipCode.length > 6
  ) {
    $("#form-alert")
      .text("Fill the form correctly..")
      .attr("class", "text-danger")
      .css("display", "block")
      .delay(1000)
      .fadeOut("slow");
  } else {
    var FormData = {
      businessname: channel_account_businessname,
      business_type: channel_account_business_type,
      IFSC_code: channel_account_IFSC_code,
      account_number: channel_account_account_number,
      confirm_account_number: channel_account_confirm_account_number,
      beneficiary_name: channel_account_beneficiary_name,
      gender: channel_account_gender,
      DateOfBirth: channel_account_DateOfBirth,
      email: channel_account_email,
      mobile: channel_account_phoneNumber,
      address: channel_account_address,
      country: channel_account_country,
      state: channel_account_state,
      city: channel_account_city,
      zipCode: channel_account_zipCode,
      actionType: "updatePaymentInfo",
    };

    console.log(FormData);

    $.ajax({
      type: "POST",
      url: "../profile-functions/channel-setting-functions.php",
      data: FormData,
      success: function (response) {
        responseObj = JSON.parse(JSON.stringify(response));
        console.log(response);
        if (responseObj.code == 200) {
          $("#form-alert")
            .text("Successfully updated..")
            .attr("class", "text-success")
            .css("display", "block")
            .delay(1000)
            .fadeOut("slow");
        } else if (responseObj.code == 400) {
          $("#form-alert")
            .text("Something went wrong.. fill your form correctly..")
            .attr("class", "text-danger")
            .css("display", "block")
            .delay(4000)
            .fadeOut("slow");
        }
      },
      beforeSend: function (params) {
        console.log("sending");
        $("#form-alert")
          .text("Processing..")
          .attr("class", "text-warning")
          .delay(1000)
          .fadeOut("slow");
      },
      error: function (error) {
        console.error(error);
      },
    });
  }
});

$(document).on("click", "#get-otp", function () {
  var token = $(this).attr("data-token");
  var mail = $("#new-mail").val();
  var otp = {
    token: token,
    mail: mail,
    actionType: "mail",
  };

  console.log(otp);

  $.ajax({
    type: "POST",
    url: "../profile-functions/channel-setting-functions.php",
    data: otp,
    dataType: "json",
    success: function (response) {
      if (response.code == 200) {
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Success!</h5>',
          html: '<p class="text-center">OTP sent to this E-Mail address.</p>',
        });
      } else {
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Alert!</h5>',
          html: '<p class="text-center">Something went wrong.. Please try some time later.</p>',
        });
      }
    },
  });
});

$(document).on("click", "#verify-otp", function () {
  var otp = $(this).attr("#otp-input");
  var token = $(this).attr("data-token");
  var mail = $("#new-mail").val();

  var data = {
    otp: otp,
    newmail: mail,
    token: token,
    actionType: "otp",
  };

  console.log(otp);

  $.ajax({
    type: "POST",
    url: "../profile-functions/channel-setting-functions.php",
    data: data,
    dataType: "json",
    success: function (response) {
      if (response.code == 200) {
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Success!</h5>',
          html: '<p class="text-center">Email-Id successfully updated</p>',
        });
      }
      if (response.code == 300) {
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Alert!</h5>',
          html: '<p class="text-center">Wrong OTP</p>',
        });
      }

      if (response.code == 400) {
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Alert!</h5>',
          html: '<p class="text-center">Failed to update the E-Mail at this moment</p>',
        });
      }
    },
  });
});
