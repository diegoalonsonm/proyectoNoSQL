<?php
session_start();  // Inicia sesión para destruirla

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir al usuario al login o a la página principal
header("Location: index.php");  // O usa "login.php" si prefieres redirigir al login
exit();
?>
