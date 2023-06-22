// LETS DO THE JOB for the behaviour (searching, loading,deleting, filtering, loading more)
// OF [channel-profile.php?page=following] page

// reset the current counter and category for next database-result set
// beacause page has been loading
localStorage.setItem("channel_following_brandsFilterCategory", "all");
localStorage.setItem("channel_following_brandCurrentPage", "0");

$(document).ready(function () {
  console.log("=" + localStorage.getItem("channel_following_brandCurrentPage"));

  // searching the next page from database
  //var from = localStorage.getItem("channel_following_brandCurrentPage") ? localStorage.getItem("channel_following_brandCurrentPage") : 0;
  var from = 0;
  var channel_following_brandFormData = {
    text: $("#following-searchbar").val(),
    filter: $("#following-filter-option").val(),
    actionType: 3,
    from: from,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/brand-following-functions.php",
    data: channel_following_brandFormData,
    success: function (response) {
      $("#following-response-area").html(response);
      localStorage.setItem("channel_following_brandCurrentPage", "20");
      console.log($("#following-filter-option").val());
      console.log(
        "==" + localStorage.getItem("channel_following_brandCurrentPage")
      );
    },
    error: function (error) {
      console.error(error);
    },
  });
});

// this will get filtered-search result
// when user will change filter option
$("#following-filter-option").change(function (e) {
  e.preventDefault();
  console.log($("#following-searchbar").val());
  $("following-filter-form").submit(false);

  console.log("=" + localStorage.getItem("channel_following_brandCurrentPage"));

  // searching the next page from database
  //var from = localStorage.getItem("channel_following_brandCurrentPage") ? localStorage.getItem("channel_following_brandCurrentPage") : 0;
  var from = 0;
  var channel_following_brandFormData = {
    text: $("#following-searchbar").val(),
    filter: $("#following-filter-option").val(),
    actionType: 3,
    from: from,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/brand-following-functions.php",
    data: channel_following_brandFormData,
    success: function (response) {
      $("#following-response-area").html(response);
      console.log(response);
      localStorage.setItem("channel_following_brandCurrentPage", "20");
      console.log($("#following-filter-option").val());
      console.log(
        "==" + localStorage.getItem("channel_following_brandCurrentPage")
      );
    },
    error: function (error) {
      console.error(error);
    },
  });
});

// search for channel_following_brand,
// when user will search using search bar
$("#following-searchbar").keyup(function (e) {
  e.preventDefault();
  console.log($("#following-searchbar").val());
  $("#following-searchbar-form").submit(false);

  // searching the next page from database
  var from = localStorage.getItem("channel_following_brandCurrentPage")
    ? localStorage.getItem("channel_following_brandCurrentPage")
    : 0;

  var channel_following_brandFormData = {
    text: $("#following-searchbar").val(),
    filter: 5,
    actionType: 3,
    from: 0,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/brand-following-functions.php",
    data: channel_following_brandFormData,
    success: function (response) {
      $("#following-response-area").html(response);
      console.log(response);
    },
    error: function (error) {
      console.error(error);
    },
  });
});

// this will load more sponsorhips in same categgory when a user
// will click "Load More" button
$("#following-load-more").click(function (e) {
  var currentPage = localStorage.getItem("channel_following_brandCurrentPage");
  var nextPage = parseInt(currentPage) + 2;

  console.log("===" + nextPage);
  var currentCatagory = $("#following-filter-option").val();

  var reloadchannel_following_brandFilter = {
    filter: $("#following-filter-option").val(),
    actionType: 3,
    from: currentPage,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/brand-following-functions.php",
    data: reloadchannel_following_brandFilter,
    success: function (response) {
      if (response.length < 10) {
        // 10 means no results
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Alert!</h5>',
          html: '<p class="text-center">No result found.</p>',
        });
      } else {
        $("#following-response-area").append(response);
        localStorage.setItem("channel_following_brandCurrentPage", nextPage);
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
    url: "../profile-functions/brand-following-functions.php",
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
