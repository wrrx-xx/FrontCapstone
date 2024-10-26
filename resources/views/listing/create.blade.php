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
									 <!-- Row START -->
									
									<div class="row gx-5 align-items-center justify-content-center">
									<!-- Property detail -->
									<div class="col-xxl-10 mb-5 mb-xxl-0">
								<div class="row g-3 bg-secondary-soft rounded p-3 p-md-5">
									<h4 class="my-0">Property Status</h4>
									<!-- Title -->
									<div class="col-md-12">
										<label class="form-label">Title *</label>
										<input type="text" class="form-control" name="title" aria-label="Title">
									</div>
									<!-- Description -->
									<div class="col-md-12">
										<label for="exampleFormControlTextarea1" class="form-label">Description *</label>
										<textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="4" spellcheck="false"></textarea>
									</div>

									<!-- Type -->
									<div class="col-md-6">
										<label class="form-label">Type *</label>
										<select class="form-select " aria-label="Default select example" name="type">
											<option value="">Select item</option>
											<option>Apartment</option>
											<option>Boarding house</option>
											<option>House</option>
											<option>Room</option>
											
										</select>
									</div>
									
									<!-- Status -->
									<div class="col-md-6">
										<label class="form-label">Status *</label>
										<select class="form-select " aria-label="Default select example" name="availability">
											<option value="">Select item</option>
											<option>open</option>
											<option>closed</option>
											
										</select>
									</div>
									<!-- Reservation -->
									<div class="col-md-6">
										<label class="form-label">Reservation *</label>
										<select class="form-select " aria-label="Default select example" name="reservation">
											<option value="">Select item</option>
											<option>open</option>
											<option>closed</option>
											
										</select>
									</div>

									<h4 class="mt-5 mb-0">Property price</h4>
									<div class="col-md-6">
										<label class="form-label">Enter price *</label>
										<input type="text" class="form-control" aria-label="price" name="price"> <!-- Changed name for clarity -->
									</div>
									<!-- Reservation price -->
									<div class="col-md-6">
										<label class="form-label">Reservation price *</label>
										<input type="text" class="form-control" aria-label="price" name="reservation_price"> <!-- Changed name for clarity -->
									</div> 
									</div>
									</div>
								</div> <!-- Row END -->
								</div>
						 
								<!-- Media step -->
								<div class="step step2 hidden">
									 <!-- Row START -->
									 <div class="row gx-5 align-items-center justify-content-center">
										<!-- Property detail -->
										<div class="col-xxl-10 mb-5 mb-xxl-0">
											<div class="row g-3 bg-secondary-soft p-3 p-md-5 rounded">
												<h4 class="mb-4 mt-0">Upload your property photo</h4>
												<!-- upload file -->
												<div class="col-md-12 mt-0">
													<div class="d-flex justify-content-center align-items-center p-4 bg-primary-soft border-dashed rounded">
														<input type="file" id="customFile" name="photos[]"  hidden>
														<label for="customFile" style="cursor:pointer;">
															<span class="fs-2 text-primary"><i class="fas fa-file-upload me-4"></i></span>
														</label>
														<div>
															<h6 class="mb-1">Drag file here or click to upload</h6>
															<span>upload up to 8 files</span>
														</div>
													</div>
												</div>

												
											</div> <!-- Row END -->
										</div>
									</div> <!-- Row END -->
								</div>
						 
								<!-- Location step -->
								<div class="step step3 hidden">
									 <!-- Row START -->
									 <div class="row gx-5">
										<!-- Location detail -->
										<div class="col-xxl-6 mb-5 mb-xxl-0">
											<div class="bg-secondary-soft p-3 p-sm-5 rounded">
												<div class="row g-3">
													<h4 class="my-4">Location Detail</h4>
													<!-- City -->
													<div class="col-md-6">
														<label class="form-label">City *</label>
														<input type="text" class="form-control" name="city" aria-label="City">
													</div>
													<div class="col-md-6">
														<label class="form-label">Baranggay *</label>
														<input type="text" class="form-control"name="baranggay" ria-label="City">
													</div>
													<!-- Address -->
													<div class="col-md-12">
														<label for="exampleFormControlTextarea2" class="form-label">Address *</label>
														<textarea class="form-control"name="address" id="exampleFormControlTextarea2" rows="4" spellcheck="false"></textarea>
													</div>
												</div> <!-- Row END -->
											</div>
										</div>
										<!-- Google map -->
										<div class="col-xxl-6">
											<div class="row g-3 bg-secondary-soft p-3 p-md-5 rounded">
												<div class="position-md-absolute end-0 top-0 w-100 h-400 mb-4">
													<iframe class="w-100 h-100 grayscale" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.9663095343008!2d-74.00425878428698!3d40.74076684379132!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259bf5c1654f3%3A0xc80f9cfce5383d5d!2sGoogle!5e0!3m2!1sen!2sin!4v1586000412513!5m2!1sen!2sin" style="border:0;" aria-hidden="false" tabindex="0"></iframe>	
												</div>

											</div>
										</div>
									</div> <!-- Row END -->
								</div>

								<!-- Amenities step -->
								<div class="step step4 hidden">
									<!-- Row START -->
									<div class="row mb-4 gx-5">
										<div class="col-xxl-12 mb-xxl-0">
											<div class="bg-secondary-soft p-5 rounded">
												<div class="row">
													<!-- Info -->
													<div class="col-sm-6 col-md-4 mt-4 mt-sm-0">
														<!-- Title -->
														<h5 class="font-base mb-2">Interior Details</h5>
														<!-- Kitchen -->
														<div class="form-check">
															<input class="form-check-input" type="checkbox" name="kitchen" id="flexCheckDefault1">
															<label class="form-check-label" for="flexCheckDefault1">
																Kitchen
															</label>
														</div>
														<!-- Laundry -->
														<div class="form-check">
															<input class="form-check-input" type="checkbox" name="laundry" id="flexCheckDefault2">
															<label class="form-check-label" for="flexCheckDefault2">
																Laundry
															</label>
														</div>
														<!-- Gym -->
														<div class="form-check">
															<input class="form-check-input" type="checkbox" name="gym" id="flexCheckDefault3">
															<label class="form-check-label" for="flexCheckDefault3">
																Gym
															</label>
														</div>
														<!-- Projector Room -->
														<div class="form-check">
															<input class="form-check-input" type="checkbox" name="projector_room" id="flexCheckDefault4">
															<label class="form-check-label" for="flexCheckDefault4">
																Projector Room
															</label>
														</div>
													</div>
								
													<!-- Info -->
													<div class="col-sm-6 col-md-4 mt-4 mt-sm-0">
														<!-- Title -->
														<h5 class="font-base mb-2">Outdoor Details</h5>
														<!-- Back yard -->
														<div class="form-check">
															<input class="form-check-input" type="checkbox" name="back_yard" id="flexCheckDefault5">
															<label class="form-check-label" for="flexCheckDefault5">
																Back yard
															</label>
														</div>
														<!-- Front yard -->
														<div class="form-check">
															<input class="form-check-input" type="checkbox" name="front_yard" id="flexCheckDefault6">
															<label class="form-check-label" for="flexCheckDefault6">
																Front yard
															</label>
														</div>
														<!-- Attached garage -->
														<div class="form-check">
															<input class="form-check-input" type="checkbox" name="attached_garage" id="flexCheckDefault7">
															<label class="form-check-label" for="flexCheckDefault7">
																Attached garage
															</label>
														</div>
														<!-- Pool -->
														<div class="form-check">
															<input class="form-check-input" type="checkbox" name="pool" id="flexCheckDefault8">
															<label class="form-check-label" for="flexCheckDefault8">
																Pool
															</label>
														</div>
													</div>
								
													<!-- Info -->
													<div class="col-sm-6 col-md-4 mt-4 mt-md-0">
														<!-- Title -->
														<h5 class="font-base mb-2">Other Features</h5>
														<!-- Elevator -->
														<div class="form-check">
															<input class="form-check-input" type="checkbox" name="elevator" id="flexCheckDefault9">
															<label class="form-check-label" for="flexCheckDefault9">
																Elevator
															</label>
														</div>
														<!-- Wifi -->
														<div class="form-check">
															<input class="form-check-input" type="checkbox" name="wifi" id="flexCheckDefault10">
															<label class="form-check-label" for="flexCheckDefault10">
																Wifi
															</label>
														</div>
														<!-- School -->
														<div class="form-check">
															<input class="form-check-input" type="checkbox" name="school" id="flexCheckDefault11">
															<label class="form-check-label" for="flexCheckDefault11">
																School
															</label>
														</div>
														<!-- Transportation hub -->
														<div class=" form-check">
															<input class="form-check-input" type="checkbox" name="transportation_hub" id="flexCheckDefault12">
															<label class="form-check-label" for="flexCheckDefault12">
																Transportation hub
															</label>
														</div>
														<!-- Super market -->
														<div class="form-check">
															<input class="form-check-input" type="checkbox" name="super_market" id="flexCheckDefault13">
															<label class="form-check-label" for="flexCheckDefault13">
																Super market
															</label>
														</div>
														<!-- Clinic -->
														<div class="form-check">
															<input class="form-check-input" type="checkbox" name="clinic" id="flexCheckDefault14">
															<label class="form-check-label" for="flexCheckDefault14">
																Clinic
															</label>
														</div>
													</div>
												</div> <!-- Row END -->
											</div>
										</div>
									</div>
								</div>
						 
							 <!-- Buttons -->
								<div class="mt-5 d-flex justify-content-between">
									 <button id="previous" class="disabled btn btn-md btn-dark-soft" disabled>
											previous
									 </button>
									 <button id="next" class="btn btn-primary-soft btn-md">
											next
									 </button>
									 <!-- <button id="validate" type="submit" class="hidden btn btn-success-soft btn-md">
										Submit
									</button> -->
								</div>
								<div class="text-end">
									<button id="validate" type="submit" class="hidden btn btn-success btn-md">
										Submit
									</button>
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

for(let i = 0 ; i < dots.length ; ++i){
	 dots[i].addEventListener('click', ()=>{
		 goToStep(i+1) 
	 })
}

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
	 
	 for(let i = indicators.length-1; i >= currentStep ; --i){
			indicators[i].classList.remove('full')
	 }
	 
	 for(let i = 0; i < currentStep; ++i){
			indicators[i].classList.add('full')
	 }
	 
	 //hide all input
	 for (let i = 0; i < inputsToHide.length; ++i) {
			hide(inputsToHide[i])
	 }
	 
	 //only show the right one
	 for (let i = 0; i < inputs.length; ++i) {
			show(inputs[i])
	 }
	 
	 //if we reached final step
	 if(currentStep === numberOfSteps){
			enable(previousButton)
			disable(nextButton)
			show(submitButton)
	 }
	 
	 //else if first step
	 else if(currentStep === 1){
		 disable(previousButton)
			enable(next)
			hide(submitButton)
	 }
	 
	 else {
			enable(previousButton)
			enable(next)
			hide(submitButton)
	 }
}

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