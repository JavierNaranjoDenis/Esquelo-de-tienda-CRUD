<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}


require_once __DIR__ . "/../includes/cabecera.php";


$mensaje = '';
$tipo_mensaje = ''; 


if (isset($_GET['mensaje_exito'])) {
    $mensaje = "¡Registro exitoso! Ahora puedes iniciar sesión.";
    $tipo_mensaje = 'success';
} elseif (isset($_GET['error'])) {
    $mensaje = htmlspecialchars($_GET['error']);
    $tipo_mensaje = 'error';
}
?>

<div class="container">
    <h2>Crear una Nueva Cuenta</h2> <p class="form-description">¡Únete a nuestra comunidad! Regístrate para publicar contenido o gestionar tu cuenta.</p>

    <?php if ($mensaje): ?>
        <p class="<?php echo $tipo_mensaje; ?>"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <form action="../publico/index.php?accion=registro" method="post">
        <div class="form-group">
            <label for="nombre_usuario">Nombre de Usuario:</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" required>
        </div>

        <div class="form-group">
            <label for="correo_registro">Correo Electrónico:</label>
            <input type="email" id="correo_registro" name="correo" required>
        </div>

        <div class="form-group">
            <label for="password_registro">Contraseña:</label>
            <input type="password" id="password_registro" name="contrasena" required>
        </div>

        <div class="form-group">
            <label for="confirmar_password">Confirmar Contraseña:</label>
            <input type="password" id="confirmar_password" name="confirmar_contrasena" required>
            </div>

        <button type="submit">Registrarme</button> </form>

    <p class="link-alternativo">¿Ya tienes una cuenta? <a href="login.php">Iniciar Sesión aquí</a></p>
</div> <?php require_once __DIR__ . "/../includes/pie.php"; ?>