<?php

require_once(__DIR__ . "/conectar.php");

try {
    $Nombre = $_POST['Nombre'];
    $Apellido = $_POST['Apellido'];
    $Edad= $_POST['Edad'];
    $Email = $_POST['Email'];
    $ContrasenaCliente = $_POST['ContrasenaCliente'];
    $tipo_doc_id_tipoDoc = $_POST['tipo_doc_id_tipoDoc']; 


        $stmt = $conn->prepare("INSERT INTO clientes (Nombre, Apellido, Edad, Email, ContrasenaCliente, tipo_doc_id_tipoDoc) 
        VALUES (:Nombre, :Apellido, :Edad, :Email, :ContrasenaCliente, :tipo_doc_id_tipoDoc)");
        
        $stmt->bindParam(':Nombre', $Nombre);
        $stmt->bindParam(':Apellido', $Apellido);
        $stmt->bindParam(':Edad', $Edad);
        $stmt->bindParam(':Email', $Email);
        $stmt->bindParam(':ContrasenaCliente', $ContrasenaCliente);
        $stmt->bindParam(':tipo_doc_id_tipoDoc', $tipo_doc_id_tipoDoc);

        $stmt->execute();
        $last_id = $conn->lastInsertId();

  $_SESSION['id'] = $last_id;
          echo '
          <script> 
              alert ("El cliente se ha registrado correctamente");
              window.location.href = "./usuarioregistrado.php" 
          </script>
          ';

        
      
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage(); 
}
?>
