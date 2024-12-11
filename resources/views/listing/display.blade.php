@extends('layouts.guest')
@section('content')
    <!-- =======================
    Main Banner START -->
    <section class="position-relative z-index-9"
        style="
        background: url(assets/images/bg/bg.jpg) no-repeat center center;
        background-size: cover;
        background-attachment: fixed;
      ">
        <div class="container">
            <!-- Form START -->
            <form class="row">
                <div class="col-md-12 my-4">
                    <div class="shadow-lg p-3 bg-blur p-4 rounded-1">
                        <div class="row g-3">
                            <div class="col-lg-4 pt-3 pt-lg-0">
                                <!-- Input -->
                                <input type="text" class="form-control" id="formGroupExampleInput1"
                                    placeholder="Enter keyword" />
                            </div>

                            <div class="col-lg-8 pt-3 pt-lg-0">
                                <div class="row g-3 align-items-center">
                                    <!-- Search item -->
                                    <div class="col-sm-6 col-md-3 pb-2 pb-md-0">
                                        <select class="form-select form-select-sm js-choice"
                                            aria-label=".form-select-sm example">
                                            <option value="">Type</option>
                                            <option>Rent</option>
                                            <option>Sale</option>
                                        </select>
                                    </div>
                                    <!-- Search item -->
                                    <div class="col-sm-6 col-md-3 pb-2 pb-md-0">
                                        <select class="form-select form-select-sm js-choice"
                                            aria-label=".form-select-sm example">
                                            <option value="">Categories</option>
                                            <option>Aparement</option>
                                            <option>Land</option>
                                            <option>Houses</option>
                                            <option>Villas</option>
                                            <option>Retails</option>
                                            <option>Shop</option>
                                            <option>Office</option>
                                        </select>
                                    </div>
                                    <!-- Search item -->
                                    <div class="col-sm-6 col-md-3 pb-2 pb-md-0">
                                        <div class="d-grid gap-2">
                                            <input type="checkbox" class="btn-check" id="btn-check-outlined" />
                                            <label class="btn btn-outline-primary" for="btn-check-outlined"
                                                data-bs-toggle="collapse" data-bs-target="#collapseExample"
                                                aria-controls="collapseExample">
                                                <i class="fas fa-sliders-h me-2"></i>Advance
                                            </label>
                                        </div>
                                    </div>
                                    <!-- Button -->
                                    <div class="col-sm-6 col-md-3 pb-2 pb-md-0">
                                        <button type="button" class="btn btn-primary w-100">
                                            Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Row END -->

                        <div class="row">
                            <!-- Colleps body -->
                            <div class="collapse" id="collapseExample">
                                <div class="row g-3 mt-3">
                                    <!-- Colleps item -->
                                    <div class="col-sm-6 col-md-3 pb-2 pb-md-0">
                                        <select class="form-select form-select-sm js-choice"
                                            aria-label=".form-select-sm example">
                                            <option value="">City</option>
                                            <option>Mumbai</option>
                                            <option>Delhi</option>
                                            <option>Los Angeles</option>
                                            <option>Phoenix</option>
                                            <option>New York</option>
                                        </select>
                                    </div>
                                    <!-- Colleps item -->
                                    <div class="col-sm-6 col-md-3 pb-2 pb-md-0">
                                        <select class="form-select form-select-sm js-choice"
                                            aria-label=".form-select-sm example">
                                            <option value="">Areas</option>
                                            <option>Manhattan</option>
                                            <option>Queens</option>
                                            <option>Westside</option>
                                        </select>
                                    </div>
                                    <!-- Colleps item -->
                                    <div class="col-sm-6 col-md-3 pb-2 pb-md-0">
                                        <!-- Input -->
                                        <input type="text" class="form-control" id="formGroupExampleInput2"
                                            placeholder="Min Price" />
                                    </div>
                                    <!-- Colleps item -->
                                    <div class="col-sm-6 col-md-3 pb-2 pb-md-0">
                                        <!-- Input -->
                                        <input type="text" class="form-control" id="formGroupExampleInput3"
                                            placeholder="Max Price" />
                                    </div>

                                    <!-- Amenities -->
                                    <h6 class="font-base text-primary mt-4">
                                        <i class="fas fa-fw fa-sliders-h me-2"></i>Amenities
                                    </h6>
                                    <div class="row mt-2">
                                        <!-- Item -->
                                        <div class="col-sm-6 col-md-3">
                                            <!-- checkbox -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault" />
                                                <label class="form-check-label text-white" for="flexCheckDefault">
                                                    Clinic
                                                </label>
                                            </div>
                                            <!-- checkbox -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault2" />
                                                <label class="form-check-label text-white" for="flexCheckDefault2">
                                                    Internet
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Item -->
                                        <div class="col-sm-6 col-md-3">
                                            <!-- checkbox -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault3" />
                                                <label class="form-check-label text-white" for="flexCheckDefault3">
                                                    Park
                                                </label>
                                            </div>
                                            <!-- checkbox -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault4" />
                                                <label class="form-check-label text-white" for="flexCheckDefault4">
                                                    School
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Item -->
                                        <div class="col-sm-6 col-md-3">
                                            <!-- checkbox -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault5" />
                                                <label class="form-check-label text-white" for="flexCheckDefault5">
                                                    Supermarket
                                                </label>
                                            </div>
                                            <!-- checkbox -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault6" />
                                                <label class="form-check-label text-white" for="flexCheckDefault6">
                                                    Swiming pool
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Item -->
                                        <div class="col-sm-6 col-md-3">
                                            <!-- checkbox -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault7" />
                                                <label class="form-check-label text-white" for="flexCheckDefault7">
                                                    Transportation hub
                                                </label>
                                            </div>
                                            <!-- checkbox -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault8" />
                                                <label class="form-check-label text-white" for="flexCheckDefault8">
                                                    Air Conditioning
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row END -->
                                </div>
                                <!-- Row END -->
                            </div>
                        </div>
                        <!-- Row END -->
                    </div>
                </div>
            </form>
            <!-- Form END -->
        </div>
    </section>
    <!-- =======================
    Main Banner END -->

    <!-- =======================
    Inner part START -->
    <section class="pt-5">
        <div class="container">
            <!-- Title -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <!-- Title START -->
                    <div class="d-md-flex justify-content-md-between align-items-center">
                        <!-- Title -->
                        <h3 class="mb-0">30 Properties in California</h3>
                        <!-- Button -->
                        <div class="text-primary-hover text-end d-none d-md-block">
                            <ul class="list-inline">
                                <!-- Grid icon -->
                                <li class="list-inline-item">
                                    <a href="#" class="border rounded-1 p-2 me-2"><i
                                            class="fas fa-fw fa-th-large"></i></a>
                                </li>
                                <!-- list icon -->
                                <li class="list-inline-item">
                                    <a href="#" class="border rounded-1 p-2 me-2"><i
                                            class="fas fa-fw fa-list-ul"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Title END -->
                </div>
            </div>

            <div class="row">
                <!-- Left sidebar START -->
                <div class="col-lg-4 pt-5 pt-lg-0 order-2 order-lg-1">
                    <div class="row mb-5 mb-lg-0">
                        <div class="col-12 col-sm-6 col-lg-12">
                            <!-- Advance search START -->
                            <div class="bg-white shadow-lg rounded-1 p-4 mb-4">
                                <!-- Title -->
                                <h4 class="mb-4">Advance Search</h4>
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Form START -->
                                        <form>
                                            <!-- Type item -->
                                            <h6 class="font-base">Type:</h6>
                                            <ul class="list-inline mb-4">
                                                <!-- Rent -->
                                                <li class="list-inline-item">
                                                    <input type="radio" class="btn-check" name="options"
                                                        id="option1" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="option1">Rent</label>
                                                </li>
                                                <!-- Sale -->
                                                <li class="list-inline-item">
                                                    <input type="radio" class="btn-check" name="options"
                                                        id="option2" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="option2">Sale</label>
                                                </li>
                                                <!-- Buy -->
                                                <li class="list-inline-item">
                                                    <input type="radio" class="btn-check" name="options"
                                                        id="option3" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="option3">Buy</label>
                                                </li>
                                            </ul>
                                            <hr class="my-0" />

                                            <!-- Category item -->
                                            <h6 class="font-base mt-4">
                                                <i class="fas fa-fw fa-home me-2"></i>Category:
                                            </h6>
                                            <ul class="list-inline mb-4 g-3">
                                                <!-- Apartment -->
                                                <li class="list-inline-item mb-2">
                                                    <input type="checkbox" class="btn-check" id="btn-check-2" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-2">Aparement</label>
                                                </li>
                                                <!-- Land -->
                                                <li class="list-inline-item mb-2">
                                                    <input type="checkbox" class="btn-check" id="btn-check-3" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-3">Land</label>
                                                </li>
                                                <!-- House -->
                                                <li class="list-inline-item mb-2">
                                                    <input type="checkbox" class="btn-check" id="btn-check-4" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-4">Houses</label>
                                                </li>
                                                <!-- Villas -->
                                                <li class="list-inline-item mb-2">
                                                    <input type="checkbox" class="btn-check" id="btn-check-5" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-5">Villas</label>
                                                </li>
                                                <!-- Retails -->
                                                <li class="list-inline-item mb-2">
                                                    <input type="checkbox" class="btn-check" id="btn-check-6" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-6">Retails</label>
                                                </li>
                                                <!-- Shop -->
                                                <li class="list-inline-item mb-2">
                                                    <input type="checkbox" class="btn-check" id="btn-check-7" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-7">Shop</label>
                                                </li>
                                                <!-- Office -->
                                                <li class="list-inline-item mb-2">
                                                    <input type="checkbox" class="btn-check" id="btn-check-8" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-8">Office</label>
                                                </li>
                                            </ul>
                                            <hr class="my-0" />

                                            <!-- Bedroom item -->
                                            <h6 class="font-base mt-4">
                                                <i class="fas fa-fw fa-bed me-2"></i>Bedroom:
                                            </h6>
                                            <ul class="list-inline mb-4 g-3">
                                                <!-- 1 -->
                                                <li class="list-inline-item">
                                                    <input type="checkbox" class="btn-check" id="btn-check-9" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-9">1</label>
                                                </li>
                                                <!-- 2 -->
                                                <li class="list-inline-item">
                                                    <input type="checkbox" class="btn-check" id="btn-check-10" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-10">2</label>
                                                </li>
                                                <!-- 3 -->
                                                <li class="list-inline-item">
                                                    <input type="checkbox" class="btn-check" id="btn-check-11" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-11">3</label>
                                                </li>
                                                <!-- 4 -->
                                                <li class="list-inline-item">
                                                    <input type="checkbox" class="btn-check" id="btn-check-12" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-12">4</label>
                                                </li>
                                                <!-- 5 -->
                                                <li class="list-inline-item">
                                                    <input type="checkbox" class="btn-check" id="btn-check-13" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-13">5+</label>
                                                </li>
                                            </ul>
                                            <hr class="my-0" />

                                            <!-- Bathroom item -->
                                            <h6 class="font-base mt-4">
                                                <i class="fas fa-fw fa-bath me-2"></i>Bathroom:
                                            </h6>
                                            <ul class="list-inline mb-4 g-3">
                                                <!-- 1 -->
                                                <li class="list-inline-item">
                                                    <input type="checkbox" class="btn-check" id="btn-check-14" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-14">1</label>
                                                </li>
                                                <!-- 2 -->
                                                <li class="list-inline-item">
                                                    <input type="checkbox" class="btn-check" id="btn-check-15" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-15">2</label>
                                                </li>
                                                <!-- 3 -->
                                                <li class="list-inline-item">
                                                    <input type="checkbox" class="btn-check" id="btn-check-16" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-16">3</label>
                                                </li>
                                                <!-- 4 -->
                                                <li class="list-inline-item">
                                                    <input type="checkbox" class="btn-check" id="btn-check-17" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-17">4</label>
                                                </li>
                                                <!-- 5 -->
                                                <li class="list-inline-item">
                                                    <input type="checkbox" class="btn-check" id="btn-check-18" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-18">5+</label>
                                                </li>
                                            </ul>
                                            <hr class="my-0" />

                                            <!-- Area item -->
                                            <h6 class="font-base mt-4">
                                                <i class="fas fa-fw fa-street-view me-2"></i>Area:
                                            </h6>
                                            <select class="form-select mb-4 js-choice"
                                                aria-label="Default select example">
                                                <option value="">Select</option>
                                                <option>Manhattan</option>
                                                <option>Queens</option>
                                                <option>West side</option>
                                            </select>
                                            <hr class="my-0" />

                                            <!-- City item -->
                                            <h6 class="font-base mt-4">
                                                <i class="fas fa-fw fa-city me-2"></i>City:
                                            </h6>
                                            <select class="form-select mb-4 js-choice"
                                                aria-label="Default select example">
                                                <option value="">Select</option>
                                                <option>Manhattan</option>
                                                <option>Queens</option>
                                                <option>West side</option>
                                            </select>
                                            <hr class="my-0" />

                                            <!-- View item -->
                                            <h6 class="font-base mt-4">
                                                <i class="fas fa-fw fa-mountain me-2"></i>View:
                                            </h6>
                                            <ul class="list-inline mb-4 g-3">
                                                <!-- Sea -->
                                                <li class="list-inline-item">
                                                    <input type="checkbox" class="btn-check" id="btn-check-19" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-19">Sea</label>
                                                </li>
                                                <!-- Mountain -->
                                                <li class="list-inline-item">
                                                    <input type="checkbox" class="btn-check" id="btn-check-20" />
                                                    <label class="btn btn-sm btn-light btn-primary-soft-check"
                                                        for="btn-check-20">Mountain</label>
                                                </li>
                                            </ul>
                                            <hr class="my-0" />

                                            <!-- Price range START -->
                                            <h6 class="font-base mt-4">
                                                <i class="fas fa-dollar-sign me-2"></i>Price range
                                            </h6>
                                            <div class="position-relative mt-2">
                                                <div class="noui-wrapper m-b-50 p-l-r">
                                                    <div class="d-flex justify-content-between">
                                                        <input type="text" class="text-body input-with-range-min" />
                                                        <input type="text" class="text-body input-with-range-max" />
                                                    </div>
                                                    <div class="noui-slider-range m-b-20 mt-2" data-range-min="10000"
                                                        data-range-max="20000" data-range-selected-min="11000"
                                                        data-range-selected-max="17000"></div>
                                                </div>
                                            </div>
                                            <!-- Price range END -->

                                            <!-- More filter START -->
                                            <div class="mt-5">
                                                <!-- More search button link -->
                                                <a class="btn btn-link btn-more-fliter p-0" data-bs-toggle="collapse"
                                                    href="#collapseExample1" role="button" aria-expanded="false"
                                                    aria-controls="collapseExample1">
                                                    <i class="fas fa-plus me-2"></i>More filter
                                                </a>
                                                <div class="collapse" id="collapseExample1">
                                                    <div class="card card-body p-0 mt-4">
                                                        <!-- Amenities START -->
                                                        <h6 class="font-base">
                                                            <i class="fas fa-bars me-2"></i>Amenities
                                                        </h6>
                                                        <div class="row">
                                                            <!-- Amenities group -->
                                                            <div class="col-6">
                                                                <!-- Checkbox -->
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="" id="flexCheckDefault9" />
                                                                    <label class="form-check-label"
                                                                        for="flexCheckDefault9">
                                                                        Clinic
                                                                    </label>
                                                                </div>
                                                                <!-- Checkbox -->
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="" id="flexCheckDefault10" />
                                                                    <label class="form-check-label"
                                                                        for="flexCheckDefault10">
                                                                        Internet
                                                                    </label>
                                                                </div>
                                                                <!-- Checkbox -->
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="" id="flexCheckDefault11" />
                                                                    <label class="form-check-label"
                                                                        for="flexCheckDefault11">
                                                                        Park
                                                                    </label>
                                                                </div>
                                                                <!-- Checkbox -->
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="" id="flexCheckDefault12" />
                                                                    <label class="form-check-label"
                                                                        for="flexCheckDefault12">
                                                                        School
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <!-- Amenities group -->
                                                            <div class="col-6">
                                                                <!-- Checkbox -->
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="" id="flexCheckDefault13" />
                                                                    <label class="form-check-label"
                                                                        for="flexCheckDefault13">
                                                                        Supermarket
                                                                    </label>
                                                                </div>
                                                                <!-- Checkbox -->
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="" id="flexCheckDefault14" />
                                                                    <label class="form-check-label"
                                                                        for="flexCheckDefault14">
                                                                        Swiming pool
                                                                    </label>
                                                                </div>
                                                                <!-- Checkbox -->
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="" id="flexCheckDefault15" />
                                                                    <label class="form-check-label"
                                                                        for="flexCheckDefault15">
                                                                        Transportation hub
                                                                    </label>
                                                                </div>
                                                                <!-- Checkbox -->
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="" id="flexCheckDefault16" />
                                                                    <label class="form-check-label"
                                                                        for="flexCheckDefault16">
                                                                        Air Conditioning
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Row END -->
                                                        <!-- Amenities END -->

                                                        <!-- Measurement START -->
                                                        <h6 class="font-base mt-3">
                                                            <i class="fas fa-drafting-compass me-2"></i>Measurement unit
                                                        </h6>
                                                        <!-- Radio -->
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="flexRadioDefault" id="flexRadioDefault" />
                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                Square meters - m<sup>2</sup>
                                                            </label>
                                                        </div>
                                                        <!-- Radio -->
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="flexRadioDefault" id="flexRadioDefault10" />
                                                            <label class="form-check-label" for="flexRadioDefault10">
                                                                Square feet - ft<sup>2</sup>
                                                            </label>
                                                        </div>
                                                        <!-- Radio -->
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="flexRadioDefault" id="flexRadioDefault11" />
                                                            <label class="form-check-label" for="flexRadioDefault11">
                                                                Acres - ac
                                                            </label>
                                                        </div>
                                                        <!-- Radio -->
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="flexRadioDefault" id="flexRadioDefault12" />
                                                            <label class="form-check-label" for="flexRadioDefault12">
                                                                Aquare yards - yd<sup>2</sup>
                                                            </label>
                                                        </div>
                                                        <!-- Radio -->
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="flexRadioDefault" id="flexRadioDefault13" />
                                                            <label class="form-check-label" for="flexRadioDefault13">
                                                                Hectares area - ha
                                                            </label>
                                                        </div>
                                                        <!-- Measurement END -->
                                                        <!-- Property size START -->
                                                        <h6 class="font-base mt-4 mb-0">
                                                            <i class="fas fa-drafting-compass me-2"></i>Property size
                                                        </h6>
                                                        <div class="position-relative my-3">
                                                            <div class="noui-wrapper m-b-50 p-l-r">
                                                                <div class="d-flex justify-content-between">
                                                                    <input type="text"
                                                                        class="text-body input-with-range-min" />
                                                                    <input type="text"
                                                                        class="text-body input-with-range-max" />
                                                                </div>
                                                                <div class="noui-slider-range m-b-20 mt-2"
                                                                    data-range-min="2000" data-range-max="50000"
                                                                    data-range-selected-min="18000"
                                                                    data-range-selected-max="24000"></div>
                                                            </div>
                                                        </div>
                                                        <!-- Property size END -->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- buttton -->
                                            <div class="d-grid gap-2 mt-4">
                                                <a href="#" class="btn btn-primary">Apply filter</a>
                                            </div>
                                            <!-- More filter END -->
                                        </form>
                                        <!-- Form END -->
                                    </div>
                                </div>
                                <!-- Row END -->
                            </div>
                            <!-- Advance search END -->
                        </div>

                        <div class="col-12 col-sm-6 col-lg-12">
                            <!-- Latest view START -->
                            <div class="bg-white p-4 mt-4 shadow-lg rounded">
                                <!-- Title -->
                                <h4 class="mb-4">Latest property</h4>
                                <!-- Tiny slider START -->
                                <div class="tiny-slider arrow-round">
                                    <div class="tiny-slider-inner" data-autoplay="false" data-arrow="true"
                                        data-dots="false" data-items="1" data-items-xs="1">
                                        <!-- Property START -->
                                        <div class="card mb-4">
                                            <div class="position-relative overflow-hidden">
                                                <!-- Card img -->
                                                <img class="card-img" src="assets/images/property/grid-list/05.jpg"
                                                    alt="Card image" />
                                                <!-- Card img overlay -->
                                                <div class="card-img-overlay bg-dark-overlay-hover">
                                                    <!-- Card category -->
                                                    <div class="w-100 h-100 d-flex flex-column">
                                                        <div class="mb-auto">
                                                            <!-- Meta -->
                                                            <div class="d-flex justify-content-between">
                                                                <a href="#" class="badge bg-orange">Limited</a>
                                                                <div>
                                                                    <a href="#" class="badge bg-primary me-2"><i
                                                                            class="fas fa-user-friends pe-1"></i>Family</a>
                                                                    <a href="#" class="badge bg-danger"><i
                                                                            class="fas fa-rupee-sign pe-1"></i>Sale</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Title -->
                                                        <h4 class="card-title">
                                                            <a href="#" class="stretched-link text-light">157485
                                                                Camino Codorniz</a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Property END -->

                                        <!-- Property START -->
                                        <div class="card mb-4">
                                            <div class="position-relative overflow-hidden">
                                                <!-- Card img -->
                                                <img class="card-img" src="assets/images/property/grid-list/02.jpg"
                                                    alt="Card image" />
                                                <!-- Card img overlay -->
                                                <div class="card-img-overlay bg-dark-overlay-hover">
                                                    <!-- Card category -->
                                                    <div class="w-100 h-100 d-flex flex-column">
                                                        <div class="mb-auto">
                                                            <!-- Meta -->
                                                            <div class="d-flex justify-content-between">
                                                                <a href="#" class="badge bg-orange">Limited</a>
                                                                <div>
                                                                    <a href="#" class="badge bg-primary me-2"><i
                                                                            class="fas fa-user-friends pe-1"></i>Family</a>
                                                                    <a href="#" class="badge bg-danger"><i
                                                                            class="fas fa-rupee-sign pe-1"></i>Sale</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Title -->
                                                        <h4 class="card-title">
                                                            <a href="#" class="stretched-link text-light">157485
                                                                Camino Codorniz</a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Property END -->
                                    </div>
                                </div>
                                <!-- Tiny slider END -->
                            </div>
                            <!-- Latest view END -->

                            <!-- Recent view START -->
                            <div class="bg-white p-4 mt-4 shadow-lg rounded">
                                <h4 class="mb-3">Recent viewed</h4>
                                <!-- Card START -->
                                <div class="card mb-3">
                                    <div class="row g-3">
                                        <!-- Image -->
                                        <div class="col-4">
                                            <img class="rounded" src="assets/images/property/grid-list/11.jpg"
                                                alt="" />
                                        </div>
                                        <!-- Info -->
                                        <div class="col-8">
                                            <h6>
                                                <a href="#" class="stretched-link">Single House Near New York</a>
                                            </h6>
                                            <div class="text-success">$160,000</div>
                                            <ul class="list-inline">
                                                <li class="list-inline-item me-0 small">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item me-0 small">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item me-0 small">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item me-0 small">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item me-0 small">
                                                    <i class="fas fa-star-half-alt text-warning"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card END -->

                                <!-- Card START -->
                                <div class="card mb-3">
                                    <div class="row g-3">
                                        <!-- Image -->
                                        <div class="col-4">
                                            <img class="rounded" src="assets/images/property/grid-list/10.jpg"
                                                alt="" />
                                        </div>
                                        <!-- Info -->
                                        <div class="col-8">
                                            <h6>
                                                <a href="#" class="stretched-link">Single House Near New York</a>
                                            </h6>
                                            <div class="text-success">$160,000</div>
                                            <ul class="list-inline">
                                                <li class="list-inline-item me-0 small">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item me-0 small">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item me-0 small">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item me-0 small">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item me-0 small">
                                                    <i class="fas fa-star-half-alt text-warning"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card END -->

                                <!-- Card START -->
                                <div class="card mb-3">
                                    <div class="row g-3">
                                        <!-- Image -->
                                        <div class="col-4">
                                            <img class="rounded" src="assets/images/property/grid-list/01.jpg"
                                                alt="" />
                                        </div>
                                        <!-- Info -->
                                        <div class="col-8">
                                            <h6>
                                                <a href="#" class="stretched-link">Single House Near New York</a>
                                            </h6>
                                            <div class="text-success">$160,000</div>
                                            <ul class="list-inline">
                                                <li class="list-inline-item me-0 small">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item me-0 small">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item me-0 small">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item me-0 small">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item me-0 small">
                                                    <i class="fas fa-star-half-alt text-warning"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card END -->
                            </div>
                            <!-- Recent view END -->
                        </div>
                    </div>
                    <!-- Row End -->
                </div>
                <!-- Left sidebar END -->

                <!-- Main content START -->
                <div class="col-lg-8 order-1">
                    <!-- Navbar START -->
                    <nav id="navbar-example2" class="navbar navbar-dark bg-dark rounded-1">
                        <ul class="nav p-2">
                            <!-- Dropdown item -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Type
                                </a>
                                <ul class="dropdown-menu mt-2" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Rent</a></li>
                                    <li><a class="dropdown-item" href="#">Sale</a></li>
                                </ul>
                            </li>
                            <!-- Dropdown item -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Category
                                </a>
                                <ul class="dropdown-menu mt-2" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Apartment</a></li>
                                    <li><a class="dropdown-item" href="#">Land</a></li>
                                    <li><a class="dropdown-item" href="#">House</a></li>
                                    <li><a class="dropdown-item" href="#">Office</a></li>
                                    <li><a class="dropdown-item" href="#">Shop</a></li>
                                    <li><a class="dropdown-item" href="#">Villa</a></li>
                                </ul>
                            </li>
                            <!-- Dropdown item -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    City
                                </a>
                                <ul class="dropdown-menu mt-2" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">New york</a></li>
                                    <li><a class="dropdown-item" href="#">Los Angeles</a></li>
                                    <li><a class="dropdown-item" href="#">Pheoenix</a></li>
                                </ul>
                            </li>
                            <!-- Dropdown item -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Area
                                </a>
                                <ul class="dropdown-menu mt-2" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Queens</a></li>
                                    <li><a class="dropdown-item" href="#">Manhattan</a></li>
                                    <li><a class="dropdown-item" href="#">WestSide</a></li>
                                </ul>
                            </li>
                            <!-- Dropdown item -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown4" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Default Order
                                </a>
                                <ul class="dropdown-menu mt-2" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="#">Price - Low to High</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Price - High to Low</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Featured Listings First</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Date - Old to New</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Date - New to Old</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- Navbar END -->

                    <div class="row mt-5">
                        <!-- Property START -->
                        <div class="col-md-12">
                            <div class="card mb-5 card-img-scale">
                                <div class="row g-3">
                                    <div class="col-md-5 col-lg-12 col-xl-5">
                                        <div class="card overflow-hidden">
                                            <!-- Image -->
                                            <img class="card-img rounded-1" src="assets/images/property/grid-list/02.jpg"
                                                alt="Card image" />
                                            <!-- Image overlay -->
                                            <div class="card-img-overlay">
                                                <!-- Meta -->
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <a href="#" class="badge bg-orange">Limited</a>
                                                    <div>
                                                        <a href="#" class="badge bg-dark text-white me-2"><i
                                                                class="fas fa-video pe-2"></i><span>2</span></a>
                                                        <a href="#" class="badge bg-dark text-white"><i
                                                                class="fas fa-camera pe-2"></i><span>2</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card body START -->
                                    <div class="col-md-7 col-lg-12 col-xl-7">
                                        <div class="row">
                                            <!-- Detail -->
                                            <div class="col-md-7">
                                                <!-- Title -->
                                                <h4 class="card-title">
                                                    <a href="#">5620 morningstar Avenue</a>
                                                </h4>
                                                <p class="small mb-3 mb-md-2 text-primary-hover">
                                                    <a href="#"><i class="fas fa-map-marker-alt me-1"></i>Chicago HQ
                                                        Estica Cop. 8573 Livingston</a>
                                                </p>
                                                <!-- Meta -->
                                                <ul
                                                    class="nav nav-divider align-items-center text-uppercase small mb-2 mb-lg-3">
                                                    <li class="nav-item me-4 mb-1">
                                                        <i class="fas fa-bed pe-1"></i> <span>5</span>
                                                    </li>
                                                    <li class="nav-item me-4 mb-1">
                                                        <i class="fas fa-bath pe-1"></i> <span>3</span>
                                                    </li>
                                                    <li class="nav-item me-4 mb-1">
                                                        <i class="fas fa-user pe-1"></i> <span>6</span>
                                                    </li>
                                                    <li class="nav-item me-4 mb-1">
                                                        <i class="fas fa-square pe-1"></i>
                                                        <span>2900<sup class="text-lowercase">m2</sup></span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="d-sm-flex justify-content-sm-between">
                                                    <!-- Badge -->
                                                    <div class="mb-2 mb-sm-0">
                                                        <span class="badge bg-primary-soft text-primary"><i
                                                                class="fas fa-user-friends pe-1"></i>Family</span>
                                                        <span class="badge bg-warning-soft text-warning"><i
                                                                class="fas fa-rupee-sign pe-1"></i>For
                                                            rent</span>
                                                        <span class="badge bg-success-soft text-success"><i
                                                                class="fas fa-home pe-1"></i>Apartment</span>
                                                    </div>
                                                    <!-- Price -->
                                                    <div>
                                                        <div class="d-flex d-md-block align-items-center mb-2 mb-lg-0">
                                                            <h5 class="text-success mb-0 me-3 me-md-0">
                                                                $20,000
                                                            </h5>
                                                            <h6
                                                                class="text-decoration-line-through mb-0 me-3 me-md-0 text-muted">
                                                                $24,000
                                                            </h6>
                                                            <p class="badge bg-orange text-white mb-0">
                                                                15% off
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Avatar and button -->
                                            <div class="d-flex justify-content-between align-items-center">
                                                <!-- Avatar -->
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm me-2">
                                                        <img class="avatar-img rounded-circle"
                                                            src="assets/images/avatar/06.jpg" alt="avatar" />
                                                    </div>
                                                    <p class="mb-1">
                                                        <a href="#" class="text-reset btn-link">Jerry Reid</a>
                                                    </p>
                                                </div>
                                                <!-- Button -->
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="text-end me-3 mb-0 h5"><i
                                                            class="fas fa-fw fa-heart text-danger"></i></a>
                                                    <a href="#" class="btn btn-dark btn-sm">View details</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Row END -->
                                    </div>
                                    <!-- Card body END -->
                                </div>
                                <!-- Row END -->
                            </div>
                        </div>
                        <!-- Property END -->

                        <!-- Property START -->
                        <div class="col-md-12">
                            <div class="card mb-5 card-img-scale">
                                <div class="row g-3">
                                    <div class="col-md-5 col-lg-12 col-xl-5">
                                        <div class="card overflow-hidden">
                                            <!-- Image -->
                                            <img class="card-img rounded-1" src="assets/images/property/grid-list/09.jpg"
                                                alt="Card image" />
                                            <!-- Image overlay -->
                                            <div class="card-img-overlay">
                                                <div class="text-end">
                                                    <a href="#" class="badge bg-dark text-white me-2"><i
                                                            class="fas fa-video pe-2"></i><span>2</span></a>
                                                    <a href="#" class="badge bg-dark text-white"><i
                                                            class="fas fa-camera pe-2"></i><span>2</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card body START -->
                                    <div class="col-md-7 col-lg-12 col-xl-7">
                                        <div class="row">
                                            <!-- Detail -->
                                            <div class="col-md-7">
                                                <!-- Title -->
                                                <h4 class="card-title">
                                                    <a href="#">Store in Woodside, San Francisco</a>
                                                </h4>
                                                <p class="small mb-2 text-primary-hover">
                                                    <a href="#"><i class="fas fa-map-marker-alt me-1"></i>Chicago HQ
                                                        Estica Cop. 8573 Livingston</a>
                                                </p>
                                                <!-- Meta -->
                                                <ul
                                                    class="nav nav-divider align-items-center text-uppercase small mb-1 mb-lg-3">
                                                    <li class="nav-item me-4 mb-1">
                                                        <i class="fas fa-bed pe-1"></i> <span>5</span>
                                                    </li>
                                                    <li class="nav-item me-4 mb-1">
                                                        <i class="fas fa-bath pe-1"></i> <span>3</span>
                                                    </li>
                                                    <li class="nav-item me-4 mb-1">
                                                        <i class="fas fa-user pe-1"></i> <span>6</span>
                                                    </li>
                                                    <li class="nav-item me-4 mb-1">
                                                        <i class="fas fa-square pe-1"></i>
                                                        <span>2900<sup class="text-lowercase">m2</sup></span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="d-sm-flex justify-content-sm-between">
                                                    <!-- Badge -->
                                                    <div class="mb-2 mb-sm-0">
                                                        <span class="badge bg-primary-soft text-primary"><i
                                                                class="fas fa-user-friends pe-1"></i>Family</span>
                                                        <span class="badge bg-danger-soft text-danger"><i
                                                                class="fas fa-rupee-sign pe-1"></i>For
                                                            sale</span>
                                                        <span class="badge bg-success-soft text-success"><i
                                                                class="fas fa-home pe-1"></i>Villa</span>
                                                    </div>
                                                    <!-- Price -->
                                                    <div>
                                                        <div class="d-flex d-md-block align-items-center mb-2 mb-lg-0">
                                                            <h5 class="text-success mb-0 me-3 me-md-0">
                                                                $220,000
                                                            </h5>
                                                            <h6
                                                                class="text-decoration-line-through mb-0 me-3 me-md-0 text-muted">
                                                                $224,000
                                                            </h6>
                                                            <p class="badge bg-orange text-white mb-0">
                                                                20% off
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Avatar and button -->
                                            <div class="d-flex justify-content-between align-items-center">
                                                <!-- Avatar -->
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm me-2">
                                                        <img class="avatar-img rounded-circle"
                                                            src="assets/images/avatar/1.jpg" alt="avatar" />
                                                    </div>
                                                    <p class="mb-1">
                                                        <a href="#" class="text-reset btn-link">Bryan Knight</a>
                                                    </p>
                                                </div>
                                                <!-- Button -->
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="text-end me-3 mb-0 h5"><i
                                                            class="far fa-heart fa-fw text-dark"></i></a>
                                                    <a href="#" class="btn btn-dark btn-sm">View details</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Row END -->
                                    </div>
                                    <!-- Card body END -->
                                </div>
                                <!-- Row END -->
                            </div>
                        </div>
                        <!-- Property END -->

                        <!-- Property START -->
                        <div class="col-md-12">
                            <div class="card mb-5 card-img-scale">
                                <div class="row g-3">
                                    <div class="col-md-5 col-lg-12 col-xl-5">
                                        <div class="card overflow-hidden">
                                            <!-- Image -->
                                            <img class="card-img rounded-1" src="assets/images/property/grid-list/06.jpg"
                                                alt="Card image" />
                                            <!-- Image overlay -->
                                            <div class="card-img-overlay">
                                                <div class="text-end">
                                                    <a href="#" class="badge bg-dark text-white me-2"><i
                                                            class="fas fa-video pe-2"></i><span>2</span></a>
                                                    <a href="#" class="badge bg-dark text-white"><i
                                                            class="fas fa-camera pe-2"></i><span>2</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card body START -->
                                    <div class="col-md-7 col-lg-12 col-xl-7">
                                        <div class="row">
                                            <!-- Detail -->
                                            <div class="col-md-7">
                                                <!-- Title -->
                                                <h4 class="card-title">
                                                    <a href="#">157485 Camino Codorniz</a>
                                                </h4>
                                                <p class="small mb-2 text-primary-hover">
                                                    <a href="#"><i class="fas fa-map-marker-alt me-1"></i>Chicago HQ
                                                        Estica Cop. 8573 Livingston</a>
                                                </p>
                                                <!-- Meta -->
                                                <ul
                                                    class="nav nav-divider align-items-center text-uppercase small mb-1 mb-lg-3">
                                                    <li class="nav-item me-4 mb-1">
                                                        <i class="fas fa-bed pe-1"></i> <span>6</span>
                                                    </li>
                                                    <li class="nav-item me-4 mb-1">
                                                        <i class="fas fa-bath pe-1"></i> <span>4</span>
                                                    </li>
                                                    <li class="nav-item me-4 mb-1">
                                                        <i class="fas fa-user pe-1"></i> <span>6</span>
                                                    </li>
                                                    <li class="nav-item me-4 mb-1">
                                                        <i class="fas fa-square pe-1"></i>
                                                        <span>2900<sup class="text-lowercase">m2</sup></span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="d-sm-flex justify-content-sm-between">
                                                    <!-- Badge -->
                                                    <div class="mb-2 mb-sm-0">
                                                        <span class="badge bg-primary-soft text-primary"><i
                                                                class="fas fa-user-friends pe-1"></i>Family</span>
                                                        <span class="badge bg-warning-soft text-warning"><i
                                                                class="fas fa-rupee-sign pe-1"></i>For
                                                            rent</span>
                                                        <span class="badge bg-success-soft text-success"><i
                                                                class="fas fa-home pe-1"></i>shop</span>
                                                    </div>
                                                    <!-- Price -->
                                                    <div>
                                                        <h5 class="text-success mb-2">$80,000</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Avatar and button -->
                                            <div class="d-flex justify-content-between align-items-center">
                                                <!-- Avatar -->
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm me-2">
                                                        <img class="avatar-img rounded-circle"
                                                            src="assets/images/avatar/2.jpg" alt="avatar" />
                                                    </div>
                                                    <p class="mb-1">
                                                        <a href="#" class="text-reset btn-link">Judy Nguyen</a>
                                                    </p>
                                                </div>
                                                <!-- Button -->
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="text-end me-3 mb-0 h5"><i
                                                            class="far fa-heart fa-fw text-dark"></i></a>
                                                    <a href="#" class="btn btn-dark btn-sm">View details</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Row END -->
                                    </div>
                                    <!-- Card body END -->
                                </div>
                                <!-- Row END -->
                            </div>
                        </div>
                        <!-- Property END -->

                        <!-- Property START -->
                        <div class="col-md-12">
                            <div class="card mb-5 card-img-scale">
                                <div class="row g-3">
                                    <div class="col-md-5 col-lg-12 col-xl-5">
                                        <div class="card overflow-hidden">
                                            <!-- Image -->
                                            <img class="card-img rounded-1" src="assets/images/property/grid-list/03.jpg"
                                                alt="Card image" />
                                            <!-- Image overlay -->
                                            <div class="card-img-overlay">
                                                <!-- Meta -->
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <a href="#" class="badge bg-orange">Limited</a>
                                                    <div>
                                                        <a href="#" class="badge bg-dark text-white me-2"><i
                                                                class="fas fa-video pe-2"></i><span>2</span></a>
                                                        <a href="#" class="badge bg-dark text-white"><i
                                                                class="fas fa-camera pe-2"></i><span>5</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card body START -->
                                    <div class="col-md-7 col-lg-12 col-xl-7">
                                        <div class="row">
                                            <!-- Detail -->
                                            <div class="col-md-7">
                                                <!-- Title -->
                                                <h4 class="card-title">
                                                    <a href="#">Single House Near New York</a>
                                                </h4>
                                                <p class="small mb-2 text-primary-hover">
                                                    <a href="#"><i class="fas fa-map-marker-alt me-1"></i>Chicago HQ
                                                        Estica Cop. 8573 Livingston</a>
                                                </p>
                                                <!-- Meta -->
                                                <ul
                                                    class="nav nav-divider align-items-center text-uppercase small mb-1 mb-lg-3">
                                                    <li class="nav-item me-4 mb-1">
                                                        <i class="fas fa-bed pe-1"></i> <span>5</span>
                                                    </li>
                                                    <li class="nav-item me-4 mb-1">
                                                        <i class="fas fa-bath pe-1"></i> <span>3</span>
                                                    </li>
                                                    <li class="nav-item me-4 mb-1">
                                                        <i class="fas fa-user pe-1"></i> <span>6</span>
                                                    </li>
                                                    <li class="nav-item me-4 mb-1">
                                                        <i class="fas fa-square pe-1"></i>
                                                        <span>2900<sup class="text-lowercase">m2</sup></span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="d-sm-flex justify-content-sm-between">
                                                    <!-- Badge -->
                                                    <div class="mb-2 mb-sm-0">
                                                        <span class="badge bg-primary-soft text-primary"><i
                                                                class="fas fa-user-friends pe-1"></i>Family</span>
                                                        <span class="badge bg-warning-soft text-warning"><i
                                                                class="fas fa-rupee-sign pe-1"></i>For
                                                            sale</span>
                                                        <span class="badge bg-success-soft text-success"><i
                                                                class="fas fa-home pe-1"></i>home</span>
                                                    </div>
                                                    <!-- Price -->
                                                    <div>
                                                        <div class="d-flex d-md-block align-items-center mb-2 mb-lg-0">
                                                            <h5 class="text-success mb-0 me-3 me-md-0">
                                                                $100,000
                                                            </h5>
                                                            <h6
                                                                class="text-decoration-line-through mb-0 me-3 me-md-0 text-muted">
                                                                $12,000
                                                            </h6>
                                                            <p class="badge bg-orange text-white mb-0">
                                                                20% off
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Avatar and button -->
                                            <div class="d-flex justify-content-between align-items-center">
                                                <!-- Avatar -->
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm me-2">
                                                        <img class="avatar-img rounded-circle"
                                                            src="assets/images/avatar/06.jpg" alt="avatar" />
                                                    </div>
                                                    <p class="mb-1">
                                                        <a href="#" class="text-reset btn-link">Jerry Reid</a>
                                                    </p>
                                                </div>
                                                <!-- Button -->
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="text-end me-3 mb-0 h5"><i
                                                            class="fas fa-fw fa-heart text-danger"></i></a>
                                                    <a href="#" class="btn btn-dark btn-sm">View details</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Row END -->
                                    </div>
                                    <!-- Card body END -->
                                </div>
                                <!-- Row END -->
                            </div>
                        </div>
                        <!-- Property END -->
                    </div>
                    <!-- Row END -->

                    <!-- Pagination START -->
                    <div class="col-12">
                        <nav class="mt-4 d-flex justify-content-center" aria-label="navigation">
                            <ul class="pagination pagination-bordered rounded">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1"><i
                                            class="fas fa-chevron-left"></i></a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item disabled">
                                    <a class="page-link" href="#">..</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">15</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Pagination END -->
                </div>
                <!-- Main content END -->
            </div>
            <!-- Row END -->
        </div>
    </section>
    <!-- =======================
    Inner part END -->
@endsection
