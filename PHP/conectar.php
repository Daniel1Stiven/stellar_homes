<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database= "stellar_homes";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  if (isset($_SESSION['id'])) {
    $stmt = $conn->prepare("SELECT * FROM clientes WHERE idCliente = :id");
    $stmt->bindParam(':id', $_SESSION['id']);
    $stmt->execute();
    $cliente_sesion = $stmt->fetchAll()[0];
  }

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

