<?php ob_start(); ?>

<h1>Editar Publicación</h1>

<?php if (empty($articulo)): ?>
    <p>Artículo no encontrado.</p>
<?php else: ?>
    <form action="/blog/articulos/actualizar" method="POST" class="contenedor-formulario">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($articulo['idArticulo']); ?>">
        <div class="grupo-formulario">
            <label for="nombre">Título:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($articulo['Nombre']); ?>" required>
        </div>
        <div class="grupo-formulario">
            <label for="contenido">Contenido:</label>
            <textarea id="contenido" name="contenido" rows="10" required><?php echo htmlspecialchars($articulo['Articolocol']); ?></textarea>
        </div>
        <div class="grupo-formulario">
            <label for="id_estado">Estado:</label>
            <select id="id_estado" name="id_estado" required>
                <?php foreach ($estados as $estado): ?>
                    <option value="<?php echo htmlspecialchars($estado['idEstado']); ?>"
                        <?php echo ($estado['idEstado'] == $articulo['Estado_idEstado']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($estado['Estado']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="boton boton-enviar">Actualizar Publicación</button>
    </form>
<?php endif; ?>

<?php
$contenido = ob_get_clean();
require_once __DIR__ . '/../layout.php';
?>