<!DOCTYPE html>
<html lang="es">
<?php 
require_once(__DIR__ . "../PHP2/conecta.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id_i'])) {
    $id = $_GET['id_i'];
    $sql = "DELETE FROM inmobiliaria WHERE idInmobiliaria = :id_i";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_i' => $id]);
    header("Location: Perfilinmobiliario.php");
    exit();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com">  </script>
    <title>Perfil Inmobiliario</title>
    
    <style>
        .card {
        background-color: #1a237e;
        color: #0F3133;

    }
    .card h1{
    color: white;
    }
        body {
            justify-content: space-between;
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
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header img {
            height: 110px;
            margin: 10px;
            padding: 0;
        }

        .menu {
            list-style: none;
            display: flex;
            margin: 20px 0;
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

        .content {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            color: #333;
        }

        .contenedores {
            display: grid;
            gap: 20px;
        }

        .contenedor {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(101, 110, 101, 0.856);
            text-align: center;
            font-size: 1.2em;
            cursor: pointer;
            color: #7a7777;
        }

        .contenedor a {
            text-decoration: none;
            color: rgb(33, 41, 255);
        }

        .contenedor:hover {
            background-color: rgba(255, 255, 255, 0.9);}

        .container{
            border-left: 20%;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(101, 110, 101, 0.856);
            text-align: center;
            font-size: 1.2em;
            cursor: pointer;
            color: #7a7777;
        }
        @media (max-width: 768px) {
            .header img {
                height: 40px;
            }

            .menu a {
                font-size: 0.9em;
                padding: 3px 8px;
            }

            .contenedores {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                width: 100%;
                margin-top: 20px;
            }
            .content {
                flex-wrap: wrap; 
            }
        }

        @media (max-width: 0px) {
            .header img {
                height: 30px;
            }

            .menu {
                flex-direction: column;
                align-items: flex-start;
            }

            .menu li {
                margin-left: 0;
                margin-bottom: 10px;
            }

            .menu a {
                padding: 5px;
                font-size: 0.8em;
            }
        }
    </style>
</head>

<body>
    <header class="header">
        <img src="./img/sh_blanco-removebg-preview.png" alt="Logo Inmobiliaria">
        <ul class="menu">
            <li><a href="./PHP/index.php">Cerrar Sesion</a></li>

        </ul>
    </header>

    <div class="content">
        <div class="contenedores">
            <div class="contenedor"><a href="./PHP/mostrar_inmuebles.php">Mis Publicaciones</a></div>
            
            <div class="contenedor"><a href="./php4/mostrar_carga_documentos.php">Verificar Documentos</a></div>
            
            <div class="contenedor"><a href="./PHP/formulario.php">Publicar</a></div>
        </div>
    <div class="container">
        <div class="row">
            <div class="card-content flex-col lg:flex-row-reverse lg:gap-32 d-flex: jutify-content-center ">
        <div class="card max-w-[600px] shrink-0 shadow-2xl">
          <form class="card-body"  method="POST" action= ./PHP2/editar.php enctype="multipart/form-data"> 
          <h1 class="text-5xl font-courier mb-4 text-light"> INMOBILIARIA <?= isset($sesionInmobiliaria['NombreInmobiliaria']) ? htmlspecialchars($sesionInmobiliaria['NombreInmobiliaria']) : ''; ?></h1> 
            <div class="form-control">
            <input type="hidden" name="idInmobiliaria" value="<?php echo htmlspecialchars($sesionInmobiliaria['idInmobiliaria'] ?? ''); ?>">
            <label class="label">
              <label class="label">
                <span class="label-text font-semibold text-red-500 align-center ">Nombre:
                </span>
              </label>
              <input type="text" placeholder="Ingresa el nombre del producto" class="input input-bordered" name="NombreInmobiliaria"  value="<?php echo isset($sesionInmobiliaria) ? htmlspecialchars($sesionInmobiliaria['NombreInmobiliaria']) : ''; ?>" required />
            </div>
            <div class="form-control">
              <label class="label">
                <span class="label-text font-semibold text-red-600">Email Inmobiliaria:
                </span>
              </label>
              <input type="text" placeholder="Ingresa la EmailInmobiliaria del producto" class="input input-bordered" name="EmailInmobiliaria" value="<?php echo isset($sesionInmobiliaria) ? htmlspecialchars($sesionInmobiliaria['EmailInmobiliaria']) : ''; ?>"
                required />
            </div>
            <div class="form-control">
                  <label class="label">
                    <span class="label-text font-semibold text-red-600"
                      >Telefono:
                    </span>
                  </label>
                  <input
                    type="number" name="Telefono" value="<?php echo isset($sesionInmobiliaria) ? htmlspecialchars($sesionInmobiliaria['Telefono']) : ''; ?>" required/>
                </div>
            <div class="form-control">
              <label class="label">
                <span class="label-text font-semibold text-red-600">Direccion:
                </span>
              </label>
              <input type="text" class="input input-bordered" name="Direccion" value="<?php echo isset($sesionInmobiliaria) ? htmlspecialchars($sesionInmobiliaria['Direccion']) : ''; ?>" required />
            </div>
              <button class="btn btn-dark" type="submit"> EDITAR </button>
                            <a href="./PHP2/elimina.php" onclick="return confirm('¿Seguro que quieres eliminar tu cuenta?')" class="btn btn-danger">Eliminar</a>
          </form>
        </div>
      </div>
            </div>
        </div>

        </div>
</body>

</html>