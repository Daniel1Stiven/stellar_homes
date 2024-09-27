<?php
require 'db.php';

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM inmueble WHERE idInmueble = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    header("Location: mostrar_inmuebles.php");
    exit();
}

$sql = "
    SELECT 
        i.*, 
        t.Descripcion AS transaccion_desc, 
        e.Descripcion AS estado_desc, 
        inm.idInmobiliaria AS inmobiliaria_id,
        inm.NombreInmobiliaria AS inmobiliaria_nombre, 
        tp.Descripcion AS tipo_desc 
    FROM 
        inmueble i
    LEFT JOIN 
        transaccion t ON i.transaccion_idtransaccion = t.idtransaccion
    LEFT JOIN 
        estado e ON i.estado_id_estado = e.id_estado
    LEFT JOIN 
        inmobiliaria inm ON i.inmobiliaria_idInmobiliaria = inm.idInmobiliaria
    LEFT JOIN 
        tipo tp ON i.tipo_idtipo = tp.idtipo
";

$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Publicaciones</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <style>
        body {
            background-image: url('../img/diseno-de-casas-modernas-1_0.jpg');
            background-size: cover; 
            background-position: center center;
            background-attachment: fixed; 
            background-repeat: no-repeat; 
            height: 100vh;
            margin: 0; 
            padding: 0; 
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
        }

        .header .title {
            flex: 1;
            text-align: center;
            margin: 0;
            color: #FFB300; 
        }

        .header .button {
            background-color: #FFB300;
            color: #1a237e;
        }

        .header .button:hover {
            background-color: #e0a800;
            color: white;
        }

        .card {
            margin-bottom: 1.5em;
        }

        .card-image img {
            border-radius: 10px 10px 0 0;
        }

        .card-content {
            background-color: #fff;
        }

        .card-title {
            color: #1a237e;
        }

        .button.is-primary {
            background-color: #1a237e;
            border-color: #1a237e;
        }

        .button.is-primary:hover {
            background-color: #3949ab;
            border-color: #3949ab;
        }

        .button.is-danger {
            background-color: #e74c3c;
            border-color: #e74c3c;
        }

        .button.is-danger:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }
    </style>
</head>
<body>
    <header class="header">
        <img src="../img/sh_blanco-removebg-preview.png" alt="Logo">
        <h1 class="title">Mis Publicaciones</h1>
        <a href="../Perfilinmobiliario.php" class="button">Volver</a>
    </header>

    <div class="container mt-4">
        <div class="columns is-multiline">
            <?php foreach ($rows as $row): ?>
                <div class="column is-one-third">
                    <div class="card">
                        <?php if (!empty($row['imagen']) && file_exists($row['imagen'])): ?>
                            <div class="card-image">
                                <figure class="image">
                                    <img src="<?php echo htmlspecialchars($row['imagen']); ?>" alt="Imagen del inmueble">
                                </figure>
                            </div>
                        <?php else: ?>
                            <div class="card-image">
                                <figure class="image">
                                    <img src="../img/diseno-de-casas-modernas-1_0.jpg" alt="Imagen no disponible">
                                </figure>
                            </div>
                        <?php endif; ?>
                        <div class="card-content">
                            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($row['Nombre']); ?></p>
                            <p><strong>Descripción:</strong> <?php echo htmlspecialchars($row['Descripcion']); ?></p>
                            <p><strong>Localidad:</strong> <?php echo htmlspecialchars($row['localidad']); ?></p>
                            <p><strong>Dirección:</strong> <?php echo htmlspecialchars($row['Direccion']); ?></p>
                            <p><strong>Datos de Contacto:</strong> <?php echo htmlspecialchars($row['NumCont']); ?></p>
                            <p><strong>Precio:</strong> <?php echo htmlspecialchars($row['precio']); ?></p>
                            <p><strong>Fecha de Publicación:</strong> <?php echo htmlspecialchars($row['FechaPubli']); ?></p>
                            <p><strong>Transacción:</strong> <?php echo htmlspecialchars($row['transaccion_desc']); ?></p>
                            <p><strong>Estado:</strong> <?php echo htmlspecialchars($row['estado_desc']); ?></p>
                            <p><strong>Inmobiliaria:</strong> <?php echo htmlspecialchars($row['inmobiliaria_nombre'] ?? 'No disponible'); ?></p>
                            <a href="edit.php?id=<?php echo htmlspecialchars($row['idInmueble']); ?>" class="button is-primary">Editar</a>
                            <a href="?action=delete&id=<?php echo htmlspecialchars($row['idInmueble']); ?>" class="button is-danger">Eliminar</a>
                            <a href="mostrar_contacto.php?id=<?php echo htmlspecialchars($row['idInmueble']); ?>" class="button is-info">Ver Contactos</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
