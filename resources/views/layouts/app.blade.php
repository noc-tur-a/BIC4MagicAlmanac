<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
    <link rel="manifest" href="/mix-manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ route('welcome') }}">
                <img src="{{asset('img/happy_unicorn_LOGO2.png')}}" width="112" height="28" style="border:solid #000; border-width: 1px 0px;">
            </a>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
               data-target="navbarMain">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarMain" class="navbar-menu">
            @auth
                <div class="navbar-start">
                    <a class="navbar-item {{ request()->routeIs('home') ? 'is-active' : '' }}"
                       href="{{ route('home') }}">
                        Home
                    </a>

                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link {{ request()->routeIs('spell.index') || request()->routeIs('spell.create') || request()->routeIs('spell.search') ? 'is-active' : '' }}">
                            Spells
                        </a>

                        <div class="navbar-dropdown">
                            <a class="navbar-item {{ request()->routeIs('spell.index') ? 'is-active' : '' }}"
                               href="{{ route('spell.index') }}">
                                List
                            </a>
                            <a class="navbar-item {{ request()->routeIs('spell.create') ? 'is-active' : '' }}"
                               href="{{ route('spell.create') }}">
                                Create
                            </a>
                            <hr class="navbar-divider">
                            <a class="navbar-item {{ request()->routeIs('spell.search') ? 'is-active' : '' }}"
                               href="{{ route('spell.search') }}">
                                Search
                            </a>
                        </div>
                    </div>

                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link {{ request()->routeIs('kind.index') || request()->routeIs('kind.create') ? 'is-active' : '' }}">
                            Kinds
                        </a>

                        <div class="navbar-dropdown">
                            <a class="navbar-item {{ request()->routeIs('kind.index') ? 'is-active' : '' }}"
                               href="{{ route('kind.index') }}">
                                List
                            </a>
                            <a class="navbar-item {{ request()->routeIs('kind.create') ? 'is-active' : '' }}"
                               href="{{ route('kind.create') }}">
                                Create
                            </a>
                        </div>
                    </div>

                </div>
            @endauth

            <div class="navbar-end">
                @guest
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                <a class="button is-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="navbar-dropdown is-right">
                            <a class="navbar-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    <div class="main is-fullheight">
        @yield('content')
    </div>

    <footer class="footer" style="background-color: /*#00b89c*/  whitesmoke; height: 94px;">
        <div class="content has-text-centered">
            <img src="{{asset('img/happy_unicorn_64.png')}}" width="41" height="64" alt="Happy Unicorn Logo">
            {{--<small style="margin-bottom: 40px;">A Happy Unicorn presentation</small>--}}
        </div>
    </footer>
</div>
</body>
</html>
