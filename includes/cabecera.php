<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../controladores/mensajesControlador.php';

$usuario_id = $_SESSION['usuario']['id'] ?? null;

$conversaciones = [];
$no_leidos = 0;

if ($usuario_id) {
    $conversaciones = MensajesControlador::conversaciones($usuario_id);
    $no_leidos = MensajesControlador::noLeidos($usuario_id);
}
?>

<link rel="stylesheet" href="/blog/recursos/css/estilos.css">

<header class="topbar">

    <h1 class="logo">Tienda Hakkai</h1>

    <nav class="nav">

        <a href="inicio.php">Inicio</a>

        <?php if ($usuario_id): ?>

            <a href="panel_usuario.php">Mi Panel</a>
            <a href="nueva_publicacion.php">Nueva Publicación</a>
            <a href="../publico/logout.php">Salir</a>

            <div class="notif-wrapper">

                <button id="notifBtn" class="notif-btn">
                    <span class="notif-icon"></span>

                    <?php if ($no_leidos > 0): ?>
                        <span class="notif-count"><?php echo $no_leidos; ?></span>
                    <?php endif; ?>
                </button>

                <div id="notifMenu" class="notif-menu">

                    <div class="notif-title">Notificaciones</div>

                    <?php if (!empty($conversaciones)): ?>

                        <?php foreach (array_slice($conversaciones, 0, 8) as $c): ?>
                            <a class="notif-item notif-click"
                               href="panel_usuario.php?chat=<?php echo $c['id']; ?>">
                                💬 <?php echo htmlspecialchars($c['titulo']); ?>
                            </a>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <div class="notif-empty">Sin notificaciones</div>
                    <?php endif; ?>

                </div>

            </div>

        <?php else: ?>

            <a href="login.php">Login</a>
            <a href="registro.php">Registro</a>

        <?php endif; ?>

    </nav>

</header>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const btn = document.getElementById("notifBtn");
    const menu = document.getElementById("notifMenu");

    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        menu.classList.toggle("show");
    });

    document.addEventListener("click", () => {
        menu.classList.remove("show");
    });

    document.querySelectorAll(".notif-click").forEach(el => {
        el.addEventListener("click", function () {
            this.style.display = "none";
        });
    });

});
</script>