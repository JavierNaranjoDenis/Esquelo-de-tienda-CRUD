<?php
// app/controladores/HomeControlador.php

class HomeControlador {
    private $modeloArticulo;

    public function __construct() {
        $this->modeloArticulo = new Articulo();
    }

    public function index() {
        $articulos = $this->modeloArticulo->obtenerTodos();
        require_once __DIR__ . '/../vistas/home/index.php';
    }
}