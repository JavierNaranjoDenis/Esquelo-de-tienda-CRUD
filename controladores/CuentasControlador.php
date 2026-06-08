<?php
require_once __DIR__ . '/../modelos/CuentasModelo.php';

class CuentasControlador {
    public static function todas() {
        return CuentasModelo::obtenerTodas();
    }

    public static function todasConEstado() {
        return CuentasModelo::obtenerTodasConEstado();
    }

    public static function porUsuario($usuario_id) {
        return CuentasModelo::obtenerPorUsuario($usuario_id);
    }

    public static function crear($juego, $plataforma, $descripcion, $usuario_id) {
        return CuentasModelo::crear([$juego, $plataforma, $descripcion, $usuario_id]);
    }

    public static function obtener($id) {
        return CuentasModelo::obtenerPorId($id);
    }

    public static function actualizar($juego, $plataforma, $descripcion, $id) {
        return CuentasModelo::actualizar([$juego, $plataforma, $descripcion, $id]);
    }

    public static function eliminar($id) {
        return CuentasModelo::eliminar($id);
    }

    public static function cambiarEstado($id) {
        return CuentasModelo::cambiarEstado($id);
    }
    public static function reservar($id) {
    return CuentasModelo::marcarComoReservado($id);
}

public static function vender($id) {
    return CuentasModelo::marcarComoVendido($id);
}

}
?>

