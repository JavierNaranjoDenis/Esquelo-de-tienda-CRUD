<?php
// public/publication_edit.php
session_start();

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/modelos/Database.php';
require_once __DIR__ . '/../app/modelos/Publicacion.php';
require_once __DIR__ . '/../app/modelos/Usuario.php';
require_once __DIR__ . '/../app/controladores/PublicacionControlador.php';

$publicacionControlador = new PublicacionControlador();

$id_publicacion = $_GET['id'] ?? null; // ID viene por GET para mostrar el formulario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si es POST, la lógica de actualización se llama desde el controlador
    // El ID se leerá de $_POST['id_publicacion'] dentro del controlador
    $publicacionControlador->actualizar();
} elseif ($id_publicacion) {
    // Si es GET y hay ID, mostrar el formulario de edición
    $publicacionControlador->editar($id_publicacion);
} else {
    $_SESSION['mensaje_error'] = 'ID de publicación no especificado para editar.';
    header('Location: ' . BASE_URL . 'publications.php');
    exit();
}
?>