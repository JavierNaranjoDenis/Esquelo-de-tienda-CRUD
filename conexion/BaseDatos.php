<?php
class BaseDatos {
    public static function getConexion() {
        try {
            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=blog_bd;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
