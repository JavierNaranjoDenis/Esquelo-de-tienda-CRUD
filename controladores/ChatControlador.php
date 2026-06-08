<?php

require_once __DIR__ . '/../modelos/ChatModelo.php';

class ChatControlador {

    public static function conversaciones($usuario_id) {
        return ChatModelo::conversacionesUsuario($usuario_id);
    }

    public static function mensajes($conversacion_id) {
        return ChatModelo::mensajes($conversacion_id);
    }

    public static function enviar($conversacion_id, $emisor_id, $mensaje) {
        return ChatModelo::enviar($conversacion_id, $emisor_id, $mensaje);
    }

    public static function abrir($publicacion_id, $comprador_id, $vendedor_id) {
        return ChatModelo::abrir($publicacion_id, $comprador_id, $vendedor_id);
    }
}