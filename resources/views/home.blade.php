@extends('layouts.app')
<!-- **************** MAIN CONTENT START **************** -->

@section('content')
<!-- =======================
Main Banner START -->
<section class="position-relative overflow-hidden">
	<!-- Svg -->
	<figure class="rotate position-absolute top-50 start-100 translate-middle">
		<svg class="opacity-1" viewBox="0 0 200 200" width="900px" height="1000px" xmlns="http://www.w3.org/2000/svg">
			<path class="fill-primary-soft" d="M55.4,-18.3C63.9,8.2,57.5,39.2,36.7,55.4C16,71.5,-19,72.9,-37.8,57.8C-56.7,42.8,-59.4,11.3,-50.4,-15.8C-41.5,-42.9,-20.7,-65.7,1.4,-66.1C23.4,-66.6,46.9,-44.7,55.4,-18.3Z" transform="translate(100 100)" />
		</svg>
	</figure>
	<!-- Blur element -->
	<div class="position-absolute top-50 start-50 translate-middle mt-5 ms-5 mb-n5">
		<span class="blur-element opacity-2"></span>
	</div>
	
	<div class="container">
		<div class="row justify-content-end align-items-center position-relative">
			<!-- Title and search -->
			<div class="col-lg-10 position-absolute-lg z-index-9">
				<div class="row">
					<div class="col-lg-6">
						<!-- Title -->
						<h1 class="mb-0 display-4">Find your</h1>
						<h2 class="display-5">Dream <span class="text-primary position-relative">Property
								<!-- Svg START -->
								<span class="position-absolute bottom-0 start-0 mb-n2 d-flex">
									<svg class="mt-auto" width="100%" height="13px" xmlns="http://www.w3.org/2000/svg">
									<path class="fill-primary" fill-rule="evenodd"
									 d="M212.085,0.394 C204.384,0.051 195.626,0.202 187.838,0.120 C183.695,0.067 180.307,0.298 176.119,0.566 C170.855,0.909 165.842,0.830 160.919,0.938 C140.929,1.402 121.831,2.202 102.966,3.072 C85.830,3.849 68.326,5.613 51.511,5.528 C35.988,5.419 19.171,5.679 3.940,8.169 C-2.659,9.318 0.701,13.793 7.221,12.801 C22.156,10.566 39.083,10.615 54.338,10.577 C62.025,10.558 69.639,9.783 77.332,9.307 C86.344,8.750 95.372,8.246 104.415,7.718 C122.137,6.688 139.886,5.668 158.038,4.717 C162.113,4.505 166.200,4.407 170.328,4.172 C174.299,3.941 178.151,3.269 182.264,3.024 C186.073,2.796 189.753,2.843 193.719,2.546 C198.584,2.173 203.525,1.468 209.034,1.298 C211.295,1.192 214.566,0.484 212.085,0.394 L212.085,0.394 Z"/>
									</svg>
								</span>
								<!-- Svg END -->
							</span>
						</h2>
						<!-- Content -->
						<p class="mt-3">Rooms oh fully taken by worse do. Points afraid but may end law lasted. Was out laughter raptures returned outweigh. Luckily cheered colonel I do we attack highest enabled. Tried law yet style child.</p>
					</div>
				</div>

				<!-- Search bar START -->
				<div class="row">
					<div class="col-lg-10">
						<div class="shadow-lg p-3 mb-5 bg-body p-4 rounded">
							<div class="row align-items-center g-3">
								<!-- Item 1 -->
								<div class="col-sm-6 col-md-3 bottomborder-select">
									<select class="form-select form-select-sm js-choice" aria-label=".form-select-sm example" >
										<option value="">Type</option>
										<option>Rent</option>
										<option>Buy</option>
										<option>Sale</option>
									</select>
								</div>
								<!-- Item 2 -->
								<div class="col-sm-6 col-md-3 bottomborder-select">
									<select class="form-select form-select-sm js-choice" aria-label=".form-select-sm example">
										<option value="">Category</option>
										<option>Aparement</option>
										<option>Land</option>
										<option>Houses</option>
										<option>Villas</option>
										<option>Retails</option>
										<option>Shop</option>
										<option>Office</option>
									</select>
								</div>
								<!-- Item 3 -->
								<div class="col-sm-6 col-md-3 bottomborder-select">
									<select class="form-select form-select-sm js-choice" aria-label=".form-select-sm example">
										<option value="">City</option>
										<option>New York</option>
										<option>Los Angeles</option>
										<option>Phoenix</option>
										<option>Mumbai</option>
									</select>
								</div>
								<!-- Button -->
								<div class="col-sm-6 col-md-3">
									<button type="button" class="btn btn-sm btn-primary w-100">Search</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Search bar END -->
			</div>

			<!-- Images -->
			<div class="col-lg-7">
				<div class="row justify-content-center">
					<!-- Image left START -->
					<div class="col-md-5 col-lg-6 position-relative d-none d-md-block">
						<!-- Image -->
						<img class="border rounded" src="assets/images/about/08.jpg" alt="">
						<!-- Svg -->
						<figure class="position-absolute bottom-0 end-0 mb-n4">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="105px" height="68px">
							<path class="fill-dark" fill-rule="evenodd"
							 d="M99.147,26.309 C96.847,26.202 94.894,23.934 95.420,21.689 C96.111,18.732 101.243,17.958 103.728,18.040 C106.540,21.381 102.550,26.467 99.147,26.309 ZM80.779,43.590 C79.264,43.267 76.909,42.659 77.146,40.505 C77.473,37.542 82.617,38.441 84.593,38.581 L84.543,38.922 C86.128,38.741 87.422,41.210 86.773,42.460 C85.799,44.336 82.373,43.931 80.779,43.590 ZM78.374,10.217 C75.852,11.089 72.400,11.023 72.232,7.568 C72.018,3.195 78.765,1.934 81.970,2.571 C84.265,5.654 81.781,9.038 78.374,10.217 ZM73.362,61.788 C72.709,65.351 68.249,66.985 65.142,67.388 C62.224,63.055 65.063,59.504 68.644,56.829 L69.259,56.374 C71.823,55.341 73.775,59.536 73.362,61.788 ZM50.822,35.374 C40.828,37.529 40.176,20.897 52.978,25.223 L52.212,24.841 C54.463,25.221 56.114,27.538 56.345,29.836 C56.695,33.318 54.029,34.682 50.822,35.374 ZM39.291,7.238 C31.618,2.096 42.219,-1.702 47.041,2.081 C51.689,7.805 44.162,10.502 39.291,7.238 ZM41.640,52.132 C45.774,56.380 47.867,62.688 41.292,65.693 C29.573,71.047 26.179,49.429 41.640,52.132 ZM17.672,35.636 C12.967,35.438 5.677,32.113 6.452,26.429 C7.389,19.549 17.899,20.396 22.747,21.964 C25.073,23.792 27.686,27.424 27.500,29.840 C27.163,34.214 21.348,35.791 17.672,35.636 ZM13.053,54.196 C17.516,58.735 5.129,62.811 1.725,58.672 C-0.533,55.927 0.192,54.402 3.220,52.694 C7.080,50.517 10.419,50.804 13.053,54.196 Z"/>
							</svg>
						</figure>
					</div>
					<!-- Image left END -->

					<!-- Image right START -->
					<div class="col-10 col-md-5 col-lg-6 position-relative">
						<!-- Image -->
						<img class="border rounded mt-5" src="assets/images/about/09.jpg" alt="">
						<!-- Svg -->
						<figure class="position-absolute top-0 end-0">
							<svg width="52px" height="150px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								<path class="fill-primary" fill-rule="evenodd"
								 d="M51.176,43.525 C51.134,56.432 51.232,69.137 50.076,82.017 C49.058,93.357 45.967,104.671 47.291,116.073 C47.941,121.668 47.586,127.187 48.339,132.790 C48.975,137.524 49.686,144.373 47.852,148.872 C47.412,149.952 46.007,150.001 45.584,148.872 C44.598,146.241 45.178,143.572 45.320,140.803 C45.506,137.182 45.247,133.802 44.774,130.212 C44.106,125.152 44.038,120.113 43.084,115.090 C41.027,104.261 42.602,92.948 41.608,82.017 C39.276,56.376 40.213,30.668 44.858,5.363 C45.194,3.534 48.243,3.535 48.578,5.363 C49.779,11.927 51.262,18.537 51.638,25.208 C51.989,31.427 51.196,37.351 51.176,43.525 ZM31.838,15.306 C32.213,21.283 31.046,26.954 31.130,32.839 C31.303,44.965 30.181,56.759 29.062,68.837 C27.812,82.324 26.094,95.562 25.936,109.157 C25.900,112.244 25.935,115.341 25.827,118.426 C25.734,121.101 25.140,123.818 25.382,126.500 C25.654,129.503 26.801,132.039 26.874,135.084 C26.960,138.672 27.593,141.973 28.340,145.467 C28.932,148.236 24.527,148.444 24.736,145.952 C25.019,142.575 24.367,139.272 24.630,135.891 C24.849,133.070 24.352,130.872 24.123,128.114 C23.607,121.881 23.775,115.437 23.701,109.157 C23.623,102.415 23.428,95.762 22.658,89.058 C21.910,82.552 22.966,76.211 22.405,69.743 C21.863,63.499 20.571,56.846 21.328,50.604 C22.042,44.713 21.868,38.779 21.839,32.839 C21.824,29.676 22.681,26.802 22.951,23.681 C23.192,20.896 22.967,18.095 23.089,15.306 C23.293,10.650 23.538,4.474 26.792,0.872 C27.506,0.082 29.152,-0.006 29.853,0.872 C33.002,4.817 31.541,10.551 31.838,15.306 ZM9.086,138.892 C9.953,143.485 2.879,145.435 2.009,140.830 C-0.004,130.174 1.014,118.583 2.382,107.893 C3.864,96.315 2.769,84.197 2.843,72.519 C2.925,59.661 2.963,46.801 3.185,33.943 C3.240,30.788 3.677,27.480 3.190,24.348 C2.804,21.864 2.363,19.986 2.581,17.419 C2.994,12.551 2.566,7.720 3.401,2.914 C3.679,1.316 5.824,1.950 5.989,3.262 C6.370,6.309 7.775,8.812 8.238,11.783 C8.614,14.192 8.281,16.644 8.470,19.064 C8.673,21.675 9.602,24.064 9.695,26.703 C9.791,29.438 9.640,32.190 9.675,34.928 C9.829,47.139 9.919,59.350 9.997,71.562 C10.037,77.797 10.029,84.033 10.093,90.268 C10.148,95.590 10.661,100.880 10.005,106.184 C8.702,116.718 7.099,128.377 9.086,138.892 Z"/>
								</svg>
						</figure>

						<!-- Card Property START -->
						<div class="position-absolute bottom-0 end-0 me-n5 mb-n5">
							<div class="card d-inline-block mb-3 me-3">
								<!-- Card info -->
								<div class="card-body bg-white shadow-lg rounded">
									<!-- Card title -->
									<h4 class="card-title"><a href="post-single-4.html" class="btn-link text-reset fw-bold">Luxury villa in Paris</a></h4>
									<!-- Info -->
									<ul class="nav nav-divider align-items-center text-uppercase small mt-3">
										<li class="nav-item me-4">
											<i class="fas fa-bed pe-1"></i>5
										</li>
										<li class="nav-item me-4">
											<i class="fas fa-bath pe-1"></i>3
										</li>
										<li class="nav-item me-4">
											<i class="fas fa-user pe-1"></i>6
										</li>
										<li class="nav-item me-4">
											<i class="fas fa-square pe-1"></i>2900<sup class="text-lowercase">m2</sup>
										</li>
									</ul>
									<!-- Badge -->
									<div class="mt-3">
										<a href="#" class="badge bg-primary-soft text-primary"><i class="fas fa-user-friends pe-1"></i>Family</a>
										<a href="#" class="badge bg-warning-soft text-warning"><i class="fas fa-rupee-sign pe-1"></i>Rent</a>
									</div>
									<!-- Price -->
									<div class="mt-3 d-flex">
										<h3 class="text-success pe-2">$500</h3><span class="pt-2">/month</span>
									</div>
								</div>
							</div>
						</div>
						<!-- Card Property END -->
					</div>
					<!-- Image right END -->
				</div>
			</div>
		</div>
	</div>
