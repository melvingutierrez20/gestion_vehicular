<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Persona</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
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
        /* Contenedor del formulario */
        .container {
            max-width: 600px;
        }

        /* Estilo de la tarjeta */
        .card {
            border: 1px solid #007bff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        /* Cabecera de la tarjeta */
        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 10px 10px 0 0;
            text-transform: uppercase;
            font-weight: bold;
        }

        /* Campos del formulario */
        .form-control {
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        /* Al enfocar los campos de texto */
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        /* Botón de agregar */
        .btn-success {
            background-color: #28a745;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            border-radius: 5px;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        /* Botón de regresar */
        .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            border-radius: 5px;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        /* Espaciado entre los botones */
        .d-flex button,
        .d-flex a {
            margin: 10px 0;
        }

        /* Título del formulario */
        h2 {
            font-size: 1.5rem;
            margin-bottom: 0;
        }
    </style>

<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center bg-primary text-white">
            <h2>Editar Persona</h2>
        </div>
        <div class="card-body">

            <?php
            require_once '../conexion_db/conexion.php';
            $id = $_GET['id']; // Obtenemos el ID de la persona a editar
            $dbConn = new DatabaseConnection();
            $db = $dbConn->Connect();
            $collection = $db->persona;
            $persona = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);

            if (!$persona) {
                echo "<p>No se encontró a la persona.</p>";
                exit;
            }
            ?>

            <!-- Formulario para editar persona -->
            <form id="editForm" method="POST">
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">

                <!-- Campo Nombre -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $persona['nombre']; ?>">
                </div>

                <!-- Campo Apellido -->
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $persona['apellido']; ?>">
                </div>

                <!-- Campo Fecha de Nacimiento -->
                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo date('Y-m-d', $persona['fecha_nacimiento']->toDateTime()->getTimestamp()); ?>">
                </div>

                <!-- Campo Dirección -->
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $persona['direccion']; ?>">
                </div>

                <!-- Campo Municipio -->
                <div class="mb-3">
                    <label for="municipio" class="form-label">Municipio</label>
                    <input type="text" class="form-control" id="municipio" name="municipio" value="<?php echo $persona['municipio']; ?>">
                </div>

                <!-- Campo Departamento (Desplegable) -->
                <div class="mb-3">
    <label for="departamento" class="form-label">Departamento</label>
    <select class="form-control" id="departamento" name="departamento">
        <option value="Ahuachapán" <?php if ($persona['departamento'] == "Ahuachapán") echo "selected"; ?>>Ahuachapán</option>
        <option value="Cabañas" <?php if ($persona['departamento'] == "Cabañas") echo "selected"; ?>>Cabañas</option>
        <option value="Chalatenango" <?php if ($persona['departamento'] == "Chalatenango") echo "selected"; ?>>Chalatenango</option>
        <option value="Cuscatlán" <?php if ($persona['departamento'] == "Cuscatlán") echo "selected"; ?>>Cuscatlán</option>
        <option value="La Libertad" <?php if ($persona['departamento'] == "La Libertad") echo "selected"; ?>>La Libertad</option>
        <option value="La Paz" <?php if ($persona['departamento'] == "La Paz") echo "selected"; ?>>La Paz</option>
        <option value="La Unión" <?php if ($persona['departamento'] == "La Unión") echo "selected"; ?>>La Unión</option>
        <option value="Morazán" <?php if ($persona['departamento'] == "Morazán") echo "selected"; ?>>Morazán</option>
        <option value="San Miguel" <?php if ($persona['departamento'] == "San Miguel") echo "selected"; ?>>San Miguel</option>
        <option value="San Salvador" <?php if ($persona['departamento'] == "San Salvador") echo "selected"; ?>>San Salvador</option>
        <option value="San Vicente" <?php if ($persona['departamento'] == "San Vicente") echo "selected"; ?>>San Vicente</option>
        <option value="Santa Ana" <?php if ($persona['departamento'] == "Santa Ana") echo "selected"; ?>>Santa Ana</option>
        <option value="Sonsonate" <?php if ($persona['departamento'] == "Sonsonate") echo "selected"; ?>>Sonsonate</option>
        <option value="Usulután" <?php if ($persona['departamento'] == "Usulután") echo "selected"; ?>>Usulután</option>
    </select>
</div>


                <!-- Botones de acción -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    <a href="../vendor/almasaeed2010/adminlte/pages/Registros/persona.php" class="btn btn-secondary">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js//persona/editar_persona.js"></script>

</body>
</html>

