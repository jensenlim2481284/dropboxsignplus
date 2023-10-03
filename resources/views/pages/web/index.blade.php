@extends("pages.web.layout")

@section('head')

<title>KKM PWA</title>
<link href="/css/page/web/homepage.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet" />
@endsection

@section('content')
<div id='camera-body'>
    <div id='ttSection'>
        <img src='/img/logo/logo2.png'/>
        <h1 id='tt'> Scan QR Code </h1>
    </div>
    <div id='videoSection'>
        <video id="video" autoplay></video>
    </div>
    <p id='td'> Hold your device parallel and aim the QR code in the above square</p>
    <canvas id="canvas" style="display: none;"></canvas>
    <div id='footer'>
        <button class='btn btn-primary' data-toggle="modal" data-target="#aboutModal"> 
            <i class='ti-info-alt'></i>
            About Us    
        </button>
        <button class='btn btn-default' data-toggle="modal" data-target="#contactModal"> 
            <i class='ti-heart'></i>
            Contact Us    
        </button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="aboutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="aboutModalLabel"></h5>
        <button type="button" class="close pr-4" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <img src='/img/logo/logo2.png' class='logo'/> -->
        <h1> About Counterfeit Buster </h1>
        <p>
            Counterfeit Buster is your trusty companion in the fight against fake products. With just a simple scan, this app empowers consumers to easily verify the authenticity of a wide range of products, from luxury goods to everyday essentials. Using advanced technology and a comprehensive database, Counterfeit Buster quickly identifies genuine products from counterfeit ones, providing users with peace of mind when making purchases. Say goodbye to counterfeit products and make informed buying decisions with Counterfeit Buster today!
        </p>
      </div>
   
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contactModalLabel"></h5>
        <button type="button" class="close pr-4" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h2> Contact Us </h2>
        <div class='contact-list'>
            <h3> <i class="ti-email"></i> Email </h3>
            <p> enquiry@kkm.com </p>
        </div>
        <div class='contact-list'>
            <h3>  <i class="ti-headphone-alt"></i> Customer Service Center </h3>
            <p> +603 6247 5400 </p>
        </div>
       
      </div>
   
    </div>
  </div>
</div>

<script src="https://cdn.rawgit.com/cozmo/jsQR/master/dist/jsQR.js"></script>
<script>
    const video = document.getElementById('video');
    const canvasElement = document.getElementById('canvas');
    const canvas = canvasElement.getContext('2d');

    navigator.mediaDevices.getUserMedia({
            video: {
                facingMode: 'environment'
            }
        })
        .then((stream) => {
            video.srcObject = stream;
            video.play();
        })
        .catch((error) => {
            console.error('Error accessing the camera:', error);
        });

    function captureQRCode() {
        canvasElement.width = video.videoWidth;
        canvasElement.height = video.videoHeight;
        canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
        const imageDataURL = canvasElement.toDataURL('image/jpeg'); // Change format as needed

        const imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
        const code = jsQR(imageData.data, imageData.width, imageData.height, {
            inversionAttempts: 'dontInvert',
        });


        if (code) {
            // Crop the QR code region from the captured image
            const {
                x,
                y,
                width,
                height
            } = code.location;
            const croppedCanvas = document.createElement('canvas');
            const croppedContext = croppedCanvas.getContext('2d');
            croppedCanvas.width = width;
            croppedCanvas.height = height;
            croppedContext.drawImage(canvasElement, x, y, width, height, 0, 0, width, height);

            const croppedImageDataURL = croppedCanvas.toDataURL('image/jpeg'); // Change format as needed

            sendQRCodeToBackend(code.data, croppedImageDataURL);
            alert(1);
        }

        // Repeat the process in the next frame
        requestAnimationFrame(captureQRCode);
    }


    function sendQRCodeToBackend(qrData, imageDataURL) {
        // Replace with your backend API endpoint and logic to send the QR code data
        const apiUrl = 'https://dashboard.kkm.test/api/receiveQR';
        fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    qrData,
                    imageDataURL
                }),
            })
            .then((response) => {
                if (response.ok) {
                    alert('QR code sent to the backend successfully.');
                } else {
                    alert('Failed to send QR code to the backend.');
                }
            })
            .catch((error) => {
                console.error('Error while sending QR code to the backend:', error);
                alert(404);
            });
    }

    // Start capturing QR codes once the video stream is ready
    video.onloadedmetadata = () => {
        captureQRCode();
    };
</script>
@stop