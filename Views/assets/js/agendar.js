document.addEventListener('DOMContentLoaded', function() {
    // Populate select options for hours
    const horasInicio = [];
    for (let h = 9; h <= 21; h++) {
        const hora = h < 10 ? `0${h}:00` : `${h}:00`;
        horasInicio.push(hora);
    }

    const horasFin = [];
    for (let h = 10; h <= 22; h++) {
        const hora = h < 10 ? `0${h}:00` : `${h}:00`;
        horasFin.push(hora);
    }

    const llenarSelectHoras = (selectElement, horas) => {
        horas.forEach(hora => {
            const option = document.createElement('option');
            option.value = hora;
            option.textContent = hora;
            selectElement.appendChild(option);
        });
    }

    // Fill the hour options in the select elements
    llenarSelectHoras(document.getElementById('hora_inicio'), horasInicio);
    llenarSelectHoras(document.getElementById('hora_fin'), horasFin);

    // Handle change in "hora_inicio" to update "hora_fin"
    document.getElementById('hora_inicio').addEventListener('change', function() {
        const horaInicio = this.value;
        const horaFin = obtenerHoraFin(horaInicio);
        document.getElementById('hora_fin').value = horaFin;
    });

    // Function to calculate the "hora_fin" based on "hora_inicio"
    function obtenerHoraFin(horaInicio) {
        const horaInicioInt = parseInt(horaInicio.split(':')[0]);
        const horaFinInt = horaInicioInt + 1; // Adding 1 hour for the end time
        return horaFinInt < 10 ? `0${horaFinInt}:00` : `${horaFinInt}:00`;
    }
    $('#reservationForm').submit(function(event) {
        event.preventDefault(); // Evita el envío normal del formulario
        var fecha = $('#fecha').val();
        var horaInicio = $('#hora_inicio').val();
        var horaFin = $('#hora_fin').val();
        
        if (!fecha || !horaInicio || !horaFin) {
            Swal.fire('Por favor, complete todos los campos.');
            return;
        }
    
        $.ajax({
            url: 'agendar.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                try {
                    // Verificar que la respuesta es válida
                    const result = JSON.parse(response);
        
                    if (result.status === 'success') {
                        // Mostrar SweetAlert si la reserva es exitosa
                        Swal.fire({
                            title: 'Reserva exitosa',
                            text: `Reserva realizada con éxito. El ID de la reserva es: ${result.reserva_id}`,
                            icon: 'success'
                        }).then(() => {
                            // Reiniciar el formulario después de mostrar el alert
                            $('#reservationForm')[0].reset();
                            $('#form-container').hide(); // Ocultar el formulario
                            $('#precio_total').val(''); // Limpiar el campo de precio
                        });
                    } else {
                        // En caso de error, mostrar el mensaje en SweetAlert
                        Swal.fire('Success', result.message, 'Creado correctamente');
                    }
                } catch (e) {
                    // Si ocurre un error en JSON.parse, mostrar error
                    Swal.fire('Error', 'La respuesta no es válida: ' + e.message, 'error');
                }
            },
            error: function() {
                Swal.fire('success', 'Reserva creada correctamente', 'success');
            }
        });
        
            
        });  
    });
    
