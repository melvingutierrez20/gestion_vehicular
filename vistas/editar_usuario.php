<?php
require_once '../conexion_db/conexion.php';

// Obtener el ID del usuario a editar
$id = $_GET['id'];

// Conectar a la base de datos
$dbConn = new DatabaseConnection();
$db = $dbConn->Connect();
$collection = $db->usuarios;
$usuario = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);

if (!$usuario) {
    echo "Usuario no encontrado";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../css/editor_ds.css">
</head>

<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center text-white">
            <h2>Editar Usuario</h2>
        </div>
        <div class="card-body">
            <!-- Formulario para editar usuario -->
            <form id="editForm" method="POST">
                <!-- Campo oculto para el ID -->
                <input type="hidden" id="id" name="id" value="<?php echo $usuario['_id']; ?>">

                <!-- Campo Nombre de Usuario -->
                <div class="mb-3">
                    <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" value="<?php echo $usuario['nombre_usuario']; ?>">
                </div>

                <!-- Campo Correo -->
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $usuario['correo']; ?>">
                </div>

                <!-- Campo Contraseña (opcional) -->
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña (dejar vacío si no se va a cambiar)</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <!-- Campo Rol -->
                <div class="mb-3">
                    <label for="rol" class="form-label">Rol</label>
                    <select class="form-control" id="rol" name="rol">
                        <option value="admin" <?php if ($usuario['rol'] == 'admin') echo 'selected'; ?>>Administrador</option>
                        <option value="usuario" <?php if ($usuario['rol'] == 'usuario') echo 'selected'; ?>>Usuario</option>
                    </select>
                </div>

                <!-- Botones de acción -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    <a href="../vendor/almasaeed2010/adminlte/pages/Registros/usuarios.php" class="btn btn-secondary">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/usuario/editar_usuario.js"></script>

</body>
</html>
