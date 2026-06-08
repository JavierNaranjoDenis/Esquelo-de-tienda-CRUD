<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/../controladores/ComprasControlador.php';

$vendedor_id = $_SESSION['usuario']['id'];
$mensaje_error = '';
$mensaje_exito = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'], $_POST['solicitud_id'])) {
    $solicitud_id = (int)$_POST['solicitud_id'];
    $accion = $_POST['accion'];

    if (in_array($accion, ['autorizado', 'rechazado'])) {
        $exito = ComprasControlador::responderSolicitud($solicitud_id, $accion);
        if ($exito) {
            $mensaje_exito = "Solicitud $accion con éxito.";
        } else {
            $mensaje_error = "Error al procesar la solicitud.";
        }
    }
}

$solicitudes = ComprasControlador::obtenerSolicitudesPendientes($vendedor_id);

require_once __DIR__ . '/../includes/cabecera.php';
?>

<div class="container">
    <h2>Solicitudes de Compra Pendientes</h2>

    <?php if ($mensaje_exito): ?>
        <p class="success"><?= htmlspecialchars($mensaje_exito); ?></p>
    <?php endif; ?>
    <?php if ($mensaje_error): ?>
        <p class="error"><?= htmlspecialchars($mensaje_error); ?></p>
    <?php endif; ?>

    <?php if (count($solicitudes) === 0): ?>
        <p>No tienes solicitudes pendientes.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Comprador</th>
                    <th>Cuenta</th>
                    <th>Fecha Solicitud</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($solicitudes as $sol): ?>
                    <tr>
                        <td><?= htmlspecialchars($sol['nombre_usuario']); ?></td>
                        <td><?= htmlspecialchars($sol['titulo']); ?></td>
                        <td><?= htmlspecialchars($sol['fecha_solicitud']); ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="solicitud_id" value="<?= $sol['id']; ?>">
                                <button type="submit" name="accion" value="autorizado" class="btn btn-autorizar">Autorizar</button>
                            </form>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="solicitud_id" value="<?= $sol['id']; ?>">
                                <button type="submit" name="accion" value="rechazado" class="btn btn-rechazar">Rechazar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../includes/pie.php'; ?>
