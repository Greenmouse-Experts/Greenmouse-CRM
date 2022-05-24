@extends('layouts.dashboard_frontend')

@section('page-content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!-- Counter - Alerts -->
                    <span class="badge badge-primary badge-counter" style="font-size: 100%; margin-top: 0px;">{{Auth::user()->user_type}}</span>
                </a>
                <!-- Dropdown - Alerts -->
                </li>

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                        <img class="img-profile rounded-circle" src="{{URL::asset('assets/img/avatar.png')}}">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                        <a class="dropdown-item" href="{{route('user.account')}}">
                            <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                            My Account
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h6 class="font-weight-bold text-primary">Profile</h6>
                        </div>
                        <div class="card-body">
                        <div class="text-left">
                        <form class="user"  method="POST" action="{{ route('update.user', Crypt::encrypt(Auth::user()->id)) }}">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control form-control-user" name="name" value="{{Auth::user()->name}}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control form-control-user" value="{{Auth::user()->email}}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="tel" class="form-control form-control-user" name="phone_number" value="{{Auth::user()->phone_number}}">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Update" class="btn btn-success btn-user btn-block">
                            </div>
                        </form>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h6 class="font-weight-bold text-primary">Change Password</h6>
                        </div>
                        <div class="card-body">
                        <div class="text-left">
                        <form class="user" method="POST" action="{{ route('change.password.user', Crypt::encrypt(Auth::user()->id)) }}">
                            @csrf
                            <div class="form-group">
                                <label for="password">Old Password</label>
                                <input type="password" class="form-control form-control-user" id="password" value="{{Auth::user()->password}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input id="new_password" type="password" class="form-control form-control-user" name="new_password" placeholder="New Password">
                            </div>
                            <div class="form-group">
                                <label for="confirm_new_password">Confirm New Password</label>
                                <input id="confirm_new_password"type="password" class="form-control form-control-user" name="new_password_confirmation" placeholder="Re-Enter New Password">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Change" class="btn btn-success btn-user btn-block">
                            </div>
                        </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->
@endsection