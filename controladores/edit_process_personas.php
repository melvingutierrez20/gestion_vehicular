<?php
require_once '../conexion_db/conexion.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $fecha_nacimiento = trim($_POST['fecha_nacimiento']);
    $direccion = trim($_POST['direccion']);
    $municipio = trim($_POST['municipio']);
    $departamento = trim($_POST['departamento']);

    if (empty($nombre) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $nombre)) {
        echo json_encode(['status' => 'error', 'message' => 'El nombre solo debe contener letras.']);
        exit;
    }

    if (empty($apellido) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $apellido)) {
        echo json_encode(['status' => 'error', 'message' => 'El apellido solo debe contener letras.']);
        exit;
    }

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


    if (empty($departamento)) {
        echo json_encode(['status' => 'error', 'message' => 'Debe seleccionar un departamento.']);
        exit;
    }

    $dbConn = new DatabaseConnection();
    $db = $dbConn->Connect();
    $collection = $db->persona;

    try {
        $updateResult = $collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id)],
            ['$set' => [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'fecha_nacimiento' => new MongoDB\BSON\UTCDateTime(strtotime($fecha_nacimiento) * 1000),
                'direccion' => $direccion,
                'municipio' => $municipio,
                'departamento' => $departamento
            ]]
        );

        echo json_encode(['status' => 'success', 'message' => 'Los datos han sido actualizados con éxito.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error en la actualización: ' . $e->getMessage()]);
    }
}
?>

