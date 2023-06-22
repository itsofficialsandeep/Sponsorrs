// LETS DO THE JOB for the behaviour (searching, loading,deleting, filtering, loading more)
// OF [channel-profile.php?page=all_clients] page

// reset the current counter and category for next database-result set
// beacause page has been loading
localStorage.setItem("clientsFilterCategory", "all");
localStorage.setItem("clientCurrentPage", "0");

$(document).ready(function () {
  console.log("=" + localStorage.getItem("clientCurrentPage"));

  // searching the next page from database
  //var from = localStorage.getItem("clientCurrentPage") ? localStorage.getItem("clientCurrentPage") : 0;
  var from = 0;
  var clientFormData = {
    text: $("#client-searchbar").val(),
    filter: $("#client-sortbycategory-select").val(),
    actionType: 2,
    from: from,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/channel-clients-functions.php",
    data: clientFormData,
    success: function (response) {
      $("#client-list").html(response);
      localStorage.setItem("clientCurrentPage", "2");
      console.log($("#client-sortbycategory-select").val());
      console.log("==" + localStorage.getItem("clientCurrentPage"));
    },
    error: function (error) {
      console.error(error);
    },
  });
});

// this will get filtered search result
// when user will change filter option
$("#client-sortbycategory-select").change(function (e) {
  e.preventDefault();
  console.log($("#client-searchbar").val());
  $("#client-searchbar-form").submit(false);

  console.log("=" + localStorage.getItem("clientCurrentPage"));

  // searching the next page from database
  //var from = localStorage.getItem("clientCurrentPage") ? localStorage.getItem("clientCurrentPage") : 0;
  var from = 0;
  var clientFormData = {
    text: $("#client-searchbar").val(),
    filter: $("#client-sortbycategory-select").val(),
    actionType: 2,
    from: from,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/channel-clients-functions.php",
    data: clientFormData,
    success: function (response) {
      $("#client-list").html(response);
      localStorage.setItem("clientCurrentPage", "2");
      console.log("=====" + response);
      console.log("==" + localStorage.getItem("clientCurrentPage"));
    },
    error: function (error) {
      console.error(error);
    },
  });
});

// search for client,
// when user will search using search bar
$("#client-searchbarr").keyup(function (e) {
  e.preventDefault();

  $("#client-searchbar-form").submit(false);

  // searching the next page from database
  var from = localStorage.getItem("clientCurrentPage")
    ? localStorage.getItem("clientCurrentPage")
    : 0;

  var clientFormData = {
    text: $("client-searchbar").val(),
    filter: 0,
    actionType: 2,
    from: parseInt(from),
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/channel-clients-functions.php",
    data: clientFormData,
    success: function (response) {
      if (response.length < 10) {
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Alert!</h5>',
          html: '<p class="text-center">No result found.</p>',
        });
      } else {
        $("#client-list").html(response);
        console.log(response);
      }
    },
    error: function (error) {
      console.error(error);
    },
  });
});

// this will load more clients in same categgory when a user
// will click "Load More" button
$("#load-more-clients").click(function (e) {
  var currentPage = localStorage.getItem("clientCurrentPage");
  var nextPage = parseInt(currentPage) + 2;

  console.log("===" + nextPage);
  var currentCatagory = $("#client-sortbycategory-select").val();

  var reloadclientFilter = {
    filter: $("#client-sortbycategory-select").val(),
    actionType: 2,
    from: currentPage,
  };

  $.ajax({
    type: "POST",
    url: "../profile-functions/channel-clients-functions.php",
    data: reloadclientFilter,
    success: function (response) {
      if (response.length < 10) {
        Swal.fire({
          showConfirmButton: false,
          title: '<h5 class="fs-3 text-dark">Alert!</h5>',
          html: '<p class="text-center">No result found.</p>',
        });
      } else {
        $("#client-list").append(response);
        console.log($("#client-sortbycategory-select").val());
        localStorage.setItem("clientCurrentPage", nextPage);
      }
    },
    error: function (error) {
      console.error(error);
    },
  });
});
