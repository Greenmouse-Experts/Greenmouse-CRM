<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{config('app.name')}}</title>

    <style>

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
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="invoice-box mt-5">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="4">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="{{$logoUrl}}" style="width: 100%; max-width: 300px" />
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
                    <td>#{{number_format($sale->price, 2)}}</td>
                    <td>#{{number_format($sale->amount, 2)}}</td>
                </tr>
                @endforeach

                <tr class="heading">
                    <td></td>
                    <td></td>
                    <td>Total:</td>
                    <td>#{{number_format($invoice->sale->sum('amount'), 2)}}</td>
                </tr>
            </table>
        </div>
    </div>
    <!-- /.container-fluid -->
</body>

</html>