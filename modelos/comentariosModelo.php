<?php

require_once __DIR__ . '/../conexion/BaseDatos.php';

class ComentariosModelo {

    public static function crear($publicacion_id, $usuario_id, $comentario) {

        $db = BaseDatos::getConexion();

        $sql = "INSERT INTO comentarios_publicacion
                (publicacion_id, usuario_id, comentario)
                VALUES (?, ?, ?)";

        $stmt = $db->prepare($sql);
        return $stmt->execute([$publicacion_id, $usuario_id, $comentario]);
    }

    public static function obtenerPorPublicacion($publicacion_id) {

        $db = BaseDatos::getConexion();

        $sql = "SELECT c.*, u.nombre_usuario
                FROM comentarios_publicacion c
                JOIN usuarios u ON c.usuario_id = u.id
                WHERE c.publicacion_id = ?
                ORDER BY c.fecha DESC";

        $stmt = $db->prepare($sql);
        $stmt->execute([$publicacion_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}