@extends('layout')

@section('subtitulo')

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand " href="{{ route('home') }}">
            <img src="/img/plain_white.png" alt="Logo" class="bg-dark" width="50" height="50">
            ImagineShirt
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                       aria-describedby="btnNavbarSearch"/>
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="/home">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Home
                        </a>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="/dashboard/charts">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a>
                        <a class="nav-link" href="/dashboard/tables">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Primary Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Warning Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Success Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Danger Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Area Chart Example
                        </div>
                        <div class="card-body">
                            <canvas id="myAreaChart" width="100%"
                                    height="40"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Bar Chart Example
                        </div>
                        <div class="card-body">
                            <canvas id="myBarChart" width="100%"
                                    height="40"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    @vite('resources/js/app.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="resources/demo/chart-area-demo.js"></script>
    <script src="resources/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    </body>

@endsection

{{--@extends('layout')--}}
{{--@section('title','Dashboard' )--}}
{{--@section('content')--}}
{{--    <div id="pop_div"></div>--}}
{{--    <div class="col-sm-7 col-md-10">--}}
{{--        <div class="row">--}}
{{--            <div class="col-sm-6 col-md-4">--}}
{{--                <div id="chart-div"></div>--}}
{{--            </div>--}}
{{--            <div class="col-sm-6 col-md-5">--}}
{{--                <div id="poll_div"></div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    @areachart('Population', 'pop_div')--}}
{{--    @donutchart('IMDB', 'chart-div')--}}
{{--    @donutchart('Estampas', 'poll_div')--}}
{{--<div class="card mb-4">--}}
{{--    <div class="card-header">--}}
{{--        <i class="fas fa-table me-1"></i>--}}
{{--        DataTable Example--}}
{{--    </div>--}}
{{--    <div class="card-body">--}}
{{--        <table id="datatablesSimple">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th>Name</th>--}}
{{--                <th>Position</th>--}}
{{--                <th>Office</th>--}}
{{--                <th>Age</th>--}}
{{--                <th>Start date</th>--}}
{{--                <th>Salary</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tfoot>--}}
{{--            <tr>--}}
{{--                <th>Name</th>--}}
{{--                <th>Position</th>--}}
{{--                <th>Office</th>--}}
{{--                <th>Age</th>--}}
{{--                <th>Start date</th>--}}
{{--                <th>Salary</th>--}}
{{--            </tr>--}}
{{--            </tfoot>--}}
{{--            <tbody>--}}
{{--            <tr>--}}
{{--                <td>Tiger Nixon</td>--}}
{{--                <td>System Architect</td>--}}
{{--                <td>Edinburgh</td>--}}
{{--                <td>61</td>--}}
{{--                <td>2011/04/25</td>--}}
{{--                <td>$320,800</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td>Garrett Winters</td>--}}
{{--                <td>Accountant</td>--}}
{{--                <td>Tokyo</td>--}}
{{--                <td>63</td>--}}
{{--                <td>2011/07/25</td>--}}
{{--                <td>$170,750</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td>Ashton Cox</td>--}}
{{--                <td>Junior Technical Author</td>--}}
{{--                <td>San Francisco</td>--}}
{{--                <td>66</td>--}}
{{--                <td>2009/01/12</td>--}}
{{--                <td>$86,000</td>--}}
{{--            </tr>--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}
{{--    <footer class="py-4 bg-light mt-auto">--}}
{{--        <div class="container-fluid px-4">--}}
{{--            <div class="d-flex align-items-center justify-content-between small">--}}
{{--                <div class="text-muted">Copyright &copy; Your Website 2022</div>--}}
{{--                <div>--}}
{{--                    <a href="#">Privacy Policy</a>--}}
{{--                    &middot;--}}
{{--                    <a href="#">Terms &amp; Conditions</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </footer>--}}
{{--</div>--}}
{{--</div>--}}
{{--@endsection--}}


