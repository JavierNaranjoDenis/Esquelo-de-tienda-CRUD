<?php
require_once __DIR__ . '/../modelos/NotificacionesModelo.php';

class NotificacionesControlador {

    // Obtener todas las notificaciones del usuario (ordenadas por fecha)
    public static function obtenerPorUsuario($usuario_id) {
        return NotificacionesModelo::obtenerPorUsuario($usuario_id);
    }

    // Marcar una notificación como leída
    public static function marcarComoLeida($id) {
        return NotificacionesModelo::marcarComoLeido($id);
    }

    // Contar notificaciones no leídas
    public static function contarNoLeidas($usuario_id) {
        $notificaciones = self::obtenerPorUsuario($usuario_id);
        $contador = 0;
        foreach ($notificaciones as $notif) {
            if (!$notif['leido']) {
                $contador++;
            }
        }
        return $contador;
    }
}
?>
