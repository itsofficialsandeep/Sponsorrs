$(document).ready(function () {
  // sponsorship cretion or updation
  $(".sponsorship-submit").click(function (event) {
    actionType = $(this).attr("data-action");
    actionToken = $(this).attr("data-token");

    console.log(actionType);

    sponsorship_category = $(".sponsorship-category").val();
    sponsorship_type = $(".sponsorship-type").val();
    sponsorship_title = $(".sponsorship-title").val();
    sponsorship_description = $(".sponsorship-description").val();
    offer_price = $(".offer-price").val();
    product_service = $(".product-service").val();
    deletesponsorship = $(".sponsorship-delete").val();
    sponsorship_id = $(".sponsorship-id").val();

    var FormData = {
      sponsorship_category: sponsorship_category,
      sponsorship_type: sponsorship_type,
      sponsorship_title: sponsorship_title,
      sponsorship_description: sponsorship_description,
      product_service: product_service,
      offer_price: offer_price,
      delete: deletesponsorship,
      sponsorship_id: sponsorship_id,
      actionType: actionType,
      actionToken: actionToken,
    };

    $.ajax({
      type: "POST",
      url: "../profile-functions/brand-create-edit-sponsorship-functions.php",
      data: FormData,
      success: function (response) {
        console.log("companyFormData ==" + JSON.stringify(FormData));
        console.log(response);

        if (response.code == 200) {
          console.log("success status-" + response.status);
          Swal.fire({
            showConfirmButton: false,
            title: '<h5 class="fs-3 text-success">Success!</h5>',
            html: '<p class="text-center">Details successfully addded.</p>',
          });
        }

        if (response.code == 400) {
          console.log("success status-" + response.status);
          Swal.fire({
            showConfirmButton: false,
            title: '<h5 class="fs-3 text-danger">Alert!</h5>',
            html: '<p class="text-center">Failed to create sponsorship at this moment.</p>',
          });
        }

        if (response.code == 500) {
          console.log("success status-" + response.status);
          Swal.fire({
            showConfirmButton: false,
            title: '<h5 class="fs-3 text-success">Success!</h5>',
            html: '<p class="text-center">Details successfully updated.</p>',
          });
        }

        if (response.code == 600) {
          console.log("success status-" + response.status);
          Swal.fire({
            showConfirmButton: false,
            title: '<h5 class="fs-3 text-danger">Alert!</h5>',
            html: '<p class="text-center">Couldn\'t update details at this moment. \r Make sure you have changed the data!</p>',
          });
        }
      },
      error: function (error) {
        console.error(error);
      },
    });
  });
});
