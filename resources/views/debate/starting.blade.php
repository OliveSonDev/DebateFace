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

<!-- Fonts -->
<link rel="dns-prefetch" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/6.4.0/adapter.min.js" ></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.7.2/jquery.min.js" ></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js" ></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.1.0/bootbox.min.js"></script>
<script type="text/javascript" src="{{ asset('js/janus.js') }}" ></script>

<link rel="stylesheet" href="{{ asset('css/demo.css') }}" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.css"/>
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
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            @if (Route::has('register'))
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </li>
                    @else
                        <li class="nav-item">
                            <a class = "nav-link" href = "{{ route('home') }}"> {{ __('Home') }} </a>
                        </li>
                        <li class="nav-item">
                            <a class = "nav-link" href = "{{ route('join') }}"> {{ __('Browse/Join a Debate') }} </a>
                        </li>
                        <li class="nav-item">
                            <a class = "nav-link" href = "{{ route('home') }}"> {{ __('Start a Debate') }} </a>
                        </li>
                        <li class="nav-item">
                            <a class = "nav-link" href = "{{ route('home') }}"> {{ __('About') }} </a>
                        </li>
                        <li class="nav-item">
                            <a class = "nav-link" href = "{{ route('home') }}"> {{ __('Contact Us') }} </a>
                        </li>
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
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <div class = "loadContainer">
                <img src = "{{ asset('img/loading.gif') }}" alt = "loading" >
                <div> Creating Debate ... Please wait... </div>
            </div>
        </div>
    </main>
</div>

<script>

var server = null;
if(window.location.protocol === 'http:')
    server = "http://" + window.location.hostname + ":8088/janus";
else
    server = "https://" + window.location.hostname + ":8089/janus";

var janus = null;
var sfutest = null;
var roomId = "{{ $roomId }}";
var opaqueId = "debate-" + roomId;

$(document).ready(function() {
    Janus.init({debug: "all", callback: function() {
        janus = new Janus({
            server: server,
            success: function() {
                // Attach to VideoRoom plugin
				janus.attach({
                    plugin: "janus.plugin.videoroom",
                    opaqueId: opaqueId,
                    success: function(pluginHandle) {
                        sfutest = pluginHandle;
                        
                        var create = { "request": "create", "room": parseInt(roomId), "description": "{{ $topic }}", "secret" : "{{ $adminkey }}", "pin" : "{{ $password }}"};
                        
                        sfutest.send(
                        {
                            "message": create,
                            success: function( msg ) {
                                var event = msg["videoroom"];
                                if( event != undefined && event != null )
                                    if ( event == "created" )
                                        window.location = '/debate/' + roomId + '/' + "{{ $password }}";
                                else
                                {
                                    alert( msg );
                                    window.location = '/home';
                                }
                            },
                            onmessage: function( msg, jsep ){
                                alert( msg );
                                window.location = '/home';
                            }
                        });
                    },
                    error: function(error) {
                        alert(error);
                        window.location = '/home';
                    },
                });
            },
            error: function(error) {
                alert(error);
                //window.location = '/home';
            },
            destroyed: function() {
                window.location.reload();
            }
        });
    }});
});

</script>

</body>
</html>
