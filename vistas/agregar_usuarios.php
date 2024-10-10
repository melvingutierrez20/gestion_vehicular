<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
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
.d-flex button,
.d-flex a {
    margin: 10px 0;
}
h2 {
    font-size: 1.5rem;
    margin-bottom: 0;
}
</style>

<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center bg-primary text-white">
            <h2>Agregar Nuevo Usuario</h2>
        </div>
        <div class="card-body">

            <!-- Formulario para agregar usuario -->
            <form id="addForm" method="POST">
                <!-- Campo Nombre de Usuario -->
                <div class="mb-3">
                    <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
                </div>

                <!-- Campo Correo -->
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="correo" name="correo" required>
                </div>

                <!-- Campo Contraseña -->
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <!-- Campo Rol (Desplegable) -->
                <div class="mb-3">
                    <label for="rol" class="form-label">Rol</label>
                    <select class="form-control" id="rol" name="rol" required>
                        <option value="">Seleccione un rol</option>
                        <option value="admin">Administrador</option>
                        <option value="usuario">Usuario</option>
                    </select>
                </div>

                <!-- Botones de acción -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a href="../vendor/almasaeed2010/adminlte/pages/Registros/usuarios.php" class="btn btn-secondary">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/usuario/agregar_usuario.js"></script>

</body>
</html>
