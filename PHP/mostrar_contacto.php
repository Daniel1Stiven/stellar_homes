<?php
require 'db.php';

if (!isset($_GET['id'])) {
    echo "ID de inmueble no especificado.";
    exit();
}

$idInmueble = $_GET['id'];

$sql = "SELECT * FROM contacto WHERE id_inmueble = :idInmueble";

$stmt = $pdo->prepare($sql);
$stmt->execute(['idInmueble' => $idInmueble]);
$contactos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos del Inmueble</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="title">Contactos del Inmueble</h1>
        <table class="table is-striped is-hoverable">
            <thead>
                <tr>
                    <th>Nombre del Cliente</th>
                    <th>Apellido del Cliente</th>
                    <th>Correo Electrónico</th>
                    <th>Teléfono de Contacto</th>
                    <th>Fecha de subida</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($contactos): ?>
                <?php foreach ($contactos as $contacto): ?>
                    <?php
                    $sqlCliente = "SELECT Nombre, Apellido, Email FROM clientes WHERE idCliente = :idCliente";
                    $stmtCliente = $pdo->prepare($sqlCliente);
                    $stmtCliente->execute(['idCliente' => $contacto['clientes_idCliente']]); // Use clientes_idCliente here
                    $cliente = $stmtCliente->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($cliente['Nombre']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['Apellido']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['Email']); ?></td>
                        <td><?php echo htmlspecialchars($contacto['TelefonoCliente']); ?></td>
                        <td><?php echo htmlspecialchars($contacto['FechaContacto']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No hay contactos disponibles para este inmueble.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <a href="mostrar_inmuebles.php" class="button">Volver a Mis Publicaciones</a>
    </div>
</body>
</html>
