<?php
ob_start();
session_start();
require 'conexion.php';
require 'phpqrcode/qrlib.php';

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
        
       $new_id = uniqid();
        $_SESSION['qr_id'] = $new_id;
        $stmt = $conexion->prepare("INSERT INTO qr (qr_id, estado) VALUES (?, 'no utilizado')");
        $stmt->bind_param("s", $new_id);
        $stmt->execute();

        $new_qr_code_data = "https://asistencia.zeabur.app/guardardatos.php?id=" . $new_id;
        QRcode::png($new_qr_code_data, 'qrcodes/new_qr.png', QR_ECLEVEL_L, 10);

// Genera un nuevo QR si se solicita



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asistencia</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Escanear QR</h1>
    <img id="qrCode" src="qrcodes/new_qr.png" alt="QR Code" />

    <script>
        function updateQRCode() {

            const currentQrId = "<?php echo $_SESSION['qr_id']; ?>"; // Obtener el ID actual
            console.log("ID actual:", currentQrId); // Verifica el ID
            $.get('updateqr.php', { id: currentQrId }, function(data) {
                const response = JSON.parse(data);
                if (response.new_qr) {
                    const qrImage = document.getElementById('qrCode');
                    qrImage.src = response.new_qr + '?' + new Date().getTime(); // Añadir timestamp

                }
            }).fail(function() {
                console.error('Error al actualizar el QR.');
            });
        }

        // Actualiza el QR cada 2 minutos (120000 ms)
        setInterval(updateQRCode, 120000);
    </script>
</body>
</html>

<?php 
ob_end_flush();

?>