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



$id = uniqid(); // o puedes usar time() para el timestamp

// Guardar en la sesión o en la base de datos si es necesario
$_SESSION['qr_id'] = $id;

// La URL a codificar en el QR
$qr_code_data = "https://qrphp2.zeabur.app/guardardatos.php?user_id=" . $id;


// Generar el QR
QRcode::png($qr_code_data, 'qrcodes/qr.png', QR_ECLEVEL_L, 10);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Asistencia</title>
</head>

<body>
<h1>Escanear QR</h1>
    <img id="qrCode" src="qrcodes/qr.png" alt="QR Code" />

    <script>
      function updateQRCode() {
            // Cambiar la URL de la imagen para forzar la recarga
            const qrImage = document.getElementById('qrCode');
            qrImage.src = 'qrcodes/qr.png?' + new Date().getTime(); // Añadir timestamp
        }

        // Actualiza el QR cada 2 minutos (120000 ms)
        setInterval(updateQRCode, 120000);
    </script>



</body>

</html>

<?php
ob_end_flush();

?>