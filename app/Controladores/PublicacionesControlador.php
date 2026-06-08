<?php
// app/controladores/PublicacionControlador.php

class PublicacionControlador {
    // ... (resto del constructor y propiedades) ...

    // ... (métodos index, vista, crear, editar, actualizar, eliminar - se mantienen igual) ...

    // Agregar un comentario a una publicación
    public function comentar(){ // Este método seguirá siendo llamado si se hace un POST a publications_view.php
        if (!$this->usuarioModelo->estaLogueado()) {
            $_SESSION['mensaje_error'] = 'Debes iniciar sesión para comentar.';
            // En este modelo, redirigir a login.php
            header('Location: ' . BASE_URL . 'login.php');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'texto' => trim($_POST['comentario_texto'] ?? ''),
                'id_publicacion' => trim($_POST['id_publicacion'] ?? ''),
                'id_usuario' => $_SESSION['id_usuario']
            ];

            if (empty($datos['texto'])) {
                $_SESSION['mensaje_error'] = 'El comentario no puede estar vacío.';
                // Redirigir de vuelta a la vista de la publicación
                header('Location: ' . BASE_URL . 'publication_view.php?id=' . $datos['id_publicacion']);
                exit();
            }

            if ($this->comentarioModelo->agregarComentario($datos)) {
                $_SESSION['mensaje_exito'] = 'Comentario añadido con éxito.';
                header('Location: ' . BASE_URL . 'publication_view.php?id=' . $datos['id_publicacion']);
                exit();
            } else {
                $_SESSION['mensaje_error'] = 'Hubo un error al añadir el comentario.';
                header('Location: ' . BASE_URL . 'publication_view.php?id=' . $datos['id_publicacion']);
                exit();
            }
        } else {
            // Si alguien intenta acceder a comentar directamente con GET, redirigir
            header('Location: ' . BASE_URL . 'publications.php');
            exit();
        }
    }


    private function cargarVista($nombreVista, $datos = []){
        extract($datos);
        // Aquí es donde se "renderiza" la vista.
        // El contenido de la vista se almacena en $contenido y luego se incluye el layout.
        ob_start();
        require_once __DIR__ . '/../vistas/' . $nombreVista . '.php';
        $contenido = ob_get_clean();
        require_once __DIR__ . '/../vistas/layout.php';
    }
}