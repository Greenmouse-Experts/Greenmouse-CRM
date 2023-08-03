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
                    <h1><i class="fa fa-list-alt"></i> Debtors</h1>
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
                            <span class="m-0 font-weight-bold text-primary">Debtors</span>

                            <div class="float-right" style="display: flex;">
                                <button type="button" class="btn btn-sm btn-success mr-3"> Total Debtors: ₦{{number_format($debtors->sum('amount_owned'), 2)}}</button>
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-modal"><i class="fa fa-plus" aria-hidden="true"></i> Add Debtor</button>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Client</th>
                                            <th>Type</th>
                                            <th>Decription</th>
                                            <th>Amount</th>
                                            <th>Date Created</th>
                                            <th style="width:15%">Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($debtors as $debtor)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                {{\App\Models\Client::find($debtor->client_id)->first_name}} {{\App\Models\Client::find($debtor->client_id)->last_name}}
                                                <a href="{{ route('view.client.management', Crypt::encrypt($debtor->client_id))}}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> </a>
                                            </td>
                                            <td>{{$debtor->debt_type}}</td>
                                            <td>{{$debtor->debt_description}}</td>
                                            <td>₦{{number_format($debtor->amount_owned, 2)}}</td>
                                            <td>{{$debtor->created_at->toDayDateTimeString()}}</td>
                                            <td class="text-center">
                                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-modal-{{$debtor->id}}"><i class="fas fa-edit"></i> </button>
                                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#process-modal-{{$debtor->id}}"><i class="fa fa-cog"></i> </button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-modal-{{$debtor->id}}"><i class="fas fa-trash"></i> </button>

                                                <div id="edit-modal-{{$debtor->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title" id="my-modal-title">Edit Debtor</h5>
                                                                <button class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('update.debtor', Crypt::encrypt($debtor->id)) }}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="row text-left">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="my-select">Client</label>
                                                                                <select class="form-control" name="client_id">
                                                                                    <option value="{{$debtor->client_id}}">{{\App\Models\Client::find($debtor->client_id)->first_name}} {{\App\Models\Client::find($debtor->client_id)->last_name}}</option>
                                                                                    <option>--Select Client--</option>
                                                                                    @foreach(\App\Models\Client::latest()->get() as $client)
                                                                                    <option value="{{$client->id}}">{{$client->first_name}} {{$client->last_name}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="my-select">Debt Type</label>
                                                                                <input type="text" class="form-control" name="type" value="{{$debtor->debt_type}}" placeholder="Enter Type">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="my-select">Description</label>
                                                                                <textarea type="text" class="form-control" name="description" value="{{$debtor->debt_description}}" placeholder="Enter Description">{{$debtor->debt_description}}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="my-select">Amount Owed</label>
                                                                                <input type="number" class="form-control" name="amount" value="{{$debtor->amount_owned}}" placeholder="Enter Amount">
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

                                                <div id="process-modal-{{$debtor->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5>Process Debt</h5>
                                                                
                                                                <button class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><span class="text-danger">Note:</span> Actions carried out here is when the debt has been paid half or full payment. The amount will be deducted and posted to financial incomes.</p>
                                                                <form method="POST" action="{{ route('process.debtor', Crypt::encrypt($debtor->id)) }}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="row text-left">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="my-select">Client</label>
                                                                                <input type="text" class="form-control" value="{{\App\Models\Client::find($debtor->client_id)->first_name}} {{\App\Models\Client::find($debtor->client_id)->last_name}}" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="my-select">Debt Type</label>
                                                                                <input type="text" class="form-control" value="{{$debtor->debt_type}}" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="my-select">Description</label>
                                                                                <textarea type="text" class="form-control" value="{{$debtor->debt_description}}" readonly>{{$debtor->debt_description}}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="my-select">Amount Owed</label>
                                                                                <input type="number" class="form-control" value="{{$debtor->amount_owned}}" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="my-select">Amount Paid</label>
                                                                                <input type="number" class="form-control" name="amount" max="{{$debtor->amount_owned}}" placeholder="Enter Amount">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <button type="submit" name="submit_add_staff" class="btn btn-success float-right">Proccess</button>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="delete-modal-{{$debtor->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title" id="my-modal-title">Delete debtor</h5>
                                                                <button class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('delete.debtor', Crypt::encrypt($debtor->id)) }}">
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
@endsection