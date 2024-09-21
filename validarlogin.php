<?php
session_start(); // Iniciar la sesión

include 'conexion.php'; // Asegúrate de que este archivo esté correctamente configurado

// Obtener y sanitizar datos POST
$usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
$contrasena = isset($_POST['contrasena']) ? trim($_POST['contrasena']) : '';

// Preparar respuesta
$response = ['success' => false, 'message' => 'Nombre de usuario o contraseña incorrectos.'];


if ($usuario && $contrasena) {
    // Preparar y ejecutar la consulta
    $stmt = $mysqli->prepare("SELECT idusuario, password_hash FROM usuario WHERE username = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Verificar si el usuario existe y si la contraseña es correcta
    if ($row = $result->fetch_assoc()) {
        if (password_verify($contrasena, $row['password_hash'])) {
            // Contraseña correcta
            $_SESSION['user_id'] = $row['idusuario'];
            $response = ['success' => true, 'message' => 'Inicio de sesión exitoso.'];
        }
    }

    $stmt->close();
}

$mysqli->close();

// Enviar respuesta JSON
header('Content-Type: application/json');
echo json_encode($response);
?>




