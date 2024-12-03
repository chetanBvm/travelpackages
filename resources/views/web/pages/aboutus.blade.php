@extends('layouts.app')
@section('content')
    <div class="main">
        <!-- College-Banner -->
        <section class="college">
            <div class="container-fluid">
                <div class="college-inner">
                    <figure>
                        @if (isset($data['banner']) && $data['banner']->type == 'about_banner')
                            <img src="{{ asset('storage' . '/' . $data['banner']->image) }}">
                        @else
                            <img src="{{ asset('web/assets/images/about-bg.png') }}">
                        @endif
                    </figure>
                    <div class="college-content">
                        @if (isset($data['banner']))
                            <h1>{{ $data['banner']->title }}</h1>
                            <p>{{ $data['banner']->subtitle }}</p>
                        @else
                            <h1>About Travel Agency </h1>
                            <p>Personalized, life-enriching travel</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- Welcome -->
        <section class="welcome">
            <div class="container">
                <div class="welcome-inner">
                    @if (isset($data['bannerwelcome']) && $data['bannerwelcome']->type == 'about_welcome')
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="welcome-left">
                                    <h2>{{ $data['bannerwelcome']->title }} </h2>
                                    <p>{!! $data['bannerwelcome']->description !!}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="welcome-right">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-7">
                                            <div class="welcome-img-left">
                                                @if ($data['bannerwelcome']->image)
                                                    @php
                                                        $welImages = json_decode($data['bannerwelcome']->image);
                                                    @endphp
                                                    @if (is_array($welImages))
                                                        @foreach ($welImages as $image)
                                                            <figure>
                                                                <img src="{{ asset('storage' . '/' . $image) }}">
                                                                {{--  --}}
                                                            </figure>
                                                        @endforeach
                                                    @else
                                                        <img src="{{ asset('web/assets/images/wel-one.png') }}">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('web/assets/images/wel-one.png') }}">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-5">
                                            <div class="welcome-img-right">
                                                <figure>
                                                    <img src="{{ asset('web/assets/images/wel-two.png') }}">
                                                </figure>
                                                <figure>
                                                    <img src="{{ asset('web/assets/images/wel-three.png') }}">
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="welcome-left">
                                    <h2>Welcome to Travel Agency </h2>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum
                                        has been the industry's standard dummy text ever since the 1500s, when an unknown
                                        printer took a galley of type and scrambled it to make a type specimen book. It has
                                        survived not only five centuries, but also the leap into electronic typesetting,
                                        remaining essentially unchanged. It was popularised in the 1960s with the release of
                                        Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                        publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="welcome-right">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-7">
                                            <div class="welcome-img-left">
                                                <figure>
                                                    <img src="{{ asset('web/assets/images/wel-one.png') }}">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-5">
                                            <div class="welcome-img-right">
                                                <figure>
                                                    <img src="{{ asset('web/assets/images/wel-two.png') }}">
                                                </figure>
                                                <figure>
                                                    <img src="{{ asset('web/assets/images/wel-three.png') }}">
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <!-- Service -->
        <section class="travel-service">
            <div class="container">
                <div class="service-inner">
                    <div class="service-head">
                        @if (isset($data['service']) && $data['service']->type == 'about_travelservice')
                            <h2 class="main-heading">{{ $data['service']->title }}</h2>
                        @else
                            <h2 class="main-heading">Our Travel Services</h2>
                        @endif
                    </div>
                    <div class="service-bottom">
                        <div class="row">
                            @if (isset($data['servicecontent']))
                                @foreach ($data['servicecontent'] as $service)
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="service-wapper">
                                            <div class="service-wapper-head">
                                                <div class="service-content">
                                                    <img src="{{ asset('storage' . '/' . $service->icon) }}">
                                                    <h3>{{ $service->header_title }}</h3>
                                                    <p>{!! $service->header_content !!}</p>
                                                    {{-- <p>Fly with the world's leading airlines at unbelievable rates.</p> --}}
                                                </div>
                                            </div>
                                            <div class="service-wapper-bottom">
                                                <figure>
                                                    <img src="{{ asset('storage' . '/' . $service->image) }}">
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-sm-6 col-lg-3">
                                    <div class="service-wapper">
                                        <div class="service-wapper-head">

                                            <div class="service-content">
                                                <img src="{{ asset('web/assets/images/icon-one.png') }}">
                                                <h3>Flights</h3>
                                                <p>Fly with the world's leading airlines at unbelievable rates.</p>
                                            </div>
                                        </div>
                                        <div class="service-wapper-bottom">
                                            <figure>
                                                <img src="{{ asset('web/assets/images/service-one.png') }}">
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- <div class="col-sm-6 col-lg-3">
                                <div class="service-wapper">
                                    <div class="service-wapper-head">
                                        <div class="service-content">
                                            <img src="{{ asset('web/assets/images/icon-two.png') }}">
                                            <h3>Hotels</h3>
                                            <p>We suggest the perfect accommodation depending on your budget.</p>
                                        </div>
                                    </div>
                                    <div class="service-wapper-bottom">
                                        <figure>
                                            <img src="{{ asset('web/assets/images/service-two.png') }}">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="service-wapper">
                                    <div class="service-wapper-head">
                                        <div class="service-content">
                                            <img src="{{ asset('web/assets/images/icon-three.png') }}">
                                            <h3>Holidays</h3>
                                            <p>Our meticulously crafted holiday packages are designed to impress.</p>
                                        </div>
                                    </div>
                                    <div class="service-wapper-bottom">
                                        <figure>
                                            <img src="{{ asset('web/assets/images/service-three.png') }}">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="service-wapper">
                                    <div class="service-wapper-head">
                                        <div class="service-content">
                                            <img src="{{ asset('web/assets/images/icon-four.png') }}">
                                            <h3>Cruises</h3>
                                            <p>Set sail with our once-in-a-lifetime cruise holidays.</p>
                                        </div>
                                    </div>
                                    <div class="service-wapper-bottom">
                                        <figure>
                                            <img src="{{ asset('web/assets/images/service-four.png') }}">
                                        </figure>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <figure class="arrow-shape-four">
                    <img src="{{ asset('web/assets/images/arrow-shape-three.png') }}">
                </figure>
            </div>
            <figure class="arrow-shape-third">
                <img src="{{ asset('web/assets/images/arrow-shape-three.png') }}">
            </figure>

        </section>
        <!-- Track -->
        <section class="track">
            <div class="container">
                <div class="track-inner">
                    <div class="track-head">
                        @if (isset($data['trackrecord']))
                            <h2 class="main-heading">{{ $data['trackrecord']->title }}</h2>
                            <p>{{ $data['trackrecord']->subtitle }}</p>
                        @else
                            <h2 class="main-heading">Our Track Record</h2>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        @endif
                    </div>
                    <div class="track-bottom">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="track-left">
                                    @if (isset($data['trackrecord']))
                                        <figure>
                                            <img src="{{ asset('storage' . '/' . $data['trackrecord']->image) }}">
                                            {{-- <img src="{{ asset('web/assets/images/track.png') }}"> --}}
                                        </figure>
                                    @else
                                        <figure>
                                            <img src="{{ asset('web/assets/images/track.png') }}">
                                        </figure>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="track-right">
                                    <div class="row">
                                        @foreach ($data['trackwrapper'] as $wrapper)
                                            <div class="col-md-6">
                                                <ul class="ticket-left">
                                                    <li class="track-wapper">
                                                        <img src="{{ asset('storage' . '/' . $wrapper->icon) }}">
                                                        {{-- <img src="{{ asset('web/assets/images/track-one.png') }}"> --}}
                                                        <h3>{{ $wrapper->subtitle }}</h3>
                                                        <p>{{ $wrapper->title }}</p>
                                                    </li>
                                                    {{-- <li class="track-wapper">
                                                    <img src="{{ asset('web/assets/images/track-two.png') }}">
                                                    <h3>8,000+</h3>
                                                    <p>Holiday Packages</p>
                                                </li> --}}
                                                </ul>
                                            </div>
                                        @endforeach
                                        {{-- <div class="col-md-6">
                                            <ul class="ticket-right">
                                                <li class="track-wapper">
                                                    <img src="{{ asset('web/assets/images/track-three.png') }}">
                                                    <h3>12,000+</h3>
                                                    <p>Hotel Bookings</p>
                                                </li>
                                                <li class="track-wapper">
                                                    <img src="{{ asset('web/assets/images/track-four.png') }}">
                                                    <h3>4,000+</h3>
                                                    <p>Cruise Holidays</p>
                                                </li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                    <figure class="arrow-shape-five">
                                        <img src="{{ asset('web/assets/images/arrow-shape.png') }}">
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
