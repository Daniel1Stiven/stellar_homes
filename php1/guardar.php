<?php
$host = 'localhost';
$dbname = 'stellar_homes';
$username = 'root';
$password = '';

// Crear conexión
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}



// Verificar si se recibió una solicitud POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_solicitante = $_POST['nombre_solicitante'];
    $correo_solicitante = $_POST['correo_solicitante'];
    $tipo_documento = $_POST['tipo_documento'];
    $solicitud_adicional = $_POST['solicitud_adicional'];

    // Validar los datos (básico)
    if (empty($nombre_solicitante) || empty($correo_solicitante) || empty($tipo_documento) || empty($solicitud_adicional)) {
        die("Todos los campos son obligatorios.");
    }

    // Insertar datos en la tabla solicitar_documentos
    $sql = "INSERT INTO solicitar_documentos (Nombre_Solicitante, Correo_Solicitante, Tipo_documento, Solicitud_adicional) 
            VALUES (:nombre_solicitante, :correo_solicitante, :tipo_documento, :solicitud_adicional)";
    
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute([
        'nombre_solicitante' => $nombre_solicitante,
        'correo_solicitante' => $correo_solicitante,
        'tipo_documento' => $tipo_documento,
        'solicitud_adicional' => $solicitud_adicional
    ]);

    // Verificar si la inserción fue exitosa
    if ($success) {
        header("Location: mostrar_documentos.php");
        exit();
    } else {
        echo "Error al enviar la solicitud.";
    }
} else {
    die("Método de solicitud no válido.");
}
?>
