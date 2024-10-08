<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Vehículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../css/editor_ds.css">
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h2>Editar Vehículo</h2>
        </div>
        <div class="card-body">

            <?php
            require_once '../conexion_db/conexion.php';

            // Obtener el ID del vehículo desde la URL
            if (isset($_GET['id'])) {
                $motosId = $_GET['id'];

                // Conexión a la base de datos
                $dbConn = new DatabaseConnection();
                $db = $dbConn->Connect();
                $motosCollection = $db->motos;

                // Buscar el vehículo por su ID
                $motos = $motosCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($motosId)]);

                if ($motos) {
                    // Obtener los valores del vehículo
                    $placa = $motos['placa'];
                    $marca = $motos['marca'];
                    $modelo = $motos['modelo'];
                    $anio = $motos['anio'];
                    $tipo = $motos['tipo'];
                    $clase = $motos['clase'];
                    $numero_chasis = $motos['numero_chasis'];
                    $numero_motor = $motos['numero_motor'];

                    // Obtener el propietario
                    $personaCollection = $db->persona;
                    $propietario = $personaCollection->findOne(['_id' => $motos['propietario_id']]);

                    if ($propietario) {
                        $propietarioNombre = $propietario['nombre'] . ' ' . $propietario['apellido'];
                        $propietarioId = (string)$propietario['_id'];
                    } else {
                        $propietarioNombre = 'Propietario no encontrado';
                        $propietarioId = '';
                    }
                } else {
                    echo "<p>No se encontró el vehículo.</p>";
                    exit;
                }
            } else {
                echo "<p>ID del vehículo no proporcionado.</p>";
                exit;
            }
            ?>

            <!-- Formulario para editar vehículo -->
            <form id="editForm" method="POST" action="../controladores/edit_process_motos.php">
                <input type="hidden" id="id" name="id" value="<?php echo $motosId; ?>">

                <!-- Campo Placa -->
                <div class="mb-3">
                    <label for="placa" class="form-label">Placa</label>
                    <input type="text" class="form-control" id="placa" name="placa" value="<?php echo $placa; ?>" required>
                </div>

                <!-- Campo Marca -->
                <div class="mb-3">
                    <label for="marca" class="form-label">Marca</label>
                    <input type="text" class="form-control" id="marca" name="marca" value="<?php echo $marca; ?>" required>
                </div>

                <!-- Campo Modelo -->
                <div class="mb-3">
                    <label for="modelo" class="form-label">Modelo</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo $modelo; ?>" required>
                </div>

                <!-- Campo Año -->
                <div class="mb-3">
                    <label for="anio" class="form-label">Año</label>
                    <input type="number" class="form-control" id="anio" name="anio" value="<?php echo $anio; ?>" min="1900" max="2100" required>
                </div>

                <!-- Campo Tipo -->
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo</label>
                    <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo $tipo; ?>" required>
                </div>

                <!-- Campo Clase -->
                <div class="mb-3">
                    <label for="clase" class="form-label">Clase</label>
                    <input type="text" class="form-control" id="clase" name="clase" value="<?php echo $clase; ?>" required>
                </div>

                <!-- Campo Número de Chasis -->
                <div class="mb-3">
                    <label for="numero_chasis" class="form-label">Número de Chasis</label>
                    <input type="text" class="form-control" id="numero_chasis" name="numero_chasis" value="<?php echo $numero_chasis; ?>" required>
                </div>

                <!-- Campo Número de Motor -->
                <div class="mb-3">
                    <label for="numero_motor" class="form-label">Número de Motor</label>
                    <input type="text" class="form-control" id="numero_motor" name="numero_motor" value="<?php echo $numero_motor; ?>" required>
                </div>

                <!-- Campo Propietario con sugerencias -->
                <div class="mb-3 position-relative">
                    <label for="propietario" class="form-label">Propietario</label>
                    <input type="text" class="form-control" id="propietario" name="propietario" value="<?php echo $propietarioNombre; ?>" required>
                    <div id="suggestions" class="suggestions"></div>
                </div>

<!-- Campo oculto para almacenar el _id del propietario -->
<input type="hidden" id="propietario_id" name="propietario_id" value="<?php echo $motos['propietario_id']; ?>">


                <!-- Botones de acción -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    <a href="../vendor/almasaeed2010/adminlte/pages/Registros/motos.php" class="btn btn-secondary">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/motos/editar_motos.js"></script>
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

        // Verificar si estamos capturando correctamente el propietario_id
        console.log("Propietario seleccionado:", propietarioNombre);
        console.log("ID del propietario seleccionado:", propietarioId);

        // Rellenar el campo de texto con el nombre del propietario
        $('#propietario').val(propietarioNombre);

        // Actualizar el campo oculto con el nuevo ID del propietario
        $('#propietario_id').val(propietarioId);

        // Limpiar las sugerencias
        $('#suggestions').empty();
    });
});



</script>

</body>
</html>
