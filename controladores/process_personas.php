<?php
require_once '../conexion_db/conexion.php';

header('Content-Type: application/json'); // Asegurar que la respuesta sea JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar los datos enviados desde el formulario
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $fecha_nacimiento = trim($_POST['fecha_nacimiento']);
    $direccion = trim($_POST['direccion']);
    $municipio = trim($_POST['municipio']);
    $departamento = trim($_POST['departamento']);

    // Validaciones del lado del servidor
    if (empty($nombre)) {
        echo json_encode(['status' => 'error', 'message' => 'El nombre es obligatorio.']);
        exit;
    }
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $nombre)) {
        echo json_encode(['status' => 'error', 'message' => 'El nombre solo debe contener letras.']);
        exit;
    }

    if (empty($apellido)) {
        echo json_encode(['status' => 'error', 'message' => 'El apellido es obligatorio.']);
        exit;
    }
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $apellido)) {
        echo json_encode(['status' => 'error', 'message' => 'El apellido solo debe contener letras.']);
        exit;
    }

    if (empty($fecha_nacimiento)) {
        echo json_encode(['status' => 'error', 'message' => 'La fecha de nacimiento es obligatoria.']);
        exit;
    }

    // Validar que la persona tenga al menos 18 años
    $fechaNacimientoDateTime = new DateTime($fecha_nacimiento);
    $hoy = new DateTime();
    $edad = $hoy->diff($fechaNacimientoDateTime)->y;

    if ($edad < 18) {
        echo json_encode(['status' => 'error', 'message' => 'La persona debe tener al menos 18 años.']);
        exit;
    }

    if (empty($direccion)) {
        echo json_encode(['status' => 'error', 'message' => 'La dirección es obligatoria.']);
        exit;
    }

    if (empty($municipio)) {
        echo json_encode(['status' => 'error', 'message' => 'El municipio es obligatorio.']);
        exit;
    }

    if (empty($departamento)) {
        echo json_encode(['status' => 'error', 'message' => 'Debe seleccionar un departamento.']);
        exit;
    }
    

    // Conexión a la base de datos
    $dbConn = new DatabaseConnection();
    $db = $dbConn->Connect();
    $collection = $db->persona;

    try {
        // Intentar insertar la nueva persona
        $insertResult = $collection->insertOne([
            'nombre' => $nombre,
            'apellido' => $apellido,
            'fecha_nacimiento' => new MongoDB\BSON\UTCDateTime(strtotime($fecha_nacimiento) * 1000),
            'direccion' => $direccion,
            'municipio' => $municipio,
            'departamento' => $departamento
        ]);

        // Respuesta de éxito si la inserción fue exitosa
        echo json_encode(['status' => 'success', 'message' => 'La persona ha sido agregada con éxito.']);
    } catch (MongoDB\Driver\Exception\BulkWriteException $e) {
        // Capturar errores de validación de MongoDB
        echo json_encode(['status' => 'error', 'message' => 'Error de validación: ' . $e->getMessage()]);
    }
}
?>
