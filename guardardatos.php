<?php
session_start();
require 'conexion.php';

if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);

    $stmt = $mysqli->prepare("INSERT INTO asistencia (user_id, fecha) VALUES (?, NOW())");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        echo "Asistencia guardada exitosamente.";
    } else {
        echo "Error al guardar asistencia: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No se recibió el ID del usuario.";
}

$mysqli->close();