</section>
<!-- =======================
Main Banner END -->

<!-- =======================
Client box START -->
<section>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12">
				<div class="shadow-lg rounded p-5">
					<div class="row">
						<div class="col-md-12">
							<!-- Slider START -->
							
							<!-- Slider END -->
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- =======================
Client box END -->

<!-- =======================
About START -->
<section class="position-relative overflow-hidden">
	<!-- Svg-->
	<figure class="position-absolute top-50 start-0 translate-middle">
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="496px" height="455px">
		<path class="fill-primary-soft opacity-1" fill-rule="evenodd"
		 d="M248.000,-0.000 C384.967,-0.000 496.000,101.855 496.000,227.500 C496.000,353.144 384.967,455.000 248.000,455.000 C111.033,455.000 0.000,353.144 0.000,227.500 C0.000,101.855 111.033,-0.000 248.000,-0.000 Z"/>
		</svg>
	</figure>

	<div class="container">
		<div class="row align-items-center justify-content-center position-relative g-5">
			<!-- Left side START -->
			<div class="col-10 col-lg-6 position-relative order-2 order-lg-1">
			
				<!--Svg decoration  -->
				<figure class="position-absolute top-0 end-0 mt-n5 d-none d-sm-block">
					<svg>
						<path class="fill-primary" d="M44.5,139.5c-0.1,0.6-0.6,1.1-1.4,1.4c-0.4,0.2-0.9,0.3-1.4,0.4c-0.3,0-0.6,0.1-0.9,0.1c-0.2,0-0.3,0-0.5,0
							c-0.2,0-0.3,0-0.5,0c-0.3,0-0.7,0-1.1,0c-0.2,0-0.4,0-0.6,0c-0.2,0-0.4,0-0.6-0.1c-0.4-0.1-0.8-0.1-1.2-0.2
							c-0.4-0.1-0.8-0.2-1.3-0.3c-0.2-0.1-0.4-0.1-0.7-0.2c-0.2-0.1-0.4-0.1-0.7-0.2c-0.4-0.1-0.9-0.3-1.3-0.5
							c-0.4-0.2-0.9-0.4-1.4-0.6l-0.3-0.2c-0.1-0.1-0.2-0.1-0.3-0.2c-0.2-0.1-0.5-0.2-0.7-0.4c-0.2-0.1-0.7-0.4-1.3-0.7
							c-0.3-0.2-0.7-0.4-1.1-0.7c-0.4-0.3-0.9-0.6-1.4-0.9c-0.5-0.3-1.1-0.7-1.7-1.1c-0.3-0.2-0.6-0.4-0.9-0.7
							c-0.2-0.1-0.3-0.2-0.5-0.4c-0.2-0.1-0.3-0.2-0.5-0.4c-0.6-0.5-1.3-1.1-2-1.7c-0.7-0.6-1.4-1.3-2.2-2c-3-2.9-6.2-6.5-9.1-11.2
							c-1.5-2.3-2.8-4.9-4.1-7.7l-0.1-0.3l-0.1-0.3c-0.1-0.2-0.1-0.4-0.2-0.5c-0.1-0.4-0.3-0.7-0.4-1.1c-0.1-0.4-0.3-0.7-0.4-1.1
							c-0.1-0.2-0.1-0.4-0.2-0.6c-0.1-0.2-0.1-0.4-0.2-0.6c-0.1-0.4-0.3-0.8-0.4-1.1c-0.1-0.2-0.1-0.4-0.2-0.6s-0.1-0.4-0.2-0.6
							c-0.1-0.4-0.2-0.8-0.3-1.2c-0.1-0.4-0.2-0.8-0.3-1.2c-0.1-0.4-0.2-0.8-0.3-1.2c-0.1-0.4-0.2-0.8-0.3-1.2C1.2,99.4,1.1,99,1,98.6
							c0-0.2-0.1-0.4-0.1-0.6c0-0.2-0.1-0.4-0.1-0.6c-0.1-0.4-0.1-0.8-0.2-1.3c-0.1-0.4-0.1-0.9-0.2-1.3c0-0.2-0.1-0.4-0.1-0.6
							c0-0.2,0-0.4-0.1-0.7c0-0.4-0.1-0.9-0.1-1.3c-0.1-0.9-0.1-1.8-0.1-2.7c0-0.2,0-0.4,0-0.7c0-0.2,0-0.4,0-0.7c0-0.5,0-0.9,0-1.4
							c0-0.5,0-0.9,0-1.4c0-0.2,0-0.5,0-0.7s0-0.5,0-0.7c0-0.5,0.1-0.9,0.1-1.4c0-0.5,0.1-0.9,0.1-1.4c0.7-7.4,2.5-15,5.6-22.3
							c0.8-1.8,1.6-3.6,2.5-5.4c0.9-1.8,1.9-3.5,3-5.3c0.3-0.4,0.5-0.9,0.8-1.3c0.3-0.4,0.6-0.9,0.8-1.3c0.3-0.4,0.6-0.8,0.9-1.3
							l0.4-0.6l0.5-0.6c0.6-0.8,1.2-1.6,1.8-2.5c0.6-0.8,1.3-1.6,1.9-2.4c2.7-3.1,5.5-6.1,8.6-8.9c0.8-0.7,1.5-1.4,2.3-2
							c0.8-0.7,1.6-1.3,2.4-2l0.6-0.5l0.6-0.5l1.2-0.9c0.4-0.3,0.8-0.6,1.2-0.9l1.3-0.9c3.3-2.4,6.8-4.6,10.4-6.6
							c3.6-2,7.2-3.8,10.8-5.4c7.3-3.2,14.8-5.8,22.2-7.5c0.5-0.1,0.9-0.2,1.4-0.3C81.9,2,82.1,2,82.3,1.9l0.3-0.1L83,1.8
							c0.9-0.2,1.9-0.3,2.8-0.5c0.9-0.1,1.8-0.3,2.8-0.4C89,0.8,89.5,0.7,90,0.7c0.5-0.1,0.9-0.1,1.4-0.2C95,0.1,98.6,0,102.1,0
							c3.5,0,6.9,0.4,10.1,0.9c1.6,0.3,3.2,0.6,4.8,0.9c1.5,0.4,3.1,0.8,4.5,1.2c0.7,0.2,1.4,0.5,2.2,0.7c0.4,0.1,0.7,0.2,1,0.4
							c0.2,0.1,0.3,0.1,0.5,0.2c0.2,0.1,0.3,0.1,0.5,0.2c0.3,0.1,0.7,0.3,1,0.4c0.3,0.1,0.7,0.3,1,0.4c0.2,0.1,0.3,0.1,0.5,0.2
							c0.2,0.1,0.3,0.1,0.5,0.2c0.3,0.1,0.6,0.3,1,0.4c2.5,1.2,4.8,2.4,6.9,3.7c4.2,2.6,7.4,5.4,9.9,7.9c1.2,1.3,2.2,2.5,3.1,3.5
							c0.2,0.3,0.4,0.5,0.6,0.8c0.2,0.3,0.4,0.5,0.5,0.7c0.2,0.2,0.3,0.5,0.5,0.7s0.3,0.4,0.4,0.6c0.2,0.4,0.5,0.7,0.6,1.1
							c0.2,0.3,0.3,0.6,0.4,0.8c0.2,0.4,0.3,0.7,0.2,0.7c-0.1,0-0.3-0.1-0.6-0.5c-0.2-0.2-0.4-0.4-0.6-0.7c-0.2-0.3-0.5-0.6-0.8-0.9
							c-0.1-0.2-0.3-0.4-0.5-0.5c-0.2-0.2-0.4-0.4-0.5-0.6c-0.2-0.2-0.4-0.4-0.6-0.6s-0.4-0.5-0.7-0.7c-0.9-0.9-2-2-3.3-3.1
							c-2.6-2.2-5.9-4.7-10-7c-2.1-1.1-4.3-2.2-6.8-3.2c-0.3-0.1-0.6-0.2-0.9-0.4c-0.2-0.1-0.3-0.1-0.5-0.2c-0.2-0.1-0.3-0.1-0.5-0.2
							c-0.3-0.1-0.6-0.2-1-0.3c-0.3-0.1-0.7-0.2-1-0.3c-0.2-0.1-0.3-0.1-0.5-0.2c-0.2-0.1-0.3-0.1-0.5-0.2c-0.3-0.1-0.7-0.2-1-0.3
							c-0.7-0.2-1.4-0.4-2.1-0.6c-1.4-0.4-2.8-0.7-4.3-1c-1.5-0.3-3-0.5-4.5-0.7c-3.1-0.3-6.3-0.5-9.6-0.4C98.8,4.2,95.3,4.5,91.9,5
							C91.5,5,91,5.1,90.6,5.2c-0.4,0.1-0.9,0.1-1.3,0.2c-0.9,0.2-1.7,0.3-2.6,0.5C85.8,6,84.9,6.2,84,6.4l-0.3,0.1l-0.3,0.1
							c-0.2,0.1-0.4,0.1-0.7,0.2c-0.4,0.1-0.9,0.2-1.3,0.3c-7,1.8-14.1,4.5-21.1,7.8c-3.5,1.7-6.9,3.5-10.2,5.5
							c-3.3,2-6.6,4.1-9.7,6.5l-1.2,0.9c-0.4,0.3-0.8,0.6-1.1,0.9L37,29.5l-0.6,0.5l-0.6,0.5c-0.7,0.6-1.5,1.3-2.2,1.9
							c-0.7,0.7-1.4,1.3-2.1,2c-2.8,2.7-5.4,5.5-7.8,8.4c-0.6,0.7-1.2,1.5-1.8,2.2c-0.5,0.8-1.1,1.5-1.6,2.3l-0.4,0.6l-0.4,0.6
							c-0.3,0.4-0.5,0.8-0.8,1.2c-0.2,0.4-0.5,0.8-0.7,1.2c-0.2,0.4-0.5,0.8-0.7,1.2c-0.9,1.6-1.8,3.2-2.6,4.9c-0.8,1.6-1.5,3.3-2.2,5
							c-2.7,6.7-4.2,13.6-4.7,20.1c0,0.4-0.1,0.8-0.1,1.2c0,0.4,0,0.8,0,1.2c0,0.2,0,0.4,0,0.6c0,0.2,0,0.4,0,0.6c0,0.4,0,0.8,0,1.2
							c0,0.4,0,0.8,0,1.2c0,0.2,0,0.4,0,0.6s0,0.4,0,0.6c0,0.8,0.1,1.6,0.2,2.3C8,91.9,8,92.3,8,92.7c0,0.2,0,0.4,0.1,0.6
							c0,0.2,0.1,0.4,0.1,0.6c0.1,0.4,0.1,0.7,0.2,1.1c0.1,0.4,0.1,0.7,0.2,1.1c0,0.2,0.1,0.4,0.1,0.6c0,0.2,0.1,0.4,0.1,0.5
							c0.1,0.4,0.1,0.7,0.2,1.1c0.1,0.4,0.2,0.7,0.3,1.1c0.1,0.4,0.2,0.7,0.3,1c0.1,0.3,0.2,0.7,0.3,1c0.1,0.3,0.2,0.7,0.3,1
							c0.1,0.2,0.1,0.3,0.2,0.5c0.1,0.2,0.1,0.3,0.2,0.5c0.1,0.3,0.2,0.7,0.3,1c0.1,0.2,0.1,0.3,0.2,0.5c0.1,0.2,0.1,0.3,0.2,0.5
							c0.1,0.3,0.2,0.6,0.4,0.9c0.1,0.3,0.3,0.6,0.4,0.9c0.1,0.2,0.1,0.3,0.2,0.5l0.1,0.2l0.1,0.2c1.1,2.4,2.3,4.6,3.6,6.6
							c2.6,4,5.4,7.1,7.9,9.5c0.7,0.6,1.3,1.1,1.9,1.6c0.6,0.5,1.2,1,1.7,1.4c0.1,0.1,0.3,0.2,0.4,0.3c0.1,0.1,0.3,0.2,0.4,0.3
							c0.3,0.2,0.5,0.4,0.8,0.6c0.5,0.3,1,0.7,1.4,0.9c0.4,0.3,0.8,0.5,1.2,0.7c0.4,0.2,0.7,0.4,1,0.5c0.5,0.3,0.9,0.5,1.1,0.6
							c0.2,0.1,0.4,0.2,0.6,0.3l0.3,0.2l0.3,0.1c0.4,0.2,0.7,0.4,1.1,0.6c0.4,0.2,0.7,0.4,1,0.6c0.2,0.1,0.3,0.2,0.5,0.3
							c0.2,0.1,0.3,0.2,0.5,0.3c0.3,0.2,0.6,0.4,1,0.6c0.3,0.2,0.6,0.4,0.9,0.5c0.1,0.1,0.3,0.2,0.4,0.3c0.1,0.1,0.3,0.2,0.4,0.3
							c0.3,0.2,0.5,0.3,0.8,0.5c0.2,0.2,0.5,0.3,0.7,0.5c0.2,0.2,0.4,0.3,0.6,0.5c0.4,0.3,0.7,0.7,1,1
							C44.3,138.2,44.6,138.9,44.5,139.5z"/>
						<polygon class="fill-primary" points="165.6,41.7 159.3,10.9 152.1,26 135.6,32.3"/>
					</svg>
				</figure>

				<!-- Svg decoration -->
				<figure class="position-absolute bottom-0 start-0 me-5 mb-n5 d-none d-sm-block">
					<svg class="fill-primary" width="210.8px" height="172.4px">
						<path class="st0" d="M5.9,160.5c-3.3,0-5.9,2.7-5.9,5.9c0,3.3,2.7,5.9,5.9,5.9c3.3,0,5.9-2.7,5.9-5.9 C11.9,163.1,9.2,160.5,5.9,160.5z"/>
						<path class="st0" d="M45.7,160.5c-3.3,0-5.9,2.7-5.9,5.9c0,3.3,2.7,5.9,5.9,5.9c3.3,0,5.9-2.7,5.9-5.9 C51.7,163.1,49,160.5,45.7,160.5z"/>
						<path class="st0" d="M85.5,160.5c-3.3,0-5.9,2.7-5.9,5.9c0,3.3,2.7,5.9,5.9,5.9s5.9-2.7,5.9-5.9C91.5,163.1,88.8,160.5,85.5,160.5z"/>
						<path class="st0" d="M125.3,160.5c-3.3,0-5.9,2.7-5.9,5.9c0,3.3,2.7,5.9,5.9,5.9c3.3,0,5.9-2.7,5.9-5.9 C131.2,163.1,128.6,160.5,125.3,160.5z"/>
						<path class="st0" d="M165.1,160.5c-3.3,0-5.9,2.7-5.9,5.9c0,3.3,2.7,5.9,5.9,5.9c3.3,0,5.9-2.7,5.9-5.9 C171,163.1,168.4,160.5,165.1,160.5z"/>
						<path class="st0" d="M204.9,160.5c-3.3,0-5.9,2.7-5.9,5.9c0,3.3,2.7,5.9,5.9,5.9c3.3,0,5.9-2.7,5.9-5.9 C210.8,163.1,208.1,160.5,204.9,160.5z"/>
						<path class="st0" d="M5.9,128.4c-3.3,0-5.9,2.7-5.9,5.9s2.7,5.9,5.9,5.9c3.3,0,5.9-2.7,5.9-5.9S9.2,128.4,5.9,128.4z"/>
						<circle class="st0" cx="45.7" cy="134.3" r="5.9"/>
						<circle class="st0" cx="85.5" cy="134.3" r="5.9"/>
						<circle class="st0" cx="125.3" cy="134.3" r="5.9"/>
						<path class="st0" d="M165.1,128.4c-3.3,0-5.9,2.7-5.9,5.9s2.7,5.9,5.9,5.9c3.3,0,5.9-2.7,5.9-5.9S168.4,128.4,165.1,128.4z"/>
						<path class="st0" d="M204.9,128.4c-3.3,0-5.9,2.7-5.9,5.9s2.7,5.9,5.9,5.9c3.3,0,5.9-2.7,5.9-5.9S208.1,128.4,204.9,128.4z"/>
						<path class="st0" d="M5.9,96.3C2.7,96.3,0,99,0,102.2c0,3.3,2.7,5.9,5.9,5.9c3.3,0,5.9-2.7,5.9-5.9C11.9,99,9.2,96.3,5.9,96.3z"/>
						<circle class="st0" cx="45.7" cy="102.2" r="5.9"/>
						<circle class="st0" cx="85.5" cy="102.2" r="5.9"/>
						<circle class="st0" cx="125.3" cy="102.2" r="5.9"/>
						<path class="st0" d="M165.1,96.3c-3.3,0-5.9,2.7-5.9,5.9c0,3.3,2.7,5.9,5.9,5.9c3.3,0,5.9-2.7,5.9-5.9 C171,99,168.4,96.3,165.1,96.3z"/>
						<path class="st0" d="M204.9,96.3c-3.3,0-5.9,2.7-5.9,5.9c0,3.3,2.7,5.9,5.9,5.9c3.3,0,5.9-2.7,5.9-5.9 C210.8,99,208.1,96.3,204.9,96.3z"/>
						<path class="st0" d="M5.9,64.2c-3.3,0-5.9,2.7-5.9,5.9c0,3.3,2.7,5.9,5.9,5.9c3.3,0,5.9-2.7,5.9-5.9C11.9,66.9,9.2,64.2,5.9,64.2z"/>
						<path class="st0" d="M45.7,64.2c-3.3,0-5.9,2.7-5.9,5.9c0,3.3,2.7,5.9,5.9,5.9c3.3,0,5.9-2.7,5.9-5.9C51.7,66.9,49,64.2,45.7,64.2z"/>
						<path class="st0" d="M85.5,64.2c-3.3,0-5.9,2.7-5.9,5.9c0,3.3,2.7,5.9,5.9,5.9s5.9-2.7,5.9-5.9C91.5,66.9,88.8,64.2,85.5,64.2z"/>
						<path class="st0" d="M125.3,64.2c-3.3,0-5.9,2.7-5.9,5.9c0,3.3,2.7,5.9,5.9,5.9c3.3,0,5.9-2.7,5.9-5.9 C131.2,66.9,128.6,64.2,125.3,64.2z"/>
						<path class="st0" d="M165.1,64.2c-3.3,0-5.9,2.7-5.9,5.9c0,3.3,2.7,5.9,5.9,5.9c3.3,0,5.9-2.7,5.9-5.9 C171,66.9,168.4,64.2,165.1,64.2z"/>
						<path class="st0" d="M204.9,64.2c-3.3,0-5.9,2.7-5.9,5.9c0,3.3,2.7,5.9,5.9,5.9c3.3,0,5.9-2.7,5.9-5.9 C210.8,66.9,208.1,64.2,204.9,64.2z"/>
						<path class="st0" d="M5.9,32.1C2.7,32.1,0,34.8,0,38C0,41.3,2.7,44,5.9,44c3.3,0,5.9-2.7,5.9-5.9C11.9,34.8,9.2,32.1,5.9,32.1z"/>
						<circle class="st0" cx="45.7" cy="38" r="5.9"/>
						<circle class="st0" cx="85.5" cy="38" r="5.9"/>
						<circle class="st0" cx="125.3" cy="38" r="5.9"/>
						<path class="st0" d="M165.1,32.1c-3.3,0-5.9,2.7-5.9,5.9c0,3.3,2.7,5.9,5.9,5.9c3.3,0,5.9-2.7,5.9-5.9 C171,34.8,168.4,32.1,165.1,32.1z"/>
						<path class="st0" d="M204.9,32.1c-3.3,0-5.9,2.7-5.9,5.9c0,3.3,2.7,5.9,5.9,5.9c3.3,0,5.9-2.7,5.9-5.9 C210.8,34.8,208.1,32.1,204.9,32.1z"/>
						<path class="st0" d="M5.9,0C2.7,0,0,2.7,0,5.9c0,3.3,2.7,5.9,5.9,5.9c3.3,0,5.9-2.7,5.9-5.9C11.9,2.7,9.2,0,5.9,0z"/>
						<circle class="st0" cx="45.7" cy="5.9" r="5.9"/>
						<circle class="st0" cx="85.5" cy="5.9" r="5.9"/>
						<circle class="st0" cx="125.3" cy="5.9" r="5.9"/>
						<path class="st0" d="M165.1,0c-3.3,0-5.9,2.7-5.9,5.9c0,3.3,2.7,5.9,5.9,5.9c3.3,0,5.9-2.7,5.9-5.9C171,2.7,168.4,0,165.1,0z"/>
						<path class="st0" d="M204.9,0c-3.3,0-5.9,2.7-5.9,5.9c0,3.3,2.7,5.9,5.9,5.9c3.3,0,5.9-2.7,5.9-5.9C210.8,2.7,208.1,0,204.9,0z"/>
					</svg>
				</figure>
				
				<!-- Image -->
				<img class="img-fluid rounded" src="assets/images/about/01.jpg" alt="">
				<!-- Meta 1 -->
				<div class="d-inline-block text-center bg-white shadow-lg position-absolute top-0 end-0 rounded p-3 p-sm-4 mt-3">
					<div class="d-flex justify-content-center">
						<!-- Counter item -->
						<h2 class="purecounter text-orange mb-0" data-purecounter-start="0" data-purecounter-end="6" data-purecounter-delay="200">0</h2>
						<span class="h2 text-orange mb-0">k</span>
					</div>
					<p>Happy customers</p>
				</div>
				<!-- Meta 2 -->
				<div class="d-inline-block text-center bg-white shadow-lg rounded px-5 py-4 position-absolute bottom-0 start-0 mb-n4 ms-n3">
					<div class="d-flex justify-content-center">
						<!-- Counter item -->
						<h2 class="purecounter text-blue mb-0" data-purecounter-start="0" data-purecounter-end="18" data-purecounter-delay="100">0</h2>
						<span class="h2 text-blue mb-0">k</span>
					</div>
					<p>Properties</p>
				</div>
			</div>
			<!-- Left side END -->

			<!-- Right side START -->
			<div class="col-lg-6 ps-md-5 order-1">
				<!-- Title -->
				<h2 class="h1">Serving renters & property owners</h2>
				<p>Improved own provided blessing may peculiar domestic. Sight house has sex never. No visited raising gravity outward subject my cottage Mr be. Hold do at tore in park feet near my case.</p>
				<!-- Button -->
				<a href="#" class="btn btn-outline-primary">Read more</a>
				<!-- Rating START -->
				<div class="d-flex pt-2">
					<h2 class="me-3">4.5</h2>
					<div class="rating pt-2">
						<p class="mb-0">Rating based on 578 buyers</p>
						<ul class="list-inline">
							<li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
							<li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
							<li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
							<li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
							<li class="list-inline-item me-0 small"><i class="fas fa-star-half-alt text-warning"></i></li>
						</ul>
					</div>
				</div>
				<!-- Rating END -->
			</div>
			<!-- Right side END -->
		</div>
	</div>
