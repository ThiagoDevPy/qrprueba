<?php
$host = 'fra1.clusters.zeabur.com'; // Ejemplo: 'mysql-123456.c.database.azure.com'
$port = '32285'; // Asegúrate de usar el puerto correcto
$user = 'root'; // Tu nombre de usuario
$pass = '12vF0CcQwG6ef9ZLHP5TEd3DzxY8V47J'; // Tu contraseña
$dbname = 'zeabur'; // El nombre de la base de datos

// Crear la conexión
$conexion = new mysqli($host, $user, $pass, $dbname, $port);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

