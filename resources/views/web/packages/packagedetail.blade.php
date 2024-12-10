@extends('layouts.app')
@section('content')
    <div class="main">
        <!-- Package-Single -->
        <section class="package-single">
            <div class="container">
                <div class="package-single-inner">

                    <div class="package-single-bottom">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="package-single-left">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="package-single-left-img">
                                                <figure>
                                                    {{-- @php dd($packages->images[0]->images);@endphp --}}
                                                    @if ($packages->images[0] && count($packages->images) > 0)
                                                        <img
                                                            src="{{ asset('storage') . '/' . $packages->images[0]->images }}" />
                                                    @endif
                                                </figure>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mt-md-0 mt-4">
                                            <div class="package-single-left-img">
                                                @if (isset($packages->images[1]))
                                                    <figure>
                                                        <img
                                                            src="{{ asset('storage') . '/' . $packages->images[1]->images }}" />
                                                    </figure>
                                                @endif
                                                {{-- <img src="{{asset('web/assets/images/pool-two.png')}}" /> --}}
                                                <div class="tree-img">
                                                    @if (isset($packages->images[2]))
                                                        <figure>
                                                            <img
                                                                src="{{ asset('storage') . '/' . $packages->images[2]->images }}">
                                                            {{-- <img src="images/pool-three.png" /> --}}
                                                        </figure>
                                                    @endif
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal2">
                                                        <figcaption>{{ $packages->images->count() ?? '' }} photos <i
                                                                class="fa-solid fa-circle-arrow-right"></i></figcaption>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- tab-section -->

                                    <div class="itinerary-inner">
                                        <p>{!! $packages->description !!}</p>
                                        {{-- <p>On the western coast, Goa is known for its endless beaches, stellar nightlife,
                                            eclectic seafood, world-heritage listed architecture. Spread across just
                                            Experience a comfortable stay in our Classic Hotels, carefully chosen for their
                                            value, convenient locations, and proximity to major attractions. Relax in
                                            well-maintained rooms with thoughtful amenities, savor a variety of breakfast
                                            choices, and benefit from attentive service to enhance your travel experience.
                                        </p> --}}
                                        {{-- <p>• 7 nights in Ponta Delgada at the Sao Miguel Park 4* hotel (or similar) in a
                                            standard room</p> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="package-single-right">
                                    <div class="package-single-right-head">
                                        <h2>{{ $packages->name }}</h2>
                                        {{-- <h2>Paris & Normandy Cruise</h2> --}}
                                        <div class="guest">
                                            <img src="{{ asset('web/assets/images/timer.svg') }}" /><span>{{ $packages->days }}
                                                Days</span>
                                            {{-- <img src="images/timer.svg" /><span>11 Days</span> --}}
                                        </div>
                                    </div>
                                    <div class="package-single-right-middle">

                                        <div class="texes">
                                            @php
                                                $currency = $packages->destination->country->currency_symbol;
                                            @endphp
                                            <h4>{{ $currency }} {{ $packages->price }}</h4>
                                            <p><span>+</span>{{ floor($packages->tax_rate) ?? '' }} taxes & fees</p>
                                            <p><span>1 Room</span> per night</p>
                                            <p class="free">Free Cancellation till 22- May-2024</p>
                                        </div>
                                    </div>
                                    <a class="travel-btn" href="javascript::" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">Send Enquiry</a>
                                </div>



                                <div class="Package-Includes-main">
                                    <h2>Package Includes</h2>
                                    <ul>
                                        <li> <img src="images/tick-circle.svg" /> INTERNATIONAL FLIGHTS</li>
                                        <li> <img src="images/tick-circle.svg" /> WELCOME & TRANSFERS</li>
                                        <li> <img src="images/tick-circle.svg" /> HOTEL 4*</li>
                                        <li> <img src="images/tick-circle.svg" /> ALL BREAKFASTS + 1 LUNCH</li>
                                        <li> <img src="images/tick-circle.svg" /> EXCURSIONS</li>
                                    </ul>

                                    <div class="coupon-main">
                                        <div class="coupon-left">
                                            <div class="coupon-top">
                                                <span>PROMO: $100 off</span>
                                                <span>$2098.00</span>
                                            </div>
                                            <h3>CAD$ <span>1,998*</span></h3>
                                            <p>STARTING AT PER PERSON/TAXES INCL</p>
                                        </div>
                                        <div class="coupon-right">
                                            <span>OFF</span>
                                            <span>20%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="tab-result-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tab-content" id="pills-tabContent">

                            <div class="package-details-tabs">

                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-dateprice-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-dateprice" type="button" role="tab"
                                            aria-controls="pills-dateprice" aria-selected="true">Dates & Prices</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-Itinerary-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-Itinerary" type="button" role="tab"
                                            aria-controls="pills-Itinerary" aria-selected="false">Itinerary</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-Accommodation-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-Accommodation" type="button" role="tab"
                                            aria-controls="pills-Accommodation" aria-selected="false">Accommodation</button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link " id="pills-Inclusions-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-Inclusions" type="button" role="tab"
                                            aria-controls="pills-Inclusions"
                                            aria-selected="true">Inclusions/Exclusions</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-Map-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-Map" type="button" role="tab"
                                            aria-controls="pills-Map" aria-selected="false">Map</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-FAQ-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-FAQ" type="button" role="tab"
                                            aria-controls="pills-FAQ" aria-selected="false">FAQ</button>
                                    </li>
                                </ul>

                            </div>
                            <div class="tab-pane fade show active" id="pills-dateprice" role="tabpanel"
                                aria-labelledby="pills-dateprice-tab" tabindex="0">
                                <div class="heading-main">
                                    <h2>Dates & Prices</h2>
                                </div>

                                <div class="package-details-filters">
                                    <form action="" class="row">

                                        <div class="col-lg-7">

                                            <div class="Destination-form">



                                                <div class="Destination-form-data">
                                                    <label class="form-label">Departure City :</label>
                                                    <select class="form-select" id="mySelect"
                                                        aria-label="Default select example">
                                                        <option value="1" selected>Los Angeles</option>
                                                        <option value="2">6-9 Days</option>
                                                        <option value="3">10-15 Days</option>
                                                        <option value="4">16-21 Days</option>
                                                    </select>
                                                </div>



                                                <div class="Destination-form-data">
                                                    <label class="form-label">Month:</label>
                                                    <select class="form-select" id="mySelectDeparture"
                                                        aria-label="Default select example">
                                                        <option selected>All Months</option>
                                                        <option value="1">Nov 2024</option>
                                                        <option value="2">Dec 2024</option>
                                                        <option value="3">Jan 2025</option>
                                                        <option value="4">Feb 2025</option>
                                                        <option value="5">Mar 2025</option>
                                                        <option value="6">Apr 2025</option>
                                                        <option value="7">May 2025</option>
                                                    </select>


                                                </div>

                                                <div class="Destination-form-data">
                                                    <label class="form-label">Accommodation Category :</label>
                                                    <select class="form-select" id="mySelectLength"
                                                        aria-label="Default select example">
                                                        <option selected>Main Deck</option>
                                                        <option value="1">6-9 Days</option>
                                                        <option value="2">10-15 Days</option>
                                                        <option value="3">16-21 Days</option>
                                                        <option value="4">22+ Days</option>
                                                    </select>


                                                </div>


                                            </div>

                                        </div>

                                    </form>
                                </div>



                                <div class="ticket-details-main">
                                    <div class="ticket-date-name">
                                        <h3>April 2025</h3>
                                        <span>Ms. Renoir - Premium ship</span>
                                    </div>

                                    <div class="ticket-details-bottom-main">
                                        <div class="ticket-details-bottom-inner">
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="./images/airplane.svg">Departure Date</span>
                                                <h4>Fri Apr 11</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="./images/aroplan-bt.svg">Departure Date</span>
                                                <h4>Fri Apr 11</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="./images/starting-price.svg">Departure Date</span>
                                                <div class="price-details-data">
                                                    <span>$3698</span>
                                                    <h4>$3,598<span>/person</span></h4>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="ticket-details-right-data">
                                            <div class="offers-data">
                                                <span>100$ off</span>
                                            </div>
                                            <div class="enquiry-btn">
                                                <a class="travel-btn btn" href="javascript::" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">Send Enquiry</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ticket-details-bottom-main">
                                        <div class="ticket-details-bottom-inner">
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="./images/airplane.svg">Departure Date</span>
                                                <h4>Sat Apr 13</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="./images/aroplan-bt.svg">Departure Date</span>
                                                <h4>Mon Apr 28</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="./images/starting-price.svg">Departure Date</span>
                                                <div class="price-details-data">
                                                    <span>$3698</span>
                                                    <h4>$3,598<span>/person</span></h4>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="ticket-details-right-data">
                                            <div class="offers-data">
                                                <span>100$ off</span>
                                            </div>
                                            <div class="enquiry-btn">
                                                <a class="travel-btn btn" href="javascript::" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">Send Enquiry</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ticket-details-bottom-main">
                                        <div class="ticket-details-bottom-inner">
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="./images/airplane.svg">Departure Date</span>
                                                <h4>Fri Apr 11</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="./images/aroplan-bt.svg">Departure Date</span>
                                                <h4>Fri Apr 11</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="./images/starting-price.svg">Departure Date</span>
                                                <div class="price-details-data">
                                                    <span>$3698</span>
                                                    <h4>$3,598<span>/person</span></h4>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="ticket-details-right-data">
                                            <div class="offers-data">
                                                <span>100$ off</span>
                                            </div>
                                            <div class="enquiry-btn">
                                                <a class="travel-btn btn" href="javascript::" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">Send Enquiry</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="ticket-details-main">
                                    <div class="ticket-date-name">
                                        <h3>July 2025</h3>
                                        <span>MS Seine Princess - Standard ship</span>
                                    </div>

                                    <div class="ticket-details-bottom-main">
                                        <div class="ticket-details-bottom-inner">
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="./images/airplane.svg">Departure Date</span>
                                                <h4>Fri Apr 11</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="./images/aroplan-bt.svg">Departure Date</span>
                                                <h4>Fri Apr 11</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="./images/starting-price.svg">Departure Date</span>
                                                <div class="price-details-data">
                                                    <span>$3698</span>
                                                    <h4>$3,598<span>/person</span></h4>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="ticket-details-right-data">
                                            <div class="offers-data">
                                                <span>100$ off</span>
                                            </div>
                                            <div class="enquiry-btn">
                                                <a class="travel-btn btn" href="javascript::" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">Send Enquiry</a>
                                            </div>
                                        </div>
                                    </div>


                                </div>



                                <div class="ticket-details-main">
                                    <div class="ticket-date-name">
                                        <h3>September 2025</h3>
                                        <span>MS Botticelli - Standard ship</span>
                                    </div>

                                    <div class="ticket-details-bottom-main">
                                        <div class="ticket-details-bottom-inner">
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="./images/airplane.svg">Departure Date</span>
                                                <h4>Fri Apr 11</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="./images/aroplan-bt.svg">Departure Date</span>
                                                <h4>Fri Apr 11</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="./images/starting-price.svg">Departure Date</span>
                                                <div class="price-details-data">
                                                    <span>$3698</span>
                                                    <h4>$3,598<span>/person</span></h4>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="ticket-details-right-data">
                                            <div class="offers-data">
                                                <span>100$ off</span>
                                            </div>
                                            <div class="enquiry-btn">
                                                <a class="travel-btn btn" href="javascript::" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">Send Enquiry</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ticket-details-bottom-main">
                                        <div class="ticket-details-bottom-inner">
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="./images/airplane.svg">Departure Date</span>
                                                <h4>Sat Apr 13</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="./images/aroplan-bt.svg">Departure Date</span>
                                                <h4>Mon Apr 28</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="./images/starting-price.svg">Departure Date</span>
                                                <div class="price-details-data">
                                                    <span>$3698</span>
                                                    <h4>$3,598<span>/person</span></h4>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="ticket-details-right-data">
                                            <div class="offers-data">
                                                <span>100$ off</span>
                                            </div>
                                            <div class="enquiry-btn">
                                                <a class="travel-btn btn" href="javascript::" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">Send Enquiry</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>



                                <div class="ticket-details-main">
                                    <div class="ticket-date-name">
                                        <h3>October 2025</h3>
                                        <span>MS Botticelli - Standard ship</span>
                                    </div>

                                    <div class="ticket-details-bottom-main">
                                        <div class="ticket-details-bottom-inner">
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="./images/airplane.svg">Departure Date</span>
                                                <h4>Fri Apr 11</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="./images/aroplan-bt.svg">Departure Date</span>
                                                <h4>Fri Apr 11</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="./images/starting-price.svg">Departure Date</span>
                                                <div class="price-details-data">
                                                    <span>$3698</span>
                                                    <h4>$3,598<span>/person</span></h4>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="ticket-details-right-data">
                                            <div class="offers-data">
                                                <span>100$ off</span>
                                            </div>
                                            <div class="enquiry-btn">
                                                <a class="travel-btn btn" href="javascript::" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">Send Enquiry</a>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="bottom-para">
                                    <p>*The advertised starting rate is available from Toronto on Jan 2025</p>
                                    <p>**All prices are subject to change without notice</p>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="pills-Itinerary" role="tabpanel"
                                aria-labelledby="pills-Itinerary-tab" tabindex="0">
                                <div class="heading-main">
                                    <div class="heading-inner">
                                        <h2>{{ $data['itinerary']->name ?? '' }}</h2>
                                        <p>{{ $packages->days }} Days</p>
                                    </div>
                                    <div class="heading-main-right">
                                        <div class="download-data">
                                            <a href="{{ route('download.pdf', $packages->id) }}"><img
                                                    src="{{ asset('web/assets/images/download.svg') }}"></a>
                                            <span>Package Details</span>
                                        </div>
                                        <a class="travel-btn btn" onclick="dates();">See Dates and Prices</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="itinerary-inner">
                                            {!! $data['itinerary']->description ?? '' !!}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="pills-Accommodation" role="tabpanel"
                                aria-labelledby="pills-Accommodation-tab" tabindex="0">
                                <div class="heading-main">
                                    <div class="heading-inner">
                                        <h2>{{ $data['itinerary']->name ?? '' }}</h2>
                                    </div>
                                    <div class="heading-main-right">
                                        <a class="travel-btn btn" onclick="dates();">See Dates and Prices</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="itinerary-inner">
                                            {!! $packages->accommodation !!}
                                            {{-- <p>Experience a comfortable stay in our Classic Hotels, carefully chosen for
                                                their value, convenient locations, and proximity to major attractions. Relax
                                                in well-maintained rooms with thoughtful amenities, savor a variety of
                                                breakfast choices, and benefit from attentive service to enhance your travel
                                                experience.</p>
                                            <p>• 7 nights in Ponta Delgada at the Sao Miguel Park 4* hotel (or similar) in a
                                                standard room</p> --}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="accommodation-images">
                                                <figure>
                                                    @if ($packages->images[0] && count($packages->images) > 0)
                                                        <img
                                                            src="{{ asset('storage') . '/' . $packages->images[0]->images }}" />
                                                    @endif
                                                    {{-- <img src="images/Accommodation1.jpg"> --}}
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="accommodation-images">
                                                @if (isset($packages->images[1]))
                                                    <figure>
                                                        @if ($packages->images[1] && count($packages->images) > 0)
                                                            <img
                                                                src="{{ asset('storage') . '/' . $packages->images[1]->images }}" />
                                                        @endif

                                                        {{-- <img src="images/Accommodation2.jpg"> --}}
                                                    </figure>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="accommodation-images">
                                                @if (isset($packages->images[2]))
                                                    <figure>
                                                        @if ($packages->images[2] && count($packages->images) > 0)
                                                            <img
                                                                src="{{ asset('storage') . '/' . $packages->images[2]->images }}" />
                                                        @endif
                                                        {{-- <img src="images/Accommodation3.jpg"> --}}
                                                    </figure>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="tree-img accommodation-images">
                                                @if (isset($packages->images[3]))
                                                    <figure>
                                                        @if ($packages->images[3] && count($packages->images) > 0)
                                                            <img
                                                                src="{{ asset('storage') . '/' . $packages->images[3]->images }}" />
                                                        @endif
                                                        {{-- <img src="images/Accommodation4.jpg"> --}}
                                                    </figure>
                                                @endif
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                                    <figcaption>+{{ $packages->images->count() ?? '' }} photos <i
                                                            class="fa-solid fa-circle-arrow-right"></i>
                                                    </figcaption>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="tab-pane fade" id="pills-Inclusions" role="tabpanel"
                                aria-labelledby="pills-Inclusions-tab" tabindex="0">
                                <div class="heading-main">
                                    <div class="heading-inner">
                                        <h2>INCLUDES</h2>

                                    </div>
                                    <div class="heading-main-right">
                                        <a class="travel-btn btn" onclick="dates();">See Dates and Prices</a>
                                    </div>
                                </div>

                                <div class="inclusions-data">

                                    <ul>
                                        <li>
                                            {{-- <img src="{{asset('web/assets/images/tick-circle.svg')}}"> --}}
                                            {!! $data['inclusion']->description ?? '' !!}
                                        </li>
                                        {{-- <li> <img src="images/tick-circle.svg">Round-trip international flights between
                                            Canada / Ponta Delgada with a good itinerary</li>
                                        <li> <img src="images/tick-circle.svg"> Welcome and transfers between the airports
                                            and the hotel in Ponta Delgada</li>
                                        <li> <img src="images/tick-circle.svg"> 7 nights hotel accommodations</li>
                                        <li> <img src="images/tick-circle.svg"> All breakfasts + 1 lunch</li>
                                        <li> <img src="images/tick-circle.svg"> Multilingual English-speaking guide during
                                            the tours</li>
                                        <li> <img src="images/tick-circle.svg"> Three-hours whale watching boat tour</li>
                                        <li> <img src="images/tick-circle.svg"> All taxes, fees, and OPC</li> --}}
                                    </ul>

                                    <h2>EXCLUDES</h2>
                                    <ul>
                                        <li>
                                            {{-- <img src="images/tick-circle.svg">  --}}
                                            {!! $data['exclusion']->description ?? '' !!}</li>
                                        {{-- <li> <img src="images/tick-circle.svg"> Fees for checked baggage</li>
                                        <li> <img src="images/tick-circle.svg"> Tips: Guides, bus drivers and hotel staff
                                        </li>
                                        <li> <img src="images/tick-circle.svg"> Meals and beverages unless otherwise
                                            mentioned</li>
                                        <li> <img src="images/tick-circle.svg"> Personal expenses and optional activities
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-Map" role="tabpanel" aria-labelledby="pills-Map-tab"
                                tabindex="0">
                                <div class="map-image">
                                    <img src="./images/map-image.jpg">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-FAQ" role="tabpanel" aria-labelledby="pills-FAQ-tab"
                                tabindex="0">
                                <div class="heading-main">
                                    <h2>Frequently Asked Questions</h2>
                                </div>


                                <div class="faq-data">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    How much of a deposit is required?
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    Lorem Ipsum has been the industry's standard dummy text ever since the
                                                    1500s, when an unknown printer took a galley of type and scrambled it to
                                                    make a type specimen book. It has survived not only five centuries, but
                                                    also the leap into electronic typesetting, remaining essentially
                                                    unchanged. </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    When is the balance due?
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    Lorem Ipsum has been the industry's standard dummy text ever since the
                                                    1500s, when an unknown printer took a galley of type and scrambled it to
                                                    make a type specimen book. It has survived not only five centuries, but
                                                    also the leap into electronic typesetting, remaining essentially
                                                    unchanged. </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    What is the group size?
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    Lorem Ipsum has been the industry's standard dummy text ever since the
                                                    1500s, when an unknown printer took a galley of type and scrambled it to
                                                    make a type specimen book. It has survived not only five centuries, but
                                                    also the leap into electronic typesetting, remaining essentially
                                                    unchanged. </div>
                                            </div>
                                        </div>


                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapsefour"
                                                    aria-expanded="false" aria-controls="collapsefour">
                                                    Is it a guaranteed departure?
                                                </button>
                                            </h2>
                                            <div id="collapsefour" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    Lorem Ipsum has been the industry's standard dummy text ever since the
                                                    1500s, when an unknown printer took a galley of type and scrambled it to
                                                    make a type specimen book. It has survived not only five centuries, but
                                                    also the leap into electronic typesetting, remaining essentially
                                                    unchanged. </div>
                                            </div>
                                        </div>


                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapsefive"
                                                    aria-expanded="false" aria-controls="collapsefive">
                                                    Is triple occupancy available?
                                                </button>
                                            </h2>
                                            <div id="collapsefive" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    Lorem Ipsum has been the industry's standard dummy text ever since the
                                                    1500s, when an unknown printer took a galley of type and scrambled it to
                                                    make a type specimen book. It has survived not only five centuries, but
                                                    also the leap into electronic typesetting, remaining essentially
                                                    unchanged. </div>
                                            </div>
                                        </div>


                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapsesix"
                                                    aria-expanded="false" aria-controls="collapsesix">
                                                    Is single occupancy available ?
                                                </button>
                                            </h2>
                                            <div id="collapsesix" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    Lorem Ipsum has been the industry's standard dummy text ever since the
                                                    1500s, when an unknown printer took a galley of type and scrambled it to
                                                    make a type specimen book. It has survived not only five centuries, but
                                                    also the leap into electronic typesetting, remaining essentially
                                                    unchanged. </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="guests-data-section">
            <div class="container">

                <div class="guests">
                    <h2>See what guests loved the most:</h2>
                    <div class="guests-inner">
                        <div class="owl-carousel owl-theme guests-slider">
                            @foreach ($data['review'] as $review)
                                <div class="item">
                                    <div class="guests-wapper">
                                        <div class="guests-wapper-head">
                                            <figure>
                                                @if ($review->images)
                                                    <img src="{{ asset('storage') . '/' . $review->images }}">
                                                @else
                                                    <img src="images/experience-one.png">
                                                @endif
                                            </figure>
                                            <h2>{{ $review->name }}</h2>
                                        </div>
                                        <p>{!! $review->description !!}</p>
                                        {{-- <p>I went for my honeymoon with Travel Agency. I discussed about my destination with
                                        akash and he shared an amazing itinerary which covered all the places of Goa which
                                        were a must visit during month of december. </p> --}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="hotels-section">
            <div class="container">
                <div class="hotels-inner">
                    <h2>Featured Packages</h2>

                    <div class="hotels-bottom">
                        <div class="row">
                            @foreach ($data['packages'] as $package)
                                <div class="col-sm-6 col-md-4">
                                    <div class="hotels-wapper">
                                        <figure>
                                            <img src="{{ asset('storage') . '/' . $package->thumbnail }}">
                                        </figure>
                                        <div class="hotels-content">
                                            <a href="{{ route('web.packageDetails', $package->id) }}">
                                                <h3>{{ $package->name }}</h3>
                                            </a>
                                            <p>{{ $package->sub_title ?? 'Per night before taxes and fees' }}</p>
                                            @php $currency =  $package->destination->country->currency_symbol @endphp
                                            <span class="inr">{{ $currency }} {{ $package->price }}</span>
                                            {{-- <span class="inr">$ 4,403.29</span> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{-- <div class="col-sm-6 col-md-4">
                                <div class="hotels-wapper">
                                    <figure>
                                        <img src="images/hotel-two.png">
                                    </figure>
                                    <div class="hotels-content">
                                        <a href="package-single.php">
                                            <h3>Highlights of Norway</h3>
                                        </a>
                                        <p>Per night before taxes and fees</p>
                                        <span class="inr">$ 1,937.53</span>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- <div class="col-sm-6 col-md-4">
                                <div class="hotels-wapper">
                                    <figure>
                                        <img src="images/hotel-three.png">
                                    </figure>
                                    <div class="hotels-content">
                                        <a href="package-single.php">
                                            <h3>Japan Great discovery</h3>
                                        </a>
                                        <p>Per night before taxes and fees</p>
                                        <span class="inr">$ 1,417.86</span>
                                    </div>
                                </div>
                            </div> --}}



                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!--Modal form -->
    @include('web.packages.modal.requestenquiry')
    @include('web.packages.modal.photoslider')

    <script>
        function dates() {
            $('#pills-dateprice-tab').click();
        }
    </script>
@endsection
