<?php
$host = 'autorack.proxy.rlwy.net'; // Ejemplo: 'mysql-123456.c.database.azure.com'
$port = '56145'; // Asegúrate de usar el puerto correcto
$user = 'root'; // Tu nombre de usuario
$pass = 'nZDgRwhZOLNoyCKpdGhqACgEaEWFPQAe'; // Tu contraseña
$dbname = 'railway'; // El nombre de la base de datos

// Crear la conexión
$mysqli = new mysqli($host, $user, $pass, $dbname, $port);

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conectado exitosamente";
?>
