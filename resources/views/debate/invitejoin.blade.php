<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Please wait...</title>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.7.2/jquery.min.js" ></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>

<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <!-- {{ config('app.name', 'Laravel') }} -->
                <img src = "{{ asset('img/logo.png') }}" class = "head-logo" alt = "{{ config('app.name', 'DebateFace') }}">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <a class = "nav-link" href = "{{ route('home') }}"> {{ __('Home') }} </a>
                    </li>
                    <li class="nav-item">
                        <a class = "nav-link" href = "{{ route('join') }}"> {{ __('Watch / Join a Debate') }} </a>
                    </li>
                    <li class="nav-item">
                        <a class = "nav-link" href = "{{ route('start') }}"> {{ __('Start a Debate') }} </a>
                    </li>
                    <li class="nav-item">
                        <a class = "nav-link" href = "{{ route('home') }}"> {{ __('About') }} </a>
                    </li>
                    <li class="nav-item">
                        <a class = "nav-link" href = "{{ route('home') }}"> {{ __('Contact Us') }} </a>
                    </li>
                    @if ( Auth::check() )
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            @if (Route::has('register'))
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <div class = "loadContainer">
                <img src = "{{ asset('img/loading.gif') }}" alt = "loading" >
                <div id = "redirectText"> You were invited to a debate. Redirecting in 10 seconds... </div>
            </div>
        </div>
    </main>
</div>

<script>

$(document).ready(function() {

    seconds = 10;
    timer = setInterval(function(){
                seconds --;
                $('#redirectText')[0].innerHTML = ' You were invited to a debate. Redirecting in ' + seconds + ' seconds... ';
                if( seconds <= 0)
                {
                    clearInterval( timer );
                    window.location = '/debate/' + "{{ $roomId }}" + '/' + "{{ base64_encode($password) }}";
                }    
            }, 1000);

});

</script>

</body>
</html>
