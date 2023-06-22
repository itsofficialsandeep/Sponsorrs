// load some results based on selected data
// set searchresultstartindex to 0
// when user changes selection get results based on selected data
// when user click 'load more', increase searchresultstartindex by 50 and get results based on selected data

$(document).ready(function () {
  localStorage.setItem("searchResultStartIndexForBrand", 0);
  localStorage.setItem("searchResultStartIndexForCreator", 0);
  localStorage.setItem("searchResultStartIndexForSponsorship", 0);

  // brand data
  brandKeyword = $("#brand-keyword").val();
  brandIndustry = $("#brand-industry").val();
  brandType = $("#brand-type").val();
  brandCategory = $("#brand-category").val();
  brandCountry = $("#brand-country").val();

  const brandData = {
    query: brandKeyword,
    industry: brandIndustry,
    type: brandType,
    category: brandCategory,
    country: brandCountry,
    actionType: 1,
  };

  // sponsorship data
  sponsorshipKeyword = $("#sponsorship-keyword").val();
  sponsorshipIndustry = $("#sponsorship-industry").val();
  sponsorshipType = $("#sponsorship-type").val();
  sponsorshipCategory = $("#sponsorship-category").val();
  sponsorshipCountry = $("#sponsorship-country").val();

  const sponsorshipData = {
    query: sponsorshipKeyword,
    industry: sponsorshipIndustry,
    type: sponsorshipType,
    category: sponsorshipCategory,
    country: sponsorshipCountry,
    actionType: 2,
  };

  // creators data
  creatorKeyword = $("#creator-keyword").val();
  creatorCategory = $("#creator-category").val();
  creatorSubscriber = $("#creator-subscriber").val();
  creatorType = $("#creator-sponsorshiptype").val();
  creatorCountry = $("#creator-country").val();

  const creatorData = {
    query: creatorKeyword,
    category: creatorCategory,
    type: creatorType,
    country: creatorCountry,
    subscriber: creatorSubscriber,
    actionType: 3,
  };

  // get default search for the type fo page (e.g. brand, creator, sponsorship)
  const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
  });
  // Get the value of "some_key" in eg "https://example.com/?some_key=some_value"
  let value = params.searchtype;

  dataParams = null;

  if (value === "brands") {
    dataParams = brandData;
    dataParams.searchResultStartIndexForBrand = 0;
  }
  if (value === "sponsorships") {
    dataParams = sponsorshipData;
    dataParams.searchResultStartIndexForSponsorship = 0;
  }
  if (value === "creators") {
    dataParams = creatorData;
    dataParams.searchResultStartIndexForCreator = 0;
  }

  console.log(dataParams);

  $.ajax({
    type: "POST",
    url: "profile-functions/for-search.php",
    data: dataParams,
    success: function (response) {
      $("#responseArea").html(response);
    },
    error: function (error) {
      console.log(error);
    },
  });

  // get result based on selected data for Brand results
  $(
    "#brand-keyword, #brand-category, #brand-industry, #brand-type, #brand-country"
  ).change(function (e) {
    e.preventDefault();

    // brand data
    brandKeyword = $("#brand-keyword").val();
    brandIndustry = $("#brand-industry").val();
    brandType = $("#brand-type").val();
    brandCategory = $("#brand-category").val();
    brandCountry = $("#brand-country").val();

    const brandData = {
      query: brandKeyword,
      industry: brandIndustry,
      type: brandType,
      category: brandCategory,
      country: brandCountry,
      actionType: 1,
    };

    // set searchresultstartindex to 0
    brandData.searchResultStartIndexForBrand = 0;

    console.log("when options changes => ");
    console.table(brandData);

    $.ajax({
      type: "POST",
      url: "/profile-functions/for-search.php",
      data: brandData,
      success: function (response) {
        $("#responseArea").html(response);
      },
      error: function (error) {},
    });
  });

  // search brand when user clicks on submit button
  $("#brand-submit").click(function (e) {
    e.preventDefault();
    // brand data
    brandKeyword = $("#brand-keyword").val();
    brandIndustry = $("#brand-industry").val();
    brandType = $("#brand-type").val();
    brandCategory = $("#brand-category").val();
    brandCountry = $("#brand-country").val();

    const brandData = {
      query: brandKeyword,
      industry: brandIndustry,
      type: brandType,
      category: brandCategory,
      country: brandCountry,
      actionType: 1,
    };

    // set searchresultstartindex to 0
    brandData.searchResultStartIndexForBrand = 0;

    console.log("when options changes => ");
    console.table(brandData);

    $.ajax({
      type: "POST",
      url: "/profile-functions/for-search.php",
      data: brandData,
      success: function (response) {
        $("#responseArea").html(response);
      },
      error: function (error) {},
    });
  });

  // get result based on selected data for sponsorship results
  $(
    "#sponsorship-keyword, #sponsorship-category, #sponsorship-type, #sponsorship-country"
  ).change(function (e) {
    e.preventDefault();

    // sponsorship data
    sponsorshipKeyword = $("#sponsorship-keyword").val();
    sponsorshipIndustry = $("#sponsorship-industry").val();
    sponsorshipType = $("#sponsorship-type").val();
    sponsorshipCategory = $("#sponsorship-category").val();
    sponsorshipCountry = $("#sponsorship-country").val();

    const sponsorshipData = {
      query: sponsorshipKeyword,
      industry: sponsorshipIndustry,
      type: sponsorshipType,
      category: sponsorshipCategory,
      country: sponsorshipCountry,
      actionType: 2,
    };

    // set searchresultstartindex to 0
    sponsorshipData.searchResultStartIndexForSponsorship = 0;

    console.log("when options changes => ");
    console.table(sponsorshipData);

    $.ajax({
      type: "POST",
      url: "profile-functions/for-search.php",
      data: sponsorshipData,
      success: function (response) {
        $("#responseArea").html(response);
      },
      error: function (error) {},
    });
  });

  // search sposnorship when user clicks on submit button
  $("#sponsorship-submit").click(function () {
    // sponsorship data
    sponsorshipKeyword = $("#sponsorship-keyword").val();
    sponsorshipIndustry = $("#sponsorship-industry").val();
    sponsorshipType = $("#sponsorship-type").val();
    sponsorshipCategory = $("#sponsorship-category").val();
    sponsorshipCountry = $("#sponsorship-country").val();

    const sponsorshipData = {
      query: sponsorshipKeyword,
      industry: sponsorshipIndustry,
      type: sponsorshipType,
      category: sponsorshipCategory,
      country: sponsorshipCountry,
      actionType: 2,
    };

    // set searchresultstartindex to 0
    sponsorshipData.searchResultStartIndexForSponsorship = 0;

    console.log("when options changes => ");
    console.table(sponsorshipData);

    $.ajax({
      type: "POST",
      url: "profile-functions/for-search.php",
      data: sponsorshipData,
      success: function (response) {
        $("#responseArea").html(response);
      },
      error: function (error) {},
    });
  });

  // get result based on selected data for creator results
  $(
    "#creator-keyword, #creator-category, #creator-sponsorshiptype, #creator-country, #creator-subscriber"
  ).change(function (e) {
    e.preventDefault();

    // creators data
    creatorKeyword = $("#creator-keyword").val();
    creatorCategory = $("#creator-category").val();
    creatorSubscriber = $("#creator-subscriber").val();
    creatorType = $("#creator-sponsorshiptype").val();
    creatorCountry = $("#creator-country").val();

    var creatorData = {
      query: creatorKeyword,
      category: creatorCategory,
      type: creatorType,
      country: creatorCountry,
      subscriber: creatorSubscriber,
      actionType: 3,
    };

    // set searchresultstartindex to 0
    creatorData.searchResultStartIndexForCreator = 0;

    console.log("when options changes => ");
    console.table(creatorData);

    $.ajax({
      type: "POST",
      url: "profile-functions/for-search.php",
      data: creatorData,
      success: function (response) {
        $("#responseArea").html(response);
      },
      error: function (error) {},
    });
  });

  // search creator when user clicks on submit button
  $("#creator-submit").click(function (e) {
    e.preventDefault();

    // creators data
    creatorKeyword = $("#creator-keyword").val();
    creatorCategory = $("#creator-category").val();
    creatorSubscriber = $("#creator-subscriber").val();
    creatorType = $("#creator-sponsorshiptype").val();
    creatorCountry = $("#creator-country").val();

    var creatorData = {
      query: creatorKeyword,
      category: creatorCategory,
      type: creatorType,
      country: creatorCountry,
      subscriber: creatorSubscriber,
      actionType: 3,
    };

    // set searchresultstartindex to 0
    creatorData.searchResultStartIndexForCreator = 0;

    console.log("when options changes => ");
    console.table(creatorData);

    $.ajax({
      type: "POST",
      url: "profile-functions/for-search.php",
      data: creatorData,
      success: function (response) {
        $("#responseArea").html(response);
      },
      error: function (error) {},
    });
  });

  // load more results
  $("#loadMore").click(function (e) {
    e.preventDefault();

    // Get the value of "some_key" in eg "https://example.com/?some_key=some_value"
    const params = new Proxy(new URLSearchParams(window.location.search), {
      get: (searchParams, prop) => searchParams.get(prop),
    });
    let value = params.searchtype;

    // brand data
    brandKeyword = $("#brand-keyword").val();
    brandIndustry = $("#brand-industry").val();
    brandType = $("#brand-type").val();
    brandCategory = $("#brand-category").val();
    brandCountry = $("#brand-country").val();

    var brandData = {
      query: brandKeyword,
      industry: brandIndustry,
      type: brandType,
      category: brandCategory,
      country: brandCountry,
      actionType: 1,
    };

    // sponsorship data
    sponsorshipKeyword = $("#sponsorship-keyword").val();
    sponsorshipIndustry = $("#sponsorship-industry").val();
    sponsorshipType = $("#sponsorship-type").val();
    sponsorshipCategory = $("#sponsorship-category").val();
    sponsorshipCountry = $("#sponsorship-country").val();

    var sponsorshipData = {
      query: sponsorshipKeyword,
      industry: sponsorshipIndustry,
      type: sponsorshipType,
      category: sponsorshipCategory,
      country: sponsorshipCountry,
      actionType: 2,
    };

    // creators data
    creatorKeyword = $("#creator-keyword").val();
    creatorCategory = $("#creator-category").val();
    creatorSubscriber = $("#creator-subscriber").val();
    creatorType = $("#creator-sponsorshiptype").val();
    creatorCountry = $("#creator-country").val();

    var creatorData = {
      query: creatorKeyword,
      category: creatorCategory,
      type: creatorType,
      country: creatorCountry,
      subscriber: creatorSubscriber,
      actionType: 3,
    };

    // set data parameters for results
    dataParams = null;

    // get search result index
    var searchResultStartIndexForBrand = localStorage.getItem(
      "searchResultStartIndexForBrand"
    );
    var searchResultStartIndexForCreator = localStorage.getItem(
      "searchResultStartIndexForCreator"
    );
    var searchResultStartIndexForSponsorship = localStorage.getItem(
      "searchResultStartIndexForSponsorship"
    );

    // increment search result index
    searchResultStartIndexForBrand =
      parseInt(searchResultStartIndexForBrand) + 20;
    searchResultStartIndexForCreator =
      parseInt(searchResultStartIndexForCreator) + 20;
    searchResultStartIndexForSponsorship =
      parseInt(searchResultStartIndexForSponsorship) + 20;

    // save incremented search result index
    localStorage.setItem(
      "searchResultStartIndexForBrand",
      searchResultStartIndexForBrand
    );
    localStorage.setItem(
      "searchResultStartIndexForCreator",
      searchResultStartIndexForCreator
    );
    localStorage.setItem(
      "searchResultStartIndexForSponsorship",
      searchResultStartIndexForSponsorship
    );

    // set data for brand search
    if (value === "brands") {
      brandData.searchResultStartIndexForBrand = searchResultStartIndexForBrand;
      dataParams = brandData;
    }

    // set data for sponsorships search
    if (value === "sponsorships") {
      sponsorshipData.searchResultStartIndexForSponsorship =
        searchResultStartIndexForSponsorship;
      dataParams = sponsorshipData;
    }

    // set data for creators search
    if (value === "creators") {
      creatorData.searchResultStartIndexForCreator =
        searchResultStartIndexForCreator;
      dataParams = creatorData;
    }

    console.log("when loading more => ");
    console.table(dataParams);

    $.ajax({
      type: "POST",
      url: "profile-functions/for-search.php",
      data: dataParams,
      success: function (response) {
        $("#responseArea").append(response);
      },
      error: function (error) {},
    });
  });
});
