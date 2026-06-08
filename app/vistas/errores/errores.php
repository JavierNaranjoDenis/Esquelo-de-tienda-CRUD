<?php ob_start(); ?>

<div class="error-pagina">
    <h1>Error 404: Página No Encontrada</h1>
    <p>Lo sentimos, la página que buscas no existe.</p>
    <p><a href="/blog/" class="boton">Volver al Inicio</a></p>
</div>

<?php
$contenido = ob_get_clean();
require_once __DIR__ . '/../layout.php';
?>