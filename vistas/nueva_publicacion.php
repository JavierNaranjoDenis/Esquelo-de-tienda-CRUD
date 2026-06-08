<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/../controladores/publicacionesControlador.php';
require_once __DIR__ . '/../includes/cabecera.php';

$mensaje = "";

// =========================
// SUBIR PUBLICACIÓN
// =========================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = $_POST['titulo'] ?? '';
    $contenido = $_POST['contenido'] ?? '';
    $precio = $_POST['precio'] ?? 0;
    $categoria = $_POST['categoria'] ?? '';
    $condicion = $_POST['condicion_producto'] ?? 'Usado';

    $usuario_id = $_SESSION['usuario']['id'];

    // =========================
    // IMÁGENES
    // =========================
    $imagenes = [];

    if (!empty($_FILES['imagenes']['name'][0])) {

        $total = count($_FILES['imagenes']['name']);

        for ($i = 0; $i < $total; $i++) {

            $nombre = uniqid() . "_" . $_FILES['imagenes']['name'][$i];
            $tmp = $_FILES['imagenes']['tmp_name'][$i];

            $ruta = "../uploads/" . $nombre;

            if (move_uploaded_file($tmp, $ruta)) {
                $imagenes[] = $nombre;
            }
        }
    }

    // =========================
    // CREAR PUBLICACIÓN
    // =========================
    PublicacionesControlador::crear(
        $titulo,
        $contenido,
        $precio,
        $categoria,
        $condicion,
        $usuario_id,
        $imagenes
    );

    header("Location: inicio.php?mensaje=publicado");
    exit;
}
?>

<div class="container">

    <h2>Nueva Publicación</h2>

    <form method="POST" enctype="multipart/form-data">

        <input type="text" name="titulo" placeholder="Título" required><br><br>

        <textarea name="contenido" placeholder="Descripción" required></textarea><br><br>

        <input type="number" name="precio" placeholder="Precio" required><br><br>

        <select name="categoria" required>
            <option value="Electrónica">Electrónica</option>
            <option value="Celulares">Celulares</option>
            <option value="Computadoras">Computadoras</option>
            <option value="Videojuegos">Videojuegos</option>
            <option value="Vehículos">Vehículos</option>
        </select><br><br>

        <select name="condicion_producto" required>
            <option value="Nuevo">Nuevo</option>
            <option value="Seminuevo">Seminuevo</option>
            <option value="Usado">Usado</option>
            <option value="Para piezas">Para piezas</option>
        </select><br><br>

        <input type="file" name="imagenes[]" multiple><br><br>

        <button type="submit">Publicar</button>

    </form>

</div>

<?php require_once __DIR__ . '/../includes/pie.php'; ?>