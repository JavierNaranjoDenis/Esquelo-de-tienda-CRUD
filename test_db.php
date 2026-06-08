<?php
// Incluye tu archivo de conexión para asegurarnos que la ruta es correcta
require_once __DIR__ . '/modelos/conexion.php'; 

echo "Intentando conectar a la base de datos y verificar la tabla usuarios...<br>";

try {
    $db = Conexion::conectar();
    echo "¡Conexión a la base de datos exitosa!<br>";

    // Prepara y ejecuta una consulta para verificar la tabla 'usuarios'
    $sql = "SELECT id, nombre_usuario, correo FROM usuarios LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo "La tabla 'usuarios' existe y contiene datos. Primer usuario: " . htmlspecialchars($user['nombre_usuario']) . "<br>";
    } else {
        echo "La tabla 'usuarios' existe, pero no contiene datos.<br>";
    }

} catch (PDOException $e) {
    echo "Error fatal de la base de datos: " . $e->getMessage() . "<br>";
    echo "Código de error SQLSTATE: " . $e->getCode() . "<br>";
    echo "Asegúrate de que la base de datos 'cuentas_bd' exista y que la tabla 'usuarios' esté dentro de ella.<br>";
}
?>