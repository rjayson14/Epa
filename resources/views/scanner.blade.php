@extends('layouts.appscanner')
@section('title')
Gate Scanner
@stop

@section('style')
<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
    }
 .success-message {
  background-color: #4CAF50;
  color: white;
  text-align: center;
  padding: 10px;
  position: fixed;
  top: 350px;
  left: 50%;
  transform: translateX(-50%);
  border-radius: 5px;
  display: none;
  z-index: 1000;
}
.error-message {
  background-color: red;
  color: white;
  text-align: center;
  padding: 10px;
  position: fixed;
  top: 350px;
  left: 50%;
  transform: translateX(-50%);
  border-radius: 5px;
  display: none;
  z-index: 1000;
}
/* Style the video container with a border inside */
.video {
    width: 100%;
    position: relative;
    overflow: hidden;
}

/* Add a border inside the video container */
#qr-video {
    width: 100%;
    height: auto;
      padding: -20px;
    border: 4px solid #000; /* Set the border color and size */
    box-sizing: border-box; /* Make the border stay inside the video */
}

/* Create a scanner line */
#qr-line {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px; /* Adjust the height as needed for the scanning line */
    background: #00ff00; /* Set the color of the scanning line */
    animation: scan 3s linear infinite; /* Add a scanning animation */
}

/* Keyframe animation for the scanning line */
@keyframes scan {
    0% {
        transform: translate(0, 0); /* Start position of the line */
    }
    100% {
        transform: translate(0, 100%); /* End position of the line */
    }
}
#donate {
    /* margin:4px; */
   
    float:left;
}

#donate label {
    /* float:left; */
    width:170px;
    margin:2px;
    background-color:#EFEFEF;
    border-radius:4px;
    border:1px solid #D0D0D0;
    overflow:auto;
       
}

#donate label span {
    text-align:center;
    font-size: 22px;
    padding:5px 0px;
    display:block;
}

#donate label input {
    position:absolute;
    top:-20px;
}

#donate input:checked + span {
    background-color:green;
    color:#F7F7F7;
}

#donate .yellow {
    background-color:#FFCC00;
    color:#333;
}

#donate .blue {
    background-color:#00BFFF;
    color:#333;
}

#donate .pink {
    background-color:#FF99FF;
    color:#333;
}

#donate .green {
    background-color:#A3D900;
    color:#333;
}
#donate .purple {
    background-color:#B399FF;
    color:#333;
}
.clock {
    top: 50%;
    left: 50%;
    /* transform: translateX(-50%) translateY(-50%); */
    color: red;
    font-size: 60px;
    font-family: Arial, Helvetica, sans-serif;

}
</style>

@stop

@section('content')
<nav class="navbar navbar-light bg-light text-left " style='display:block !important;'>
    <a class="navbar-brand" href="{{url('/gates')}}">Gates</a>
    <a class="navbar-brand" href="{{url('/classrooms')}}">Classrooms</a>
  </nav>
 
    <div class='row pt-3'>
        <div class="col-md-12 text-center">
            <h1><span>{{$gate->name}}</h1><h3></span> {{date('F d, Y - l')}}</h3>
        </div>
        <div class='col-md-12 text-center'>
            <h1 style='font-size: 70px;' id='time' class='clock'></h1>
        </div>
    </div>
    <div class='row'>
        <div id="successMessage" style="display: none;" class="success-message">
        Success! Qr Code Scanned.
        </div>
        <div id="errorMessage" style="display: none;" class="error-message">
            No user was found <br>
            <strong>Please generate the QR code again.</strong>
        </div>
       
        <div class="col-md-12 text-center">
            <div class="well" style="position: relative;display: inline-block;style='width:100%;';">
                <div class='video'> 
                    <div class="form-check text-center">
                        <div id="donate" class="text-center">
                            <label class="dark" class='text-center'><input type="radio" name="type" value='Time In' checked><span>Time In</span></label>
                            <label class="dark"><input type="radio" name="type" value='Time Out'><span>Time Out</span></label>
                        </div>
                    </div>
                <video class='video' style='width:300px;height:300px;' width="300" height="300" id="qr-video" ></video>
                </div>
                <audio style='display:none;' controls   autoplay  id="scanSound" preload="auto" src="{{ asset('success.mp3') }}"></audio>
            </div>
            <div class='row'>
               
            </div>
        </div>
        <div class="col-md-12 text-center">
            <div class="thumbnail" id="result">
                <div class="well">
                    <div class="caption">
                        <h1><strong><span id="name-result"></span></strong></h1>
                        <h4><span id="course-result"></span></h4>
                        <h4><span id="timein"></span> - <span id="type"></span></h4>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
@section('scripts')
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script>
var location_id = {!! json_encode($gate->id) !!};
function show_message()
{
    var successMessage = document.getElementById("successMessage");

// Display the success message
successMessage.style.display = "block";

// Hide the message after a certain duration (e.g., 3 seconds)
setTimeout(function () {
  successMessage.style.display = "none";
}, 2000); // 3000 milliseconds (3 seconds)
    
}
function show_error_message()
{
    var errorMessage = document.getElementById("errorMessage");

    // Display the success message
    errorMessage.style.display = "block";

    // Hide the message after a certain duration (e.g., 3 seconds)
    setTimeout(function () {
        errorMessage.style.display = "none";
    }, 2000); // 3000 milliseconds (3 seconds)
    
}
function CallAjaxLoginQr(code) {
    var type = document.querySelector('input[name="type"]:checked').value;
    $.ajax({
        type: "POST",
        cache: false,
        url: "{{ url('check-user') }}",
        data: { data: code ,id :location_id,type:type },
        success: function (data) {
            if (data.user != null) {
                console.log(data.attendance.time);
                show_message();
                document.getElementById("name-result").innerHTML = data.user.name;
                document.getElementById("course-result").innerHTML = data.course;
                document.getElementById("timein").innerHTML = data.time;
                document.getElementById("type").innerHTML = data.type;
                
            } else {
                show_error_message();
            }
        }
    });
    
}
function playScanSound() {
        const scanSound = document.getElementById("scanSound");
        if (scanSound) {
            scanSound.play();
        }
    }
</script>
<script>
    const videoElement = document.getElementById("qr-video");
    const scanner = new Instascan.Scanner({ video: videoElement });

    scanner.addListener("scan", function (content) {
        playScanSound(scanSound);
        CallAjaxLoginQr(content);
        // show_message();
    });

    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            const selectedCamera = cameras[0]; // You can select a different camera if multiple are available.
            scanner.start(selectedCamera);

            // Check if brightness is supported
            if (selectedCamera.getCapabilities && selectedCamera.getCapabilities().brightness) {
                selectedCamera.applyConstraints({
                    advanced: [{ brightness: 1 }] // Adjust the brightness value as needed
                }).catch(function (error) {
                    console.error("Error adjusting brightness:", error);
                });
            }
        } else {
            console.error("No cameras found.");
        }
    }).catch(function (error) {
        console.error("Error accessing camera:", error);
    });

    
</script>
<script>
    var span = document.getElementById('time');

    function time() {
        var d = new Date();
        var s = d.getSeconds();
        var m = d.getMinutes();
        var h = d.getHours();
        var session = "AM";
    
            if(h == 0){
                h = 12;
            }
            
            if(h > 12){
                h = h - 12;
                session = "PM";
            }
            
            h = (h < 10) ? "0" + h : h;
            m = (m < 10) ? "0" + m : m;
            s = (s < 10) ? "0" + s : s;
    
        span.textContent =
            ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + " " + session;
    }

    setInterval(time, 1000);
</script>
@endsection