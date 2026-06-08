<?php
// app/modelos/Comentario.php

class Comentario { // Clase en singular
    private $conexion;
    private $nombre_tabla = "Comentarios";

    public function __construct() {
        $database = Database::obtenerInstancia();
        $this->conexion = $database->obtenerConexion();
    }

    public function obtenerPorIdArticulo($id_articulo) {
        $query = "SELECT c.*, u.Nombre as nombre_autor, u.Apellido as apellido_autor
                  FROM " . $this->nombre_tabla . " c
                  LEFT JOIN Usuarios u ON c.Usuarios_Id_usuarios = u.Id_usuarios
                  WHERE c.Articulo_idArticulo = ?
                  ORDER BY c.idComentarios ASC";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $id_articulo);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($texto, $id_articulo, $id_usuario = null) {
        $query = "INSERT INTO " . $this->nombre_tabla . " (Texto, Articulo_idArticulo, Usuarios_Id_usuarios) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $texto);
        $stmt->bindParam(2, $id_articulo);
        $stmt->bindParam(3, $id_usuario); // Puede ser NULL para anónimos

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}