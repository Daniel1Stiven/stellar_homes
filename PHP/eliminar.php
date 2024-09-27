<?php

require_once(__DIR__ . "/conectar.php");

$id = $_SESSION['id'];

try{
    $sql = "DELETE FROM usuario WHERE id_usuario=$id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);

    $conn->exec($sql);
    echo "
    <script> 
        alert ('usuario eliminado.');
        window.location.href = 'logout.php' 
    </script>";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}