<?php
require_once __DIR__ . '/../conexion/BaseDatos.php';

class NotificacionesModelo {
    public static function crear($usuario_id, $mensaje) {
        $db = BaseDatos::getConexion();
        $sql = "INSERT INTO notificaciones (usuario_id, mensaje) VALUES (?, ?)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$usuario_id, $mensaje]);
    }

    public static function obtenerPorUsuario($usuario_id) {
        $db = BaseDatos::getConexion();
        $sql = "SELECT * FROM notificaciones WHERE usuario_id = ? ORDER BY fecha_creacion DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function marcarComoLeido($id) {
        $db = BaseDatos::getConexion();
        $sql = "UPDATE notificaciones SET leido = TRUE WHERE id = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$id]);
    }
    public static function contarNoLeidasPorUsuario($usuario_id) {
    $db = BaseDatos::getConexion();
    $sql = "SELECT COUNT(*) FROM notificaciones WHERE usuario_id = ? AND leido = FALSE";
    $stmt = $db->prepare($sql);
    $stmt->execute([$usuario_id]);
    return (int) $stmt->fetchColumn();
}

}
?>