</section>
<!-- =======================
About END -->

<!-- =======================
Work START -->
<section class="bg-primary-soft position-relative mt-5 overflow-hidden">
	<!-- Svg -->
	<figure class="d-none d-md-block position-absolute top-0 start-50 translate-middle-x w-100">
		<svg class="fill-white" width="2392.9px" height="122.2px" viewBox="0 0 2392.9 122.2" style="enable-background:new 0 0 2392.9 122.2;" xml:space="preserve">
		<path class="st0" d="M0,73.8l2392.9-42.2V0H0V73.8z"/>
		</svg>
	</figure>
	<!-- Svg -->
	<figure class="position-absolute top-100 start-50 translate-middle w-100 mt-5">
		<svg class="fill-white" width="2392.9px" height="122.2px" viewBox="0 0 2392.9 122.2" style="enable-background:new 0 0 2392.9 122.2;" xml:space="preserve">
			<path class="st0" d="M2392.9,73.8L0,31.6V0h2392.9V73.8z"/>
		</svg>
	</figure>
	<!-- Svg -->
	<figure class="position-absolute bottom-0 end-0 me-n7">
		<svg class="opacity-5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="350px" height="350px">
		<path class="fill-light" fill-rule="evenodd"
		 d="M150.000,-0.000 C232.843,-0.000 300.000,67.157 300.000,150.000 C300.000,232.842 232.843,300.000 150.000,300.000 C67.157,300.000 0.000,232.842 0.000,150.000 C0.000,67.157 67.157,-0.000 150.000,-0.000 Z"/>
		</svg>
	</figure>

	<div class="container">
		<!-- Title -->
		<div class="text-center">
			<h2>How it works</h2>
			<p>Saw met applauded favorite deficient engrossed concealed and her</p>
		</div>

		<div class="row align-items-center text-center mt-5">
			<!-- Item START -->
			<div class="col-md-6 col-lg-3">
				<div class="card align-items-center bg-transparent">
					<!-- Image overlay -->
					<div class="position-relative">
						<!-- Image -->
						<div class="box-xxxl bg-primary-overlay-hover border border-white border-5 rounded-circle shadow-lg">
					 	 <img src="assets/images/about/work/01.jpg" class="box-img" alt="...">
					 	</div>
					 	<!-- Hover element -->
						<div class="card-element-hover box-md bg-white rounded-circle position-absolute top-50 start-50 translate-middle">
							<span class="text-primary fs-6 fw-bold">01</span>
						</div>
					</div>
					<!-- Content -->
					<div class="card-body">
						<h4 class="card-title">Choose Category</h4>
						<p class="card-text">Demesne far hearted had has. Dependent on so extremely delivered by.</p>
					</div>
				</div>
			</div>
			<!-- Item END -->

			<!-- Item START -->
			<div class="col-md-6 col-lg-3">
				<div class="card align-items-center bg-transparent">
				 <!-- Image overlay -->
					<div class="position-relative">
						<!-- Image -->
						<div class="box-xxxl bg-primary-overlay-hover border border-white border-5 rounded-circle shadow-lg">
					 	 <img src="assets/images/about/work/02.jpg" class="box-img" alt="...">
					 	</div>
							<!-- Hover element -->
							<div class="card-element-hover box-md bg-white rounded-circle position-absolute top-50 start-50 translate-middle">
								<span class="text-primary fs-6 fw-bold">02</span>
							</div>
					</div>
					<!-- Content -->
					<div class="card-body">
						<h4 class="card-title">Find Real Estate</h4>
						<p class="card-text">What better way to demonstrate your value to a potential customer than to describe</p>
					</div>
				</div>
			</div>
			<!-- Item END -->

			<!-- Item START -->
			<div class="col-md-6 col-lg-3">
				<div class="card align-items-center bg-transparent">
					<!-- Image overlay -->
					<div class="position-relative">
						<!-- Image -->
						<div class="box-xxxl bg-primary-overlay-hover border border-white border-5 rounded-circle shadow-lg">
					 	 <img src="assets/images/about/work/03.jpg" class="box-img" alt="...">
					 	</div>
					 	<!-- Hover element -->
						 <div class="card-element-hover box-md bg-white rounded-circle position-absolute top-50 start-50 translate-middle">
							<span class="text-primary fs-6 fw-bold">03</span>
						</div>
					</div>
					<!-- Content -->
					<div class="card-body">
						<h4 class="card-title">Buy or Rent Home</h4>
						<p class="card-text">Fulfilled direction use continual Saw met applauded concealed and her.</p>
					</div>
				</div>
			</div>
			<!-- Item END -->

			<!-- Item START -->
			<div class="col-md-6 col-lg-3">
				<div class="card align-items-center bg-transparent">
					<!-- Image overlay -->
					<div class="position-relative">
						<!-- Image -->
						<div class="box-xxxl bg-primary-overlay-hover border border-white border-5 rounded-circle shadow-lg">
					 	 <img src="assets/images/about/work/04.jpg" class="box-img" alt="...">
					 	</div>
							<!-- Hover element -->
							<div class="card-element-hover box-md bg-white rounded-circle position-absolute top-50 start-50 translate-middle">
								<span class="text-primary fs-6 fw-bold">04</span>
							</div>
					</div>
				 	<!-- Content -->
					<div class="card-body">
						<h4 class="card-title">Live Happily</h4>
						<p class="card-text">As it so contrasted oh estimating instrument. Size like body someone had.</p>
					</div>
				</div>
			</div>
			<!-- Item END -->
		</div>
	</div>
