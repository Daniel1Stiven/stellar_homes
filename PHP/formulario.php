<?php

require 'db.php';

$query_estados = "SELECT id_estado, descripcion FROM estado";
$stmt_estados = $pdo->prepare($query_estados);
$stmt_estados->execute();
$estados = $stmt_estados->fetchAll(PDO::FETCH_ASSOC);

$query_tipos = "SELECT idtipo, descripcion FROM tipo";
$stmt_tipos = $pdo->prepare($query_tipos);
$stmt_tipos->execute();
$tipos = $stmt_tipos->fetchAll(PDO::FETCH_ASSOC);

$query_transacciones = "SELECT idtransaccion, descripcion FROM transaccion";
$stmt_transacciones = $pdo->prepare($query_transacciones);
$stmt_transacciones->execute();
$transacciones = $stmt_transacciones->fetchAll(PDO::FETCH_ASSOC);

$inmobiliaria_idInmobiliaria = 1; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Nombre = $_POST['Nombre'];
    $descripcion = $_POST['descripcion'];
    $localidad = $_POST['localidad'];
    $direccion = $_POST['direccion'];
    $numCont = $_POST['numCont'];
    $precio = $_POST['precio'];
    $fechaPubli = $_POST['fechaPubli'];
    $estado_id_estado = $_POST['estado_id_estado'];
    $tipo_idtipo = $_POST['tipo_idtipo'];
    $transaccion_idtransaccion = $_POST['transaccion_idtransaccion'];

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagenTmp = $_FILES['imagen']['tmp_name'];
        $imagenNombre = basename($_FILES['imagen']['name']);
        $imagenRuta = 'uploads/' . $imagenNombre;

        if (move_uploaded_file($imagenTmp, $imagenRuta)) {
            $sql = "INSERT INTO inmueble (Nombre, imagen, Descripcion, localidad, Direccion, NumCont, precio, FechaPubli, estado_id_estado, tipo_idtipo, transaccion_idtransaccion, inmobiliaria_idInmobiliaria) VALUES (:Nombre, :imagen, :descripcion, :localidad, :direccion, :numCont, :precio, :fechaPubli, :estado_id_estado, :tipo_idtipo, :transaccion_idtransaccion, :inmobiliaria_idInmobiliaria)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':Nombre', $Nombre);
            $stmt->bindParam(':imagen', $imagenRuta);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':localidad', $localidad);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':numCont', $numCont);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':fechaPubli', $fechaPubli);
            $stmt->bindParam(':estado_id_estado', $estado_id_estado);
            $stmt->bindParam(':tipo_idtipo', $tipo_idtipo);
            $stmt->bindParam(':transaccion_idtransaccion', $transaccion_idtransaccion);
            $stmt->bindParam(':inmobiliaria_idInmobiliaria', $inmobiliaria_idInmobiliaria);

            if ($stmt->execute()) {
                echo "Inmueble añadido correctamente.";
            } else {
                echo "Error al añadir el inmueble.";
            }
        } else {
            echo "Error al mover el archivo.";
        }
    } else {
        echo "Archivo de imagen no válido o no se ha subido.";
    }
}
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
            color: #F5F5F5;
        }

        .header .button {
            background-color: #FFB300;
            color: #1a237e;
        }

        .header .button:hover {
            background-color: #e0a800;
            color: #1a237e;
        }

        .container {
            margin-top: 2em;
        }

        .form-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 2em;
        }

        .form-group {
            margin-bottom: 1em;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input, .form-group select {
            width: 100%;
            border-radius: 4px;
        }

        .form-group input[type="file"] {
            padding: 0;
        }

        .button.is-primary {
            background-color: #1a237e;
            border-color: #1a237e;
        }

        .button.is-primary:hover {
            background-color: #3949ab;
            border-color: #3949ab;
        }
    </style>
</head>
<body>
    <header class="header">
        <img src="../img/sh_blanco-removebg-preview.png" alt="Logo">
        <h1 class="title">Publicar Inmueble</h1>
        <a href="../Perfilinmobiliario.php" class="button">Volver</a>
    </header>

    <div class="container">
        <div class="form-container">
            <h2 class="title is-4">Añadir Inmueble</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="Nombre">Nombre del Inmueble:</label>
                    <input type="text" id="Nombre" name="Nombre" class="input" placeholder="Ingrese el Nombre del Inmueble" required>
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen del Inmueble:</label>
                    <input type="file" id="imagen" name="imagen" class="input" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción del Inmueble:</label>
                    <input type="text" id="descripcion" name="descripcion" class="input" placeholder="Descripción del inmueble" required>
                </div>
                <div class="form-group">
                    <label for="localidad">Localidad:</label>
                    <input type="text" id="localidad" name="localidad" class="input" placeholder="Ingrese la localidad donde esta ubicado el inmueble" required>
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" class="input" placeholder="Dirección del inmueble" required>
                </div>
                <div class="form-group">
                    <label for="numCont">Número de Contacto:</label>
                    <input type="text" id="numCont" name="numCont" class="input" placeholder="Número de contacto" required>
                </div>
                <div class="form-group">
                    <label for="precio">Precio del Inmueble:</label>
                    <input type="text" id="precio" name="precio" class="input" placeholder="Ingrese el precio del inmueble" required>
                </div>
                <div class="form-group">
                    <label for="fechaPubli">Fecha de Publicación:</label>
                    <input type="date" id="fechaPubli" name="fechaPubli" class="input" required>
                </div>
                <div class="form-group">
                    <label for="estado_id_estado">Estado:</label>
                    <div class="select">
                        <select id="estado_id_estado" name="estado_id_estado" required>
                            <?php foreach ($estados as $estado): ?>
                                <option value="<?php echo htmlspecialchars($estado['id_estado']); ?>">
                                    <?php echo htmlspecialchars($estado['descripcion']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tipo_idtipo">Tipo:</label>
                    <div class="select">
                        <select id="tipo_idtipo" name="tipo_idtipo" required>
                            <?php foreach ($tipos as $tipo): ?>
                                <option value="<?php echo htmlspecialchars($tipo['idtipo']); ?>">
                                    <?php echo htmlspecialchars($tipo['descripcion']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="transaccion_idtransaccion">Transacción:</label>
                    <div class="select">
                        <select id="transaccion_idtransaccion" name="transaccion_idtransaccion" required>
                            <?php foreach ($transacciones as $transaccion): ?>
                                <option value="<?php echo htmlspecialchars($transaccion['idtransaccion']); ?>">
                                    <?php echo htmlspecialchars($transaccion['descripcion']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
              
                <input type="hidden" id="inmobiliaria_idInmobiliaria" name="inmobiliaria_idInmobiliaria" value="<?php echo htmlspecialchars($inmobiliaria_idInmobiliaria); ?>">
                
                <button type="submit" class="button is-primary">Añadir Inmueble</button>
            </form>
        </div>
    </div>
</body>
</html>
