$('#usuario_add').on('submit', function (event) {
    event.preventDefault();
    $('#btnRegistar').prop('disabled', true);
    var formData = new FormData($('#usuario_add')[0]);

    $.ajax({
        url: '../controller/RegistrarseController.php?op=insertar',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            var data = JSON.parse(response);
            if (data.exito) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: data.msg
                }).then(() => {
                    $('#usuario_add')[0].reset();
                    tabla.ajax.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.msg
                });
            }
            $('#btnRegistar').removeAttr('disabled');
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al procesar el registro'
            });
            $('#btnRegistar').removeAttr('disabled');
        }
    });
});
