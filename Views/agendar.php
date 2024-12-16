<?php
require __DIR__ . '/../vendor/autoload.php'; // Asegúrate de que MongoDB esté en tu proyecto
use MongoDB\Client;

session_start();

// Verificar autenticación del usuario
if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario']['id']; // Asegúrate de que el ID del usuario esté disponible

// Establecer conexión con MongoDB
$cliente = new Client("mongodb://localhost:27017");
$db = $cliente->ProyectoNoSQL;
$coleccionReservas = $db->Reservas;
$coleccionChalecos = $db->Chalecos;
$coleccionHidratacion = $db->Hidratacion;

// Obtener chalecos e hidratación disponibles
$chalecos = $coleccionChalecos->find(['disponible' => true])->toArray();
$hidratacion = $coleccionHidratacion->find(['disponible' => true])->toArray();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validación de datos del formulario
    $cancha_id = filter_input(INPUT_POST, 'cancha_id', FILTER_SANITIZE_STRING);
    $fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_STRING);
    $hora_inicio = filter_input(INPUT_POST, 'hora_inicio', FILTER_SANITIZE_STRING);
    $hora_fin = filter_input(INPUT_POST, 'hora_fin', FILTER_SANITIZE_STRING);
    $chaleco_id = filter_input(INPUT_POST, 'chalecos', FILTER_SANITIZE_STRING);
    $hidratacion_id = filter_input(INPUT_POST, 'hidratacion', FILTER_SANITIZE_STRING);
    $precio = filter_input(INPUT_POST, 'cancha_precio', FILTER_VALIDATE_FLOAT); // Asegúrate de recibir el precio correctamente

    if (!$cancha_id || !$fecha || !$hora_inicio || !$hora_fin || !$precio) {
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos obligatorios']);
        exit;
    }

    // Crear la reserva
    $reserva = [
        'usuario_id' => (int)$usuario_id,
        'cancha_id' => $cancha_id,
        'fecha' => new MongoDB\BSON\UTCDateTime(strtotime($fecha) * 1000), // Convierte a fecha de MongoDB
        'hora_inicio' => $hora_inicio,
        'hora_fin' => $hora_fin,
        'chaleco_id' => $chaleco_id,
        'hidratacion_id' => $hidratacion_id,
        'monto_total' => (float)$precio,
    ];

    // Insertar reserva en MongoDB
    $resultado = $coleccionReservas->insertOne($reserva);

    // Verificar si la inserción fue exitosa
    header('Content-Type: application/json');
    echo json_encode([ 
        'status' => 'success', 
        'message' => 'Reserva realizada con éxito', 
        'reserva_id' => (string)$resultado->getInsertedId()
    ]);
    
    } 

