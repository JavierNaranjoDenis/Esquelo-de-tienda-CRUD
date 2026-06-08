<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/controladores/mensajesControlador.php";

$usuario_id = $_SESSION['usuario']['id'];
$error = '';
$mensaje_exito = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $receptor_id = $_POST['receptor_id'] ?? null;
    $publicacion_id = $_POST['publicacion_id'] ?? null;
    $mensaje = trim($_POST['mensaje'] ?? '');

    if (!$receptor_id || empty($mensaje)) {
        $error = "Datos incompletos para enviar el mensaje.";
    } else {
        $enviado = MensajesControlador::enviarMensaje($usuario_id, $receptor_id, $publicacion_id, $mensaje);
        if ($enviado) {
            $mensaje_exito = "Mensaje enviado correctamente.";
        } else {
            $error = "Error al enviar el mensaje.";
        }
    }
}

// Opcional: obtener conversaciones recientes para mostrar en un listado
$conversaciones = MensajesControlador::obtenerConversacionesUsuario($usuario_id);

require_once __DIR__ . "/includes/cabecera.php";
?>

<div class="container">
    <h2>Mensajes</h2>

    <?php if ($error): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <?php if ($mensaje_exito): ?>
        <p class="success"><?php echo htmlspecialchars($mensaje_exito); ?></p>
    <?php endif; ?>

    <h3>Conversaciones recientes</h3>
    <ul>
        <?php foreach ($conversaciones as $conv): ?>
            <li>
                <strong>De: <?php echo htmlspecialchars($conv['emisor']); ?></strong> 
                <strong>Para: <?php echo htmlspecialchars($conv['receptor']); ?></strong>
                <br>
                <small><?php echo htmlspecialchars($conv['mensaje']); ?></small>
                <br>
                <small><?php echo htmlspecialchars($conv['fecha_envio']); ?></small>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Aquí puedes agregar más funcionalidad para mostrar conversación específica y responder -->

</div>

<?php require_once __DIR__ . "/includes/pie.php"; ?>
