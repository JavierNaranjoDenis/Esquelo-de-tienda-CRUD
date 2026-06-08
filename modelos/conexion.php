<?php
class Conexion {
    public static function conectar() {
        try {
            $pdo = new PDO(
                "mysql:host=127.0.0.1;port=3306;dbname=blog_bd;charset=utf8",
                "root",
                ""
            );

            return $pdo;

        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
?>