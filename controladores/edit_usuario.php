<?php
require_once '../conexion_db/conexion.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar los datos enviados desde el formulario
    $id = trim($_POST['id']);
    $nombre_usuario = trim($_POST['nombre_usuario']);
    $correo = trim($_POST['correo']);
    $password = trim($_POST['password']); // La contraseña puede ser opcional, se puede actualizar solo si se envía
    $rol = trim($_POST['rol']);

    // Validaciones del lado del servidor
    if (empty($id) || empty($nombre_usuario) || empty($correo) || empty($rol)) {
        echo json_encode(['status' => 'error', 'message' => 'Todos los campos, excepto la contraseña, son obligatorios.']);
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
        $collection = $db->usuarios;

        // Armar los datos a actualizar
        $updateData = [
            'nombre_usuario' => $nombre_usuario,
            'correo' => $correo,
            'rol' => $rol
        ];

        // Solo actualizar la contraseña si fue proporcionada
        if (!empty($password)) {
            $updateData['password'] = $password; // Sin encriptar la contraseña
        }

        // Actualizar el usuario en la base de datos
        $updateResult = $collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id)], // Filtrar por ID
            ['$set' => $updateData] // Actualizar los datos
        );

        if ($updateResult->getModifiedCount() > 0) {
            echo json_encode(['status' => 'success', 'message' => 'El usuario ha sido actualizado con éxito.']);
        } else {
            echo json_encode(['status' => 'info', 'message' => 'No se realizaron cambios.']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el usuario: ' . $e->getMessage()]);
    }
}
?>
