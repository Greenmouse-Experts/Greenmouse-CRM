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
            <!-- Content Row -->
            <form method="POST" action="{{ route('add.client.management') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <span class="m-0 font-weight-bold text-primary">Add Client</span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Title</label>
                                            <div class="row">
                                                <div class="col-12">
                                                    <select class="form-control select2" name="title">
                                                        <option value="">--Select Title--</option>
                                                        <option value="Mr.">Mr.</option>
                                                        <option   option value="Mrs.">Mrs.</option>
                                                        <option value="Miss">Miss</option>
                                                        <option value="Ms.">Ms.</option>
                                                        <option value="Master">Master</option>
                                                        <option value="Sir">Sir</option>
                                                        <option value="Dr.">Dr.</option>
                                                    </select>
                                                </div>
                                            </div>                                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Full Name</label>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="first_name" placeholder="First Name"aria-describedby="helpId" >
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" aria-describedby="helpId" >
                                                </div>
                                            </div>                                                    
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <textarea type="text" class="form-control" name="address_1"
                                                        aria-describedby="helpId" placeholder="Enter Address"></textarea>
                                                        <small class="text-danger">Street Address/City/State/Providence</small>
                                                </div>
                                                <div class="col-lg-6">
                                                    <textarea type="text" class="form-control" name="address_2"
                                                        aria-describedby="helpId" placeholder="Enter Address Line 2"></textarea>
                                                        <small class="text-danger">Street Address/City/State/Providence</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="">Phone Number</label>
                                                    <input type="tel" class="form-control" name="phone_number" placeholder="Phone Number" aria-describedby="helpId" >
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="">E-mail Address</label>
                                                    <input type="text" class="form-control" name="email" placeholder="E-mail Address" aria-describedby="helpId" >
                                                </div>
                                            </div>                                                    
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="">Occupation</label>
                                                    <input type="text" class="form-control" name="occupation" placeholder="Occupation" aria-describedby="helpId" >    
                                                </div>                                           
                                                <div class="col-lg-6">
                                                    <label for="">Business Section</label>
                                                    <select class="form-control" name="section">
                                                        <option value="">--Select Section--</option>
                                                        <option>Transport</option>
                                                        <option>Logistics</option>
                                                        <option>Finance</option>
                                                        <option>Agriculture</option>
                                                    </select>
                                                </div>  
                                            </div>                                                
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success float-right">Create</button>
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