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
                <div class="container-fluid">
                    <!-- Properties -->
                    <section class="properties">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="image-div">
                                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach(explode(',', $property->images) as $image)
                                                @if ($loop->first)
                                                <div class="carousel-item active">
                                                    <img src="/storage/property_images/{{$image}}" class="d-block w-100" alt="...">
                                                </div>
                                                @else
                                                <div class="carousel-item">
                                                    <img src="/storage/property_images/{{$image}}" class="d-block w-100" alt="...">
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <h1>
                                            {{$property->title}}
                                        </h1>
                                        <p>
                                            {{$property->location}}
                                        </p>

                                        <h4 class="mt-2">Description</h4>
                                        <p>{{$property->description}}</p>
                                        
                                        <h4 class="mt-2">
                                            Features
                                        </h4>
                                        <ul>
                                            @foreach(explode(',', $property->features) as $feature)
                                            <li>
                                                {{$feature}}
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="comment">
                                        <div class="box arrow-left">
                                            <h3>
                                                Title:
                                            </h3>
                                            <h5>
                                                {{$property->title}}
                                            </h5>
                                        </div>
                                        <div class="box arrow-left">
                                            <h3>
                                                Per Sqm:
                                            </h3>
                                            <h5>
                                                {{$property->per_sqm}}
                                            </h5>
                                        </div>
                                        <div class="box arrow-left">
                                            <h3>
                                                Price:
                                            </h3>
                                            <h5>
                                                ₦{{number_format($property->price, 2)}}
                                            </h5>
                                        </div>
                                        <div class="box arrow-left">
                                            <h3>
                                                Payment plan:
                                            </h3>
                                            @foreach(explode(',', $property->payment_plans) as $paymentplan)
                                            <p>
                                                {{$paymentplan}}
                                            </p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--Properties Ends  -->
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->
@endsection