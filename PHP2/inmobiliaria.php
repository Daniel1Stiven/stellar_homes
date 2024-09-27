<?php
 

 require(__DIR__ . "/conecta.php");  

try{

  $NombreInmobiliaria=$_POST['NombreInmobiliaria'];
  $EmailInmobiliaria=$_POST['EmailInmobiliaria'];
  $Telefono=$_POST['Telefono'];
  $Direccion=$_POST['Direccion']; 
  $ContrasenaInmobiliaria=$_POST['ContrasenaInmobiliaria'];
 

  $stmt = $conn->prepare("INSERT INTO  inmobiliaria (NombreInmobiliaria , EmailInmobiliaria , Telefono , Direccion,  ContrasenaInmobiliaria )  
  VALUES (:NombreInmobiliaria , :EmailInmobiliaria , :Telefono , :Direccion, :ContrasenaInmobiliaria )");

  $stmt->bindParam(':NombreInmobiliaria', $NombreInmobiliaria);
  $stmt->bindParam(':EmailInmobiliaria', $EmailInmobiliaria);
  $stmt->bindParam(':Telefono', $Telefono);
  $stmt->bindParam(':Direccion', $Direccion);
  $stmt->bindParam(':ContrasenaInmobiliaria', $ContrasenaInmobiliaria);


  $stmt->execute();

  $last_id = $conn->lastInsertId();

  $_SESSION['id_i'] = $last_id;
          echo '
          <script> 
              alert ("La inmobiliaria se ha registrado correctamente");
              window.location.href = "../Perfilinmobiliario.php" 
          </script>
          ';
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage(); 
}
  

?>
