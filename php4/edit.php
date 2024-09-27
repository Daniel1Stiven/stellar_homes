<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM cargar_documentos_u WHERE id_C_documentos_U = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $cargar_documentos_u = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cargar_documentos_u) {
        die("Documento encontrado.");
    }
} else {
    die("ID de Documento no especificado.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Nombre_Usuario = $_POST['Nombre_Usuario'];
    $Correo_Usuario = $_POST['Correo_Usuario'];
    $Tipo_documento = $_POST['Tipo_documento'];
    $Numero_Documento = $_POST['Numero_Documento'];
    $Cargar_Documento = $_POST['Cargar_Documento'];
    $Certificado_Laboral = $_POST['Certificado_Laboral'];
    $Ultimos_Extractos_Bancarios = $_POST['Ultimos_Extractos_Bancarios'];
    $Certificados_de_ingresos = $_POST['Certificados_de_ingresos'];

    $sql = "UPDATE cargar_documentos_u SET 
            Nombre_Usuario = :Nombre_Usuario, 
            Correo_Usuario = :Correo_Usuario, 
            Tipo_documento = :Tipo_documento,
            Numero_Documento = :Numero_Documento,
            Cargar_Documento = :Cargar_Documento,
            Certificado_Laboral = :Certificado_Laboral,
            Ultimos_Extractos_Bancarios = :Ultimos_Extractos_Bancarios,
            Certificados_de_ingresos = :Certificados_de_ingresos
            WHERE id_C_documentos_U = :id";
    
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute([
        'Nombre_Usuario' => $Nombre_Usuario,
        'Correo_Usuario' => $Correo_Usuario,
        'Tipo_documento' => $Tipo_documento,
        'Numero_Documento' => $Numero_Documento,
        'Cargar_Documento' => $Cargar_Documento,
        'Certificado_Laboral' => $Certificado_Laboral,
        'Ultimos_Extractos_Bancarios' => $Ultimos_Extractos_Bancarios,
        'Certificados_de_ingresos' => $Certificados_de_ingresos,
        'id' => $id
    ]);

    if ($success) {
        header("Location: mostrar_carga_documentos.php");
        exit();
    } else {
        echo "Error al actualizar el contacto.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar contacto</title>
    <link rel="stylesheet" href="style.css">
    <style>
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
    color: #333;
}

header {
    background-color: #1a237e;
    color: #fff;
    padding: 1.5em 0;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

section {
    width: 90%;
    max-width: 800px;
    margin: 2em auto;
    padding: 2em;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 0.5em;
    font-weight: bold;
}

input[type="text"], select {
    padding: 10px;
    margin-bottom: 1em;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="text"]:focus, select:focus {
    border-color: #1a237e;
    outline: none;
}

button {
    background-color: #1a237e;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #3949ab;
}

    </style>
</head>
<body>
    <header>
        <h1>Editar contacto</h1>
    </header>

    <section>
        <form action="edit.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
            <label for="Nombre_Usuario">Nombre Usuario:</label>
            <input type="text" id="Nombre_Usuario" name="Nombre_Usuario" value="<?php echo htmlspecialchars($cargar_documentos_u['Nombre_Usuario']); ?>" required>

            <label for="Correo_Usuario">Correo Usuario</label>
            <input type="text" id="Correo_Usuario" name="Correo_Usuario" value="<?php echo htmlspecialchars($cargar_documentos_u['Correo_Usuario']); ?>" required>

            <label for="Tipo_documento">Tipo de Documento:</label>
            <select id="Tipo_documento" name="Tipo_documento" required>
                <option value="CC" <?php echo ($cargar_documentos_u['Tipo_documento'] == 1) ? 'selected' : ''; ?>>CC</option>
                <option value="CE" <?php echo ($cargar_documentos_u['Tipo_documento'] == 2) ? 'selected' : ''; ?>>CE</option>
            </select>

            <label for="Numero_Documento">Numero Documento</label>
            <input type="text" id="Numero_Documento" name="Numero_Documento" value="<?php echo htmlspecialchars($cargar_documentos_u['Numero_Documento']); ?>" required>

            <label for="Cargar_Documento">Cargar Documento</label>
            <input type="text" id="Cargar_Documento" name="Cargar_Documento" value="<?php echo htmlspecialchars($cargar_documentos_u['Cargar_Documento']); ?>" required>

            <label for="Certificado_Laboral">Certificado Laboral</label>
            <input type="text" id="Certificado_Laboral" name="Certificado_Laboral" value="<?php echo htmlspecialchars($cargar_documentos_u['Certificado_Laboral']); ?>" required>

            <label for="Ultimos_Extractos_Bancarios">Ultimos Extractos Bancarios</label>
            <input type="text" id="Ultimos_Extractos_Bancarios" name="Ultimos_Extractos_Bancarios" value="<?php echo htmlspecialchars($cargar_documentos_u['Ultimos_Extractos_Bancarios']); ?>" required>

            <label for="Certificados_de_ingresos">Certificado Laborales</label>
            <input type="text" id="Certificados_de_ingresos" name="Certificados_de_ingresos" value="<?php echo htmlspecialchars($cargar_documentos_u['Certificados_de_ingresos']); ?>" required>
            <button type="submit">Guardar Cambios</button>
        </form>
    </section>
</body>
</html>
