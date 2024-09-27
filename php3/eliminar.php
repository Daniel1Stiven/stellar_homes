<?php

require_once(__DIR__ . "../conexion.php");

$id = $_SESSION['id_i'];

try{
    $sql = "DELETE FROM  WHERE id_Cargardocumentos.php =$id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_i', $id);

    $conn->exec($sql);
    echo "
    <script> 
        alert ('Documento eliminado');
        window.location.href = 'CS.php' 
    </script>";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}