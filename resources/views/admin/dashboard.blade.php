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
                    <h1><i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</h1>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                </ul>
            </div>
            
            <!-- DataTales Example -->
            <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Employees</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$employees}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-cubes fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Expenses</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">₦{{ number_format($expenses, 2)}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-retweet fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Incomes</div>
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">₦{{ number_format($incomes, 2)}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Products</div>
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$products}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-cubes fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Suppliers</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$suppliers}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-retweet fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Debtors</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">₦{{ number_format($debtors, 2)}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header bg-transparent">
                            <div class="d-flex align-items-center" style="justify-content: space-between;">
                                <div>
                                    <h6 class="mb-0">Incomes</h6>
                                </div>
                               <div style="justify-content: flex-end;">
                                    <form id="incomeYearForm" method="GET" action="{{ route('dashboard') }}">
                                        <label for="year">Select Year:</label>
                                        <select name="income_year" id="year" onchange="submitIncomeForm()">
                                            @for ($year = date('Y'); $year >= 2010; $year--)
                                                <option value="{{ $year }}"{{ $year == $selectedIncomeYear ? ' selected' : '' }}>{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="incomesChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header bg-transparent">
                            <div class="d-flex align-items-center" style="justify-content: space-between;">
                                <div>
                                    <h6 class="mb-0">Expenses</h6>
                                </div>
                               <div style="justify-content: flex-end;">
                                    <form id="ExpenseYearForm" method="GET" action="{{ route('dashboard') }}">
                                        <label for="year">Select Year:</label>
                                        <select name="expense_year" id="year" onchange="submitExpenseForm()">
                                            @for ($year = date('Y'); $year >= 2010; $year--)
                                                <option value="{{ $year }}"{{ $year == $selectedExpensesYear ? ' selected' : '' }}>{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="expenseChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-6 d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header bg-transparent">
                            <div class="d-flex align-items-center" style="justify-content: space-between;">
                                <div>
                                    <h6 class="mb-0">Products Categories</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="productChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header bg-transparent">
                            <div class="d-flex align-items-center" style="justify-content: space-between;">
                                <div>
                                    <h6 class="mb-0">Debtors</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id=""></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header bg-transparent">
                            <div class="d-flex align-items-center" style="justify-content: space-between;">
                                <div>
                                    <h6 class="mb-0">Debtors</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="debtorHorizontalBarChart"></canvas>
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
<script src="{{URL::asset('assets/plugins/chartjs/js/chart.js')}}"></script>
<script src="{{URL::asset('assets/plugins/chartjs/js/chartjs-custom.js')}}"></script>
<script src="{{URL::asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/apexcharts-bundle/js/apex-custom.js')}}"></script>
<style>
    #incomesChart {
        /* height: 500px !important;  */
    }
</style>
<script>
    function submitIncomeForm() {
        document.getElementById('incomeYearForm').submit();
    }

    function submitExpenseForm() {
        document.getElementById('ExpenseYearForm').submit();
    }
    
    var incomeChart = document.getElementById('incomesChart').getContext('2d');
    var ic = @json($incomesChart);
    var incomemonths = ic.map(item => getMonthName(item.month)); // Map numeric months to month names
    var incomeamounts = ic.map(item => parseFloat(item.total_amount));

    function getMonthName(month) {
        const monthNames = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        return monthNames[month - 1]; // Adjust index
    }

    var chart1 = new Chart(incomeChart, {
        type: 'bar',
        data: {
            labels: incomemonths,
            datasets: [{
                label: 'Monthly Incomes for '+{{$selectedIncomeYear}},
                data: incomeamounts,
                backgroundColor: 'rgba(137, 194, 57, 0.2)', // Bar color
                borderColor: 'rgba(137, 194, 57, 1)', // Border color
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var expenseChart = document.getElementById('expenseChart').getContext('2d');
    var ec = @json($expensesChart);
    var expensemonths = ec.map(item => getMonthName(item.month)); // Map numeric months to month names
    var expenseamounts = ec.map(item => parseFloat(item.total_amount));

    function getMonthName(month) {
        const monthNames = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        return monthNames[month - 1]; // Adjust index
    }

    var chart2 = new Chart(expenseChart, {
        type: 'bar',
        data: {
            labels: expensemonths,
            datasets: [{
                label: 'Monthly Expenses for '+{{$selectedExpensesYear}},
                data: expenseamounts,
                backgroundColor: 'rgba(137, 194, 57, 0.2)', // Bar color
                borderColor: 'rgba(137, 194, 57, 1)', // Border color
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var productChart = document.getElementById('productChart').getContext('2d');
    var productsByCategory = @json($productsByCategory);

    var labelsProduct = productsByCategory.map(item => item.category);
    var dataProduct = productsByCategory.map(item => item.total_quantity); // Replace with your metric

    // Generate random background colors
    var backgroundColors = [];
    for (var i = 0; i < labelsProduct.length; i++) {
        var randomColor = '#' + Math.floor(Math.random()*16777215).toString(16);
        backgroundColors.push(randomColor);
    }

    var chart3 = new Chart(productChart, {
        type: 'pie',
        data: {
            labels: labelsProduct,
            datasets: [{
                data: dataProduct,
                backgroundColor: backgroundColors,
            }]
        }
    });

    var debtorChart = document.getElementById('debtorHorizontalBarChart').getContext('2d');
    var debtors = @json($debtorsChart);
    
    var debtorNames = debtors.map(debtor => debtor.client.first_name);
    var debtAmounts = debtors.map(debtor => debtor.amount_owned);

    var chart4 = new Chart(debtorChart, {
        type: 'bar',
        data: {
            labels: debtorNames,
            datasets: [{
                label: 'Debt Amount',
                data: debtAmounts,
                backgroundColor: backgroundColors,
            }]
        },
        options: {
            scales: {
                x: {
                    beginAtZero: true,
                }
            }
        }
    });
</script>
@endsection