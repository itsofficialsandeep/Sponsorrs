// LETS DO THE JOB for the behaviour (searching, loading,deleting, filtering, loading more)
// OF [channel-profile.php?page=following] page

// reset the current counter and category for next database-result set
// beacause page has been loading
localStorage.setItem("saved_sponsorshipsFilterCategory", "all");
localStorage.setItem("saved_sponsorshipCurrentPage", "0");

$(document).ready(function () {
  console.log("=" + localStorage.getItem("saved_sponsorshipCurrentPage"));

  // searching the next page from database
  //var from = localStorage.getItem("saved_sponsorshipCurrentPage") ? localStorage.getItem("saved_sponsorshipCurrentPage") : 0;
  var from = 0;
  var saved_sponsorshipFormData = {
    text: $("#saved-sponsorship-searchbar").val(),
    filter: $("#saved-sponsorship-filter-option").val(),
    actionType: 3,
    from: from,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/channel-saved-sponsorship-functions.php",
    data: saved_sponsorshipFormData,
    success: function (response) {
      $("#saved-sponsorship-response-area").html(response);
      localStorage.setItem("saved_sponsorshipCurrentPage", "2");
      console.log($("#saved-sponsorship-filter-option").val());
      console.log("==" + localStorage.getItem("saved_sponsorshipCurrentPage"));
    },
    error: function (error) {
      console.error(error);
    },
  });
});

// this will get filtered-search result
// when user will change filter option
$("#saved-sponsorship-filter-option").change(function (e) {
  e.preventDefault();
  console.log($("#saved-sponsorship-searchbar").val());
  $("saved-brand-filter-form").submit(false);

  console.log("=" + localStorage.getItem("saved_sponsorshipCurrentPage"));

  // searching the next page from database
  //var from = localStorage.getItem("saved_sponsorshipCurrentPage") ? localStorage.getItem("saved_sponsorshipCurrentPage") : 0;
  var from = 0;
  var saved_sponsorshipFormData = {
    text: $("#saved-sponsorship-searchbar").val(),
    filter: $("#saved-sponsorship-filter-option").val(),
    actionType: 3,
    from: from,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/channel-saved-sponsorship-functions.php",
    data: saved_sponsorshipFormData,
    success: function (response) {
      $("#saved-sponsorship-response-area").html(response);
      localStorage.setItem("saved_sponsorshipCurrentPage", "2");
      console.log($("#saved-sponsorship-filter-option").val());
      console.log("==" + localStorage.getItem("saved_sponsorshipCurrentPage"));
    },
    error: function (error) {
      console.error(error);
    },
  });
});

// search for saved_sponsorship,
// when user will search using search bar
$("#saved-sponsorship-searchbar").keyup(function (e) {
  e.preventDefault();
  console.log($("#saved-sponsorship-searchbar").val());
  $("#saved-sponsorship-searchbar-form").submit(false);

  // searching the next page from database
  var from = localStorage.getItem("saved_sponsorshipCurrentPage")
    ? localStorage.getItem("saved_sponsorshipCurrentPage")
    : 0;

  var saved_sponsorshipFormData = {
    text: $("#saved-sponsorship-searchbar").val(),
    filter: 7,
    actionType: 3,
    from: 0,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/channel-saved-sponsorship-functions.php",
    data: saved_sponsorshipFormData,
    success: function (response) {
      $("#saved-sponsorship-response-area").html(response);
      console.log(response);
    },
    error: function (error) {
      console.error(error);
    },
  });
});

// this will load more sponsorhips in same categgory when a user
// will click "Load More" button
$("#saved-sponsorship-load-more").click(function (e) {
  var currentPage = localStorage.getItem("saved_sponsorshipCurrentPage");
  var nextPage = parseInt(currentPage) + 2;

  console.log("===" + nextPage);
  var currentCatagory = $("#saved-sponsorship-filter-option").val();

  var reloadsaved_sponsorshipFilter = {
    filter: $("#saved-sponsorship-filter-option").val(),
    actionType: 3,
    from: currentPage,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/channel-saved-sponsorship-functions.php",
    data: reloadsaved_sponsorshipFilter,
    success: function (response) {
      if (response.length < 10) {
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Alert!</h5>',
          html: '<p class="text-center">No result found.</p>',
        });
      } else {
        $("#saved-sponsorship-response-area").append(response);
        console.log($("#saved-sponsorship-filter-option").val());
        localStorage.setItem("saved_sponsorshipCurrentPage", nextPage);
      }
    },
    error: function (error) {
      console.error(error);
    },
  });
});

// deletes sent request of saved_sponsorships
function removeRequest(selector, sponsorshipId) {
  var saved_sponsorshipData = {
    sponsorshipId: sponsorshipId,
    actionType: 1,
  };

  console.log("--" + sponsorshipId);

  $.ajax({
    type: "POST",
    url: "../profile-functions/channel-saved-sponsorship-functions.php",
    data: saved_sponsorshipData,
    success: function (response) {
      $(selector).attr("class", "bg-danger-subtle");
      $(selector).animate({ left: "250px" }).fadeOut(500);

      $("b" + selector)
        .animate({ left: "250px" })
        .fadeOut(500);
      if (response === "Successfully removed") {
        console.log(response);
        //alert("Successfully removed");
        $(selector).attr("class", "bg-danger-subtle");
        $(selector).animate({ left: "250px" }).fadeOut(500);
      }
      if (response === "Failed to remove") {
        console.log(response);
      }
    },
    error: function (error) {
      console.error(error);
    },
  });
}
