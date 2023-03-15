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
                            <span class="m-0 font-weight-bold text-primary">Salary Structure</span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Full Name</th>
                                            <th>Role</th>
                                            <th>Salary</th>
                                            <th>Date Added</th>
                                            <th style="width:5%">Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($salaries as $salary)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{App\Models\Employee::find($salary->employee_id)->last_name}} {{App\Models\Employee::find($salary->employee_id)->first_name}} {{App\Models\Employee::find($salary->employee_id)->middle_name}}
                                                <p>{{App\Models\Employee::find($salary->employee_id)->email}}</p>
                                            </td>
                                            <td>{{App\Models\Role::find(App\Models\Employee::find($salary->employee_id)->role)->name}}</td>
                                            <td>₦{{number_format($salary->salary,2)}}</td>
                                            <td>{{$salary->created_at->toDayDateTimeString()}}</td>
                                            <td class="text-center">  
                                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-modal-{{$salary->id}}"><i class="fas fa-edit"></i> </button>

                                                <div id="edit-modal-{{$salary->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title" id="my-modal-title">Edit Salary</h5>
                                                                <button class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('update.role', Crypt::encrypt($salary->id)) }}">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group text-left">
                                                                                <label for="my-select">Salary</label>
                                                                                <input type="text" class="form-control" name="name" value="{{$salary->salary}}">
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
                                </table>
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