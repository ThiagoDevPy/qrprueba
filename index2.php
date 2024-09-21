<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Escanear QR con html5-qrcode</title>
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
</head>
<body>
    <div id="reader" style="width: 300px; height: 300px;"></div>
    <script>
        const html5QrCode = new Html5Qrcode("reader");

        const config = {
            fps: 10,
            qrbox: 250
        };

        html5QrCode.start(
            { facingMode: "environment" }, // Usa la cámara trasera
            config,
            (decodedText, decodedResult) => {
                console.log(`Código QR detectado: ${decodedText}`);
                window.location.href = decodedText; // Redirigir a la URL
            },
            (errorMessage) => {
                console.error(`Error de escaneo: ${errorMessage}`);
            }
        ).catch(err => {
            console.error(`Error al iniciar: ${err}`);
        });
    </script>
</body>
</html>