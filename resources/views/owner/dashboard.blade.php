@extends('layouts.app')
@section('content')
			<!-- Main content START -->
			<div class="main-content">
				<div class="row">
					<div class="col-12">
						<!-- Page title -->
						<div class="my-5">
							<h3>Dashboard</h3>
							<div class="card mb-4">
								<div class="card-body">
									<h5 class="card-title">Account Status</h5>
									@if(Auth::user()->ownerProfile && Auth::user()->ownerProfile->approved)
										<p class="text-success">Your account is approved. You can create listings.</p>
									@else
										<p class="text-danger">Your account is pending approval. You cannot create listings yet.</p>
										<p>Please wait for admin approval or contact support for more information.</p>
									@endif
								</div>
							</div>
							<hr>
						</div>
						<div class="row">
							<div class="col-12">
								<!-- Svg -->
								<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
									<symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
										<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
									</symbol>
									<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
										<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
									</symbol>
									<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
										<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
									</symbol>
								</svg>
								<!-- Alert 1 -->
								<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
									<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
										<div>
											Hello! You have got a new message from customer on <strong>Realty</strong> for rent request
										</div>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
								
								<!-- Alert 2 -->
								<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show mb-5" role="alert">
									<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
										<div>
											Password change notice for security issue and make your password more strong
										</div>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>

								<div class="row">
									<!-- Item -->
									<div class="col-sm-6 col-xxl-3 mb-5 mb-xxl-0">
										<div class="bg-danger d-flex justify-content-between align-items-center p-3 rounded">
											<span class="display-5 text-white opacity-5"><i class="fas fa-fw fa-home"></i></span>
											<div class="text-center">
												<h3 class="purecounter mb-0 text-white" data-purecounter-start="0" data-purecounter-end="200" data-purecounter-delay="200">0</h3>
												<p class="mb-0 text-white">Total Property</p>
											</div>
										</div>
									</div>
									<!-- Item -->
									<div class="col-sm-6 col-xxl-3 mb-5 mb-xxl-0">
										<div class="bg-warning d-flex justify-content-between align-items-center p-3 rounded">
											<span class="display-5 text-white opacity-5"><i class="far fa-fw fa-comment-dots"></i></span>
											<div class="text-center">
												<h3 class="purecounter mb-0 text-white" data-purecounter-start="0" data-purecounter-end="156" data-purecounter-delay="200">156</h3>
												<p class="mb-0 text-white">Total Review</p>
											</div>
										</div>
									</div>
									<!-- Item -->
									<div class="col-sm-6 col-xxl-3 mb-5 mb-xxl-0">
										<div class="bg-info d-flex justify-content-between align-items-center p-3 rounded">
											<span class="display-5 text-white opacity-5"><i class="fas fa-fw fa-eye"></i></span>
											<div class="text-center">
												<h3 class="purecounter mb-0 text-white" data-purecounter-start="0" data-purecounter-end="225" data-purecounter-delay="200">2255</h3>
												<p class="mb-0 text-white">Total View</p>
											</div>
										</div>
									</div>
									<!-- Item -->
									<div class="col-sm-6 col-xxl-3 mb-5 mb-xxl-0">
										<div class="bg-orange d-flex justify-content-between align-items-center p-3 rounded">
											<span class="display-5 text-white opacity-5"><i class="fab fa-fw fa-gratipay"></i></span>
											<div class="text-center">
												<h3 class="purecounter mb-0 text-white" data-purecounter-start="0" data-purecounter-end="80" data-purecounter-delay="100">80</h3>
												<p class="mb-0 text-white">Total Favorites</p>
											</div>
										</div>
									</div>
								</div> <!-- Row END -->

								<div class="row mt-5">
									<!-- Chart -->
									<div class="col-xl-7 mb-5 mb-xl-0">
										<div class="bg-secondary-soft p-4 rounded">
											<h4 class="mb-4 mt-0">View Statistics</h4>
											<canvas id="chartJSContainer" width="600" height="400"></canvas>
										</div>
									</div>
									<div class="col-xl-5">
										<div class="bg-secondary-soft p-4 rounded">
											<!-- Title -->
											<h4 class="mb-4 mt-0">Recent Activity</h4>
											<ul class="list-inline mb-4">
												<!-- Info -->
												<li class="list-inline-item">
													<div class="d-flex mb-3">
														<div class="fs-4 text-primary">
															<i class="fas fa-fw fa-home"></i>
														</div>
														<div class="ms-3">
															<p class="mb-0 text-dark"> New property approve for Rent by Realty</p>
															<div class="small">29 December 2020</div>
														</div>
													</div>
												</li>
												<!-- Info -->
												<li class="list-inline-item">
													<div class="d-flex mb-3">
														<div class="fs-4 text-warning">
															<i class="far fa-fw fa-comment-dots"></i>
														</div>
														<div class="ms-3">
															<p class="mb-0 text-dark"> Comments replay by admin in Morningstar avenue Apartment</p>
															<div class="small">05 December 2020</div>
														</div>
													</div>
												</li>
												<!-- Info -->
												<li class="list-inline-item">
													<div class="d-flex mb-3">
														<div class="fs-4 text-danger">
															<i class="fab fa-fw fa-gratipay"></i>
														</div>
														<div class="ms-3">
															<p class="mb-0 text-dark"> Someone favorites your Single House Near New York listing</p>
															<div class="small">12 January 2021</div>
														</div>
													</div>
												</li>
												<!-- Info -->
												<li class="list-inline-item">
													<div class="d-flex mb-3">
														<div class="fs-4 text-primary">
															<i class="fas fa-fw fa-home"></i>
														</div>
														<div class="ms-3">
															<p class="mb-0 text-dark"> New property approve for Rent by Realty</p>
															<div class="small">05 December 2020</div>
														</div>
													</div>
												</li>
												<!-- Info -->
												<li class="list-inline-item">
													<div class="d-flex mb-3">
														<div class="fs-4 text-success">
															<i class="fas fa-fw fa-hand-holding-usd"></i>
														</div>
														<div class="ms-3">
															<p class="mb-0 text-dark"> Payment received from customer invoice no 565656</p>
															<div class="small">12 January 2021</div>
														</div>
													</div>
												</li>
												<!-- Info -->
												<li class="list-inline-item">
													<div class="d-flex mb-3">
														<div class="fs-4 text-danger">
															<i class="fab fa-fw fa-gratipay"></i>
														</div>
														<div class="ms-3">
															<p class="mb-0 text-dark"> Someone favorites your Single House Near New York listing</p>
															<div class="small">15 June 2021</div>
														</div>
													</div>
												</li>
												<!-- Info -->
												<li class="list-inline-item">
													<div class="d-flex mb-3">
														<div class="fs-4 text-warning">
															<i class="far fa-fw fa-comment-dots"></i>
														</div>
														<div class="ms-3">
															<p class="mb-0 text-dark"> Comments replay by admin in Morningstar avenue Apartment</p>
															<div class="small">05 Nay 2020</div>
														</div>
													</div>
												</li>
											</ul>
											<!-- button -->
											<div class="text-center">
												<button type="button" class="btn btn-sm btn-primary-soft">View all</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> <!-- Row END -->
					</div>
				</div> <!-- Row END -->
			<!-- Main content END -->
		</div>
		</div>
	</div>
</main>
<!-- **************** MAIN CONTENT END **************** -->
@endsection