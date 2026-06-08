<?php

require_once __DIR__ . '/../conexion/BaseDatos.php';

class PublicacionesModelo {

    public static function todas() {

        $db = BaseDatos::getConexion();

        $sql = "SELECT p.*, u.nombre_usuario AS autor
                FROM publicaciones p
                INNER JOIN usuarios u ON u.id = p.usuario_id
                ORDER BY p.id DESC";

        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function porUsuario($usuario_id) {

        $db = BaseDatos::getConexion();

        $sql = "SELECT * FROM publicaciones WHERE usuario_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$usuario_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtener($id) {

        $db = BaseDatos::getConexion();

        $sql = "SELECT * FROM publicaciones WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ CORREGIDO: nombre real de tu tabla
    public static function obtenerImagenes($id) {

        $db = BaseDatos::getConexion();

        $sql = "SELECT imagen 
                FROM publicaciones_imagenes 
                WHERE publicacion_id = ?";

        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function crear($titulo, $contenido, $precio, $categoria, $condicion, $estado, $usuario_id) {

        $db = BaseDatos::getConexion();

        $sql = "INSERT INTO publicaciones
                (titulo, contenido, precio, categoria, condicion_producto, estado, usuario_id)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $db->prepare($sql);
        $stmt->execute([$titulo, $contenido, $precio, $categoria, $condicion, $estado, $usuario_id]);

        return $db->lastInsertId();
    }

    public static function actualizar($id, $titulo, $contenido, $precio, $categoria, $condicion, $estado) {

        $db = BaseDatos::getConexion();

        $sql = "UPDATE publicaciones
                SET titulo=?, contenido=?, precio=?, categoria=?, condicion_producto=?, estado=?
                WHERE id=?";

        $stmt = $db->prepare($sql);
        return $stmt->execute([$titulo, $contenido, $precio, $categoria, $condicion, $estado, $id]);
    }

    public static function eliminar($id) {

        $db = BaseDatos::getConexion();

        $sql = "DELETE FROM publicaciones WHERE id=?";
        $stmt = $db->prepare($sql);

        return $stmt->execute([$id]);
    }
}