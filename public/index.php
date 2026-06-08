<?php
// public/index.php (Página de inicio)
session_start();

// Incluir archivos de configuración y modelos
require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/modelos/Database.php';
require_once __DIR__ . '/../app/modelos/Usuario.php';
require_once __DIR__ . '/../app/modelos/Publicaciones.php';
require_once __DIR__ . '/../app/modelos/Comentarios.php';

// Incluir el controlador de Home (se encargará de la lógica de la página de inicio)
require_once __DIR__ . '/../app/controladores/HomeControlador.php';

$homeControlador = new HomeControlador();
$homeControlador->index(); // Llama al método index del HomeControlador para mostrar la vista
?>