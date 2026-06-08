<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Blog CMS</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/estilos.css">
</head>
<body>
    <header>
        <div class="contenedor-cabecera">
            <a href="<?php echo BASE_URL; ?>index.php" class="logo">Mi Blog CMS</a>
            <nav>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>index.php">Inicio</a></li>
                    <li><a href="<?php echo BASE_URL; ?>publicaciones.php">Publicaciones</a></li>

                    <?php if (isset($_SESSION['id_usuario'])): ?>
                        <li><a href="<?php echo BASE_URL; ?>perfil.php">Hola, <?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?></a></li>
                        <?php if (isset($_SESSION['rol_id']) && $_SESSION['rol_id'] == 1): // Si es Administrador ?>
                            <li><a href="<?php echo BASE_URL; ?>usuarios.php">Gestión Usuarios</a></li>
                        <?php endif; ?>
                        <li><a href="<?php echo BASE_URL; ?>publication_crear.php">Crear Publicación</a></li>
                        <li><a href="<?php echo BASE_URL; ?>logout.php">Cerrar Sesión</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo BASE_URL; ?>login.php">Iniciar Sesión</a></li>
                        <li><a href="<?php echo BASE_URL; ?>registro.php">Registrarse</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main class="contenedor-principal">
        <?php
        // Mostrar mensajes de éxito o error de sesión
        if (isset($_SESSION['mensaje_exito'])):
            echo '<div class="mensaje exito">' . htmlspecialchars($_SESSION['mensaje_exito']) . '</div>';
            unset($_SESSION['mensaje_exito']);
        endif;
        if (isset($_SESSION['mensaje_error'])):
            echo '<div class="mensaje error">' . htmlspecialchars($_SESSION['mensaje_error']) . '</div>';
            unset($_SESSION['mensaje_error']);
        endif;
        ?>
        <?php echo $contenido; ?>
    </main>

    <footer>
        <div class="contenedor-pie">
            <p>&copy; <?php echo date('Y'); ?> Mi Blog CMS. Todos los derechos reservados.</p>
        </div>
    </footer>
    <script src="<?php echo BASE_URL; ?>js/main.js"></script>
</body>
</html>