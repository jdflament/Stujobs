<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard/sidebar.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <button type="button" id="sidebarCollapse" class="btn btn-light navbar-btn">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                        @guest
                        <li><a class="nav-link" href="{{ route('login') }}">Connexion</a></li>
                        <li><a class="nav-link" href="{{ route('register') }}">Inscription</a></li>
                        @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->email }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if ( Auth::user()->role == 'admin' ||  Auth::user()->role == 'superadmin' )
                                    <a class="dropdown-item" href="{{ route('dashboardIndex') }}">
                                        Dashboard
                                    </a>
                                    <a class="dropdown-item" href="{{ route('dashboardIndexProfile') }}">
                                        Mon Profil
                                    </a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Déconnexion
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @if ( Auth::user() )
        <nav id="sidebar" class="active">
            <!-- Sidebar Header -->
            <div class="sidebar-header">
                <h3><a href="{{ url('/') }}">{{ config('app.name', 'Stujobs') }} Panel</a></h3>
                <strong><a href="{{ url('/') }}">{{ config('app.short_name', 'STUJOBS PANEL') }}</a></strong>
            </div>

            <!-- Sidebar Links -->
            <ul class="list-unstyled components">
                <li class="{{ Request::path() == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('dashboardIndex') }}">
                        <i class="fa fa-compass"></i> Dashboard
                    </a>
                </li>
                @if ( Auth::user()->role == 'superadmin' )
                <li class="{{ strpos(Request::path(), 'admins') !== false ? 'active' : '' }}">
                    <a href="{{ route('dashboardIndexAdmins') }}">
                        <i class="fa fa-user"></i> Admins
                    </a>
                </li>
                @endif
                <li class="{{ strpos(Request::path(), 'companies') !== false ? 'active' : '' }}">
                    <a href="{{ route('dashboardIndexCompanies') }}">
                        <i class="fa fa-building"></i> Entreprises
                    </a>
                </li>
                <li class="{{ strpos(Request::path(), 'offers') !== false ? 'active' : '' }}" style="position: relative;">
                    <a href="{{ route('dashboardIndexOffers') }}">
                        <div class="totalOffersInvalid @if ($total < 1) hidden @endif">{{ $total }}</div>
                        <i class="fa fa-briefcase"></i> Offres
                    </a>
                </li>
            </ul>
        </nav>
        @endif

        <main class="py-4">
            <div id="alerts"></div>
            <div id="alertsBack">
                @if (\Session::has('error'))
                    <div class="alert alert-danger">
                        {!! \Session::get('error') !!}
                    </div>
                @endif
            </div>
            <div class="overlay"></div>
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script src="{{ asset('js/dashboard/admins.js') }}"></script>
    <script src="{{ asset('js/dashboard/sidebar.js') }}"></script>
    <script src="{{ asset('js/dashboard/companies.js') }}"></script>
    <script src="{{ asset('js/dashboard/offers.js') }}"></script>
    <script src="{{ asset('js/dashboard/profile.js') }}"></script>
    @yield('scripts')
</body>
</html>
