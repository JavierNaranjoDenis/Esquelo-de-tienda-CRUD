<?php
require_once __DIR__ . '/../modelos/conexion.php';
require_once __DIR__ . '/../modelos/ComprasModelo.php';
require_once __DIR__ . '/../modelos/CarritoModelo.php';

class ComprasControlador {

    public static function solicitarCompra($comprador_id, $publicacion_id, $mensaje) {
        return ComprasModelo::solicitarCompra($comprador_id, $publicacion_id, $mensaje);
    }

    public static function obtenerSolicitudesPorVendedor($vendedor_id) {
        return ComprasModelo::obtenerSolicitudesPorVendedor($vendedor_id);
    }

    public static function actualizarEstado($compra_id, $estado) {
        if (!in_array($estado, ['aceptada', 'rechazada'])) {
            return false;
        }
        return ComprasModelo::actualizarEstado($compra_id, $estado);
    }

    public static function aceptarCompra($compra_id) {
        $db = Conexion::conectar();

        // Obtener comprador_id y publicacion_id correctamente
        $sql = "SELECT comprador_id AS usuario_id, publicacion_id FROM compras WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$compra_id]);
        $compra = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$compra) {
            return false; // Compra no encontrada
        }

        // Actualizar estado a 'aceptada'
        $sql_update = "UPDATE compras SET estado = 'aceptada' WHERE id = ?";
        $stmt_update = $db->prepare($sql_update);
        $cambio = $stmt_update->execute([$compra_id]);

        if ($cambio) {
            // Agregar al carrito
            return CarritoModelo::agregarAlCarrito($compra['usuario_id'], $compra['publicacion_id']);
        }

        return false;
    }
}

