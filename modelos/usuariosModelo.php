<?php
require_once "conexion.php";
class UsuariosModelo {
    public static function obtenerTodos() {
        $sql = "SELECT * FROM usuarios";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public static function obtenerPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public static function registrar($datos) {
        $sql = "INSERT INTO usuarios (nombre_usuario, correo, contrasena, rol) VALUES (?, ?, ?, ?)";
        $stmt = Conexion::conectar()->prepare($sql);
        return $stmt->execute($datos);
    }
    public static function validarLogin($correo, $contrasena) {
        $sql = "SELECT * FROM usuarios WHERE correo = ? AND contrasena = ?";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute([$correo, $contrasena]);
        return $stmt->fetch();
    }
    public static function eliminar($id) {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = Conexion::conectar()->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>