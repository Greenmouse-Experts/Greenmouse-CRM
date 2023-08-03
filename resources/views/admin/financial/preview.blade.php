<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{config('app.name')}}</title>

    <!-- Custom fonts for this template -->
    <link href="{{URL::asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{URL::asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="{{URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- Syncfusion Essential JS 2 Styles -->
    <link rel="stylesheet" href="https://cdn.syncfusion.com/ej2/material.css" />
    <!-- Syncfusion Essential JS 2 Scripts -->
    <script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />

    <script type="text/javascript">
        window.setTimeout(function() {
            $(".alert-timeout").fadeTo(500, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 3000);

        $(document).ready(function() {
            $('#localclock').jsclock();
        });
    </script>

    <style>
        .calculator {
            border: 1px solid #ccc;
            border-radius: 5px;
            position: relative;
            /* top: 50%; */
            top: 16rem;
            left: 50%;
            transform: translate(-50%, -50%);
            /* width: 400px; */
        }

        .calculator-screen {
            width: 100%;
            height: 80px;
            border: none;
            background-color: #252525;
            color: #fff;
            text-align: right;
            padding-right: 20px;
            padding-left: 10px;
            font-size: 4rem;
        }

        .calculator-keys button {
            height: 60px;
            font-size: 2rem !important;
        }

        .percent-sign {
            height: 98%;
            grid-area: 2 / 4 / 6 / 5 !important;
        }

        .equal-sign {
            height: 98%;
            grid-area: 3 / 4 / 6 / 5;
        }

        .calculator-keys {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 20px;
            padding: 20px;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body id="page-top">
    <!-- Alerts  Start-->
    <div style="position: fixed; top: 20px; right: 20px; z-index: 100000; width: auto;">
        @include('layouts.alert')
    </div>
    <!-- Alerts End -->
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <span id="accordionSidebar">
            @includeIf('layouts.admin_sidebar')
        </span>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <span id="topBar">
                    @includeIf('layouts.admin_topbar')
                </span>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="invoice-box mt-5">
                        <table cellpadding="0" cellspacing="0">
                            <tr class="top">
                                <td colspan="4">
                                    <table>
                                        <tr>
                                            <td class="title">
                                                <img src="{{URL::asset('assets/img/greenmouse-logo.png')}}" style="width: 100%; max-width: 300px" />
                                            </td>

                                            <td>
                                                Invoice #: {{$invoice->invoice_id}}<br />
                                                Created: {{$invoice->created_at->toDayDateTimeString()}}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr class="information">
                                <td colspan="4">
                                    <table>
                                        <tr>
                                            <td>
                                                {{config('app.name')}}<br />
                                                Metalbox Road<br />
                                                Ogba-Ikeja, Lagos State
                                            </td>
                                            <td>
                                                {{$invoice->name}}<br />
                                                {{$invoice->email}}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr class="heading">
                                <td>Payment Method</td>
                                <td></td>
                                <td></td>
                                <td>Cash</td>
                            </tr>

                            <tr class="details">
                                <td>Cash</td>
                                <td></td>
                                <td></td>
                                <td>{{number_format($invoice->total, 2)}}</td>
                            </tr>

                            <tr class="heading">
                                <td>Item</td>
                                <td>Quantity</td>
                                <td>Price</td>
                                <td>Amount</td>
                            </tr>
                            @foreach($invoice->sale as $sale)
                            <tr class="item">
                                <td>{{$sale->product->product_name}}</td>
                                <td>{{$sale->quantity}}</td>
                                <td>₦{{number_format($sale->price, 2)}}</td>
                                <td>₦{{number_format($sale->amount, 2)}}</td>
                            </tr>
                            @endforeach

                            <tr class="heading">
                                <td></td>
                                <td></td>
                                <td>Total:</td>
                                <td>₦{{number_format($invoice->sale->sum('amount'), 2)}}</td>
                            </tr>
                        </table>
                        <div class="col-12 text-right mt-5">
                            <a id="print" class="btn btn-primary" href="javascript:window.print();" target="_blank">
                                <i class="fa fa-print"></i> Print
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script>
        $(function() {
            $("#datepicker").datepicker({
                dateFormat: "yy-mm-dd"
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.min.js" integrity="sha512-Bkf3qaV86NxX+7MyZnLPWNt0ZI7/OloMlRo8z8KPIEUXssbVwB1E0bWVeCvYHjnSPwh4uuqDryUnRdcUw6FoTg==" crossorigin="anonymous"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{URL::asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{URL::asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{URL::asset('assets/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{URL::asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{URL::asset('assets/js/demo/datatables-demo.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{URL::asset('assets/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{URL::asset('assets/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{URL::asset('assets/js/demo/chart-pie-demo.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="{{URL::asset('assets/js/jsclock-0.8.min.js') }}"></script>
    <script src="{{URL::asset('assets/js/calculator.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>

    <script>
        $("#print").click(function() {
            //Hide all other elements other than printarea.
            $('#print').css('display', 'none');
            $('#accordionSidebar').css('display', 'none');
            $('#topBar').css('display', 'none');
            $('.card-header').css('display', 'none');
            window.print();
            window.location.href = "{{route('preview.invoice', Crypt::encrypt($invoice->id))}}";
        });
    </script>
</body>

</html>