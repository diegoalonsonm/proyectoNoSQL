<?php
// Incluir el autoload de Composer
require __DIR__ . '/../vendor/autoload.php';

// Configurar encabezados para devolver JSON
header('Content-Type: application/json');

try {
    // Conectar a MongoDB
    $client = new MongoDB\Client;

    // Seleccionar la base de datos
    $ProyectoNoSQL = $client->ProyectoNoSQL;

    // Consulta con $lookup para unir usuarios y roles
    $pipeline = [
        [
            '$lookup' => [
                'from' => 'Roles',          // Nombre de la colección de roles
                'localField' => 'id_rol',  // Campo de unión en usuarios
                'foreignField' => 'id_rol',// Campo de unión en roles
                'as' => 'rol_info'         // Resultado se guardará aquí
            ]
        ],
        [
            '$unwind' => [               // Descomponer el arreglo de roles
                'path' => '$rol_info',
                'preserveNullAndEmptyArrays' => true
            ]
        ]
    ];

    // Ejecutar la agregación
    $Usuarios = $ProyectoNoSQL->Usuarios->aggregate($pipeline);

    // Transformar resultados a un formato compatible con DataTables
    $result = [];
    foreach ($Usuarios as $usuario) {
        $result[] = [
            'Id' => $usuario['_id'],                         // ID del usuario
            'Nombre' => $usuario['nombre'] ?? 'Sin Nombre',  // Nombre
            'Email' => $usuario['email'] ?? 'Sin Email',     // Email
            'Telefono' => $usuario['telefono'] ?? 'N/A',     // Teléfono
            'Fecha Registro' => $usuario['fecha_registro'] ?? 'N/A', // Fecha de registro
            'Rol' => $usuario['rol_info']['rol'] ?? 'Sin rol',       // Rol del usuario
            'Estado' => 'Activo' // Ejemplo: Puedes incluir lógica para determinar estado
        ];
    }

    // Enviar la respuesta en formato JSON
    echo json_encode(['data' => $result]);
} catch (Exception $e) {
    // Enviar un mensaje de error si algo falla
    echo json_encode(['error' => $e->getMessage()]);
}
?>
