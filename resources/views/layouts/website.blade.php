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
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    <link href="{{ asset('css/notification.css') }}" rel="stylesheet">
    <link href="{{ asset('css/website/website.css') }}" rel="stylesheet">
    <link href="{{ asset('css/website/filters.css') }}" rel="stylesheet">
    <link href="{{ asset('css/website/box_offer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/website/footer.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>

<?php
    if (Auth::user()) {
        if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin') {
            $admin = DB::table('users')->where('users.id', Auth::user()->id)
                ->leftJoin('admins', 'users.id', '=', 'admins.user_id')
                ->select('users.id', 'users.email', 'users.role', 'users.created_at', 'users.verified', 'admins.user_id', 'admins.firstname', 'admins.lastname', 'admins.phone', 'admins.office')
                ->get()
                ->first();

        } else if (Auth::user()->role == 'company') {
            $company = DB::table('users')->where('users.id', Auth::user()->id)
                ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
                ->select('users.id', 'users.email', 'users.role', 'users.created_at', 'users.verified', 'companies.user_id', 'companies.name', 'companies.siret', 'companies.phone', 'companies.address')
                ->get()
                ->first();
        }
    }
?>

<div id="app">
    <nav class="navbarTop">
        <div class="containerLg">
            <ul class="navbarNavigation">
                <li class="navbarLogo">
                    <a href="{{ url('/') }}">{{ config('app.name', 'Stujobs') }}<span class="beta">beta</span></a>
                </li>
                <li class="navbarMenu">
                    @guest
                        <span class="navbarSpan">Vous êtes recruteur ? <a href="{{ route('login') }}">Connectez-vous</a> ou <a href="{{ route('register') }}">Inscrivez-vous</a></span>
                    @else
                        <span class="navbarSpan navbarDropdownAction">
                            @if (isset($admin))
                                {{ $admin->firstname && $admin->lastname ? $admin->firstname . " " . $admin->lastname : $admin->email }} <span class="caret noRotate"></span>
                            @elseif (isset($company))
                                {{ $company->name ? $company->name : $company->email }} <span class="caret noRotate"></span>
                            @endif
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
                            @else
                                @if (isset($admin))
                                    <h3>{{ $admin->firstname }} {{ $admin->lastname }}</h3>
                                @elseif (isset($company))
                                    <h3>{{ $company->name }}</h3>
                                @endif
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
        @foreach (['danger', 'warning', 'success', 'info', 'status', 'message'] as $key)
            @if (session($key))
            <div class="notificationAlert {{ $key }}Alert showAlert">
                {{ session($key) }}<span aria-hidden="true">&times;</span>
            </div>
            @endif
        @endforeach

        @yield('content')
    </main>
</div>


<footer class="col-xs-12 footer">
    <div class="row footer-container">
        <div class="footer-left col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <p>Stujobs, tous droits réservés 2018</p>
        </div>
        <div class="footer-center col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <span class="smallText"><a id="newsletterButton" href="">Être alerté lors d’une nouvelle offre <i class="fa fa-arrow-right"></i></a></span>
        </div>
        <div class="footer-right col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <a href="">Plan du site</a>
            <a href="">Mentions légales</a>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('js/notification.js') }}"></script>
<script src="{{ asset('js/global.js') }}"></script>
<script src="{{ asset('js/navbar.js') }}"></script>
<script src="{{ asset('js/website/filters.js') }}"></script>
<script src="{{ asset('js/website/profile.js') }}"></script>
<script src="{{ asset('js/website/offers.js') }}"></script>
<script src="{{ asset('js/website/newsletter.js') }}"></script>
@yield('scripts')


</body>
</html>
