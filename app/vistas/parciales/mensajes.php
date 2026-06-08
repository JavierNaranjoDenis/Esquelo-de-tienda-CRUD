<?php
// app/vistas/parciales/mensajes.php
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    $tipo = $mensaje['tipo']; // 'exito' o 'error'
    $texto = $mensaje['texto'];
    echo "<div class='mensaje {$tipo}'>{$texto}</div>";
    unset($_SESSION['mensaje']); // Eliminar el mensaje después de mostrarlo
}
?>