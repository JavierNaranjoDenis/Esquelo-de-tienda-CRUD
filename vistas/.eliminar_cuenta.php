<?php
session_start();
require_once "../controladores/cuentasControlador.php";
require_once "../includes/cabecera.php";

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$id_cuenta = null;
$error = '';
$mensaje_exito = '';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_cuenta = $_GET['id'];

    $cuenta = CuentasControlador::obtener($id_cuenta);

    if (!$cuenta) {
        $error = "Cuenta no encontrada.";
    } elseif ($cuenta['usuario_id'] !== $_SESSION['usuario']['id'] && $_SESSION['usuario']['rol'] !== 'admin') {
        $error = "No tienes permiso para eliminar esta cuenta.";
    } else {
        $resultado = CuentasControlador::eliminar($id_cuenta);

        if ($resultado) {
            $mensaje_exito = "Cuenta eliminada correctamente.";
            header("Location: inicio.php?mensaje=" . urlencode($mensaje_exito));
            exit();
        } else {
            $error = "Error al eliminar la cuenta. Inténtalo de nuevo.";
        }
    }
} else {
    $error = "ID de cuenta no proporcionado o inválido.";
}
?>

<div class="container">
    <h2>Eliminar Cuenta de Videojuego</h2>

    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
        <p><a href="inicio.php">Volver al Inicio</a></p>
    <?php endif; ?>

    <?php if ($mensaje_exito): ?>
        <p class="success"><?php echo $mensaje_exito; ?></p>
        <p><a href="inicio.php">Volver al Inicio</a></p>
    <?php endif; ?>
</div>

<?php require_once "../includes/pie.php"; ?>
