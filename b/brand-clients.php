<div class="col-xl-9">
	<!-- Card START -->
	<div class="card border bg-transparent rounded-3">
		<!-- Card header START -->
		<div class="card-header bg-transparent border-bottom">
			<h3 class="mb-0">All Client(s)</h3>
		</div>
		<!-- Card header END -->

		<!-- Card body START -->
		<div class="card-body p-0">

			<!-- Main content START -->
			<div class="col p-0">
				<div class="card rounded-2 p-0">
					<!-- Tabs START -->
					<div class="card-header border-bottom px-4 py-3">
						<ul class="nav nav-pills nav-tabs-line py-0" id="course-pills-tab" role="tablist">
							<!-- Tab item -->
							<li class="nav-item me-2 me-sm-4" role="presentation">
								<button class="nav-link mb-2 mb-md-0 active" id="course-pills-tab-1"
									data-bs-toggle="pill" data-bs-target="#course-pills-1" type="button" role="tab"
									aria-controls="course-pills-1" aria-selected="true">Direct Request Clients</button>
							</li>
							<!-- Tab item -->
							<li class="nav-item me-2 me-sm-4" role="presentation">
								<button class="nav-link mb-2 mb-md-0" id="course-pills-tab-2" data-bs-toggle="pill"
									data-bs-target="#course-pills-2" type="button" role="tab"
									aria-controls="course-pills-2" aria-selected="false">Clients from
									Sponsorships</button>
							</li>
						</ul>
					</div>
					<!-- Tabs END -->

					<!-- Tab contents START -->
					<div class=" p-0 ">
						<div class="tab-content" id="course-pills-tabContent">
							<div class="tab-pane fade active show" id="course-pills-1" role="tabpanel"
								aria-labelledby="course-pills-tab-1">
								<div class="col">
									<!-- Card START -->
									<div class="">
										<!-- Card body START -->
										<div class="p-3">

											<!-- Search and select START -->
											<div class="row g-3 align-items-center justify-content-between mb-1">
												<!-- Search -->
												<div class="col-md-8" style="display:none">
													<form class="rounded position-relative"
														id="directRequest_search_form">
														<input class="form-control pe-5 bg-transparent" type="search"
															placeholder="Search" aria-label="Search"
															id="directRequest_search" onckeyup="">
														<button
															class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset"
															id="directRequest_search_button" style="display:none">
															<i class="fas fa-search fs-6 "></i>
														</button>
													</form>
												</div>
												<div class="col" id="noContentFound">
													<p class="bg-info-subtle rounded text-black p-2 d-inline-flex p-2 ">
														<i class="bi bi-exclamation-circle-fill align-middle"
															style="margin-right: 20px;"></i>Creators applied you
														without sponsorships will be shown below
													</p>
												</div>
												<!-- Select option -->
												<div class="col-md-3 d-none" style="display:none">
													<!-- Short by filter -->
													<form>
														<select
															class="form-select js-choice border-0 z-index-9 bg-transparent"
															aria-label=".form-select-sm"
															id="directRequest_search_filter">

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
															<th scope="col" class="border-0 rounded-start">Title</th>
															<th scope="col" class="border-0 rounded-start">Description
															</th>
															<th scope="col" class="border-0">Category</th>
															<th scope="col" class="border-0 rounded-end">Subscribers
															</th>
														</tr>
													</thead>

													<!-- Table body START -->
													<tbody id="tablebody_direct">

													</tbody>
													<!-- Table body END -->
												</table>
											</div>
											<!-- Course list table END -->

											<!-- Pagination START -->
											<div
												class="d-sm-flex justify-content-sm-center align-items-sm-center mt-4 mt-sm-3">
												<button class="border border-primary bg-primary p-2 rounded text-white"
													id="loadMoreDirectRequest">Load
													More</button>
											</div>
											<!-- Pagination END -->
										</div>
										<!-- Card body START -->
									</div>
									<!-- Card END -->
								</div>
							</div>
							<div class="tab-pane fade " id="course-pills-2" role="tabpanel"
								aria-labelledby="course-pills-tab-2">
								<div class="col">
									<!-- Card START -->
									<div class="">
										<!-- Card body START -->
										<div class="p-3">

											<!-- Search and select START -->
											<div class="row g-3 align-items-center justify-content-between mb-1">
												<!-- Search -->
												<div class="col-md-8" style="display:none">
													<form class="rounded position-relative"
														id="withSponsorshipRequest_search_form">
														<input class="form-control pe-5 bg-transparent" type="search"
															placeholder="Search" aria-label="Search"
															id="withSponsorshipRequest_search" onckeyup="">
														<button
															class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset"
															id="withSponsorshipRequest_search_button"
															style="display:none">
															<i class="fas fa-search fs-6 "></i>
														</button>
													</form>
												</div>
												<div class="col" id="noContentFound">
													<p class="bg-info-subtle rounded text-black p-2 d-inline-flex p-2 ">
														<i class="bi bi-exclamation-circle-fill align-middle"
															style="margin-right: 20px;"></i>Creators applied you with
														sponsorships will be shown below
													</p>
												</div>
												<!-- Select option -->
												<div class="col-md-3 d-none" style="display:none">
													<!-- Short by filter -->
													<form>
														<select
															class="form-select js-choice border-0 z-index-9 bg-transparent"
															aria-label=".form-select-sm"
															id="withSponsorshipRequest_search_filter">

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
															<th scope="col" class="border-0 rounded-start">Title</th>
															<th scope="col" class="border-0 rounded-start">Description
															</th>
															<th scope="col" class="border-0">Category</th>
															<th scope="col" class="border-0 rounded-end">Subscribers
															</th>
														</tr>
													</thead>

													<!-- Table body START -->
													<tbody id="tablebody_withsponsorship">

													</tbody>
													<!-- Table body END -->
												</table>
											</div>
											<!-- Course list table END -->

											<!-- Pagination START -->
											<div
												class="d-sm-flex justify-content-sm-center align-items-sm-center mt-4 mt-sm-3">
												<button class="border border-primary bg-primary p-2 rounded text-white"
													id="loadMoreWithSponsorship">Load
													More</button>
											</div>
											<!-- Pagination END -->
										</div>
										<!-- Card body START -->
									</div>
									<!-- Card END -->
								</div>
							</div>
						</div>
					</div>
					<!-- Tab contents END -->
				</div>
			</div>
		</div>
		<!-- Card body START -->
	</div>
	<!-- Card END -->
</div>