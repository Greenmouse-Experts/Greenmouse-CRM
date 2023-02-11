<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon" style="background: #fff; border-radius: 5px; padding: 5px;">
            <img src="{{URL::asset('assets/img/greenmouse-logo.png')}}" alt="logo" width="90px">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/admin/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-user"></i>
            <span>Staff Management</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a href="{{route('staffs')}}" class="collapse-item">Staffs</a>
                <a href="" class="collapse-item">Salary Structure</a>
                <a href="" class="collapse-item">Leaves/Benefits</a>
                <a href="" class="collapse-item">Attendance</a>
                <a href="" class="collapse-item">Appraisal/Report</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCM" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-users"></i>
            <span>Client Management</span>
        </a>
        <div id="collapseCM" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a href="{{route('client.management')}}" class="collapse-item">Add</a>
                <a href="{{route('clients')}}" class="collapse-item">View</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFM" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-users"></i>
            <span>Financial Management</span>
        </a>
        <div id="collapseFM" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a href="" class="collapse-item">Sales</a>
                <a href="{{route('debtors')}}" class="collapse-item">Debtors</a>
                <a href="{{route('incomes')}}" class="collapse-item">Incomes</a>
                <a href="{{route('expenses')}}" class="collapse-item">Expenses</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInventory" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-users"></i>
            <span>Inventories</span>
        </a>
        <div id="collapseInventory" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a href="{{route('categories')}}" class="collapse-item">Categories</a>
                <a href="{{route('suppliers')}}" class="collapse-item">Suppliers</a>
                <a href="{{route('products')}}" class="collapse-item">Products</a>
            </div>
        </div>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="{{route('todo.list')}}">
            <i class="fas fa-list"></i>
            <span>Todo List</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('todo.list')}}">
            <i class="fas fa-list"></i>
            <span>Credential Details</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProperty" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-home"></i>
            <span>Project Management</span>
        </a>
        <div id="collapseProperty" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a href="" class="collapse-item">Projects</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('enquiries')}}">
            <i class="fas fa-list-alt"></i>
            <span>Enquiry Management</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('enquiries')}}">
            <i class="fas fa-list-alt"></i>
            <span>Support Management</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Account
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-home"></i>
            <span>Settings</span>
        </a>
        <div id="collapseSettings" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a href="{{ route('account') }}" class="collapse-item">My Account</a>
                <a href="" class="collapse-item">Sub Admins</a>
            </div>
        </div>
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