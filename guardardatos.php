<?php
define("ZONA_HORARIA", "America/Asuncion");
date_default_timezone_set(ZONA_HORARIA);
session_start();
$user_id = $_SESSION['user_id'];
require 'conexion.php';

$fecha = date("Y-m-d");
$hora = date("H:i.s");

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


        $stmt = $conexion->prepare("SELECT * FROM asistencias WHERE empleado_id = ? ");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $resulta = $stmt->get_result();

        if ($resulta->num_rows == 1) {
            $stmt = $conexion->prepare("INSERT INTO asistencias (empleado_id, fecha,hora, tipo) VALUES (?, '$fecha', '$hora', 'SALIDA');");
            $stmt->bind_param("i", $user_id);
            if ($stmt->execute()) {
                header("Location: guardarexito.php");
            } else {
                echo "Error al guardar asistencia: " . $stmt->error;
            }
        } elseif ($resulta->num_rows >= 2) {
            header("Location: guardarmensaje.php");
            
        } elseif ($resulta->num_rows == 0) {
            // Aquí va la lógica para guardar los datos
            $user_id = $_SESSION['user_id'];

            $stmt = $conexion->prepare("INSERT INTO asistencias (empleado_id, fecha,hora, tipo) VALUES (?, '$fecha', '$hora', 'ENTRADA');");
            $stmt->bind_param("i", $user_id);
            if ($stmt->execute()) {
                header("Location: guardarexito.php");
            } else {
                echo "Error al guardar asistencia: " . $stmt->error;
            }
        }
    } else {
        die("ID no válido o ya ha sido utilizado.");
    }



    $stmt->close();
} else {
    echo "No se recibió el ID del usuario.";
}

$conexion->close();
