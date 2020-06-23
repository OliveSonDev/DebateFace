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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/spin.js/2.3.2/spin.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.js"></script>
<script type="text/javascript" src="{{ asset('js/janus.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/sweetalert.min.js') }}" ></script>

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
            @if ( $usertype == 'moderator' ) 
                <div class = "row">
                    <div class = "col-md-3 offset-md-2">
                        <div class = "modCtrlDiv">
                            <div>
                                <div class = "modCtrlButtons">
                                    <div class = "modCtrlContainer">
                                        <div class = "text-center"> Mute </div>
                                        <div class = "modCtrlImgDiv" onclick = "mute('debator_one')">
                                            <img src = "{{ asset('img/mute.png') }}" class = "modCtrlImg" alt = "mute"> 
                                        </div>
                                    </div>
                                    <div class = "modCtrlContainer">
                                        <div class = "text-center"> Timer </div>
                                        <div class = "modCtrlImgDiv" onclick = "timelimit('one')">
                                            <img src = "{{ asset('img/timer.png') }}" class = "modCtrlImg" alt = "timer"> 
                                        </div>
                                    </div>
                                    <div class = "modCtrlContainer">
                                        <div class = "text-center"> Boot </div>
                                        <div class = "modCtrlImgDiv" onclick = "kick('one')">
                                            <img src = "{{ asset('img/boot.png') }}" class = "modCtrlImg" alt = "boot"> 
                                        </div>
                                    </div>
                                    <div class = "modCtrlContainer">
                                        <div class = "text-center"> Send Invite </div>
                                        <div class = "modCtrlImgDiv">
                                            <img src = "{{ asset('img/email.png') }}" class = "modCtrlImg" alt = "email"> 
                                        </div>
                                    </div>
                                </div>
                                <div class = "text-center mt-1"> <h4 id = "username_one"> User: <h4> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">Moderator<span class="label label-info hide" id="remote1"></span></h3>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-body relative videoContainer" id="moderator_container">
                                <video class="rounded centered" id="moderator" width="100%" height="100%" autoplay playsinline muted="muted"/>
                            </div>
                            <div class = "py-2"> <h5 class = "text-center"> Your Debate </h5> </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class = "modCtrlDiv">
                            <div>
                                <div class = "modCtrlButtons">
                                    <div class = "modCtrlContainer">
                                        <div class = "text-center"> Mute </div>
                                        <div class = "modCtrlImgDiv" onclick = "mute('debator_two')">
                                            <img src = "{{ asset('img/mute.png') }}" class = "modCtrlImg" alt = "mute"> 
                                        </div>
                                    </div>
                                    <div class = "modCtrlContainer">
                                        <div class = "text-center"> Timer </div>
                                        <div class = "modCtrlImgDiv" onclick = "timelimit('two')">
                                            <img src = "{{ asset('img/timer.png') }}" class = "modCtrlImg" alt = "timer"> 
                                        </div>
                                    </div>
                                    <div class = "modCtrlContainer">
                                        <div class = "text-center"> Boot </div>
                                        <div class = "modCtrlImgDiv" onclick = "kick('two')">
                                            <img src = "{{ asset('img/boot.png') }}" class = "modCtrlImg" alt = "boot"> 
                                        </div>
                                    </div>
                                    <div class = "modCtrlContainer">
                                        <div class = "text-center"> Send Invite </div>
                                        <div class = "modCtrlImgDiv">
                                            <img src = "{{ asset('img/email.png') }}" class = "modCtrlImg" alt = "email"> 
                                        </div>
                                    </div>
                                </div>
                                <div class = "text-center mt-1"> <h4 id = "username_two"> User: <h4> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "row">
                    <div class = "col-md-12 text-center py-4">
                        <div> <h2 class=""> Topic: {{ $debate->topic }} </h2> </div>
                        <div> <h5 class=""> Debate #: {{ $debate->id }} </h5> </div>
                    </div>
                </div>
                
                <div class = "row">
                    <div class="col-md-4 offset-md-2">
                        <div class="panel panel-default">
                            <div class="panel-body relative videoContainer" id="debator_one_container">
                                <video class="rounded centered" id="debator_one" width="100%" height="100%" autoplay playsinline muted="muted"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <div class="panel panel-default">
                            <div class="panel-body relative videoContainer" id="debator_two_container">
                                <video class="rounded centered" id="debator_two" width="100%" height="100%" autoplay playsinline muted="muted"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "row">
                    <div class = "col-md-4 offset-md-2">
                        <div class="modStatusContainer mt-2">
                            <div class = "text-center">
                                <div class = "modStatusCtrl">
                                    <img src = "{{ asset('img/upvote.png') }}" class = "modStatusImg" alt = "upvote">
                                </div>
                                <div class = "text-center"> {{ $debate->one_upvote }} </div>
                            </div>
                            <div class = "text-center">
                                <div class = "modStatusCtrl">
                                    <img src = "{{ asset('img/downvote.png') }}" class = "modStatusImg" alt = "downvote">
                                </div>
                                <div class = "text-center"> {{ $debate->one_downvote }} </div>
                            </div>
                            <div class = "text-center">
                                <div class = "modStatusCtrl">
                                    <img src = "{{ asset('img/heart.png') }}" class = "modStatusImg" alt = "heart">
                                </div>
                                <div class = "text-center"> {{ $debate->one_heart }} </div>
                            </div>
                            <div class = "text-center">
                                <div class = "modStatusCtrl">
                                    <img src = "{{ asset('img/sharp.png') }}" class = "modStatusImg" alt = "sharp">
                                </div>
                                <div class = "text-center"> {{ $debate->one_sharp }} </div>
                            </div>
                            <div class = "text-center text-middle"> <h4 id = "one_timelimit"> Time Left: Unlimited </h4> </div>
                        </div>
                    </div>
                    <div class = "col-md-4">
                        <div class="modStatusContainer mt-2">
                            <div class = "text-center">
                                <div class = "modStatusCtrl">
                                    <img src = "{{ asset('img/upvote.png') }}" class = "modStatusImg" alt = "upvote">
                                </div>
                                <div class = "text-center"> {{ $debate->two_upvote }} </div>
                            </div>
                            <div class = "text-center">
                                <div class = "modStatusCtrl">
                                    <img src = "{{ asset('img/downvote.png') }}" class = "modStatusImg" alt = "downvote">
                                </div>
                                <div class = "text-center"> {{ $debate->two_downvote }} </div>
                            </div>
                            <div class = "text-center">
                                <div class = "modStatusCtrl">
                                    <img src = "{{ asset('img/heart.png') }}" class = "modStatusImg" alt = "heart">
                                </div>
                                <div class = "text-center"> {{ $debate->two_heart }} </div>
                            </div>
                            <div class = "text-center">
                                <div class = "modStatusCtrl">
                                    <img src = "{{ asset('img/sharp.png') }}" class = "modStatusImg" alt = "sharp">
                                </div>
                                <div class = "text-center"> {{ $debate->two_sharp }} </div>
                            </div>
                            <div class = "text-center text-middle"> <h4 id = "two_timelimit"> Time Left: Unlimited </h4> </div>
                        </div>
                    </div>
                </div>
            @else
                <div class = "row">
                    <div class = "col-md-12 text-center py-4">
                        <div> <h2 class=""> Topic: {{ $debate->topic }} </h2> </div>
                    </div>
                </div>
                <div class = "row">
                    <div class="col-md-4 offset-md-2">
                        <div class="panel panel-default">
                            <div class="panel-body relative videoContainer" id="debator_one_container">
                                <video class="rounded centered" id="debator_one" width="100%" height="100%" autoplay playsinline muted="muted"/>
                            </div>
                        </div>
                        <div class = "modStatusContainer mt-1">
                            <div> <h4 id = "username_one"> User: <h4> </div>
                            <div> <h4 id = "one_timelimit"> Time left: Unlimited </h4> </div>
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <div class="panel panel-default">
                            <div class="panel-body relative videoContainer" id="debator_two_container">
                                <video class="rounded centered" id="debator_two" width="100%" height="100%" autoplay playsinline muted="muted"/>
                            </div>
                        </div>
                        <div class = "modStatusContainer mt-1">
                            <div> <h4 id = "username_two"> User: <h4> </div>
                            <div> <h4 id = "two_timelimit"> Time left: Unlimited </h4> </div>
                        </div>
                    </div>
                </div>
                <div class = "row mt-2">
                    <div class = "col-md-3 offset-md-2">
                        <div class = "modCtrlDiv">
                            <div class = "modStatusContainer">
                                <div class = "text-center">
                                    <div class = "modStatusCtrl">
                                        <img src = "{{ asset('img/upvote.png') }}" class = "modStatusImg" alt = "upvote">
                                    </div>
                                    <div class = "text-center"> {{ $debate->one_upvote }} </div>
                                </div>
                                <div class = "text-center">
                                    <div class = "modStatusCtrl">
                                        <img src = "{{ asset('img/downvote.png') }}" class = "modStatusImg" alt = "downvote">
                                    </div>
                                    <div class = "text-center"> {{ $debate->one_downvote }} </div>
                                </div>
                                <div class = "text-center">
                                    <div class = "modStatusCtrl">
                                        <img src = "{{ asset('img/heart.png') }}" class = "modStatusImg" alt = "heart">
                                    </div>
                                    <div class = "text-center"> {{ $debate->one_heart }} </div>
                                </div>
                                <div class = "text-center">
                                    <div class = "modStatusCtrl">
                                        <img src = "{{ asset('img/sharp.png') }}" class = "modStatusImg" alt = "sharp">
                                    </div>
                                    <div class = "text-center"> {{ $debate->one_sharp }} </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center">Moderator<span class="label label-info hide" id="remote1"></span></h3>
                            </div>
                            <div class="panel-body relative videoContainer" id="moderator_container">
                                <video class="rounded centered" id="moderator" width="100%" height="100%" autoplay playsinline muted="muted"/>
                            </div>
                            <div class = "mt-2 text-center"> <h5> Debate #: {{ $debate->id }} </h5> </div>
                        </div>
                    </div>
                    <div class = "col-md-3 ">
                        <div class = "modCtrlDiv">
                            <div class = "modStatusContainer">
                                <div class = "text-center">
                                    <div class = "modStatusCtrl">
                                        <img src = "{{ asset('img/upvote.png') }}" class = "modStatusImg" alt = "upvote">
                                    </div>
                                    <div class = "text-center"> {{ $debate->two_upvote }} </div>
                                </div>
                                <div class = "text-center">
                                    <div class = "modStatusCtrl">
                                        <img src = "{{ asset('img/downvote.png') }}" class = "modStatusImg" alt = "downvote">
                                    </div>
                                    <div class = "text-center"> {{ $debate->two_downvote }} </div>
                                </div>
                                <div class = "text-center">
                                    <div class = "modStatusCtrl">
                                        <img src = "{{ asset('img/heart.png') }}" class = "modStatusImg" alt = "heart">
                                    </div>
                                    <div class = "text-center"> {{ $debate->two_heart }} </div>
                                </div>
                                <div class = "text-center">
                                    <div class = "modStatusCtrl">
                                        <img src = "{{ asset('img/sharp.png') }}" class = "modStatusImg" alt = "sharp">
                                    </div>
                                    <div class = "text-center"> {{ $debate->two_sharp }} </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class = "row mt-4">
                <div class = "col-md-2 text-right">
                    <img src = "{{ asset('img/avatar.png') }}" alt = "commentAvatar" class = "commentAvatar">
                </div>
                <div class = "col-md-8">
                    <div class = "commentText"> User 1 Commented </div>
                </div>
            </div>
            <div class = "row">
                <div class = "col-md-2 text-right">
                    <img src = "{{ asset('img/avatar.png') }}" alt = "commentAvatar" class = "commentAvatar">
                </div>
                <div class = "col-md-8">
                    <div class = "commentText"> User 2 Commented </div>
                </div>
            </div>
            <div class = "row">
                <div class = "col-md-2 text-right">
                    Your Comment
                </div>
                <div class = "col-md-8">
                    <textarea class = "myCommentText">  </textarea>
                </div>
                <div class = "col-md-2 text-left">
                    <button class = "doCommentBtn">Send Comment</button>
                </div>
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
var username = "{{ $usertype }}";
var usertype;
var opaqueId = "debate-" + roomId;

