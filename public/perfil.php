<?php
// public/profile.php
session_start();

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/modelos/Database.php';
require_once __DIR__ . '/../app/modelos/Usuario.php';
require_once __DIR__ . '/../app/modelos/Publicacion.php'; // Para las publicaciones del usuario
require_once __DIR__ . '/../app/controladores/UsuarioControlador.php';

$usuarioControlador = new UsuarioControlador();
$usuarioControlador->perfil();
?>