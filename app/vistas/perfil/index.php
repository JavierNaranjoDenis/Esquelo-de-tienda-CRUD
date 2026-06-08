<?php ob_start(); ?>

<h1>Perfil de Usuario: <?php echo $usuario->nombre . ' ' . $usuario->apellido; ?></h1>

<div class="perfil-info">
    <p><strong>Email:</strong> <?php echo $usuario->email; ?></p>
    <p><strong>Rol:</strong> <?php echo $_SESSION['rol_nombre']; ?></p>
    <p><strong>Miembro desde:</strong> <?php echo date('d/m/Y', strtotime($usuario->fecha_registro)); ?></p>
    
    <a href="<?php echo BASE_URL; ?>perfil/editar" class="boton">Editar Perfil</a>
    
    <?php if (isset($_SESSION['rol_id']) && $_SESSION['rol_id'] == 2): // Si es Usuario General ?>
        <h2>Mis Publicaciones</h2>
        <p>No tienes publicaciones aún. <a href="<?php echo BASE_URL; ?>articulos/crear">¡Crea una!</a></p>
    <?php endif; ?>

</div>

<?php
$contenido = ob_get_clean();
require_once __DIR__ . '/../layout.php';
?>