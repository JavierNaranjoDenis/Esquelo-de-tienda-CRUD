<?php
session_start();
require_once "../controladores/publicacionesControlador.php";
require_once "../controladores/comentariosControlador.php";
require_once "../includes/cabecera.php";

$publicacion = null;
$comentarios = [];
$error = '';
$mensaje_comentario = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar_comentario'])) {

    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php?redirect=" . urlencode($_SERVER['REQUEST_URI']));
        exit();
    }

    $id_publicacion_comentario = (int)$_POST['id_publicacion'];
    $contenido_comentario = trim($_POST['comentario']);
    $id_usuario = $_SESSION['usuario']['id'];
    $nombre_usuario = $_SESSION['usuario']['nombre_usuario'];

    if (!empty($contenido_comentario)) {

        $resultado_comentario = ComentariosControlador::agregar(
            $id_publicacion_comentario,
            $id_usuario,
            $nombre_usuario,
            $contenido_comentario
        );

        if ($resultado_comentario) {

            header("Location: publicaciones.php?id=" . $id_publicacion_comentario . "&comentario=ok");
            exit();

        } else {
            $error = "Error al añadir el comentario.";
        }

    } else {
        $error = "El comentario no puede estar vacío.";
    }
}

if (isset($_GET['comentario']) && $_GET['comentario'] === 'ok') {
    $mensaje_comentario = "Comentario añadido correctamente.";
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $id_publicacion = (int)$_GET['id'];

    $publicacion = PublicacionesControlador::obtener($id_publicacion);

    if (!$publicacion) {

        $error = "Publicación no encontrada.";

    } else {

        $comentarios = ComentariosControlador::porPublicacion($id_publicacion);

    }

} else {

    $error = "ID de publicación no proporcionado o inválido.";

}
?>

<div class="container">

```
<?php if ($error): ?>

    <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <p><a href="inicio.php">Volver al Inicio</a></p>

<?php elseif ($publicacion): ?>

    <div class="publicacion-completa">

        <h2><?php echo htmlspecialchars($publicacion['titulo']); ?></h2>

        <p>
            <small>
                Publicado por:
                <?php echo htmlspecialchars($publicacion['nombre_usuario_autor']); ?>
                |
                Fecha:
                <?php echo htmlspecialchars($publicacion['fecha_publicacion'] ?? 'Fecha no disponible'); ?>
            </small>
        </p>

        <div class="contenido-publicacion">
            <p><?php echo nl2br(htmlspecialchars($publicacion['contenido'])); ?></p>
        </div>

        <div class="seccion-comentarios">

            <h3>Comentarios</h3>

            <?php if ($mensaje_comentario): ?>
                <p class="success">
                    <?php echo htmlspecialchars($mensaje_comentario); ?>
                </p>
            <?php endif; ?>

            <?php if (!empty($comentarios)): ?>

                <ul class="lista-comentarios">

                    <?php foreach ($comentarios as $comentario): ?>

                        <li>
                            <strong>
                                <?php echo htmlspecialchars($comentario['nombre_usuario']); ?>:
                            </strong>

                            <p>
                                <?php echo htmlspecialchars($comentario['comentario']); ?>
                            </p>

                            <small>
                                Publicado el:
                                <?php echo htmlspecialchars($comentario['fecha_comentario'] ?? 'Fecha desconocida'); ?>
                            </small>
                        </li>

                    <?php endforeach; ?>

                </ul>

            <?php else: ?>

                <p>No hay comentarios aún. ¡Sé el primero en comentar!</p>

            <?php endif; ?>

            <?php if (isset($_SESSION['usuario'])): ?>

                <div class="form-comentario">

                    <h4>Añadir un comentario</h4>

                    <form action="publicaciones.php?id=<?php echo htmlspecialchars($publicacion['id']); ?>" method="POST">

                        <input
                            type="hidden"
                            name="id_publicacion"
                            value="<?php echo htmlspecialchars($publicacion['id']); ?>"
                        >

                        <textarea
                            name="comentario"
                            rows="4"
                            placeholder="Escribe tu comentario aquí..."
                            required
                        ></textarea>

                        <button
                            type="submit"
                            name="enviar_comentario"
                            class="btn"
                        >
                            Enviar Comentario
                        </button>

                    </form>

                </div>

            <?php else: ?>

                <p>
                    Debes
                    <a href="login.php?redirect=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">
                        iniciar sesión
                    </a>
                    para comentar.
                </p>

            <?php endif; ?>

        </div>

    </div>

<?php endif; ?>
```

</div>

<?php require_once "../includes/pie.php"; ?>