var mystream = null;
var mypvtid = null;

var feeds = [];
var one_timelimit = "{{ $one_timelimit }}";
var two_timelimit = "{{ $two_timelimit }}";

if( username == 'moderator' || username == 'debator_one' || username == 'debator_two' )
    usertype = 'publisher';
else
    usertype = 'subscriber';

var publishStopper;

$(document).ready(function() {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    if( one_timelimit == 'unlimited' )
        $('#one_timelimit')[0].innerHTML = 'Time left: Unlimited';
    else if( one_timelimit == 0 )
        $('#one_timelimit')[0].innerHTML = 'Time left: 00:00';
    else if( one_timelimit > 0 )
    {
        setupTimeLimit('debator_one', one_timelimit);
        if( username == 'debator_one' )
        {
            toastr.warning('You have ' + one_timelimit + ' seconds to debate');
            if( publishStopper )
                clearTimeout(publishStopper);
            publishStopper = setTimeout(function(){ 
                var unpublish = { "request": "unpublish" };
                sfutest.send({"message": unpublish});
                toastr.warning('Time is out...');
                }, one_timelimit * 1000);
        }
    }

    if( two_timelimit == 'unlimited' )
        $('#two_timelimit')[0].innerHTML = 'Time left: Unlimited';
    else if( one_timelimit == 0 )
        $('#two_timelimit')[0].innerHTML = 'Time left: 00:00';
    else if( two_timelimit > 0 )
    {
        setupTimeLimit('debator_two', two_timelimit);
        if( username == 'debator_two' )
        {
            toastr.warning('You have ' + two_timelimit + ' seconds to debate');
            if( publishStopper )
                clearTimeout(publishStopper);
            publishStopper = setTimeout(function(){ 
                var unpublish = { "request": "unpublish" };
                sfutest.send({"message": unpublish});
                toastr.warning('Time is out...');
                }, two_timelimit * 1000);
        }
    }

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
                        
                        var register = { "request": "join", "room": parseInt(roomId), "ptype": "publisher", "display": username, "pin": "{{ $pin }}" };
                    
                        sfutest.send({"message": register});
                    },
                    mediaState: function(medium, on) {
                        Janus.log("Janus " + (on ? "started" : "stopped") + " receiving our " + medium);
                    },
                    webrtcState: function(on) {
                        Janus.log("Janus says our WebRTC PeerConnection is " + (on ? "up" : "down") + " now");
                        if(!on)
                            return;
                    },
                    onmessage: function(msg, jsep) {
                        var event = msg["videoroom"];
                        console.log(msg);

                        setUserName("one");
                        setUserName("two");

                        if(event != undefined && event != null) {
                            if(event === "joined") {
                                myid = msg["id"];
                                mypvtid = msg["private_id"];
                                Janus.log("Successfully joined room " + msg["room"] + " with ID " + myid);
                                if ( usertype == "publisher" )
                                    publishOwnFeed(true);
                                // Any new feed to attach to?
                                if(msg["publishers"] !== undefined && msg["publishers"] !== null) {
                                    var list = msg["publishers"];
                                    Janus.debug("Got a list of available publishers/feeds:");
                                    Janus.debug(list);
                                    console.log(list);
                                    for(var f in list) {
                                        if( list[f]["display"] != "subscriber" )
                                        {
                                            var id = list[f]["id"];
                                            var display = list[f]["display"];
                                            var audio = list[f]["audio_codec"];
                                            var video = list[f]["video_codec"];
                                            Janus.debug("  >> [" + id + "] " + display + " (audio: " + audio + ", video: " + video + ")");
                                            newRemoteFeed(id, display, audio, video);
                                            if( display == "moderator" )
                                                toastr.success('Moderator joined to the debate.');
                                            else if( display == "debator_one" )
                                                toastr.success('First debator joined to the debate.');
                                            else if( display == "debator_two" )
                                                toastr.success('Second debator joined to the debate.');
                                        }
                                    }
                                }
                            } else if(event === "destroyed") {
                                // The room has been destroyed
                                Janus.warn("The room has been destroyed!");
                                bootbox.alert("The room has been destroyed", function() {
                                    window.location.reload();
                                });
                            } else if(event === "event") {
                                // Any new feed to attach to?
                                if(msg["publishers"] !== undefined && msg["publishers"] !== null) {
                                    var list = msg["publishers"];
                                    Janus.debug("Got a list of available publishers/feeds:");
                                    Janus.debug(list);
                                    console.log(list);
                                    for(var f in list) {
                                        if( list[f]["display"] != "subscriber" )
                                        {
                                            var id = list[f]["id"];
                                            var display = list[f]["display"];
                                            var audio = list[f]["audio_codec"];
                                            var video = list[f]["video_codec"];
                                            Janus.debug("  >> [" + id + "] " + display + " (audio: " + audio + ", video: " + video + ")");
                                            newRemoteFeed(id, display, audio, video);
                                            if( display == "moderator" )
                                                toastr.success('Moderator joined to the debate.');
                                            else if( display == "debator_one" )
                                                toastr.success('First debator joined to the debate.');
                                            else if( display == "debator_two" )
                                                toastr.success('Second debator joined to the debate.');
                                        }
                                    }
                                } else if(msg["leaving"] !== undefined && msg["leaving"] !== null) {
                                    // One of the publishers has gone away?
                                    var leaving = msg["leaving"];
                                    Janus.log("Publisher left: " + leaving);
                                    if( leaving == "ok" && msg["reason"] == "kicked")
                                        swal("You were kicked.", { icon: "warning", });
                                    
                                    var remoteFeed = null;
                                    for( var i = 0; i < feeds.length; i ++ ) {
                                        if ( feeds[i] && feeds[i].rfid == msg["leaving"] )
                                        {
                                            console.log('here', feeds[i])
                                            if( feeds[i].display == "debator_one" )
                                                toastr.warning("First Debator leaved the room...");
                                            else if( feeds[i].display == "debator_two" )
                                                toastr.warning("Second Debator leaved the room...");
                                            remoteFeed = feeds[i];
                                            feeds.splice( i, 1 );
                                        }
                                    }
                                    if(remoteFeed != null) {
                                        Janus.debug("Feed " + remoteFeed.rfid + " (" + remoteFeed.rfdisplay + ") has left the room, detaching");
                                        $('#remote'+remoteFeed.rfindex).empty().hide();
                                        $('#videoremote'+remoteFeed.rfindex).empty();
                                        remoteFeed.detach();
                                    }
                                } else if(msg["unpublished"] !== undefined && msg["unpublished"] !== null) {
                                    // One of the publishers has unpublished?
                                    var unpublished = msg["unpublished"];
                                    Janus.log("Publisher left: " + unpublished);
                                    if(unpublished === 'ok') {
                                        // That's us
                                        sfutest.hangup();
                                        return;
                                    }
                                    var remoteFeed = null;
                                    for( var i = 0; i < feeds.length; i ++ ) {
                                        if ( feeds[i] && feeds[i].rfid == msg["leaving"] )
                                        {
                                            if( feeds[i].display == "debator_one" )
                                                toastr.warning("First Debator leaved the room...");
                                            else if( feeds[i].display == "debator_two" )
                                                toastr.warning("Second Debator leaved the room...");
                                            remoteFeed = feeds[i];
                                            feeds.splice( i, 1 );
                                        }
                                    }
                                    if(remoteFeed != null) {
                                        Janus.debug("Feed " + remoteFeed.rfid + " (" + remoteFeed.rfdisplay + ") has left the room, detaching");
                                        $('#remote'+remoteFeed.rfindex).empty().hide();
                                        $('#videoremote'+remoteFeed.rfindex).empty();
                                        remoteFeed.detach();
                                    }
                                } else if(msg["error"] !== undefined && msg["error"] !== null) {
                                    console.log('error');
                                    if(msg["error_code"] === 426) {
                                        toastr.error('This debate does not exist anymore...');
                                    } else {
                                        toastr.error(msg["error"]);
                                    }
                                }
                            }
                        }
                        if(jsep !== undefined && jsep !== null) {
                            Janus.debug("Handling SDP as well...");
                            Janus.debug(jsep);
                            sfutest.handleRemoteJsep({jsep: jsep});
                            // Check if any of the media we wanted to publish has
                            // been rejected (e.g., wrong or unsupported codec)
                            var audio = msg["audio_codec"];
                            if(mystream && mystream.getAudioTracks() && mystream.getAudioTracks().length > 0 && !audio) {
                                // Audio has been rejected
                                toastr.warning("Our audio stream has been rejected, viewers won't hear us");
                            }
                            var video = msg["video_codec"];
                            if(mystream && mystream.getVideoTracks() && mystream.getVideoTracks().length > 0 && !video) {
                                // Video has been rejected
                                toastr.warning("Our video stream has been rejected, viewers won't see us");
                            }
                        }
                    },
                    onlocalstream: function(stream) {
                        Janus.debug(" ::: Got a local stream :::");
                        mystream = stream;
                        Janus.debug(stream);
                        if( username == 'moderator' || username == 'debator_one' || username == 'debator_two' )
                        {
                            Janus.attachMediaStream($('#' + username).get(0), stream);
                            $("#" + username).get(0).muted = "muted";

                            var videoTracks = stream.getVideoTracks();
                            if(videoTracks === null || videoTracks === undefined || videoTracks.length === 0) {
                                alert('No Webcam !');
                            }
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    },
                });
            },
            error: function(error) {
                console.log(error);
            },
            destroyed: function() {
                window.location.reload();
            }
        });
    }});
});

