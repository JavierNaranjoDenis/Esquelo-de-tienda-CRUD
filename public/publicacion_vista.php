<?php
// public/publication_view.php
session_start();

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/modelos/Database.php';
require_once __DIR__ . '/../app/modelos/Publicacion.php';
require_once __DIR__ . '/../app/modelos/Comentario.php';
require_once __DIR__ . '/../app/modelos/Usuario.php';
require_once __DIR__ . '/../app/controladores/PublicacionControlador.php';

$publicacionControlador = new PublicacionControlador();

// Esperamos que el ID de la publicación venga en el parámetro 'id' de la URL
$id_publicacion = $_GET['id'] ?? null;

if ($id_publicacion) {
    $publicacionControlador->vista($id_publicacion);
} else {
    // Si no hay ID, redirigir o mostrar un error 404
    $_SESSION['mensaje_error'] = 'ID de publicación no especificado.';
    header('Location: ' . BASE_URL . 'publications.php');
    exit();
    // O cargar la vista de error 404
    // require_once __DIR__ . '/../app/vistas/errores/404.php';
}
?>