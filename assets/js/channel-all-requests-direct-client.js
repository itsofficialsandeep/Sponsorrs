// LETS DO THE JOB for the behaviour (searching, loading, deleting, filtering, loading more)
// OF [brand-all-requests.php?page=all_request] page [direct-requests]

// reset the current counter and category for next database-result set
// beacause page has been loading
localStorage.setItem("directRequestsFilterCategory", "all");
localStorage.setItem("directRequestCurrentPage", "0");

$(document).ready(function () {
  console.log("=" + localStorage.getItem("directRequestCurrentPage"));

  //============================================================================================================================
  // searching the next page from database
  //var from = localStorage.getItem("directRequestCurrentPage") ? localStorage.getItem("directRequestCurrentPage") : 0;
  var from = 0;
  var directRequestFormData = {
    text: $("directRequest_search").val(),
    filter: $("#directRequest_search_filter").val(),
    search_result_type: 2,
    from: from,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/channel-direct-requests-clients.php",
    data: directRequestFormData,
    success: function (response) {
      if (response.length < 10) {
        // 10 means no results
      } else {
        $("#tablebody_direct").html(response);
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
$("#directRequest_search_filter").change(function (e) {
  e.preventDefault();
  console.log($("directRequest_search").val());
  $("#directRequest_search_form").submit(false);

  console.log("=" + localStorage.getItem("directRequestCurrentPage"));

  // searching the next page from database
  //var from = localStorage.getItem("directRequestCurrentPage") ? localStorage.getItem("directRequestCurrentPage") : 0;
  var from = 0;
  var directRequestFormData = {
    text: $("directRequest_search").val(),
    filter: $("#directRequest_search_filter").val(),
    search_result_type: 1,
    from: from,
  };

  $.ajax({
    type: "POST",
    url: "../sr/brand-searchresult.php",
    data: directRequestFormData,
    success: function (response) {
      if (response.length < 10) {
        // 10 means no results
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Alert!</h5>',
          html: '<p class="text-center">No result found.</p>',
        });
      } else {
        $("#tablebody_direct").html(response);
      }
    },
    error: function (error) {
      console.error(error);
    },
  });
});

//================================================================================================================================
// search for directRequest,
// when user will search using search bar
$("#directRequest_search").keyup(function (e) {
  e.preventDefault();
  console.log($("directRequest_search").val());
  $("#directRequest_search_form").submit(false);

  // searching the next page from database
  var from = localStorage.getItem("directRequestCurrentPage")
    ? localStorage.getItem("directRequestCurrentPage")
    : 0;

  var directRequestFormData = {
    text: $("directRequest_search").val(),
    filter: 0,
    search_result_type: 1,
    from: parseInt(from),
  };

  $.ajax({
    type: "POST",
    url: "../sr/brand-searchresult.php",
    data: directRequestFormData,
    success: function (response) {
      if (response.length < 10) {
        // 10 means no results
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Alert!</h5>',
          html: '<p class="text-center">No result found.</p>',
        });
      } else {
        $("#tablebody_direct").html(response);
      }
    },
    error: function (error) {
      console.error(error);
    },
  });
});

//================================================================================================================================
// this will load more applications in same categgory when a user
// will click "Load More" button
$("#loadMoreDirectRequest").click(function (e) {
  var currentPage = localStorage.getItem("directRequestCurrentPage");
  var nextPage = parseInt(currentPage) + 20;

  console.log("===" + nextPage);
  var currentCatagory = $("#directRequest_search_filter").val();

  var reloadSponsorshipFilter = {
    filter: $("#directRequest_search_filter").val(),
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
        $("#tablebody_direct").append(response);
        localStorage.setItem("directRequestCurrentPage", nextPage);
      }
    },
    error: function (error) {
      console.error(error);
    },
  });
});

//================================================================================================================================
// deletes sent request of directRequests

function deleteRequest(selector) {
  console.log(selector);
  //var selector = $(this);
  var directRequestid = selector;

  var directRequestData = {
    applyId: directRequestid,
    actionType: "deleteApplication",
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/channel-direct-requests.php",
    data: directRequestData,
    success: function (response) {
      console.log(directRequestData);
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