?>
<?php include('plantilla.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Selecciona una cancha</h2>

        <div class="row mt-4">
            <!-- Cancha 1 -->
            <div class="col-md-4 text-center">
                <div class="card" style="background-color: black;" data-cancha-id="1" data-cancha-nombre="Cancha 1" data-cancha-tipo="Fut 5 - Sintética" data-cancha-precio="20000" data-cancha-hora-inicio="09:00" data-cancha-hora-fin="11:00">
                    <img src="https://i.pinimg.com/736x/23/c7/2e/23c72ef928463b817d90df7d27c392aa.jpg" class="card-img-top" alt="Cancha 1" style="height:350px">
                    <div class="card-body" style="background-color: black; color: White">
                        <h5 class="card-title" style="background-color: black;">Cancha 1</h5>
                        <p class="card-text">Fut 5 - Sintética</p>
                        <button class="btn btn-light text-dark reservar-btn">Reservar</button>
                    </div>
                </div>
            </div>
            <!-- Cancha 2 -->
            <div class="col-md-4 text-center">
                <div class="card" style= "background-color: black;" data-cancha-id="2" data-cancha-nombre="Cancha 2" data-cancha-tipo="Fut 5 - Sintética" data-cancha-precio="20000" data-cancha-hora-inicio="9:00" data-cancha-hora-fin="11:00">
                    <img src="https://i.pinimg.com/736x/97/65/ca/9765ca932641b02242b78a55f8eeb515.jpg" class="card-img-top" alt="Cancha 2" style="height:350px">
                    <div class="card-body" style= "background-color: black; color: White">
                        <h5 class="card-title" style= "background-color: black;">Cancha 2</h5>
                        <p class="card-text">Fut 5 - Sintética</p>
                        <button class="btn btn-light text-dark reservar-btn">Reservar</button>
                    </div>
                </div>
            </div>
            <!-- Cancha 3 -->
            <div class="col-md-4 text-center">
                <div class="card" style= "background-color: black;" data-cancha-id="3" data-cancha-nombre="Cancha 3" data-cancha-tipo="Fut 7 - Natural" data-cancha-precio="25000" data-cancha-hora-inicio="9:00" data-cancha-hora-fin="11:00">
                    <img src="https://i.pinimg.com/736x/e3/1a/6a/e31a6a2ee5de9f2423b66883b48e1602.jpg" class="card-img-top" alt="Cancha 3" style="height:350px">
                    <div class="card-body" style= "background-color: black; color: White">
                        <h5 class="card-title" style= "background-color: black;">Cancha 3</h5>
                        <p class="card-text">Fut 7 - Natural</p>
                        <button class="btn btn-light text-dark reservar-btn">Reservar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario de Reserva -->
    <div id="form-container" class="mt-5" style="display:none; background-color: rgba(0, 0, 0, 0.8); color: white; border-radius: 20px;">
        <br><br>
        <h2 class="text-center">Reservar <span id="cancha-nombre"></span></h2>
        <form id="reservationForm" class="mt-4">
            <input type="hidden" id="cancha-id" name="cancha_id">
            <input type="hidden" id="cancha-precio" name="cancha_precio">

            <!-- Fecha -->
            <div class="mb-3 text-center">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" id="fecha" name="fecha" class="form-control" required style="width: 300px; margin: 0 auto;">
            </div>

            <!-- Hora de Inicio y Hora de Fin -->
            <div class="row text-center" style="display: flex; justify-content: center; gap: 10px;">
    <div class="col-md-4" style="padding: 0;">
        <label for="hora_inicio" class="form-label">Hora de Inicio</label>
        <select id="hora_inicio" name="hora_inicio" class="form-control" required style="width: 300px; margin: 0 auto;">
            <!-- Las opciones se generarán dinámicamente -->
        </select>
    </div>
    <div class="col-md-4" style="padding: 0;">
        <label for="hora_fin" class="form-label">Hora de Fin</label>
        <input type="text" id="hora_fin" name="hora_fin" class="form-control" readonly style="width: 300px; margin: 0 auto;">
    </div>
</div>


            <!-- Chalecos -->
            <div class="mb-4 text-center">
                <label for="chalecos" class="form-label">Chalecos</label>
                <select id="chalecos" name="chalecos" class="form-control" required style="width: 300px; margin: 0 auto;">
                    <option value="0" data-costo="0">Seleccione un chaleco</option>  
                    <?php foreach ($chalecos as $chaleco) { ?>
                        <option value="<?php echo $chaleco->_id; ?>" data-costo="<?php echo $chaleco->costo_adquisicion; ?>">
                            <?php echo $chaleco->color . " " . $chaleco->cantidad . " disponibles"; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <!-- Hidratación -->
            <div class="mb-4 text-center">
                <label for="hidratacion" class="form-label">Hidratación</label>
                <select id="hidratacion" name="hidratacion" class="form-control" required style="width: 300px; margin: 0 auto;">
                    <option value="0" data-costo="0">Seleccione una hidratación</option>  
                    <?php foreach ($hidratacion as $item) { ?>
                        <option value="<?php echo $item->_id; ?>" data-costo="<?php echo $item->costo_adquisicion; ?>">
                            <?php echo $item->nombre . "  ₡" . number_format($item->costo_adquisicion, 0, ".", "."); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <!-- Precio Total -->
            <div class="mb-3 text-center">
                <label for="precio_total" class="form-label">Precio Total</label>
                <input type="text" id="precio_total" class="form-control" readonly style="width: 300px; margin: 0 auto;">
            </div>
            <input type="hidden" id="usuario-id" name="usuario_id" value="<?php echo $usuario_id; ?>">

            <div class="text-center">
                <button type="submit" class="btn btn-light">Confirmar Reserva</button>
            </div>
        </form>
    </div>
<br><br><br><br>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        $(document).ready(function() {
            AOS.init();
            
            $('.reservar-btn').on('click', function() {
                var card = $(this).closest('.card');
                var canchaId = card.data('cancha-id');
                var canchaNombre = card.data('cancha-nombre');
                var canchaPrecio = card.data('cancha-precio');
                var horaInicio = card.data('cancha-hora-inicio');
                var horaFin = card.data('cancha-hora-fin');

                $('#form-container').show();
                $('#cancha-id').val(canchaId);
                $('#cancha-nombre').text(canchaNombre);
                $('#cancha-precio').val(canchaPrecio);
                
            });
            // Update price when chaleco or hidratacion changes
            $('#chalecos, #hidratacion').on('change', function() {
                var precioCancha = parseFloat($('#cancha-precio').val());
                var chalecoCosto = parseFloat($('#chalecos option:selected').data('costo'));
                var hidratacionCosto = parseFloat($('#hidratacion option:selected').data('costo'));

                var precioTotal = precioCancha + chalecoCosto + hidratacionCosto;
                $('#precio_total').val('₡ ' + precioTotal.toLocaleString());
            });
            if (!fecha || !hora_inicio || !hora_fin) {
            Swal.fire('Por favor, complete todos los campos.');
            return;
        }
        });

    </script>
  <script src="assets/js/agendar.js"></script>
</body>
</html>
