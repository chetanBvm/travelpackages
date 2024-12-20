@if (!empty($data['social_link']->header_title))
    <div class="offer-news">
        <span>{{ $data['social_link']->header_title }}</span>
    </div>
@else
    <div class="offer-news">

        <span>BLACK FRIDAY AT My Vacay Host: Additional $100 OFF / person on all packages. Book by Dec 4th</span>
    </div>
@endif

<div class="offer-news offer-news-2">
    <span>{{ $data['social_link']->title ?? 'Come See the world with Us' }}</span>
    <ul class="social-icon">
        @php
            $socialLinks = json_decode($data['social_link']->social_link, true);

        @endphp
        @php
            // Predefined mapping of platforms to font-awesome icon classes
            $platformIcons = [
                'facebook' => 'facebook',
                'youtube' => 'youtube',
                'twitter' => 'twitter',
                'instagram' => 'instagram',
                'linkedin' => 'linkedin',
            ];
        @endphp
        @foreach ($socialLinks as $social)
            @php
                // Extract the platform name from the URL
                $url = parse_url($social['url']);
                $host = $url['host'] ?? ''; // Get the host (e.g., facebook.com)
                $platform = explode('.', $host)[0]; // Extract the platform name (e.g., facebook)

                // Get the corresponding icon class
                $icon = $platformIcons[strtolower($platform)] ?? 'link'; // Default to 'link' if platform not found
            @endphp
            <li><a href="{{ $social['url'] }}">
                    <i class="fa-brands fa-{{ $icon }}"></i>
                </a></li>
        @endforeach
    </ul>
</div>

<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg p-0">
            <a class="navbar-brand p-0" href="{{ route('dashboard') }}"><img
                    src="{{ asset('web/assets/images/logo.png') }}"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse header-inner" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto mt-0 mb-lg-0 main-menu">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Home</a>
                    </li>

                    <li class="nav-item our-service">
                        <a data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false"
                            aria-controls="collapseExample1">
                            Tour Packages <i class="fa-solid fa-angle-down"></i></a>
                        <div class="collapse service-menu" id="collapseExample1">
                            <div class="card card-body">
                                <ul class="inner-menu">
                                    <!-- <li><a href="package.php"><img src="images/TourPackages.svg"> Tour Packages</a></li> -->
                                    <li><a href="{{ route('web.packages') }}"><img
                                                src="{{ asset('web/assets/images/safari.svg') }}"> Safari</a></li>
                                    {{-- <li><a href="#"><img
                                                src="{{ asset('web/assets/images/OceanCruisePackages.svg') }}"> River
                                            Cruise Packages</a></li> --}}
                                </ul>
                            </div>
                        </div>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pages.about') }}">About Us</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pages.contactus') }}">Contact Us</a>
                    </li>
                </ul>
                <div class="login-sec">
                    <span class="search search-toggle"><img
                            src="{{ asset('web/assets/images/search-icon.svg') }}"></span>
                    <button class="login-btn"><img
                            src="{{ asset('web/assets/images/call-calling.svg') }}"><span>Toll-Free</span>
                        1234-567-890</button>
                </div>
            </div>
        </nav>
        <div class="search-box">
            <div class="wrap">
                <lable>
                    <input type="search" id="search-field" class="search-field" placeholder="Search...">
                    </label>
                    <button class="travel-btn" id="search-btn"><i class="fas fa-search"></i> Search</button>
            </div>
        </div>
    </div>
</header>
