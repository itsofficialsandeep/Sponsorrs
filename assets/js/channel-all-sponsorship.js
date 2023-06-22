// LETS DO THE JOB for the behaviour (searching, loading,deleting, filtering, loading more)
// OF [channel-profile.php?page=all_sponsorships] page

// reset the current counter and category for next database-result set
// beacause page has been loading
localStorage.setItem("sponsorshipsFilterCategory", "all");
localStorage.setItem("sponsorshipCurrentPage", "0");

$(document).ready(function () {
  console.log("=" + localStorage.getItem("sponsorshipCurrentPage"));

  //============================================================================================================================
  // searching the next page from database
  //var from = localStorage.getItem("sponsorshipCurrentPage") ? localStorage.getItem("sponsorshipCurrentPage") : 0;
  var from = 0;
  var sponsorshipFormData = {
    text: $("sponsorship_search").val(),
    filter: $("#sponsorship_search_filter").val(),
    search_result_type: 1,
    from: from,
  };

  $.ajax({
    type: "POST",
    url: "../sr/searchresults.php",
    data: sponsorshipFormData,
    success: function (response) {
      if (response.length < 10) {
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Alert!</h5>',
          html: '<p class="text-center">No result found.</p>',
        });
      } else {
        $("#tablebody").append(response);

        //update the next page
        var currentPage = localStorage.getItem("sponsorshipCurrentPage");
        var nextPage = parseInt(currentPage) + 20;

        localStorage.setItem("sponsorshipCurrentPage", nextPage);
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
$("#sponsorship_search_filter").change(function (e) {
  e.preventDefault();
  console.log($("sponsorship_search").val());
  $("#sponsorship_search_form").submit(false);

  console.log("=" + localStorage.getItem("sponsorshipCurrentPage"));

  // searching the next page from database
  //var from = localStorage.getItem("sponsorshipCurrentPage") ? localStorage.getItem("sponsorshipCurrentPage") : 0;
  var from = 0;
  var sponsorshipFormData = {
    text: $("sponsorship_search").val(),
    filter: $("#sponsorship_search_filter").val(),
    search_result_type: 1,
    from: from,
  };

  $.ajax({
    type: "POST",
    url: "../sr/searchresults.php",
    data: sponsorshipFormData,
    success: function (response) {
      if (response.length < 10) {
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Alert!</h5>',
          html: '<p class="text-center">No result found.</p>',
        });
      } else {
        $("#tablebody").html(response);

        //update the next page
        var currentPage = localStorage.getItem("sponsorshipCurrentPage");
        var nextPage = parseInt(currentPage) + 20;

        localStorage.setItem("sponsorshipCurrentPage", nextPage);
      }
    },
    error: function (error) {
      console.error(error);
    },
  });
});

//================================================================================================================================
// search for sponsorship,
// when user will search using search bar
$("#sponsorship_search").keyup(function (e) {
  e.preventDefault();
  console.log($("sponsorship_search").val());
  $("#sponsorship_search_form").submit(false);

  // searching the next page from database
  var from = localStorage.getItem("sponsorshipCurrentPage")
    ? localStorage.getItem("sponsorshipCurrentPage")
    : 0;

  var sponsorshipFormData = {
    text: $("sponsorship_search").val(),
    filter: 0,
    search_result_type: 1,
    from: parseInt(from),
  };

  $.ajax({
    type: "POST",
    url: "../sr/searchresults.php",
    data: sponsorshipFormData,
    success: function (response) {
      try {
        if (response.code == 400) {
          Swal.fire({
            showConfirmButton: false,
            title: '<h5 class="fs-3">Alert!</h5>',
            html: '<p class="text-center">No result found.</p>',
          });
        }
      } catch (error) {
        $("#tablebody").html(response);
      }
      console.log(response);
    },
    error: function (error) {
      console.error(error);
    },
  });
});

//================================================================================================================================
// this will load more sponsorhips in same categgory when a user
// will click "Load More" button
$("#loadMoreSponsorhips").click(function (e) {
  var currentPage = localStorage.getItem("sponsorshipCurrentPage");
  var nextPage = parseInt(currentPage) + 20;

  console.log(currentPage + "====" + nextPage + "===" + nextPage);
  var currentCatagory = $("#sponsorship_search_filter").val();

  var reloadSponsorshipFilter = {
    filter: $("#sponsorship_search_filter").val(),
    search_result_type: 1,
    from: currentPage,
  };

  $.ajax({
    type: "POST",
    url: "../sr/searchresults.php",
    data: reloadSponsorshipFilter,
    success: function (response) {
      if (response.length < 10) {
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Alert!</h5>',
          html: '<p class="text-center">No result found.</p>',
        });
      } else {
        $("#tablebody").append(response);
        localStorage.setItem("sponsorshipCurrentPage", nextPage);
      }
    },
    error: function (error) {
      console.error(error);
    },
  });
});

//================================================================================================================================
// deletes sent request of sponsorships
function deleteRequest(selector, applyId) {
  var sponsorshipData = {
    applyId: applyId,
    actionType: "deleteSponsorship",
  };

  console.log("--" + applyId);

  $.ajax({
    type: "POST",
    url: "channel-profile.php",
    data: sponsorshipData,
    success: function (response) {
      $(selector).attr("class", "bg-danger-subtle");
      $(selector).animate({ left: "250px" }).fadeOut(500);
      console.log(applyId);
    },
    error: function (error) {
      console.error(error);
    },
  });
}
