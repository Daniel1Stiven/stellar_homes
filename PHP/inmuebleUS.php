<?php
require 'db.php';

$sql = "
    SELECT 
        i.Nombre,
        i.imagen,
        i.Descripcion, 
        i.localidad,
        i.Direccion, 
        i.precio, 
        i.FechaPubli,
        e.Descripcion AS estado_desc
    FROM 
        inmueble i
    LEFT JOIN 
        estado e ON i.estado_id_estado = e.id_estado
";

$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propiedades - Inmobiliaria</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
    <header>
        <img src="../img/sh_blanco-removebg-preview.png" alt="Logo" class="logo">
    </header>

    <section class="properties-section">
        <?php foreach ($rows as $row): ?>
            <div class="property-container">
                <div class="property-images">
                    <?php if (!empty($row['imagen']) && file_exists($row['imagen'])): ?>
                        <img src="<?php echo htmlspecialchars($row['imagen']); ?>" alt="Imagen del inmueble">
                    <?php else: ?>
                        <img src="../img/diseno-de-casas-modernas-1_0.jpg" alt="Imagen no disponible">
                    <?php endif; ?>
                </div>
                <div class="property-description">
                    <h3><?php echo htmlspecialchars($row['Nombre']); ?></h3>
                    <p>Descripción: <?php echo htmlspecialchars($row['Descripcion']); ?></p>
                    <p>Localidad: <?php echo htmlspecialchars($row['localidad']); ?></p>
                    <p>Dirección: <?php echo htmlspecialchars($row['Direccion']); ?></p>
                    <p>Precio: $<?php echo number_format(htmlspecialchars($row['precio'])); ?></p>
                    <p>Fecha de Publicación: <?php echo htmlspecialchars($row['FechaPubli']); ?></p>
                    <div class="property-status">
                        Estado: <?php echo htmlspecialchars($row['estado_desc']); ?>   
                    </div>
                    <a href="./contacto.php" class="contact-button">
                            <button>Contacto</button>
                        </a>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

    <footer>
        <a href="./usuarioregistrado.php">
            <button class="dropbtn">Volver</button>
        </a>
        <p>&copy; 2024 Inmobiliaria. Todos los derechos reservados.</p>
    </footer>

</body>

</html>
