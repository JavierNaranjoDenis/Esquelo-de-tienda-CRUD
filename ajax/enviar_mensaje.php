<?php

session_start();

require_once __DIR__ . '/../controladores/mensajesControlador.php';

if (!isset($_SESSION['usuario'])) exit;

$chat_id = $_POST['chat_id'];
$mensaje = trim($_POST['mensaje']);
$usuario_id = $_SESSION['usuario']['id'];

if ($mensaje !== '') {
    MensajesControlador::enviar($chat_id, $usuario_id, $mensaje);
}