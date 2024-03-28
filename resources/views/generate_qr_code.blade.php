@extends('layouts.appscanner')
@section('title')
QR Code
@stop

@section('content')
<!-- qr code  -->
<div class='row pt-5 text-center'>
  <div class='col-md-12 pt-5 text-center' style="background:white" >
    <div class="text-center pt-5" id='down-qr'>
    @if($id)

      <div id='image'>{!! QrCode::size(300)->generate($user->password); !!}</div>
      <h2 style='color: black;'>{{$user->name}}</h2>
      @endif
      
      
    </a>
    </div>
    <strong><p style='color: black;'>This is your QR code. Download it to your mobile.</p></strong>
   
    <button id='btnSave' class="btn btn-primary sub6" onclick='shot()'>Download QR Code</button>
    </div>
    
</div>
<!-- end qr code -->
@stop

@section('scripts')
<script>
function injectScript(uri) {
    const document = window.document;
    const script = document.createElement("script");
    script.setAttribute("src", uri);
    document.body.appendChild(script);
}

function injectHtml2canvas() {
    injectScript("//html2canvas.hertzen.com/dist/html2canvas.js");
}

// injectHtml2canvas();

function saveScreenshot(canvas) {
    const fileName = "image";
    const link = document.createElement("a");
    link.download = fileName + ".png";
    console.log(canvas);
    canvas.toBlob(function (blob) {
        console.log(blob);
        link.href = URL.createObjectURL(blob);
        link.click();
    });
}
function shot(){
    var element = document.getElementById("down-qr"); // Replace "yourDivId" with the ID of your specific div
    html2canvas(element, {
        allowTaint: true,
        useCORS: true
    }).then(saveScreenshot);
}
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