$(document).ready(function () {
    $('#editForm').on('submit', function (e) {
        e.preventDefault(); // Prevenir comportamiento por defecto del formulario

        // Serializar los datos del formulario
        var formData = $(this).serialize();

        // Enviar los datos por AJAX
        $.ajax({
            url: '../controladores/edit_usuario.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    // Mostrar mensaje de éxito
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Redirigir a la lista de usuarios después de guardar
                        window.location.href = '../vendor/almasaeed2010/adminlte/pages/Registros/usuarios.php';
                    });
                } else if (response.status === 'info') {
                    // Si no se realizaron cambios
                    Swal.fire({
                        icon: 'info',
                        title: 'Sin cambios',
                        text: response.message
                    });
                } else if (response.status === 'error') {
                    // Mostrar mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al procesar los datos. Inténtalo de nuevo.'
                });
            }
        });
    });
});
