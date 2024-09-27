<?php
require 'db.php';

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM cargar_documentos_u WHERE id_C_documentos_U = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    header("Location: mostrar_carga_documentos.php");
    exit();
}


$sql = "SELECT * FROM cargar_documentos_u"; 
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Inmuebles</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>

body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    color: #333;
}

header {
    background-color: #1a237e;
    color: #fff;
    padding: 1.5em 0;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.header {
background-color: #1a237e;
color: #fff;
padding: 1.5em;
display: flex;
align-items: center;
justify-content: space-between;
 }

.header img {
height: 110px;
margin: 10px;
padding: 100; 
}

.header .title {
flex: 1;
text-align: center;
margin: 0;
color : #fff;
}

.header .button {
color: #FDFDFDFF;
text-decoration: none;
} 

section {
    width: 90%;
    max-width: 1200px;
    margin: 2em auto;
    padding: 1em;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1em;
}

table th, table td {
    padding: 12px;
    text-align: left;
}

table thead {
    background-color: #1a237e;
    color: #fff;
}

table thead th {
    border-bottom: 2px solid #fff;
}

table tbody tr:nth-child(even) {
    background-color: #f4f4f4;
}

table tbody tr:hover {
    background-color: #e0e0e0;
}

table td, table th {
    border: 1px solid #ddd;
}

table a {
    color: #1a237e;
    text-decoration: none;
    font-weight: bold;
}

table a:hover {
    text-decoration: underline;
}

table .actions a {
    margin-right: 10px;
}

</style>
<body>
<header class="header">
        <img src="../img/sh_blanco-removebg-preview.png" alt="Logo"> 
        <h1 class="title">VERFICAR DOCUMENTOS</h1>
        <a href="../Perfilinmobiliario.php" class="button">Volver</a>
    </header>

    <section>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Usuario</th>
                    <th>Correo Usuario</th>
                    <th>Tipo Documento</th>
                    <th>Numero Documento</th>
                    <th>Cargar Documento</th>
                    <th>Certificado Laboral</th>
                    <th>Ultimos Extractos Bancarios </th>
                    <th>Certficado Laborales</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id_C_documentos_U']); ?></td>
                        <td><?php echo htmlspecialchars($row['Nombre_Usuario']); ?></td>
                        <td><?php echo htmlspecialchars($row['Correo_Usuario']); ?></td>
                        <td><?php echo htmlspecialchars($row['Tipo_documento']); ?></td>
                        <td><?php echo htmlspecialchars($row['Numero_Documento']); ?></td>
                        <td><?php echo htmlspecialchars($row['Cargar_Documento']); ?></td>
                        <td><?php echo htmlspecialchars($row['Certificado_Laboral']); ?></td>
                        <td><?php echo htmlspecialchars($row['Ultimos_Extractos_Bancarios']); ?></td>
                        <td><?php echo htmlspecialchars($row['Certificados_de_ingresos']); ?></td>

                        <td>
                            <!-- <a href="edit.php?id=<?php echo htmlspecialchars($row['id_C_documentos_U']); ?>">Editar</a> | -->
                            <a href="mostrar_carga_documentos.php?action=delete&id=<?php echo htmlspecialchars($row['id_C_documentos_U']); ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar este contacto?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>
</html>
