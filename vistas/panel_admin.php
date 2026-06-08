<?php
session_start();
require_once __DIR__ . "/../includes/cabecera.php";


if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
  
    header("Location: inicio.php?error=" . urlencode("Acceso denegado. Solo administradores."));
    exit();
}


?>

<div class="container">
    <h2 class="mt-4 mb-4">Panel de Administración</h2>

    <p>Bienvenido, **<?php echo htmlspecialchars($_SESSION['usuario']['nombre_usuario']); ?>**.</p>
    <p>Desde aquí puedes gestionar usuarios, publicaciones y comentarios.</p>

    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Gestión de Usuarios
                </div>
                <div class="card-body">
                    <p>Administra las cuentas de usuario.</p>
                    <a href="admin_usuarios.php" class="btn btn-primary">Ver Usuarios</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Gestión de Publicaciones
                </div>
                <div class="card-body">
                    <p>Administra todas las publicaciones del blog.</p>
                    <a href="admin_publicaciones.php" class="btn btn-primary">Ver Publicaciones</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Gestión de Comentarios
                </div>
                <div class="card-body">
                    <p>Administra todos los comentarios del blog.</p>
                    <a href="admin_comentarios.php" class="btn btn-primary">Ver Comentarios</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../includes/pie.php";  ?>