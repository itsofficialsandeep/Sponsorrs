<?php

include_once("../misc/functions.php");
$sp = $_GET['sp'];
$currentUser = $_SESSION['currentUser'];
//Sql to get logged in user details.
$sql = "SELECT *
		FROM sponsorships 
		WHERE sponsorship_id='$sp'";
$result = $conn->query($sql);

//	username, company name, email address, phone number, country, state, city, website, about, logo, industry, benefit

//If user exists then show his details.
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		?>
		<div class="col-xl-9">
			<!-- Edit profile START -->
			<div class="card bg-transparent border rounded-3">
				<!-- Card header -->
				<div class="card-header bg-transparent border-bottom">
					<h3 class="card-header-title mb-0">Edit Sponsorship</h3>
				</div>
				<!-- Card body START -->
				<div class="card-body">
					<!-- Form -->
					<form class="row g-4">

						<!-- Category -->
						<div class="col-6  ori">
							<label class="form-label">Sponsorship category:</label>
							<select class="form-select js-choice sponsorship-category" aria-label=".form-select-sm"
								id="edit-sponsorship-category">

								<option value="<?php echo $row['adcategory']; ?>"><?php echo adcategoryNumToString($row['adcategory']); ?></option>
								<option value="0">Techincal</option>
								<option value="1">Comercial</option>
								<option value="2">Vlogger</option>
								<option value="3">Educator</option>
								<option value="4">Photogradphy</option>
								<option value="5">Gaming</option>
								<option value="6">Fitness</option>
								<option value="7">News</option>
								<option value="8">Comody Shows</option>
								<option value="9">Makeup</option>
								<option value="10">Experiment</option>
								<option value="11">Toy Review</option>
								<option value="12">Food</option>
								<option value="13">Clothe</option>
							</select>
						</div>
						<!-- Category -->
						<div class="col-6  ori">
							<label data-p="<?php echo $row['adtype']; ?>" class="form-label">Sponsorship Type:</label>
							<select class="form-select js-choice sponsorship-type" aria-label=".form-select-sm"
								id="edit-sponsorship-type">
								<option value="<?php echo $row['adtype']; ?>"><?php echo adtypeNumToString($row['adtype']); ?>
								</option>
								<option value="1">Type 1</option>
								<option value="2">Type 2</option>
								<option value="3">Type 3</option>
								<option value="4">Type 4</option>
							</select>
						</div>

						<!-- Full name -->
						<div class="col-6">
							<label class="form-label">Sponsorship title</label>
							<div class="input-group">
								<input id="edit-sponsorship-title" type="text" class="form-control sponsorship-title"
									value="<?php echo $row['sponsorship_title']; ?>" placeholder="Sponsorship title">
							</div>
							<div class="form-text text-danger d-none" id="alert-text-sponsorship-title">Characters should be
								less than
								255.</div>

						</div>

						<!-- Email id -->
						<div class="col-md-6">
							<label class="form-label">Sponsorship Description</label>
							<input class="form-control sponsorship-description" id="edit-sponsorship-description" type="text"
								value="<?php echo $row['description']; ?>" placeholder="Sponsorship description">
							<div class="form-text text-danger d-none" id="alert-text-description">Something went wrong here.
							</div>
						</div>

						<!-- Username -->
						<div class="col-md-6">
							<label class="form-label">Offer price</label>
							<input class="form-control offer-price" id="edit-offer-price" type="number"
								value="<?php echo $row['offer_price']; ?>" placeholder="Offer price">
							<div class="form-text text-danger d-none" id="alert-text-offer-price">Something went wrong here.
							</div>

						</div>

						<div class="col-6 ori">
							<label class="form-label">Product/Service</label>
							<select class="form-select js-choice product-service" aria-label=".form-select-sm"
								id="edit-product-service">
								<option value="<?php echo $row['service']; ?>"><?php echo adserviceNumToString($row['service']); ?>
								</option>
								<option value="1">Product</option>
								<option value="2">Service</option>
							</select>
						</div>

						<div class="col-6 ori">
							<label class="form-label">Delete this sponsorship?</label>
							<select class="form-select js-choice sponsorship-delete" aria-label=".form-select-sm"
								id="edit-delete">
								<option value="1">NO</option>
								<option value="0">Delete this</option>
							</select>
						</div>

						<input type="hidden" class="sponsorship-id" value="<?php echo $_GET['sp']; ?>">

						<!-- Save button -->
						<div class="d-sm-flex justify-content-left">
							<button id="sponsorship-submit" data-action="update" type="button" data-token="d"
								class="btn btn-primary mb-0 sponsorship-submit">Update</button>
						</div>
					</form>
				</div>
				<!-- Card body END -->
			</div>
			<!-- Edit profile END -->
		</div>

		<?php
	}
}
?>