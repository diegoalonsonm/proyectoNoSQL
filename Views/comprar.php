<?php
require __DIR__ . '/../vendor/autoload.php'; // Asegúrate de que MongoDB esté en tu proyecto
include('plantilla.php');
use MongoDB\Client;

//session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario']['id'];

$cliente = new Client("mongodb://localhost:27017");
$db = $cliente->ProyectoNoSQL;
$productosColeccion = $db->ProductosVenta;

$productos = $productosColeccion->find(['stock' => ['$gt' => 0]])->toArray();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Comprar</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col text-center">
                <h2>Comprar</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card p-5" style="background-color: rgba(0, 0, 0, 0.8); color: white; border-radius: 20px;"">
                    <form id="comprarForm">
                        <input type="hidden" id="usuario_id" value="<?php echo $usuario_id; ?>">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Producto</label>
                            <select name="selectProducto" id="selectProducto" class="form-control" required>
                                <option value="0" selected disabled>Selecciona un producto</option>
                                <?php foreach ($productos as $producto): ?>
                                    <option value="<?php echo $producto->_id; ?>" data-precio="<?php echo $producto->precio;?>">
                                        <?php echo $producto->nombre." (₡".$producto->precio.")"; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" min="1" class="form-control" id="cantidad" value="1" placeholder="1">
                        </div>
                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input type="number" min="1" class="form-control" id="total" value="" placeholder="Total a pagar" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Comprar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./assets/js/productos.js"></script>
</body>
</html>
