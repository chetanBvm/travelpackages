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
        <!-- College-Banner -->
        <section class="college">
            <div class="container-fluid">
                <div class="college-inner">
                    <figure>
                        @if (isset($data['banner']->image))
                            <img src="{{ asset('storage') . '/' . $data['banner']->image }}">
                        @else
                            <img src="{{ asset('web/assets/images/package-bg.png') }}" />
                        @endif
                    </figure>
                    <div class="college-content">
                        @if (isset($data['banner']->text))
                            <h1>{{ $data['banner']->text }}</h1>
                        @else
                            <h1>Holiday Package</h1>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- Package -->
        <section class="package">
            <div class="container">
                <div class="package-inner">
                    <div class="package-head">

                        <div class="filter-form">
                            <form action="" class="row">

                                <div class="col-lg-10 col-md-12">

                                    <div class="Destination-form">



                                        <div class="Destination-form-data">
                                            <select class="form-select" id="mySelect" aria-label="Default select example">
                                                <option value="0" selected> Destination</option>
                                                @foreach ($data['country'] as $countries)
                                                    <option value="{{ $countries->id }}">{{ $countries->name }}</option>
                                                @endforeach
                                                {{-- <option value="2">Africa / Middle East</option>
                                                <option value="3">Asia</option>
                                                <option value="4">Central America</option>
                                                <option value="5"> Europe</option> --}}
                                            </select>
                                        </div>

                                        <div class="Destination-form-data">
                                            <select class="form-select" id="mySelectDeparture" name="departure_month"
                                                aria-label="Default select example">
                                                <option selected disabled>Departure Month</option>
                                                @foreach ($months as $index => $month)
                                                    <option value="{{ $index + 1 }}"
                                                        {{ old('departure_month') == $index + 1 ? 'selected' : '' }}>
                                                        {{ $month }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="Destination-form-data">
                                            <select class="form-select" id="mySelectLength"
                                                aria-label="Default select example">
                                                <option selected>Length</option>
                                                <option value="1">6-9 Days</option>
                                                <option value="2">10-15 Days</option>
                                                <option value="3">16-21 Days</option>
                                                <option value="4">22+ Days</option>
                                            </select>

                                        </div>

                                        <div class="Destination-form-data">
                                            <select class="form-select" id="mySelectPackage"
                                                aria-label="Default select example">
                                                <option selected>Package Type</option>
                                                <option value="1">Tour Packages</option>
                                                {{-- <option value="2">Ocean Cruise Packages</option>
                                                <option value="3">River Cruise Packages</option> --}}
                                            </select>
                                        </div>




                                    </div>

                                </div>

                                <div class="col-lg-2 col-md-12">
                                    <div class="form-action">
                                        <button type="submit" class="fillter-btn btn"><i class="fa-solid fa-filter"></i>
                                            Find your trip</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>





                    <div class="sort-package-filters">
                        <div class="row align-items-center">
                            <div class="col-lg-5">
                                <div class="sort-by-main">
                                    <span class="sort-by">Sort By :</span>

                                    <div class="Destination-form-data">
                                        <select class="form-select" id="myfilters"
                                            aria-label="Default select example">
                                            <option selected>Duration</option>
                                            <option value="1">Shortest to Longest</option>
                                            <option value="2" >Longest to Shortest</option>
                               
                                        </select>


                                    </div>

                                    <div class="Destination-form-data">
                                        <select class="form-select" id="myduration" aria-label="Default select example">
                                            <option selected>Price</option>
                                            <option value="1">Low to High</option>
                                            <option value="2">High to Low</option>
                                        </select>


                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-7">
                                <div class="select-package">
                                    <span>Package type :</span>
                                    <div class="package-select-data">

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="exampleRadios1"
                                                id="exampleRadios1" value="option1">
                                            <label class="form-check-label" for="exampleRadios1">
                                                24 Semi-organized
                                            </label>
                                        </div>
                                    </div>
                                    <div class="package-select-data">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="exampleRadios2"
                                                id="exampleRadios2" value="option2">
                                            <label class="form-check-label" for="exampleRadios2">
                                                12 Freedom
                                            </label>
                                        </div>
                                    </div>
                                    <div class="package-select-data">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="exampleRadios3"
                                                id="exampleRadios3" value="option3">
                                            <label class="form-check-label" for="exampleRadios3">
                                                14 Organized
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="package-bottom">
                    @foreach ($data['package'] as $packages)
                        <div class="package-wapper">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="package-left">
                                        <figure>
                                            <img src="{{ asset('storage') . '/' . $packages->thumbnail }}">
                                            {{-- <img src="images/package-one.png"> --}}
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="package-left">
                                        <ul class="package-left-head">
                                            <li>
                                                <h2>{{ $packages->name }}</h2>
                                                <span class="day-night">{{ $packages->days }} Days</span>
                                            </li>
                                            <li>
                                                @php
                                                    $currency = $packages->destination->country->currency_symbol;
                                                @endphp
                                                <h3> {{ $currency }} {{ $packages->price }}</h3>
                                                <span class="start-price">Starting Price</span>
                                            </li>
                                        </ul>
                                        <div class="package-left-middle">
                                            @php
                                                $truncatedDescription = Str::limit(
                                                    strip_tags($packages->description),
                                                    200,
                                                    '...',
                                                );
                                            @endphp
                                            <p>{!! $truncatedDescription !!}</p>
                                            <a class="view-more-btn"
                                                href="{{ route('web.packageDetails', $packages->id) }}">View More</a>
                                        </div>

                                        <a class="travel-btn"
                                            href="{{ route('web.packageDetails', $packages->id) }}">Send
                                            Enquiry</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="package-wapper">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="package-left">
                                    <figure>
                                        <img src="images/package-two.png">
                                    </figure>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="package-left">
                                    <ul class="package-left-head">
                                        <li>
                                            <h2>Mount Abu Tour Package</h2>
                                            <span class="day-night">10 Days</span>
                                        </li>
                                        <li>
                                            <h3>$ 18 799.000</h3>
                                            <span class="start-price">Starting Price</span>
                                        </li>
                                    </ul>
                                    <div class="package-left-middle">
                                        <p>The only hill station of Rajasthan, its cool atmosphere and lush green
                                            surroundings make it a major tourist spot within the state. The most important
                                            ...</p>
                                        <a class="view-more-btn" href="package-single.php">View More</a>
                                    </div>
                                    <a class="travel-btn" href="package-single.php">Send Enquiry</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="package-wapper">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="package-left">
                                    <figure>
                                        <img src="images/package-three.png">
                                    </figure>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="package-left">
                                    <ul class="package-left-head">
                                        <li>
                                            <h2>Weekend Jaipur Pushkar Package</h2>
                                            <span class="day-night">11 Days</span>
                                        </li>
                                        <li>
                                            <h3>$ 15 799.00</h3>
                                            <span class="start-price">Starting Price</span>
                                        </li>
                                    </ul>
                                    <div class="package-left-middle">
                                        <p>Blended with the true essence of Rajasthan this tour is designed in a way that it
                                            helps you experience the right mix of mysticism and serenity that pr... </p>
                                        <a class="view-more-btn" href="package-single.php">View More</a>
                                    </div>

                                    <a class="travel-btn" href="package-single.php">Send Enquiry</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="package-wapper">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="package-left">
                                    <figure>
                                        <img src="images/package-four.png">
                                    </figure>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="package-left">
                                    <ul class="package-left-head">
                                        <li>
                                            <h2>Best of North India Tour</h2>
                                            <span class="day-night">16 Days</span>
                                        </li>
                                        <li>
                                            <h3>$ 33 799.00</h3>
                                            <span class="start-price">Starting Price</span>
                                        </li>
                                    </ul>
                                    <div class="package-left-middle">
                                        <p>Get the touch of complete India, the variant culture, and lifestyle, cuisines,
                                            and costumes with a well planned North India and South India Tour. Each...</p>
                                        <a class="view-more-btn" href="package-single.php">View More</a>
                                    </div>

                                    <a class="travel-btn" href="package-single.php">Send Enquiry</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="package-pagenation">
                        {{ $data['package']->links() }}
                    </div> --}}
                    {{-- <div class="package-pagenation">
                        <span class="page-count">Page 1 of 30 </span>
                        <button class="prev-btn"><i class="fa-solid fa-angle-left"></i> Previous</button>
                        <ul class="page-number dasktop-page">
                            <li class="active">1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                            <li>6</li>
                            <li>7</li>
                            <li>8</li>
                            <li>9</li>
                            <li>10</li>
                        </ul>
                        <ul class="page-number mobile-page">
                            <li class="active">1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>...</li>
                            <li>10</li>
                        </ul>
                        <button class="next-btn">Next <i class="fa-solid fa-angle-right"></i></button>
                    </div> --}}
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection
