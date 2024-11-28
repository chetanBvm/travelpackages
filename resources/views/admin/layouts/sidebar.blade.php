<div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <a href="{{route('admin.dashboard')}}"><img src="{{asset('admin/assets/images/logo/logo4.png')}}" alt="Logo" srcset=""></a>
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
                <a href="{{route('admin.dashboard')}}" class='sidebar-link'>
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
                <a href="{{route('destination.index')}}" class='sidebar-link'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backpack-fill" viewBox="0 0 16 16"><path d="M5 13v-3h4v.5a.5.5 0 0 0 1 0V10h1v3z"/><path d="M6 2v.341C3.67 3.165 2 5.388 2 8v5.5A2.5 2.5 0 0 0 4.5 16h7a2.5 2.5 0 0 0 2.5-2.5V8a6 6 0 0 0-4-5.659V2a2 2 0 1 0-4 0m2-1a1 1 0 0 1 1 1v.083a6 6 0 0 0-2 0V2a1 1 0 0 1 1-1m0 3a4 4 0 0 1 3.96 3.43.5.5 0 1 1-.99.14 3 3 0 0 0-5.94 0 .5.5 0 1 1-.99-.14A4 4 0 0 1 8 4M4.5 9h7a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5"/></svg>
                    <span>Destination</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('package.index') ? 'active' : '' }}">
                <a href="{{route('package.index')}}" class='sidebar-link'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-fill" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.004-.001.274-.11a.75.75 0 0 1 .558 0l.274.11.004.001zm-1.374.527L8 5.962 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339Z"/> </svg>
                    <span>Packages</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('promotion.index') ? 'active' : '' }}">
                <a href="{{route('promotion.index')}}" class='sidebar-link'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-badge-fill" viewBox="0 0 16 16"> <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6m5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1z"/></svg>
                    <span>Promotion</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('banner.index') ? 'active' : '' }}">
                <a href="{{route('banner.index')}}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Banner</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('airline.index') ? 'active' : '' }}">
                <a href="{{route('airline.index')}}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Airline</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('stay.index') ? 'active' : '' }}">
                <a href="{{route('stay.index')}}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Stay</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('travel-experience.index') ? 'active' : '' }}">
                <a href="{{route('travel-experience.index')}}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Travel Experinece</span>
                </a>
            </li>
                {{-- <ul class="submenu">
                    <li class="submenu-item">
                        <a href=""></a>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
