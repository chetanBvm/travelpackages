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
        <section class="travel-banner">
            <div class="container-fluid">
                <div class="home-travel-inner">
                    <figure class="home-slider-images">
                        @if ($data['homeBanner']->image)
                            @php
                                $welImages = json_decode($data['homeBanner']->image);
                            @endphp
                            @if (is_array($welImages))
                                @foreach ($welImages as $image)
                                    <img src="{{ asset('storage' . '/' . $image) }}">
                                @endforeach
                            @else
                                <img src="{{ asset('web/assets/images/wel-one.png') }}">
                            @endif
                        @else
                            <img src="{{ asset('web/assets/images/home-background-img.jpg') }}">
                        @endif
                    </figure>


                    <div class="bannr-inner">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="banner-left text-center">
                                    @if ($data['homeBanner'] && $data['homeBanner']->type == 'home_banner')
                                        <a class="explore"
                                            href="{{ route('web.packages') }}">{{ $data['homeBanner']->title }} <i
                                                class="fa-solid fa-compass"></i></a>
                                        <h1> {!! $data['homeBanner']->subtitle !!}</h1>
                                    @else
                                        <a class="explore" href="{{ route('web.packages') }}">Explore the world! <i
                                                class="fa-solid fa-compass"></i></a>
                                        <h1>From Southeast Asia to<br> the <span class="world">World.</span> </h1>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="Destination-form">

                            <div class="row justify-content-between">
                                <div class="col-12">
                                    <form class="Destination-form-main" method="get" action="{{route('dashboard.filter')}}">
                                        <div class="Destination-form-inner">
                                            <div class="Destination-form-data">
                                                <label for="mySelect" class="form-label">
                                                    <div class="form-label-img"><img
                                                            src="{{ 'web/assets/images/location.svg' }}"></div>
                                                    Destination
                                                </label>
                                                <select class="form-select" id="mySelect"
                                                    aria-label="Default select example" name="destination">
                                                    @foreach ($data['destinations'] as $destination)
                                                        <option value="{{ $destination->id }}">{{ $destination->country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>



                                            <div class="Destination-form-data">
                                                <label for="mySelectDeparture" class="form-label">
                                                    <div class="form-label-img"><img
                                                            src="{{ 'web/assets/images/calendar.svg' }}"
                                                            class="form-label-img"></div> Duration
                                                </label>
                                                <select name="departure_month" class="form-select" id="mySelectDeparture"
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
                                                            class="form-label-img"></div> Month of Departure
                                                </label>
                                                <select class="form-select" id="mySelectLength"
                                                    aria-label="Default select example" name="departure_days">
                                                    <option value="all">All</option>
                                                    <option value="5-10" {{ request('departure_days') == '5-10' ? 'selected' : '' }}>5-10 Days</option>
                                                    <option value="11-15" {{ request('departure_days') == '11-15' ? 'selected' : '' }}>11-15 Days</option>
                                                    <option value="16-30" {{ request('departure_days') == '16-30' ? 'selected' : '' }}>16 days or more</option>
                                                </select>


                                            </div>

                                            <div class="Destination-form-data">
                                                <label for="mySelectPackage" class="form-label">
                                                    <div class="form-label-img"><img
                                                            src="{{ asset('web/assets/images/map.svg') }}"
                                                            class="form-label-img"></div> Package Type
                                                </label>
                                                <select class="form-select" id="mySelectPackage"
                                                    aria-label="Default select example" name="package_type">
                                                        @foreach($data['packageType'] as $packagetype)
                                                        <option value="{{$packagetype->id}}">{{$packagetype->name}}</option>
                                                        @endforeach
                                                    <!-- <option value="2">Ocean Cruise Packages</option>
                                                  <option value="3">River Cruise Packages</option> -->
                                                </select>
                                            </div>
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
            </div>
        </section>
        <!-- Tranding -->
        <section class="tranding">
            <div class="container">
                <div class="tranding-inner">
                    <div class="tranding-head">
                        @if ($data['homeDestination'] && $data['homeDestination']->type == 'home_destination')
                            <h2 class="main-heading">{{ $data['homeDestination']->title }}</h2>
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
                                    <div class="col-sm-6 col-md-4">
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
                                                <p>{{ $packages->sub_title ?? 'Per night before taxes and fees' }}</p>
                                                @php
                                                    $currency = $packages->destination->country->currency_symbol;
                                                    $price = $packages->price;
                                                    $formattedPrice =
                                                        floor($price) == $price
                                                            ? number_format($price, 0)
                                                            : number_format($price, 2);
                                                @endphp
                                                <span class="inr">{{ $currency }} {{ $formattedPrice }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="nodata-para">No Packages Available.</p>
                            @endif
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
                                            {!! $experience->description !!}
                                           
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

        <!-- Newsletter-->
        <section class="newsletter ">
            <div class="container">
              <div class="news-letter-inner">
                <div class="row align-items-center justify-content-center text-center">
                  <div class="col-xl-6 col-md-8">
                    <div class="experience-head">
                      <h2 class="main-heading my-2">Subscribe To Our Newsletter</h2>
                      <p class="content my-2">Lorem Ipsum passages, and more recently with desktop publishing </p>
                      <div class="content">
                        <form class="subscription">
                          <input type="email" name="Email" class="form-control" placeholder="Enter email address">
                          <button class="travel-btn" type="button">
                            Subscribe
                          </button>
                        </form>
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
