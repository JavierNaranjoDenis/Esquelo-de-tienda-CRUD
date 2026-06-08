<?php
session_start();

require_once __DIR__ . '/../controladores/mensajesControlador.php';

if (!isset($_SESSION['usuario'])) exit;

$chat_id = $_GET['chat_id'];

$mensajes = MensajesControlador::mensajes($chat_id);

foreach ($mensajes as $m):

    $clase = ($m['emisor_id'] == $_SESSION['usuario']['id'])
        ? "msg-derecha"
        : "msg-izquierda";
?>

    <div class="msg <?php echo $clase; ?>">
        <b><?php echo htmlspecialchars($m['nombre_usuario']); ?></b><br>
        <?php echo htmlspecialchars($m['mensaje']); ?>
    </div>

<?php endforeach; ?>