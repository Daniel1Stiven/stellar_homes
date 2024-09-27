<?php
require 'db.php';

$idInmueble = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$inmueble = null; 

if ($idInmueble > 0) {
    $sql = "
        SELECT 
            i.idInmueble, 
            i.Nombre, 
            i.Descripcion, 
            i.localidad, 
            i.Direccion, 
            i.precio, 
            i.FechaPubli, 
            i.imagen, 
            e.Descripcion AS estado_desc
        FROM 
            inmueble i
        LEFT JOIN 
            estado e ON i.estado_id_estado = e.id_estado
        WHERE 
            i.idInmueble = :idInmueble
    ";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['idInmueble' => $idInmueble]);
        $inmueble = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Inmueble</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <style>
        header {
            background-color: #1a237e; 
            color: white;
            padding: 1rem 0;
        }
        .logo {
            max-width: 150px;
            margin: 0 auto;
            display: block;
        }
        .property-detail {
            background-color: #ffffff;
            border-radius: 10px; 
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); 
            margin: 2rem 0; 
        }
        footer {
            background-color: #1a237e;
            color: white;
            padding: 1rem 0;
        }
        .notification.is-danger {
            background-color: #ffdddd; 
            border: 1px solid #ff0000; 
        }
        .button.is-warning {
            background-color: #ffcc00; 
            border: none;
        }
        .button.is-info {
            background-color: #0099cc; 
            border: none;
        }
    </style>
</head>

<body>
    <header>
        <div class="container has-text-centered">
            <img src="../img/sh_blanco-removebg-preview.png" alt="Logo" class="logo">
        </div>
    </header>

    <div class="container mt-5">
        <?php if ($inmueble): ?>
            <section class="property-detail">
                <h2 class="title has-text-centered"><?php echo htmlspecialchars($inmueble['Nombre']); ?></h2>
                <div class="columns">
                    <div class="column is-half">
                        <?php
                        $imageFileName = htmlspecialchars($inmueble['imagen']);
                        $imagePath = './uploads/' . basename($imageFileName);
                        ?>
                        <figure class="image">
                            <?php if (!empty($imageFileName) && file_exists($imagePath)): ?>
                                <img src="<?php echo $imagePath; ?>" alt="Imagen del inmueble">
                            <?php else: ?>
                                <img src="../img/diseno-de-casas-modernas-1_0.jpg" alt="Imagen no disponible">
                            <?php endif; ?>
                        </figure>
                    </div>
                    <div class="column is-half">
                        <div class="content">
                            <p><strong>Descripción:</strong> <?php echo htmlspecialchars($inmueble['Descripcion']); ?></p>
                            <p><strong>Localidad:</strong> <?php echo htmlspecialchars($inmueble['localidad']); ?></p>
                            <p><strong>Dirección:</strong> <?php echo htmlspecialchars($inmueble['Direccion']); ?></p>
                            <p><strong>Precio:</strong> $<?php echo number_format(htmlspecialchars($inmueble['precio'])); ?></p>
                            <p><strong>Fecha de Publicación:</strong> <?php echo htmlspecialchars($inmueble['FechaPubli']); ?></p>
                            <p><strong>Estado:</strong> <?php echo htmlspecialchars($inmueble['estado_desc']); ?></p>
                            <a href="./contacto.php?id=<?php echo $inmueble['idInmueble']; ?>" class="button is-warning mt-3">Contacto</a>

                        </div>
                    </div>
                </div>
            </section>
        <?php else: ?>
            <div class="notification is-danger">
                <p>El inmueble solicitado no existe.</p>
            </div>
        <?php endif; ?>
    </div>

    <footer class="has-background-dark mt-5">
        <div class="container has-text-centered">
            <a href="usuarioregistrado.php" class="button is-info">Volver a Propiedades</a>
            <p class="mt-3">&copy; 2024 Inmobiliaria. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>
