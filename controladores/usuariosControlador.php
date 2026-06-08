<?php

require_once "../modelos/usuariosModelo.php";
class UsuariosControlador {
    public static function registrar($nombre, $correo, $contrasena, $rol = 'usuario') {
        return UsuariosModelo::registrar([$nombre, $correo, $contrasena, $rol]);
    }

    public static function login($correo, $contrasena) {
        return UsuariosModelo::validarLogin($correo, $contrasena);
    }

    public static function obtenerUsuarios() {
        return UsuariosModelo::obtenerTodos();
    }

    public static function eliminarUsuario($id) {
        return UsuariosModelo::eliminar($id);
    }
}
?>