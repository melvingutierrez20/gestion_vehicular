$(document).ready(function() {
    // Al hacer clic en el botón de eliminar
    $('.deleteBtn').on('click', function() {
        var id = $(this).data('id'); // Obtener el ID desde el botón
        console.log("ID capturado:", id); // Verificar el ID capturado en la consola

        if (!id) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo obtener el ID para eliminar.'
            });
            return;
        }

        // Mostrar SweetAlert de confirmación
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esta acción",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, hacer la petición AJAX para eliminar
                $.ajax({
                    url: '/gestion_vehicular/controladores/eliminar_motos.php', // Ajustar la ruta al archivo PHP correcto
                    type: 'POST',
                    data: { id: id }, // Enviar el ID al servidor
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Eliminado',
                                text: 'El vehículo ha sido eliminado con éxito.'
                            }).then(() => {
                                window.location.reload(); // Recargar la página después de eliminar
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Verificar cualquier error del servidor
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un problema al intentar eliminar el vehículo.'
                        });
                    }
                });
            }
        });
    });
});