function publishOwnFeed(useAudio) {
	// Publish our stream
    if( username == 'moderator' 
    || (username == 'debator_one' && ( one_timelimit == 'unlimited' || one_timelimit > 0 ) ) 
    || (username == 'debator_two' && ( two_timelimit == 'unlimited' || two_timelimit > 0 ) ) )
        sfutest.createOffer(
        {
            media: { audioRecv: false, videoRecv: false, audioSend: useAudio, videoSend: true, data: true },	// Publishers are sendonly
            success: function(jsep) {
                Janus.debug("Got publisher SDP!");
                Janus.debug(jsep);
                var publish = { "request": "configure", "audio": useAudio, "video": true, "pin": "{{ $pin }}" };
                sfutest.send({"message": publish, "jsep": jsep});
            },
            error: function(error) {
                Janus.error("WebRTC error:", error);
                if (useAudio) {
                        publishOwnFeed(false);
                } else {
                    bootbox.alert("WebRTC error... " + JSON.stringify(error));
                    $('#publish').removeAttr('disabled').click(function() { publishOwnFeed(true); });
                }
            }
        });
}

function setUserName( usertype )
{
    $.ajax({
        type:'POST',
        url:"{{ route('getusername') }}",
        data:{ type: usertype, roomId: roomId },
        success: function(data){
            if( data.name )
                $("#username_" + usertype)[0].innerHTML = 'User: ' + data.name;
        }
    });
}

