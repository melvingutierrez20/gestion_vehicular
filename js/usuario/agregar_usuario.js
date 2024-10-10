$(document).ready(function () {
    // Manejar el envío del formulario
    $('#addForm').on('submit', function (e) {
        e.preventDefault(); // Prevenir el comportamiento por defecto del formulario

        // Serializar los datos del formulario
        var formData = $(this).serialize();

        // Enviar el formulario por AJAX
        $.ajax({
            url: '../controladores/agregar_usuario.php', // Asegúrate de que la ruta sea correcta
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
                        // Redirigir a la lista de usuarios después de cerrar el alert
                        window.location.href = '../vendor/almasaeed2010/adminlte/pages/Registros/usuarios.php';
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
