<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/../controladores/CarritoControlador.php';

$usuario_id = $_SESSION['usuario']['id'];
$items = CarritoControlador::obtenerCarrito($usuario_id);

require_once __DIR__ . '/../includes/cabecera.php';
?>

<div class="container">
    <h2>Mi Carrito</h2>

    <?php if (!empty($items)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Juego</th>
                    <th>Plataforma</th>
                    <th>Precio</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['id']); ?></td>
                        <td><?= htmlspecialchars($item['titulo']); ?></td>
                        <td><?= htmlspecialchars($item['juego']); ?></td>
                        <td><?= htmlspecialchars($item['plataforma']); ?></td>
                        <td>$<?= htmlspecialchars($item['precio']); ?></td>
                        <td><?= htmlspecialchars($item['fecha_publicacion']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No tienes cuentas en tu carrito aún.</p>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../includes/pie.php'; ?>
