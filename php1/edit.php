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

// Verificar si el ID del documento fue pasado como parámetro
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos del documento para editar
    $sql = "SELECT * FROM solicitar_documentos WHERE id_Solicitar_documentos = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $documento = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró el documento
    if (!$documento) {
        die("Documento no encontrado.");
    }
} else {
    die("ID de documento no especificado.");
}

// Manejar la actualización de datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_solicitante = $_POST['nombre_solicitante'];
    $correo_solicitante = $_POST['correo_solicitante'];
    $tipo_documento = $_POST['tipo_documento'];
    $solicitud_adicional = $_POST['solicitud_adicional'];

    $sql = "UPDATE Solicitar_Documentos SET 
            Nombre_Solicitante = :nombre_solicitante, 
            Correo_Solicitante = :correo_solicitante, 
            Tipo_documento = :tipo_documento, 
            Solicitud_adicional = :solicitud_adicional 
            WHERE id_Solicitar_documentos = :id";
    
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute([
        'nombre_solicitante' => $nombre_solicitante,
        'correo_solicitante' => $correo_solicitante,
        'tipo_documento' => $tipo_documento,
        'solicitud_adicional' => $solicitud_adicional,
        'id' => $id
    ]);

    // Verificar si la actualización fue exitosa antes de redirigir
    if ($success) {
        header("Location: mostrar_documentos.php");
        exit();
    } else {
        echo "Error al actualizar el documento.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Solicitud de Documentos</title>
    <!-- Integrar Bulma -->
    <link href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
            color: #333;
        }
        .header {
            background-color: #1a237e;
            color: #fff;
            padding: 1.5em 0;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <header class="header">
        <h1 class="title has-text-white">Editar Solicitud de Documentos</h1>
    </header>

    <section class="section">
        <div class="container">
            <form action="edit.php?id=<?php echo htmlspecialchars($id); ?>" method="post" class="box">
                <div class="field">
                    <label class="label" for="nombre_solicitante">Nombre del Solicitante:</label>
                    <div class="control">
                        <input class="input" type="text" id="nombre_solicitante" name="nombre_solicitante" value="<?php echo htmlspecialchars($documento['Nombre_Solicitante']); ?>" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="correo_solicitante">Correo del Solicitante:</label>
                    <div class="control">
                        <input class="input" type="text" id="correo_solicitante" name="correo_solicitante" value="<?php echo htmlspecialchars($documento['Correo_Solicitante']); ?>" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="Tipo_documento">Tipo de Documento:</label>
                    <div class="control">
                        <div class="select is-fullwidth">
                            <select id="Tipo_documento" name="Tipo_documento" required>
                                <option value="">-- Seleccione --</option>
                                <option value="C.C" <?php echo ($documento['Tipo_documento'] == 1) ? 'selected' : ''; ?>>C.C</option>
                                <option value="C.E" <?php echo ($documento['Tipo_documento'] == 2) ? 'selected' : ''; ?>>C.E</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="solicitud_adicional">Solicitud Adicional:</label>
                    <div class="control">
                        <input class="input" type="text" id="solicitud_adicional" name="solicitud_adicional" value="<?php echo htmlspecialchars($documento['Solicitud_adicional']); ?>" required>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-primary" type="submit">Guardar Cambios</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>
</html>