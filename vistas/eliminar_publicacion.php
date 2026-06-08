<?php

session_start();

require_once "../controladores/publicacionesControlador.php";

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $id_publicacion = (int)$_GET['id'];

    $publicacion = PublicacionesControlador::obtener($id_publicacion);

    if (!$publicacion) {

        header("Location: panel_usuario.php?error=Publicacion+no+encontrada");
        exit;

    }

    if (
        $publicacion['usuario_id'] != $_SESSION['usuario']['id']
        && $_SESSION['usuario']['rol'] != 'admin'
    ) {

        header("Location: panel_usuario.php?error=No+tienes+permiso+para+eliminar+esta+publicacion");
        exit;

    }

    $resultado = PublicacionesControlador::eliminar($id_publicacion);

    if ($resultado) {

        header("Location: panel_usuario.php?mensaje=Publicacion+eliminada+correctamente");
        exit;

    } else {

        header("Location: panel_usuario.php?error=Error+al+eliminar+la+publicacion");
        exit;

    }

} else {

    header("Location: panel_usuario.php?error=ID+de+publicacion+invalido");
    exit;

}
?>