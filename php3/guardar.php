<?php
require 'db.php';

$Nombre_Completo_Solicitante = isset($_POST['Nombre_Completo_Solicitante']) ? $_POST['Nombre_Completo_Solicitante'] : null;
$Correo = isset($_POST['Correo']) ? $_POST['Correo'] : null;
$Fecha = isset($_POST['Fecha']) ? $_POST['Fecha'] : null;
$Numero_Documento = isset($_POST['Numero_Documento']) ? $_POST['Numero_Documento'] : null;
$Cargar_Documento = isset($_POST['Cargar_Documento']) ? $_POST['Cargar_Documento'] : null;
$Certificado_Laboral = isset($_POST['Certificado_Laboral']) ? $_POST['Certificado_Laboral'] : null;
$Ultimos_Extractos_Bancarios = isset($_POST['Ultimos_Extractos_Bancarios']) ? $_POST['Ultimos_Extractos_Bancarios'] : null;
$Certificados_de_ingresos = isset($_POST['Certificados_de_ingresos']) ? $_POST['Certificados_de_ingresos'] : null;

// Validación de variables
if ($Nombre_Completo_Solicitante && $Correo && $Numero_Documento) {
    $sql = "INSERT INTO documentos (Nombre_Completo_Solicitante, Correo, Fecha, Numero_Documento, Cargar_Documento, Certificado_Laboral, Ultimos_Extractos_Bancarios, Certificados_de_ingresos) 
            VALUES (:Nombre_Completo_Solicitante, :Correo, :Fecha, :Numero_Documento, :Cargar_Documento, :Certificado_Laboral, :Ultimos_Extractos_Bancarios, :Certificados_de_ingresos)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':Nombre_Completo_Solicitante', $Nombre_Completo_Solicitante);
        $stmt->bindParam(':Correo', $Correo);
        $stmt->bindParam(':Fecha', $Fecha);
        $stmt->bindParam(':Numero_Documento', $Numero_Documento);
        $stmt->bindParam(':Cargar_Documento', $Cargar_Documento);
        $stmt->bindParam(':Certificado_Laboral', $Certificado_Laboral);
        $stmt->bindParam(':Ultimos_Extractos_Bancarios', $Ultimos_Extractos_Bancarios);
        $stmt->bindParam(':Certificados_de_ingresos', $Certificados_de_ingresos);

        if ($stmt->execute()) {
          
            if (isset($_FILES['property-images']) && $_FILES['property-images']['error'][0] === UPLOAD_ERR_OK) {
                $imagenes = $_FILES['property-images']['name'];
                $imagenes_tmp = $_FILES['property-images']['tmp_name'];

              
                foreach ($imagenes_tmp as $key => $tmp_name) {
                    $target_file = 'uploads/' . basename($imagenes[$key]);
                    if (move_uploaded_file($tmp_name, $target_file)) {
                        echo "Archivo " . htmlspecialchars($imagenes[$key]) . " subido correctamente.<br>";
                    } else {
                        echo "Error al subir el archivo " . htmlspecialchars($imagenes[$key]) . ".<br>";
                    }
                }
            }
            echo "Inmueble publicado correctamente.<br>";
        } else {
            echo "Error al guardar los datos.<br>";
        }

        
        echo "<script type='text/javascript'>
        window.location.href = 'mostrar_inmuebles.php';
        </script>";

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Por favor, complete los campos requeridos.";
}
?>
