<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themes.webestica.com/realty/agent-add-property.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Oct 2024 10:21:56 GMT -->
<head>
	<title>Realty - Real Estate Bootstrap 5 Template</title>
	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Webestica.com">
	<meta name="description" content="bootstrap 5 based real estate template">

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&amp;family=DM+Serif+Text&amp;display=swap" rel="stylesheet">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="assets/vendor/font-awesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-icons/bootstrap-icons.css">
	
	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>

<body>
<!-- **************** MAIN CONTENT START **************** -->
<main>
	<!-- Navbar top START -->
	<div class="dashboard-topbar navbar-dark bg-dark px-3 px-sm-4 px-md-5">
		<div class="d-flex justify-content-between align-items-center">
			<!-- Logo -->
			<a class="navbar-brand d-flex align-items-center py-2" href="index.html">
				<img class="navbar-brand-item" src="assets/images/logo-light.svg" alt="logo">
			</a>
	
			<!-- Navbar right -->
			<ul class="list-inline m-0 text-primary-hover">
				<!-- Search bar -->
				<li class="d-none d-md-inline-block list-inline-item text-white me-3">
					<form class="align-self-center position-relative" role="search" action="#">
						<input type="text" class="form-control bg-secondary-soft text-white border-0" placeholder="Search here...">
						<button type="submit" id="search-submit" class="btn position-absolute top-50 end-0 translate-middle-y"><i class="fa fa-search text-secondary"></i></button>
					</form>
				</li>
				<!-- Icon -->
				<li class="list-inline-item me-2 me-sm-3"> <a href="#" class="text-white"><i class="far fa-envelope"></i></a></li>
				<li class="list-inline-item me-2 me-sm-3">
					<a href="#" class="text-white position-relative">
						<i class="far fa-bell"></i>
						<span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-danger p-1">
							<span class="visually-hidden">unread messages</span>
						</span>
					</a>
				</li>
				<!-- Dropdown avatar -->
				<li class="list-inline-item">
					<a href="#" class="btn-link" role="button" id="dropdownAvatar" data-bs-toggle="dropdown" aria-expanded="false">
						<img class="box-sm rounded-circle" src="assets/images/avatar/2.jpg" alt="Profile picture">
					</a>
					<!-- Dropdown list -->
					<ul class="dropdown-menu min-w-auto" aria-labelledby="dropdownAvatar">
						<li><a class="dropdown-item" href="#">Profile</a></li>
						<li><a class="dropdown-item" href="#">Setting</a></li>
						<li><a class="dropdown-item" href="#">My Wallet</a></li>
						<li><a class="dropdown-item" href="#">Sign out</a></li>
					</ul>
				</li>
				<!-- Toggle button -->
				<li class="list-inline-item d-md-inline-block d-lg-none">
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#dashboardNav" aria-controls="dashboardNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
				</li>
			</ul>
		</div>
	</div>
	<!--Navbar top END -->
	
	<div class="container-fluid px-0">
		<div class="page-wrapper">
			<!-- Left sidebar START -->
			<nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
				<div class="collapse navbar-collapse" id="dashboardNav">
					<div class="dashboard-sidebar bg-light">
						<div class="content mt-3">
							<!-- Sidebar menu -->
							<div class="list-group list-group-borderless p-3 p-md-4">
								<p class="text-body mb-2">Main</p>
									<a class="list-group-item hover-primary-soft" href="{{ route('owner') }}"><i class="fas fa-fw fa-tachometer-alt me-2"></i>Dashboard</a>

								<p class="text-body mt-3 mb-2">Manage Listing</p>
								<a class="list-group-item hover-primary-soft" href="{{ url('clisting') }}"><i class="bi fa-fw bi-bookmark-plus-fill me-2"></i>Add Property</a>
								<a class="list-group-item hover-primary-soft" href="{{ route('owner.property') }}"><i class="fas fa-fw fa-home me-2"></i>My Property</a>
									<a class="list-group-item hover-primary-soft" href="agent-review.html"><i class="far fa-fw fa-comment-dots me-2"></i>Review</a>

								<p class="text-body mt-3 mb-2">Messages</p>
									<a class="list-group-item hover-primary-soft" href="{{ route('suppmess.index') }}"><i class="fas fa-fw fa-envelope me-2"></i>Message</a>

								<p class="text-body mt-3 mb-2">Manage Account</p>
									<a class="list-group-item hover-primary-soft" href="{{ route('profile.edit') }}"><i class="fas fa-fw fa-user-alt me-2"></i>My Profile</a>
									<form action="{{ route('signout') }}" method="POST" class="d-inline">
										@csrf
										<button type="submit" class="list-group-item hover-primary-soft" style="border: none; background: none; cursor: pointer;">
											<i class="fas fa-fw fa-sign-out-alt me-2"></i>Log Out
										</button>
									</form>

					
							</div>
						</div>
					</div>
				</div>
			</nav>	
			<!-- Left sidebar END -->
	
			<!-- Main content START -->
			<div class="main-content">
				<div class="row">
					<div class="col-12">
						<!-- Page title -->
						<div class="my-5">
							<h3>Add Property</h3>
							<hr>
						</div>
						<form id="stepByStepForm" class="file-upload" action="{{ route('listing.store') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<ul class="progress-step">
								<li class="progress-bar__dot full box-md position-relative me-4 me-lg-0">
									<span class="mb-0 position-absolute top-50 start-50 translate-middle fs-6"><i class="far fa-edit"></i></span>
								</li>
								<li class="progress-bar__connector align-items-center d-none d-lg-block">
									<span class="fs-5 mb-0 ms-2 text-dark">Description</span>
								</li>
								<li class="progress-bar__dot box-md position-relative me-4 me-lg-0">
									<span class="mb-0 position-absolute top-50 start-50 translate-middle fs65"><i class="fas fa-photo-video"></i></span>
								</li>
								<li class="progress-bar__connector align-items-center d-none d-lg-block">
									<span class="fs-5 mb-0 ms-2 text-dark">Media</span>
								</li>
								<li class="progress-bar__dot box-md position-relative me-4 me-lg-0">
									<span class="mb-0 position-absolute top-50 start-50 translate-middle fs65"><i class="fas fa-map-marker-alt"></i></span>
								</li>
								<li class="progress-bar__connector align-items-center d-none d-lg-block">
									<span class="fs-5 mb-0 ms-2 text-dark">Location</span>
								</li>
								<li class="progress-bar__dot box-md position-relative">
									<span class="mb-0 position-absolute top-50 start-50 translate-middle fs65"><i class="fas fa-bars"></i></span>
								</li>
								<li class="progress-bar__connector align-items-center d-none d-lg-block">
									<span class="fs-5 mb-0 ms-2 text-dark">Amenities</span>
								</li>
							</ul>
						
							<!-- Description step -->
							<div class="step step1">
								<div class="row gx-5 align-items-center justify-content-center">
									<div class="col-xxl-10 mb-5 mb-xxl-0">
										<div class="row g-3 bg-secondary-soft rounded p-3 p-md-5">
											<h4 class="my-0">Property Status</h4>
											<div class="col-md-12">
												<label class="form-label">Title *</label>
												<input type="text" class="form-control" name="title" aria-label="Title">
											</div>
											<div class="col-md-12">
												<label for="body" class="form-label">Description *</label>
												<textarea class="form-control" name="body" id="body" rows="4" spellcheck="false"></textarea>
											</div>
											<div class="col-md-6">
												<label class="form-label">Type *</label>
												<select class="form-select" name="type">
													<option value="">Select item</option>
													<option>Apartment</option>
													<option>Boarding house</option>
													<option>House</option>
													<option>Room</option>
												</select>
											</div>
											<div class="col-md-6">
												<label class="form-label">Availability *</label>
												<select class="form-select" name="availability">
													<option value="open">Open</option>
													<option value="closed">Closed</option>
												</select>
											</div>
											<div class="col-md-6">
												<label class="form-label">Reservation Status *</label>
												<select class="form-select" name="reservation">
													<option value="open">Open</option>
													<option value="closed">Closed</option>
												</select>
											</div>
											<div class="col-md-6">
												<label class="form-label">Price *</label>
												<input type="text" class="form-control" name="price" aria-label="Price">
											</div>
											<div class="col-md-6">
												<label class="form-label">Reservation Amount *</label>
												<input type="text" class="form-control" name="reservation_amount" aria-label="Reservation Amount">
											</div>
										</div>
									</div>
								</div>
							</div>
						
							<!-- Media step -->
							<div class="step step2 hidden">
								<div class="row gx-5 align-items-center justify-content-center">
									<div class="col-xxl-10 mb-5 mb-xxl-0">
										<div class="row g-3 bg-secondary-soft p-3 p-md-5 rounded">
											<h4 class="mb-4 mt-0">Upload Property Photos</h4>
											<div class="col-md-12">
												<input type="file" name="photos[]" multiple>
											</div>
										</div>
									</div>
								</div>
							</div>
						
							<!-- Location step -->
							<div class="step step3 hidden">
								<div class="row gx-5">
									<div class="col-xxl-6 mb-5 mb-xxl-0">
										<div class="bg-secondary-soft p-3 p-sm-5 rounded">
											<h4>Location Details</h4>
											<div class="col-md-6">
												<label class="form-label">City *</label>
												<input type="text" class="form-control" name="city" aria-label="City">
											</div>
											<div class="col-md-6">
												<label class="form-label">Baranggay *</label>
												<input type="text" class="form-control" name="baranggay" aria-label="Baranggay">
											</div>
											<div class="col-md-12">
												<label class="form-label">Address *</label>
												<textarea class="form-control" name="address" rows="4" spellcheck="false"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						
							<!-- Amenities step -->
							<div class="step step4 hidden">
								<div class="row mb-4 gx-5">
									<div class="col-xxl-12">
										<div class="bg-secondary-soft p-5 rounded">
											<h5 class="font-base mb-2">Amenities</h5>
											<div class="row">
												<div class="col-md-4">
													<div class="form-check">
														<input type="checkbox" class="form-check-input" name="wifi" id="wifi">
														<label class="form-check-label" for="wifi">Wifi</label>
													</div>
													<div class="form-check">
														<input type="checkbox" class="form-check-input" name="parking" id="parking">
														<label class="form-check-label" for="parking">Parking</label>
													</div>
													<div class="form-check">
														<input type="checkbox" class="form-check-input" name="bathroom" id="bathroom">
														<label class="form-check-label" for="bathroom">Bathroom</label>
													</div>
												</div>
												<!-- Repeat for other amenities as needed -->
											</div>
										</div>
									</div>
								</div>
							</div>
						
							<!-- Navigation Buttons -->
							<div class="mt-5 d-flex justify-content-between">
								<button id="previous" class="disabled btn btn-dark-soft" disabled>Previous</button>
								<button id="next" class="btn btn-primary-soft">Next</button>
							</div>
							<div class="text-end">
								<button id="validate" type="submit" class="hidden btn btn-success btn-md">Submit</button>
							</div>
						</form>
						
					</div>
				</div> <!-- Row END -->
			</div>
			<!-- Main content END -->
		</div>
	</div>
