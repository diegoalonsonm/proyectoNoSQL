$(document).ready(function () {
    $('#tbllistado').DataTable({
        ajax: {
            url: 'listar_pagos.php',
            type: 'GET',
            dataSrc: ''
        },
        columns: [
            { data: 'nombre' },
            { data: 'correo' },
            { data: 'cancha' },
            { data: 'fecha' },
            { data: 'hora' },
            { data: 'monto_total' },
            { data: 'estado' },
            {
                data: null,
                render: function (data, type, row) {
                    return `
                        <button class="btn btn-info btn-sm" onclick="verDetalles('${data.nombre}')">Detalles</button>
                    `;
                }
            }
        ],
        responsive: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
        }
    });
});

function verDetalles(nombre) {
    alert("Detalles de: " + nombre);
}