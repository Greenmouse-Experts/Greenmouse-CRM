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
                            <span class="m-0 font-weight-bold text-primary">Products</span>

                            <div class="float-right">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-modal"><i class="fa fa-plus" aria-hidden="true"></i> Add Product</button>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Category</th>
                                            <th>Supplier</th>
                                            <th>Product Image</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Assigned To</th>
                                            <th>Price</th>
                                            <th>Date Added</th>
                                            <th style="width:5%">Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{\App\Models\Category::find($product->category_id)->name}}</td>
                                            <td>{{\App\Models\Supplier::find($product->supplier_id)->name}}
                                                <p>{{\App\Models\Supplier::find($product->supplier_id)->shopName}}</p>
                                            </td>
                                            <td>@if($product->product_image)
                                                <img src="{{$product->product_image}}" alt="{{$product->name}}" width="100" />
                                                @else
                                                null
                                                @endif
                                            </td>
                                            <td>{{$product->product_name}}</td>
                                            <td>{{$product->quantity}}</td>
                                            <td>{{App\Models\Employee::find($product->employee_id)->first_name}} {{App\Models\Employee::find($product->employee_id)->last_name}}</td>
                                            <td>₦{{number_format($product->price, 2)}}</td>
                                            <td>{{$product->created_at->toDayDateTimeString()}}</td>
                                            <td class="text-center">
                                                <a href="{{ route('view.product', Crypt::encrypt($product->id)) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> </a>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-modal-{{$product->id}}"><i class="fas fa-trash"></i> </button>

                                                <div id="delete-modal-{{$product->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title" id="my-modal-title">Delete Supplier</h5>
                                                                <button class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('delete.product', Crypt::encrypt($product->id)) }}">
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

                <div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="my-modal-title">Add Product</h5>
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('add.product') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="my-select">Category</label>
                                                <select class="form-control" name="category_id">
                                                    <option value="">--Select Category--</option>
                                                    @foreach(\App\Models\Category::latest()->get() as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="my-select">Supplier</label>
                                                <select class="form-control" name="supplier_id">
                                                    <option value="">--Select Supplier--</option>
                                                    @foreach(\App\Models\Supplier::latest()->get() as $supplier)
                                                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="my-select">Product Name</label>
                                                <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="my-select">Product Description</label>
                                                <textarea type="text" class="form-control" name="product_description" placeholder="Enter Product Description"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="my-select">Quantity</label>
                                                <input type="number" class="form-control" name="quantity" placeholder="Enter Quantity">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="my-select">Price</label>
                                                        <input type="number" class="form-control" name="price" placeholder="Enter Price">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="my-select">Employee</label>
                                                        <select class="form-control" name="employee_id">
                                                            <option value="">--Select Employee--</option>
                                                            @foreach(\App\Models\Employee::latest()->get() as $employee)
                                                            <option value="{{$employee->id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="my-select">Product Photo</label>
                                                <input type="file" class="form-control" name="photo" placeholder="Enter Product Photo">
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