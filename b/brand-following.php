<div class="col-xl-9">
	<!-- Card START -->
	<div class="card border bg-transparent rounded-3">
		<!-- Card header START -->
		<div class="card-header bg-transparent border-bottom">
			<h3 class="mb-0">Creators you are following</h3>
		</div>
		<!-- Card body START -->
		<div class="card-body">

			<!-- Search and select START -->
			<div class="row g-3 align-items-center justify-content-between mb-4  d-none">
				<!-- Search -->
				<div class="col-md-8">
					<form class="rounded position-relative" id="following-searchbar-form">
						<input class="form-control pe-5 bg-transparent" type="search"
							placeholder="Search by brand name.. " aria-label="Search" id="following-searchbar">
						<button
							class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset"
							type="submit" id="following-searchbar-button">
							<i class="fas fa-search fs-6 "></i>
						</button>
					</form>
				</div>

				<!-- Select option -->
				<div class="col-md-3">
					<!-- Short by filter -->
					<form id="following-filter-form">
						<select class="form-select js-choice border-0 z-index-9 bg-transparent"
							aria-label=".form-select-sm" id="following-filter-option">
							<option value="1">Sort by: Brand Name</option>
							<option value="2">Sort by: Location</option>
							<option value="3">Sort by: Industry</option>
							<option value="4">Sort by: Active spnsorships</option>
						</select>
					</form>
				</div>
			</div>
			<!-- Search and select END -->

			<!-- Student list table START -->
			<div class="table-responsive border-0">
				<table class="table table-dark-gray align-middle p-4 mb-0 table-hover">
					<!-- Table head -->
					<thead>
						<tr>
							<th scope="col" class="border-0 rounded-start">Brand Name</th>
							<th scope="col" class="border-0">Location</th>
							<th scope="col" class="border-0">Industry</th>
							<th scope="col" class="border-0">Subscribers</th>
							<th scope="col" class="border-0 rounded-end">Action</th>
						</tr>
					</thead>

					<!-- Table body START -->
					<tbody id="following-response-area">
						<!-- Table item -->
					</tbody>
					<!-- Table body END -->
				</table>
			</div>
			<!-- Student list table END -->

			<!-- Pagination START -->
			<div class="d-sm-flex justify-content-sm-center align-items-sm-center mt-4 mt-sm-3">
				<button class="border border-primary bg-primary p-2 rounded text-white" id="following-load-more">Load
					More</button>
			</div>
			<!-- Pagination END -->
		</div>
		<!-- Card body START -->
	</div>
	<!-- Card END -->
</div>