<?php
// app/modelos/Database.php

class Database {
    private $host = DB_HOST;
    private $usuario = DB_USER;
    private $contrasena = DB_PASSWORD;
    private $nombre_base = DB_NAME;
    private $puerto = DB_PORT; // Añadir la propiedad para el puerto

    private $dbh; // Database Handler
    private $stmt; // Statement
    private $error;

    public function __construct(){
        // Configurar DSN (Data Source Name) para MySQL
        $dsn = 'mysql:host=' . $this->host . ';port=' . $this->puerto . ';dbname=' . $this->nombre_base;
        $opciones = array(
            PDO::ATTR_PERSISTENT => true, // Conexión persistente
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Manejo de errores de PDO
        );

        // Crear una instancia de PDO
        try {
            $this->dbh = new PDO($dsn, $this->usuario, $this->contrasena, $opciones);
            // Si la conexión es exitosa, puedes imprimir un mensaje (temporalmente)
            echo "<p style='color: green; font-weight: bold;'>¡Conexión a la base de datos exitosa!</p>";
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            // Si hay un error, imprímelo para depuración
            echo "<p style='color: red; font-weight: bold;'>Error de conexión a la base de datos: " . $this->error . "</p>";
            // Opcional: podrías loguear el error en un archivo en lugar de mostrarlo al usuario.
            // die("Error de conexión a la base de datos: " . $this->error);
        }
    }

    // Método para preparar la consulta
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Método para vincular parámetros
    public function bind($parametro, $valor, $tipo = null){
        if(is_null($tipo)){
            switch(true){
                case is_int($valor):
                    $tipo = PDO::PARAM_INT;
                    break;
                case is_bool($valor):
                    $tipo = PDO::PARAM_BOOL;
                    break;
                case is_null($valor):
                    $tipo = PDO::PARAM_NULL;
                    break;
                default:
                    $tipo = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($parametro, $valor, $tipo);
    }

    // Método para ejecutar la consulta preparada
    public function execute(){
        return $this->stmt->execute();
    }

    // Obtener los registros
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Obtener un solo registro
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Obtener el número de filas afectadas
    public function rowCount(){
        return $this->stmt->rowCount();
    }

    // Obtener el último ID insertado
    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }
}