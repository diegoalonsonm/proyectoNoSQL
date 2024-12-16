<?php
require __DIR__ . '/../vendor/autoload.php';

header('Content-Type: application/json');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    $cliente = new MongoDB\Client("mongodb://localhost:27017");
    $db = $cliente->ProyectoNoSQL;

    $coleccionReservas = $db->Reservas;
    $coleccionCanchas = $db->Canchas;
    $coleccionUsuarios = $db->Usuarios;
    $coleccionHidratacion = $db->Hidratacion;
    $coleccionChalecos = $db->Chalecos;

    $reservas = $coleccionReservas->find()->toArray();
    $resultado = [];

    foreach ($reservas as $reserva) {
        $usuario = $coleccionUsuarios->findOne(['_id' => $reserva['usuario_id']]);
        $cancha = $coleccionCanchas->findOne(['_id' => $reserva['cancha_id']]);
        $hidratacion = $reserva['hidratacion_id'] ? $coleccionHidratacion->findOne(['_id' => $reserva['hidratacion_id']]) : null;
        $chaleco = $reserva['chaleco_id'] ? $coleccionChalecos->findOne(['_id' => $reserva['chaleco_id']]) : null;

        // Convertir la fecha
        $fechaFormateada = null;
        if (isset($reserva['fecha']) && $reserva['fecha'] instanceof MongoDB\BSON\UTCDateTime) {
            $fechaFormateada = $reserva['fecha']->toDateTime()->format('d-m-Y');
        } else {
            $fechaFormateada = 'No disponible';
        }

        $resultado[] = [
            'Nombre' => $usuario['nombre'] ?? 'Desconocido',
            'Correo' => $usuario['email'] ?? 'Desconocido',
            'Telefono' => $usuario['telefono'] ?? 'Desconocido',
            'Cancha' => $cancha['nombre'],
            'Fecha' => $fechaFormateada,
            'Hora Inicio' => $reserva['hora_inicio'] ?? 'No disponible',
            'Hora Fin' => $reserva['hora_fin'] ?? 'No disponible',
            'Chalecos' => $chaleco ? $chaleco['color'] : 'No seleccionado',
            'Hidratacion' => $hidratacion ? $hidratacion['nombre'] : 'No seleccionado',
            'Monto Total' => $reserva['monto_total'] ?? 0,
            'Id' => (string) $reserva['_id']
        ];
    }

    echo json_encode($resultado);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
