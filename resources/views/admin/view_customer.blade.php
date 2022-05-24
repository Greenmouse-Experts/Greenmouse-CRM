@extends('layouts.admin_dashboard_frontend')

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

                        <a class="dropdown-item" href="{{route('account')}}">
                            <i class="fas fa-fw fa-wrench fa-sm fa-fw mr-2 text-gray-400"></i>
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
            <!-- Content Row -->
            <form method="POST" action="{{ route('update.customer.management', Crypt::encrypt($customer->id))}}" enctype="multipart/form-data">
                 @csrf
                 <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <span class="m-0 font-weight-bold text-primary">View/Edit {{$customer->first_name}} {{$customer->last_name}} Details</span>
                            </div>
                            <div class="card-body">

                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Full Name <small class="text-danger">*</small></label>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{$customer->first_name}}" aria-describedby="helpId" required>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{$customer->last_name}}"aria-describedby="helpId" required>
                                                    </div>
                                                </div>                                                    
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Address <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control" name="address" value="{{$customer->address}}"
                                                    aria-describedby="helpId" placeholder="Enter Address">
                                                    <small class="text-danger">Street Address/City/State/Providence</small>
                                                <input type="text" class="form-control" name="address_2" value="{{$customer->address_2}}"
                                                    aria-describedby="helpId" placeholder="Enter Address Line 2">
                                                    <small class="text-danger">Street Address/City/State/Providence</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="">Phone Number <small class="text-danger">*</small></label>
                                                        <input type="tel" class="form-control" name="phone_number" value="{{$customer->phone_number}}" placeholder="Phone Number" aria-describedby="helpId" required>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="">E-mail Address <small class="text-danger">*</small></label>
                                                        <input type="email" class="form-control" name="email" value="{{$customer->email}}" placeholder="E-mail Address" aria-describedby="helpId" required>
                                                    </div>
                                                </div>                                                    
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Occupation <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control" name="occupation" value="{{$customer->occupation}}" placeholder="Occupation" aria-describedby="helpId" required>                                               
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Property of Interest <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control" name="property_of_interest" placeholder="Property of Interest" value="{{$customer->property_of_interest}}" aria-describedby="helpId" required>                                               
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Amount to Offer <small class="text-danger">*</small></label>
                                                <input type="number" class="form-control" name="offer" placeholder="Amount to Offer"  value="{{$customer->offer}}" aria-describedby="helpId" required>                                               
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">When Do You Want To Move In? <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control" name="when_do_you_want_to_move_in" value="{{$customer->when_do_you_want_to_move_in}}" placeholder="When Do You Want To Move In?" aria-describedby="helpId" required>                                               
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{route('customers')}}" class="btn btn-danger float-left">Cancel</a>
                                    <button type="submit" class="btn btn-success float-right">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->
@endsection