<?php
session_start();
require_once __DIR__ . '/../controladores/carritoControlador.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['publicacion_id'])) {
    $usuario_id = $_SESSION['usuario']['id'];
    $publicacion_id = (int)$_POST['publicacion_id'];

    CarritoControlador::eliminar($usuario_id, $publicacion_id);
}

header('Location: carrito.php');
exit;
