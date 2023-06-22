// LETS DO THE JOB for the behaviour (searching, loading,deleting, filtering, loading more)
// OF [channel-profile.php?page=payment] page

// reset the current counter and category for next database-result set
// beacause page has been loading
localStorage.setItem("channel_paymentsFilterCategory", "all");
localStorage.setItem("channel_paymentCurrentPage", "0");

$(document).ready(function () {
  console.log("=" + localStorage.getItem("channel_paymentCurrentPage"));

  // searching the next page from database
  //var from = localStorage.getItem("channel_paymentCurrentPage") ? localStorage.getItem("channel_paymentCurrentPage") : 0;
  var from = 0;
  var channel_paymentFormData = {
    text: "", // $("#payment-searchbar").val()
    filter: 1, // $("#payment-filter-option").val()
    actionType: 3,
    from: from,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/channel-payment-functions.php",
    data: channel_paymentFormData,
    success: function (response) {
      $("#payment-response-area").html(response);
      localStorage.setItem("channel_paymentCurrentPage", "20");
      console.log($("#payment-filter-option").val());
      console.log("==" + localStorage.getItem("channel_paymentCurrentPage"));
    },
    error: function (error) {
      console.error(error);
    },
  });
});

// this will get filtered-search result
// when user will change filter option
$("#payment-filter-option").change(function (e) {
  e.preventDefault();
  console.log($("#payment-searchbar").val());
  $("payment-filter-form").submit(false);

  console.log("=" + localStorage.getItem("channel_paymentCurrentPage"));

  // searching the next page from database
  //var from = localStorage.getItem("channel_paymentCurrentPage") ? localStorage.getItem("channel_paymentCurrentPage") : 0;
  var from = 0;
  var channel_paymentFormData = {
    text: $("#payment-searchbar").val(),
    filter: $("#payment-filter-option").val(),
    actionType: 3,
    from: from,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/channel-payment-functions.php",
    data: channel_paymentFormData,
    success: function (response) {
      $("#payment-response-area").html(response);
      console.log(response);
      localStorage.setItem("channel_paymentCurrentPage", "20");
      console.log($("#payment-filter-option").val());
      console.log("==" + localStorage.getItem("channel_paymentCurrentPage"));
    },
    error: function (error) {
      console.error(error);
    },
  });
});

// search for channel_payment,
// when user will search using search bar
$("#payment-searchbar").keyup(function (e) {
  e.preventDefault();
  console.log($("#payment-searchbar").val());
  $("#payment-searchbar-form").submit(false);

  // searching the next page from database
  var from = localStorage.getItem("channel_paymentCurrentPage")
    ? localStorage.getItem("channel_paymentCurrentPage")
    : 0;

  var channel_paymentFormData = {
    text: $("#payment-searchbar").val(),
    filter: 5,
    actionType: 3,
    from: 0,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/channel-payment-functions.php",
    data: channel_paymentFormData,
    success: function (response) {
      $("#payment-response-area").html(response);
      console.log(response);
    },
    error: function (error) {
      console.error(error);
    },
  });
});

// this will load more sponsorhips in same categgory when a user
// will click "Load More" button
$("#payment-load-more").click(function (e) {
  var currentPage = localStorage.getItem("channel_paymentCurrentPage");
  var nextPage = parseInt(currentPage) + 2;

  console.log("===" + nextPage);
  var currentCatagory = $("#payment-filter-option").val();

  var reloadchannel_paymentFilter = {
    filter: 1, //$("#payment-filter-option").val()
    actionType: 3,
    from: currentPage,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/channel-payment-functions.php",
    data: reloadchannel_paymentFilter,
    success: function (response) {
      if (response.length < 10) {
        // 10 means no results
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Alert!</h5>',
          html: '<p class="text-center">No result found.</p>',
        });
      } else {
        $("#payment-response-area").append(response);
        localStorage.setItem("channel_paymentCurrentPage", nextPage);
      }
    },
    error: function (error) {
      console.error(error);
    },
  });
});

// unfollow the user
function deleteRequest(selector) {
  console.log(selector);
  //var selector = $(this);
  var unfollowId = selector;

  var directRequestData = {
    applyId: unfollowId,
    actionType: 1,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/channel-payment-functions.php",
    data: directRequestData,
    success: function (response) {
      console.log(response);
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
