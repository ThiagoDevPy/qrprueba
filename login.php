<?php
ob_start();
session_start();
require 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $mysqli->real_escape_string($_POST['nombre']);

    $query = "SELECT id FROM usuarios WHERE nombre = '$nombre'";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        $_SESSION['user_id'] = $usuario['id'];
        header("Location: index.php");
        exit();
    } else {
        echo "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión 2</title>
</head>

<body>
    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre de usuario" required>
        <button type="submit">Iniciar Sesión 1</button>
    </form>
</body>

</html>

<?php
ob_end_flush();

?>