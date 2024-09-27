<?php

require_once(__DIR__ . "/conecta.php");

$id = $_SESSION['id_i'];

try{
    $sql = "DELETE FROM inmobiliaria WHERE idInmobiliaria =$id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_i', $id);

    $conn->exec($sql);
    echo "
    <script> 
        alert ('inmueble eliminado.');
        window.location.href = 'CS.php' 
    </script>";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}