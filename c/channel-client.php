<div class="col-xl-9">
	<!-- Card START -->
	<div class="card border bg-transparent rounded-3">
		<!-- Card header START -->
		<div class="card-header bg-transparent border-bottom d-flex justify-content-between">
			<h3 class="mb-0">My clients</h3>
			<div class="col-md-3">
				<!-- Short by filter -->
				<form id="client-sortbycategory-form">
					<select class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm"
						id="client-sortbycategory-select">
						<option value="1">Sort by: Company Name</option>
						<option value="2">Sort by: Industry</option>
						<option value="3">Sort by: Country</option>
					</select>
				</form>
			</div>
		</div>
		<!-- Card header END -->

		<!-- Card body START -->
		<div class="card-body">

			<!-- Search and select START -->
			<div class="row g-3 align-items-center justify-content-between mb-4">
				<!-- Search -->
				<div class="col-md-8" style="display:none">
					<form class="rounded position-relative" id="client-searchbar-form">
						<input class="form-control pe-5 bg-transparent" type="search" placeholder="Search"
							aria-label="Search" id="client-searchbar">
						<button
							class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset"
							type="button" id="client-searchbar-button">
							<i class="fas fa-search fs-6 "></i>
						</button>
					</form>
				</div>

				<!-- Student list table START -->
				<div class="table-responsive border-0">
					<table class="table table-dark-gray align-middle p-4 mb-0 table-hover">
						<!-- Table head -->
						<thead>
							<tr>
								<th scope="col" class="border-0 rounded-start">Client name</th>
								<th scope="col" class="border-0">Location</th>
								<th scope="col" class="border-0">Industry</th>
								<th scope="col" class="border-0">Website</th>
								<th scope="col" class="border-0 rounded-end">Action</th>
							</tr>
						</thead>

						<!-- Table body START -->
						<tbody id="client-list">
							<!-- Table item -->
						</tbody>
						<!-- Table body END -->
					</table>
				</div>
				<!-- Student list table END -->

				<!-- Pagination START -->
				<div class="d-sm-flex justify-content-sm-center align-items-sm-center mt-4 mt-sm-3">
					<button class="border border-primary bg-primary p-2 rounded text-white" id="load-more-clients">Load
						More</button>
				</div>
				<!-- Pagination END -->
			</div>
			<!-- Card body START -->
		</div>
		<!-- Card END -->
	</div>