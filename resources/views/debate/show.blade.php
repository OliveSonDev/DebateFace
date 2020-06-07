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
            @if ( $usertype == 'debator' ) 
                <div class = "row">
                    <div class = "col-md-3 offset-md-2">
                        <div class = "modCtrlDiv">
                            <div>
                                <div class = "modCtrlButtons">
                                    <div class = "modCtrlContainer">
                                        <div class = "text-center"> Mute </div>
                                        <div class = "modCtrlImgDiv">
                                            <img src = "{{ asset('img/mute.png') }}" class = "modCtrlImg" alt = "mute"> 
                                        </div>
                                    </div>
                                    <div class = "modCtrlContainer">
                                        <div class = "text-center"> Timer </div>
                                        <div class = "modCtrlImgDiv">
                                            <img src = "{{ asset('img/timer.png') }}" class = "modCtrlImg" alt = "timer"> 
                                        </div>
                                    </div>
                                    <div class = "modCtrlContainer">
                                        <div class = "text-center"> Boot </div>
                                        <div class = "modCtrlImgDiv">
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
                            <div class="panel-body relative" id="debator_container">
                                <video class="rounded centered" id="debator" width="100%" height="100%" autoplay playsinline muted="muted"/>
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
                                        <div class = "modCtrlImgDiv">
                                            <img src = "{{ asset('img/mute.png') }}" class = "modCtrlImg" alt = "mute"> 
                                        </div>
                                    </div>
                                    <div class = "modCtrlContainer">
                                        <div class = "text-center"> Timer </div>
                                        <div class = "modCtrlImgDiv">
                                            <img src = "{{ asset('img/timer.png') }}" class = "modCtrlImg" alt = "timer"> 
                                        </div>
                                    </div>
                                    <div class = "modCtrlContainer">
                                        <div class = "text-center"> Boot </div>
                                        <div class = "modCtrlImgDiv">
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
                            <div class="panel-body relative" id="moderator_one_container">
                                <video class="rounded centered" id="moderator_one" width="100%" height="100%" autoplay playsinline muted="muted"/>
                            </div>
                        </div>
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
                            <div class = "text-center text-middle"> <h4> Time Left: 2:00 </h4> </div>
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <div class="panel panel-default">
                            <div class="panel-body relative" id="moderator_two_container">
                                <video class="rounded centered" id="moderator_two" width="100%" height="100%" autoplay playsinline muted="muted"/>
                            </div>
                        </div>
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
                            <div class = "text-center text-middle"> <h4> Time Left: 2:00 </h4> </div>
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
                            <div class="panel-body relative" id="moderator_one_container">
                                <video class="rounded centered" id="moderator_one" width="100%" height="100%" autoplay playsinline muted="muted"/>
                            </div>
                        </div>
                        <div class = "modStatusContainer mt-1">
                            <div> <h4 id = "username_one"> User: <h4> </div>
                            <div> <h4> Time left: 1.47 </h4> </div>
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <div class="panel panel-default">
                            <div class="panel-body relative" id="moderator_two_container">
                                <video class="rounded centered" id="moderator_two" width="100%" height="100%" autoplay playsinline muted="muted"/>
                            </div>
                        </div>
                        <div class = "modStatusContainer mt-1">
                            <div> <h4 id = "username_two"> User: <h4> </div>
                            <div> <h4> Time left: 1.47 </h4> </div>
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
                                <h3 class="panel-title text-center">Debator<span class="label label-info hide" id="remote1"></span></h3>
                            </div>
                            <div class="panel-body relative" id="debator_container">
                                <video class="rounded centered" id="debator" width="100%" height="100%" autoplay playsinline muted="muted"/>
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

if( username == 'debator' || username == 'moderator_one' || username == 'moderator_two' )
    usertype = 'publisher';
