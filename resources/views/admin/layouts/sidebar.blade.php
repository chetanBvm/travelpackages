<div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <a href="{{route('admin.dashboard')}}"><img src="{{asset('admin/assets/images/logo/logo.png')}}" alt="Logo" srcset=""></a>
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
            <li class="sidebar-item {{ request()->routeIs('user.index') ? 'active' : '' }}">
                <a href="{{route('user.index')}}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>User</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('destination.index') ? 'active' : '' }}">
                <a href="{{route('destination.index')}}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Destination</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('package.index') ? 'active' : '' }}">
                <a href="{{route('package.index')}}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Packages</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('promotion.index') ? 'active' : '' }}">
                <a href="{{route('promotion.index')}}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Promotion</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('banner.index') ? 'active' : '' }}">
                <a href="{{route('banner.index')}}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Banner</span>
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