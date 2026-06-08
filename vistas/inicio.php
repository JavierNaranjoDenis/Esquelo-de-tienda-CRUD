<?php
session_start();

require_once __DIR__ . "/../controladores/publicacionesControlador.php";
require_once __DIR__ . "/../controladores/comentariosControlador.php";
require_once __DIR__ . "/../includes/cabecera.php";

$publicaciones = PublicacionesControlador::todas();

$mensaje_exito = $_GET['mensaje'] ?? '';
$mensaje_error = $_GET['error'] ?? '';
?>

<div class="container">

    <?php if ($mensaje_exito): ?>
        <p class="success"><?php echo htmlspecialchars($mensaje_exito); ?></p>
    <?php endif; ?>

    <?php if ($mensaje_error): ?>
        <p class="error"><?php echo htmlspecialchars($mensaje_error); ?></p>
    <?php endif; ?>

    <h2>Productos Recientes</h2>

    <?php if (empty($publicaciones)): ?>

        <p style="text-align:center;">No hay productos publicados todavía.</p>

    <?php else: ?>

        <div class="publicaciones-grid">

            <?php foreach ($publicaciones as $publicacion): ?>

                <div class="publicacion-card">

                    <?php
                    $imagenes = PublicacionesControlador::obtenerImagenes($publicacion['id']);
                    ?>

                    <?php if (!empty($imagenes) && isset($imagenes[0]['imagen'])): ?>

                        <img
                            src="../uploads/<?php echo htmlspecialchars($imagenes[0]['imagen']); ?>"
                            alt="<?php echo htmlspecialchars($publicacion['titulo']); ?>"
                            style="width:100%; height:250px; object-fit:cover; border-radius:8px; margin-bottom:15px;"
                        >

                    <?php else: ?>

                        <img
                            src="../recursos/img/default.jpg"
                            alt="sin imagen"
                            style="width:100%; height:250px; object-fit:cover; border-radius:8px; margin-bottom:15px;"
                        >

                    <?php endif; ?>

                    <h4><?php echo htmlspecialchars($publicacion['titulo']); ?></h4>

                    <h3 style="color:green;">
                        $<?php echo number_format($publicacion['precio'], 2); ?>
                    </h3>

                    <p>
                        <?php echo nl2br(htmlspecialchars(substr($publicacion['contenido'], 0, 150))); ?>...
                    </p>

                    <p><strong>Categoría:</strong> <?php echo htmlspecialchars($publicacion['categoria'] ?? 'Sin categoría'); ?></p>
                    <p><strong>Condición:</strong> <?php echo htmlspecialchars($publicacion['condicion_producto'] ?? 'No especificada'); ?></p>
                    <p><strong>Estado:</strong> <?php echo htmlspecialchars($publicacion['estado'] ?? 'Disponible'); ?></p>

                    <small>
                        Publicado por:
                        <?php echo htmlspecialchars($publicacion['autor'] ?? 'Desconocido'); ?>
                        |
                        Fecha:
                        <?php echo htmlspecialchars($publicacion['fecha_publicacion']); ?>
                    </small>

                    <div style="margin-top:15px;">
                        <a href="detalles_publicacion.php?id=<?php echo $publicacion['id']; ?>" class="btn">
                            Ver Producto
                        </a>
                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</div>

<?php require_once __DIR__ . "/../includes/pie.php"; ?>