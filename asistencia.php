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
    <h1>Listar Asistencias</h1>
    <img src="<?php echo $qr_file; ?>" alt="QR Code">



</body>

</html>

<?php
ob_end_flush();

?>