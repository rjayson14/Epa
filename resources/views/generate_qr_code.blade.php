@extends('layouts.appscanner')
@section('title')
QR Code
@stop

@section('content')
<!-- qr code  -->
<div class='row pt-5'>
  <div class='col-md-12 pt-5' style="background:white">
<div class="text-center pt-5">
@if($id)

  <div id='image'>{!! QrCode::size(300)->generate($user->password); !!}</div>
  <h2 style='color: black;'>{{$user->name}}</h2>
  <strong><p style='color: black;'>This is your QR code. Download it to your mobile.</p></strong>
  @endif
  <button type="submit" id='btnSave' class="btn btn-primary sub6">Download QR Code</button>
</a>
</div>
</div>
<!-- end qr code -->
@stop

@section('scripts')
<script>
$(function() { 
     $("#btnSave").click(function() { 
     
        html2canvas($("#image"), {
        onrendered: function(canvas) {
            theCanvas = canvas;
            document.body.appendChild(canvas);

            // Convert and download as image 
            Canvas2Image.saveAsPNG(canvas); 
            // Clean up 
            //document.body.removeChild(canvas);
        }
    });
});
});
      

</script>
@endsection