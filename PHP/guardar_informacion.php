<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $clientes_idCliente = $_POST['clientes_idCliente'] ?? "";
    $telefono = $_POST['telefono'] ?? "";
    $fecha = $_POST['fecha'] ?? "";
    $idInmueble = $_POST['idInmueble'] ?? ""; 
    

    if (!$clientes_idCliente || !$telefono || !$fecha || !$idInmueble) {
        echo  var_dump($clientes_idCliente);
        "Todos los campos son obligatorios.";
        
        exit;
    }

    $sqlCheckInmueble = "SELECT * FROM inmueble WHERE idInmueble = :idInmueble"; 
    $stmtCheck = $pdo->prepare($sqlCheckInmueble);
    $stmtCheck->execute(['idInmueble' => $idInmueble]);

    if ($stmtCheck->rowCount() === 0) {
        echo "El inmueble seleccionado no existe.";
        exit;
    }

    $sql = "INSERT INTO contacto (TelefonoCliente, FechaContacto, id_inmueble, clientes_idCliente) VALUES (:telefono, :fecha, :idInmueble, :clientes_idCliente)";
    
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            'telefono' => $telefono,
            'fecha' => $fecha,
            'idInmueble' => $idInmueble,
            'clientes_idCliente' => $clientes_idCliente
        ]);
        echo '<script>
        alert ("Su carga de informacion ha sido enviado correctamente");
        window.location.href = "usuarioregistrado.php"</script>';
    } catch (PDOException $e) {
        echo "Error al guardar la información: " . $e->getMessage();
    }
} else {
    echo "Método de solicitud no válido.";
}
?>
