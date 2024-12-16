<?php
require __DIR__ . '/../vendor/autoload.php';

// Conectar a MongoDB
$cliente = new MongoDB\Client("mongodb://localhost:27017");
$db = $cliente->ProyectoNoSQL;  // Reemplaza con el nombre de tu base de datos
$coleccion_usuarios = $db->Usuarios; // Reemplaza con el nombre de tu colección de usuarios
$coleccion_contadores = $db->counters; // Colección de contadores

// Verifica si el formulario es enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['correo']; // Actualiza el campo de correo
    $telefono = $_POST['telefono']; // Nuevo campo para teléfono
    $contrasena = $_POST['contrasena'];

    // Obtener la fecha de registro automáticamente con la fecha y hora del sistema
    $fecha_registro = new MongoDB\BSON\UTCDateTime(); // Fecha y hora actual en formato UTCDateTime
    $id_rol = 2; // Cliente, valor por defecto 2 como int32
    $estado = 1; // Estado activo por defecto

    // Verificar si el correo ya está registrado
    $usuario_existente = $coleccion_usuarios->findOne(['email' => $email]);

    if ($usuario_existente) {
        // Si el correo ya existe, muestra un mensaje de error
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'El correo ya está registrado.',
                    showConfirmButton: true
                });
              </script>";
    } else {
        // Verifica si el documento con el ID de contador 'usuarios' existe
        $contador_documento = $coleccion_contadores->findOne(['_id' => 'usuarios']);
        
        if (!$contador_documento) {
            // Si no existe, crea el documento con el valor inicial de seq
            $coleccion_contadores->insertOne([
                '_id' => 'usuarios',
                'seq' => 0
            ]);
        }

        // Obtener el siguiente ID autoincremental de la colección 'counters'
        $counter = $coleccion_contadores->findOneAndUpdate(
            ['_id' => 'usuarios'], // Identificador único para el contador de usuarios
            ['$inc' => ['seq' => 1]], // Incrementar el contador
            ['returnDocument' => MongoDB\Operation\FindOneAndUpdate::RETURN_DOCUMENT_AFTER]
        );

        // Obtener el nuevo valor del contador (ID autoincremental)
        $nuevoId = $counter->seq;

        // Hashear la contraseña
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

        // Insertar el usuario con el ID autoincremental
        $coleccion_usuarios->insertOne([
            '_id' => $nuevoId,  // Usar el ID autoincremental
            'nombre' => $nombre,
            'email' => $email,
            'telefono' => $telefono,
            'contrasena' => $hashed_password,
            'fecha_registro' => $fecha_registro,
            'id_rol' => $id_rol,  // Guardar el rol como int32
            'estado' => $estado
        ]);

        echo "<script>
                window.onload = function() {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Registrado!',
                        text: 'Usuario registrado correctamente.',
                        showConfirmButton: true
                    }).then(function() {
                        window.location.href = 'login.php'; // Redirige a login
                    });
                };
              </script>";
    }
}
?>

<?php include('plantilla.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./assets/css/Registrarse.css">
    <link rel="stylesheet" href="./assets/css/plantillafooter.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
<br>
<br>
<br>
<br>
    <div class="container" style="margin-top: 20px; height: 740px; width: 800px; background-color: rgba(0, 0, 0, 0.4); color: white;">
        <h2>Registro</h2>
        <form name="usuario_add" id="usuario_add" method="POST" class="form-centered text-center">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required style="width: 300px; margin: 0 auto;"><br><br>

            <label for="correo">Correo electrónico:</label>
            <input type="email" id="correo" name="correo" required style="width: 300px; margin: 0 auto;"><br><br>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required style="width: 300px; margin: 0 auto;"><br><br>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required style="width: 300px; margin: 0 auto;"><br><br>

            <input type="hidden" id="estado" name="estado" value="1"> <!-- Estado activo por defecto -->
            <input type="hidden" id="fecha_registro" name="fecha_registro">
            <button type="submit" class="boton btn btn-success">Registrarse</button>
            <br><br>
        </form>
        <div id="response" class="mt-3"></div>
        <p>¿Ya tienes una cuenta? <a href="./login.php">Inicia sesión aquí</a>.</p>
    </div>
    <br><br><br>
</body>
<br><br><br>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script> 
<script src="https://unpkg.com/scrollreveal"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
