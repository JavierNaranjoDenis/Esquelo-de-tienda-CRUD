<?php

require_once __DIR__ . '/../conexion/BaseDatos.php';

class ChatModelo {

    public static function conversacionesUsuario($usuario_id) {
        $db = BaseDatos::getConexion();

        $sql = "SELECT 
                    c.id,
                    c.publicacion_id,
                    c.comprador_id,
                    c.vendedor_id,
                    c.fecha_creacion,
                    p.titulo
                FROM conversaciones c
                INNER JOIN publicaciones p ON p.id = c.publicacion_id
                WHERE c.comprador_id = ? OR c.vendedor_id = ?
                ORDER BY c.fecha_creacion DESC";

        $stmt = $db->prepare($sql);
        $stmt->execute([$usuario_id, $usuario_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mensajes($conversacion_id) {
        $db = BaseDatos::getConexion();

        $sql = "SELECT 
                    m.id,
                    m.conversacion_id,
                    m.emisor_id,
                    m.mensaje,
                    m.fecha,
                    u.nombre_usuario
                FROM mensajes_chat m
                INNER JOIN usuarios u ON u.id = m.emisor_id
                WHERE m.conversacion_id = ?
                ORDER BY m.fecha ASC";

        $stmt = $db->prepare($sql);
        $stmt->execute([$conversacion_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function enviar($conversacion_id, $emisor_id, $mensaje) {
        $db = BaseDatos::getConexion();

        $sql = "INSERT INTO mensajes_chat (conversacion_id, emisor_id, mensaje)
                VALUES (?, ?, ?)";

        $stmt = $db->prepare($sql);
        return $stmt->execute([$conversacion_id, $emisor_id, $mensaje]);
    }

    public static function abrir($publicacion_id, $comprador_id, $vendedor_id) {
        $db = BaseDatos::getConexion();

        $sql = "SELECT id FROM conversaciones
                WHERE publicacion_id = ?
                AND comprador_id = ?
                AND vendedor_id = ?
                LIMIT 1";

        $stmt = $db->prepare($sql);
        $stmt->execute([$publicacion_id, $comprador_id, $vendedor_id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) return $row['id'];

        $sql = "INSERT INTO conversaciones (publicacion_id, comprador_id, vendedor_id)
                VALUES (?, ?, ?)";

        $stmt = $db->prepare($sql);
        $stmt->execute([$publicacion_id, $comprador_id, $vendedor_id]);

        return $db->lastInsertId();
    }
}