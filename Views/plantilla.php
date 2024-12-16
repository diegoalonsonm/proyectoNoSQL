<?php
require __DIR__ . '/../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$usuario_logueado = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;
$id_rol = $usuario_logueado['id_rol'] ?? null; 

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Sitio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body style="background-image: url('https://images5.alphacoders.com/107/thumb-1920-1075025.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg body-tertiary" style="align-content:center; height:100px; background-color: rgba(0, 0, 0, 0.8);">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-left:350px;">

        <li class="nav-item mb-10" style="position: absolute; left: 0; margin-left: 10px;">
    <a class="nav-link active" aria-current="page" href="index.php">
        <p style="text-align: left; font-size: 45px; color: white;">FUT 5<img src="https://media.contentapi.ea.com/content/dam/ea/fifa/fifa-21/ultimate-team/features/images/2020/10/fut21-hero-medium-fut-champions-7x2-xl.png.adapt.crop16x9.767w.png" alt="Logo" style="width: 150px; height: auto; margin-bottom: 20px; margin-right: 20px">
        </p>
        </a>
</li>


        <ul class="navbar-nav m-auto mb-2 mb-lg-0" style="align-content:center;">
                <?php if ($id_rol == 1): ?>
                    <li class="nav-item m-4">
                        <a class="nav-link active" style="margin-right:10px;" aria-current="page" href="index.php">
                            <p style="text-align:center; font-size:25px; color:white">Menu</p>
                        </a>
                    </li>
                    <!--<li class="nav-item m-4">
                        <a class="nav-link active" style="margin-right:10px;" aria-current="page" href="agendar.php">
                            <p style="text-align:center; font-size:25px; color:white;">Agendar</p>
                        </a>
                    </li>
                    <li class="nav-item m-4">
                        <a class="nav-link active" style="margin-right:10px;" aria-current="page" href="perfil.php">
                            <p style="text-align:center; font-size:25px; color:white">Perfil</p>
                        </a>
                    </li>-->
                    <li class="nav-item m-4">
                        <a class="nav-link active" style="margin-right:10px;" aria-current="page" href="pagosADM.php">
                            <p style="text-align:center; font-size:25px; color:white">Pagos</p>
                        </a>
                    </li>
                    <li class="nav-item m-4">
                        <a class="nav-link active" style="margin-right:10px;" aria-current="page" href="reservasADM.php">
                            <p style="text-align:center; font-size:25px; color:white">Reservas</p>
                        </a>
                    </li>
                    <li class="nav-item m-4">
                        <a class="nav-link active" style="margin-right:10px;" aria-current="page" href="usuariosADM.php">
                            <p style="text-align:center; font-size:25px; color:white">Usuarios</p>
                        </a>
                    </li>
                    <li class="nav-item m-4">
                        <a class="nav-link active" style="margin-right:10px;" aria-current="page" href="productosADM.php">
                            <p style="text-align:center; font-size:25px; color:white">Productos</p>
                        </a>
                    </li>
                <?php elseif ($id_rol == 2): ?>
                    <li class="nav-item m-4">
                        <a class="nav-link active" style="margin-right:10px;" aria-current="page" href="index.php">
                            <p style="text-align:center; font-size:25px; color:white">Menu</p>
                        </a>
                    </li>
                    <li class="nav-item m-4">
                        <a class="nav-link active" style="margin-right:10px;" aria-current="page" href="agendar.php">
                            <p style="text-align:center; font-size:25px; color:white;">Agendar</p>
                        </a>
                    </li>
                    <li class="nav-item m-4">
                        <a class="nav-link active" style="margin-right:10px;" aria-current="page" href="perfil.php">
                            <p style="text-align:center; font-size:25px; color:white">Perfil</p>
                        </a>
                    </li>
                    <li class="nav-item m-4">
                        <a class="nav-link active" style="margin-right:10px;" aria-current="page" href="ventas.php">
                            <p style="text-align:center; font-size:25px; color:white">Productos</p>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav ms-auto mb-lg-0">
                <?php if ($usuario_logueado): ?>
                    <li class="nav-item m-2">
                        <a class="nav-link active" href="perfil.php" style="color:white;">Hola, <?php echo $usuario_logueado['nombre']; ?>! Bienvenido</a>
                    </li>
                    <li class="nav-item m-2">
                        <a class="nav-link active" href="cerrar_sesion.php" style="text-align:center; font-size:25px; color:white;">Cerrar sesión</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item m-2">
                        <a class="nav-link active" style="margin-right:0px;" aria-current="page" href="login.php">
                            <p style="text-align:center; font-size:25px; color:white">Login</p>
                        </a>
                    </li>
                    <li class="nav-item m-2">
                        <a class="nav-link active" style="margin-right:10px;" aria-current="page" href="registrarse.php">
                            <p style="text-align:center; font-size:25px; color:white">Registrarse</p>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Footer -->
<footer class="text-center text-white" style="background-color: rgba(0, 0, 0, 0.8); padding: 20px; position: fixed; bottom: 0; width: 100%; left: 0;">
    <p>© 2024 Fut5. Todos los derechos reservados.</p>
</footer>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="plugins/DataTables/datatables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/bootbox/bootbox.min.js"></script>
<script src="plugins/toastr/toastr.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
