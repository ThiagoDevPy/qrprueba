<?php
ob_start();
session_start();
require 'conexion.php';
require 'phpqrcode/qrlib.php'; // Incluye la biblioteca

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asistencia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        #reader {
            width: 300px;
            height: 300px;
            border: 1px solid #ccc;
            margin: 20px;
        }
    </style>
</head>
<body>
    <h1>Bienvenido, Usuario</h1>
    <div id="reader"></div>

    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script>
        const html5QrCode = new Html5Qrcode("reader");

        // Callback para el éxito del escaneo
        const qrCodeSuccessCallback = (decodedText, decodedResult) => {
            // Detener el escaneo después de un éxito
            html5QrCode.stop().then(ignore => {
                // Redirige a la URL del QR
                window.location.href = decodedText;
            }).catch(err => {
                console.error("Error al detener el escáner: ", err);
            });
        };

        // Callback para manejar errores
        const qrCodeErrorCallback = (errorMessage) => {
            console.log("Error de escaneo:", errorMessage);
        };

        // Comenzar a escanear inmediatamente
        html5QrCode.start({ facingMode: "environment" }, { fps: 10, qrbox: 250 },
            qrCodeSuccessCallback,
            qrCodeErrorCallback
        ).catch(err => {
            console.error("Error al iniciar el escáner: ", err);
        });
    </script>
</body>
</html>

<?php
ob_end_flush();
?>
