<?php 
require_once(__DIR__ . "/conectar.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM clientes WHERE idCliente = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    header("Location: misdatos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        header {
            background-color: #1a237e; /* Color del encabezado */
            color: #fff;
            padding: 1.5em 0;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative; /* Añadido para el botón "Volver" */
        }
        header .volver-btn {
            position: absolute; /* Para posicionarlo a la derecha */
            right: 20px; /* Espacio desde el borde derecho */
            top: 50%;
            transform: translateY(-50%);
            background-color: #FFB300; /* Color del botón */
            color: #1a237e; /* Color del texto */
            padding: 0.5em 1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        header .volver-btn:hover {
            background-color: #e0a800; /* Color al pasar el cursor */
        }
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 100px);
        }
        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 600px;
        }
        .form-control {
            margin-bottom: 1.5rem;
        }
        .form-control label {
            font-weight: bold;
        }
        .btn-dark {
            background-color: #1a237e;
            color: #fff;
        }
        .btn-error {
            background-color: #ff4c4c;
            color: #fff;
        }
        .btn {
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn:hover {
            transform: scale(1.05);
        }
        .hero {
            padding: 2rem;
        }
        h1 {
            font-size: 2.5rem; /* Tamaño del título */
            margin: 0; /* Eliminar márgenes */
        }
    </style>
</head>

<body>
<header>
    <h1>Mis datos</h1>
    <a href="../perfilusuario.html" class="volver-btn">Volver</a>
</header>

<main>
    <div class="hero bg-base-200 min-h-screen">
        <div class="card shadow-2xl">
            <form class="card-body" method="post" action="./actualizar.php" enctype="multipart/form-data">
                <h1 class="text-4xl font-bold mb-4 text-center">Perfil de <?= $cliente_sesion['Nombre'] ?></h1>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Nombres:</span>
                    </label>
                    <input type="text" placeholder="Ingresa tu nombre" class="input input-bordered" name="Nombre" value="<?= $cliente_sesion['Nombre'] ?>" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Apellidos:</span>
                    </label>
                    <input type="text" placeholder="Ingresa tu apellido" class="input input-bordered" name="Apellido" value="<?= $cliente_sesion['Apellido'] ?>" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Edad:</span>
                    </label>
                    <input type="number" placeholder="Ingresa tu edad" class="input input-bordered" name="Edad" value="<?= $cliente_sesion['Edad'] ?>" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Correo:</span>
                    </label>
                    <input type="email" placeholder="ejemplo@gmail.com" class="input input-bordered" name="Email" value="<?= $cliente_sesion['Email'] ?>" required />
                </div>
                <div class="form-control">
                    <button class="btn btn-dark">Actualizar</button>
                </div>
                <div class="form-control">
                    <a href="./eliminar.php" onclick="return confirm('¿Seguro que quieres eliminar tu cuenta?')" class="btn btn-error">Eliminar</a>
                </div>
            </form>
        </div>
    </div>
</main>
</body>
</html>
