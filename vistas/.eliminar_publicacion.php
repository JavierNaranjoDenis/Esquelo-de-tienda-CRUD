<?php
session_start();
require_once "../controladores/publicacionesControlador.php";
require_once "../includes/cabecera.php";

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$id_publicacion = null;
$error = '';
$mensaje_exito = '';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_publicacion = $_GET['id'];

    $publicacion = PublicacionesControlador::obtener($id_publicacion);

    if (!$publicacion) {
        $error = "Publicación no encontrada.";
    } elseif ($publicacion['usuario_id'] !== $_SESSION['usuario']['id'] && $_SESSION['usuario']['rol'] !== 'admin') {
        $error = "No tienes permiso para eliminar esta publicación.";
    } else {
        $resultado = PublicacionesControlador::eliminar($id_publicacion);

        if ($resultado) {
            $mensaje_exito = "Publicación eliminada correctamente.";
        
            header("Location: inicio.php?mensaje=" . urlencode($mensaje_exito));
            exit();
        } else {
            $error = "Error al eliminar la publicación. Inténtalo de nuevo.";
        }
    }
} else {
    $error = "ID de publicación no proporcionado o inválido.";
}
?>

<div class="container">
    <h2>Eliminar Publicación</h2>

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