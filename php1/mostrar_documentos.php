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

// Manejo de eliminación
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Validar que el ID sea un número
    if (is_numeric($id)) {
        $stmt = $pdo->prepare("DELETE FROM solicitar_documentos WHERE id_Solicitar_Documentos = ?");
        if ($stmt->execute([$id])) {
            header('Location: mostrar_documentos.php'); // Redirigir después de eliminar
            exit;
        } else {
            echo "Error al eliminar el documento.";
        }
    } else {
        echo "ID inválido.";
    }
}

// Obtener todos los documentos
$sql = "SELECT * FROM solicitar_documentos";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$documentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Solicitudes de Documentos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .header {
            background-color: #1a237e;
            color: #fff;
            padding: 1.5em;
        }

        .header img {
            height: 80px;
        }

        .header .navbar {
            justify-content: space-between;
        }

        .header .navbar-nav .nav-item {
            margin-left: 1em;
        }

        .header .navbar-nav .nav-link {
            color: #fff;
            font-weight: bold;
        }

        .header .navbar-nav .nav-link:hover {
            color: #FFB300;
        }

        .table-container {
            margin: 2rem auto;
            padding: 2rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 0.75rem;
            text-align: left;
            color: #333;
        }

        th {
            background-color: #1a237e;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .actions a {
            margin-right: 0.5rem;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .actions a:first-child {
            background-color: #3949ab;
        }

        .actions a:first-child:hover {
            background-color: #303f9f;
        }

        .actions a:last-child {
            background-color: #e53935;
        }

        .actions a:last-child:hover {
            background-color: #c62828;
        }

        /* Ocultar columnas en pantallas pequeñas */
        @media (max-width: 767.98px) {
            .d-md-table-cell {
                display: none;
            }

            .table-container td {
                display: block;
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            .table-container td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 10px;
                font-weight: bold;
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="#"><img src="../img/sh_blanco-removebg-preview.png" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../Perfilinmobiliario.php">Volver</a>
                    </li>
                </ul>
                <h1 class="ml-auto">Listado de Solicitudes de Documentos</h1>
            </div>
        </nav>
    </header>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th class="d-none d-md-table-cell">Nombre del Solicitante</th>
                    <th class="d-none d-md-table-cell">Correo del Solicitante</th>
                    <th class="d-none d-md-table-cell">Tipo de Documento</th>
                    <th class="d-none d-md-table-cell">Solicitud Adicional</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($documentos as $documento): ?>
                <tr>
                    <td data-label="ID"><?php echo htmlspecialchars($documento['id_Solicitar_Documentos']); ?></td>
                    <td data-label="Nombre del Solicitante" class="d-none d-md-table-cell"><?php echo htmlspecialchars($documento['Nombre_Solicitante']); ?></td>
                    <td data-label="Correo del Solicitante" class="d-none d-md-table-cell"><?php echo htmlspecialchars($documento['Correo_Solicitante']); ?></td>
                    <td data-label="Tipo de Documento" class="d-none d-md-table-cell"><?php echo htmlspecialchars($documento['Tipo_documento']); ?></td>
                    <td data-label="Solicitud Adicional" class="d-none d-md-table-cell"><?php echo htmlspecialchars($documento['Solicitud_adicional']); ?></td>
                    <td class="actions" data-label="Acciones">
                        <a href="edit.php?id=<?php echo htmlspecialchars($documento['id_Solicitar_Documentos']); ?>">Editar</a>
                        <a href="?action=delete&id=<?php echo htmlspecialchars($documento['id_Solicitar_Documentos']); ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar este documento?');">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
