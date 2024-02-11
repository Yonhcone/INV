<?php
$servername = "localhost";
$username = "root";
$password = ""; // No hay contraseña en este caso
$database = "cone"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

?>