</section>
<!-- =======================
Work END -->

<!-- =======================
Property START -->
<section class="position-relative z-index-9">
    <div class="container">
        <!-- Title -->
        <div class="text-center">
            <h2>Feature Properties</h2>
            <p>A pleasure exertion if believed provided to all led out world this music while asked</p>
        </div>

        <div class="row mt-5">
            @foreach ($listings as $listing)
            <!-- Property START -->
            <div class="col-sm-6 col-lg-4">
                <div class="card mb-4">
					<div class="position-relative overflow-hidden">
						<!-- Image -->
						@if ($listing->photos->isNotEmpty())
							<img class="card-img" 
								 src="{{ Storage::url($listing->photos->first()->photo_url) }}" 
								 alt="Property image" 
								 style="width: 100%; height: 200px; object-fit: cover;">
						@else
							<img class="card-img" 
								 src="path_to_default_image.jpg" 
								 alt="No image available" 
								 style="width: 100%; height: 200px; object-fit: cover;">
						@endif
						<!-- Image overlay -->
						<div class="card-img-overlay">
							<div class="text-end">
								<a href="#" class="badge bg-dark text-light me-2"><i class="fas fa-video pe-2"></i><span>2</span></a>
								<a href="#" class="badge bg-dark text-light"><i class="fas fa-camera pe-2"></i><span>2</span></a>
							</div>
						</div>    
					</div>
					<!-- Card body START -->
					<div class="card-body px-2 pt-3">
						<!-- Badge and icon -->
						<div class="d-flex justify-content-between">
							<div>
								<a href="#" class="badge bg-primary-soft text-primary"><i class="fas fa-user-friends pe-1"></i>Family</a>
								<a href="#" class="badge bg-danger-soft text-danger"><i class="fas fa-rupee-sign pe-1"></i>{{ $listing->type }}</a>
							</div>
							<a href="#"><i class="fas fa-heart fa-fw text-danger ms-auto"></i></a>
						</div>
						<!-- Title -->
						<h4 class="card-title mt-3">
							<a href="{{ route('listings.show', $listing->id)}}">{{ $listing->title }}</a>
						</h4>
						<!-- Info -->
						<ul class="nav nav-divider align-items-center text-uppercase small mt-3">
							<li class="nav-item me-4">
								<i class="fas fa-bed pe-1"></i> <span>{{ $listing->bedrooms }}</span>
							</li>
							<li class="nav-item me-4">
								<i class="fas fa-bath pe-1"></i> <span>{{ $listing->bathrooms }}</span>
							</li>
							<li class="nav-item me-4">
								<i class="fas fa-user pe-1"></i> <span>{{ $listing->occupancy }}</span>
							</li>
							<li class="nav-item me-4">
								<i class="fas fa-square pe-1"></i> <span>{{ $listing->area }}<sup class="text-lowercase">m2</sup></span>
							</li>
						</ul>
						<!-- Price -->
						<div class="mt-3 d-flex justify-content-between align-items-center">
							<div>
								<h3 class="text-success mb-0">₱{{ $listing->price }}</h3>
							</div>
							<a class="btn btn-dark btn-sm" href="{{ route('listings.show', $listing->id) }}">View details</a>
						</div>
					</div>
					<!-- Card body END -->
				</div>
            </div>
            <!-- Property END -->
            @endforeach
        </div>
    </div>
