<?php
require 'db.php';

// Crear conexión
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Verificar si se proporciona el ID en la URL
if (!isset($_GET['id'])) {
    die("Error: ID de inmueble no proporcionado.");
}
$id_inmueble = $_GET['id'];

// Consultar los datos del inmueble existente
$query_inmueble = "SELECT * FROM inmueble WHERE idInmueble = :id";
$stmt_inmueble = $pdo->prepare($query_inmueble);
$stmt_inmueble->bindParam(':id', $id_inmueble, PDO::PARAM_INT);
$stmt_inmueble->execute();
$inmueble = $stmt_inmueble->fetch(PDO::FETCH_ASSOC);

if (!$inmueble) {
    echo "Inmueble no encontrado.";
    exit;
}

// Si el formulario ha sido enviado
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

    // Verificar si se subió una nueva imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagenTmp = $_FILES['imagen']['tmp_name'];
        $imagenNombre = basename($_FILES['imagen']['name']);
        $imagenRuta = 'uploads/' . $imagenNombre;

        // Mover la imagen subida a la carpeta de destino
        if (move_uploaded_file($imagenTmp, $imagenRuta)) {
            $sql = "UPDATE inmueble SET Nombre = :Nombre, imagen = :imagen, Descripcion = :descripcion, localidad = :localidad, Direccion = :direccion, NumCont = :numCont, precio = :precio, FechaPubli = :fechaPubli, estado_id_estado = :estado_id_estado, tipo_idtipo = :tipo_idtipo, transaccion_idtransaccion = :transaccion_idtransaccion WHERE idInmueble = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':imagen', $imagenRuta);
        } else {
            echo "Error al mover el archivo de imagen.";
            exit;
        }
    } else {
        $sql = "UPDATE inmueble SET Nombre = :Nombre, Descripcion = :descripcion, localidad = :localidad, Direccion = :direccion, NumCont = :numCont, precio = :precio, FechaPubli = :fechaPubli, estado_id_estado = :estado_id_estado, tipo_idtipo = :tipo_idtipo, transaccion_idtransaccion = :transaccion_idtransaccion WHERE idInmueble = :id";
        $stmt = $pdo->prepare($sql);
    }
    $stmt->bindParam(':Nombre', $Nombre);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':localidad', $localidad);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':numCont', $numCont);
    $stmt->bindParam(':precio', $precio);
    $stmt->bindParam(':fechaPubli', $fechaPubli);
    $stmt->bindParam(':estado_id_estado', $estado_id_estado);
    $stmt->bindParam(':tipo_idtipo', $tipo_idtipo);
    $stmt->bindParam(':transaccion_idtransaccion', $transaccion_idtransaccion);
    $stmt->bindParam(':id', $id_inmueble, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: mostrar_inmuebles.php");
    exit();
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
    background-size: cover; /* Asegura que la imagen cubra toda el área del body */
    background-position: center center; /* Centra la imagen en el área visible */
    background-attachment: fixed; /* Fija la imagen en su lugar cuando se desplaza la página */
    background-repeat: no-repeat; /* Evita que la imagen se repita */
    height: 100vh; /* Hace que el body ocupe toda la altura de la ventana */
    margin: 0; /* Elimina los márgenes por defecto del body */
    padding: 0; /* Elimina el padding por defecto del body */
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
        }

        .header .button {
            background-color: #FFB300;
            color: #1a237e;
        }

        .header .button:hover {
            background-color: #e0a800;
            color: #1a237e;
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
    </header>

    <div class="container mt-5">
        <div class="box">
            <h1 class="title is-3">Editar Inmueble</h1>
            <form action="edit.php?id=<?php echo htmlspecialchars($id_inmueble); ?>" method="post" enctype="multipart/form-data">
            <div class="field">
                    <label class="label">Nombre</label>
                    <div class="control">
                        <input class="input" type="text" name="Nombre" value="<?php echo htmlspecialchars($inmueble['Nombre']); ?>" required>
                    </div>
                <div class="field">
                    <label class="label">Descripción</label>
                    <div class="control">
                        <input class="input" type="text" name="descripcion" value="<?php echo htmlspecialchars($inmueble['Descripcion']); ?>" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Localidad</label>
                    <div class="control">
                        <input class="input" type="text" name="localidad" value="<?php echo htmlspecialchars($inmueble['localidad']); ?>" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Dirección</label>
                    <div class="control">
                        <input class="input" type="text" name="direccion" value="<?php echo htmlspecialchars($inmueble['Direccion']); ?>" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Datos de Contacto</label>
                    <div class="control">
                        <input class="input" type="text" name="numCont" value="<?php echo htmlspecialchars($inmueble['NumCont']); ?>" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Precio del Inmueble</label>
                    <div class="control">
                        <input class="input" type="text" name="precio" value="<?php echo htmlspecialchars($inmueble['precio']); ?>" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Fecha de Publicación</label>
                    <div class="control">
                        <input class="input" type="date" name="fechaPubli" value="<?php echo htmlspecialchars($inmueble['FechaPubli']); ?>" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Estado</label>
                    <div class="control">
                        <div class="select">
                            <select name="estado_id_estado" required>
                                <?php
                                $sql_estados = "SELECT * FROM estado";
                                $stmt_estados = $pdo->query($sql_estados);
                                $estados = $stmt_estados->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($estados as $estado):
                                    $selected = ($estado['id_estado'] == $inmueble['estado_id_estado']) ? 'selected' : '';
                                ?>
                                    <option value="<?php echo htmlspecialchars($estado['id_estado']); ?>" <?php echo $selected; ?>>
                                        <?php echo htmlspecialchars($estado['Descripcion']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Tipo</label>
                    <div class="control">
                        <div class="select">
                            <select name="tipo_idtipo" required>
                                <?php
                                $sql_tipos = "SELECT * FROM tipo";
                                $stmt_tipos = $pdo->query($sql_tipos);
                                $tipos = $stmt_tipos->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($tipos as $tipo):
                                    $selected = ($tipo['idtipo'] == $inmueble['tipo_idtipo']) ? 'selected' : '';
                                ?>
                                    <option value="<?php echo htmlspecialchars($tipo['idtipo']); ?>" <?php echo $selected; ?>>
                                        <?php echo htmlspecialchars($tipo['Descripcion']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Transacción</label>
                    <div class="control">
                        <div class="select">
                            <select name="transaccion_idtransaccion" required>
                                <?php
                                $sql_transacciones = "SELECT * FROM transaccion";
                                $stmt_transacciones = $pdo->query($sql_transacciones);
                                $transacciones = $stmt_transacciones->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($transacciones as $transaccion):
                                    $selected = ($transaccion['idtransaccion'] == $inmueble['transaccion_idtransaccion']) ? 'selected' : '';
                                ?>
                                    <option value="<?php echo htmlspecialchars($transaccion['idtransaccion']); ?>" <?php echo $selected; ?>>
                                        <?php echo htmlspecialchars($transaccion['Descripcion']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Imagen</label>
                    <div class="control">
                        <input class="input" type="file" name="imagen">
                        <?php if (!empty($inmueble['imagen'])): ?>
                            <img src="<?php echo htmlspecialchars($inmueble['imagen']); ?>" alt="Imagen actual" style="max-width: 200px; margin-top: 10px;">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <button class="button is-primary" type="submit">Guardar Cambios</button>
                        <a class="button is-light" href="mostrar_inmuebles.php">Volver</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/js/bulma.min.js"></script>
</body>
</html>
