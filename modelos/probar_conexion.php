<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=blog_bd", "root", "");
    echo "Conexión exitosa";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
