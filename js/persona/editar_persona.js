



$(document).ready(function() {
    $('#editForm').on('submit', function(e) {
        e.preventDefault();

        // Validar los campos antes de enviar
        var nombre = $('#nombre').val();
        var apellido = $('#apellido').val();
        var departamento = $('#departamento').val();

        if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(nombre)) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El nombre solo debe contener letras.'
            });
            return;
        }

        if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(apellido)) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El apellido solo debe contener letras.'
            });
            return;
        }

        if (departamento === "") {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Debe seleccionar un departamento.'
            });
            return;
        }

        // Serializar los datos
        var formData = $(this).serialize();

        // Realizar la petición AJAX para editar
        $.ajax({
            url: '../controladores/edit_process_personas.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = '../vendor/almasaeed2010/adminlte/pages/Registros/persona.php';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al intentar actualizar la persona.'
                });
            }
        });
    });
});
