@extends('layouts.admin_dashboard_frontend')

@section('page-content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        @includeIf('layouts.admin_topbar')>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Content Row -->
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <span class="m-0 font-weight-bold text-primary">View/Edit {{$product->product_code}}</span>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update.product', Crypt::encrypt($product->id)) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    @if($product->product_image)
                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <label for="my-select">Product Image</label>
                                            </br>
                                            
                                            <img src="{{$product->product_image}}" alt="{{$product->name}}" width="100" />
                                            
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="my-select">Product Code</label>
                                            <input class="form-control" value="{{$product->product_code}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="my-select">Category</label>
                                            <select class="form-control" name="category_id">
                                                <option value="{{$product->category_id}}">{{\App\Models\Category::find($product->category_id)->name}}</option>
                                                <option>--Select Category--</option>
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
                                                <option value="{{$product->supplier_id}}">{{\App\Models\Supplier::find($product->supplier_id)->name}}</option>
                                                <option>--Select Supplier--</option>
                                                @foreach(\App\Models\Supplier::latest()->get() as $supplier)
                                                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="my-select">Product Name</label>
                                            <input type="text" class="form-control" name="product_name" value="{{$product->product_name}}" placeholder="Enter Product Name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="my-select">Product Description</label>
                                            <textarea type="text" class="form-control" name="product_description" value="{{$product->product_description}}" placeholder="Enter Product Description">{{$product->product_description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="my-select">Quantity</label>
                                            <input type="number" class="form-control" name="quantity" value="{{$product->quantity}}" placeholder="Enter Quantity">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="my-select">Price</label>
                                                    <input type="number" class="form-control" name="price" value="{{$product->price}}" placeholder="Enter Price">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="my-select">Weight</label>
                                                    <input type="text" class="form-control" name="weight" value="{{$product->weight}}" placeholder="Enter Weight">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="my-select">Product Photo</label>
                                            <input type="file" class="form-control" name="photo" value="{{$product->product_photo}}" placeholder="Enter Product Photo">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success float-right">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <span class="m-0 font-weight-bold text-danger">Supplier Details</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="text-center">
                                            @if(\App\Models\Supplier::find($product->supplier_id)->photo)
                                            <p class="mt-2">
                                                <img src="{{\App\Models\Supplier::find($product->supplier_id)->photo}}" alt="{{\App\Models\Supplier::find($product->supplier_id)->name}}" width="100" />
                                            </p>
                                            @endif
                                            <p class="mt-2">{{\App\Models\Supplier::find($product->supplier_id)->name}}</p>
                                            <p class="mt-2">{{\App\Models\Supplier::find($product->supplier_id)->email}}</p>
                                            <p class="mt-2">{{\App\Models\Supplier::find($product->supplier_id)->phone}}</p>
                                            <p class="mt-2">{{\App\Models\Supplier::find($product->supplier_id)->address}}</p>
                                            <p class="mt-2">{{\App\Models\Supplier::find($product->supplier_id)->shopName}}</p>
                                        </div>
                                    </div>
                                </div>
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