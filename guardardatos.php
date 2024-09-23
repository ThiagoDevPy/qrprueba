<?php
define("ZONA_HORARIA", "America/Asuncion");
date_default_timezone_set(ZONA_HORARIA);
session_start();
require 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (empty($id)) {
        die('ID no valido.');
    }


    $stmt = $conexion->prepare("SELECT * FROM qr WHERE qr_id = ? AND estado = 'no utilizado'");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
       
         // Aquí va la lógica para guardar los datos
        $user_id = $_SESSION['user_id'];

        $stmt = $conexion->prepare("INSERT INTO asistencias (empleado_id, fecha,hora, tipo) VALUES (?, NOW(), NOW(), 'ENTRADA');");
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            header("Location: guardarexito.php");
        } else {
            echo "Error al guardar asistencia: " . $stmt->error;
        }
       
        echo "Datos guardados correctamente.";
    } else {
        die("ID no válido o ya ha sido utilizado.");
    }



    $stmt->close();
} else {
    echo "No se recibió el ID del usuario.";
}

$conexion->close();
