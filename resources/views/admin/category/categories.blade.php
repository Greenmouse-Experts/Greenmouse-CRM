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
                            <span class="m-0 font-weight-bold text-primary">Categories</span>

                            <div class="float-right">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-modal"><i class="fa fa-plus" aria-hidden="true"></i> Add Category</button>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Date Added</th>
                                            <th style="width:5%">Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $category)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$category->name}}</td>
                                            <td>{{$category->created_at->toDayDateTimeString()}}</td>
                                            <td class="text-center">  
                                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-modal-{{$category->id}}"><i class="fas fa-edit"></i> </button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-modal-{{$category->id}}"><i class="fas fa-trash"></i> </button>
                                                
                                                <div id="edit-modal-{{$category->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title" id="my-modal-title">Edit Category</h5>
                                                                <button class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('update.category', Crypt::encrypt($category->id)) }}">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group text-left">
                                                                                <label for="my-select">Category Name</label>
                                                                                <input type="text" class="form-control" name="name" value="{{$category->name}}"
                                                                                                    placeholder="Enter Category Name">
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

                                                <div id="delete-modal-{{$category->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title" id="my-modal-title">Delete Category</h5>
                                                                <button class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('delete.category', Crypt::encrypt($category->id)) }}">
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
                                <h5 class="modal-title" id="my-modal-title">Add Category</h5>
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('add.category') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="my-select">Category Name</label>
                                                <input type="text" class="form-control" name="name" 
                                                placeholder="Enter Category Name">
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