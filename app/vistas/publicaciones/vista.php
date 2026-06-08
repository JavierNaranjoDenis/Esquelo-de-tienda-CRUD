<?php ob_start(); ?>

<?php if (empty($articulo)): ?>
    <p>Artículo no encontrado.</p>
<?php else: ?>
    <div class="detalle-articulo">
        <h1><?php echo htmlspecialchars($articulo['Nombre']); ?></h1>
        <p class="meta">
            Publicado por <?php echo htmlspecialchars($articulo['nombre_autor'] . ' ' . $articulo['apellido_autor']); ?>
            el <?php echo htmlspecialchars($articulo['Fecha_de_edicion']); ?>
            (Estado: <?php echo htmlspecialchars($articulo['nombre_estado']); ?>)
        </p>
        <div class="contenido-articulo">
            <?php echo nl2br(htmlspecialchars($articulo['Articolocol'])); ?>
        </div>

        <div class="acciones">
            <?php if (isset($_SESSION['id_usuario']) && ($_SESSION['id_rol_usuario'] == 1 || $_SESSION['id_usuario'] == $articulo['Usuarios_Id_usuarios'])): // Administrador o propietario ?>
                <a href="/blog/articulos/editar?id=<?php echo htmlspecialchars($articulo['idArticulo']); ?>" class="boton boton-editar">Editar Artículo</a>
                <form action="/blog/articulos/eliminar" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este artículo?');">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($articulo['idArticulo']); ?>">
                    <button type="submit" class="boton boton-eliminar">Eliminar Artículo</button>
                </form>
            <?php endif; ?>
        </div>

        <hr>

        <h2>Comentarios</h2>
        <div class="seccion-comentarios">
            <?php if (empty($comentarios)): ?>
                <p>No hay comentarios aún.</p>
            <?php else: ?>
                <?php foreach ($comentarios as $comentario): ?>
                    <div class="item-comentario">
                        <p class="texto-comentario"><?php echo nl2br(htmlspecialchars($comentario['Texto'])); ?></p>
                        <p class="meta-comentario">
                            Por: <?php echo $comentario['nombre_autor'] ? htmlspecialchars($comentario['nombre_autor'] . ' ' . $comentario['apellido_autor']) : 'Anónimo'; ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['id_usuario'])): ?>
                <h3>Añadir un comentario</h3>
                <form action="/blog/articulos/comentar" method="POST" class="contenedor-formulario">
                    <input type="hidden" name="id_articulo" value="<?php echo htmlspecialchars($articulo['idArticulo']); ?>">
                    <div class="grupo-formulario">
                        <textarea name="texto_comentario" rows="4" placeholder="Escribe tu comentario..." required></textarea>
                    </div>
                    <button type="submit" name="agregar_comentario" class="boton boton-enviar">Publicar Comentario</button>
                </form>
            <?php else: ?>
                <p>Inicia sesión para dejar un comentario.</p>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<?php
$contenido = ob_get_clean();
require_once __DIR__ . '/../layout.php';
?>