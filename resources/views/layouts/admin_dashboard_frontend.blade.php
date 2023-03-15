<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{config('app.name')}} | Admin Dashboard</title>

    <!-- Custom fonts for this template -->
    <link href="{{URL::asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{URL::asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- Syncfusion Essential JS 2 Styles -->
    <link rel="stylesheet" href="https://cdn.syncfusion.com/ej2/material.css" /> 
    <!-- Syncfusion Essential JS 2 Scripts -->
    <script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js"></script>

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
            font-size: 2rem!important;
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
        @includeIf('layouts.admin_sidebar')
        <!-- End Sidebar -->

        <!-- Page-Content -->
        @yield('page-content')
        <!-- End Page-Content -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script>
        $(function(){
            $("#datepicker").datepicker({
                dateFormat: "yy-mm-dd"
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.min.js" integrity="sha512-Bkf3qaV86NxX+7MyZnLPWNt0ZI7/OloMlRo8z8KPIEUXssbVwB1E0bWVeCvYHjnSPwh4uuqDryUnRdcUw6FoTg==" crossorigin="anonymous"></script>
    <script>
        var el = document.getElementById("dl");
        el.addEventListener("click", function() {
            var table = document.getElementById("dataTable");
            var wb = XLSX.utils.table_to_book(table, {
                sheet: "output"
            });
            var file = XLSX.writeFile(wb, "output.csv", {
                bookType: "csv",
                type: "base64"
            });

        });
    </script>
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

    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="{{URL::asset('assets/js/jsclock-0.8.min.js') }}"></script>
    <script src="{{URL::asset('assets/js/calculator.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel'
                ]
            });
        });

        function loadPreview(input) {
            var data = $(input)[0].files; //this file data
            $.each(data, function(index, file) {
                if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
                    var fRead = new FileReader();
                    fRead.onload = (function(file) {
                        return function(e) {
                            var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image thumb element
                            $('#thumb-output').append(img);
                        };
                    })(file);
                    fRead.readAsDataURL(file);
                }
            });
        }
    </script>
</body>

</html>