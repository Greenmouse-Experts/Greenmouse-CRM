@extends('layouts.admin_dashboard_frontend')

@section('page-content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        @includeIf('layouts.admin_topbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="row">
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <span class="m-0 font-weight-bold text-primary">Equiries</span>

                            <div class="float-right">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-modal"><i class="fa fa-plus" aria-hidden="true"></i> Add Enquiry</button>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th>Location</th>
                                            <th>How Do You Know About Us</th>
                                            <th>Enquiry Details</th>
                                            <th>Created At</th>
                                            <th style="width:5%">Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($enquiries as $key => $enquiry)
                                        <tr>
                                            <td>{{$enquiry->first_name}}</td>
                                            <td>{{$enquiry->last_name}}</td>
                                            <td>{{$enquiry->phone_number}}</td>
                                            <td>{{$enquiry->email}}</td>
                                            <td>{{$enquiry->location}}</td>
                                            <td>{{$enquiry->how_do_you_know_about_us}}</td>
                                            <td>{{$enquiry->enquiry_details}}</td>
                                            <td>{{$enquiry->created_at}}</td>
                                            <td class="text-center"> 
                                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-modal-{{$enquiry->id}}"><i class="fas fa-edit"></i> </button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-modal-{{$enquiry->id}}"><i class="fas fa-trash"></i> </button>
                                                
                                                <div id="edit-modal-{{$enquiry->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title" id="my-modal-title">Edit Call Booking</h5>
                                                                <button class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('update.enquiry', Crypt::encrypt($enquiry->id)) }}">
                                                                    @csrf
                                                                    <div class="row text-left">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group text-left">
                                                                                <label>First Name</label>
                                                                                <input type="text" class="form-control" name="first_name" value="{{$enquiry->first_name}}" placeholder="Enter First Name">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group text-left">
                                                                                <label>Last Name</label>
                                                                                <input type="text" class="form-control" name="last_name" value="{{$enquiry->last_name}}" placeholder="Enter Last Name">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group text-left">
                                                                                <label for="my-select">Phone Number</label>
                                                                                <input type="tel" class="form-control" name="phone_number" value="{{$enquiry->phone_number}}" placeholder="Enter Phone Number">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group text-left">
                                                                                <label for="my-select">Email</label>
                                                                                <input type="email" class="form-control" name="email" value="{{$enquiry->email}}" placeholder="Enter Email">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="my-select">Enquiry Location</label>
                                                                                <input type="text" class="form-control" name="location" placeholder="Enter Enquiry Location" value="{{$enquiry->location}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group text-left">
                                                                                <label for="my-select">How Do You Know About Us</label>
                                                                                <input type="text" class="form-control" name="how_do_you_know_about_us" placeholder="How Do You Know About Us" value="{{$enquiry->how_do_you_know_about_us}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group text-left">
                                                                                <label>Enquiry Details</label>
                                                                                <textarea type="text" class="form-control" name="details" placeholder="Comment" value="{{$enquiry->enquiry_details}}">{{$enquiry->enquiry_details}}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <button type="submit"  class="btn btn-success float-right">Update</button>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div id="delete-modal-{{$enquiry->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title" id="my-modal-title">Delete</h5>
                                                                <button class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('delete.enquiry', Crypt::encrypt($enquiry->id)) }}">
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
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
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
                                <h5 class="modal-title" id="my-modal-title">Add Enquiry</h5>
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('add.enquiry') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" name="first_name" placeholder="Enter First Name">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="my-select">Phone Number</label>
                                                <input type="tel" class="form-control" name="phone_number" placeholder="Enter Phone Number">
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
                                                <label for="my-select">Enquiry Location</label>
                                                <input type="text" class="form-control" name="location" placeholder="Enter Enquiry Location">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="my-select">How Do You Know About Us</label>
                                                <input type="text" class="form-control" name="how_do_you_know_about_us" placeholder="How Do You Know About Us">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Enquiry Details</label>
                                                <textarea type="text" class="form-control" name="details" placeholder="Enter Details"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-success float-right">Create</button>
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