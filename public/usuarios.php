<?php
// public/users.php
session_start();

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/modelos/Database.php';
require_once __DIR__ . '/../app/modelos/Usuario.php';
require_once __DIR__ . '/../app/controladores/UsuarioControlador.php';

$usuarioControlador = new UsuarioControlador();
$usuarioControlador->index(); // Llama al método index para listar usuarios (con chequeo de admin)
?>