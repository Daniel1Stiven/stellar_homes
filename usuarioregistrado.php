<?php
require './php/db.php';

$sql = "
    SELECT 
        i.Nombre, 
        i.localidad, 
        i.Direccion, 
        i.precio, 
        i.imagen 
    FROM 
        inmueble i
";

$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inmobiliaria</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <img src="./img/sh_blanco-removebg-preview.png" alt="Logo" class="logo">
    </header>
    <div class="menu-bar">

        <a href="./PHP/inmuebleUS.php">
            <button class="dropbtn">Inmuebles</button>
        </a>

        <a href="PHP/index.php">
            <button class="dropbtn">Cerrar Sesión</button>
        </a>
        <a href="./perfilusuario.html">
            <button class="dropbtn">Mi Perfil De Usario</button>
        </a>

    </div>
    <section class="carousel">
        <div class="carousel-container">
            <div class="carousel-slide">
                <img src="./img/diseno-de-casas-modernas-1_0.jpg" alt="Imagen 1">
                <div class="caption">Encuentra el lugar de tus sueños</div>
            </div>
            <div class="carousel-slide">
                <img src="./img/13232908_1604013343248088_6302168264450648482_n.jpg" alt="Imagen 2">
                <div class="caption">Encuentra el lugar de tus sueños</div>
            </div>
            <div class="carousel-slide">
                <img src="./img/luxury-beach-house-sea-view-600nw-2313357873.webp" alt="Imagen 3">
                <div class="caption">Encuentra el lugar de tus sueños</div>
            </div>
        </div>
        <button class="prev">&#10094;</button>
        <button class="next">&#10095;</button>
        <div class="carousel-indicators">
            <span class="indicator active"></span>
            <span class="indicator"></span>
            <span class="indicator"></span>
        </div>
    </section>

    <section class="search">
        <h2>Buscar Inmueble</h2>
        <form>
            <div class="form-group">
                <label for="tipo">Tipo de Inmueble:</label>
                <select id="tipo" name="tipo">
                    <option value="casa">Casa</option>
                    <option value="apartamento">Apartamento</option>
                    <option value="oficina">Oficina</option>
                </select>
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <select id="estado" name="estado">
                    <option value="venta">Venta</option>
                    <option value="arriendo">Arriendo</option>
                </select>
            </div>
            <div class="form-group">
                <label for="zona">Zona:</label>
                <input type="text" id="zona" name="zona" placeholder="Ingrese la zona">
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Ingrese el precio">
            </div>
            <button type="submit"><a href="./Página de Inmuebles.html">Buscar</a></button>
        </form>
    </section>

    <section class="highlighted-properties">
    <h2>Propiedades</h2>
    <div class="properties-grid">
        <?php foreach ($rows as $row): ?>
            <div class="property">
                <div class="property-image">
                    <?php
                    $imageFileName = htmlspecialchars($row['imagen']);
                    $imagePath = './PHP/uploads/' . basename($imageFileName);
                    ?>
                    <?php if (!empty($imageFileName) && file_exists($imagePath)): ?>
                        <img src="<?php echo $imagePath; ?>" alt="Imagen del inmueble">
                    <?php else: ?>
                        <img src="../img/diseno-de-casas-modernas-1_0.jpg" alt="Imagen no disponible">
                    <?php endif; ?>
                </div>
                <div class="property-info">
                    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($row['Nombre']); ?></p>
                    <p><strong>Localidad:</strong> <?php echo htmlspecialchars($row['localidad']); ?></p>
                    <p><strong>Dirección:</strong> <?php echo htmlspecialchars($row['Direccion']); ?></p>
                    <p><strong>Precio:</strong> <?php echo htmlspecialchars($row['precio']); ?></p>
                    <a href="./php/inmuebleUS.php"><button>Ver más</button></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="./php/inmuebleUS.php" class="view-more">Ver más propiedades</a>
</section>
    <section class="clients">
        <h2>Clientes</h2>
        <div class="comment">
            <p>"Excelente servicio, muy profesionales."</p>
            <span>⭐⭐⭐⭐⭐</span>
        </div>
        <div class="comment">
            <p>"Muy satisfecho con la compra de mi nueva casa."</p>
            <span>⭐⭐⭐⭐⭐</span>
        </div>
    </section>
    <footer>
        <nav>
            <a href="./PHP/inmuebleUS.php">
                <button class="dropbtn">Inmuebles</button>
            </a>
            <a href="./Nosotros.html">
                <button class="dropbtn">Nosotros</button>
            </a>
            <a href="./Iniciar Sesión.html">
                <button class="dropbtn">Iniciar Sesión</button>
            </a>
        </nav>
        <img src="./img/sh_blanco-removebg-preview.png" alt="Logo2" class="logo2">
        <p>&copy; 2024 Inmobiliaria. Todos los derechos reservados.</p>
    </footer>
    <script>
        let index = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const totalSlides = slides.length;
        const indicators = document.querySelectorAll('.indicator');
        const intervalTime = 3000; // Tiempo en milisegundos para el cambio automático (3 segundos)

        function updateCarousel() {
            const offset = -index * 100;
            document.querySelector('.carousel-container').style.transform = `translateX(${offset}%)`;
            updateIndicators();
        }

        function updateIndicators() {
            indicators.forEach((indicator, i) => {
                indicator.classList.toggle('active', i === index);
            });
        }

        function nextSlide() {
            index = (index + 1) % totalSlides;
            updateCarousel();
        }

        function prevSlide() {
            index = (index - 1 + totalSlides) % totalSlides;
            updateCarousel();
        }

        document.querySelector('.next').addEventListener('click', nextSlide);
        document.querySelector('.prev').addEventListener('click', prevSlide);

        document.querySelectorAll('.indicator').forEach((indicator, i) => {
            indicator.addEventListener('click', () => {
                index = i;
                updateCarousel();
            });
        });

        // Cambiar diapositiva automáticamente cada `intervalTime` milisegundos
        setInterval(nextSlide, intervalTime);

    </script>
</body>

</html>