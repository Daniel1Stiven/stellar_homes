<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database= "stellar_homes";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if (isset($_SESSION['id_i'])) {
    $stmt = $conn->prepare("SELECT * FROM inmobiliaria WHERE idInmobiliaria = :id_i");
    $stmt->bindParam(':id_i', $_SESSION['id_i']);
    $stmt->execute();
    $sesionInmobiliaria = $stmt->fetchAll()[0];
  }
}catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>

