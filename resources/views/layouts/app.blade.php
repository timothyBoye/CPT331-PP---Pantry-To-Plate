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
    <link rel="icon" href="{{ asset('favicon.ico') }}"/>
    <!--Generated from here: https://www.favicon-generator.org   -->
    <!--Need to check if background will be white or black with transparent png-->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('img/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
    <!--TBC: https://developer.apple.com/library/content/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html-->
</head>

<body>
<header>
    <!--Begin Horizontal Nav: https://getbootstrap.com/docs/3.3/components/#navbar-->
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
            <!--Need to resize the image so that it is responsive and or update the logo-->
                <a class="navbar-brand" href="{{ route('home') }}"><img style="	width: 120px;" src="{{ URL::asset('img/logo-one.png') }}" alt="Pantry to Plate Logo"></a>
            </div>


            <span>


            <!--Nav items on the left hand side-->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><span><a href="{{ route('home') }}" class="glyphicon glyphicon-home" aria-hidden="true"> Home</a></span></li>
                    <li><span><a href="{{ route('about') }}" class="glyphicon glyphicon-book" aria-hidden="true"> About</a></span></li>
                    <li><span><a href="{{ route('contact') }}" class="glyphicon glyphicon-envelope" aria-hidden="true"> Contact</a></span></li>
                </ul>

                <!--Nav items on the right hand side-->
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
<<<<<<< HEAD
                        <li><span><a href="{{ route('login') }}" class="glyphicon glyphicon-log-in" aria-hidden="true"> Login</a></span></li>
                        <li><span><a href="{{ route('register') }}" class="glyphicon glyphicon-user" aria-hidden="true"> Register</a></span></li>
=======
                        <li><a href="{{ route('login') }}" class="glyphicon glyphicon-log-in" aria-hidden="false"> Login</a></li>
                        <li> <a href="{{ route('register') }}" class="glyphicon glyphicon-user" aria-hidden="true"> Register</a></li>
>>>>>>> 762294c879f7c5dd8f6a759a593157d7a1d6ac1e
                    @else
                        {{--<a href="#"> Hi {{ Auth::user()->name }}</a>--}}
                        <li><span><a href="{{ route('profile.cuisines')}}" class="glyphicon glyphicon-cog" aria-hidden="true"> Manage Cuisine Preferences</a></span></li>
                        <li><span><form id="logout-form" action="{{ route('logout') }}" method="POST">
                                {{ csrf_field() }}
                            </form></span></li>
                        <li><span><a href="{{Route('profile.saved_recipes')}}" class="glyphicon glyphicon-bookmark" aria-hidden="true"> Saved Recipes</a></span></li>
                    @endif

                    @if (Auth::user())
                        <li><span><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="glyphicon glyphicon-log-out" aria-hidden="true"> Logout</a></span></li>
                        @if (Auth::user()->role->user_role_name == "Admin")
                            <li><span><a href="{{ route('admin') }}">Admin Dashboard</a></span></li>
                        @endif
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <!--End Horizontal Nav-->
</header>
    <div id="app">
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
    <script src="{{ asset('js/saveRecipeController.js') }}"></script>
    <script src="{{ asset('js/icheck-settings.js') }}"></script>
    <script src="{{ asset('js/contactForm.js') }}"></script>


    @yield('footer')
</body>
</html>
