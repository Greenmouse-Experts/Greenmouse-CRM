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
                <div class="col-lg-6 mb-4">
                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h6 class="font-weight-bold text-primary">Profile</h6>
                        </div>
                        <div class="card-body">
                        <div class="text-left">
                        <form class="user"> 
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control form-control-user" value="{{Auth::user()->name}}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control form-control-user" value="{{Auth::user()->email}}" readonly>
                            </div>
                            <div class="form-group">
                                <label>User Type</label>
                                <input type="text" class="form-control form-control-user" value="{{Auth::user()->user_type}}" readonly>
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
                        <form class="user" method="POST" action="{{ route('change.password', Crypt::encrypt(Auth::user()->id)) }}">
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