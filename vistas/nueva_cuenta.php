<?php
session_start();
require_once __DIR__ . '/../controladores/cuentasControlador.php';
require_once __DIR__ . '/../includes/cabecera.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    $juego = trim($_POST['juego']);
    $plataforma = trim($_POST['plataforma']);
    $descripcion = trim($_POST['descripcion']);
    $usuario_id = $_SESSION['usuario']['id'];
    $imagen = null;

    // Procesar la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreTemporal = $_FILES['imagen']['tmp_name'];
        $nombreArchivo = basename($_FILES['imagen']['name']);
        $rutaDestino = "../recursos/imagenes_cuentas/" . $nombreArchivo;

        if (move_uploaded_file($nombreTemporal, $rutaDestino)) {
            $imagen = "imagenes_cuentas/" . $nombreArchivo; // Ruta relativa para la BD
        }
    }

    if (!empty($juego) && !empty($plataforma) && !empty($descripcion)) {
        $ok = CuentasControlador::crear($juego, $plataforma, $descripcion, $imagen, $usuario_id);

        if ($ok) {
            header("Location: inicio.php");
            exit;
        } else {
            echo "<p class='error'>Error al guardar la cuenta.</p>";
        }
    } else {
        echo "<p class='error'>Todos los campos son obligatorios.</p>";
    }
}
?>

<div class="container">
    <h2>Nueva Cuenta de Videojuego</h2>

    <form action="nueva_cuenta.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="juego">Juego:</label>
            <input type="text" id="juego" name="juego" required>
        </div>

        <div class="form-group">
            <label for="plataforma">Plataforma:</label>
            <input type="text" id="plataforma" name="plataforma" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="8" required></textarea>
        </div>

        <div class="form-group">
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*">
        </div>

        <button type="submit" name="crear">Guardar Cuenta</button>
    </form>
</div>

<?php require_once __DIR__ . '/../includes/pie.php'; ?>