else
    usertype = 'subscriber';

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
                                        }
                                    }
                                } else if(msg["leaving"] !== undefined && msg["leaving"] !== null) {
                                    // One of the publishers has gone away?
                                    var leaving = msg["leaving"];
                                    Janus.log("Publisher left: " + leaving);
                                    var remoteFeed = null;
                                    for( var i = 0; i < feeds.length; i ++ ) {
                                        if ( feeds[i] && feeds[i].rfid == msg["leaving"] )
                                        {
                                            if( feeds[i].display == "moderator_one" )
                                                toastr.warning("Moderator One leaved the room...");
                                            else if( feeds[i].display == "moderator_two" )
                                                toastr.warning("Moderator Two leaved the room...");
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
                                            if( feeds[i].display == "moderator_one" )
                                                toastr.warning("Moderator One leaved the room...");
                                            else if( feeds[i].display == "moderator_two" )
                                                toastr.warning("Moderator Two leaved the room...");
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
                                    if(msg["error_code"] === 426) {
                                        // This is a "no such room" error: give a more meaningful description
                                        bootbox.alert(
                                            "<p>Apparently room <code>" + myroom + "</code> (the one this demo uses as a test room) " +
                                            "does not exist...</p><p>Do you have an updated <code>janus.plugin.videoroom.jcfg</code> " +
                                            "configuration file? If not, make sure you copy the details of room <code>" + myroom + "</code> " +
                                            "from that sample in your current configuration file, then restart Janus and try again."
                                        );
                                    } else {
                                        bootbox.alert(msg["error"]);
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
                                // // Hide the webcam video
                                // $('#myvideo').hide();
                                // $('#videolocal').append(
                                //     '<div class="no-video-container">' +
                                //         '<i class="fa fa-video-camera fa-5 no-video-icon" style="height: 100%;"></i>' +
                                //         '<span class="no-video-text" style="font-size: 16px;">Video rejected, no webcam</span>' +
                                //     '</div>');
                            }
                        }
                    },
                    onlocalstream: function(stream) {
                        Janus.debug(" ::: Got a local stream :::");
                        mystream = stream;
                        Janus.debug(stream);
                        if( username == 'debator' || username == 'moderator_one' || username == 'moderator_two' )
                        {
                            Janus.attachMediaStream($('#' + username).get(0), stream);
                            $("#" + username).get(0).muted = "muted";
                            // if(sfutest.webrtcStuff.pc.iceConnectionState !== "completed" &&
                            //     sfutest.webrtcStuff.pc.iceConnectionState !== "connected") {
                            //     $("#" + username + "_container").parent().parent().block({
                            //         message: '<b>Publishing...</b>',
                            //         css: {
                            //             border: 'none',
                            //             backgroundColor: 'transparent',
                            //             color: 'white'
                            //         }
                            //     });
                            // }

                            var videoTracks = stream.getVideoTracks();
                            if(videoTracks === null || videoTracks === undefined || videoTracks.length === 0) {
                                alert('No Webcam !');
                            }
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        //window.location = '/home';
                    },
                });
            },
            error: function(error) {
                console.log(error);
                //window.location = '/home';
            },
            destroyed: function() {
                window.location.reload();
            }
        });
    }});
});

