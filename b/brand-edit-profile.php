<?php
$currentUser = $_SESSION['currentUser'];
//Sql to get logged in user details.
$sql = "SELECT *, primary_ac.dp_username 
		FROM company 
		LEFT JOIN social_links 
		ON company.primary_ac_id=social_links.channel_user_id 
		LEFT JOIN primary_ac 
		ON primary_ac_id=ac_id 
		WHERE primary_ac_id='$currentUser'";
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
					<h3 class="card-header-title mb-0">Edit Profile</h3>
				</div>
				<!-- Card body START -->
				<div class="card-body">
					<!-- Form -->
					<form class="row g-4">

						<!-- Full name -->
						<div class="col-6">
							<label class="form-label">Company name</label>
							<div class="input-group">
								<input id="company-name" type="text" class="form-control"
									value="<?php echo $row['companyname']; ?>" placeholder="Company name">
							</div>
							<div class="form-text text-danger d-none" id="alert-text-company-name">Characters should be
								less than
								255.</div>

						</div>

						<!-- Email id -->
						<div class="col-md-6">
							<label class="form-label">Email id</label>
							<input class="form-control" id="email" type="email" value="<?php echo $row['email']; ?>"
								placeholder="Email" disabled>
							<div class="form-text text-danger d-none" id="alert-text-email">Something went wrong here.
							</div>

						</div>

						<!-- Username -->
						<div class="col-md-6">
							<label class="form-label">Create a username</label>
							<input class="form-control" id="new-username" type="text" value="<?php echo $row['dp_username']; ?>"
								placeholder="Username">
							<div class="form-text text-danger d-none" id="alert-text-username">Something went wrong here.
							</div>

						</div>

						<!-- Email id -->
						<div class="col-md-6">
							<label class="form-label">Intro YouTube video URL</label>
							<input class="form-control" id="intro-video" type="url" value="https://www.youtube.com/watch?v=<?php echo $row['intro_video']; ?>"
								placeholder="Intro video URL">
							<div class="form-text text-danger d-none" id="alert-text-intro-video">Something went wrong here.
							</div>

						</div>


						<!-- Phone number -->
						<div class="col-md-6">
							<label class="form-label">Phone number</label>
							<input id="phone-number" type="text" class="form-control" value="<?php echo $row['contactno']; ?>"
								placeholder="Phone number">
							<div class="form-text text-danger d-none" id="alert-text-phone-number">Please use a
								valid phone
								number.
							</div>

						</div>

						<!-- Location -->
						<div class="col-md-6">
							<label class="form-label">Country</label>
							<input id="country" class="form-control" type="text" value="<?php echo $row['country']; ?>">
							<div class="form-text text-danger d-none" id="alert-text-country">Enter a valid country
								name.
							</div>
						</div>

						<!-- Location -->
						<div class="col-md-6">
							<label class="form-label">State</label>
							<input id="state" class="form-control" type="text" value="<?php echo $row['state']; ?>">
							<div class="form-text text-danger d-none" id="alert-text-state">Enter a valid state
								name.
							</div>
						</div>

						<!-- Location -->
						<div class="col-md-6">
							<label class="form-label">City</label>
							<input id="city" class="form-control" type="text" value="<?php echo $row['city']; ?>">
							<div class="form-text text-danger d-none" id="alert-text-city">Enter a valid city
								name.
							</div>
						</div>

						<!-- About me -->
						<div class="col-12">
							<label class="form-label">About you</label>
							<input type="text" id="about-you" class="form-control" rows="8" autocomplete="off"
								value="<?php echo $row['aboutme']; ?>">
							<div class="form-text text-danger d-none" id="alert-text-about-you">Brief description
								about
								your
								company. Characters should be
								less than 500</div>
						</div>

						<!-- About me -->
						<div class="col-12">
							<h5 class="form-label fs-5">Benefit a brand will get.</h5>
							<label class="form-label">Five line description separated with dot (full stop)</label>
							<textarea id="benefit" class="form-control" rows="5"><?php echo $row['benefit']; ?></textarea>
							<div class="form-text text-danger d-none" id="alert-text-benefit">File line description separated
								with dot </div>
						</div>

						<div class="d-flex justify-content-between">
							<div class="col-5">
								<label class="form-label">Industry</label>
								<form id="saved-sponsorship-filter-form" class="bg-success">
									<select class="bg-success form-select js-choice border-0 z-index-9 bg-transparent"
										aria-label=".form-select-sm" id="company-industry">

										<option <?php if ($row['industry'] == '-') {
											echo "selected";
										} ?> value="-">
											Choose
											Industry</option>
										<option <?php if ($row['industry'] == 0) {
											echo "selected";
										} ?> value="0">
											Techincal</option>
										<option <?php if ($row['industry'] == 1) {
											echo "selected";
										} ?> value="1">
											Comercial</option>
										<option <?php if ($row['industry'] == 2) {
											echo "selected";
										} ?> value="2">Vlogger
										</option>
										<option <?php if ($row['industry'] == 3) {
											echo "selected";
										} ?> value="3">
											Educator
										</option>
										<option <?php if ($row['industry'] == 4) {
											echo "selected";
										} ?> value="4">
											Photogradphy</option>
										<option <?php if ($row['industry'] == 5) {
											echo "selected";
										} ?> value="5">Gaming
										</option>
										<option <?php if ($row['industry'] == 6) {
											echo "selected";
										} ?> value="6">Fitness
										</option>
										<option <?php if ($row['industry'] == 7) {
											echo "selected";
										} ?> value="7">News
										</option>
										<option <?php if ($row['industry'] == 8) {
											echo "selected";
										} ?> value="8">Comody
											Shows</option>
										<option <?php if ($row['industry'] == 9) {
											echo "selected";
										} ?> value="9">Makeup
										</option>
										<option <?php if ($row['industry'] == 10) {
											echo "selected";
										} ?> value="10">
											Experiment</option>
										<option <?php if ($row['industry'] == 11) {
											echo "selected";
										} ?> value="11">Toy
											Review</option>
										<option <?php if ($row['industry'] == 12) {
											echo "selected";
										} ?> value="12">Food
										</option>
										<option <?php if ($row['industry'] == 13) {
											echo "selected";
										} ?> value="13">
											Clothe
										</option>
									</select>
								</form>
								<div class="form-text text-danger d-none" id="alert-text-company-industry">
									Choose one option
									form the
									list.</div>

							</div>

						</div>
						<!-- Save button -->
						<div class="d-sm-flex justify-content-left">
							<button id="submit-basic-detail" type="button" class="btn btn-primary mb-0">Save changes</button>
						</div>
					</form>
				</div>
				<!-- Card body END -->
			</div>
			<!-- Edit profile END -->

			<div class="row g-4 mt-3">

				<!-- Social media profile START -->
				<div class="col-lg-12">
					<div class=" card bg-transparent border rounded-3">
						<!-- Card header -->
						<div class="card-header bg-transparent border-bottom">
							<h5 class="card-header-title mb-0">Social media profile</h5>
						</div>
						<!-- Card body START -->
						<div class="card-body row g-4">
							<!-- Facebook username -->

							<div class="col-lg-6 mb-3">
								<label class="form-label"><i class="fab fa-facebook text-facebook me-2"></i>Enter Facebook
									username:</label>
								<input id="facebook-username" class="form-control" type="text"
									value="<?php echo $row['facebook']; ?>" placeholder="Enter username">
							</div>

							<!-- Twitter username -->
							<div class="col-lg-6 mb-3">
								<label class="form-label"><i class="bi bi-twitter text-twitter me-2"></i>Enter Twitter
									username:</label>
								<input id="twitter-username" class="form-control" type="text"
									value="<?php echo $row['twitter']; ?>" placeholder="Enter username">
							</div>

							<!-- Instagram username -->
							<div class="col-lg-6 mb-3">
								<label class="form-label"><i class="fab fa-instagram text-instagram-gradient me-2"></i>Enter
									Instagram username:</label>
								<input id="instagram-username" class="form-control" type="text"
									value="<?php echo $row['instagram']; ?>" placeholder="Enter username">
							</div>

							<!-- Youtube -->
							<div class="col-lg-6 mb-3">
								<label class="form-label"><i class="fab fa-youtube text-youtube me-2"></i>YouTube channel
									1:</label>
								<input id="youtube-channel-1" class="form-control" type="text"
									value="<?php echo $row['youtube_1']; ?>" placeholder="Enter username">
							</div>

							<!-- Youtube -->
							<div class="col-lg-6 mb-3">
								<label class="form-label"><i class="fab fa-youtube text-youtube me-2"></i>YouTube channel
									2:</label>
								<input id="youtube-channel-2" class="form-control" type="text"
									value="<?php echo $row['youtube_2']; ?>" placeholder="Enter username">
							</div>
							<!-- Youtube -->
							<div class="col-lg-6 mb-3">
								<label class="form-label"><i class="fab fa-youtube text-youtube me-2"></i>YouTube channel
									3:</label>
								<input id="youtube-channel-3" class="form-control" type="text"
									value="<?php echo $row['youtube_3']; ?>" placeholder="Enter username">
							</div>

							<div class="col-lg-6 mb-3">
								<label class="form-label"><i class="fab fa-linkedin text-linkedin me-2"></i>Enter LinkedIn
									username:</label>
								<input id="linkedin-username" class="form-control" type="text"
									value="<?php echo $row['linkedin']; ?>" placeholder="Enter username">
							</div>

							<!-- Twitter username -->
							<div class="col-lg-6 mb-3">
								<label class="form-label"><i class="bi bi-snapchat text-snapchat me-2"></i>Enter Snapchat
									username:</label>
								<input id="snapchat-username" class="form-control" type="text"
									value="<?php echo $row['snapchat']; ?>" placeholder="Enter username">
							</div>

							<!-- Instagram username -->
							<div class="col-lg-6 mb-3">
								<label class="form-label"><i class="fab fa-reddit text-reddit-gradient me-2"></i>Enter
									Reddit username:</label>
								<input id="reddit-username" class="form-control" type="text"
									value="<?php echo $row['reddit']; ?>" placeholder="Enter username">
							</div>
							<!-- Instagram username -->
							<div class="col-lg-6 mb-3">
								<label class="form-label"><i class="fab fa-tiktok text-instagram-gradient me-2"></i>Enter
									Tiktok username:</label>
								<input id="tiktok-username" class="form-control" type="text"
									value="<?php echo $row['tiktok']; ?>" placeholder="Enter username">
							</div>
							<!-- Instagram username -->
							<div class="col-lg-6 mb-3">
								<label class="form-label"><i class="fab fa-pinterest text-instagram-gradient me-2"></i>Enter
									Pinterest username:</label>
								<input id="pinterest-username" class="form-control" type="text"
									value="<?php echo $row['pinterest']; ?>" placeholder="Enter username">
							</div>
							<!-- Instagram username -->
							<div class="col-lg-6 mb-3">
								<label class="form-label"><i class="bi bi-globe me-2"></i>Enter
									Website:</label>
								<input id="website" class="form-control" type="text" value="<?php echo $row['website']; ?>"
									placeholder="https://example.com">
							</div>

							<!-- Button -->
							<div class="d-flex justify-content-end mt-4">
								<div class="text-success fs-6 d-flex justify-content-right mr-4">
									<div id="changes-saved" style="display:none">Changes saved..</div>
								</div>
								<input id="submit-social" type="button" class="btn btn-primary mb-0" value="Save Changes">
							</div>

						</div>
						<!-- Card body END -->
					</div>
				</div>
				<!-- Social media profile END -->



			</div>
		</div>

		<?php
	}
}
?>