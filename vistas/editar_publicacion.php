<?php
session_start();

require_once __DIR__ . '/../controladores/publicacionesControlador.php';

if (!isset($_GET['id'])) {
    header("Location: panel_usuario.php");
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    PublicacionesControlador::actualizar($id, [
        'titulo' => $_POST['titulo'],
        'contenido' => $_POST['contenido'],
        'precio' => $_POST['precio'],
        'categoria' => $_POST['categoria'],
        'condicion' => $_POST['condicion'],
        'estado' => $_POST['estado']
    ]);

    header("Location: panel_usuario.php");
    exit;
}

$pub = PublicacionesControlador::obtener($id);
?>

<form method="POST">

    <input type="text" name="titulo" value="<?php echo $pub['titulo']; ?>">
    <textarea name="contenido"><?php echo $pub['contenido']; ?></textarea>

    <input type="number" name="precio" value="<?php echo $pub['precio']; ?>">

    <input type="text" name="categoria" value="<?php echo $pub['categoria']; ?>">

    <input type="text" name="condicion" value="<?php echo $pub['condicion_producto']; ?>">

    <select name="estado">
        <option value="Disponible">Disponible</option>
        <option value="Agotado">Agotado</option>
    </select>

    <button type="submit">Actualizar</button>

</form>