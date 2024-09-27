<?php

require_once(__DIR__ . "/conecta.php");

try {

    $NombreInmobiliaria = $_POST['NombreInmobiliaria'];
    $EmailInmobiliaria = $_POST['EmailInmobiliaria'];

    $stmt = $conn->prepare("UPDATE inmobiliaria SET
    NombreInmobiliaria = :NombreInmobiliaria,
    EmailInmobiliaria = :EmailInmobiliaria  
    WHERE idInmobiliaria = :id_i ");

    $stmt->bindParam(':NombreInmobiliaria', $NombreInmobiliaria);
    $stmt->bindParam(':EmailInmobiliaria', $EmailInmobiliaria);
    $stmt->bindParam(':id_i', $_SESSION['id_i']);
    
    $stmt->execute();
    echo '
    <script> 
        alert ("la inmobiliaria se ha acutalizado correctamente");
        window.location.href = "../Perfilinmobiliario.php" 
    </script>
    ';

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage(); 
}



