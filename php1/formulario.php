<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Documentos</title>
    <!-- Enlace a Bulma CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f4f4f4;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #1a237e;
            color: #fff;
            padding: 1rem 2rem;
        }

        .logo img {
            height: 50px;
        }

        .menu-bar a {
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
            font-weight: bold;
            transition: color 0.3s;
        }

        .menu-bar a:hover {
            color: #FFB300;
        }

        .publish-section {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .publish-section h1 {
            margin-bottom: 1.5rem;
            color: #1a237e;
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
        }

        .field label {
            color: #333;
        }

        .button {
            background-color: #1a237e;
            color: #fff;
            border-radius: 4px;
            padding: 0.75rem 1.25rem;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #3949ab;
        }

        .field .control input,
        .field .control select {
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../img/sh_blanco-removebg-preview.png" alt="Logo">
        </div>
        <nav class="menu-bar">   
            <a href="mostrar_documentos.php">Ver Solicitudes</a>
        </nav>
    </header>

    <section class="publish-section">
        <h1>Formulario de Solicitud de Documentos</h1>
        <form class="form" action="guardar.php" method="post">
            <div class="field">
                <label class="label" for="nombre_solicitante">Nombre del Solicitante:</label>
                <div class="control">
                    <input type="text" id="nombre_solicitante" name="nombre_solicitante" class="input" placeholder="Ingrese su nombre" required>
                </div>
            </div>
            <div class="field">
                <label class="label" for="correo_solicitante">Correo del Solicitante:</label>
                <div class="control">
                    <input type="email" id="correo_solicitante" name="correo_solicitante" class="input" placeholder="Ingrese su correo electrónico" required>
                </div>
            </div>
            <div class="field">
                <label class="label" for="tipo_documento">Tipo de Documento:</label>
                <div class="control">
                    <div class="select">
                        <select id="tipo_documento" name="tipo_documento" required>
                            <option value="">-- Seleccione --</option>
                            <option value="C.C">C.C</option>
                            <option value="C.E">C.E</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="field">
                <label class="label" for="solicitud_adicional">Solicitud Adicional:</label>
                <div class="control">
                    <input type="text" id="solicitud_adicional" name="solicitud_adicional" class="input" placeholder="Detalles adicionales de la solicitud" required>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-primary">Enviar Solicitud</button>
                </div>
            </div>
        </form>
    </section>
</body>
</html>
