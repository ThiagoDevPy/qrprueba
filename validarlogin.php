<?php
session_start(); // Iniciar la sesión

include 'conexion.php'; // Asegúrate de que este archivo esté correctamente configurado

// Obtener y sanitizar datos POST
$cedula = isset($_POST['cedula']) ? trim($_POST['cedula']) : '';


// Preparar respuesta
$response = ['success' => false, 'message' => 'Nombre de usuario o contraseña incorrectos.'];


if ($cedula) {
    // Preparar y ejecutar la consulta
    $stmt = $conexion->prepare("SELECT id FROM empleados WHERE documento_numero = ?");
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Verificar si el usuario existe y si la contraseña es correcta
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        session_regenerate_id(true); // Regenerar ID de sesión
        $response = ['success' => true, 'message' => 'Inicio de sesión exitoso.'];
    }

    $stmt->close();
}

$conexion->close();

// Enviar respuesta JSON
header('Content-Type: application/json');
echo json_encode($response);
?>



