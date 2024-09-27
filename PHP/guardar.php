<?php
require 'db.php';

// Recoger los datos del formulario
$descripcion = $_POST['description'] ?? '';
$direccion = $_POST['location'] ?? '';
$datos_de_contacto = $_POST['contact-info'] ?? '';
$nombre_propietario = $_POST['owner-name'] ?? '';
$tipo_de_inmueble = $_POST['property-type'] ?? '';
$transaccion = $_POST['transaction-type'] ?? '';

// Prepara la consulta SQL
$sql = "INSERT INTO inmuebles (Descripcion, Direccion, NumCont, FechaPubli, transaccion_idtransaccion, tipo_idtipo) 
        VALUES (:descripcion, :direccion, :datos_de_contacto, NOW(), :transaccion, :tipo_de_inmueble)";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':datos_de_contacto', $datos_de_contacto);
    $stmt->bindParam(':nombre_propietario', $nombre_propietario);
    $stmt->bindParam(':tipo_de_inmueble', $tipo_de_inmueble);
    $stmt->bindParam(':transaccion', $transaccion);

    if ($stmt->execute()) {
        // Guardar imágenes si es necesario
        if (isset($_FILES['property-images']) && $_FILES['property-images']['error'][0] === UPLOAD_ERR_OK) {
            $imagenes = $_FILES['property-images']['name'];
            $imagenes_tmp = $_FILES['property-images']['tmp_name'];

            foreach ($imagenes_tmp as $key => $tmp_name) {
                $target_file = 'uploads/' . basename($imagenes[$key]);
                if (move_uploaded_file($tmp_name, $target_file)) {
                    echo "Archivo " . htmlspecialchars($imagenes[$key]) . " subido correctamente.";
                } else {
                    echo "Error al subir el archivo " . htmlspecialchars($imagenes[$key]) . ".";
                }
            }
        }
        echo "Inmueble publicado correctamente.";
        echo "<script type='text/javascript'>
        window.location.href = 'mostrar_inmuebles.php';
      </script>"; 
    } else {
        echo "Error al guardar los datos.";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
