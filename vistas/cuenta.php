<?php
session_start();

require_once __DIR__ . "/../controladores/cuentasControlador.php";
require_once __DIR__ . "/../controladores/comentariosControlador.php";
require_once __DIR__ . "/../includes/cabecera.php";

$cuenta = null;
$comentarios = [];
$error = '';
$mensaje_exito = '';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_cuenta = $_GET['id'];
    $cuenta = CuentasControlador::obtener($id_cuenta);

    if ($cuenta) {
        $comentarios = ComentariosControlador::porPublicacion($id_cuenta);
    } else {
        $error = "Cuenta no encontrada.";
    }
} else {
    $error = "ID de cuenta no proporcionado o inválido.";
}

// Procesar acciones de reservar o vender
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion_cuenta']) && isset($_SESSION['usuario']) && $cuenta) {
        $usuarioActual = $_SESSION['usuario'];
        if ($usuarioActual['id'] === $cuenta['usuario_id'] || $usuarioActual['rol'] === 'admin') {
            if ($_POST['accion_cuenta'] === 'reservar') {
                CuentasControlador::reservar($cuenta['id']);
                header("Location: cuenta.php?id=" . $cuenta['id']);
                exit;
            } elseif ($_POST['accion_cuenta'] === 'vender') {
                CuentasControlador::vender($cuenta['id']);
                header("Location: cuenta.php?id=" . $cuenta['id']);
                exit;
            }
        } else {
            $error = "No tienes permiso para modificar esta cuenta.";
        }
    }
}
?>

<div class="container">
    <?php if ($error): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <?php if ($mensaje_exito): ?>
        <p class="success"><?php echo htmlspecialchars($mensaje_exito); ?></p>
    <?php endif; ?>

    <?php if ($cuenta): ?>
        <div class="cuenta">
            <h3><?php echo htmlspecialchars($cuenta['juego']); ?> (<?php echo htmlspecialchars($cuenta['plataforma']); ?>)</h3>
            <?php if (!empty($cuenta['imagen'])): ?>
                <img src="../<?php echo htmlspecialchars($cuenta['imagen']); ?>" alt="Imagen de cuenta" style="max-width: 300px; margin-bottom: 10px;">
            <?php endif; ?>
            <p><?php echo nl2br(htmlspecialchars($cuenta['descripcion'])); ?></p>
            <small>Subida por: <?php echo htmlspecialchars($cuenta['nombre_usuario_autor']); ?> | Fecha: <?php echo htmlspecialchars($cuenta['fecha_creacion']); ?></small>
            <br><small>Estado: <strong><?php echo strtoupper($cuenta['estado']); ?></strong></small>

            <?php if (isset($_SESSION['usuario']) && ($_SESSION['usuario']['id'] === $cuenta['usuario_id'] || $_SESSION['usuario']['rol'] === 'admin')): ?>
                <div class="acciones-cuenta" style="margin-top: 20px;">
                    <a href="editar_cuenta.php?id=<?php echo htmlspecialchars($cuenta['id']); ?>" class="btn btn-editar">Editar</a>
                    <a href="eliminar_cuenta.php?id=<?php echo htmlspecialchars($cuenta['id']); ?>" class="btn btn-eliminar" onclick="return confirm('¿Seguro que deseas eliminar esta cuenta?');">Eliminar</a>

                    <!-- Botones Reservar y Vender -->
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="accion_cuenta" value="reservar">
                        <button type="submit" class="btn btn-warning" onclick="return confirm('¿Seguro que deseas reservar esta cuenta?');">Reservar</button>
                    </form>

                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="accion_cuenta" value="vender">
                        <button type="submit" class="btn btn-success" onclick="return confirm('¿Seguro que deseas marcar esta cuenta como vendida?');">Vender</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>

        <div class="comentarios-seccion">
            <h3>Comentarios</h3>
            <?php if (!empty($comentarios)): ?>
                <?php foreach ($comentarios as $comentario): ?>
                    <div class="comentario-item">
                        <strong><?php echo htmlspecialchars($comentario['nombre_usuario']); ?>:</strong>
                        <p><?php echo nl2br(htmlspecialchars($comentario['comentario'])); ?></p>
                        <small>Fecha: <?php echo htmlspecialchars($comentario['fecha_comentario']); ?></small> 
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay comentarios aún. ¡Sé el primero en comentar!</p>
            <?php endif; ?>

            <?php if (isset($_SESSION['usuario'])): ?>
                <h4>Deja tu comentario:</h4>
                <form action="cuenta.php?id=<?php echo htmlspecialchars($cuenta['id']); ?>" method="POST">
                    <input type="hidden" name="accion" value="comentar">
                    <input type="hidden" name="cuenta_id" value="<?php echo htmlspecialchars($cuenta['id']); ?>">
                    <div class="form-group">
                        <textarea name="comentario" rows="4" placeholder="Escribe tu comentario aquí..." required></textarea>
                    </div>
                    <button type="submit">Comentar</button>
                </form>
            <?php else: ?>
                <p class="link-alternativo">Para dejar un comentario, por favor <a href="login.php">inicia sesión</a>.</p>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <p style="text-align: center; color: #777;">La cuenta solicitada no se encontró o ha ocurrido un error.</p>
    <?php endif; ?>

    <div style="text-align: center; margin-top: 25px;">
        <a href="inicio.php" class="btn">Volver al listado</a>
    </div>
</div>

<?php require_once __DIR__ . "/../includes/pie.php"; ?>
