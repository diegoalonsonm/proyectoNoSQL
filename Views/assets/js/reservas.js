$(document).ready(() => {
    $('#tablaReservas').DataTable({
        "columns": [
            { "data": "Id" },
            { "data": "Nombre" },
            { "data": "Correo" },
            { "data": "Telefono" },
            { "data": "Cancha" },
            { "data": "Fecha" },
            { "data": "Hora Inicio" },
            { "data": "Hora Fin" },
            { "data": "Chalecos" },
            { "data": "Hidratacion" },
            { "data": "Monto Total" },
            {
                "data": null,
                "render": function (data, type, row) {
                    return `
                        <button class="btn btn-primary btn-sm" onclick="editarReserva('${data.Id}')">Editar</button>
                        <button class="btn btn-danger btn-sm" onclick="eliminarReserva('${data.Id}')">Eliminar</button>
                    `;
                }
            }
        ]
    })
})

$.ajax({
    url: 'listar_Reservas.php',
    method: "GET",
    dataType: 'json',
    success: (data) => {
        console.log(data)
        $('#tablaReservas').DataTable({
            data: data,
            "columns": [
                { "data": "Id" },
                { "data": "Nombre" },
                { "data": "Correo" },
                { "data": "Telefono" },
                { "data": "Cancha" },
                { "data": "Fecha" },
                { "data": "Hora Inicio" },
                { "data": "Hora Fin" },
                { "data": "Chalecos" },
                { "data": "Hidratacion" },
                { "data": "Monto Total" },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return `
                        <button class="btn btn-primary btn-sm" onclick="editarReserva('${data.Id}')">Editar</button>
                        <button class="btn btn-danger btn-sm" onclick="eliminarReserva('${data.Id}')">Eliminar</button>
                    `;
                    }
                }
            ]
        })
    },
    error: (error) => {
        console.log(error)
    }
})