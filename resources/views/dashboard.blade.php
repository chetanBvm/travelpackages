@extends('layouts.app')
@section('content')
    @php
        use Carbon\Carbon;
        // Get the current year
        $currentYear = Carbon::now();

        // Array to hold the months
        $months = [];

        // Generate the months for the current year
        for ($i = 0; $i <= 12; $i++) {
            $months[] = $currentYear->copy()->addMonths($i)->format('M Y');
        }
    @endphp
    <div class="main">
        <section class="travel-banner"
            @if (isset($data['homeBanner']) && $data['homeBanner']->type == 'home_banner') style="background-image: url({{ asset('storage') . '/' . $data['homeBanner']->image }})"
            @else
                style="background-image: url('{{ asset('web/assets/images/home-background-img.jpg') }}')" @endif>
            <div class="container">
                <div class="bannr-inner">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="banner-left text-center">
                                @if ($data['homeBanner'] && $data['homeBanner']->type == 'home_banner')
                                    <span class="explore">{{ $data['homeBanner']->title }} <i
                                            class="fa-solid fa-compass"></i></span>
                                    <h1> {!! $data['homeBanner']->subtitle !!}</h1>
                                @else
                                    <span class="explore">Explore the world! <i class="fa-solid fa-compass"></i></span>
                                    <h1>From Southeast Asia to<br> the <span class="world">World.</span> </h1>
                                @endif
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
                                            @foreach ($data['country'] as $countries)
                                                <option value="{{ $countries->id }}">{{ $countries->name }}</option>
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
                                        <select class="form-select" id="mySelectDeparture" name="departure_month"
                                            aria-label="Default select example">
                                            <option value="all">All</option>
                                            @foreach ($months as $index => $month)
                                                <option value="{{ $index + 1 }}"
                                                    {{ old('departure_month') == $index + 1 ? 'selected' : '' }}>
                                                    {{ $month }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="Destination-form-data">
                                        <label for="mySelectLength" class="form-label">
                                            <div class="form-label-img"><img
                                                    src="{{ asset('web/assets/images/timer.svg') }}"
                                                    class="form-label-img">
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
                        @if ($data['homeDestination'] && $data['homeDestination']->type == 'home_destination')
                            <h2>{{ $data['homeDestination']->title }}</h2>
                            <p class="content">{{ $data['homeDestination']->subtitle }}</p>
                        @else
                            <h2 class="main-heading">Trending Destinations</h2>
                            <p class="content">Most popular choices for travellers from India</p>
                        @endif
                    </div>
                    <div class="tranding-bottom">
                        <div class="row">
                            @if ($data['destination']->count() > 0)
                                @foreach ($data['destination'] as $destinations)
                                    <div class="col-sm-6 col-md-6">
                                        <div class="tranding-content">
                                            <figure class="city">
                                                <img src="{{ asset('storage/') . '/' . $destinations->image }}">
                                            </figure>
                                            <div class="flag-city">{{ $destinations->country->name }}
                                                {{ $destinations->country->emoji }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="nodata-para">No Destination available.</p>
                            @endif

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
                        @if ($data['homeStay'] && $data['homeStay']->type == 'home_stay')
                            <h2 class="main-heading">{{ $data['homeStay']->title }}</h2>
                        @else
                            <h2 class="main-heading">Discover your New Favourite Stay</h2>
                        @endif
                    </div>
                    <div class="discover-bottom">
                        <div class="row">
                            @if ($data['stay']->count() > 0)
                                @foreach ($data['stay'] as $stay)
                                    <div class="col">
                                        <div class="discover-content">
                                            <figure>
                                                <img src="{{ asset('storage') . '/' . $stay->image }}">
                                            </figure>
                                            <div class="flag-city">{{ $stay->name }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="nodata-para">No Stay available</p>
                            @endif
                            {{-- <div class="col">
                                <div class="discover-content">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/dis-two.png') }}">
                                    </figure>
                                    <div class="flag-city">Apartment</div>
                                </div>
                            </div> --}}
                            {{-- <div class="col">
                                <div class="discover-content">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/dis-three.png') }}">
                                    </figure>
                                    <div class="flag-city">Houseboat</div>
                                </div>
                            </div> --}}
                            {{-- <div class="col">
                                <div class="discover-content">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/dis-four.png') }}">
                                    </figure>
                                    <div class="flag-city">Cottage</div>
                                </div>
                            </div> --}}
                            {{-- <div class="col">
                                <div class="discover-content">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/dis-five.png') }}">
                                    </figure>
                                    <div class="flag-city">All Inclusive</div>
                                </div>
                            </div> --}}
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
                    @if ($data['homeSection'] && $data['homeSection']->type == 'home_section')
                        <video width="100%" autoplay="" muted="" loop="" playsinline="">
                            <source src="{{ asset('storage') . '/' . $data['homeSection']->image }}">
                        </video>
                        <div class="campaign-content">
                            <h2>{{ $data['homeSection']->title }}</h2>
                            <a href="javascript::" class="travel-btn">{{ $data['homeSection']->subtitle }}</a>
                        </div>
                    @else
                        <video width="100%" autoplay="" muted="" loop="" playsinline="">
                            <source src="{{ asset('web/assets/images/campaign.mp4') }}" type="video/mp4">
                        </video>
                        <div class="campaign-content">
                            <h2>BEST IN TRAVEL 2024</h2>
                            <a href="javascript::" class="travel-btn">Discover the winners</a>
                        </div>
                    @endif

                </div>
            </div>
        </section>
        <!-- Popular -->
        <section class="popular">
            <div class="container">
                <div class="popular-inner">
                    <div class="popular-head">
                        @if ($data['homeAirline'] && $data['homeAirline']->type == 'home_airline')
                            <h2 class="main-heading">{{ $data['homeAirline']->title }}</h2>
                        @else
                            <h2 class="main-heading">Popular Domestic Airlines</h2>
                        @endif
                    </div>
                    <div class="popular-bottom">
                        @if ($data['airline']->count() > 0)
                            <ul class="popular-content">
                                @foreach ($data['airline'] as $airline)
                                    <li>
                                        <figure class="indigo">
                                            <img src="{{ asset('storage') . '/' . $airline->image }}">
                                        </figure>
                                        <h3>{{ $airline->name }}</h3>
                                    </li>
                                @endforeach
                                {{-- <li>
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
                            </li> --}}
                            </ul>
                        @else
                            <p class="nodata-para">No Airlines available</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- Hotels -->
        <section class="hotels">
            <div class="container">
                <div class="hotels-inner">
                    <div class="hotels-head">
                        @if ($data['homePackage'] && $data['homePackage']->type == 'home_package')
                            <h2 class="main-heading">{{ $data['homePackage']->title }}</h2>
                        @else
                            <h2 class="main-heading">Featured Packages</h2>
                        @endif
                    </div>
                    <div class="hotels-bottom">
                        <div class="row">
                            @if ($data['package']->count() > 0)
                                @foreach ($data['package'] as $packages)
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="hotels-wapper">
                                            <figure>
                                                <img src="{{ asset('storage') . '/' . $packages->thumbnail }}">
                                            </figure>
                                            <div class="hotels-content">
                                                <a href="{{ route('web.packageDetails', $packages->id) }}">
                                                    <h3>{{ $packages->name }}</h3>
                                                </a>
                                                <p>{{ $packages->sub_title ?? 'Per night before taxes and fees'}}</p>
                                                @php $currency = $packages->destination->country->currency_symbol @endphp
                                                <span class="inr">{{$currency}} {{ $packages->price }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="nodata-para">No Packages Available.</p>
                            @endif
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
                        @if ($data['homeExperience'] && $data['homeExperience']->type == 'home_travelexperience')
                            <h2 class="main-heading">{{ $data['homeExperience']->title }}</h2>
                            <p class="content">{{ $data['homeExperience']->subtitle }}</p>
                        @else
                            <h2 class="main-heading">Traveler’s Experiences</h2>
                            <p class="content">Here some awesome feedback from our travelers</p>
                        @endif
                    </div>
                    <div class="experience-bottom">
                        @if ($data['experience']->count() > 0)
                            <div class="owl-carousel owl-theme experience-slider">
                                @foreach ($data['experience'] as $experience)
                                    <div class="item">
                                        <div class="exprerience-wapper">
                                            <figure>
                                                <img src="{{ asset('storage') . '/' . $experience->image }}">
                                                {{-- <img src="{{ asset('web/assets/images/experience-one.png') }}"> --}}
                                            </figure>
                                            <h4>{{ $experience->name }}</h4>
                                            <p>{!! $experience->description !!}</p>
                                            {{-- <P>I went for my honeymoon with Travel Agency. I discussed about my destination with
                                        akash and he shared an amazing itinerary which covered all the places of Kashmir
                                        which were a must visit during month of december. </P> --}}
                                        </div>
                                    </div>
                                @endforeach

                                {{-- <div class="item">
                                <div class="exprerience-wapper">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/experience-two.png') }}">
                                    </figure>
                                    <h4>Ashwani gupta</h4>
                                    <P>I went for my honeymoon with Travel Agency. I discussed about my destination with
                                        akash and he shared an amazing itinerary which covered all the places of Kashmir
                                        which were a must visit during month of december. </P>
                                </div>
                            </div> --}}
                                {{-- <div class="item">
                                <div class="exprerience-wapper">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/experience-three.png') }}">
                                    </figure>
                                    <h4>Dr. Priya khandelwal</h4>
                                    <P>I went for my honeymoon with Travel Agency. I discussed about my destination with
                                        akash and he shared an amazing itinerary which covered all the places of Kashmir
                                        which were a must visit during month of december. </P>
                                </div>
                            </div> --}}
                            </div>
                        @else
                            <p class="nodata-para">No Experiences available.</p>
                        @endif
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
