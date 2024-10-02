<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Persona</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center bg-primary text-white">
            <h2>Agregar Nueva Persona</h2>
        </div>
        <div class="card-body">

            <!-- Formulario para agregar persona -->
            <form id="addForm" method="POST">
                <!-- Campo Nombre -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                </div>

                <!-- Campo Apellido -->
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido">
                </div>

                <!-- Campo Fecha de Nacimiento -->
                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                </div>

                <!-- Campo Dirección -->
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion">
                </div>

                <!-- Campo Municipio -->
                <div class="mb-3">
                    <label for="municipio" class="form-label">Municipio</label>
                    <input type="text" class="form-control" id="municipio" name="municipio">
                </div>

                <!-- Campo Departamento (Desplegable) -->
                <div class="mb-3">
                    <label for="departamento" class="form-label">Departamento</label>
                    <select class="form-control" id="departamento" name="departamento">
                        <option value="">Seleccione un departamento</option>
                        <option value="Ahuachapán">Ahuachapán</option>
                        <option value="Santa Ana">Santa Ana</option>
                        <option value="Sonsonate">Sonsonate</option>
                        <option value="Chalatenango">Chalatenango</option>
                        <option value="La Libertad">La Libertad</option>
                        <option value="San Salvador">San Salvador</option>
                        <option value="Cuscatlán">Cuscatlán</option>
                        <option value="Cabañas">Cabañas</option>
                        <option value="San Vicente">San Vicente</option>
                        <option value="Usulután">Usulután</option>
                        <option value="San Miguel">San Miguel</option>
                        <option value="Morazán">Morazán</option>
                        <option value="La Unión">La Unión</option>
                        <option value="La Paz">La Paz</option>
                    </select>
                </div>

                <!-- Botones de acción -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a href="../vendor/almasaeed2010/adminlte/pages/Registros/persona.php" class="btn btn-secondary">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/persona/agregar_persona.js"></script>

</body>
</html>
