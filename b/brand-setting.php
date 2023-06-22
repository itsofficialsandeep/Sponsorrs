<?php
include_once("../misc/db.php");

$currentUser = $_SESSION['currentUser'];

$businessName = "";
$businessType = "";
$IFSC_code = "";
$accountNumber = "";
$beneficiaryName = "";
$gender = "";
$dateOfBirth = "";
$email = "";
$mobile = "";
$address = "";
$country = "";
$state = "";
$city = "";
$zip = "";

$sqlPayementAccountData = $conn->prepare("SELECT * FROM payment_account_details where primary_ac_id = ?");

$sqlPayementAccountData->bind_param("s", $currentUser);

if ($sqlPayementAccountData->execute()) {
	$result = $sqlPayementAccountData->get_result();
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$businessName = $row['business_name'];
		$businessType = $row['business_type'];
		$IFSC_code = $row['ifsc_code'];
		$accountNumber = $row['account_number'];
		$beneficiaryName = $row['beneficiary_name'];
		$gender = $row['gender'];
		$dateOfBirth = $row['dob'];
		$email = $row['email'];
		$mobile = $row['phone_number'];
		$address = $row['address'];
		$country = $row['country'];
		$state = $row['state'];
		$city = $row['city'];
		$zip = $row['zipcode'];
		$sqlPayementAccountData->close();
	}
} else {
	echo "Something went wrong";
}

?>

