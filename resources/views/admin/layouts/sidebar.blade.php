<div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <a href="{{ route('admin.dashboard') }}"><img src="{{ asset('admin/assets/images/logo/logo4.png') }}"
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
                    <span>Dashboards</span>
                </a>
            </li>
            {{-- <li class="sidebar-item {{ request()->routeIs('user.index') ? 'active' : '' }}">
                <a href="{{route('user.index')}}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>User</span>
                </a>
            </li> --}}
            <li class="sidebar-item {{ request()->routeIs('destination.index') ? 'active' : '' }}">
                <a href="{{ route('destination.index') }}" class='sidebar-link'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-backpack-fill" viewBox="0 0 16 16">
                        <path d="M5 13v-3h4v.5a.5.5 0 0 0 1 0V10h1v3z" />
                        <path
                            d="M6 2v.341C3.67 3.165 2 5.388 2 8v5.5A2.5 2.5 0 0 0 4.5 16h7a2.5 2.5 0 0 0 2.5-2.5V8a6 6 0 0 0-4-5.659V2a2 2 0 1 0-4 0m2-1a1 1 0 0 1 1 1v.083a6 6 0 0 0-2 0V2a1 1 0 0 1 1-1m0 3a4 4 0 0 1 3.96 3.43.5.5 0 1 1-.99.14 3 3 0 0 0-5.94 0 .5.5 0 1 1-.99-.14A4 4 0 0 1 8 4M4.5 9h7a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5" />
                    </svg>
                    <span>Destination</span>
                </a>
            </li>
            <li class="sidebar-item has-sub">
                <a class='sidebar-link'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-box-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.004-.001.274-.11a.75.75 0 0 1 .558 0l.274.11.004.001zm-1.374.527L8 5.962 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339Z" />
                    </svg>
                    <span>Packages</span>
                </a>
                <ul class="submenu">
                    <li class="submenu-item {{ request()->routeIs('package.index') ? 'active' : '' }}">
                        <a href="{{ route('package.index') }}">Package</a>
                    </li>
                    <li class="submenu-item {{ request()->routeIs('package.image') ? 'active' : '' }}">
                        <a href="{{ route('package-image.index') }}">Package Images</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item {{ request()->routeIs('promotion.index') ? 'active' : '' }}">
                <a href="{{ route('promotion.index') }}" class='sidebar-link'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-person-badge-fill" viewBox="0 0 16 16">
                        <path
                            d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6m5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1z" />
                    </svg>
                    <span>Promotion</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('banner.index') ? 'active' : '' }}">
                <a href="{{ route('banner.index') }}" class='sidebar-link'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-postage-fill" viewBox="0 0 16 16">
                        <path d="M4.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z" />
                        <path
                            d="M3.5 1a1 1 0 0 0 1-1h1a1 1 0 0 0 2 0h1a1 1 0 0 0 2 0h1a1 1 0 1 0 2 0H15v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1h-1.5a1 1 0 1 0-2 0h-1a1 1 0 1 0-2 0h-1a1 1 0 1 0-2 0h-1a1 1 0 1 0-2 0H1v-1a1 1 0 1 0 0-2v-1a1 1 0 1 0 0-2V9a1 1 0 1 0 0-2V6a1 1 0 0 0 0-2V3a1 1 0 0 0 0-2V0h1.5a1 1 0 0 0 1 1M3 3v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1" />
                    </svg>
                    <span>Banner</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('airline.index') ? 'active' : '' }}">
                <a href="{{ route('airline.index') }}" class='sidebar-link'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-airplane-fill" viewBox="0 0 16 16">
                        <path
                            d="M6.428 1.151C6.708.591 7.213 0 8 0s1.292.592 1.572 1.151C9.861 1.73 10 2.431 10 3v3.691l5.17 2.585a1.5 1.5 0 0 1 .83 1.342V12a.5.5 0 0 1-.582.493l-5.507-.918-.375 2.253 1.318 1.318A.5.5 0 0 1 10.5 16h-5a.5.5 0 0 1-.354-.854l1.319-1.318-.376-2.253-5.507.918A.5.5 0 0 1 0 12v-1.382a1.5 1.5 0 0 1 .83-1.342L6 6.691V3c0-.568.14-1.271.428-1.849" />
                    </svg>
                    <span>Airline</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('stay.index') ? 'active' : '' }}">
                <a href="{{ route('stay.index') }}" class='sidebar-link'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-suitcase2-fill" viewBox="0 0 16 16">
                        <path
                            d="M6.5 0a.5.5 0 0 0-.5.5V3H4.5A1.5 1.5 0 0 0 3 4.5v9a1.5 1.5 0 0 0 1.003 1.416A1 1 0 1 0 6 15h4a1 1 0 1 0 1.996-.084A1.5 1.5 0 0 0 13 13.5v-9A1.5 1.5 0 0 0 11.5 3H10V.5a.5.5 0 0 0-.5-.5zM9 3H7V1h2zM4 7V6h8v1z" />
                    </svg>
                    <span>Stay</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('travel-experience.index') ? 'active' : '' }}">
                <a href="{{ route('travel-experience.index') }}" class='sidebar-link'>
                    <i class="bi bi-chat-left-quote-fill"></i>
                    <span>Travel Experinece</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('itinerary.index') ? 'active' : '' }}">
                <a href="{{ route('itinerary.index') }}" class='sidebar-link'>
                    <i class="bi bi-calendar-minus-fill"></i>
                    <span>Itinerary</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('inclusion.index') ? 'active' : '' }}">
                <a href="{{ route('inclusion.index') }}" class='sidebar-link'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe-americas" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0M2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484q-.121.12-.242.234c-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z"/>
                      </svg>
                    <span>Inclusion</span>
                </a>
            </li>
            <li class="sidebar-item has-sub">
                <a href="" class='sidebar-link'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-houses-fill" viewBox="0 0 16 16">
                        <path d="M7.207 1a1 1 0 0 0-1.414 0L.146 6.646a.5.5 0 0 0 .708.708L1 7.207V12.5A1.5 1.5 0 0 0 2.5 14h.55a2.5 2.5 0 0 1-.05-.5V9.415a1.5 1.5 0 0 1-.56-2.475l5.353-5.354z"/>
                        <path d="M8.793 2a1 1 0 0 1 1.414 0L12 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l1.854 1.853a.5.5 0 0 1-.708.708L15 8.207V13.5a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 4 13.5V8.207l-.146.147a.5.5 0 1 1-.708-.708z"/>
                      </svg>
                    <span>Home Management</span>
                </a>
                <ul class="submenu">
                    <li class="submenu-item ">
                        <a href="{{ route('home-banner') }}">Home Banner</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('home.destination') }}">Home Destination</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('home.stay') }}">Home Stay</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('home.section') }}">Home Section</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('home.airline') }}">Home Airline</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('home.package') }}">Home Package</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('home.travelExperience') }}">Home Travel Experience</a>
                    </li>

                </ul>
            </li>
            <li class="sidebar-item has-sub">
                <a href="" class='sidebar-link'>
                    <i class="bi bi-file-earmark-person-fill"></i>
                    <span>About Management</span>
                </a>
                <ul class="submenu">

                    <li class="submenu-item">
                        <a href="{{ route('aboutbanner') }}">About Banner</a>
                    </li>

                    <li class="submenu-item">
                        <a href="{{ route('about.welcome') }}">About Welcome</a>
                    </li>
                    <li class="submenu-item">
                        <a href="{{ route('about-travelservice') }}">About Travel Service</a>
                    </li>
                    <li class="submenu-item">
                        <a href="{{ route('about-travelservicecontent') }}">About Travel Service Content</a>
                    </li>
                    <li class="submenu-item">
                        <a href="{{ route('about-trackrecord') }}">About Track Record</a>
                    </li>
                    <li class="submenu-item">
                        <a href="{{ route('about-trackrecordwrapper') }}">About Track Record wrapper</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
