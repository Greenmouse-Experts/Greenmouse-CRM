<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!-- Counter - Alerts -->
                <span style="margin-right: 25px; color: #000;">
                    <span class="clock">
                        {{ \Carbon\Carbon::now()->format('d F Y') }} |
                    </span>
                    <span id="localclock" class="clock"></span>
                </span>
            </a>
            <!-- Dropdown - Alerts -->
        </li>

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                <img class="img-profile rounded-circle" src="{{URL::asset('assets/img/avatar.png')}}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                <a class="dropdown-item" href="{{route('account')}}">
                    <i class="fas fa-fw fa-wrench fa-sm fa-fw mr-2 text-gray-400"></i>
                    My Account
                </a>
                <button class="dropdown-item" data-toggle="modal" data-target="#calculator-modal">
                    <i class="fas fa-fw fa-calculator fa-sm fa-fw mr-2 text-gray-400"></i>
                    Calculator
                </button>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>

    </ul>

</nav>

<div id="calculator-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xs" role="document">
        <div class="modal-content" style="background-color: transparent !important; border: none !important">
            <div class="modal-body">
                <div id="calculator">
                    <p id="last_operation_history"></p>
                    <p id="box" class="box">0</p>
                    <table id="table">
                        <tr>
                            <td><button onclick="calculate_percentage()">%</button></td>
                            <td><button onclick="clear_entry()">CE</button></td>
                            <td><button onclick="button_clear()">C</button></td>
                            <td><button id="backspace_btn" onclick="backspace_remove()"></button></td>
                        </tr>
                        <tr>
                            <td><button onclick="division_one()">¹∕ₓ</button></td>
                            <td><button onclick="power_of()">𝑥²</button></td>
                            <td><button onclick="square_root()">√𝑥</button></td>
                            <td><button id="plusOp" value="+" class="operator" onclick="button_number('+')">+</button></td>
                        </tr>
                        <tr>
                            <td><button onclick="button_number(7)">7</button></td>
                            <td><button onclick="button_number(8)">8</button></td>
                            <td><button onclick="button_number(9)">9</button></td>
                            <td><button id="subOp" value="-" class="operator" onclick="button_number('-')">-</button></td>
                        </tr>
                        <tr>
                            <td><button onclick="button_number(4)">4</button></td>
                            <td><button onclick="button_number(5)">5</button></td>
                            <td><button onclick="button_number(6)">6</button></td>
                            <td><button id="multiOp" value="*" class="operator" onclick="button_number('*')">×</button></td>
                        </tr>
                        <tr>
                            <td><button onclick="button_number(1)">1</button></td>
                            <td><button onclick="button_number(2)">2</button></td>
                            <td><button onclick="button_number(3)">3</button></td>
                            <td><button id="divOp" value="/" class="operator" onclick="button_number('/')">÷</button></td>
                        </tr>
                        <tr>
                            <td><button onclick="plus_minus()">±</button></td>
                            <td><button onclick="button_number(0)">0</button></td>
                            <td><button id="dot" value="." onclick="button_number('.')">.</button></td>
                            <td colspan="4"><button value="=" class="operator" id="equal_sign" onclick="button_number('=')">=</button></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{URL::asset('assets/js/calculator.js')}}"></script>
<style>
    #calculator {
        width: auto;
        height: auto;
        padding: 1.5vh;
        border: 5px solid #666666;
        border-radius: 15px;
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        background: #0f1506;
    }

    .box {
        text-align: right;
        font-size: 2.8vh;
        height: 3vh;
        line-height: 3vh;
        padding: 1em;
        border: 2px solid #e68a00;
        color: white;
        border-radius: 15px;
        background-color: black;
    }

    #last_operation_history {
        height: 1.8vh;
        font-size: 1.8vh;
        text-align: right;
        padding-right: 1.5vh;
        color: rgb(177, 176, 176);
        background-color: black;
    }

    #table button {
        width: 9vh;
        height: 9vh;
        font-weight: bold;
        font-size: 3vh;
        color: white;
        background-color: #666666;
        border-radius: 50%;
        border: 1px solid #333333;
    }

    #backspace_btn {
        background-image: url("../assets/img/back_remove.png");
        background-repeat: no-repeat;
        background-position: 50% 50%;
        background-size: 1.7em;
    }

    #table button:hover {
        background-color: #999999;
    }

    #table .operator {
        background-color: rgb(58 86 20);
    }

    #table .operator:hover {
        background-color: #73aa22;
    }

    #equal_sign {
        width: 100%;
        border-radius: 15px;
    }
</style>