function publishOwnFeed(useAudio) {
	// Publish our stream
	sfutest.createOffer(
    {
        media: { audioRecv: false, videoRecv: false, audioSend: useAudio, videoSend: true },	// Publishers are sendonly
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
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

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
    if( display != "debator" && display != "moderator_one" && display != "moderator_two")
        return;

    if( ( username != "subscriber" ) && username == display )
        return;

    // Get UserName of moderator
    if( display == "moderator_one" )
        setUserName('one');
    else if( display == "moderator_two" )
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
            // In case you don't want to receive audio, video or data, even if the
            // publisher is sending them, set the 'offer_audio', 'offer_video' or
            // 'offer_data' properties to false (they're true by default), e.g.:
            // 		subscribe["offer_video"] = false;
            // For example, if the publisher is VP8 and this is Safari, let's avoid video
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
                    // Subscriber created and attached
                    // for(var i=1;i<3;i++) {
                    //     if(feeds[i] === undefined || feeds[i] === null) {
                    //         feeds[i] = remoteFeed;
                    //         remoteFeed.rfindex = i;
                    //         break;
                    //     }
                    // }
                    remoteFeed.rfid = msg["id"];
                    remoteFeed.rfdisplay = msg["display"];
                    var checkFeed = feeds.filter( e => e.display && e.display == msg["display"] );
                    if( checkFeed[0] )
                        checkFeed[0] = remoteFeed;
                    else
                        feeds.push(remoteFeed);
                    // if(remoteFeed.spinner === undefined || remoteFeed.spinner === null) {
                    //     var target = document.getElementById('videoremote'+remoteFeed.rfindex);
                    //     remoteFeed.spinner = new Spinner({top:100}).spin(target);
                    // } else {
                    //     remoteFeed.spinner.spin();
                    // }
                    // Janus.log("Successfully attached to feed " + remoteFeed.rfid + " (" + remoteFeed.rfdisplay + ") in room " + msg["room"]);
                    // $('#remote'+remoteFeed.rfindex).removeClass('hide').html(remoteFeed.rfdisplay).show();
                } else if(event === "event") {
                    // Check if we got an event on a simulcast-related event from this publisher
                    // var substream = msg["substream"];
                    // var temporal = msg["temporal"];
                    // if((substream !== null && substream !== undefined) || (temporal !== null && temporal !== undefined)) {
                    //     if(!remoteFeed.simulcastStarted) {
                    //         remoteFeed.simulcastStarted = true;
                    //         // Add some new buttons
                    //         addSimulcastButtons(remoteFeed.rfindex, remoteFeed.videoCodec === "vp8" || remoteFeed.videoCodec === "h264");
                    //     }
                    //     // We just received notice that there's been a switch, update the buttons
                    //     updateSimulcastButtons(remoteFeed.rfindex, substream, temporal);
                    // }
                } else {
                    // What has just happened?
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
                        media: { audioSend: false, videoSend: false },	// We want recvonly audio/video
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
            // if($('#'+remoteFeed.rfdisplay).length === 0) {
            //     // Show the video, hide the spinner and show the resolution when we get a playing event
            //     $('#'+remoteFeed.rfdisplay).bind("playing", function () {
            //         if(remoteFeed.spinner !== undefined && remoteFeed.spinner !== null)
            //             remoteFeed.spinner.stop();
            //         remoteFeed.spinner = null;
            //         $('#waitingvideo'+remoteFeed.rfindex).remove();
            //         if(this.videoWidth)
            //             $('#remotevideo'+remoteFeed.rfindex).removeClass('hide').show();
            //         var width = this.videoWidth;
            //         var height = this.videoHeight;
            //         $('#curres'+remoteFeed.rfindex).removeClass('hide').text(width+'x'+height).show();
            //         if(Janus.webRTCAdapter.browserDetails.browser === "firefox") {
            //             // Firefox Stable has a bug: width and height are not immediately available after a playing
            //             setTimeout(function() {
            //                 var width = $("#remotevideo"+remoteFeed.rfindex).get(0).videoWidth;
            //                 var height = $("#remotevideo"+remoteFeed.rfindex).get(0).videoHeight;
            //                 $('#curres'+remoteFeed.rfindex).removeClass('hide').text(width+'x'+height).show();
            //             }, 2000);
            //         }
            //     });
            // }
            Janus.attachMediaStream($('#'+remoteFeed.rfdisplay).get(0), stream);
            //var videoTracks = stream.getVideoTracks();
            // if(videoTracks === null || videoTracks === undefined || videoTracks.length === 0) {
            //     // No remote video
            //     $('#remotevideo'+remoteFeed.rfindex).hide();
            //     if($('#videoremote'+remoteFeed.rfindex + ' .no-video-container').length === 0) {
            //         $('#videoremote'+remoteFeed.rfindex).append(
            //             '<div class="no-video-container">' +
            //                 '<i class="fa fa-video-camera fa-5 no-video-icon"></i>' +
            //                 '<span class="no-video-text">No remote video available</span>' +
            //             '</div>');
            //     }
            // } else {
            //     $('#videoremote'+remoteFeed.rfindex+ ' .no-video-container').remove();
            //     $('#remotevideo'+remoteFeed.rfindex).removeClass('hide').show();
            // }
            // if(!addButtons)
            //     return;
            // if(Janus.webRTCAdapter.browserDetails.browser === "chrome" || Janus.webRTCAdapter.browserDetails.browser === "firefox" ||
            //         Janus.webRTCAdapter.browserDetails.browser === "safari") {
            //     $('#curbitrate'+remoteFeed.rfindex).removeClass('hide').show();
            //     bitrateTimer[remoteFeed.rfindex] = setInterval(function() {
            //         // Display updated bitrate, if supported
            //         var bitrate = remoteFeed.getBitrate();
            //         $('#curbitrate'+remoteFeed.rfindex).text(bitrate);
            //         // Check if the resolution changed too
            //         var width = $("#remotevideo"+remoteFeed.rfindex).get(0).videoWidth;
            //         var height = $("#remotevideo"+remoteFeed.rfindex).get(0).videoHeight;
            //         if(width > 0 && height > 0)
            //             $('#curres'+remoteFeed.rfindex).removeClass('hide').text(width+'x'+height).show();
            //     }, 1000);
            // }
        },
        oncleanup: function() {
            // Janus.log(" ::: Got a cleanup notification (remote feed " + id + ") :::");
            // if(remoteFeed.spinner !== undefined && remoteFeed.spinner !== null)
            //     remoteFeed.spinner.stop();
            // remoteFeed.spinner = null;
            // $('#remotevideo'+remoteFeed.rfindex).remove();
            // $('#waitingvideo'+remoteFeed.rfindex).remove();
            // $('#novideo'+remoteFeed.rfindex).remove();
            // $('#curbitrate'+remoteFeed.rfindex).remove();
            // $('#curres'+remoteFeed.rfindex).remove();
            // if(bitrateTimer[remoteFeed.rfindex] !== null && bitrateTimer[remoteFeed.rfindex] !== null)
            //     clearInterval(bitrateTimer[remoteFeed.rfindex]);
            // bitrateTimer[remoteFeed.rfindex] = null;
            // remoteFeed.simulcastStarted = false;
            // $('#simulcast'+remoteFeed.rfindex).remove();
        }
    });
}

</script>

</body>
</html>
