<?php ob_start(); ?>

<h1>Gestión de Usuarios</h1>

<?php if (empty($usuarios)): ?>
    <p>No hay usuarios registrados.</p>
<?php else: ?>
    <table class="tabla-usuarios">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo htmlspecialchars($usuario['Id_usuarios']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['Nombre']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['Apellido']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['nombre_rol']); ?></td>
                    <td>
                        <a href="#" class="boton boton-editar">Editar</a>
                        <button type="button" class="boton boton-eliminar">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php
$contenido = ob_get_clean();
require_once __DIR__ . '/../layout.php';
?>