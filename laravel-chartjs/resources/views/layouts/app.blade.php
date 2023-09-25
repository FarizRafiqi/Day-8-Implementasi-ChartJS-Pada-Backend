<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css"
          integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin=""/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
    @stack('header_scripts')
</head>

<body>
<nav class="navbar navbar-dark navbar-expand-lg sticky-top bg-dark flex-md-nowrap shadow p-0 mb-5">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 text-white py-3"
       href="#">Laravel ChartJS</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
            data-target="#sidebarMenu">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav ml-auto">
        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item text-nowrap">
                <a class="btn btn-dark" href="#" id="logoutBtn">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        @endguest
    </ul>
</nav>

<div class="container-fluid">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="sidebar-sticky pt-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <span data-feather="home"></span>
                        Dashboard
                    </a>
                </li>
                @if(strpos(Session::get('user_access'), 'barang_manage') !== false ||
                strpos(Session::get('user_access'),
                'order_manage') !== false)
                    @can('access', 'barang_manage')
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('barang.*') ? 'active' : '' }}"
                               href="{{ route('barang.index') }}">
                                <span data-feather="package"></span>
                                Barang
                            </a>
                        </li>
                    @endcan
                    @can('access', 'barang_manage')
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('orders.*') ? 'active' : '' }}"
                               href="{{ route('orders.index') }}">
                                <span data-feather="shopping-cart"></span>
                                Order
                            </a>
                        </li>
                    @endcan
                    @can('access', 'barang_manage')
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('minta.*') ? 'active' : '' }}"
                               href="{{ route('minta.index') }}">
                                <span data-feather="list"></span>
                                Permintaan Pembelian
                            </a>
                        </li>
                    @endcan
                @endif
                @if(strpos(Session::get('user_access'), 'access_group_manage') !== false ||
                strpos(Session::get('user_access'),
                'access_master_manage') !== false || strpos(Session::get('user_access'), 'users_manage') !== false)
                    @can('access', 'users_manage')
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('users.*') ? 'active' : '' }}"
                               href="{{ route('users.index') }}">
                                <span data-feather="users"></span>
                                Users
                            </a>
                        </li>
                    @endcan
                    @can('access', 'access_group_manage')
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('access_groups.*') ? 'active' : '' }}"
                               href="{{ route('access_groups.index') }}">
                                <span data-feather="bar-chart-2"></span>
                                Group Access
                            </a>
                        </li>
                    @endcan
                    @can('access', 'access_master_manage')
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('access_masters.*') ? 'active' : '' }}"
                               href="{{ route('access_masters.index') }}">
                                <span data-feather="layers"></span>
                                Access Master
                            </a>
                        </li>
                    @endcan
                @endif
            </ul>
        </div>
    </nav>

    <div class="{{ !Route::is(['login', 'register']) ? 'col-md-9 ml-sm-auto col-lg-10' : '' }} px-md-4">
        @yield('content')
    </div>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
        integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest.js"
        integrity="sha512-2AL/VEauKkZqQU9BHgnv48OhXcJPx9vdzxN1JrKDVc4FPU/MEE/BZ6d9l0mP7VmvLsjtYwqiYQpDskK9dG8KBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js"
        integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js">
</script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
</script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js">
</script>
@stack('scripts');
<script>
    /* globals feather:false */
    (function () {
        'use strict'

        feather.replace();

        $('#logoutBtn').on('click', (event) => {
            if (confirm('Yakin ingin keluar?') === true) {
                event.preventDefault();
                document.getElementById('logout-form').submit();
            }
        })
    })()
</script>
</body>
</html>
