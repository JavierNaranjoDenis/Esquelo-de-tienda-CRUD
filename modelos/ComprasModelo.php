<?php
require_once __DIR__ . '/conexion.php';

require_once __DIR__ . '/CarritoModelo.php'; 

class ComprasModelo {
    public static function crearCompra($usuario_id, $publicacion_id, $mensaje = null) {
        $db = Conexion::conectar();
        $sql = "INSERT INTO compras (usuario_id, publicacion_id, mensaje, fecha_solicitud) VALUES (?, ?, ?, NOW())";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$usuario_id, $publicacion_id, $mensaje]);
    }

    public static function solicitarCompra($usuario_id, $publicacion_id, $mensaje) {
        $conexion = Conexion::conectar();
        $sql = "INSERT INTO compras (comprador_id, publicacion_id, estado, fecha_solicitud, mensaje)
                VALUES (?, ?, 'pendiente', NOW(), ?)";
        $stmt = $conexion->prepare($sql);
        return $stmt->execute([$usuario_id, $publicacion_id, $mensaje]);
    }

    public static function obtenerSolicitudesPorPublicacion($publicacion_id) {
        $conexion = Conexion::conectar();
        $sql = "SELECT c.*, u.nombre_usuario 
                FROM compras c
                JOIN usuarios u ON u.id = c.usuario_id
                WHERE c.publicacion_id = ?
                ORDER BY c.fecha_solicitud DESC";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$publicacion_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function actualizarEstado($compra_id, $estado) {
        $conexion = Conexion::conectar();
        $sql = "UPDATE compras SET estado = ? WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        return $stmt->execute([$estado, $compra_id]);
    }

    public static function obtenerSolicitudesPorVendedor($vendedor_id) {
        $conexion = Conexion::conectar();
        $sql = "SELECT c.*, u.nombre_usuario, p.titulo 
                FROM compras c
                JOIN publicaciones p ON p.id = c.publicacion_id
                JOIN usuarios u ON u.id = c.comprador_id
                WHERE p.usuario_id = ?
                ORDER BY c.fecha_solicitud DESC";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$vendedor_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function aceptarCompra($compra_id) {
        $conexion = Conexion::conectar();

        $sql = "SELECT usuario_id, publicacion_id FROM compras WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$compra_id]);
        $compra = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$compra) return false;

        $sqlUpdate = "UPDATE compras SET estado = 'aceptada' WHERE id = ?";
        $stmtUpdate = $conexion->prepare($sqlUpdate);
        $actualizado = $stmtUpdate->execute([$compra_id]);

        if ($actualizado) {
            return CarritoModelo::agregarAlCarrito($compra['usuario_id'], $compra['publicacion_id']);
        }

        return false;
    }
}
?>
