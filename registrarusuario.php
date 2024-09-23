<?php
// Conectar a la base de datos
include 'conexion.php';
// Datos del nuevo usuario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cedula = $_POST['cedula'];
$telefono = $_POST['telefono'];
$carrera = $_POST['carrera'];



$sql = "INSERT INTO empleados (nombre,apellidos,documento_numero,telefono,carrera) VALUES (?,?,?,?,?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param('sssss', $nombre, $apellido, $cedula, $telefono,$carrera);

if ($stmt->execute()) {
    echo "Usuario registrado correctamente.";
}else{
    echo "Error al insertar" . $stmt->error;
}


?>