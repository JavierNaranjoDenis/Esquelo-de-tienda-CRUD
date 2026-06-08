<?php
require_once __DIR__ . '/conexion.php';

class CarritoModelo {

    public static function agregarAlCarrito($usuario_id, $publicacion_id) {
        $db = Conexion::conectar();

        $sql_check = "SELECT id FROM carrito WHERE usuario_id = ? AND publicacion_id = ?";
        $stmt_check = $db->prepare($sql_check);
        $stmt_check->execute([$usuario_id, $publicacion_id]);
        if ($stmt_check->fetch()) {
            return true; 
        }
        $sql = "INSERT INTO carrito (usuario_id, publicacion_id, fecha_agregado) VALUES (?, ?, NOW())";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$usuario_id, $publicacion_id]);
    }

    public static function obtenerCarritoPorUsuario($usuario_id) {
        $db = Conexion::conectar();

        $sql = "SELECT c.*, p.titulo, p.juego, p.plataforma, p.precio, p.fecha_publicacion
                FROM carrito c
                JOIN publicaciones p ON p.id = c.publicacion_id
                WHERE c.usuario_id = ?";

        $stmt = $db->prepare($sql);
        $stmt->execute([$usuario_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
