<?php ob_start(); ?>

<h1>Crear Nueva Publicación</h1>

<form action="/blog/articulos/guardar" method="POST" class="contenedor-formulario">
    <div class="grupo-formulario">
        <label for="nombre">Título:</label>
        <input type="text" id="nombre" name="nombre" required>
    </div>
    <div class="grupo-formulario">
        <label for="contenido">Contenido:</label>
        <textarea id="contenido" name="contenido" rows="10" required></textarea>
    </div>
    <div class="grupo-formulario">
        <label for="id_estado">Estado:</label>
        <select id="id_estado" name="id_estado" required>
            <?php foreach ($estados as $estado): ?>
                <option value="<?php echo htmlspecialchars($estado['idEstado']); ?>">
                    <?php echo htmlspecialchars($estado['Estado']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="boton boton-enviar">Crear Publicación</button>
</form>

<?php
$contenido = ob_get_clean();
require_once __DIR__ . '/../layout.php';
?>