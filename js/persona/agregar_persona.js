$(document).ready(function() {
    // Manejar el envío del formulario
    $('#addForm').on('submit', function(e) {
        e.preventDefault(); // Prevenir el comportamiento por defecto del formulario

        // Validar si se seleccionó un departamento
        var departamento = $('#departamento').val();
        if (departamento === "") {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Debe seleccionar un departamento.'
            });
            return;
        }

        // Obtener la fecha de nacimiento del formulario
        var fechaNacimiento = new Date($('#fecha_nacimiento').val());
        var hoy = new Date();
        var edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
        var mes = hoy.getMonth() - fechaNacimiento.getMonth();

        // Ajustar si aún no ha sido el cumpleaños este año
        if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
            edad--;
        }

        // Validar si la edad es menor a 18 años
        if (edad < 18) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La persona debe ser mayor de 18 años.'
            });
            return;
        }

        // Serializar los datos del formulario
        var formData = $(this).serialize();

        // Enviar el formulario por AJAX
        $.ajax({
            url: '../controladores/process_personas.php',
            type: 'POST',
            data: formData,
            dataType: 'json',  // Asegura que la respuesta se trate como JSON
            success: function(response) {
                if (response.status === 'success') {
                    // Mostrar mensaje de éxito
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Redirigir a la página principal después de cerrar el alert
                        window.location.href = '../vendor/almasaeed2010/adminlte/pages/Registros/persona.php';
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
            error: function() {
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






