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
    <link href="{{ asset('css/website/index.css') }}" rel="stylesheet">
    <link href="{{ asset('css/website/navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/website.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbarTop">
        <div class="containerLg">
            <ul class="navbarNavigation">
                <li class="navbarLogo">
                    <a href="{{ url('/') }}">{{ config('app.name', 'Stujobs') }}<span class="beta">beta</span></a>
                </li>
                <li class="navbarMenu">
                    @guest
                        <span class="navbarSpan">Vous êtes recruteur ? <a href="{{ route('login') }}">Connectez-vous</a></span>
                    @else
                        <span class="navbarSpan navbarDropdownAction">
                            {{ Auth::user()->email }} <span class="caret noRotate"></span>
                        </span>
                        <div class="navbarDropdownMenu hideDropdown">
                            <ul class="dropdownMenu">
                                @if ( Auth::user()->role == 'admin' ||  Auth::user()->role == 'superadmin' )
                                    <li class="dropdownMenuItem">
                                        <a href="{{ route('dashboardIndex') }}"><i class="fa fa-tachometer"></i><span class="dropdownSubtitle">Dashboard</span></a>
                                    </li>
                                    <li class="dropdownMenuItem">
                                        <a href="{{ route('dashboardIndexProfile') }}"><i class="fa fa-user"></i><span class="dropdownSubtitle">Mon profil</span></a>
                                    </li>
                                @endif
                                @if ( Auth::user()->role == 'company')
                                    <li class="dropdownMenuItem">
                                        <a href="{{ route('indexProfile') }}"><i class="fa fa-user"></i><span class="dropdownSubtitle">Mon profil</span></a>
                                    </li>
                                    <li class="dropdownMenuItem">
                                        <a href="{{ route('indexOffers') }}"><i class="fa fa-briefcase"></i><span class="dropdownSubtitle">Mes offres d'emploi</span></a>
                                    </li>
                                @endif
                                <li class="dropdownMenuItem">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i><span class="dropdownSubtitle">Déconnexion</span></a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    @endguest
                </li>
                <!-- Mobile menu -->
                <li class="navMobile">
                    <div class="toggleMenu mobileMenuAction">
                        <i class="fa fa-bars"></i>
                    </div>
                    <div class="popupMenu hideMenu">
                        <div class="closeMenu mobileMenuAction">
                            <i class="fa fa-times"></i>
                        </div>
                        <div class="popupMenuTitle">
                            @guest
                            <h3>Vous êtes recruteur ?</h3>
                            @endguest
                        </div>
                        <ul class="menuActionsList">
                            @guest
                                <li class="menuActionsItem">
                                    <a href="{{ route('login') }}"><i class="fa fa-sign-in"></i><p class="menuSubtitle">Connectez-vous</p></a>
                                </li>
                                <li class="menuActionsItem">
                                    <a href="{{ route('register') }}"><i class="fa fa-user-plus"></i><p class="menuSubtitle">Inscrivez-vous</p></a>
                                </li>
                            @else
                                @if ( Auth::user()->role == 'admin' ||  Auth::user()->role == 'superadmin' )
                                    <li class="menuActionsItem">
                                        <a href="{{ route('dashboardIndex') }}"><i class="fa fa-tachometer"></i><p class="menuSubtitle">Dashboard</p></a>
                                    </li>
                                    <li class="menuActionsItem">
                                        <a href="{{ route('dashboardIndexProfile') }}"><i class="fa fa-user"></i><p class="menuSubtitle">Mon profil</p></a>
                                    </li>
                                @endif
                                @if ( Auth::user()->role == 'company')
                                    <li class="menuActionsItem">
                                        <a href="{{ route('indexProfile') }}"><i class="fa fa-user"></i><p class="menuSubtitle">Mon profil</p></a>
                                    </li>
                                    <li class="menuActionsItem">
                                        <a href="{{ route('indexOffers') }}"><i class="fa fa-briefcase"></i><p class="menuSubtitle">Mes offres</p></a>
                                    </li>
                                @endif
                                <li class="menuActionsItem">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i><p class="menuSubtitle">Déconnexion</p></a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endguest
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <main class="py-4">
        <div id="alerts"></div>
        <div id="alertsBack">
            @if (\Session::has('error'))
                <div class="alert alert-danger">
                    {!! \Session::get('error') !!}
                </div>
            @endif
        </div>
        @yield('content')
    </main>
</div>

<!-- Scripts -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/website/navbar.js') }}"></script>
<script src="{{ asset('js/website/global.js') }}"></script>
<script src="{{ asset('js/website/profile.js') }}"></script>
<script src="{{ asset('js/website/offers.js') }}"></script>
</body>
</html>
