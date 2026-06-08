<?php
// public/logout.php
session_start();

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/controladores/AuthControlador.php';

$authControlador = new AuthControlador();
$authControlador->salir(); // Este método destruye la sesión y redirige
?>