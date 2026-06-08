<?php
// public/login.php
session_start();

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/modelos/Database.php';
require_once __DIR__ . '/../app/modelos/Usuario.php';
require_once __DIR__ . '/../app/Controladores/AuthControlador.php';

$authControlador = new AuthControlador();
$authControlador->ingresar(); // <-- Lo regresamos a 'ingresar()' como estaba originalmente
?>
