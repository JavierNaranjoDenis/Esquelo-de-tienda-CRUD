<h2>Gestionar Usuarios</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($usuarios)): // $usuarios viene del controlador ?>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['nombre_usuario']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['correo']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['rol']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['estado']); ?></td>
                    <td>
                        <a href="/admin/usuarios/editar/<?php echo $usuario['id']; ?>" class="edit-btn">Editar</a>
                        <a href="/admin/usuarios/eliminar/<?php echo $usuario['id']; ?>" class="delete-btn" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">Eliminar</a>
                        <?php if ($usuario['estado'] !== 'oculto'): ?>
                            <a href="/admin/usuarios/ocultar/<?php echo $usuario['id']; ?>" class="hide-btn" onclick="return confirm('¿Estás seguro de que quieres ocultar este usuario?');">Ocultar</a>
                        <?php else: ?>
                            <a href="/admin/usuarios/mostrar/<?php echo $usuario['id']; ?>" class="unhide-btn" onclick="return confirm('¿Estás seguro de que quieres mostrar este usuario?');">Mostrar</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6">No hay usuarios registrados.</td></tr>
        <?php endif; ?>
    </tbody>
</table>