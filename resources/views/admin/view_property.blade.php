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
            <form method="POST" action="{{ route('update.property', Crypt::encrypt($property->id)) }}" enctype="multipart/form-data">
                 @csrf
                 <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <span class="m-0 font-weight-bold text-primary">View/Edit {{$property->title}}</span>
                            </div>
                            <div class="card-body">

                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Title</label>
                                                <input type="text" class="form-control" name="title" value="{{$property->title}}"
                                                    aria-describedby="helpId" placeholder="e.g. EDEN VIEW ESTATE" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Location</label>
                                                <input type="text" class="form-control" name="location" value="{{$property->location}}"
                                                    aria-describedby="helpId" placeholder="e.g Folu Ise, Ibeju Lekki, Ise Ibeju, Lekki">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <textarea class="form-control" name="description" rows="3" value="{{$property->description}}"
                                                    placeholder="e.g Excision in Progress">{{$property->description}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Per Sqm</label>
                                                <input type="text" class="form-control" name="per_sqm"
                                                    id="" aria-describedby="helpId" value="{{$property->per_sqm}}"
                                                    placeholder="e.g 600sqm">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Price(₦)</label>
                                                <input type="number" class="form-control" name="price" value="{{$property->price}}"
                                                    aria-describedby="helpId" placeholder="e.g ₦6000000">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Payment Plans</label>
                                                <textarea class="form-control" name="payment_plans" rows="3" value="{{$property->payment_plans}}"
                                                    placeholder="e.g 1-2months: ₦800k, 3 months: ₦900,000, 6 months: ₦1,000,000, Initial Deposit: ₦400,000">{{$property->payment_plans}}</textarea>
                                                    <small class="text-danger">Separate items with the comma(,) sign</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Features</label>
                                                <textarea class="form-control" name="features" rows="3" value="{{$property->features}}"
                                                    placeholder="e.g Perimeter Fencing, Good Road Networks, Security, Water">{{$property->features}}</textarea>
                                                    <small class="text-danger">Separate items with the comma(,) sign</small>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <span class="m-0 font-weight-bold text-danger">Take all pictures in landscape format</span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Upload Images</label>
                                            <div class="row">
                                            @foreach(explode(',', $property->images) as $image) 
                                                <div class="form-group col-md-4">
                                                    <label for="title">{{$loop->iteration}}</label><br>
                                                    <img class="img-fluid" width="100%" src="/storage/property_images/{{$image}}" alt="{{$image}}">
                                                </div>
                                            @endforeach
                                            </div>
                                            <hr>
                                            <div id="thumb-output" class="mb-2 image-fluid"></div>
                                            <input type="file" name="images[]" onchange="loadPreview(this)" class="form-control"
                                                multiple> <small id="helpId" class="form-text text-muted">
                                                Maximum of 5 pictures</small>
                                            <div class="text-left mt-4">
                                                <p><b>How to upload multiple pictures at once</b></p>
                                                <ul>
                                                    <li>Click the Choose Files button above</li>
                                                    <li>Hold down the ctrl key (Window) or command key (macOS) and at the same time select the pictures you want to upload.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{route('properties')}}" class="btn btn-danger float-left">Cancel</a>
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