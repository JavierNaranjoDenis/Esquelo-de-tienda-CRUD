<?php
// public/publications.php
session_start();

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/modelos/Database.php';
require_once __DIR__ . '/../app/modelos/Publicacion.php';
require_once __DIR__ . '/../app/modelos/Usuario.php'; // Necesario para comprobar si está logueado
require_once __DIR__ . '/../app/controladores/PublicacionControlador.php';

$publicacionControlador = new PublicacionControlador();
$publicacionControlador->index(); // Llama al método index para listar publicaciones
?>