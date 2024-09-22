<?php
$host = 'ewr1.clusters.zeabur.com'; // Ejemplo: 'mysql-123456.c.database.azure.com'
$port = '31480'; // Asegúrate de usar el puerto correcto
$user = 'root'; // Tu nombre de usuario
$pass = '860e3v9YbismGq1z54yjH27cMKUkNnAO'; // Tu contraseña
$dbname = 'zeabur'; // El nombre de la base de datos

// Crear la conexión
$mysqli = new mysqli($host, $user, $pass, $dbname, $port);

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

