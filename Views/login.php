<?php
session_start(); // Inicia la sesión
require __DIR__ . '/../vendor/autoload.php';

// Verifica si el usuario está logueado, si es así, redirige al index
if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

// Si el formulario es enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    // Conectar a MongoDB
    $cliente = new MongoDB\Client("mongodb://localhost:27017");
    $db = $cliente->ProyectoNoSQL;  // Reemplaza con el nombre de tu base de datos
    $coleccion_usuarios = $db->Usuarios; // Reemplaza con el nombre de tu colección de usuarios
    $coleccion_roles = $db->Roles; // Reemplaza con el nombre de tu colección de roles

    // Buscar el usuario en la colección Usuarios por email
    $usuario = $coleccion_usuarios->findOne(['email' => $email]);
    $rol_usuario_db = $coleccion_roles->findOne(['id_rol' => $usuario['id_rol']]);

    if ($usuario) {
        // Depuración: Verifica que la contraseña almacenada es correcta
        var_dump($usuario['contrasena']); // Verifica el valor de la contraseña en la BD
        // Verificar la contraseña
        if (password_verify($contrasena, $usuario['contrasena'])) {
            // Si la contraseña es correcta, almacenar el usuario y rol en la sesión
            $_SESSION['usuario'] = [
                'id' => (string)$usuario['_id'],
                'nombre' => $usuario['nombre'],
                'email' => $usuario['email'],
                'telefono' => $usuario['telefono'],
                'id_rol' => $rol_usuario_db['id_rol'] // Aquí guardas el rol
            ];
            header("Location: index.php");  // Redirigir a la página principal
            exit();
        } else {
            // Si la contraseña es incorrecta
            var_dump(password_verify($contrasena, $usuario['contrasena'])); // Verifica el resultado
            $error = "Contraseña incorrecta.";
        }
    } else {
        // Si el usuario no está registrado
        $error = "El usuario no está registrado.";
    }
    
}

?>
<?php include('plantilla.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="./assets/css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

</head>
<body>
    <div class="container" style="margin-top: 100px; margin-bottom: 50px; width:600px; height:400px; background-color: rgba(0, 0, 0, 0.4); color: white;">
        <h2>Iniciar sesión</h2>
        <form class="form-centered text-center" id="loginForm" action="login.php" method="post">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" required style="width: 300px; margin: 0 auto;" autocomplete="email"><br>

            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" required style="width: 300px; margin: 0 auto;" autocomplete="current-password"><br>

            <button type="submit" class="boton btn btn-success">Iniciar sesión</button>
        </form>

        <div id="response" class="mt-3"></div>
        <p>¿No tienes cuenta? <a href="./Registrarse.php">Regístrate aquí</a>.</p>
    </div>
    <br>
</body>

    <!-- Asegúrate de cargar SweetAlert2 antes de utilizarlo -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Carga de Bootstrap al final -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- El código para mostrar el error -->
    <?php if (isset($error)): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: '<?php echo $error; ?>',
                showConfirmButton: true
            });
        </script>
    <?php endif; ?>
</body>
</html>
