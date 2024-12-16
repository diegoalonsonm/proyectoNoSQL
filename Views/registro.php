<?php
session_start(); // Inicia la sesión
require __DIR__ . '/../vendor/autoload.php';

// Si el formulario es enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    // Conectar a MongoDB
    $cliente = new MongoDB\Client("mongodb://localhost:27017");
    $db = $cliente->ProyectoNoSQL;  // Reemplaza con el nombre de tu base de datos
    $coleccion_usuarios = $db->Usuarios; // Reemplaza con el nombre de tu colección de usuarios

    // Hashear la contraseña
    $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

    // Insertar usuario en la base de datos
    $coleccion_usuarios->insertOne([
        'nombre' => $nombre,
        'email' => $email,
        'contrasena' => $hashed_password,
    ]);

    echo "Usuario registrado correctamente.";
}
?>