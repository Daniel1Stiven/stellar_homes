<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Documentos</title>
    <link rel="stylesheet" href="../style.css">
</head>
<style>

</style>
<body>
    <header>
        <div class="logo">

            <img src="../img/sh_blanco-removebg-preview.png" alt="Logo Inmobiliaria">

        </div>
        <div class="menu-bar">
            <nav>
                <a href="./perfilusuario.html">Volver</a>

            </nav>
        </div>
    </header>

    <section class="publish-section">
        <h1>Cargar Documentos</h1>
        <form id="subir-form" class="publish-form" action="./guardar.php" method="post">
            <div class="form-group">
                <label for="Nombre_Usuario">Nombre Completo del Solicitante</label>
                <input type="text" id="Nombre_Usuario" name="Nombre_Usuario" placeholder="Ingrese su Nombre" required>
            </div>

            <div class="form-group">
                <label for="Correo_Usuario">Correo Electrónico</label>
                <input type="email" id="Correo_Usuario" name="Correo_Usuario" placeholder="Ingrese el Correo Electrónico" required>
            </div>

            <div class="form-group">
                <label for="document-type">Seleccion el tipo de documento</label>
                <select id="Tipo_documento" name="Tipo_documento" onchange="toggleForms()" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="CE">CE: Cedula de Extranjeria</option>
                    <option value="CC">CC: Cedula de Ciudadania</option>
                </select>
            </div>

            <div class="form-group">
                <label for="Numero_Documento">Numero de Documento</label>
                <input type="text" id="Numero_Documento" name="Numero_Documento" placeholder="Ingrese el numero de los documentos" required>
            </div>

            <div class="form-group">
                <label for="Cargar_Documento">Cargar Documento</label>
                <input type="file" id="Cargar_Documento" name="Cargar_Documento" required>
            </div>

            <div class="form-group">
                <label for="property-images">Certificacion Laboral</label>
                <input type="file" id="Certificado_Laboral" name="Certificado_Laboral" required>
            </div>

            <div class="form-group">
                <label for="Ultimos_Extractos_Bancarios">Ultimos Extractos Bancarios</label>
                <input type="file" id="Ultimos_Extractos_Bancarios" name="Ultimos_Extractos_Bancarios" required>
            </div>

            <div class="form-group">
                <label for="Certificados_de_ingresos">Certificados de Ingresos</label>
                <input type="file" id="Certificados_de_ingresos" name="Certificados_de_ingresos" required>
            </div>


            
                    <button type="submit">Subir Documentos</button>

        </form>
    </section>
   
    <footer>
        <nav>

        </nav>
        <p>&copy; 2024 Inmobiliaria. Todos los derechos reservados.</p>
    </footer>

</body>

</html>