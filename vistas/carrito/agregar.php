<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: /Blog/publico/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['publicacion_id'])) {
    require_once __DIR__ . '/../../controladores/CarritoControlador.php';

    $usuario_id = $_SESSION['usuario']['id'];
    $publicacion_id = (int) $_POST['publicacion_id'];

    $exito = CarritoControlador::agregar($usuario_id, $publicacion_id);

    if ($exito) {
        header("Location: /Blog/vistas/publicaciones/inicio.php?mensaje=Cuenta añadida al carrito");
        exit;
    } else {
        header("Location: /Blog/vistas/publicaciones/inicio.php?error=No se pudo añadir la cuenta al carrito");
        exit;
    }
} else {
    header("Location: /Blog/vistas/publicaciones/inicio.php");
    exit;
}
?>
