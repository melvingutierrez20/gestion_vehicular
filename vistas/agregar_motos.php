<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Motos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            background-attachment: fixed;
            display: flex;
            font-family: "Roboto Condensed", sans-serif;
        }

        .container {
            max-width: 600px;
        }

        .card {
            border: 1px solid #007bff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 10px 10px 0 0;
            text-transform: uppercase;
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn-success, .btn-secondary {
            padding: 10px 20px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            border-radius: 5px;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .d-flex button, .d-flex a {
            margin: 10px 0;
        }

        h2 {
            font-size: 1.5rem;
            margin-bottom: 0;
        }

        /* Estilo para la lista de sugerencias de propietarios */
        .suggestions {
            position: absolute;
            background-color: white;
            border: 1px solid #ccc;
            z-index: 1000;
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
        }

        .suggestion-item {
            padding: 10px;
            cursor: pointer;
        }

        .suggestion-item:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h2>Agregar Nuevo Vehículo</h2>
        </div>
        <div class="card-body">

            <!-- Formulario para agregar vehículo -->
            <form id="addForm" method="POST">
                <!-- Campo Placa -->
                <div class="mb-3">
                    <label for="placa" class="form-label">Placa</label>
                    <input type="text" class="form-control" id="placa" name="placa" required>
                </div>

                <!-- Campo Marca -->
                <div class="mb-3">
                    <label for="marca" class="form-label">Marca</label>
                    <input type="text" class="form-control" id="marca" name="marca" required>
                </div>

                <!-- Campo Modelo -->
                <div class="mb-3">
                    <label for="modelo" class="form-label">Modelo</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" required>
                </div>

                <!-- Campo Año -->
                <div class="mb-3">
                    <label for="anio" class="form-label">Año</label>
                    <input type="number" class="form-control" id="anio" name="anio" min="1900" max="2100" required>
                </div>

                <!-- Campo Tipo -->
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo</label>
                    <input type="text" class="form-control" id="tipo" name="tipo" required>
                </div>

                <!-- Campo Clase -->
                <div class="mb-3">
                    <label for="clase" class="form-label">Clase</label>
                    <input type="text" class="form-control" id="clase" name="clase" required>
                </div>

                <!-- Campo Número de Chasis -->
                <div class="mb-3">
                    <label for="numero_chasis" class="form-label">Número de Chasis</label>
                    <input type="text" class="form-control" id="numero_chasis" name="numero_chasis" required>
                </div>

                <!-- Campo Número de Motor -->
                <div class="mb-3">
                    <label for="numero_motor" class="form-label">Número de Motor</label>
                    <input type="text" class="form-control" id="numero_motor" name="numero_motor" required>
                </div>

                <!-- Campo Propietario con sugerencias en tiempo real -->
                <div class="mb-3 position-relative">
                    <label for="propietario" class="form-label">Propietario</label>
                    <input type="text" class="form-control" id="propietario" name="propietario" autocomplete="off" required>
                    <div id="suggestions" class="suggestions"></div>
                </div>

                <!-- Campo oculto para almacenar el _id del propietario -->
                <input type="hidden" id="propietario_id" name="propietario_id">

                <!-- Botones de acción -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a href="../vendor/almasaeed2010/adminlte/pages/Registros/motos.php" class="btn btn-secondary">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/motos/agregar_motos.js"></script>
<script>
$(document).ready(function () {
    // Capturar el evento input en el campo de propietario
    $('#propietario').on('input', function () {
        var query = $(this).val(); // Obtener el valor ingresado
        if (query.length > 2) { // Iniciar búsqueda si el texto tiene más de 2 caracteres
            $.ajax({
                url: '../controladores/buscar_propietario.php', // Ajusta esta ruta según tu estructura
                method: 'GET',
                data: { query: query },
                success: function (data) {
                    $('#suggestions').html(data); // Mostrar resultados en el div de sugerencias
                },
                error: function (xhr, status, error) {
                    console.log('Error en la solicitud: ' + error); // Para capturar posibles errores
                }
            });
        } else {
            $('#suggestions').empty(); // Limpiar sugerencias si el input es corto
        }
    });

    // Cuando el usuario haga clic en una sugerencia, completar el campo con el nombre y almacenar el _id
    $(document).on('click', '.suggestion-item', function () {
        var propietarioNombre = $(this).text();
        var propietarioId = $(this).data('id'); // Obtener el _id del propietario desde el atributo data-id

        // Rellenar el campo de texto con el nombre del propietario
        $('#propietario').val(propietarioNombre);

        // Almacenar el _id del propietario en un campo oculto
        $('#propietario_id').val(propietarioId);

        // Limpiar las sugerencias
        $('#suggestions').empty();
    });
});
</script>

</body>
</html>
