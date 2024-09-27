
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Documentos - Inmobiliaria</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('./img/diseno-de-casas-modernas-1_0.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #1a237e;
        }

        .header {
            background-color: #1a237e;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header img {
            height: 50px;
        }

        .menu {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .menu li {
            margin-left: 20px;
        }

        .menu a {
            color: white;
            text-decoration: none;
            font-size: 1.2em;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .menu a:hover {
            background-color: #4850a8;
        }

        .form-container {
            display: flex;
            justify-content: center;
            padding: 50px;
            color: #333;
        }

        .form-wrapper {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(101, 110, 101, 0.856);
            max-width: 600px;
            width: 100%;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 1.1em;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 1em;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group select:focus {
            border-color: #FFB300;
            box-shadow: 0 0 5px rgba(255, 179, 0, 0.5);
            outline: none;
        }

        button {
            background-color: #FFB300;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 1.2em;
        }

        button:hover {
            background-color: #e67e22;
        }
    </style>
</head>

<body>
    <header class="header">
        <img src="../img/sh_blanco-removebg-preview.png" alt="Logo Inmobiliaria">
        <ul class="menu">
            <li><a href="./inmuebles_de_usuarios.html">Volver</a></li>
        </ul>
    </header>

    <div class="form-container">
        <div class="form-wrapper">
            <h2>Te llamamos</h2>

            <form action="./guardar.php" method="post">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="Nombre_compl" name="Nombre_compl" placeholder="Ingrese su Nombre" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="text" id="Email" name="Email" placeholder="Ingrese su Correo" required>
                </div>
                <div class="form-group">
                    <label for="email">telefono o numero de contacto:</label>
                    <input type="text" id="Telefono" name="Telefono" placeholder="Ingrese su Telefono" required>
                </div>

                <button type=" submit">Enviar Información</button>

            </form>



            
        </div>
    </div>
</body>

</html>