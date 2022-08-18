<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon" style="background: #fff; border-radius: 5px; padding: 5px;">
            <img src="{{URL::asset('assets/img/reftophome-logo.png')}}" alt="logo" width="90px">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <li class="nav-item">
        <a class="nav-link" href="{{route('downlines')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Downlines</span>
        </a>
    </li>

    <!-- Nav Item - Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('referral')}}">
            <i class="fas fa-user"></i>
            <span>Referral</span>
        </a>
    </li>

    <!-- Nav Item - Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('user.properties')}}">
            <i class="fas fa-user"></i>
            <span>Properties</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Settings
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('user.account')}}">
            <i class="fas fa-fw fa-wrench"></i>
            <span>My Account</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->