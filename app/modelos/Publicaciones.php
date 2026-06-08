<?php
// app/modelos/Publicaiones.php

class Articulo {
    private $conexion;
    private $nombre_tabla = "publicaciones";

    public function __construct() {
        $database = Database::obtenerInstancia();
        $this->conexion = $database->obtenerConexion();
    }

    public function obtenerTodos() {
        $query = "SELECT a.*, u.Nombre as nombre_autor, u.Apellido as apellido_autor, e.Estado as nombre_estado
                  FROM " . $this->nombre_tabla . " a
                  JOIN Usuarios u ON a.Usuarios_Id_usuarios = u.Id_usuarios
                  JOIN Estado e ON a.Estado_idEstado = e.idEstado
                  ORDER BY a.Fecha_de_edicion DESC";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $query = "SELECT a.*, u.Nombre as nombre_autor, u.Apellido as apellido_autor, e.Estado as nombre_estado
                  FROM " . $this->nombre_tabla . " a
                  JOIN Usuarios u ON a.Usuarios_Id_usuarios = u.Id_usuarios
                  JOIN Estado e ON a.Estado_idEstado = e.idEstado
                  WHERE a.idArticulo = ? LIMIT 0,1";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($nombre, $fecha_edicion, $contenido, $estado_str, $id_usuario, $id_estado) {
        $query = "INSERT INTO " . $this->nombre_tabla . " (Nombre, Fecha_de_edicion, Articolocol, Estado, Usuarios_Id_usuarios, Estado_idEstado) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $fecha_edicion);
        $stmt->bindParam(3, $contenido);
        $stmt->bindParam(4, $estado_str);
        $stmt->bindParam(5, $id_usuario);
        $stmt->bindParam(6, $id_estado);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function actualizar($id, $nombre, $fecha_edicion, $contenido, $estado_str, $id_estado) {
        $query = "UPDATE " . $this->nombre_tabla . " SET Nombre = ?, Fecha_de_edicion = ?, Articolocol = ?, Estado = ?, Estado_idEstado = ? WHERE idArticulo = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $fecha_edicion);
        $stmt->bindParam(3, $contenido);
        $stmt->bindParam(4, $estado_str);
        $stmt->bindParam(5, $id_estado);
        $stmt->bindParam(6, $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function eliminar($id) {
        $query = "DELETE FROM " . $this->nombre_tabla . " WHERE idArticulo = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function obtenerEstados() {
        $query = "SELECT * FROM Estado";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}