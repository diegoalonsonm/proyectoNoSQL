<?php
session_start();

if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
} else {
    header('Location: login.php');
    exit;
}

require __DIR__ . '/../vendor/autoload.php';  
$cliente = new MongoDB\Client("mongodb://localhost:27017");
$db = $cliente->ProyectoNoSQL;

function obtenerReservasDelUsuario($usuario_id) {
    global $db;
    $coleccionReservas = $db->Reservas;
    
    return $coleccionReservas->find(['usuario_id' => (int)$usuario_id])->toArray();
}

function obtenerVentasUsuario($usuario_id){
    global $db;
    $coleccionVentas = $db->Ventas;

    return $coleccionVentas->find(['usuario_id' =>$usuario_id])->toArray();
}

function obtenerNombreProducto($producto_id) {
    global $db;
    $coleccionProductos = $db->ProductosVenta;
    $producto = $coleccionProductos->findOne(['_id' => new MongoDB\BSON\ObjectId($producto_id)]);
    return $producto ? $producto->nombre : 'Producto no encontrado';
}

$reservas = obtenerReservasDelUsuario($usuario['id']);
$ventas = obtenerVentasUsuario($usuario['id']);
?>

<?php include('plantilla.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-dt/css/jquery.dataTables.min.css">
    <style>
        .perfil-container {
            width: 80%;
            margin: 0 auto;
            margin-top: 40PX;
            padding: 20px;
            text-align: center;
            background-color: rgba(51, 51, 51, 0.8);
            border: 1px solid #ddd;
            border-radius: 10px;
            color: white;
        }

        .dataTable {
            width: 100%;
            margin-top: 20px;
            color: black;
            background-color: #d2d2d2;
        }

        table.dataTable thead {
            background-color: rgba(51, 51, 51, 0.8);
            color: white;
        }

        h2, h3 {
            color: white;
        }
    </style>
</head>
<body >
    <div class="perfil-container">
        <h2>Bienvenido, <?php echo htmlspecialchars($usuario['nombre']); ?></h2>

        <h3>Información de contacto</h3>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario['nombre']); ?></p>
        <p><strong>Correo electrónico:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
        <p><strong>Teléfono:</strong> <?php echo isset($usuario['telefono']) ? htmlspecialchars($usuario['telefono']) : 'No disponible'; ?></p>

        <h3>Historial de Reservas</h3>
        <table id="reservasTable" class="dataTable">
            <thead>
                <tr>
                    <th>Cancha</th>
                    <th>Fecha</th>
                    <th>Hora de Inicio</th>
                    <th>Hora de Fin</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (empty($reservas)) {
                    echo "<tr><td colspan='4'>No tienes reservas.</td></tr>";
                } else {
                    foreach ($reservas as $reserva) {
                        $fechaFormateada = ($reserva['fecha']) ? $reserva['fecha']->toDateTime()->format('d-m-Y') : 'No disponible';
                        echo "<tr class='table-light'>
                            <td>" . htmlspecialchars($reserva['cancha_id']) . "</td>
                            <td>" . htmlspecialchars($fechaFormateada) . "</td>
                            <td>" . htmlspecialchars($reserva['hora_inicio']) . "</td>
                            <td>" . htmlspecialchars($reserva['hora_fin']) . "</td>
                        </tr>";
                    }
                }
                ?>
            </tbody>
        </table>

        <div class="mt-3">
            <h3>Historial de Compras</h3>
            <table id="comprasTable" class="display dataTable">
                <thead >
                <tr>
                    <th># Orden</th>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Hora de Fin</th>
                    <th>Precio Total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (empty($ventas)) {
                    echo "<tr><td colspan='5'>No tienes compras.</td></tr>";
                } else {
                    foreach ($ventas as $venta) {
                        //$fechaFormateada = ($venta['fecha']) ? $venta['fecha']->toDateTime()->format('d-m-Y') : 'No disponible';
                        $nombreProducto = obtenerNombreProducto($venta['producto_id']);
                        echo "<tr class='table-light'>
                            <td>" . htmlspecialchars($venta['_id']) . "</td>
                            <td>" . htmlspecialchars($venta['fecha']) . "</td>
                            <td>" . htmlspecialchars($nombreProducto) . "</td>
                            <td>" . htmlspecialchars($venta['cantidad']) . "</td>
                            <td>" . htmlspecialchars($venta['total']) . "</td>
                        </tr>";
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#reservasTable').DataTable();
        });
    </script>
</body>
</html>
