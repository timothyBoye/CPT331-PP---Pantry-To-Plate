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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <!-- Authentication Links -->
            @if (Auth::guest())
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @else
                <a href="#"> Hi {{ Auth::user()->name }}</a>

                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <a href="{{ route('profile.cuisines')}}">Manage Cuisine Preferences</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    {{ csrf_field() }}
                </form>
                <a href="#">Recipes</a>
            @endif
            <a href="#">About</a>
            <a href="#">Contact</a>
        </div>
        <div class = "nav-long"><span class = "burger" onclick="openNav()">&#9776;</span></div>

        @yield('content')
    </div>



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/sortable.js') }}"></script>
    <script src="{{ asset('js/jsCookie.js') }}"></script>
    <script src="{{ asset('js/csrf_init.js') }}"></script>
    <script src="{{ asset('js/storageService.js') }}"></script>
    <script src="{{ asset('js/nav.js') }}"></script>

    @yield('footer')
</body>
</html>
