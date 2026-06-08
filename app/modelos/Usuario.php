<?php
// app/modelos/Usuario.php

class Usuario {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Método para registrar un nuevo usuario
    // El $datos array debe contener 'nombre_usuario', 'email', 'contrasena' y 'id_rol'
    public function registrarUsuario($datos){
        // CAMBIO: Nombres de columnas de la tabla 'Usuarios' deben coincidir con la base de datos
        // (nombreUsuario, email, contrasena, idRol)
        $this->db->query('INSERT INTO Usuarios (nombreUsuario, email, contrasena, idRol) VALUES(:nombreUsuario, :email, :contrasena, :idRol)');

        // CAMBIO: Los bind deben usar las claves del array $datos que vienen del controlador
        $this->db->bind(':nombreUsuario', $datos['nombre_usuario']); // Asumiendo que el controlador envía 'nombre_usuario'
        $this->db->bind(':email', $datos['email']);
        $this->db->bind(':contrasena', $datos['contrasena']); // La contraseña ya debe estar hasheada
        $this->db->bind(':idRol', $datos['id_rol']);           // Asumiendo que el controlador envía 'id_rol'

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    // Método para encontrar un usuario por email
    public function encontrarUsuarioPorEmail($email){
        $this->db->query('SELECT * FROM Usuarios WHERE email = :email');
        $this->db->bind(':email', $email);

        $fila = $this->db->single();

        return $fila;
    }

    // Método para el inicio de sesión
    public function loginUsuario($email, $contrasena){
        $this->db->query('SELECT * FROM Usuarios WHERE email = :email');
        $this->db->bind(':email', $email);

        $usuario = $this->db->single();

        if ($usuario) { // Si el usuario existe
            // Verificar la contraseña hasheada
            $contrasenaHasheada = $usuario->contrasena; // La columna es 'contrasena' en tu DB
            if (password_verify($contrasena, $contrasenaHasheada)) {
                return $usuario;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Método para verificar si un usuario ha iniciado sesión
    public function estaLogueado(){
        return isset($_SESSION['id_usuario']);
    }

    // Método para verificar si el usuario logueado es administrador
    public function esAdministrador(){
        // Asumiendo que el rol de administrador es 1 (según tus inserts iniciales en Roles)
        return isset($_SESSION['rol_id']) && $_SESSION['rol_id'] == 1;
    }

    // Método para obtener un usuario por su ID
    public function obtenerUsuarioPorId($id){
        // CAMBIO: La columna ID en la tabla Usuarios es 'idUsuario'
        $this->db->query('SELECT * FROM Usuarios WHERE idUsuario = :id');
        $this->db->bind(':id', $id);
        $usuario = $this->db->single();
        return $usuario;
    }
}