<?php
require __DIR__ . '/../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asegúrate de recibir el ID correctamente
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['_id'] ?? null;

    // Depuración
    if (!$id) {
        echo json_encode(['success' => false, 'message' => 'ID de reserva no proporcionado']);
        exit;
    }

    // Validar si el ID tiene el formato adecuado para MongoDB (12 caracteres hexadecimales)
    if (!preg_match('/^[0-9a-fA-F]{24}$/', $id)) {
        echo json_encode(['success' => false, 'message' => 'ID de reserva inválido']);
        exit;
    }

    try {
        $cliente = new MongoDB\Client("mongodb://localhost:27017");
        $db = $cliente->ProyectoNoSQL;
        $coleccionReservas = $db->Reservas;

        // Intentar eliminar la reserva con el ID proporcionado
        $result = $coleccionReservas->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);

        if ($result->getDeletedCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'Reserva eliminada con éxito']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se encontró la reserva para eliminar']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}
?>
