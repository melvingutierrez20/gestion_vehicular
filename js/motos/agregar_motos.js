$(document).ready(function () {
    // Manejar el envío del formulario
    $('#addForm').on('submit', function (e) {
        e.preventDefault(); // Prevenir el comportamiento por defecto del formulario

        // Validar si los campos requeridos no están vacíos
        var placa = $('#placa').val().trim();
        var marca = $('#marca').val().trim();
        var modelo = $('#modelo').val().trim();
        var anio = $('#anio').val().trim();
        var tipo = $('#tipo').val().trim();
        var clase = $('#clase').val().trim();
        var numero_chasis = $('#numero_chasis').val().trim();
        var numero_motor = $('#numero_motor').val().trim();
        var propietario = $('#propietario').val().trim(); // Asume que este campo ya tiene la lógica de autocompletar

        if (!placa || !marca || !modelo || !anio || !tipo || !clase || !numero_chasis || !numero_motor || !propietario) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Todos los campos son obligatorios.'
            });
            return;
        }

        // Validar que el año sea un número válido
        if (isNaN(anio) || anio < 1900 || anio > new Date().getFullYear()) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El año debe ser válido y mayor a 1900.'
            });
            return;
        }

        // Serializar los datos del formulario
        var formData = $(this).serialize();

        // Enviar el formulario por AJAX
        $.ajax({
            url: '../controladores/process_motos.php',
            type: 'POST',
            data: formData,
            dataType: 'json', // Asegura que la respuesta se trate como JSON
            success: function (response) {
                if (response.status === 'success') {
                    // Mostrar mensaje de éxito
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Redirigir a la página principal después de cerrar el alert
                        window.location.href = '../vendor/almasaeed2010/adminlte/pages/Registros/motos.php';
                    });
                } else if (response.status === 'error') {
                    // Mostrar mensaje de error específico
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function () {
                // Mostrar mensaje de error en caso de fallo en la solicitud AJAX
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al procesar los datos. Por favor, intenta de nuevo.'
                });
            }
        });
    });
});
