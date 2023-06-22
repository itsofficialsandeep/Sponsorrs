// LETS DO THE JOB for the behaviour (searching, loading,deleting, filtering, loading more)
// OF [channel-profile.php?page=following] page

// reset the current counter and category for next database-result set
// beacause page has been loading
localStorage.setItem("saved_brandsFilterCategory", "all");
localStorage.setItem("saved_brandCurrentPage", "0");

$(document).ready(function () {
  console.log("=" + localStorage.getItem("saved_brandCurrentPage"));

  // searching the next page from database
  //var from = localStorage.getItem("saved_brandCurrentPage") ? localStorage.getItem("saved_brandCurrentPage") : 0;
  var from = 0;
  var saved_brandFormData = {
    text: $("#saved-brand-searchbar").val(),
    filter: $("#saved-brand-filter-option").val(),
    actionType: 3,
    from: from,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/brand-saved-creators-functions.php",
    data: saved_brandFormData,
    success: function (response) {
      $("#saved-brand-response-area").html(response);
      localStorage.setItem("saved_brandCurrentPage", "20");
      console.log($("#saved-brand-filter-option").val());
      console.log("==" + localStorage.getItem("saved_brandCurrentPage"));

      if (response.length < 10) {
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Alert!</h5>',
          html: '<p class="text-center">No result found.</p>',
        });
      } else {
        $("#saved-brand-response-area").html(response);

        //update the next page
        var currentPage = localStorage.getItem("saved_brandCurrentPage");
        var nextPage = parseInt(currentPage) + 20;

        localStorage.setItem("saved_brandCurrentPage", nextPage);
      }
    },
    error: function (error) {
      console.error(error);
    },
  });
});

// this will get filtered-search result
// when user will change filter option
$("#saved-brand-filter-option").change(function (e) {
  e.preventDefault();
  console.log($("#saved-brand-searchbar").val());
  $("saved-brand-filter-form").submit(false);

  console.log("=" + localStorage.getItem("saved_brandCurrentPage"));

  // searching the next page from database
  //var from = localStorage.getItem("saved_brandCurrentPage") ? localStorage.getItem("saved_brandCurrentPage") : 0;
  var from = 0;
  var saved_brandFormData = {
    text: $("#saved-brand-searchbar").val(),
    filter: $("#saved-brand-filter-option").val(),
    actionType: 3,
    from: from,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/brand-saved-creators-functions.php",
    data: saved_brandFormData,
    success: function (response) {
      $("#saved-brand-response-area").html(response);
      localStorage.setItem("saved_brandCurrentPage", "20");
      console.log($("#saved-brand-filter-option").val());
      console.log("==" + localStorage.getItem("saved_brandCurrentPage"));
    },
    error: function (error) {
      console.error(error);
    },
  });
});

// search for saved_brand,
// when user will search using search bar
$("#saved-brand-searchbar").keyup(function (e) {
  e.preventDefault();
  console.log($("#saved-brand-searchbar").val());
  $("#saved-brand-searchbar-form").submit(false);

  // searching the next page from database
  var from = localStorage.getItem("saved_brandCurrentPage")
    ? localStorage.getItem("saved_brandCurrentPage")
    : 0;

  var saved_brandFormData = {
    text: $("#saved-brand-searchbar").val(),
    filter: 5,
    actionType: 3,
    from: 0,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/brand-saved-creators-functions.php",
    data: saved_brandFormData,
    success: function (response) {
      $("#saved-brand-response-area").html(response);
      console.log(response);
    },
    error: function (error) {
      console.error(error);
    },
  });
});

// this will load more sponsorhips in same categgory when a user
// will click "Load More" button
$("#saved-brand-load-more").click(function (e) {
  var currentPage = localStorage.getItem("saved_brandCurrentPage");
  var nextPage = parseInt(currentPage) + 2;

  console.log("===" + nextPage);
  var currentCatagory = $("#saved-brand-filter-option").val();

  var reloadsaved_brandFilter = {
    filter: $("#saved-brand-filter-option").val(),
    actionType: 3,
    from: currentPage,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/brand-saved-creators-functions.php",
    data: reloadsaved_brandFilter,
    success: function (response) {
      if (response.length < 10) {
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Alert!</h5>',
          html: '<p class="text-center">No result found.</p>',
        });
      } else {
        $("#saved-brand-response-area").append(response);
        console.log($("#saved-brand-filter-option").val());
        localStorage.setItem("saved_brandCurrentPage", nextPage);
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
    url: "../profile-functions/brand-saved-creators-functions.php",
    data: directRequestData,
    success: function (response) {
      console.log(response);
      if (response.code == 400) {
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Alert!</h5>',
          html: '<p class="text-center">Couldn\'t unsave at this moment..</p>',
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
