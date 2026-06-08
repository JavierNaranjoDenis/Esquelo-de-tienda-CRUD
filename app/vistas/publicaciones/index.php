<?php ob_start(); ?>

<h1>Publicaciones del Blog</h1>

<?php if (empty($articulos)): ?>
    <p>No hay artículos para mostrar.</p>
<?php else: ?>
    <div class="lista-articulos">
        <?php foreach ($articulos as $articulo): ?>
            <div class="item-articulo">
                <h2><a href="/blog/articulos/vista?id=<?php echo htmlspecialchars($articulo['idArticulo']); ?>">
                    <?php echo htmlspecialchars($articulo['Nombre']); ?>
                </a></h2>
                <p class="meta">Publicado por <?php echo htmlspecialchars($articulo['nombre_autor'] . ' ' . $articulo['apellido_autor']); ?> el <?php echo htmlspecialchars($articulo['Fecha_de_edicion']); ?> (Estado: <?php echo htmlspecialchars($articulo['nombre_estado']); ?>)</p>
                <p><?php echo nl2br(htmlspecialchars(substr($articulo['Articolocol'], 0, 200))); ?>...</p>
                <div class="acciones">
                    <a href="/blog/articulos/vista?id=<?php echo htmlspecialchars($articulo['idArticulo']); ?>" class="boton boton-ver">Ver Más</a>
                    <?php if (isset($_SESSION['id_usuario']) && ($_SESSION['id_rol_usuario'] == 1 || $_SESSION['id_usuario'] == $articulo['Usuarios_Id_usuarios'])): // Administrador o propietario ?>
                        <a href="/blog/articulos/editar?id=<?php echo htmlspecialchars($articulo['idArticulo']); ?>" class="boton boton-editar">Editar</a>
                        <form action="/blog/articulos/eliminar" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este artículo?');">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($articulo['idArticulo']); ?>">
                            <button type="submit" class="boton boton-eliminar">Eliminar</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php
$contenido = ob_get_clean();
require_once __DIR__ . '/../layout.php';
?>