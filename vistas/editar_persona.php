<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Persona</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../css/editor_ds.css">
</head>


<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center text-white">
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

