<div class="col-xl-9">
	<!-- Card START -->
	<div class="card border bg-transparent rounded-3">
		<!-- Card header START -->
		<div class="card-header bg-transparent border-bottom">
			<h3 class="mb-0">Sponsorships you have Saved</h3>
		</div>
		<!-- Card header END -->

		<!-- Card body START -->
		<div class="card-body">

			<!-- Search and select START -->
			<div class="row g-3 align-items-center justify-content-between mb-4">
				<!-- Search -->
				<div class="col-md-8">
					<form class="rounded position-relative" id="saved-sponsorship-searchbar-form">
						<input class="form-control pe-5 bg-transparent" type="search"
							placeholder="Search by brand name.." aria-label="Search" id="saved-sponsorship-searchbar">
						<button
							class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset"
							type="submit" id="saved-sponsorship-searchbar-button">
							<i class="fas fa-search fs-6 "></i>
						</button>
					</form>
				</div>

				<!-- Select option -->
				<div class="col-md-3">
					<!-- Short by filter -->
					<form id="saved-sponsorship-filter-form">
						<select class="form-select js-choice border-0 z-index-9 bg-transparent"
							aria-label=".form-select-sm" id="saved-sponsorship-filter-option">
							<option value="1">Sort by: Offer price</option>
							<option value="2">Sort by: Sponsorship Type</option>
							<option value="3">Sort by: Sponsorship category</option>
							<option value="4">Sort by: Sponsorship date</option>
							<option value="5">Sort by: Sponsorship active</option>
							<option value="6">Sort by: Brand name</option>
						</select>
					</form>
				</div>
			</div>
			<!-- Search and select END -->

			<!-- Student list table START -->
			<div class="table-responsive border-0">
				<table class="table table-dark-gray align-middle p-4 mb-0 table-hover">
					<!-- Table body START -->
					<tbody id="saved-sponsorship-response-area">
						<!-- Table item -->
					</tbody>
					<!-- Table body END -->
				</table>
			</div>
			<!-- Student list table END -->

			<!-- Pagination START -->
			<div class="d-sm-flex justify-content-sm-center align-items-sm-center mt-4 mt-sm-3">
				<button class="border border-primary bg-primary p-2 rounded text-white"
					id="saved-sponsorship-load-more">Load
					More</button>
			</div>
			<!-- Pagination END -->
		</div>
		<!-- Card body START -->
	</div>
	<!-- Card END -->
</div>