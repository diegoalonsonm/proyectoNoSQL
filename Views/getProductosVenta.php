<?php
require __DIR__ . '/../vendor/autoload.php';
header('Content-Type: application/json');

try {
    $cliente = new MongoDB\Client("mongodb://localhost:27017");
    $db = $cliente->ProyectoNoSQL;

    $coleccionProductos = $db->ProductosVenta;
    $productos = $coleccionProductos->find(['stock' => ['$gt' => 0]])->toArray();

    $resultado = [];

    foreach ($productos as $producto) {
        $resultado[] = [
            "nombre" => $producto['nombre'] ?? 'Desconocido',
            "descripcion" => $producto['descripcion'] ?? 'Desconocido',
            "precio" => $producto['precio'] ?? 0,
            "imagen" => $producto['url'] ?? 'Desconocido',
            "stock" => $producto['stock'] ?? 0,
            "categoria" => $producto['categoria'] ?? 'Desconocido',
            "marca" => $producto['marca'] ?? 'Desconocido',
            "talla" => $producto['talla'] ?? 'Desconocido',
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($resultado);
} catch (Exception $e) {
    // Enviar un mensaje de error si algo falla
    echo json_encode(['error' => $e->getMessage()]);
}