<?php
session_start();
require_once "../controladores/usuariosControlador.php";
require_once "../controladores/publicacionesControlador.php";
require_once "../controladores/comentariosControlador.php";

if (isset($_GET['accion'])) {
    switch ($_GET['accion']) {
        case 'login':
            $usuario = UsuariosControlador::login($_POST['correo'], $_POST['contrasena']);
            if ($usuario) {
                $_SESSION['usuario'] = $usuario;
                header("Location: ../vistas/inicio.php");
            } else {
                header("Location: ../vistas/login.php?error=1");
            }
            break;
        case 'registro':
            UsuariosControlador::registrar($_POST['nombre_usuario'], $_POST['correo'], $_POST['contrasena']);
            header("Location: ../vistas/login.php");
            break;
        case 'logout':
            session_destroy();
            header("Location: ../vistas/login.php");
            break;
        case 'comentar':
           
            $comentario_texto = $_POST['comentario'] ?? ''; 
            $publicacion_id = $_POST['publicacion_id'] ?? null;

            if (isset($_SESSION['usuario']) && !empty($comentario_texto) && $publicacion_id) {
                 ComentariosControlador::crear($publicacion_id, $_SESSION['usuario']['id'], $comentario_texto); 
                 header("Location: ../vistas/publicaciones.php?id=" . $publicacion_id . "&mensaje=Comentario+agregado");
            } else {
                
                 header("Location: ../vistas/publicaciones.php?id=" . $publicacion_id . "&error=No+se+pudo+agregar+el+comentario");
            }
            break;
        case 'eliminar_usuario':
            if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] === 'admin' && isset($_GET['id'])) {
                UsuariosControlador::eliminar($_GET['id']); 
                header("Location: ../vistas/panel_admin.php?mensaje=Usuario+eliminado");
            } else {
                header("Location: ../vistas/panel_admin.php?error=Permiso+denegado+o+ID+invalido");
            }
            break;
      
        case 'eliminar_publicacion':
           
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $id_publicacion = $_GET['id'];
                $publicacion = PublicacionesControlador::obtener($id_publicacion); 

                if ($publicacion && isset($_SESSION['usuario'])) {
                    if ($_SESSION['usuario']['id'] === $publicacion['usuario_id'] || $_SESSION['usuario']['rol'] === 'admin') {
                        $resultado = PublicacionesControlador::eliminar($id_publicacion); 
                        if ($resultado) {
                            header("Location: ../vistas/panel_usuario.php?mensaje=Publicacion+eliminada+correctamente");
                        } else {
                            header("Location: ../vistas/panel_usuario.php?error=Error+al+eliminar+la+publicacion");
                        }
                    } else {
                        header("Location: ../vistas/panel_usuario.php?error=No+tienes+permiso+para+eliminar+esta+publicacion");
                    }
                } else {
                    header("Location: ../vistas/panel_usuario.php?error=Publicacion+no+encontrada+o+sesion+no+activa");
                }
            } else {
                header("Location: ../vistas/panel_usuario.php?error=ID+de+publicacion+invalido");
            }
            break;
    }
} else {
  
}
?>