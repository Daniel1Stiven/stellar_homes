<?php
require 'db.php';
    $Nombre_Usuario = $_POST['Nombre_Usuario'];
    $Correo_Usuario = $_POST['Correo_Usuario'];
    $Tipo_documento = $_POST['Tipo_documento'];
    $Numero_Documento = $_POST['Numero_Documento'];
    $Cargar_Documento = $_POST['Cargar_Documento'];
    $Certificado_Laboral = $_POST['Certificado_Laboral'];
    $Ultimos_Extractos_Bancarios = $_POST['Ultimos_Extractos_Bancarios'];
    $Certificados_de_ingresos = $_POST['Certificados_de_ingresos'];

$sql = "INSERT INTO cargar_documentos_u (Nombre_Usuario, Correo_Usuario, Tipo_documento, Numero_Documento, Cargar_Documento, Certificado_Laboral, Ultimos_Extractos_Bancarios, Certificados_de_ingresos) VALUES (:Nombre_Usuario, :Correo_Usuario, :Tipo_documento, :Numero_Documento, :Cargar_Documento, :Certificado_Laboral, :Ultimos_Extractos_Bancarios, :Certificados_de_ingresos)";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':Nombre_Usuario', $Nombre_Usuario);
    $stmt->bindParam(':Correo_Usuario', $Correo_Usuario);
    $stmt->bindParam(':Tipo_documento', $Tipo_documento);
    $stmt->bindParam(':Numero_Documento', $Numero_Documento);
    $stmt->bindParam(':Cargar_Documento', $Cargar_Documento);
    $stmt->bindParam(':Certificado_Laboral', $Certificado_Laboral);
    $stmt->bindParam(':Ultimos_Extractos_Bancarios', $Ultimos_Extractos_Bancarios);
    $stmt->bindParam(':Certificados_de_ingresos', $Certificados_de_ingresos);
 


    if ($stmt->execute()) {
        echo '<script>
        alert ("Su carga de documentos ha sido enviado correctamente");
        window.location.href = "../Perfilusuario.html"</script>';
    } else {
        echo "Error al guardar los datos.";
        
       
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>
