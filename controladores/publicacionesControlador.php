<?php

require_once __DIR__ . '/../modelos/publicacionesModelo.php';

class PublicacionesControlador {

    public static function todas() {
        return PublicacionesModelo::todas();
    }

    public static function porUsuario($usuario_id) {
        return PublicacionesModelo::porUsuario($usuario_id);
    }

    public static function obtener($id) {
        return PublicacionesModelo::obtener($id);
    }

    public static function obtenerImagenes($id) {
        return PublicacionesModelo::obtenerImagenes($id);
    }

    public static function crear($titulo, $contenido, $precio, $categoria, $condicion, $estado, $usuario_id) {
        return PublicacionesModelo::crear($titulo, $contenido, $precio, $categoria, $condicion, $estado, $usuario_id);
    }

    // 🔥 MEJORADO: acepta datos incompletos sin romper
    public static function actualizar($id, $data = []) {

        $actual = PublicacionesModelo::obtener($id);

        $titulo = $data['titulo'] ?? $actual['titulo'];
        $contenido = $data['contenido'] ?? $actual['contenido'];
        $precio = $data['precio'] ?? $actual['precio'];
        $categoria = $data['categoria'] ?? $actual['categoria'];
        $condicion = $data['condicion'] ?? $actual['condicion_producto'];
        $estado = $data['estado'] ?? $actual['estado'];

        return PublicacionesModelo::actualizar(
            $id,
            $titulo,
            $contenido,
            $precio,
            $categoria,
            $condicion,
            $estado
        );
    }

    public static function eliminar($id) {
        return PublicacionesModelo::eliminar($id);
    }
}