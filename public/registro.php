<?php
// public/registro.php
ini_set('display_errors', 1); // Habilitar display_errors temporalmente para depuración
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Incluir archivos de configuración y modelos
require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/modelos/Database.php';
require_once __DIR__ . '/../app/modelos/Usuario.php';

// Asegúrate que la 'C' de Controladores sea mayúscula según tu estructura
require_once __DIR__ . '/../app/Controladores/AuthControlador.php';

echo "";

$authControlador = new AuthControlador();

echo "";

// Llama al método registrar del controlador. Este método debería manejar la lógica y cargar la vista.
$authControlador->registrar();

echo "";
?>