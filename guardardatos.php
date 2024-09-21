<?php
define("ZONA_HORARIA", "America/Asuncion");
date_default_timezone_set(ZONA_HORARIA);
$timeZone = 'America/Asuncion'; // O la zona horaria que necesites
$mysqli->query("SET time_zone = '$timeZone'");
session_start();
require 'conexion.php';

if (isset($_GET['user_id'])) {
    $user_id = $_SESSION['user_id'];
  
    $stmt = $mysqli->prepare("INSERT INTO asistencia (user_id, fecha) VALUES (?, NOW())");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        header("Location: guardarexito.php");
    } else {
        echo "Error al guardar asistencia: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No se recibió el ID del usuario.";
}

$mysqli->close();
