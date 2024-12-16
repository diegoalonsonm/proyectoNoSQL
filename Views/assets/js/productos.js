// obtener productos
$.ajax({
    url: 'getProductosVenta.php',
    type: 'GET',
    data: {},
    contentType: false,
    processData: false,
    success: (datos) => {
        const container = document.getElementById('contenedor-ventas')

        let row

        datos.forEach((dato, index) => {
            if (index % 4 === 0) {
                row = document.createElement('div')
                row.className = 'row mb-4'
                container.appendChild(row)
            }

            const col = document.createElement('div')
            col.className = 'col-md-3'

            const card = `
                <div class="card" style="background-color: black;">
                    <img src="${dato.imagen}" class="card-img-top" alt="${dato.nombre}" style="height:200px">
                        <div class="card-body" style="background-color: black; color: White">
                            <h5 class="card-title">${dato.nombre}</h5>
                            <p class="card-text">₡${dato.precio}</p>
                            <a href="comprar.php" class="btn btn-light text-dark">Comprar</a>
                        </div>
                </div>
            `;

        col.innerHTML = card;
            row.appendChild(col)
        })
    },
    error: function (e) {
        console.log(e.responseText)
    },
})

// actualizar precio total
$('#selectProducto, #cantidad').on('change', () => {
    const precio = $('#selectProducto option:selected').data('precio')
    const cantidad = $('#cantidad').val()

    $('#total').val(precio * cantidad)
})

// hacer venta
$('#comprarForm').submit((e) => {
    e.preventDefault()

    const producto = $('#selectProducto').val()
    const cantidad = $('#cantidad').val()
    const total = $('#total').val()
    const usuario = $('#usuario_id').val()
    const fecha = new Date().toISOString().slice(0, 19).replace('T', ' ')

    $.ajax({
        url: 'procesarVenta.php',
        type: 'POST',
        data: {
            producto: producto,
            cantidad: cantidad,
            total: total,
            usuario: usuario,
            fecha: fecha
        },
        success: (response) => {
            Swal.fire('Venta procesada con éxito')
            $('#comprarForm')[0].reset()
            $('#total').val('')
        },
        error: (e) => {
            Swal.fire('Error al procesar la venta')
        }
    })
})

// mostrar en admin
$(document).ready(() => {
    $('#tbllistado').DataTable({
        ajax: {
            url: 'getProductosVenta.php',
            type: 'GET',
            dataSrc: ''
        },
        columns: [
            {data: 'nombre'},
            {data: 'descripcion'},
            {data: 'precio'},
            {
                data: 'imagen',
                render: (data) => {
                    return `<a href="${data}" target="_blank" class="text-white">Ver imagen</a>`
                }
            },
            {data: 'stock'},
            {data: 'categoria'},
            {data: 'marca'},
            {data: 'talla'},
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
    })
})