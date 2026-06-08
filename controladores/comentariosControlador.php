<?php

require_once "../modelos/comentariosModelo.php";

class ComentariosControlador {

    public static function porPublicacion($id) {
        return ComentariosModelo::obtenerPorPublicacion($id);
    }

    public static function crear($publicacion_id, $usuario_id, $comentario) {
        return ComentariosModelo::crear($publicacion_id, $usuario_id, $comentario);
    }
}