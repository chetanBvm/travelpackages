@extends('layouts.app')
@section('content')
    <div class="main">

        <section class="travel-banner">
            <div class="container">
                <div class="bannr-inner">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="banner-left text-center">
                                <span class="explore">Explore the world! <i class="fa-solid fa-compass"></i></span>
                                <h1>From Southeast Asia to<br> the <span class="world">World.</span> </h1>
                            </div>
                        </div>
                    </div>
                    <div class="Destination-form">
                        <div class="row justify-content-between">
                            <div class="col-12">
                                <form class="Destination-form-main">
                                    <div class="Destination-form-data">
                                        <label for="mySelect" class="form-label">
                                            <div class="form-label-img"><img
                                                    src="{{ asset('web/assets/images/location.svg') }}"></div> Destination
                                        </label>
                                        <select class="form-select" id="mySelect" aria-label="Default select example">
                                            @foreach($data['country'] as $countries)
                                            <option value="{{$countries->id}}">{{$countries->name}}</option>
                                            @endforeach
                                            {{-- <option value="1"> All destinations</option>
                                            <option selected>Central America</option>
                                            <option value="2">Africa / Middle East</option>
                                            <option value="3">Asia</option> --}}
                                        </select>
                                    </div>



                                    <div class="Destination-form-data">
                                        <label for="mySelectDeparture" class="form-label">
                                            <div class="form-label-img"><img
                                                    src="{{ asset('web/assets/images/calendar.svg') }}"
                                                    class="form-label-img"></div> Departure Month
                                        </label>
                                        <select class="form-select" id="mySelectDeparture"
                                            aria-label="Default select example">
                                            <option>All</option>
                                            <option value="1" selected>Nov 2024</option>
                                            <option value="2">Dec 2024</option>
                                            <option value="3">Jan 2025</option>
                                            <option value="4">Feb 2025</option>
                                            <option value="5">Mar 2025</option>
                                            <option value="6">Apr 2025</option>
                                            <option value="7">May 2025</option>
                                        </select>


                                    </div>

                                    <div class="Destination-form-data">
                                        <label for="mySelectLength" class="form-label">
                                            <div class="form-label-img"><img
                                                    src="{{ asset('web/assets/images/timer.svg') }}" class="form-label-img">
                                            </div> Length
                                        </label>
                                        <select class="form-select" id="mySelectLength" aria-label="Default select example">
                                            <option>All</option>
                                            <option value="1" selected>6-9 Days</option>
                                            <option value="2">10-15 Days</option>
                                            <option value="3">16-21 Days</option>
                                            <option value="4">22+ Days</option>
                                        </select>


                                    </div>

                                    <div class="Destination-form-data">
                                        <label for="mySelectPackage" class="form-label">
                                            <div class="form-label-img"><img src="{{ asset('web/assets/images/map.svg') }}"
                                                    class="form-label-img"></div> Package Type
                                        </label>
                                        <select class="form-select" id="mySelectPackage"
                                            aria-label="Default select example">
                                            <option>All Packages</option>
                                            <option value="1" selected>Tour Packages</option>
                                            <option value="2">Ocean Cruise Packages</option>
                                            <option value="3">River Cruise Packages</option>
                                        </select>
                                    </div>

                                    <div class="btn-wrapper">
                                        <button class="select-form-btn">Find your trip</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tranding -->
        <section class="tranding">
            <div class="container">
                <div class="tranding-inner">
                    <div class="tranding-head">
                        <h2 class="main-heading">Trending Destinations</h2>
                        <p class="content">Most popular choices for travellers from India</p>
                    </div>
                    <div class="tranding-bottom">
                        <div class="row">
                            @foreach ($data['destination'] as $destinations)
                                <div class="col-sm-6 col-md-6">
                                    <div class="tranding-content">
                                        <figure class="city">
                                            <img src="{{ asset('storage/').'/'.$destinations->image }}">
                                        </figure>
                                        <div class="flag-city">{{ $destinations->country->name }}
                                            {{ $destinations->country->emoji }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- <div class="col-sm-6 col-md-6">
                                <div class="tranding-content">
                                    <figure class="city">
                                        <img src="{{ asset('web/assets/images/trand-two.png') }}">
                                    </figure>
                                    <div class="flag-city">Japan<img src="{{ asset('web/assets/images/flag-2.png') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="tranding-content">
                                    <figure class="city">
                                        <img src="{{ asset('web/assets/images/trand-three.png') }}">
                                    </figure>
                                    <div class="flag-city">Greece<img src="{{ asset('web/assets/images/flag-3.png') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="tranding-content">
                                    <figure class="city">
                                        <img src="{{ asset('web/assets/images/trand-four.png') }}">
                                    </figure>
                                    <div class="flag-city">Mumbai<img src="{{ asset('web/assets/images/flag.png') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="tranding-content">
                                    <figure class="city">
                                        <img src="{{ asset('web/assets/images/trand-five.png') }}">
                                    </figure>
                                    <div class="flag-city">Italy<img src="{{ asset('web/assets/images/flag-5.png') }}">
                                    </div>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                    <figure class="arrow-shape-second">
                        <img src="{{ asset('web/assets/images/arrow-shape-two.png') }}">
                    </figure>
                </div>
                <figure class="arrow-shape">
                    <img src="{{ asset('web/assets/images/arrow-shape.png') }}">
                </figure>

            </div>
        </section>
        <!-- Discover -->
        <section class="discover">
            <div class="container">
                <div class="discover-inner">
                    <div class="discover-head">
                        <h2 class="main-heading">Discover your New Favourite Stay</h2>
                    </div>
                    <div class="discover-bottom">
                        <div class="row">
                            <div class="col">
                                <div class="discover-content">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/dis-one.png') }}">
                                    </figure>
                                    <div class="flag-city">Villa</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="discover-content">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/dis-two.png') }}">
                                    </figure>
                                    <div class="flag-city">Apartment</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="discover-content">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/dis-three.png') }}">
                                    </figure>
                                    <div class="flag-city">Houseboat</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="discover-content">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/dis-four.png') }}">
                                    </figure>
                                    <div class="flag-city">Cottage</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="discover-content">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/dis-five.png') }}">
                                    </figure>
                                    <div class="flag-city">All Inclusive</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <figure class="arrow-shape-third">
                    <img src="{{ asset('web/assets/images/arrow-shape-three.png') }}">
                </figure>
            </div>
        </section>
        <!-- Campaign -->
        <section class="campaign">
            <div class="container-fluid">
                <div class="campaign-inner">
                    <video width="100%" autoplay="" muted="" loop="" playsinline="">
                        <source src="{{ asset('web/assets/images/campaign.mp4') }}" type="video/mp4">
                    </video>
                    <div class="campaign-content">
                        <h2>BEST IN TRAVEL 2024</h2>
                        <a href="javascript::" class="travel-btn">Discover the winners</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Popular -->
        <section class="popular">
            <div class="container">
                <div class="popular-inner">
                    <div class="popular-head">
                        <h2 class="main-heading">Popular Domestic Airlines</h2>
                    </div>
                    <div class="popular-bottom">
                        <ul class="popular-content">
                            <li>
                                <figure class="indigo">
                                    <img src="{{ asset('web/assets/images/popular-one.png') }}">
                                </figure>
                                <h3>IndiGo</h3>
                            </li>
                            <li>
                                <figure class="air-india">
                                    <img src="{{ asset('web/assets/images/popular-two.png') }}">
                                </figure>
                                <h3>Air India</h3>
                            </li>
                            <li>
                                <figure class="india-express">
                                    <img src="{{ asset('web/asset/images/popular-three.png') }}">
                                </figure>
                                <h3>Air India Express</h3>
                            </li>
                            <li>
                                <figure class="akasa-air">
                                    <img src="{{ asset('web/assets/images/popular-four.png') }}">
                                </figure>
                                <h3>Akasa Air</h3>
                            </li>
                            <li>
                                <figure class="vistara">
                                    <img src="{{ asset('web/assets/images/popular-five.png') }}">
                                </figure>
                                <h3>Vistara</h3>
                            </li>
                            <li>
                                <figure class="spicejet">
                                    <img src="{{ asset('web/assets/images/popular-six.png') }}">
                                </figure>
                                <h3>SpiceJet</h3>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hotels -->
        <section class="hotels">
            <div class="container">
                <div class="hotels-inner">
                    <div class="hotels-head">
                        <h2 class="main-heading">Featured Packages</h2>
                    </div>
                    <div class="hotels-bottom">
                        <div class="row">
                            @foreach ($data['package'] as $packages)
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="hotels-wapper">
                                        <figure>
                                            <img src="{{ asset('web/assets/images/hotel-one.png') }}">
                                        </figure>
                                        <div class="hotels-content">
                                            <h3>{{ $packages->name }}</h3>
                                            <p>{{ strip_tags($packages->description) }}</p>
                                            <span class="inr">INR {{ $packages->price }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="hotels-wapper">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/hotel-two.png') }}">
                                    </figure>
                                    <div class="hotels-content">
                                        <h3>Highlights of Norway</h3>
                                        <p>Per night before taxes and fees</p>
                                        <span class="inr">INR 1,937.53</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="hotels-wapper">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/hotel-three.png') }}">
                                    </figure>
                                    <div class="hotels-content">
                                        <h3>Japan Great discovery</h3>
                                        <p>Per night before taxes and fees</p>
                                        <span class="inr">INR 1,417.86</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="hotels-wapper">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/hotel-four.png') }}">
                                    </figure>
                                    <div class="hotels-content">
                                        <h3>Tunisia Beach Stay</h3>
                                        <p>Per night before taxes and fees</p>
                                        <span class="inr">INR 1,663.15</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="hotels-wapper">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/hotel-five.png') }}">
                                    </figure>
                                    <div class="hotels-content">
                                        <h3>Central Europe Discovery Cruise</h3>
                                        <p>Per night before taxes and fees</p>
                                        <span class="inr">INR 3,012</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="hotels-wapper">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/hotel-six.png') }}">
                                    </figure>
                                    <div class="hotels-content">
                                        <h3>The Aldott, Cyber City</h3>
                                        <p>Per night before taxes and fees</p>
                                        <span class="inr">INR 3,778</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="hotels-wapper">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/hotel-seven.png') }}">
                                    </figure>
                                    <div class="hotels-content">
                                        <h3>Charming Portugal</h3>
                                        <p>Per night before taxes and fees</p>
                                        <span class="inr">INR 4,010</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="hotels-wapper">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/hotel-eight.png') }}">
                                    </figure>
                                    <div class="hotels-content">
                                        <h3>Best of Ireland</h3>
                                        <p>Per night before taxes and fees</p>
                                        <span class="inr">INR 1,462</span>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Experiences -->
        <section class="experience">
            <div class="container">
                <div class="experience-inner">
                    <div class="experience-head">
                        <h2 class="main-heading">Traveler’s Experiences</h2>
                        <p class="content">Here some awesome feedback from our travelers</p>
                    </div>
                    <div class="experience-bottom">
                        <div class="owl-carousel owl-theme experience-slider">
                            <div class="item">
                                <div class="exprerience-wapper">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/experience-one.png') }}">
                                    </figure>
                                    <h4>Yuvraj sharma</h4>
                                    <P>I went for my honeymoon with Travel Agency. I discussed about my destination with
                                        akash and he shared an amazing itinerary which covered all the places of Kashmir
                                        which were a must visit during month of december. </P>
                                </div>
                            </div>
                            <div class="item">
                                <div class="exprerience-wapper">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/experience-two.png') }}">
                                    </figure>
                                    <h4>Ashwani gupta</h4>
                                    <P>I went for my honeymoon with Travel Agency. I discussed about my destination with
                                        akash and he shared an amazing itinerary which covered all the places of Kashmir
                                        which were a must visit during month of december. </P>
                                </div>
                            </div>
                            <div class="item">
                                <div class="exprerience-wapper">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/experience-three.png') }}">
                                    </figure>
                                    <h4>Dr. Priya khandelwal</h4>
                                    <P>I went for my honeymoon with Travel Agency. I discussed about my destination with
                                        akash and he shared an amazing itinerary which covered all the places of Kashmir
                                        which were a must visit during month of december. </P>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('click', function() {
                $(".service-menu").removeClass('show');
            });
        });
    </script>
    <script type="text/javascript">
        $('.experience-slider').owlCarousel({
            loop: true,
            margin: 4,
            center: true,
            nav: false,
            dots: true,
            responsive: {
                0: {
                    items: 1
                },
                800: {
                    items: 1.5
                },
                991: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        })
    </script>
    <script>
        // Initialize Select2
        $(document).ready(function() {
            $('#mySelect').select2();
        });

        $(document).ready(function() {
            $('#mySelectDeparture').select2();
        });

        $(document).ready(function() {
            $('#mySelectLength').select2();
        });

        $(document).ready(function() {
            $('#mySelectPackage').select2();
        });
    </script>
@endsection
