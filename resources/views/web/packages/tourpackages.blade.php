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
                            <form action="{{ route('packages.filter') }}" class="row" method="post">
                                @csrf()
                                <div class="col-lg-10 col-md-12">
                                    <div class="Destination-form">
                                        <div class="Destination-form-data">
                                            <select class="form-select" id="mySelect" aria-label="Default select example" name="destination">
                                                <option value="all">All Destination</option>
                                                @foreach ($data['destination'] as $destination)
                                                    <option value="{{ $destination->id }}">{{ $destination->country->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="Destination-form-data">
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
                                            <select class="form-select" id="mySelectLength"
                                                aria-label="Default select example" name="days">
                                                <option value="all">All</option>
                                                <option value="6-9">6-9 Days</option>
                                                <option value="10-15">10-15 Days</option>
                                                <option value="16-21">16-21 Days</option>
                                                <option value="22-60">22+ Days</option>
                                            </select>
                                        </div>

                                        <div class="Destination-form-data">
                                            <select class="form-select" id="mySelectPackage"
                                                aria-label="Default select example" name="packages_type">
                                                <option value="all">All Packages</option>
                                                @foreach ($data['packageType'] as $packagetype)
                                                    <option value="{{ $packagetype->id }}">{{ $packagetype->name }}
                                                    </option>
                                                @endforeach
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
                                        <select class="form-select filter" name="sort_days" id="sort-days"
                                            aria-label="Default select example">
                                            <option selected>Duration</option>
                                            <option value="shortest">Shortest to Longest</option>
                                            <option value="longest">Longest to Shortest</option>
                                        </select>
                                    </div>
                                    <div class="Destination-form-data">
                                        <select class="form-select filter" id="price-filter"
                                            aria-label="Default select example">
                                            <option selected>Price</option>
                                            <option value="shortest">Low to High</option>
                                            <option value="highest">High to Low</option>
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

                @if ($filteredPackages->isNotEmpty())
                    <div class="package-bottom" id="package-list">
                        @foreach ($filteredPackages as $packages)
                            <div class="package-wapper">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="package-left">
                                            <figure>
                                                <img src="{{ asset('storage') . '/' . $packages->thumbnail }}">
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
                    </div>
                @elseif (request()->hasAny(['destination', 'duration', 'package_type']))
                    <p>No Packages Found</p>
                @else
                    <div class="package-bottom">
                        @if(!empty($data['package']))
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
                        @else
                        <p>No packages Found</p>
                        @endif                        
                    </div>
                @endif
            </div>
        </div>
    </section>
    </div>
@endsection