</main>
<!-- **************** MAIN CONTENT END **************** -->
<!-- Back to top -->
<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>
<!-- Back to top -->

<!-- =======================
JS libraries, plugins and custom scripts -->

<!-- Bootstrap JS -->
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Vendors -->
<!-- Template Functions -->
<script src="assets/js/functions.js"></script>

<!-- Script for tab active -->
<script>
const previousButton = document.getElementById("previous")
const nextButton = document.getElementById("next")
const submitButton = document.getElementById('validate')
const form = document.getElementById('stepByStepForm')
const dots = document.getElementsByClassName('progress-bar__dot')
const numberOfSteps = 4
let currentStep = 1

// Check if all necessary elements exist
if (!previousButton || !nextButton || !submitButton || !form) {
    console.error("One or more elements are missing.");
}

// Attach event listeners to the dots for step navigation
for(let i = 0 ; i < dots.length ; ++i){
    dots[i].addEventListener('click', ()=>{
        goToStep(i+1) 
    })
}

// Button click event handlers
previousButton.onclick = goPrevious
nextButton.onclick = goNext

function goNext(e) {
    e.preventDefault()
    currentStep += 1
    goToStep(currentStep)
}

function goPrevious(e) {
    e.preventDefault()
    currentStep -= 1
    goToStep(currentStep)
}

function goToStep(stepNumber){   
    currentStep = stepNumber
    
    let inputsToHide = document.getElementsByClassName('step')
    let inputs = document.getElementsByClassName(`step${currentStep}`)
    let indicators = document.getElementsByClassName('progress-bar__dot')
    
    for(let i = indicators.length - 1; i >= currentStep; --i){
        indicators[i].classList.remove('full')
    }
    
    for(let i = 0; i < currentStep; ++i){
        indicators[i].classList.add('full')
    }
    
    // Hide all steps
    for (let i = 0; i < inputsToHide.length; ++i) {
        hide(inputsToHide[i])
    }
    
    // Show the current step
    for (let i = 0; i < inputs.length; ++i) {
        show(inputs[i])
    }
    
    // If we reached the final step
    if(currentStep === numberOfSteps){
        enable(previousButton)
        disable(nextButton)
        show(submitButton)
    }
    
    // If it's the first step
    else if(currentStep === 1){
        disable(previousButton)
        enable(nextButton)
        hide(submitButton)
    }
    
    // Otherwise
    else {
        enable(previousButton)
        enable(nextButton)
        hide(submitButton)
    }
}

// Helper functions for enabling, disabling, showing, and hiding elements
function enable(elem) {
    elem.classList.remove("disabled");
    elem.disabled = false;
}

function disable(elem) {
    elem.classList.add("disabled");
    elem.disabled = true;
}

function show(elem){
    elem.classList.remove('hidden')
}

function hide(elem){
    elem.classList.add('hidden')
}
</script>

</body>

<!-- Mirrored from themes.webestica.com/realty/agent-add-property.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Oct 2024 10:21:56 GMT -->
</html>
