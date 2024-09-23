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

// Generar un nuevo ID único
$id = uniqid(); 

// Guardar en la sesión o en la base de datos si es necesario
$_SESSION['qr_id'] = $id;

$stmt = $conexion->prepare("INSERT INTO qr (qr_id, estado) VALUES (?, 'no utilizado')");
$stmt->bind_param("s", $id);
$stmt->execute();

// La URL a codificar en el nuevo QR, incluye el ID único
$qr_code_data = "https://qrcode.zeabur.app/guardardatos.php?id=" . $id; 

// Generar el nuevo QR
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
    <img id="qrCode" src="qrcodes/qr.png?<?php echo time(); ?>" alt="QR Code" /> <!-- Agregar timestamp aquí -->

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