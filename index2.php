<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Escanear QR</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsqr/1.4.0/jsQR.js"></script>
</head>
<body>
    <select id="videoSource"></select>
    <video id="preview" width="100%" height="auto" autoplay></video>
    <canvas id="canvas" hidden></canvas>

    <script>
        'use strict';

        var videoElement = document.querySelector('video');
        var videoSelect = document.querySelector('select#videoSource');
        var canvas = document.getElementById('canvas');
        var context = canvas.getContext('2d');

        videoSelect.onchange = getStream;

        getDevices().then(getStream);

        function getDevices() {
            return navigator.mediaDevices.enumerateDevices().then(gotDevices);
        }

        function gotDevices(deviceInfos) {
            for (const deviceInfo of deviceInfos) {
                const option = document.createElement('option');
                option.value = deviceInfo.deviceId;
                if (deviceInfo.kind === 'videoinput') {
                    option.text = deviceInfo.label || `Camera ${videoSelect.length + 1}`;
                    videoSelect.appendChild(option);
                }
            }
        }

        function getStream() {
            if (window.stream) {
                window.stream.getTracks().forEach(track => track.stop());
            }
            const videoSource = videoSelect.value;
            const constraints = {
                video: { deviceId: videoSource ? { exact: videoSource } : undefined }
            };
            return navigator.mediaDevices.getUserMedia(constraints).then(gotStream).catch(handleError);
        }

        function gotStream(stream) {
            window.stream = stream;
            videoElement.srcObject = stream;
            requestAnimationFrame(scanQRCode);
        }

        function scanQRCode() {
            if (videoElement.readyState === videoElement.HAVE_ENOUGH_DATA) {
                canvas.height = videoElement.videoHeight;
                canvas.width = videoElement.videoWidth;
                context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);
                const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                const code = jsQR(imageData.data, canvas.width, canvas.height);

                if (code) {
                    console.log('Contenido del QR:', code.data);
                    window.location.href = code.data; // Redirigir a la URL
                }
            }
            requestAnimationFrame(scanQRCode);
        }

        function handleError(error) {
            console.error('Error: ', error);
        }
    </script>
</body>
</html>
