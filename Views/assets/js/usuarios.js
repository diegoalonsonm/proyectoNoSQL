$(document).ready(function () {
    $('#tbllistado').DataTable({
        "ajax": "getUsuarios.php", 
        "dataSrc": "data", // URL correcta para obtener los datos
        "columns": [
            { "data": "Id" },
            { "data": "Nombre" },
            { "data": "Email" },
            { "data": "Telefono" },
            { "data": "Fecha Registro" },
            { "data": "Rol" },
            { "data": "Estado" },
            {
                "data": null,
                "render": function (data, type, row) {
                    // Renderizar botones de "Editar" y "Eliminar"
                    return `
                        <button class="btn btn-primary btn-sm" onclick="editarUsuario('${data.Id}')">Editar</button>
                        <button class="btn btn-danger btn-sm" onclick="eliminarUsuario('${data.Id}')">Eliminar</button>
                    `;
                }
            }
        ]
    });
});


