<?php
require_once __DIR__ . '/../modelos/CarritoModelo.php';

class CarritoControlador {
    public static function agregar($usuario_id, $publicacion_id) {
        return CarritoModelo::agregarAlCarrito($usuario_id, $publicacion_id);
    }

    public static function obtenerCarrito($usuario_id) {
        return CarritoModelo::obtenerCarritoPorUsuario($usuario_id);
    }

    public static function eliminar($usuario_id, $publicacion_id) {
        return CarritoModelo::eliminarDelCarrito($usuario_id, $publicacion_id);
    }
}
?>
