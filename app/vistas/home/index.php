<?php ob_start(); ?>

<h1>Bienvenido al Blog</h1>
<p>Aquí puedes encontrar las últimas publicaciones:</p>

<?php
// Reutilizamos la vista de listado de artículos para la página de inicio
require_once __DIR__ . '/../articulos/index.php';
?>

<?php
// No es necesario llamar ob_get_clean() aquí, ya se hizo en articulos/index.php
// y se llamó a layout.php desde articulos/index.php.
?>