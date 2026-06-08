<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Blog CMS</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/style.css">
    </head>
<body>
    <header>
        <div class="contenedor-cabecera">
            <a href="<?php echo BASE_URL; ?>" class="logo">Mi Blog CMS</a>
            <nav>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>inicio">Inicio</a></li>
                    <li><a href="<?php echo BASE_URL; ?>articulos">Artículos</a></li>
                    
                    <?php if (isset($_SESSION['id_usuario'])): // Si hay un usuario logueado ?>
                        <li><a href="<?php echo BASE_URL; ?>perfil">Hola, <?php echo $_SESSION['nombre_usuario']; ?></a></li>
                        <?php if (isset($_SESSION['rol_id']) && $_SESSION['rol_id'] == 1): // Si es Administrador ?>
                            <li><a href="<?php echo BASE_URL; ?>usuarios">Gestión Usuarios</a></li>
                            <li><a href="<?php echo BASE_URL; ?>articulos/crear">Crear Artículo</a></li>
                        <?php endif; ?>
                        <li><a href="<?php echo BASE_URL; ?>salir">Cerrar Sesión</a></li>
                    <?php else: // Si no hay usuario logueado ?>
                        <li><a href="<?php echo BASE_URL; ?>ingresar">Iniciar Sesión</a></li>
                        <li><a href="<?php echo BASE_URL; ?>registrar">Registrarse</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main class="contenedor-principal">
        <?php echo $contenido; // Aquí se inyecta el contenido de cada vista ?>
    </main>

    <footer>
        <div class="contenedor-pie">
            <p>&copy; <?php echo date('Y'); ?> Mi Blog CMS. Todos los derechos reservados.</p>
        </div>
    </footer>
    <script src="<?php echo BASE_URL; ?>public/js/main.js"></script>
    </body>
</html>