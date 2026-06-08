<?php

try {
    $pdo = new PDO(
        "mysql:host=127.0.0.1;port=3306;dbname=blog_bd;charset=utf8",
        "root",
        ""
    );

    echo "CONEXIÓN EXITOSA";

} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}