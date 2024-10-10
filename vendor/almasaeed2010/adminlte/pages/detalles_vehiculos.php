<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Vehículo por Placa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../../../../css/detalles_vehiculos.css">
    
</head>
<body>

<div class="container">
    <!-- Botón de Cerrar Sesión -->
    <button id="logoutBtn" onclick="cerrarSesion()">Cerrar Sesión</button>

    <h2 class="text-center mb-4">Buscar Vehículo por Placa</h2>
    <div class="mb-3">
        <input type="text" id="placaInput" class="form-control" placeholder="Ingrese la placa">
    </div>
    <button id="buscarBtn" class="btn btn-primary w-100">Buscar</button>

    <!-- Contenedor de resultados -->
    <div id="resultados" class="mt-4"></div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('#buscarBtn').on('click', function() {
        var placa = $('#placaInput').val().trim();

        if (placa === '') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor, ingrese una placa válida.'
            });
            return;
        }

        $.ajax({
            url: '/gestion_vehicular/controladores/buscar_vehiculo.php',
            type: 'GET',
            data: { placa: placa },
            success: function(response) {
                if (response.status === 'success') {
                    var vehiculo = response.data;

                    // Mostrar datos del vehículo
                    var tarjeta = `
                        <div class="card">
                            <div class="card-header">
                                Placa: ${vehiculo.placa}
                            </div>
                            <div class="card-body">
                                <p><strong>Marca:</strong> ${vehiculo.marca}</p>
                                <p><strong>Modelo:</strong> ${vehiculo.modelo}</p>
                            </div>
                        </div>
                    `;
                    $('#resultados').html(tarjeta);

                    // Mostrar las esquelas directamente debajo del vehículo
                    var esquelasHtml = '<h5 class="esquela-header">Esquelas:</h5>';
                    if (vehiculo.esquelas && vehiculo.esquelas.length > 0) {
                        esquelasHtml += '<ul class="list-group mt-2">';
                        vehiculo.esquelas.forEach(function(esquela) {
                            esquelasHtml += `
                                <li class="list-group-item">
                                    <strong>Descripción:</strong> ${esquela.descripcion} <br>
                                    <strong>Monto:</strong> ${esquela.monto} <br>
                                    <strong>Estado:</strong> ${esquela.estado}
                                </li>
                            `;
                        });
                        esquelasHtml += '</ul>';
                    } else {
                        esquelasHtml += '<p>No se encontraron esquelas para este vehículo.</p>';
                    }

                    // Botón para agregar nueva esquela
                    esquelasHtml += `
                        <div class="text-center mt-4">
                            <button id="nuevaEsquelaBtn" class="btn btn-success">Agregar Esquela</button>
                        </div>
                    `;
                    
                    $('#resultados').append(esquelasHtml);

                    // Evento para el botón de agregar nueva esquela
                    $('#nuevaEsquelaBtn').on('click', function () {
                        Swal.fire({
                            title: 'Agregar nueva esquela',
                            html: `
                                <input type="text" id="descripcion" class="swal2-input" placeholder="Descripción">
                                <select id="monto" class="swal2-input">
                                    <option value="34.11">34.11</option>
                                    <option value="11.34">11.34</option>
                                    <option value="57.14">57.14</option>
                                </select>
                            `,
                            showCancelButton: true,
                            confirmButtonText: 'Agregar',
                            cancelButtonText: 'Cancelar',
                            preConfirm: () => {
                                const descripcion = Swal.getPopup().querySelector('#descripcion').value;
                                const monto = Swal.getPopup().querySelector('#monto').value;

                                if (!descripcion || !monto) {
                                    Swal.showValidationMessage(`Por favor completa todos los campos.`);
                                    return;
                                }

                                // Retornar los datos para la solicitud AJAX
                                return { descripcion: descripcion, monto: parseFloat(monto), estado: 'sin pagar' };
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                var nuevaEsquela = result.value;

                                // Extraer el valor del ObjectId (solo la parte del oid)
                                var vehiculoId = vehiculo._id.$oid;

                                console.log('ID del vehículo:', vehiculoId); // Asegúrate de que esto sea una cadena válida

                                // Aquí haces la solicitud AJAX para insertar la nueva esquela
                                $.ajax({
                                    url: '/gestion_vehicular/controladores/agregar_esquela.php',
                                    type: 'POST',
                                    data: {
                                        vehiculo_id: vehiculoId, // Enviar solo el string del ObjectId
                                        descripcion: nuevaEsquela.descripcion,
                                        monto: nuevaEsquela.monto,
                                        estado: nuevaEsquela.estado
                                    },
                                    success: function (response) {
                                        console.log('Respuesta del servidor:', response);
                                        if (response.status === 'success') {
                                            Swal.fire('Éxito', 'Esquela agregada correctamente', 'success');
                                        } else {
                                            Swal.fire('Error', response.message, 'error');
                                        }
                                    },
                                    error: function () {
                                        Swal.fire('Error', 'Hubo un problema al agregar la esquela.', 'error');
                                    }
                                });
                            }
                        });
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
                console.log('Error en el AJAX:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al intentar buscar el vehículo.'
                });
            }
        });
    });
});

// Función para cerrar sesión
function cerrarSesion() {
    // Redirigir a una página de logout o cerrar sesión en el backend
    window.location.href = 'http://localhost/gestion_vehicular/vistas/login.php'; 
}
</script>

</body>
</html>
