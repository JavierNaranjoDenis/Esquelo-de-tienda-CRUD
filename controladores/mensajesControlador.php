<?php

require_once __DIR__ . '/../modelos/mensajesModelo.php';

class MensajesControlador {

    public static function conversaciones($usuario_id) {
        return MensajesModelo::conversacionesUsuario($usuario_id);
    }

    public static function mensajes($conversacion_id) {
        return MensajesModelo::mensajesPorConversacion($conversacion_id);
    }

    public static function enviar($conversacion_id, $emisor_id, $mensaje) {
        return MensajesModelo::enviarMensaje($conversacion_id, $emisor_id, $mensaje);
    }

    public static function abrir($publicacion_id, $comprador_id, $vendedor_id) {
        return MensajesModelo::abrirConversacion($publicacion_id, $comprador_id, $vendedor_id);
    }

    public static function noLeidos($usuario_id) {
        return MensajesModelo::contarNoLeidos($usuario_id);
    }

    public static function marcarLeidos($chat_id, $usuario_id) {
        return MensajesModelo::marcarLeidos($chat_id, $usuario_id);
    }
}