<?php
require_once "../modelos/usuariosModelo.php";
require_once "../modelos/publicacionesModelo.php"; // Asegúrate de esta inclusión
require_once "../modelos/comentariosModelo.php"; // Asegúrate de esta inclusión

class AdminControlador {

    public function mostrarPanelAdmin() {
        // Lógica para cargar y mostrar la vista del panel de administración
        // Esto podría incluir obtener estadísticas, listas de usuarios, publicaciones, etc.
        // Por ahora, simplemente cargaremos la vista.
        require_once "../vistas/admin_panel.php"; // Asegúrate de que esta vista existe
    }

    public function gestionarUsuarios() {
        $usuarios = UsuariosModelo::obtenerTodos(); // Obtener todos los usuarios
        require_once "../vistas/admin/gestionar_usuarios.php"; // Asegúrate de que esta vista existe
    }

    public function eliminarUsuario($id_usuario) {
        if (UsuariosModelo::eliminar($id_usuario)) {
            redirectTo("index.php?accion=admin_usuarios", "success", "Usuario eliminado correctamente.");
        } else {
            redirectTo("index.php?accion=admin_usuarios", "error", "Error al eliminar usuario.");
        }
    }

    public function editarUsuario($id) {
        $usuario = UsuariosModelo::obtenerPorId($id);
        if ($usuario) {
            require_once "../vistas/admin/editar_usuario.php"; // Asegúrate de esta vista
        } else {
            redirectTo("index.php?accion=admin_usuarios", "error", "Usuario no encontrado.");
        }
    }

    public function editarUsuarioGuardar($id, $datos_post) {
        // Asegúrate de que $datos_post contenga al menos nombre_usuario, correo, rol, estado
        // y opcionalmente contrasena si se desea cambiar
        if (UsuariosModelo::actualizar($id, $datos_post)) {
            redirectTo("index.php?accion=admin_usuarios", "success", "Usuario actualizado correctamente.");
        } else {
            redirectTo("index.php?accion=admin_usuarios", "error", "Error al actualizar usuario. El correo puede ya estar en uso.");
        }
    }

    public function ocultarUsuario($id_usuario) {
        if (UsuariosModelo::ocultar($id_usuario)) {
            redirectTo("index.php?accion=admin_usuarios", "success", "Usuario ocultado correctamente.");
        } else {
            redirectTo("index.php?accion=admin_usuarios", "error", "Error al ocultar usuario.");
        }
    }

    public function mostrarUsuario($id_usuario) {
        if (UsuariosModelo::mostrar($id_usuario)) {
            redirectTo("index.php?accion=admin_usuarios", "success", "Usuario mostrado correctamente.");
        } else {
            redirectTo("index.php?accion=admin_usuarios", "error", "Error al mostrar usuario.");
        }
    }

    public function gestionarPublicaciones() {
        $publicaciones = PublicacionesModelo::obtenerTodos(); // Obtener todas las publicaciones
        require_once "../vistas/admin/gestionar_publicaciones.php"; // Asegúrate de que esta vista existe
    }

    public function eliminarPublicacion($id_publicacion) {
        if (PublicacionesModelo::eliminar($id_publicacion)) {
            redirectTo("index.php?accion=admin_publicaciones", "success", "Publicación eliminada correctamente.");
        } else {
            redirectTo("index.php?accion=admin_publicaciones", "error", "Error al eliminar publicación.");
        }
    }

    public function editarPublicacion($id) {
        $publicacion = PublicacionesModelo::obtener($id);
        if ($publicacion) {
            require_once "../vistas/admin/editar_publicacion.php"; // Asegúrate de esta vista
        } else {
            redirectTo("index.php?accion=admin_publicaciones", "error", "Publicación no encontrada.");
        }
    }

    public function editarPublicacionGuardar($id, $datos_post) {
        if (PublicacionesModelo::actualizar($id, $datos_post)) {
            redirectTo("index.php?accion=admin_publicaciones", "success", "Publicación actualizada correctamente.");
        } else {
            redirectTo("index.php?accion=admin_publicaciones", "error", "Error al actualizar publicación.");
        }
    }

    public function ocultarPublicacion($id_publicacion) {
        if (PublicacionesModelo::ocultar($id_publicacion)) {
            redirectTo("index.php?accion=admin_publicaciones", "success", "Publicación ocultada correctamente.");
        } else {
            redirectTo("index.php?accion=admin_publicaciones", "error", "Error al ocultar publicación.");
        }
    }

    public function mostrarPublicacion($id_publicacion) {
        if (PublicacionesModelo::mostrar($id_publicacion)) {
            redirectTo("index.php?accion=admin_publicaciones", "success", "Publicación mostrada correctamente.");
        } else {
            redirectTo("index.php?accion=admin_publicaciones", "error", "Error al mostrar publicación.");
        }
    }
    // Puedes añadir aquí métodos para gestionar comentarios desde el admin panel si lo necesitas
    public function gestionarComentarios() {
        // Implementa lógica para obtener y mostrar comentarios
        // $comentarios = ComentariosModelo::obtenerTodos(); // si tienes un método así
        // require_once "../vistas/admin/gestionar_comentarios.php";
    }
}
?>