<?php
require __DIR__ . '/../vendor/autoload.php';
use MongoDB\Client;

session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario']['id'];

$cliente = new Client("mongodb://localhost:27017");
$db = $cliente->ProyectoNoSQL;
$ventasColeccion = $db->Ventas;
$productosColeccion = $db->ProductosVenta;

$producto = $_POST['producto'];
$cantidad = $_POST['cantidad'];
$total = $_POST['total'];
$usuario = $_POST['usuario'];
$fecha = $_POST['fecha'];

$venta = [
    'producto_id' => $producto,
    'cantidad' => $cantidad,
    'total' => $total,
    'usuario_id' => $usuario,
    'fecha' => $fecha
];

$result = $ventasColeccion->insertOne($venta);

if ($result->getInsertedCount() === 1) {
    $producto = $productosColeccion->findOne(['_id' => new MongoDB\BSON\ObjectId($producto)]);
    if ($producto) {
        $nuevoStock = $producto->stock - $cantidad;
        $productosColeccion->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($producto)],
            ['$set' => ['stock' => $nuevoStock]]
        );
    }

    echo json_encode(['status' => 'success', 'message' => 'Venta procesada con éxito']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error al procesar la venta']);
}
?>