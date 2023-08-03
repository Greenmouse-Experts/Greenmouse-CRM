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
                    <h1><i class="fa fa-list-alt"></i> Sales</h1>
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
                            <span class="m-0 font-weight-bold text-primary">Sales</span>

                            <div class="float-right" style="display: flex;">
                                <button type="button" class="btn btn-sm btn-success mr-3"> Total Sales: ₦{{number_format($sales->sum('amount'), 2)}}</button>
                                <a href="{{route('invoices')}}" class="btn btn-sm btn-success mr-3 text-white"> Invoices</a>
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-modal"><i class="fa fa-plus" aria-hidden="true"></i> Add Sale</button>
                            </div>

                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Product</th>
                                            <th>Invoice No.</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Amount</th>
                                            <th>Date of Payment</th>
                                            <th>Date Created</th>
                                            <th style="width:15%">Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sales as $sale)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                {{$sale->name}}
                                                {{$sale->email}}
                                            </td>
                                            <td>
                                                @if (App\Models\Product::where('id', $sale->product_id)->exists())
                                                {{App\Models\Product::find($sale->product_id)->product_name}}
                                                @else
                                                <b>{{ 'DELETED' }}</b>
                                                @endif
                                            </td>
                                            <td>
                                                @if (App\Models\Invoice::where('id', $sale->invoice_id)->exists())
                                                {{App\Models\Invoice::find($sale->invoice_id)->invoice_id}}
                                                @else
                                                <b>{{ 'DELETED' }}</b>
                                                @endif
                                            </td>
                                            <td>{{$sale->quantity}}</td>
                                            <td>₦{{number_format($sale->price, 2)}}</td>
                                            <td>₦{{number_format($sale->amount, 2)}}</td>
                                            <td>{{$sale->date_of_payment}}</td>
                                            <td>{{$sale->created_at->toDayDateTimeString()}}</td>
                                            <td class="text-center">
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-modal-{{$sale->id}}"><i class="fas fa-trash"></i> </button>

                                                <div id="delete-modal-{{$sale->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title" id="my-modal-title">Delete sale</h5>
                                                                <button class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('delete.sale', Crypt::encrypt($sale->id)) }}">
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
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="my-modal-title">Add Sales</h5>
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{route('add.sale')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label class="control-label">Customer Name</label>
                                            <input name="name" class="form-control" type="text" placeholder="Enter customer name" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="control-label">Customer Email Address</label>
                                            <input name="email" class="form-control" type="text" placeholder="Enter customer email">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="control-label">Date</label>
                                            <input name="date" class="form-control datepicker" value="<?php echo date('Y-m-d') ?>" type="date" placeholder="Enter date" required>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="tbSales" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col"><a class="addRow" style="cursor: pointer;"><i class="fa fa-plus"></i></a></th>
                                                </tr>
                                            </thead>
                                            <tbody class="tbody">
                                                <tr>
                                                    <td><select name="product_id[]" class="form-control productname" required>
                                                            <option value="">Select Product</option>
                                                            @foreach($products as $product)
                                                            <option name="product_id[]" value="{{$product->id}}">{{$product->product_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><input type="number" name="qty[]" class="form-control qty" required></td>
                                                    <td><input type="number" name="price[]" class="form-control price" required></td>
                                                    <td><input type="number" name="amount[]" class="form-control amount" required></td>
                                                    <td><a href="#" class="btn btn-danger text-white removeRow"><i class="fa fa-trash"></i></a></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td><b>Total</b></td>
                                                    <td><b class="total"></b></td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div>
                                            <button class="btn btn-success" type="submit">Submit</button>
                                        </div>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('.tbody').delegate('.productname', 'change', function() {
            var tr = $(this).parent().parent();
            tr.find('.qty').focus();
        })

        $('.tbody').delegate('.productname', 'change', function() {
            var tr = $(this).parent().parent();
            var id = tr.find('.productname').val();
            var dataId = {
                'id': id
            };
            $.ajax({
                type: 'GET',
                url: "{{route('find.price')}}",

                dataType: 'json',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    'id': id
                },
                success: function(data) {
                    tr.find('.price').val(data.price);
                }
            });
        });

        $('.tbody').delegate('.qty,.price', 'keyup', function() {
            var tr = $(this).parent().parent();
            var qty = tr.find('.qty').val();
            var price = tr.find('.price').val();
            var amount = (qty * price);
            tr.find('.amount').val(amount);
            total();
        });

        function total() {
            var total = 0;
            $('.amount').each(function(i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            })
            $('.total').html(total);
        }

        $('.addRow').on('click', function() {
            addRow();
        });

        function addRow() {
            var addRow = '<tr>\n' +
                '         <td><select name="product_id[]" class="form-control productname" required>\n' +
                '         <option value="0" selected="true" disabled="true">Select Product</option>\n' +
                '                                        @foreach($products as $product)\n' +
                '                                            <option value="{{$product->id}}">{{$product->product_name}}</option>\n' +
                '                                        @endforeach\n' +
                '               </select></td>\n' +
                '                                <td><input type="number" name="qty[]" class="form-control qty" required></td>\n' +
                '                                <td><input type="number" name="price[]" class="form-control price" required></td>\n' +
                '                                <td><input type="number" name="amount[]" class="form-control amount" required></td>\n' +
                '                                <td><a href="#" class="btn btn-danger text-white removeRow"><i class="fa fa-trash"></i></a></td>\n' +
                '                             </tr>';
            $('.tbody').append(addRow);
        };

        $("#tbSales").on('click', '.removeRow', function () {
            var l = $('.tbody tr').length;
            if(l == 1){
                alert('you cant delete last one')
            }else{
                $(this).parent().parent().remove();
            }
        });
    });
</script>
@endsection