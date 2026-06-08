<?php
// app/Controladores/AuthControlador.php
require_once __DIR__ . '/../modelos/Usuario.php';

class AuthControlador {
    private $usuarioModelo;

    public function __construct(){
        $this->usuarioModelo = new Usuario();
    }

    public function registrar(){
        echo "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "";
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $datos = [
                'nombre_usuario' => trim($_POST['nombre_usuario'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'contrasena' => trim($_POST['contrasena'] ?? ''),
                'confirmar_contrasena' => trim($_POST['confirmar_contrasena'] ?? ''),
                'error_nombre_usuario' => '',
                'error_email' => '',
                'error_contrasena' => '',
                'error_confirmar_contrasena' => ''
            ];

            // Validar los datos
            if (empty($datos['nombre_usuario'])) {
                $datos['error_nombre_usuario'] = 'Por favor ingresa un nombre de usuario.';
            }

            if (empty($datos['email'])) {
                $datos['error_email'] = 'Por favor ingresa un email.';
            } elseif ($this->usuarioModelo->encontrarUsuarioPorEmail($datos['email'])) {
                $datos['error_email'] = 'Este email ya está registrado.';
            }

            if (empty($datos['contrasena'])) {
                $datos['error_contrasena'] = 'Por favor ingresa una contraseña.';
            } elseif (strlen($datos['contrasena']) < 6) {
                $datos['error_contrasena'] = 'La contraseña debe tener al menos 6 caracteres.';
            }

            if (empty($datos['confirmar_contrasena'])) {
                $datos['error_confirmar_contrasena'] = 'Por favor confirma tu contraseña.';
            } elseif ($datos['contrasena'] !== $datos['confirmar_contrasena']) {
                $datos['error_confirmar_contrasena'] = 'Las contraseñas no coinciden.';
            }

            echo "";

            // Si no hay errores, intentar registrar al usuario
            if (empty($datos['error_nombre_usuario']) && empty($datos['error_email']) && empty($datos['error_contrasena']) && empty($datos['error_confirmar_contrasena'])) {
                // Hashear la contraseña
                $datos['contrasena'] = password_hash($datos['contrasena'], PASSWORD_DEFAULT);

                // Asegúrate de que 'id_rol' esté presente en el array $datos
                $datos['id_rol'] = 3; // Asigna rol 3 (Lector)

                echo "";
                if ($this->usuarioModelo->registrarUsuario($datos)) { // Se pasa el array $datos
                    echo "";
                    $_SESSION['mensaje_exito'] = '¡Registro exitoso! Por favor, inicia sesión.';
                    header('Location: ' . BASE_URL . 'login.php');
                    exit(); // Importante para detener la ejecución después de la redirección
                } else {
                    echo "";
                    $_SESSION['mensaje_error'] = 'Hubo un error al intentar registrar el usuario. Inténtalo de nuevo.';
                    $this->cargarVista('auth/registro', $datos);
                }
            } else {
                echo "";
                $_SESSION['mensaje_error'] = 'Por favor, corrige los errores en el formulario.';
                $this->cargarVista('auth/registro', $datos);
            }
        } else {
            // Si la solicitud es GET, simplemente cargar el formulario de registro
            $datos = [
                'nombre_usuario' => '',
                'email' => '',
                'contrasena' => '',
                'confirmar_contrasena' => '',
                'error_nombre_usuario' => '',
                'error_email' => '',
                'error_contrasena' => '',
                'error_confirmar_contrasena' => ''
            ];
            echo "";
            $this->cargarVista('auth/registro', $datos);
            echo "";
        }
        echo "";
    }

    private function cargarVista($nombreVista, $datos = []){
        echo "";
        extract($datos);
        echo "";
        ob_start();
        echo "";
        require_once __DIR__ . '/../vistas/' . $nombreVista . '.php';
        echo "";
        $contenido = ob_get_clean();
        echo "";
        require_once __DIR__ . '/../vistas/layout.php';
        echo "";
    }
}