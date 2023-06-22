<div class="col-xl-9">
	<!-- Card START -->
	<div class="card border bg-transparent rounded-3">
		<!-- Card header START -->
		<div class="card-header bg-transparent border-bottom">
			<h3 class="mb-0">My Sponsorship List</h3>
		</div>
		<!-- Card header END -->

		<!-- Card body START -->
		<div class="card-body">

			<!-- Search and select START -->
			<div class="row g-3 align-items-center justify-content-between mb-1">
				<!-- Search -->
				<div class="col-md-8" style="display:none">
					<form class="rounded position-relative" id="sponsorship_search_form">
						<input class="form-control pe-5 bg-transparent" type="search" placeholder="Search"
							aria-label="Search" id="sponsorship_search" onckeyup="">
						<button
							class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset"
							id="sponsorship_search_button" style="display:none">
							<i class="fas fa-search fs-6 "></i>
						</button>
					</form>
				</div>
				<div class="col-md-6" id="noContentFound">
					<p class="bg-info-subtle rounded text-black p-2 d-inline-flex p-2 ">
						<i class="bi bi-exclamation-circle-fill align-middle" style="margin-right: 20px;"></i>Your
						sponsorships
						requests will be
						shown below!
					</p>
				</div>
				<!-- Select option -->
				<div class="col-md-3">
					<!-- Short by filter -->
					<form>
						<select class="form-select js-choice border-0 z-index-9 bg-transparent"
							aria-label=".form-select-sm" id="sponsorship_search_filter">

							<option value="1">Sort by: Accepted</option>
							<option value="0">Sort by: Rejected</option>
							<option value="2">Sort by: Sent</option>
							<option value="3">Sort by: All</option>
						</select>
					</form>
				</div>
			</div>
			<!-- Search and select END -->

			<!-- Course list table START -->
			<div class="table-responsive border-0">
				<table class="table table-dark-gray align-middle p-4 mb-0 table-hover">
					<!-- Table head -->
					<thead>
						<tr>
							<th scope="col" class="border-0 rounded-start">Sponsorship Title</th>
							<th scope="col" class="border-0">Request Date</th>
							<th scope="col" class="border-0">Status</th>
							<th scope="col" class="border-0">Offer</th>
							<th scope="col" class="border-0 rounded-end">Action</th>
						</tr>
					</thead>

					<!-- Table body START -->
					<tbody id="tablebody">

					</tbody>
					<!-- Table body END -->
				</table>
			</div>
			<!-- Course list table END -->

			<!-- Pagination START -->
			<div class="d-sm-flex justify-content-sm-center align-items-sm-center mt-4 mt-sm-3">
				<button class="border border-primary bg-primary p-2 rounded text-white" id="loadMoreSponsorhips">Load
					More</button>
			</div>
			<!-- Pagination END -->
		</div>
		<!-- Card body START -->
	</div>
	<!-- Card END -->
</div>