<div class="col-xl-9">
	<!-- Privacy START -->

	<div class="border rounded-3">
		<!-- Card header -->
		<div class="card-header bg-transparent border-bottom p-3">
			<h3 class="card-header-title m-2">Edit Profile</h3>
		</div>
		<div class="row g-3 p-5">
			<div class="d-flex justify-content-left">
				<h5 class="mb-0">Payment Account Settings</h5>
				<span class="badge bg-success bg-opacity-10 text-success fs-6"
					style="margin-left:10px"><b>Active</b></span>
			</div>
			<p class="" style="margin-left:0px"><small>You will recieve sponsorship payments on this account.</small>
			</p>
			<!-- Business name -->
			<div class="col-12">
				<div class="row g-xl-0 align-items-center">
					<div class="col-lg-4">
						<h6 class="mb-lg-0">Business Name<span class="text-danger">*</span></h6>
					</div>
					<div class="col-lg-8">
						<input type="text" value="<?php echo $businessName; ?>" class="form-control"
							id="channel-account-businessname">
					</div>
				</div>
			</div>

			<!-- BUusiness Type -->
			<div class="col-12">
				<div class="row g-xl-0 align-items-center">
					<div class="col-lg-4">
						<h6 class="mb-lg-0">Business Type<span class="text-danger">*</span></h6>
					</div>
					<div class="col-lg-8">
						<select required="" name="business_type" autocomplete="off" class="form-control  input-lg"
							id="channel-account-business-type">
							<option value="4" <?php $s = $businessType == 4 ? "selected" : "";
							echo $s; ?>>Private
								Limited</option>
							<option value="1" <?php $s = $businessType == 1 ? "selected" : "";
							echo $s; ?>>Proprietorship
							</option>
							<option value="3" <?php $s = $businessType == 3 ? "selected" : "";
							echo $s; ?>>Partnership
							</option>
							<option value="2" <?php $s = $businessType == 2 ? "selected" : "";
							echo $s; ?>>Individual
							</option>
							<option value="5" <?php $s = $businessType == 5 ? "selected" : "";
							echo $s; ?>>Public Limited
							</option>
							<option value="6" <?php $s = $businessType == 6 ? "selected" : "";
							echo $s; ?>>LLP</option>
							<option value="9" <?php $s = $businessType == 9 ? "selected" : "";
							echo $s; ?>>Trust</option>
							<option value="10" <?php $s = $businessType == 10 ? "selected" : "";
							echo $s; ?>>Society
							</option>
							<option value="7" <?php $s = $businessType == 7 ? "selected" : "";
							echo $s; ?>>NGO</option>
						</select>
					</div>
				</div>
			</div>

			<!-- IFSC Code -->
			<div class="col-12">
				<div class="row g-xl-0 align-items-center">
					<div class="col-lg-4">
						<h6 class="mb-lg-0">Branch IFSC Code<span class="text-danger">*</span></h6>
					</div>
					<div class="col-lg-8">
						<input type="text" value="<?php echo $IFSC_code; ?>" class="form-control"
							id="channel-account-IFSC-code">
					</div>
				</div>
			</div>

			<!-- A/c number -->
			<div class="col-12">
				<div class="row g-xl-0 align-items-center">
					<div class="col-lg-4">
						<h6 class="mb-lg-0">Account Number<span class="text-danger">*</span></h6>
					</div>
					<div class="col-lg-8 d-flex justify-content-between">
						<input type="text" value="<?php echo $accountNumber; ?>" class="form-control me-4"
							id="channel-account-account-number">
						<input type="text" value="<?php echo $accountNumber; ?>" class="form-control"
							id="channel-account-confirm-account-number" placeholder="Confirm Account number">
					</div>
				</div>
			</div>

			<!-- Beneficiary Name -->
			<div class="col-12">
				<div class="row g-xl-0 align-items-center">
					<div class="col-lg-4">
						<h6 class="mb-lg-0">Beneficiary Name<span class="text-danger">*</span></h6>
					</div>
					<div class="col-lg-8">
						<input type="text" value="<?php echo $beneficiaryName; ?>" class="form-control"
							id="channel-account-beneficiary-name">
					</div>
				</div>
			</div>

			<!-- Gender -->
			<div class="col-12">
				<div class="row g-xl-0 align-items-center">
					<div class="col-lg-4">
						<h6 class="mb-lg-0">Gender <span class="text-danger">*</span></h6>
					</div>
					<div class="col-lg-8">
						<div class="d-flex">
							<div class="form-check radio-bg-light me-4">
								<input class="form-check-input" type="radio" name="gender" id="channel-account-male"
									value="1" <?php $s = $gender == 1 ? "checked" : "";
									echo $s; ?>>
								<label class="form-check-label" for="gender">
									Male
								</label>
							</div>
							<div class="form-check radio-bg-light me-4">
								<input class="form-check-input" type="radio" name="gender" id="channel-account-female"
									value="2" <?php $s = $gender == 2 ? "checked" : "";
									echo $s; ?>>
								<label class="form-check-label" for="gender">
									Female
								</label>
							</div>
							<div class="form-check radio-bg-light">
								<input class="form-check-input" type="radio" name="gender" id="channel-account-other"
									value="3" <?php $s = $gender == 3 ? "checked" : "";
									echo $s; ?>>
								<label class="form-check-label" for="gender">
									Other
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Date of birth -->
			<div class="col-12">
				<div class="row g-xl-0 align-items-center">
					<div class="col-lg-4">
						<h6 class="mb-lg-0">Date of birth</h6>
					</div>
					<div class="col-lg-8">
						<div class="row g-2 g-sm-4">
							<div class="col-4 d-flex justify-content-evenly">
								<input type="text" value="<?php echo $dateOfBirth; ?>" class="form-control mr-5"
									id="channel-account-DateOfBirth" placeholder="DD/MM/YYYY">

							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Email -->
			<div class="col-12">
				<div class="row g-xl-0 align-items-center">
					<div class="col-lg-4">
						<h6 class="mb-lg-0">Email <span class="text-danger">*</span></h6>
					</div>
					<div class="col-lg-8">
						<input type="email" value="<?php echo $email; ?>" class="form-control"
							id="channel-account-email">
					</div>
				</div>
			</div>

			<!-- Phone number -->
			<div class="col-12">
				<div class="row g-xl-0 align-items-center">
					<div class="col-lg-4">
						<h6 class="mb-lg-0">Phone number <span class="text-danger">*</span></h6>
					</div>
					<div class="col-lg-8">
						<input type="text" value="<?php echo $mobile; ?>" class="form-control"
							id="channel-account-phoneNumber">
					</div>
				</div>
			</div>

			<!-- Home address -->
			<div class="col-12">
				<div class="row g-xl-0">
					<div class="col-lg-4">
						<h6 class="mb-lg-0">Your address <span class="text-danger">*</span></h6>
					</div>
					<div class="col-lg-8">
						<textarea class="form-control" rows="3" placeholder=""
							id="channel-account-address"><?php echo $address; ?></textarea>
					</div>
				</div>
			</div>

			<!-- Country -->
			<div class="col-12">
				<div class="row g-xl-0 align-items-center">
					<div class="col-lg-4">
						<h6 class="mb-lg-0">Select country <span class="text-danger">*</span></h6>
					</div>
					<div class="col-lg-8">
						<div class="form-holder">
							<fieldset>
								<select class="form-control  input-lg" id="channel-account-country"
									name="company_country" required>
									<?php

									// if there is no country selected
									if (!$country) {
										echo '<option selected value="">Select Country</option>';
									} else {
										//	if there is country in db
										echo '<option selected value="' . $country . '">' . $country . '</option>';
									}

									$sql = "SELECT * FROM countries";
									$result = $conn->query($sql);
									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {
											echo "<option value='" . $row['name'] . "' data-id='" . $row['id'] . "'>" . $row['name'] . "</option>";
										}
									}
									?>
								</select>
							</fieldset>
						</div>
					</div>
				</div>
			</div>

			<!-- State -->
			<div class="col-12">
				<div class="row g-xl-0 align-items-center">
					<div class="col-lg-4">
						<h6 class="mb-lg-0">Select state <span class="text-danger">*</span></h6>
					</div>
					<div class="col-lg-8" id="channel-account-stateDiv">
						<select class="form-control  input-lg" id="channel-account-state" name="state" required>
							<?php
							// if there is no country selected
							if (!$state) {
								echo '<option selected value="">Select state</option>';
							} else {
								//	if there is country in db
								echo '<option selected value="' . $state . '">' . $state . '</option>';
							}
							?>
						</select>
					</div>
				</div>
			</div>

			<!-- City -->
			<div class="col-12">
				<div class="row g-xl-0 align-items-center">
					<div class="col-lg-4">
						<h6 class="mb-lg-0">Select city <span class="text-danger">*</span></h6>
					</div>
					<div class="col-lg-8" id="channel-account-cityDiv">
						<select class="form-control  input-lg" id="channel-account-city" name="city" required>
							<?php
							// if there is no country selected
							if (!$state) {
								echo '<option selected value="">Select city</option>';
							} else {
								//	if there is country in db
								echo '<option selected value="' . $city . '">' . $city . '</option>';
							}
							?>
						</select>
					</div>
				</div>
			</div>

			<!-- Zip code-->
			<div class="col-12">
				<div class="row g-xl-0 align-items-center">
					<div class="col-lg-4">
						<h6 class="mb-lg-0">Zip code <span class="text-danger">*</span></h6>
					</div>
					<div class="col-lg-8">
						<input type="text" value="<?php echo $zip; ?>" class="form-control"
							id="channel-account-zipCode">
					</div>
				</div>
			</div>

			<h6 id="form-alert" style="display:none">Fill your form correctly..</h6>

			<!-- Button -->
			<div class="col-12 text-sm-end">
				<button class="btn btn-primary mb-0" id="channel-account-submit">Submit</button>
			</div>
			<!-- Divider -->
			<hr class="my-5">
		</div>

		<div class="row d-flex justify-content-center">
			<div class="col-5 m-3">
				<div class="col-12 d-flex justify-content-center">
					<!-- Password change START -->
					<div class="col-lg-12 ml-2">
						<div class="card border bg-transparent rounded-3">
							<!-- Card header -->
							<div class="card-header bg-transparent border-bottom">
								<h5 class="card-header-title mb-0">Update password</h5>
							</div>
							<!-- Card body START -->
							<div class="card-body">
								<!-- Current password -->
								<div class="mb-3">
									<input id="current-password" class="form-control" type="password"
										placeholder="Enter current password">
								</div>
								<!-- New password -->
								<div class="mb-3">
									<div class="input-group">
										<input id="psw-input" class="form-control" type="password"
											placeholder="Enter new password">
									</div>
									<div class="rounded mt-1" id="psw-strength"></div>
									<div id="pswmeter" class="mt-2 password-strength-meter d-none">
										<div class="password-strength-meter-score"></div>
									</div>
									<div class="d-flex mt-1">
										<div id="pswmeter-message" class="rounded fs-7 text-danger">Easy peasy!</div>
										<!-- Password message notification -->
										<div class="ms-auto">
											<i class="bi bi-info-circle ps-1" data-bs-container="body"
												data-bs-toggle="popover" data-bs-placement="top"
												data-bs-content="Include at least one uppercase, one lowercase, one special character, one number and 8 characters long."
												data-bs-original-title="" title=""></i>
										</div>
									</div>
								</div>

								<!-- Confirm password -->
								<div>
									<input id="confirm-password" class="form-control" type="password"
										placeholder="Enter new password">
									<label class="form-label text-success" id="match-alert" style="display:none">
										Password
										Matched!</label>

								</div>

								<!-- Button -->
								<div class="d-flex justify-content-end mt-4">
									<button id="submit-change-password" type="button"
										class="btn btn-primary mb-0">Change
										password</button>
								</div>
							</div>
							<!-- Card body END -->
						</div>
					</div>
					<!-- Password change end -->
				</div>
			</div>

			<div class="col-6 m-3">
				<div class="col-12 d-flex justify-content-center">
					<!-- Password change START -->
					<div class="col-lg-12 ml-2">
						<div class="card border bg-transparent rounded-3">
							<!-- Card header -->
							<div class="card-header bg-transparent border-bottom">
								<h5 class="card-header-title mb-0">Update E-Mail</h5>
							</div>
							<!-- Card body START -->
							<div class="card-body">
								<div class="mb-3">
									<div class="input-group">
										<input id="new-mail" class="form-control" type="email"
											placeholder="Enter new E-Mail">
										<button id="get-otp" type="button" data-token=""
											class="btn btn-primary mb-0 d-flex">Get
											OTP</button>
									</div>
								</div>
								<div class="mb-3 mt-3">
									<div class="input-group">
										<input id="otp-input" class="form-control" type="text" placeholder="Type OTP">
										<button id="verify-otp" type="button"
											class="btn btn-primary mb-0">Verify</button>
									</div>
								</div>
							</div>
							<!-- Card body END -->
						</div>
					</div>
					<!-- Password change end -->
				</div>
			</div>
		</div>

		<!-- Main content END -->
	</div><!-- Row END -->
</div>