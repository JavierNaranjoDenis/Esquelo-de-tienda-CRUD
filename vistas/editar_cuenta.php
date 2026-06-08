<?php
session_start();
require_once __DIR__ . "/../controladores/cuentasControlador.php";
require_once __DIR__ . "/../includes/cabecera.php";

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$id_cuenta = null;
$cuenta = null;
$error = '';
$mensaje_exito = '';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_cuenta = $_GET['id'];
    $cuenta = CuentasControlador::obtener($id_cuenta);

    if (!$cuenta) {
        $error = "Cuenta no encontrada.";
    } elseif ($cuenta['usuario_id'] !== $_SESSION['usuario']['id'] && $_SESSION['usuario']['rol'] !== 'admin') {
        $error = "No tienes permiso para editar esta cuenta.";
        $cuenta = null; 
    }
} else {
    $error = "ID de cuenta no proporcionado o inválido.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $cuenta) {
    $juego = trim($_POST['juego'] ?? '');
    $plataforma = trim($_POST['plataforma'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $id = $_POST['id'] ?? null;
    $imagen = $cuenta['imagen']; // mantener imagen actual por defecto

    // Si se subió una nueva imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreTemporal = $_FILES['imagen']['tmp_name'];
        $nombreArchivo = basename($_FILES['imagen']['name']);
        $rutaDestino = "../recursos/imagenes_cuentas/" . $nombreArchivo;

        if (move_uploaded_file($nombreTemporal, $rutaDestino)) {
            $imagen = "imagenes_cuentas/" . $nombreArchivo;
        }
    }

    if (empty($juego) || empty($plataforma) || empty($descripcion)) {
        $error = "Todos los campos son obligatorios.";
    } elseif ($id != $id_cuenta) {
        $error = "Error de seguridad: ID no coincide.";
    } else {
        $resultado = CuentasControlador::actualizar($juego, $plataforma, $descripcion, $imagen, $id);
        if ($resultado) {
            $mensaje_exito = "Cuenta actualizada correctamente.";
            $cuenta = CuentasControlador::obtener($id_cuenta);
        } else {
            $error = "Error al actualizar la cuenta. Inténtalo de nuevo.";
        }
    }
}
?>

<div class="container">
    <h2>Editar Cuenta</h2>

    <?php if ($error): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <?php if ($mensaje_exito): ?>
        <p class="success"><?php echo htmlspecialchars($mensaje_exito); ?></p>
    <?php endif; ?>

    <?php if ($cuenta): ?>
        <form action="editar_cuenta.php?id=<?php echo htmlspecialchars($cuenta['id']); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($cuenta['id']); ?>">
            
            <div class="form-group">
                <label for="juego">Juego:</label>
                <input type="text" id="juego" name="juego" value="<?php echo htmlspecialchars($cuenta['juego']); ?>" required>
            </div>

            <div class="form-group">
                <label for="plataforma">Plataforma:</label>
                <input type="text" id="plataforma" name="plataforma" value="<?php echo htmlspecialchars($cuenta['plataforma']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="8" required><?php echo htmlspecialchars($cuenta['descripcion']); ?></textarea>
            </div>

            <?php if (!empty($cuenta['imagen'])): ?>
                <div class="form-group">
                    <label>Imagen actual:</label><br>
                    <img src="../<?php echo htmlspecialchars($cuenta['imagen']); ?>" alt="Imagen de cuenta" style="max-width: 200px; margin-bottom: 10px;">
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="imagen">Nueva Imagen (opcional):</label>
                <input type="file" id="imagen" name="imagen" accept="image/*">
            </div>

            <button type="submit">Actualizar Cuenta</button>
        </form>
    <?php else: ?>
        <?php if (!$error): ?>
            <p style="text-align: center; color: #777;">No se pudo cargar la cuenta para editar o no tienes permiso.</p>
        <?php endif; ?>
    <?php endif; ?>

    <div style="text-align: center; margin-top: 25px;">
        <a href="panel_usuario.php" class="btn">Volver a Mis Cuentas</a>
    </div>
</div>

<?php require_once __DIR__ . "/../includes/pie.php"; ?>
