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

// Genera un QR único cada 5 minutos
$qr_code_data = "https://phpqr.zeabur.app/guardardatos.php?user_id=" . $_SESSION['user_id'];

// Crea un archivo de imagen para el QR
$qr_file = 'qrcodes/qr_' . $_SESSION['user_id'] . '.png';
QRcode::png($qr_code_data, $qr_file, QR_ECLEVEL_L, 10); // Genera el QR code
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

    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script>
        document.getElementById('scanButton').onclick = function() {
            const html5QrCode = new Html5Qrcode("reader");
            html5QrCode.start({ facingMode: "environment" }, { fps: 10, qrbox: 250 },
                (decodedText, decodedResult) => {
                    window.location.href = decodedText;
                },
                (errorMessage) => {
                    console.log("Error de escaneo:", errorMessage);
                });
        };
    </script>
</body>
</html>