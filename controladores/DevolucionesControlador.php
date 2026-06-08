<?php
require_once __DIR__ . '/../modelos/DevolucionesModelo.php';

class DevolucionesControlador {
    public static function crear($compra_id, $comprador_id, $vendedor_id, $mensaje) {
        return DevolucionesModelo::crear($compra_id, $comprador_id, $vendedor_id, $mensaje);
    }

    public static function contarNoLeidas($vendedor_id) {
        return DevolucionesModelo::contarNoLeidasPorVendedor($vendedor_id);
    }

    public static function obtenerNoLeidas($vendedor_id) {
        return DevolucionesModelo::obtenerNoLeidasPorVendedor($vendedor_id);
    }

    public static function marcarComoLeido($id) {
        return DevolucionesModelo::marcarComoLeido($id);
    }
}
?>