</section>




<!-- =======================
Property END -->

<!-- =======================
Review START -->

<!-- =======================
Review END -->

<!-- =======================
City START -->
{{-- <section class="pt-0">
	<div class="container card-grid">
		<!-- Title -->
		<div class="text-center mb-3 mb-md-5">
			<h2>Explore cities</h2>
			<p>Delightful own attachment her partiality unaffected occasional thoroughly</p>
		</div>
		<div class="row g-4">
			<!-- Category START -->
			<div class="col-md-3">
				<!-- Image -->
				<div class="card card-metro card-grid-lg overflow-hidden rounded" style="background-image:url(assets/images/city/01.jpg); background-position: center; background-size: cover;">
					<!-- Image overlay -->
					<div class="card-img-overlay d-flex flex-column"> 
						<!-- Info -->
						<div class="mt-auto card-text">
							<a href="#" class="badge bg-light-soft">5 Property</a>
								<div>
									<a href="#" class="text-light mt-auto fs-4 stretched-link">India/ Mumbai</a>
								</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Category END -->

			<!-- Category START -->
			<div class="col-md-3">
				<!-- Image -->
				<div class="card card-metro card-grid-lg overflow-hidden rounded" style="background-image:url(assets/images/city/04.jpg); background-position: center; background-size: cover;">
					<!-- Image overlay -->
					<div class="card-img-overlay d-flex flex-column"> 
						<!-- Info -->
						<div class="mt-auto card-text">
							<a href="#" class="badge bg-light-soft">5 Property</a>
								<div>
									<a href="#" class="text-light mt-auto fs-4 stretched-link">America/ California</a>
								</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Category END -->
		
			<div class="col-md-6">
				<div class="row g-4">
					<!-- Category START -->
					<div class="col-12">
						<!-- Image -->
						<div class="card card-metro card-grid-sm overflow-hidden rounded" style="background-image:url(assets/images/city/03.jpg); background-position: center left; background-size: cover;">
							<!-- Image overlay -->
							<div class="card-img-overlay d-flex flex-column"> 
								<!-- Info -->
								<div class="mt-auto card-text">
									<a href="#" class="badge bg-light-soft">5 Property</a>
									<div>
										<a href="#" class="text-light mt-auto fs-4 stretched-link">England/ London</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Category END -->

					<!-- Category START -->
					<div class="col-12">
						<!-- Image -->
						<div class="card card-metro card-grid-sm overflow-hidden rounded" style="background-image:url(assets/images/city/02.jpg); background-position: center left; background-size: cover;">
							<!-- Image overlay -->
							<div class="card-img-overlay d-flex flex-column"> 
								<!-- Info -->
								<div class="mt-auto card-text">
									<a href="#" class="badge bg-light-soft">5 Property</a>
									<div>
										<a href="#" class="text-light mt-auto fs-4 stretched-link">Dubai/ Dubai</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Category END -->
				</div>
			</div>
		</div> <!-- Row END -->
	</div>	
</section> --}}
<!-- =======================
City END -->


</main>

<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Vendors -->
<script src="assets/vendor/purecounterjs/dist/purecounter_vanilla.js"></script>
<script src="assets/vendor/tiny-slider/tiny-slider.js"></script>
<script src="../../cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<!-- Template Functions -->
<script src="assets/js/functions.js"></script>
@endsection