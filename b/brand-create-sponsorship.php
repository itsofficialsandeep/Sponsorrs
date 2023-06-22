<div class="col-xl-9">
	<!-- Edit profile START -->
	<div class="card bg-transparent border rounded-3">
		<!-- Card header -->
		<div class="card-header bg-transparent border-bottom">
			<h3 class="card-header-title mb-0">Create New Sponsorship</h3>
		</div>
		<!-- Card body START -->
		<div class="card-body">
			<!-- Form -->
			<form class="row g-4">

				<!-- Category -->
				<div class="col-6  ori">
					<label class="form-label">Sponsorship category:</label>
					<select class="form-select js-choice sponsorship-category" aria-label=".form-select-sm"
						id="sponsorship-category">
						<option value="-">Choose Category</option>
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
					<label class="form-label">Sponsorship Type:</label>
					<select class="form-select js-choice sponsorship-type" aria-label=".form-select-sm" id="">
						<option value="-">Choose Type</option>
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
						<input id="" type="text" class="form-control sponsorship-title" value=""
							placeholder="Sponsorship title">
					</div>
					<div class="form-text text-danger d-none" id="alert-text-sponsorship-title">Characters should be
						less than
						255.</div>

				</div>

				<!-- Email id -->
				<div class="col-md-6">
					<label class="form-label">Sponsorship Description</label>
					<input class="form-control sponsorship-description" id="" type="text" value=""
						placeholder="Sponsorship description">
					<div class="form-text text-danger d-none" id="alert-text-description">Something went wrong here.
					</div>
				</div>

				<!-- Username -->
				<div class="col-md-6">
					<label class="form-label">Offer price</label>
					<input class="form-control offer-price" id="offer-price" type="number" value=""
						placeholder="Offer price">
					<div class="form-text text-danger d-none" id="alert-text-offer-price">Something went wrong here.
					</div>

				</div>

				<div class="col-6 ori">
					<label class="form-label">Product/Service</label>
					<select class="form-select js-choice product-service" aria-label=".form-select-sm" id="">
						<option value="1" selected="true">Product</option>
						<option value="2">Service</option>
					</select>
				</div>

				<input type="hidden" class="sponsorship-delete" value="1">

				<!-- Save button -->
				<div class="d-sm-flex justify-content-left">
					<button id="sponsorship-submit" data-action="create" type="button" data-token="sa"
						class="btn btn-primary mb-0 sponsorship-submit">Create</button>
				</div>
			</form>
		</div>
		<!-- Card body END -->
	</div>
	<!-- Edit profile END -->
</div>