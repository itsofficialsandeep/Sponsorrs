// LETS DO THE JOB for the behaviour (searching, loading, deleting, filtering, loading more)
// OF [brand-all-requests.php?page=all_request] page [direct-requests]

// reset the current counter and category for next database-result set
// beacause page has been loading
localStorage.setItem("withSponsorshipRequestsFilterCategory", "all");
localStorage.setItem("withSponsorshipRequestCurrentPage", "0");

$(document).ready(function () {
  console.log("=" + localStorage.getItem("withSponsorshipRequestCurrentPage"));

  //============================================================================================================================
  // searching the next page from database
  //var from = localStorage.getItem("withSponsorshipRequestCurrentPage") ? localStorage.getItem("withSponsorshipRequestCurrentPage") : 0;
  var from = 0;
  var withSponsorshipRequestFormData = {
    text: $("withSponsorshipRequest_search").val(),
    filter: $("#withSponsorshipRequest_search_filter").val(),
    search_result_type: 1,
    from: from,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/brand-with-sponsorship-requests.php",
    data: withSponsorshipRequestFormData,
    success: function (response) {
      if (response.length < 10) {
        // 10 means no results
      } else {
        $("#tablebody_withsponsorship").html(response);

        //update the next page
        var currentPage = localStorage.getItem(
          "withSponsorshipRequestCurrentPage"
        );
        var nextPage = parseInt(currentPage) + 20;

        console.log(nextPage);

        localStorage.setItem("withSponsorshipRequestCurrentPage", nextPage);
      }
    },
    error: function (error) {
      console.error(error);
    },
  });
});

//================================================================================================================================
// this will get filtered search result
// when user will change filter option
$("#withSponsorshipRequest_search_filter").change(function (e) {
  e.preventDefault();
  console.log($("withSponsorshipRequest_search").val());
  $("#withSponsorshipRequest_search_form").submit(false);

  console.log("=" + localStorage.getItem("withSponsorshipRequestCurrentPage"));

  // searching the next page from database
  //var from = localStorage.getItem("withSponsorshipRequestCurrentPage") ? localStorage.getItem("withSponsorshipRequestCurrentPage") : 0;
  var from = 0;
  var withSponsorshipRequestFormData = {
    text: $("withSponsorshipRequest_search").val(),
    filter: $("#withSponsorshipRequest_search_filter").val(),
    search_result_type: 1,
    from: from,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/brand-with-sponsorship-requests.php",
    data: withSponsorshipRequestFormData,
    success: function (response) {
      if (response.length < 10) {
        // 10 means no results
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Alert!</h5>',
          html: '<p class="text-center">No result found.</p>',
        });
      } else {
        $("#tablebody_withsponsorship").html(response);
      }
    },
    error: function (error) {
      console.error(error);
    },
  });
});

//================================================================================================================================
// search for withSponsorshipRequest,
// when user will search using search bar
$("#withSponsorshipRequest_search").keyup(function (e) {
  e.preventDefault();
  console.log($("withSponsorshipRequest_search").val());
  $("#withSponsorshipRequest_search_form").submit(false);

  // searching the next page from database
  var from = localStorage.getItem("withSponsorshipRequestCurrentPage")
    ? localStorage.getItem("withSponsorshipRequestCurrentPage")
    : 0;

  var withSponsorshipRequestFormData = {
    text: $("withSponsorshipRequest_search").val(),
    filter: 0,
    search_result_type: 1,
    from: parseInt(from),
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/brand-with-sponsorship-requests.php",
    data: withSponsorshipRequestFormData,
    success: function (response) {
      if (response.length < 10) {
        // 10 means no results
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Alert!</h5>',
          html: '<p class="text-center">No result found.</p>',
        });
      } else {
        $("#tablebody_withsponsorship").html(response);
      }
    },
    error: function (error) {
      console.error(error);
    },
  });
});

