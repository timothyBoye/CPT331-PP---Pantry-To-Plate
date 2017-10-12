<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Mobile Web App option: For installing to the home screen https://developer.apple.com/library/content/documentation/AppleApplications/Reference/SafariHTMLRef/Articles/MetaTags.html-->
    <meta name=”apple-mobile-web-app-capable” content=”yes”>
    <!--End Mobile Web App option-->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstro.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="{{ asset('css/icheck-line/green.css') }}" rel="stylesheet">
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">
    <!--Favicon-->
    <link rel="icon" href="favicon.ico"/>
    <!--Generated from here: https://www.favicon-generator.org   -->
    <!--Need to check if background will be white or black with transparent png-->
    <link rel="apple-touch-icon" sizes="57x57" href="/public/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/public/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/public/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/public/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/public/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/public/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/public/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/public/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/public/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/public/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/public/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/public/img/favicon/favicon-16x16.png">
    <!--TBC: https://developer.apple.com/library/content/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html-->
</head>

<header>
    <!--Begin Horizontal Nav: https://getbootstrap.com/docs/3.3/components/#navbar-->
    <!-- navbar-inverse if want black back-->
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!--Left hand logo area-->
                {{--<a class="navbar-brand" href="{{ route('home') }}">Pantry to Plate (Logo)</a>--}}
                <!--Inserting image works but needs to be style better. It's overflowing-->
                <a class="navbar-brand" href="{{ route('home') }}"><img style="	width: 120px;" src="{{ URL::asset('img/logo-one.png') }}" alt="Pantry to Plate Logo"></a>


            </div>

            <!--Nav items on the left hand side-->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>



                <!--Nav items on the right hand side-->
                <ul class="nav navbar-nav navbar-right">
                    <!--Default bootsrap items-->
                    {{--<li><a href="#">Register</a></li>--}}
                    {{--<li><a href="#">Login</a></li>--}}

                    <!--Imported from old navbar-->
                    @if (Auth::guest())
                       <li><a href="{{ route('login') }}">Login</a></li>
                       <li> <a href="{{ route('register') }}">Register</a></li>
                    @else
                        {{--<a href="#"> Hi {{ Auth::user()->name }}</a>--}}
                        <li><a href="{{ route('profile.cuisines')}}">Manage Cuisine Preferences</a></li>
                        <li><form id="logout-form" action="{{ route('logout') }}" method="POST">
                            {{ csrf_field() }}
                        </form></li>
                        <li><a href="#">Saved Recipes</a></li>
                    @endif

                    @if (Auth::user())
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                        @if (Auth::user()->role->user_role_name == "Admin")
                            <li><a href="{{ route('admin') }}">Admin Dashboard</a></li>
                    @endif
                @endif
                    <!--End of import of old nav bar-->
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <!--End Horizontal Nav-->
</header>



<body>
    <div id="app">
        {{--<div id="mySidenav" class="sidenav">--}}
            {{--<!-- Sidenav now uses burger to toggle between open/closed--}}
            {{--<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->--}}
            {{--<a href="{{ route('home') }}">Home</a>--}}
            {{--<!-- Authentication Links -->--}}
            {{--@if (Auth::guest())--}}
                {{--<a href="{{ route('login') }}">Login</a>--}}
                {{--<a href="{{ route('register') }}">Register</a>--}}
            {{--@else--}}
                {{--<a href="#"> Hi {{ Auth::user()->name }}</a>--}}
                {{--<a href="{{ route('profile.cuisines')}}">Manage Cuisine Preferences</a>--}}
                {{--<form id="logout-form" action="{{ route('logout') }}" method="POST">--}}
                    {{--{{ csrf_field() }}--}}
                {{--</form>--}}
                {{--<a href="#">Saved Recipes</a>--}}
            {{--@endif--}}
            {{--<a href="{{ route('about') }}">About</a>--}}
            {{--<a href="#">Contact</a>--}}
            {{--@if (Auth::user())--}}
                {{--<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">--}}
                    {{--Logout--}}
                {{--</a>--}}
                {{--@if (Auth::user()->role->user_role_name == "Admin")--}}
                    {{--<a href="{{ route('admin') }}">Admin Dashboard</a>--}}
                {{--@endif--}}
            {{--@endif--}}
        {{--</div>--}}

        {{--<!--Creates the nav bar and hamburger-->--}}
        {{--<div class="burger" onclick="toggleNav()">&#9776;</div>--}}
        {{--<div class="nav-long" >--}}
            {{--<span id="nav-logo-link">--}}
                {{--<a  href="{{ route('home') }}"><img src="{{ URL::asset('img/logo-one.png') }}" alt="Pantry to Plate Logo" id="logo-image"></a>--}}
            {{--</span>--}}
        {{--</div>--}}

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/sortable.js') }}"></script>
    <script src="{{ asset('js/jsCookie.js') }}"></script>
    <script src="{{ asset('js/csrf_init.js') }}"></script>
    <script src="{{ asset('js/storageService.js') }}"></script>
    <script src="{{ asset('js/bootstro.js') }}"></script>
    <script src="{{ asset('js/nav.js') }}"></script>
    <script src="{{ asset('js/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.icheck-field').each(function(){
                var self = $(this),
                    label = self.next(),
                    label_text = label.text();

                label.remove();
                self.iCheck({
                    checkboxClass: 'icheckbox_line-green',
                    radioClass: 'iradio_line-green',
                    insert: '<div class="icheck_line-icon"></div>' + label_text
                });
            });
        });
    </script>

    @yield('footer')
</body>
</html>
