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
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }} Admin Panel
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->email }} <span class="caret"></span>
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
                <h3><a href="{{ url('/') }}">{{ config('app.name', 'Stujobs') }}</a></h3>
                <strong><a href="{{ url('/') }}">{{ config('app.short_name', 'SJ') }}</a></strong>
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
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script src="{{ asset('js/dashboard/admins.js') }}"></script>
    <script src="{{ asset('js/dashboard/companies.js') }}"></script>
    <script src="{{ asset('js/dashboard/offers.js') }}"></script>
    <script src="{{ asset('js/dashboard/profile.js') }}"></script>
    @yield('scripts')
</body>
</html>