function newRemoteFeed(id, display, audio, video) {
	console.log(id, display);
	// A new feed has been published, create a new plugin handle and attach to it as a subscriber
    var remoteFeed = null;
    if( display != "moderator" && display != "debator_one" && display != "debator_two")
        return;

    if( ( username != "subscriber" ) && username == display )
        return;

    // Get UserName of debator
    if( display == "debator_one" )
        setUserName('one');
    else if( display == "debator_two" )
        setUserName('two');

	janus.attach(
    {
        plugin: "janus.plugin.videoroom",
        opaqueId: opaqueId,
        success: function(pluginHandle) {
            remoteFeed = pluginHandle;
            remoteFeed.simulcastStarted = false;
            Janus.log("Plugin attached! (" + remoteFeed.getPlugin() + ", id=" + remoteFeed.getId() + ")");
            Janus.log("  -- This is a subscriber");
            // We wait for the plugin to send us an offer
            var subscribe = { "request": "join", "room": parseInt(roomId), "ptype": "subscriber", "feed": id, "private_id": mypvtid , "pin": "{{ $pin }}"};
            if(Janus.webRTCAdapter.browserDetails.browser === "safari" &&
                    (video === "vp9" || (video === "vp8" && !Janus.safariVp8))) {
                if(video)
                    video = video.toUpperCase()
                toastr.warning("Publisher is using " + video + ", but Safari doesn't support it: disabling video");
                subscribe["offer_video"] = false;
            }
            remoteFeed.videoCodec = video;
            remoteFeed.send({"message": subscribe});
        },
        error: function(error) {
            Janus.error("  -- Error attaching plugin...", error);
            bootbox.alert("Error attaching plugin... " + error);
        },
        ondata: function( response ) {
            var data = JSON.parse(response);
            switch ( data.msgCode )
            {
                case 'mute':
                    if( data.msgData == username )
                    {
                        var muted = sfutest.isAudioMuted();
                        if(muted)
                            sfutest.unmuteAudio();
                        else
                            sfutest.muteAudio();
                    }
                    break;
                case 'timelimit':
                    setupTimeLimit(data.msgData, data.limit);
                    if( data.msgData == username )
                    {
                        toastr.warning('Timer set as ' + data.limit + ' seconds');
                        if( publishStopper )
                            clearTimeout(publishStopper);
                        if( data.limit > 0 )
                            publishStopper = setTimeout(function(){ 
                                var unpublish = { "request": "unpublish" };
	                            sfutest.send({"message": unpublish});
                                toastr.warning('Time is out...');
                             }, data.limit * 1000);
                    }
                    break;
            }
        },
        onmessage: function(msg, jsep) {
            Janus.debug(" ::: Got a message (subscriber) :::");
            Janus.debug(msg);
            console.log('Message Received', msg);
            var event = msg["videoroom"];
            Janus.debug("Event: " + event);
            if(msg["error"] !== undefined && msg["error"] !== null) {
                bootbox.alert(msg["error"]);
            } else if(event != undefined && event != null) {
                if(event === "attached") {
                    remoteFeed.rfid = msg["id"];
                    remoteFeed.rfdisplay = msg["display"];
                    var checkFeed = feeds.filter( e => e.display && e.display == msg["display"] );
                    if( checkFeed[0] )
                        checkFeed[0] = remoteFeed;
                    else
                        feeds.push(remoteFeed);
                    console.log('hereherehere', msg["display"]);
                }
            }
            if(jsep !== undefined && jsep !== null) {
                Janus.debug("Handling SDP as well...");
                Janus.debug(jsep);
                console.log('jsep', jsep);
                // Answer and attach
                remoteFeed.createAnswer(
                    {
                        jsep: jsep,
                        // Add data:true here if you want to subscribe to datachannels as well
                        // (obviously only works if the publisher offered them in the first place)
                        media: { audioSend: false, videoSend: false, data: true },	// We want recvonly audio/video
                        success: function(jsep) {
                            Janus.debug("Got SDP!");
                            Janus.debug(jsep);
                            var body = { "request": "start", "room": parseInt(roomId) };
                            remoteFeed.send({"message": body, "jsep": jsep});
                        },
                        error: function(error) {
                            Janus.error("WebRTC error:", error);
                            bootbox.alert("WebRTC error... " + JSON.stringify(error));
                        }
                    });
            }
        },
        webrtcState: function(on) {
            Janus.log("Janus says this WebRTC PeerConnection (feed #" + remoteFeed.rfindex + ") is " + (on ? "up" : "down") + " now");
        },
        onlocalstream: function(stream) {
            // The subscriber stream is recvonly, we don't expect anything here
        },
        onremotestream: function(stream) {
            Janus.debug("Remote feed #" + remoteFeed.rfindex);
            console.log('start', remoteFeed);
            Janus.attachMediaStream($('#'+remoteFeed.rfdisplay).get(0), stream);
        }
    });
}