//================================================================================================================================
// this will load more appli in same categgory when a user
// will click "Load More" button
$("#loadMoreWithSponsorship").click(function (e) {
  var currentPage = localStorage.getItem("withSponsorshipRequestCurrentPage");
  var nextPage = parseInt(currentPage) + 20;

  console.log("===" + nextPage);
  var currentCatagory = $("#withSponsorshipRequest_search_filter").val();

  var reloadSponsorshipFilter = {
    filter: $("#withSponsorshipRequest_search_filter").val(),
    search_result_type: 1,
    from: currentPage,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/brand-with-sponsorship-requests.php",
    data: reloadSponsorshipFilter,
    success: function (response) {
      console.log(response + "---" + currentPage + "---" + nextPage);

      if (response.length < 10) {
        // 10 means no results
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Alert!</h5>',
          html: '<p class="text-center">No result found.</p>',
        });
      } else {
        $("#tablebody_withsponsorship").append(response);
        localStorage.setItem("withSponsorshipRequestCurrentPage", nextPage);
      }
    },
    error: function (error) {
      console.error(error);
    },
  });
});

//================================================================================================================================
// deletes sent request of withSponsorshipRequests

function deleteApplication(selector) {
  console.log(selector);
  //var selector = $(this);
  var withSponsorshipRequestid = selector;

  var withSponsorshipRequestData = {
    applyId: withSponsorshipRequestid,
    actionType: "deleteApplication",
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/brand-with-sponsorship-requests.php",
    data: withSponsorshipRequestData,
    success: function (response) {
      console.log(withSponsorshipRequestData);
      if (response.code == 400) {
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Alert!</h5>',
          html: '<p class="text-center">Couldn\'t delete at this moment..</p>',
        });
      }
      if (response.code == 200) {
        $(selector).attr("class", "bg-danger-subtle");
        $(selector).animate({ left: "250px" }).fadeOut(500);
      }
    },
    error: function (error) {
      console.error(error);
    },
  });
}

function addRequest(selector, cs) {
  // payment code
  // pay now button clicked
  console.log("Pay Now clicked");

  var name = jQuery("#name").val();
  var amt = jQuery("#amt").val();

  // prepare amount and currency to create order
  var formData = {
    name: name,
    amount: amt * 100,
    currency: "INR",
    actionType: "createOrder", // for order creation
  };

  // prepare to send request
  jQuery.ajax({
    type: "post",
    url: "../profile-functions/brand-with-sponsorship-requests.php",
    data: formData,
    success: function (result) {
      console.log("requesting order: " + result);

      var orderJSON = JSON.parse(result);
      if (orderJSON.code == 200) {
        // order created successfully
        console.log("Order created successfully");
        console.log("preparing for payment process");

        // prepare for payment process
        var options = {
          order_id: orderJSON.order_id,
          key: "rzp_test_kqdrez1FZqQ1qs",
          amount: amt * 100,
          currency: "INR",
          name: "Acme Corp",
          description: "Test Transaction",
          image:
            "https://image.freepik.com/free-vector/logo-sample-text_355-558.jpg",
          handler: function (response) {
            // payment process response
            console.log("handler response: " + JSON.stringify(response));
            jQuery.ajax({
              type: "post",
              url: "../profile-functions/brand-with-sponsorship-requests.php",
              data:
                "actionType=preparePayment,payment_id=" +
                response.razorpay_payment_id,
              success: function (result) {
                //window.location.href = "thank_you.php";
                console.log(
                  "handler success response: " + JSON.stringify(result)
                );
              },
            });
            // {"razorpay_payment_id":"pay_LKBPc5rVuF5nc0","razorpay_order_id":"order_LKBPLto9lvmlu6","razorpay_signature":"5904e994de6f6010ee9a66b65008cb89904e92d66bf1ab1574d1e66ba8f64010"}
          },
        };
        var rzp1 = new Razorpay(options);
        rzp1.on("payment.failed", function (response) {
          console.log(response.error.code);
          console.log(response.error.description);
          console.log(response.error.source);
          console.log(response.error.step);
          console.log(response.error.reason);
          console.log(response.error.metadata.order_id);
          console.log(response.error.metadata.payment_id);
        });
        rzp1.open();
      } else if (orderJSON.code == 404) {
        // failed to create order
        console.log("fialed to create order..");
      }
    },
  });

  // payment code ends

  console.log(selector);
  var directRequestid = selector;

  var directRequestData = {
    applyId: directRequestid,
    actionType: "addApplication",
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/brand-with-sponsorship-requests.phpp",
    data: directRequestData,
    success: function (response) {
      console.log(directRequestData);
      console.log(response);

      if (response.code == 500) {
        $(selector).attr("class", "bg-success-subtle");
        $(selector).animate({ left: "250px" }).fadeOut(500);
      }
      if (response.code == 600) {
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Alert!</h5>',
          html: '<p class="text-center">Couldn\'t accept at this moment..</p>',
        });
      }
    },
    error: function (error) {
      console.error(error);
    },
  });
}

