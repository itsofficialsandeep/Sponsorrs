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
    url: "../profile-functions/channel-with-sponsorship-requests-clients.php",
    data: withSponsorshipRequestFormData,
    success: function (response) {
      if (response.length < 10) {
        // 10 means no results
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
    url: "../sr/brand-searchresult.php",
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
    url: "../sr/brand-searchresult.php",
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
    url: "../sr/brand-searchresult.php",
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
    url: "../profile-functions/channel-with-sponsorship-requests-clients.php",
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
