$(document).ready(() => {
    const tablaReservas = $('#tablaReservas').DataTable({
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
            { "data": "Monto Total" }
        ]
    });

    $.ajax({
        url: 'listar_Reservas.php',
        method: "GET",
        dataType: 'json',
        success: (data) => {
            console.log(data);

            tablaReservas.clear();
            tablaReservas.rows.add(data).draw();
        },
        error: (error) => {
            console.error("Error al cargar los datos:", error);
        }
    });
});
