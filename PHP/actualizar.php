<?php

require_once(__DIR__ . "/conectar.php");

try {

    $Nombre = $_POST['Nombre'];
    $Apellido = $_POST['Apellido'];
    $Edad= $_POST['Edad'];
    $Email = $_POST['Email'];

    $stmt = $conn->prepare("UPDATE clientes SET
    Nombre = :Nombre  ,
    Apellido = :Apellido ,
    Edad = :Edad ,
    Email = :Email  
    WHERE idCliente = :id ");

    $stmt->bindParam(':Nombre', $Nombre);
    $stmt->bindParam(':Apellido', $Apellido);
    $stmt->bindParam(':Edad', $Edad);
    $stmt->bindParam(':Email', $Email);
    $stmt->bindParam(':id', $_SESSION['id']);
    
    $stmt->execute();
    echo '
    <script> 
        alert ("¡El usuario se ha acutalizado correctamente");
        window.location.href = "misdatos.php" 
    </script>
    ';

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage(); 
}



