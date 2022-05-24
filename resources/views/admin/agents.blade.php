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
            <!-- DataTales Example -->
            <div class="row">
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <span class="m-0 font-weight-bold text-primary">Agents</span>

                            <div class="float-right">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-modal"><i class="fa fa-plus" aria-hidden="true"></i> Add Agent</button>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Referrer Code</th>
                                            <th>Date Added</th>
                                            <th style="width:20%">Manage</th>
                                        </tr>
                                    </thead>
                                    @if($agents->isEmpty())
                                    <tbody class="text-muted mb-0">
                                        <tr>
                                            <td class="align-enter text-dark font-15" colspan="6">No Registered Agent.</td>
                                        </tr>
                                    </tbody>
                                    @else
                                    <tbody>
                                        @foreach($agents as $agent)
                                        <tr>
                                            <td>{{$agent->name}}</td>
                                            <td>{{$agent->email}}</td>
                                            <td>{{$agent->phone_number}}</td>
                                            <td>{{$agent->referrer_code}}</td>
                                            <td>{{$agent->created_at}}</td>
                                            <td class="text-center"> 
                                                <a href="{{ route('downlines.user', Crypt::encrypt($agent->id))}}" class="btn btn-success btn-sm">Downlines</a>
                                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-modal-{{$agent->id}}"><i class="fas fa-edit"></i> </button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-modal-{{$agent->id}}"><i class="fas fa-trash"></i> </button>
                                                
                                                <div id="delete-modal-{{$agent->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title" id="my-modal-title">Delete {{$agent->name}}</h5>
                                                                <button class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('delete.user', Crypt::encrypt($agent->id)) }}">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <h2">Are you sure want to delete this record?</h2>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-success float-right">Delete</button>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="edit-modal-{{$agent->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title" id="my-modal-title">Edit {{$agent->name}}</h5>
                                                                <button class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('edit.user', Crypt::encrypt($agent->id)) }}">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group text-left">
                                                                                <label for="my-select">Full Name</label>
                                                                                <input type="text" class="form-control" name="name" value="{{$agent->name}}" placeholder="Enter Name">
                                                                            </div>
                                                                        </div>
                                                                        <!-- <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="my-select">Email</label>
                                                                                <input type="email" class="form-control" name="email" value="{{$agent->email}}" placeholder="Enter Email">
                                                                            </div>
                                                                        </div> -->
                                                                        <div class="col-md-12">
                                                                            <div class="form-group text-left">
                                                                                <label for="my-select">Phone Number</label>
                                                                                <input type="text" class="form-control" name="phone_number" value="{{$agent->phone_number}}" placeholder="Enter Phone Number">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <button type="submit" name="submit_add_staff" class="btn btn-success float-right">Update</button>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="my-modal-title">Add Agent</h5>
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('add.user') }}">
                                    @csrf
                                    <div class="row">
                                        <input type="text" class="form-control" name="user_type" value="Agent" hidden>
                                        <input class="form-control" name="password" value="@Default1" hidden>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="my-select">Full Name</label>
                                                <input type="text" class="form-control" name="name" placeholder="Enter Name">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="my-select">Email</label>
                                                <input type="email" class="form-control" name="email" placeholder="Enter Email">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="my-select">Phone Number</label>
                                                <input type="text" class="form-control" name="phone_number" placeholder="Enter Phone Number">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="submit" name="submit_add_staff" class="btn btn-success float-right">Create</button>
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