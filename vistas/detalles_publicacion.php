<?php
session_start();

require_once __DIR__ . '/../controladores/publicacionesControlador.php';
require_once __DIR__ . '/../controladores/mensajesControlador.php';
require_once __DIR__ . '/../controladores/comentariosControlador.php';
require_once __DIR__ . '/../includes/cabecera.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: inicio.php");
    exit;
}

$id_publicacion = (int)$_GET['id'];

$publicacion = PublicacionesControlador::obtener($id_publicacion);

if (!$publicacion) {
    echo "Publicación no encontrada";
    require_once __DIR__ . '/../includes/pie.php';
    exit;
}

$imagenesData = PublicacionesControlador::obtenerImagenes($id_publicacion);

$imagenes = [];
foreach ($imagenesData as $img) {
    $imagenes[] = "../uploads/" . $img['imagen'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comentar'])) {

    $comentario = trim($_POST['comentario']);
    $usuario_id = $_SESSION['usuario']['id'];

    ComentariosControlador::crear($id_publicacion, $usuario_id, $comentario);

    header("Location: detalles_publicacion.php?id=$id_publicacion");
    exit;
}

$comentarios = ComentariosControlador::porPublicacion($id_publicacion);
?>

<div class="container">

    <h2><?php echo htmlspecialchars($publicacion['titulo']); ?></h2>

    <!-- IMÁGENES -->
    <?php if (!empty($imagenes)): ?>
        <img id="imgCarrusel"
             src="<?php echo $imagenes[0]; ?>"
             style="width:100%;max-width:500px;border-radius:8px;">

        <div style="display:flex;gap:10px;margin-top:10px;">
            <?php foreach ($imagenes as $img): ?>
                <img src="<?php echo $img; ?>"
                     style="width:70px;height:70px;cursor:pointer"
                     onclick="document.getElementById('imgCarrusel').src=this.src">
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <p><strong>Precio:</strong> $<?php echo $publicacion['precio']; ?></p>

    <p><strong>Categoría:</strong> <?php echo $publicacion['categoria']; ?></p>
    <p><strong>Estado:</strong> <?php echo $publicacion['estado']; ?></p>
    <p><strong>Condición:</strong> <?php echo $publicacion['condicion_producto']; ?></p>

    <hr>

    <!-- CONTACTO -->
    <h3>Contactar vendedor</h3>

    <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] != $publicacion['usuario_id']): ?>

        <?php
        $chat_id = MensajesControlador::abrir(
            $id_publicacion,
            $_SESSION['usuario']['id'],
            $publicacion['usuario_id']
        );
        ?>

        <a href="panel_usuario.php?chat=<?php echo $chat_id; ?>" class="btn">
            Contactar vendedor
        </a>

    <?php else: ?>
        <p>No disponible</p>
    <?php endif; ?>

    <hr>

    <!-- COMENTARIOS -->
    <h3>Comentarios</h3>

    <?php if (isset($_SESSION['usuario'])): ?>
        <form method="POST">
            <textarea name="comentario" required></textarea>
            <button name="comentar">Comentar</button>
        </form>
    <?php endif; ?>

    <?php foreach ($comentarios as $c): ?>
        <p>
            <b><?php echo htmlspecialchars($c['nombre_usuario']); ?></b>:
            <?php echo htmlspecialchars($c['comentario']); ?>
        </p>
    <?php endforeach; ?>

</div>

<?php require_once __DIR__ . '/../includes/pie.php'; ?>