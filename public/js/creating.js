// creating

var server = null;
if(window.location.protocol === 'http:')
	server = "http://" + window.location.hostname + ":8088/janus";
else
    server = "https://" + window.location.hostname + ":8089/janus";
    
var janus = null;
var sfutest = null;
var opaqueId = "debate-"+Janus.randomString(12);

var myroom = 1234;	// Demo room
