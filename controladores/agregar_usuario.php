<?php
require_once '../conexion_db/conexion.php';

header('Content-Type: application/json'); // Asegurar que la respuesta sea JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar los datos enviados desde el formulario
    $nombre_usuario = trim($_POST['nombre_usuario']);
    $correo = trim($_POST['correo']);
    $password = trim($_POST['password']); // Guardaremos la contraseña directamente
    $rol = trim($_POST['rol']);

    // Validaciones del lado del servidor
    if (empty($nombre_usuario) || empty($correo) || empty($password) || empty($rol)) {
        echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'El correo electrónico no es válido.']);
        exit;
    }

    try {
        // Conexión a la base de datos
        $dbConn = new DatabaseConnection();
        $db = $dbConn->Connect();
        $collection = $db->usuarios;  // Asegúrate de que 'usuarios' es el nombre de la colección correcta

        // Verificar si el usuario ya existe
        $existingUser = $collection->findOne(['correo' => $correo]);
        if ($existingUser) {
            echo json_encode(['status' => 'error', 'message' => 'Ya existe un usuario con este correo.']);
            exit;
        }

        // Insertar el nuevo usuario sin encriptar la contraseña
        $insertResult = $collection->insertOne([
            'nombre_usuario' => $nombre_usuario,
            'correo' => $correo,
            'password' => $password,  // Guardar la contraseña sin encriptar
            'rol' => $rol
        ]);

        // Respuesta de éxito si la inserción fue exitosa
        echo json_encode(['status' => 'success', 'message' => 'El usuario ha sido agregado con éxito.']);
    } catch (Exception $e) {
        // Capturar cualquier error
        echo json_encode(['status' => 'error', 'message' => 'Error al agregar el usuario: ' . $e->getMessage()]);
    }
}
?>
