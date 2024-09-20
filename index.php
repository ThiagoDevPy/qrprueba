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
</head>

<body>
    <h1>Bienvenido, Usuario</h1>

    <button id="scanButton">Escanear QR</button>
    <div id="reader" style="width: 300px; height: 300px;"></div>

    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script>
        document.getElementById('scanButton').onclick = function() {
            const html5QrCode = new Html5Qrcode("reader");
            html5QrCode.start({
                    facingMode: "environment"
                }, {
                    fps: 10,
                    qrbox: 250
                },
                (decodedText, decodedResult) => {
                    window.location.href = decodedText; // Redirige al enlace del QR
                },
                (errorMessage) => {
                    console.log("Error de escaneo:", errorMessage);
                });
        };
    </script>
</body>

</html>

<?php
ob_end_flush();
?>