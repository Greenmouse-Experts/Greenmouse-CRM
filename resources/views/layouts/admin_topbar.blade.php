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
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="my-modal-title">Calculator</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="calculator card">

                    <input type="text" class="calculator-screen z-depth-1" value="" disabled />

                    <div class="calculator-keys">

                        <button type="button" class="operator btn btn-info" value="+">+</button>
                        <button type="button" class="operator btn btn-info" value="-">-</button>
                        <button type="button" class="operator btn btn-info" value="*">&times;</button>
                        <button type="button" class="operator btn btn-info" value="/">&divide;</button>

                        <button type="button" value="7" class="btn btn-light waves-effect">7</button>
                        <button type="button" value="8" class="btn btn-light waves-effect">8</button>
                        <button type="button" value="9" class="btn btn-light waves-effect">9</button>


                        <button type="button" value="4" class="btn btn-light waves-effect">4</button>
                        <button type="button" value="5" class="btn btn-light waves-effect">5</button>
                        <button type="button" value="6" class="btn btn-light waves-effect">6</button>


                        <button type="button" value="1" class="btn btn-light waves-effect">1</button>
                        <button type="button" value="2" class="btn btn-light waves-effect">2</button>
                        <button type="button" value="3" class="btn btn-light waves-effect">3</button>


                        <button type="button" value="0" class="btn btn-light waves-effect">0</button>
                        <button type="button" class="decimal function btn btn-secondary" value=".">.</button>
                        <button type="button" class="all-clear function btn btn-danger btn-sm" value="all-clear">AC</button>

                        <!-- <button type="button" class="percent-sign operator btn btn-info" value="%">&percnt;</button> -->
                        <button type="button" class="equal-sign operator btn btn-default" value="=">=</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>