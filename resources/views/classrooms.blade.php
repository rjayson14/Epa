@extends('layouts.appscanner')
@section('title')
Classrooms
@stop

@section('style')
<style>
 .success-message {
  background-color: #4CAF50;
  color: white;
  text-align: center;
  padding: 10px;
  position: fixed;
  top: 100px;
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
  top: 100px;
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
</style>

@stop

@section('content')
<nav class="navbar navbar-light bg-light text-left " style='display:block !important;'>
  <a class="navbar-brand" href="{{url('/gates')}}">Gates</a>
  <a class="navbar-brand" href="{{url('/classrooms')}}">Classrooms</a>
</nav>
    <div class='row pt-3'>
      <div class="col-md-3">
      </div>
      <div class="col-md-6">
        <table class="table table-bordered" >
            <thead >
            <tr >
                <td >Classroom Name</td>
                <td  scope="col">Scanner</td>
            </tr>
            </thead>
            <tbody>
                @foreach($classrooms as $gate)
                <tr>
                  <td class="pt-1 ps-0">
                    {{$gate->name}}
                  </td>
                  <td class="pt-1 ps-0">
                      <a href='{{url('scanner/room/'.$gate->id)}}' target='_blank'><i class="fa fa-qrcode"></i></a>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
   
@endsection
@section('scripts')

@endsection