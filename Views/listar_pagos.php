<?php
require __DIR__ . '/../vendor/autoload.php';

// Configurar encabezados para devolver JSON
header('Content-Type: application/json');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Conexión a MongoDB
try {
    $cliente = new MongoDB\Client("mongodb://localhost:27017");
    $db = $cliente->ProyectoNoSQL; // Cambia por el nombre de tu base de datos

    // Colecciones
    $coleccionPagos = $db->Pagos;
    $coleccionCanchas = $db->Canchas;
    $coleccionUsuarios = $db->Usuarios;

    // Consultar pagos
    $pagos = $coleccionPagos->find()->toArray();
    $resultado = [];

    foreach ($pagos as $pago) {
        $usuario = $coleccionUsuarios->findOne(['_id' => $pago['usuario_id']]);
        $cancha = $coleccionCanchas->findOne(['_id' => $pago['cancha_id']]);
        
        $resultado[] = [
            'nombre' => $usuario['nombre'] ?? 'Desconocido',
            'correo' => $usuario['email'] ?? 'Desconocido',
            'cancha' => $cancha['nombre'] ?? 'Desconocido',
            'fecha' => date('Y-m-d', strtotime($pago['fecha_pago'])),
            'hora' => date('H:i:s', strtotime($pago['fecha_pago'])),
            'monto_total' => $pago['monto_total'] ?? 0,
            'estado' => $pago['estado'] ?? 'Desconocido'
        ];
    }

    // Respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($resultado);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
