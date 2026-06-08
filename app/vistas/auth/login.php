<?php ob_start(); ?>

<h1>Iniciar Sesión</h1>

<form action="<?php echo BASE_URL; ?>ingresar" method="POST" class="contenedor-formulario">
    <div class="grupo-formulario">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $datos['email'] ?? ''; ?>" required>
        <?php if (isset($errores['email'])): ?>
            <p class="error-texto"><?php echo $errores['email']; ?></p>
        <?php endif; ?>
    </div>
    <div class="grupo-formulario">
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <?php if (isset($errores['contrasena'])): ?>
            <p class="error-texto"><?php echo $errores['contrasena']; ?></p>
        <?php endif; ?>
    </div>
    <button type="submit" class="boton boton-enviar">Iniciar Sesión</button>
    <p class="texto-enlace">¿No tienes cuenta? <a href="<?php echo BASE_URL; ?>registrar">Regístrate aquí</a></p>
</form>

<?php
// Mostrar mensajes de éxito o error global
if (isset($mensaje_exito)): // Para mensajes que vienen de registro exitoso
    echo '<div class="mensaje exito">' . $mensaje_exito . '</div>';
endif;
if (isset($errores['general'])): // Para errores de login
    echo '<div class="mensaje error">' . $errores['general'] . '</div>';
endif;
// También puedes verificar mensajes de sesión aquí si tu lógica de redirección los usa
if (isset($_SESSION['mensaje_exito'])):
    echo '<div class="mensaje exito">' . $_SESSION['mensaje_exito'] . '</div>';
    unset($_SESSION['mensaje_exito']);
endif;
if (isset($_SESSION['mensaje_error'])):
    echo '<div class="mensaje error">' . $_SESSION['mensaje_error'] . '</div>';
    unset($_SESSION['mensaje_error']);
endif;
?>

<?php
$contenido = ob_get_clean();
require_once __DIR__ . '/../layout.php';
?>