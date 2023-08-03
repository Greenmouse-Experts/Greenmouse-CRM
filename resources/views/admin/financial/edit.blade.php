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
                    <h1><i class="fa fa-list-alt"></i> Edit Debtors</h1>
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
                        </div>
                        
                        <div class="card-body">
                            <form method="POST" action="{{route('update.invoice', Crypt::encrypt($invoice->id))}}">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Customer Name</label>
                                        <input name="name" class="form-control" value="{{$invoice->name}}" type="text" placeholder="Enter customer name" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Customer Email Address</label>
                                        <input name="email" class="form-control" value="{{$invoice->email}}" type="text" placeholder="Enter customer email">
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
                                            @foreach($sales as $sale)
                                            <tr>
                                                <td><select name="product_id[]" class="form-control productname" required>
                                                        <option name="product_id[]" value="{{$sale->product_id}}">{{$sale->product->product_name}}</option>
                                                        <option value="">Select Product</option>
                                                        @foreach($products as $product)
                                                        <option name="product_id[]" value="{{$product->id}}">{{$product->product_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="number" name="qty[]" class="form-control qty" value="{{$sale->quantity}}" required></td>
                                                <td><input type="number" name="price[]" class="form-control price" value="{{$sale->price}}" required></td>
                                                <td><input type="number" name="amount[]" class="form-control amount" value="{{$sale->amount}}" required></td>
                                                <td><a href="#" class="btn btn-danger text-white removeRow"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                            @endforeach
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
                                        <button class="btn btn-success" type="submit">Update</button>
                                    </div>
                                </div>
                            </form>
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