<?php ob_start(); // Inicia el búfer de salida aquí ?>

<h1>Iniciar Sesión</h1>

<form action="<?php echo BASE_URL; ?>login.php" method="POST" class="contenedor-formulario">
    <div class="grupo-formulario">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
        <?php if (!empty($error_email)): ?>
            <span class="mensaje-error"><?php echo htmlspecialchars($error_email); ?></span>
        <?php endif; ?>
    </div>

    <div class="grupo-formulario">
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <?php if (!empty($error_contrasena)): ?>
            <span class="mensaje-error"><?php echo htmlspecialchars($error_contrasena); ?></span>
        <?php endif; ?>
    </div>

    <button type="submit" class="boton">Iniciar Sesión</button>

    <p class="texto-enlace">¿No tienes cuenta? <a href="<?php echo BASE_URL; ?>registro.php">Regístrate aquí</a></p>
</form>

<?php
$contenido = ob_get_clean();
// La ruta a layout.php ahora es manejada por el controlador que carga la vista
require_once __DIR__ . '/../layout.php';
?>