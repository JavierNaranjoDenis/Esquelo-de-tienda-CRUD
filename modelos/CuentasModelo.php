<?php
require_once __DIR__ . '/../conexion/BaseDatos.php';

class CuentasModelo {
    public static function obtenerTodas() {
        $db = BaseDatos::getConexion();
        $sql = "SELECT c.*, u.nombre_usuario AS autor 
                FROM cuentas c 
                JOIN usuarios u ON c.usuario_id = u.id 
                WHERE c.estado = 'activo'
                ORDER BY fecha_creacion DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerTodasConEstado() {
        $db = BaseDatos::getConexion();
        $sql = "SELECT c.*, u.nombre_usuario AS autor 
                FROM cuentas c 
                JOIN usuarios u ON c.usuario_id = u.id 
                ORDER BY fecha_creacion DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerPorUsuario($usuario_id) {
        $db = BaseDatos::getConexion();
        $sql = "SELECT c.*, u.nombre_usuario AS nombre_usuario_autor 
                FROM cuentas c 
                JOIN usuarios u ON c.usuario_id = u.id 
                WHERE c.usuario_id = ? AND c.estado = 'activo'
                ORDER BY fecha_creacion DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function crear($datos) {
        $db = BaseDatos::getConexion();
        $sql = "INSERT INTO cuentas (juego, plataforma, descripcion, imagen, usuario_id, fecha_creacion, estado) 
                VALUES (?, ?, ?, ?, ?, NOW(), 'activo')";
        $stmt = $db->prepare($sql);
        return $stmt->execute($datos);
    }

    public static function obtenerPorId($id) {
        $db = BaseDatos::getConexion();
        $sql = "SELECT c.*, u.nombre_usuario AS nombre_usuario_autor 
                FROM cuentas c 
                JOIN usuarios u ON c.usuario_id = u.id 
                WHERE c.id = ? AND c.estado = 'activo'";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function actualizar($datos) {
        $db = BaseDatos::getConexion();
        $sql = "UPDATE cuentas 
                SET juego = ?, plataforma = ?, descripcion = ?, imagen = ? 
                WHERE id = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute($datos);
    }

    public static function eliminar($id) {
        $db = BaseDatos::getConexion();
        $sql = "DELETE FROM cuentas WHERE id = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$id]);
    }

    public static function cambiarEstado($id) {
        $db = BaseDatos::getConexion();
        $sql = "UPDATE cuentas SET estado = 
                CASE 
                    WHEN estado = 'activo' THEN 'oculto'
                    ELSE 'activo'
                END
                WHERE id = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$id]);
    }
    public static function marcarComoReservado($id) {
    $db = BaseDatos::getConexion();
    $sql = "UPDATE cuentas SET estado = 'reservado' WHERE id = ?";
    $stmt = $db->prepare($sql);
    return $stmt->execute([$id]);
}

public static function marcarComoVendido($id) {
    $db = BaseDatos::getConexion();
    $sql = "UPDATE cuentas SET estado = 'vendido' WHERE id = ?";
    $stmt = $db->prepare($sql);
    return $stmt->execute([$id]);
}public static function notificacionesDetalle($usuario_id) {

    $db = BaseDatos::getConexion();

    $sql = "SELECT 
                m.id,
                m.mensaje,
                m.leido,
                m.fecha,
                u.nombre_usuario,
                c.id AS chat_id,
                p.titulo
            FROM mensajes_chat m
            INNER JOIN conversaciones c ON c.id = m.conversacion_id
            INNER JOIN usuarios u ON u.id = m.emisor_id
            INNER JOIN publicaciones p ON p.id = c.publicacion_id
            WHERE (c.comprador_id = ? OR c.vendedor_id = ?)
              AND m.emisor_id != ?
              AND m.leido = 0
            ORDER BY m.fecha DESC
            LIMIT 10";

    $stmt = $db->prepare($sql);
    $stmt->execute([$usuario_id, $usuario_id, $usuario_id]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}

?>