function fancyTimeFormat(time)
{   
    // Hours, minutes and seconds
    var mins = ~~(time / 60);
    var secs = ~~time % 60;

    var ret = "";

    ret += (mins < 10 ? "0" : "");
    ret += "" + mins + ":" + (secs < 10 ? "0" : "");
    ret += "" + secs;
    return ret;
}

var timerOne, timerTwo;

function setupTimeLimit( who, limit )
{
    if( limit > 0)
    {
        var seconds = limit;
        if( who == 'debator_one')
        {
            if( timerOne ) clearInterval( timerOne );
            timerOne = setInterval(function(){
                seconds --;
                $('#one_timelimit')[0].innerHTML = 'Time left: ' + fancyTimeFormat( seconds );
                if( seconds <= 0)
                    clearInterval( timerOne );
            }, 1000);
        }
        else if( who == 'debator_two')
        {
            if( timerTwo ) clearInterval( timerTwo );
            timerTwo = setInterval(function(){
                seconds --;
                $('#two_timelimit')[0].innerHTML = 'Time left: ' + fancyTimeFormat( seconds );
                if( seconds <= 0)
                    clearInterval( timerTwo );
            }, 1000);
        }
    }
}

</script>
@if ( $usertype == 'moderator' ) 
<script>

function kick( who )
{
    $.ajax({
        type:'POST',
        url:"{{ route('getadminkey') }}",
        data:{ roomId: roomId },
        success: function( secretKey ){
            swal({
			  title: "Are you sure?",
			  text: "You are going to kick a debator.",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((confirmKick) => {
			  if (confirmKick) {
                for( var i = 0; i < feeds.length; i ++ ) {
                    if ( feeds[i] && feeds[i].rfdisplay == "debator_" + who )
                    {
                        console.log('kick debator_' + who);
                        var kick = { "request": "kick", "secret": secretKey, "room": parseInt(roomId), "id": feeds[i].rfid };
                        sfutest.send({ "message": kick });
                        
                        $.ajax({
                            type:'POST',
                            url:"{{ route('kick') }}",
                            data:{ roomId: roomId, who: who },
                            success: function( data )
                            {
                                if( data == 'success' )
                                    swal("Debator kicked.", { icon: "success", });
                                else
                                    swal("Debator kick failed.", { icon: "warning", });
                            }
                        });
                        feeds.splice( i, 1 );
                        break;
                    }
                }
			  }
			});
        }
    });
}

function mute( who )
{
    swal({
        title: "Are you sure?",
        text: "You are going to mute a debator.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((confirmMute) => {
        if ( confirmMute ) {
            sfutest.data({
                text: '{ "msgCode": "mute", "msgData": "' + who + '"}',
                error: function(reason) { toastr.warning(reason); },
                success: function() { swal("Operation Done.", { icon: "success", }); },
            });
        }
    });
}

function timelimit( who )
{
    swal({
        text: 'Input the time limit in seconds.',
        content: "input",
        button: {
            text: "OK",
            closeModal: true,
        },
    })
    .then(seconds => {
        console.log(seconds);
        if( seconds != null && seconds != undefined && !isNaN(seconds) )
        {
            $.ajax({
                type:'POST',
                url:"{{ route('timelimit') }}",
                data:{ roomId: roomId, who: who, limit: seconds },
                success: function( data )
                {
                    if( data == 'success' )
                    {
                        sfutest.data({
                            text: '{ "msgCode": "timelimit", "msgData": "debator_' + who + '", "limit":' + seconds + '}',
                            error: function(reason) { toastr.warning(reason); },
                            success: function() { swal("Timer set success.", { icon: "success", }); },
                        });
                        setupTimeLimit("debator_" + who, seconds);
                    }    
                    else
                        swal("Timer set failed.", { icon: "warning", });
                }
            });
        }
    })
}

</script>
@endif

</body>
</html>
