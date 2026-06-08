<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}


require_once __DIR__ . "/../includes/cabecera.php";


$error_message = '';
if (isset($_GET['error'])) {
    $error_message = "Credenciales incorrectas. Por favor, inténtalo de nuevo."; 
}
?>

<div class="container">
    <h2>Iniciar Sesión</h2>

    <?php if ($error_message): ?>
        <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>

    <form action="../publico/index.php?accion=login" method="post">
        <div class="form-group">
            <label for="correo_login">Correo Electrónico:</label>
            <input type="email" id="correo_login" name="correo" required>
        </div>

        <div class="form-group">
            <label for="password_login">Contraseña:</label>
            <input type="password" id="password_login" name="contrasena" required>
        </div>

        <button type="submit">Acceder</button> </form>

    <p class="link-alternativo">¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
</div> <?php require_once __DIR__ . "/../includes/pie.php"; ?>