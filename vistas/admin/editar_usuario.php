<h2>Editar Usuario: <?php echo htmlspecialchars($usuario['nombre_usuario'] ?? ''); // $usuario viene del controlador ?></h2>
<form action="/admin/usuarios/editar/<?php echo htmlspecialchars($usuario['id'] ?? ''); ?>" method="POST">
    <label for="nombre_usuario">Nombre de Usuario:</label>
    <input type="text" id="nombre_usuario" name="nombre_usuario" value="<?php echo htmlspecialchars($usuario['nombre_usuario'] ?? ''); ?>" required><br>

    <label for="correo">Correo:</label>
    <input type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($usuario['correo'] ?? ''); ?>" required><br>

    <label for="rol">Rol:</label>
    <select id="rol" name="rol">
        <option value="admin" <?php echo (($usuario['rol'] ?? '') === 'admin') ? 'selected' : ''; ?>>Administrador</option>
        <option value="editor" <?php echo (($usuario['rol'] ?? '') === 'editor') ? 'selected' : ''; ?>>Editor</option>
        <option value="usuario" <?php echo (($usuario['rol'] ?? '') === 'usuario') ? 'selected' : ''; ?>>Usuario</option>
    </select><br>

    <label for="estado">Estado:</label>
    <select id="estado" name="estado">
        <option value="activo" <?php echo (($usuario['estado'] ?? '') === 'activo') ? 'selected' : ''; ?>>Activo</option>
        <option value="inactivo" <?php echo (($usuario['estado'] ?? '') === 'inactivo') ? 'selected' : ''; ?>>Inactivo</option>
        <option value="oculto" <?php echo (($usuario['estado'] ?? '') === 'oculto') ? 'selected' : ''; ?>>Oculto</option>
    </select><br>

    <label for="contrasena">Nueva Contraseña (dejar en blanco para no cambiar):</label>
    <input type="password" id="contrasena" name="contrasena"><br>

    <button type="submit">Guardar Cambios</button>
    <a href="/admin/usuarios" class="button">Cancelar</a>
</form>