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
            <div class="app-title">
                <div>
                    <h1><i class="fa fa-list-alt"></i> Invoices</h1>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                </ul>
            </div>
            <!-- DataTales Example -->
            <div class="row">
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <span class="m-0 font-weight-bold text-primary">Invoices</span>

                            <div class="float-right" style="display: flex;">
                                <button type="button" class="btn btn-sm btn-success mr-3"> Total Invoices: ₦{{number_format($invoices->sum('total'), 2)}}</button>
                                <a href="{{route('sales')}}" class="btn btn-sm btn-success text-white">View Sales</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Invoice No</th>
                                            <th>Name</th>
                                            <th>Number of Sales</th>
                                            <th>Total</th>
                                            <th>Date Created</th>
                                            <th style="width:15%">Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($invoices as $invoice)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                {{$invoice->invoice_id}}
                                            </td>
                                            <td>{{$invoice->name}}</td>
                                            <td>
                                                @if (App\Models\Sale::where('invoice_id', $invoice->id)->exists())
                                                {{App\Models\Sale::where('invoice_id', $invoice->id)->get()->count()}}
                                                @else
                                                <b>{{ 'DELETED' }}</b>
                                                @endif
                                            </td>
                                            <td>₦{{number_format($invoice->total, 2)}}</td>
                                            <td>{{$invoice->created_at->toDayDateTimeString()}}</td>
                                            <td class="text-center">
                                                <a class="btn btn-success" href="{{route('preview.invoice', Crypt::encrypt($invoice->id))}}"><i class="fa fa-bandcamp" aria-hidden="true"></i></a>
                                                <a class="btn btn-success" href="{{route('edit.invoice', Crypt::encrypt($invoice->id))}}"><i class="fa fa-edit"></i></a>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-modal-{{$invoice->id}}"><i class="fas fa-trash"></i> </button>

                                                <div id="delete-modal-{{$invoice->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title" id="my-modal-title">Delete Invoice</h5>
                                                                <button class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('delete.invoice', Crypt::encrypt($invoice->id)) }}">
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
                                <h5 class="modal-title" id="my-modal-title">Add Debtor</h5>
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('add.debtor') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="my-select">Client</label>
                                                <select class="form-control" name="client_id">
                                                    <option value="">--Select Client--</option>
                                                    @foreach(\App\Models\Client::latest()->get() as $client)
                                                    <option value="{{$client->id}}">{{$client->first_name}} {{$client->last_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="my-select">Debt Type</label>
                                                <input type="text" class="form-control" name="type" placeholder="Enter Type">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="my-select">Description</label>
                                                <textarea type="text" class="form-control" name="description" placeholder="Enter Description"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="my-select">Amount Owed</label>
                                                <input type="number" class="form-control" name="amount" placeholder="Enter Amount">
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

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection