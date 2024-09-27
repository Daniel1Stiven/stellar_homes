<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Inmobiliaria</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #1a237e;
            padding: 10px;
            text-align: center;
        }
        header .button {
            color: #ffffff;
            text-decoration: none;
            font-size: 1em;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #3949ab;
            transition: background-color 0.3s ease;
        }
        header .button:hover {
            background-color: #1a237e;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
            border: 1px solid #ddd;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }
        .login-container:hover {
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
            transform: translateY(-5px);
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2em;
            color: #1a237e;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #3949ab;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 1em;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-group input:focus {
            border-color: #FFB300;
            box-shadow: 0 0 8px rgba(255, 179, 0, 0.5);
            outline: none;
        }
        button {
            background-color: #FFB300;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 6px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            width: 100%;
        }
        button:hover {
            background-color: #e67e22;
            transform: scale(1.02);
        }
        .button {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #d6d7e4;
            font-size: 1em;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <a href="./index.html" class="button">Volver a la página principal</a>
    </header>
    <div class="login-container">
        <h2>Login Inmobiliaria</h2>
        <form method="POST" action="./PHP2/inmobiliaria.php">
            <div class="form-group">
                <label for="NombreInmobiliaria">Nombre de la Inmobiliaria:</label>
                <input type="text" id="NombreInmobiliaria" name="NombreInmobiliaria" required>
            </div>
            <div class="form-group">
                <label for="EmailInmobiliaria">Correo electrónico:</label>
                <input type="EmailInmobiliaria" id="EmailInmobiliaria" name="EmailInmobiliaria" required>
            </div>
            <div class="form-group">
                <label for="Telefono">Teléfono:</label>
                <input type="Telefono" id="Telefono" name="Telefono" required>
            </div>
            <div class="form-group">
                <label for="Direccion">Direccion:</label>
                <input type="Direccion" id="Direccion" name="Direccion" required>
            </div>
            <div class="form-group">
                <label for="ContrasenaInmobiliaria">Contraseña:</label>
                <input type="password" id="ContrasenaInmobiliaria" name="ContrasenaInmobiliaria" required>
            </div>

            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
