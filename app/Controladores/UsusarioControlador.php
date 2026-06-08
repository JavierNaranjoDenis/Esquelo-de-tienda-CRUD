<?php
// app/controladores/UsuarioControlador.php

class UsuarioControlador {
    private $usuarioModelo;

    public function __construct(){
        $this->usuarioModelo = new Usuario();
    }

    public function index() {
        // Lógica para listar usuarios (solo para administradores)
        if (!$this->usuarioModelo->esAdministrador()) {
            $_SESSION['mensaje_error'] = 'No tienes permiso para ver esta sección.';
            header('Location: ' . BASE_URL);
            exit();
        }
        $usuarios = $this->usuarioModelo->obtenerTodosLosUsuarios(); // Necesitarás este método en el modelo
        $this->cargarVista('usuarios/index', ['usuarios' => $usuarios]);
    }

    // NUEVO MÉTODO: Para la página de perfil del usuario
    public function perfil(){
        if (!$this->usuarioModelo->estaLogueado()) {
            $_SESSION['mensaje_error'] = 'Necesitas iniciar sesión para ver tu perfil.';
            header('Location: ' . BASE_URL . 'ingresar');
            exit();
        }

        // Obtener datos del usuario logueado de la sesión
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = $this->usuarioModelo->obtenerUsuarioPorId($id_usuario); // Usa el nuevo método del modelo

        if ($usuario) {
            $this->cargarVista('perfil/index', ['usuario' => $usuario]);
        } else {
            $_SESSION['mensaje_error'] = 'No se pudieron cargar los datos del perfil.';
            header('Location: ' . BASE_URL);
            exit();
        }
    }

    // Método auxiliar para cargar vistas (ya lo tienes o similar)
    private function cargarVista($nombreVista, $datos = []) {
        extract($datos);
        require_once __DIR__ . '/../vistas/' . $nombreVista . '.php';
    }

    // Puedes necesitar un método para obtener todos los usuarios en el modelo si implementas el index de usuarios
    // public function obtenerTodosLosUsuarios() { ... }
}