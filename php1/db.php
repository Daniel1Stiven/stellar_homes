<?php
// Configuración de la conexión a la base de datos
$host = 'localhost';
$dbname = 'stellar_homes'; // Reemplaza con el nombre real de tu base de datos
$username = 'root'; // Cambia si usas un usuario diferente
$password = ''; // Cambia si usas una contraseña diferente

// Crear conexión
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
