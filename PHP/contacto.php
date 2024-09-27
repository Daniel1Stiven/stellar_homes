<?php
require 'db.php';
session_start();

if (isset($_SESSION['id'])) {
    $clientes_idCliente = $_SESSION['id'];

   
    $sql = "
        SELECT nombre, apellido, email 
        FROM clientes 
        WHERE idCliente = :clientes_idCliente
        
    ";


    $stmt = $pdo->prepare($sql);
    $stmt->execute(['clientes_idCliente' => $clientes_idCliente]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cliente) {
        echo "Cliente no encontrado en la base de datos.";
        $cliente = ['nombre' => '', 'apellido' => '', 'email' => '']; 
    }
} else {
  
    echo "No se ha iniciado sesión o el cliente no está disponible.";
    $cliente = ['nombre' => '', 'apellido' => '', 'email' => '']; 
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Documentos - Inmobiliaria</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <header class="header">
        <img src="../img/sh_blanco-removebg-preview.png" alt="Logo Inmobiliaria">
        <ul class="menu">
            <li><a href="./Página de Inmuebles.html">Volver</a></li>
        </ul>
    </header>

    <div class="form-container">
        <div class="form-wrapper">
            <h2>Te llamamos</h2>

            <form action="guardar_informacion.php" method="post">
    <input type="hidden" name="idInmueble" value="<?php echo htmlspecialchars($_GET['id']); ?>">
    <input type="hidden" name="clientes_idCliente" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">

    
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($cliente['nombre']); ?>" readonly>
    </div>

    <div class="form-group">
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($cliente['apellido']); ?>" readonly>
    </div>

    <div class="form-group">
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($cliente['email']); ?>" readonly>
    </div>

    <div class="form-group">
        <label for="telefono">Teléfono o número de contacto:</label>
        <input type="number" id="telefono" name="telefono" placeholder="Ingrese su número de contacto" required>
    </div>

    <div class="form-group">
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>
    </div>

    <button type="submit">Enviar Información</button>
</form>

        </div>
    </div>
</body>
</html>
