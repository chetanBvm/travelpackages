<div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <a href="{{ route('admin.dashboard') }}"><img src="{{ asset('admin/assets/images/logo/logo.png') }}"
                        alt="Logo" srcset=""></a>
            </div>
            <div class="toggler">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>
            <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            {{-- Package Management --}}
            <li
                class="sidebar-item {{ request()->routeIs('package.*', 'package-image.*', 'package-review.*', 'package-type.*', 'departure-flights.*', 'departure-city.*') ? 'active' : '' }} has-sub">
                <a class='sidebar-link'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-box-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.004-.001.274-.11a.75.75 0 0 1 .558 0l.274.11.004.001zm-1.374.527L8 5.962 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339Z" />
                    </svg>
                    <span>Packages</span>
                </a>
                <ul
                    class="submenu {{ request()->routeIs('package.*', 'package-image.*', 'package-review.*', 'package-type.*', 'departure-flights.*', 'travel-experience.*', 'departure-city.*', 'destination.*') ? 'active' : '' }}">
                    <li class="submenu-item {{ request()->routeIs('package-type.*') ? 'active' : '' }}">
                        <a href="{{ route('package-type.index') }}">Package Type</a>
                    </li>
                    <li class="submenu-item {{ request()->routeIs('package.*') ? 'active' : '' }}">
                        <a href="{{ route('package.index') }}">Package</a>
                    </li>
                    {{-- <li class="submenu-item {{ request()->routeIs('package-image.*') ? 'active' : '' }}">
                        <a href="{{ route('package-image.index') }}">Package Images</a>
                    </li> --}}
                    <li class="submenu-item {{ request()->routeIs('package-review.*') ? 'active' : '' }}">
                        <a href="{{ route('package-review.index') }}">Package Reviews</a>
                    </li>

                    <li class="submenu-item {{ request()->routeIs('departure-flights.*') ? 'active' : '' }}">
                        <a href="{{ route('departure-flights.index') }}">Departure Flights</a>
                    </li>
                    <li class="submenu-item {{ request()->routeIs('departure-city.*') ? 'active' : '' }}">
                        <a href="{{ route('departure-city.index') }}">Departure Cities</a>
                    </li>
                    <li class="submenu-item {{ request()->routeIs('destination.*') ? 'active' : '' }}">
                        <a href="{{ route('destination.index') }}">
                            <span>Destinations</span>
                        </a>
                    </li>
                    <li class="submenu-item {{ request()->routeIs('travel-experience.*') ? 'active' : '' }}">
                        <a href="{{ route('travel-experience.index') }}">
                            <span>Travel Experinece</span>
                        </a>
                    </li>

                </ul>
            </li>

            {{-- Booking Management --}}
            <li class="sidebar-item {{ request()->routeIs('bookings.index') ? 'active' : '' }}">
                <a href="{{ route('bookings.index') }}" class='sidebar-link'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-backpack-fill" viewBox="0 0 16 16">
                        <path d="M5 13v-3h4v.5a.5.5 0 0 0 1 0V10h1v3z" />
                        <path
                            d="M6 2v.341C3.67 3.165 2 5.388 2 8v5.5A2.5 2.5 0 0 0 4.5 16h7a2.5 2.5 0 0 0 2.5-2.5V8a6 6 0 0 0-4-5.659V2a2 2 0 1 0-4 0m2-1a1 1 0 0 1 1 1v.083a6 6 0 0 0-2 0V2a1 1 0 0 1 1-1m0 3a4 4 0 0 1 3.96 3.43.5.5 0 1 1-.99.14 3 3 0 0 0-5.94 0 .5.5 0 1 1-.99-.14A4 4 0 0 1 8 4M4.5 9h7a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5" />
                    </svg>
                    <span>Bookings</span>
                </a>
            </li>


            <li
                class="sidebar-item {{ request()->routeIs('home-banner', 'home.destination', 'home.stay', 'home.section', 'home.airline', 'home.package', 'home.travelExperience', 'home.topbar') ? 'active' : '' }} has-sub">
                <a href="" class='sidebar-link'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-houses-fill" viewBox="0 0 16 16">
                        <path
                            d="M7.207 1a1 1 0 0 0-1.414 0L.146 6.646a.5.5 0 0 0 .708.708L1 7.207V12.5A1.5 1.5 0 0 0 2.5 14h.55a2.5 2.5 0 0 1-.05-.5V9.415a1.5 1.5 0 0 1-.56-2.475l5.353-5.354z" />
                        <path
                            d="M8.793 2a1 1 0 0 1 1.414 0L12 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l1.854 1.853a.5.5 0 0 1-.708.708L15 8.207V13.5a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 4 13.5V8.207l-.146.147a.5.5 0 1 1-.708-.708z" />
                    </svg>
                    <span>Home Management</span>
                </a>
                <ul
                    class="submenu {{ request()->routeIs('home-banner', 'home.destination', 'home.stay', 'home.section', 'home.airline', 'home.package', 'home.travelExperience', 'home.topbar', 'promotion.*', 'stay.*', 'airline.*') ? 'active' : '' }}">
                    <li class="submenu-item {{ request()->routeIs('home-banner') ? 'active' : '' }}">
                        <a href="{{ route('home-banner') }}">Home Banner</a>
                    </li>
                    <li class="submenu-item {{ request()->routeIs('home.destination') ? 'active' : '' }}">
                        <a href="{{ route('home.destination') }}">Home Destination</a>
                    </li>
                    <li class="submenu-item {{ request()->routeIs('home.stay') ? 'active' : '' }}">
                        <a href="{{ route('home.stay') }}">Home Stay</a>
                    </li>
                    <li class="submenu-item {{ request()->routeIs('home.section') ? 'active' : '' }}">
                        <a href="{{ route('home.section') }}">Home Section</a>
                    </li>
                    <li class="submenu-item {{ request()->routeIs('home.airline') ? 'active' : '' }}">
                        <a href="{{ route('home.airline') }}">Home Airline</a>
                    </li>
                    <li class="submenu-item {{ request()->routeIs('home.package') ? 'active' : '' }}">
                        <a href="{{ route('home.package') }}">Home Package</a>
                    </li>
                    <li class="submenu-item {{ request()->routeIs('home.travelExperience') ? 'active' : '' }}">
                        <a href="{{ route('home.travelExperience') }}">Home Travel Experience</a>
                    </li>
                    <li class="submenu-item {{ request()->routeIs('home.topbar') ? 'active' : '' }}">
                        <a href="{{ route('home.topbar') }}">Home TopBar</a>
                    </li>
                    <li class="submenu-item {{ request()->routeIs('promotion.*') ? 'active' : '' }}">
                        <a href="{{ route('promotion.index') }}">
                            <span>Promotion</span>
                        </a>
                    </li>
                    <li class="submenu-item {{ request()->routeIs('stay.*') ? 'active' : '' }}">
                        <a href="{{ route('stay.index') }}">
                            <span>Stay</span>
                        </a>
                    </li>
                    <li class="submenu-item {{ request()->routeIs('airline.*') ? 'active' : '' }}">
                        <a href="{{ route('airline.index') }}">
                            <span>Airline</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li
                class="sidebar-item {{ request()->routeIs('aboutbanner', 'about.welcome', 'about-travelservice', 'about-travelservicecontent', 'about-trackrecord', 'about-trackrecordwrapper') ? 'active' : '' }} has-sub">
                <a href="" class='sidebar-link'>
                    <i class="bi bi-file-earmark-person-fill"></i>
                    <span>About Management</span>
                </a>
                <ul
                    class="submenu {{ request()->routeIs('aboutbanner', 'about.welcome', 'about-travelservice', 'about-travelservicecontent', 'about-trackrecord', 'about-trackrecordwrapper') ? 'active' : '' }}">

                    <li class="submenu-item {{ request()->routeIs('aboutbanner') ? 'active' : '' }}">
                        <a href="{{ route('aboutbanner') }}">About Banner</a>
                    </li>

                    <li class="submenu-item {{ request()->routeIs('about.welcome') ? 'active' : '' }}">
                        <a href="{{ route('about.welcome') }}">About Welcome</a>
                    </li>
                    <li class="submenu-item {{ request()->routeIs('about-travelservice') ? 'active' : '' }}">
                        <a href="{{ route('about-travelservice') }}">About Travel Service</a>
                    </li>
                    <li class="submenu-item {{ request()->routeIs('about-travelservicecontent') ? 'active' : '' }}">
                        <a href="{{ route('about-travelservicecontent') }}">About Travel Service Content</a>
                    </li>
                    <li class="submenu-item {{ request()->routeIs('about-trackrecord') ? 'active' : '' }}">
                        <a href="{{ route('about-trackrecord') }}">About Track Record</a>
                    </li>
                    <li class="submenu-item {{ request()->routeIs('about-trackrecordwrapper') ? 'active' : '' }}">
                        <a href="{{ route('about-trackrecordwrapper') }}">About Track Record wrapper</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item {{ request()->routeIs('logo', 'contact', 'contactus') ? 'active' : '' }} has-sub">
                <a class='sidebar-link'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-box-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.004-.001.274-.11a.75.75 0 0 1 .558 0l.274.11.004.001zm-1.374.527L8 5.962 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339Z" />
                    </svg>
                    <span>Settings</span>
                </a>
                <ul class="submenu {{ request()->routeIs('logo', 'contact', 'contactus') ? 'active' : '' }}">
                    <li class="submenu-item {{ request()->routeIs('logo') ? 'active' : '' }}">
                        <a href="{{ route('logo') }}">Logo</a>
                    </li>
                    <li class="submenu-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                        <a href="{{ route('contact') }}">Contact</a>
                    </li>
                    <li class="submenu-item {{ request()->routeIs('contactus') ? 'active' : '' }}">
                        <a href="{{ route('contactus') }}">Contact Us</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item {{ request()->routeIs('contactus.*') ? 'active' : '' }}">
                <a href="{{ route('contactus.index') }}" class='sidebar-link'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                        <path
                            d="M512 80c8.8 0 16 7.2 16 16l0 320c0 8.8-7.2 16-16 16L64 432c-8.8 0-16-7.2-16-16L48 96c0-8.8 7.2-16 16-16l448 0zM64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zM208 256a64 64 0 1 0 0-128 64 64 0 1 0 0 128zm-32 32c-44.2 0-80 35.8-80 80c0 8.8 7.2 16 16 16l192 0c8.8 0 16-7.2 16-16c0-44.2-35.8-80-80-80l-64 0zM376 144c-13.3 0-24 10.7-24 24s10.7 24 24 24l80 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-80 0zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24l80 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-80 0z" />
                    </svg>
                    <span>Contact US</span>
                </a>
            </li>



            <li class="sidebar-item {{ request()->routeIs('seo-management.*') ? 'active' : '' }}">
                <a href="{{ route('seo-management.index') }}" class='sidebar-link'>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="16" height="16"
                        class="bi bi-box-fill">
                        <path
                            d="M163.9 136.9c-29.4-29.8-29.4-78.2 0-108s77-29.8 106.4 0l17.7 18 17.7-18c29.4-29.8 77-29.8 106.4 0s29.4 78.2 0 108L310.5 240.1c-6.2 6.3-14.3 9.4-22.5 9.4s-16.3-3.1-22.5-9.4L163.9 136.9zM568.2 336.3c13.1 17.8 9.3 42.8-8.5 55.9L433.1 485.5c-23.4 17.2-51.6 26.5-80.7 26.5L192 512 32 512c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l36.8 0 44.9-36c22.7-18.2 50.9-28 80-28l78.3 0 16 0 64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l120.6 0 119.7-88.2c17.8-13.1 42.8-9.3 55.9 8.5zM193.6 384c0 0 0 0 0 0l-.9 0c.3 0 .6 0 .9 0z" />
                    </svg>
                    <span>Manage SEO</span>
                </a>
            </li>










            {{-- <li class="sidebar-item {{ request()->routeIs('email-template.*') ? 'active' : '' }}">
                <a href="{{ route('email-template.index') }}" class='sidebar-link'>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="16" height="16"
                        class="bi bi-box-fill">
                        <path
                            d="M163.9 136.9c-29.4-29.8-29.4-78.2 0-108s77-29.8 106.4 0l17.7 18 17.7-18c29.4-29.8 77-29.8 106.4 0s29.4 78.2 0 108L310.5 240.1c-6.2 6.3-14.3 9.4-22.5 9.4s-16.3-3.1-22.5-9.4L163.9 136.9zM568.2 336.3c13.1 17.8 9.3 42.8-8.5 55.9L433.1 485.5c-23.4 17.2-51.6 26.5-80.7 26.5L192 512 32 512c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l36.8 0 44.9-36c22.7-18.2 50.9-28 80-28l78.3 0 16 0 64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l120.6 0 119.7-88.2c17.8-13.1 42.8-9.3 55.9 8.5zM193.6 384c0 0 0 0 0 0l-.9 0c.3 0 .6 0 .9 0z" />
                    </svg>
                    <span>Email Templates</span>
                </a>
            </li> --}}


        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
