<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/../controladores/publicacionesControlador.php";
require_once __DIR__ . "/../controladores/mensajesControlador.php";
require_once __DIR__ . "/../includes/cabecera.php";

$usuario_id = $_SESSION['usuario']['id'];

/* PUBLICACIONES */
$mis_publicaciones = PublicacionesControlador::porUsuario($usuario_id);

/* CHAT (TODAS LAS CONVERSACIONES) */
$conversaciones = MensajesControlador::conversaciones($usuario_id);

/* CHAT ACTIVO */
$chat = $_GET['chat'] ?? null;

/* NOTIFICACIONES */
$no_leidos = MensajesControlador::noLeidos($usuario_id);

/* MARCAR COMO LEÍDOS SI ENTRO AL CHAT */
if ($chat) {
    MensajesControlador::marcarLeidos($chat, $usuario_id);
}

/* ENVIAR MENSAJE */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mensaje'], $_POST['chat_id'])) {

    MensajesControlador::enviar(
        $_POST['chat_id'],
        $usuario_id,
        trim($_POST['mensaje'])
    );

    header("Location: panel_usuario.php?chat=" . $_POST['chat_id']);
    exit;
}

/* MENSAJES DEL CHAT ACTIVO */
$mensajes = [];
if ($chat) {
    $mensajes = MensajesControlador::mensajes($chat);
}
?>

<div class="container">

<h2>Mi Panel</h2>

<p><b>🔔 Mensajes nuevos:</b> <?php echo $no_leidos; ?></p>

<div style="display:flex; gap:20px;">

<!-- LISTA DE CHATS -->
<div style="width:35%; border-right:1px solid #ddd; padding-right:10px;">

<h3>💬 Conversaciones</h3>

<?php foreach ($conversaciones as $c): ?>
    <a href="panel_usuario.php?chat=<?php echo $c['id']; ?>"
       style="display:block; padding:8px; border-bottom:1px solid #eee;
       background:<?php echo ($chat == $c['id']) ? '#f0f0f0' : 'transparent'; ?>;">

        <b><?php echo htmlspecialchars($c['titulo']); ?></b><br>
        <small>Chat #<?php echo $c['id']; ?></small>

    </a>
<?php endforeach; ?>

</div>

<!-- CHAT -->
<div style="width:65%; padding-left:10px;">

<?php if ($chat): ?>

<h3>Chat activo</h3>

<div style="height:300px; overflow:auto; border:1px solid #ccc; padding:10px; background:#fafafa;">

<?php foreach ($mensajes as $m): ?>

    <div style="
        margin:5px;
        padding:8px;
        border-radius:8px;
        background:<?php echo ($m['emisor_id'] == $usuario_id) ? '#DCF8C6' : '#eee'; ?>;
        max-width:70%;
        <?php echo ($m['emisor_id'] == $usuario_id) ? 'margin-left:auto; text-align:right;' : ''; ?>
    ">

        <b><?php echo htmlspecialchars($m['nombre_usuario']); ?></b><br>
        <?php echo htmlspecialchars($m['mensaje']); ?>

    </div>

<?php endforeach; ?>

</div>

<form method="POST" style="margin-top:10px;">
    <input type="hidden" name="chat_id" value="<?php echo $chat; ?>">
    <textarea name="mensaje" required style="width:100%; height:60px;"></textarea>
    <button type="submit">Enviar</button>
</form>

<?php else: ?>
    <p>Selecciona un chat</p>
<?php endif; ?>

<hr>

<h3>📦 Mis publicaciones</h3>

<?php foreach ($mis_publicaciones as $p): ?>
    <p>
        <?php echo htmlspecialchars($p['titulo']); ?>
        |
        <a href="editar_publicacion.php?id=<?php echo $p['id']; ?>">Editar</a>
        |
        <a href="eliminar_publicacion.php?id=<?php echo $p['id']; ?>">Eliminar</a>
    </p>
<?php endforeach; ?>

</div>

</div>
</div>

<?php require_once __DIR__ . "/../includes/pie.php"; ?>