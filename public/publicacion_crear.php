<?php
// public/publication_create.php
session_start();

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/modelos/Database.php';
require_once __DIR__ . '/../app/modelos/Publicacion.php';
require_once __DIR__ . '/../app/modelos/Usuario.php';
require_once __DIR__ . '/../app/controladores/PublicacionControlador.php';

$publicacionControlador = new PublicacionControlador();
$publicacionControlador->crear(); // Este método ya maneja GET y POST
?>