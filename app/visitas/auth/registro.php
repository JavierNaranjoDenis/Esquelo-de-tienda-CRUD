<?php ob_start(); // ¡Importante! Inicia el búfer de salida aquí ?>

<h1>Registrarse</h1>

<form action="<?php echo BASE_URL; ?>registro.php" method="POST" class="contenedor-formulario">
    <div class="grupo-formulario">
        <label for="nombre_usuario">Nombre de Usuario:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" value="<?php echo htmlspecialchars($nombre_usuario ?? ''); ?>" required>
        <?php if (!empty($error_nombre_usuario)): ?>
            <span class="mensaje-error"><?php echo htmlspecialchars($error_nombre_usuario); ?></span>
        <?php endif; ?>
    </div>

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

    <div class="grupo-formulario">
        <label for="confirmar_contrasena">Confirmar Contraseña:</label>
        <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" required>
        <?php if (!empty($error_confirmar_contrasena)): ?>
            <span class="mensaje-error"><?php echo htmlspecialchars($error_confirmar_contrasena); ?></span>
        <?php endif; ?>
    </div>

    <button type="submit" class="boton">Registrarse</button>

    <p class="texto-enlace">¿Ya tienes cuenta? <a href="<?php echo BASE_URL; ?>login.php">Inicia sesión aquí</a></p>
</form>

<?php
// Captura el contenido de este script y lo guarda en $contenido
$contenido = ob_get_clean();

// Incluye el layout principal, que a su vez imprimirá $contenido
// La ruta a layout.php ahora es manejada por el controlador que carga la vista
require_once __DIR__ . '/../layout.php';
?>