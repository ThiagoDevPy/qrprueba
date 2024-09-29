<?php
$host = 'fra1.clusters.zeabur.com'; // Ejemplo: 'mysql-123456.c.database.azure.com'
$port = '30860'; // Asegúrate de usar el puerto correcto
$user = 'root'; // Tu nombre de usuario
$pass = '39pG6swmq5rUCfoRJ1VFZ24E7giDTj80'; // Tu contraseña
$dbname = 'zeabur'; // El nombre de la base de datos

// Crear la conexión
$conexion = new mysqli($host, $user, $pass, $dbname, $port);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

