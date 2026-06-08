<?php
// public/publication_delete.php
session_start();

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/modelos/Database.php';
require_once __DIR__ . '/../app/modelos/Publicacion.php';
require_once __DIR__ . '/../app/modelos/Usuario.php';
require_once __DIR__ . '/../app/controladores/PublicacionControlador.php';

$publicacionControlador = new PublicacionControlador();

// Esperamos que el ID de la publicación venga por GET o POST
$id_publicacion = $_REQUEST['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id_publicacion) {
    // Llama al método eliminar solo si es POST y hay ID
    $publicacionControlador->eliminar($id_publicacion);
} else {
    $_SESSION['mensaje_error'] = 'Solicitud inválida para eliminar publicación.';
    header('Location: ' . BASE_URL . 'publications.php');
    exit();
}
?>