// accpeting request from creator for sponsorship
$(document).on("click", ".acceptRequest", function () {
  var accountTo = $(this).attr("data-to");
  var sponsorshipId = $(this).attr("data-sponsorshipId");
  var accountFrom = $(this).attr("data-from");
  var amt = $(this).attr("data-amount");
  var name = $(this).attr("data-name");
  var desc = $(this).attr("data-desc");
  var logo = $(this).attr("data-logo");
  var sponsorshipapplyid = $(this).attr("data-sponsorshipapplyid");

  var selector = $(this).attr("value");
  console.log(selector);

  // prepare amount and currency to create order
  var formData = {
    to: accountTo,
    sponsorshipId: sponsorshipId,
    from: accountFrom,
    name: name,
    amount: amt * 100,
    currency: "INR",
    actionType: "createOrder", // for order creation
  };

  // prepare to send request
  jQuery.ajax({
    type: "post",
    url: "../profile-functions/brand-with-sponsorship-requests.php",
    data: formData,
    success: function (result) {
      console.log("requesting order: " + result);

      var orderJSON = JSON.parse(result);
      if (orderJSON.code == 200) {
        // order created successfully
        console.log("Order created successfully");
        console.log("preparing for payment process");

        // prepare for payment process
        var options = {
          order_id: orderJSON.order_id,
          key: "rzp_test_kqdrez1FZqQ1qs",
          amount: amt * 100,
          currency: "INR",
          name: name,
          description: desc,
          image: logo,
          handler: function (response) {
            // collect response to send to server
            responeData = {
              to: accountTo,
              sponsorshipId: sponsorshipId,
              from: accountFrom,
              razorpay_payment_id: response.razorpay_payment_id,
              razorpay_order_id: response.razorpay_order_id,
              razorpay_signature: response.razorpay_signature,
              sponsorshipapplyid: sponsorshipapplyid,
              actionType: "preparePayement",
            };
            // payment process response
            console.log("handler response: " + JSON.stringify(response));
            jQuery.ajax({
              type: "post",
              url: "../profile-functions/brand-with-sponsorship-requests.php",
              data: responeData,

              success: function (result) {
                if (result.code == 200) {
                  $(selector).attr("class", "bg-success-subtle");
                  $(selector).animate({ left: "250px" }).fadeOut(500);
                }
                if (result.code == 400) {
                  Swal.fire({
                    showConfirmButton: false,
                    title: '<h5 class="fs-3 text-dark">Alert!</h5>',
                    html: '<p class="text-center">Couldn\'t accept at this moment..</p>',
                  });
                }
                //window.location.href = "thank_you.php";
                console.log("response from server: " + JSON.stringify(result));
              },
              error: function (error) {
                console.error(error);
              },
            });
            // {"razorpay_payment_id":"pay_LKBPc5rVuF5nc0","razorpay_order_id":"order_LKBPLto9lvmlu6","razorpay_signature":"5904e994de6f6010ee9a66b65008cb89904e92d66bf1ab1574d1e66ba8f64010"}
          },
        };

        var rzp1 = new Razorpay(options);
        rzp1.on("payment.failed", function (response) {
          console.log(response.error.code);
          console.log(response.error.description);
          console.log(response.error.source);
          console.log(response.error.step);
          console.log(response.error.reason);
          console.log(response.error.metadata.order_id);
          console.log(response.error.metadata.payment_id);
        });
        rzp1.open();
      } else if (orderJSON.code == 404) {
        // failed to create order
        console.log("fialed to create order..");

        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Error!</h5>',
          html: '<p class="text-center">Something went wrong..\n Try again later</p>',
        });
      }
    },
  });

  // payment code ends
});
