<?php
require_once '../conexion_db/conexion.php';

header('Content-Type: application/json'); // Asegurar que la respuesta sea JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; // El ID del vehículo a editar
    $placa = trim($_POST['placa']);
    $marca = trim($_POST['marca']);
    $modelo = trim($_POST['modelo']);
    $anio = trim($_POST['anio']);
    $tipo = trim($_POST['tipo']);
    $clase = trim($_POST['clase']);
    $numero_chasis = trim($_POST['numero_chasis']);
    $numero_motor = trim($_POST['numero_motor']);
    $propietario_id = trim($_POST['propietario_id']);

    // Validaciones del lado del servidor
    if (empty($placa) || empty($marca) || empty($modelo) || empty($anio) || empty($tipo) || empty($clase) || empty($numero_chasis) || empty($numero_motor) || empty($propietario_id)) {
        echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    // Convertir a ObjectId
    try {
        $propietarioObjectId = new MongoDB\BSON\ObjectId($propietario_id);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'ID del propietario inválido.']);
        exit;
    }

    // Conexión a la base de datos
    $dbConn = new DatabaseConnection();
    $db = $dbConn->Connect();
    $collection = $db->motos;

    // Encontrar el vehículo actual
    $motos = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);

    if (!$motos) {
        echo json_encode(['status' => 'error', 'message' => 'El vehículo no existe.']);
        exit;
    }

    // Verificar si los datos han cambiado
    $updateData = [];
    if ($motos['placa'] !== $placa) $updateData['placa'] = $placa;
    if ($motos['marca'] !== $marca) $updateData['marca'] = $marca;
    if ($motos['modelo'] !== $modelo) $updateData['modelo'] = $modelo;
    if ($motos['anio'] !== intval($anio)) $updateData['anio'] = intval($anio);
    if ($motos['tipo'] !== $tipo) $updateData['tipo'] = $tipo;
    if ($motos['clase'] !== $clase) $updateData['clase'] = $clase;
    if ($motos['numero_chasis'] !== $numero_chasis) $updateData['numero_chasis'] = $numero_chasis;
    if ($motos['numero_motor'] !== $numero_motor) $updateData['numero_motor'] = $numero_motor;
    if ($motos['propietario_id'] != $propietarioObjectId) $updateData['propietario_id'] = $propietarioObjectId;

    // Verificar si hay cambios
    if (empty($updateData)) {
        echo json_encode(['status' => 'info', 'message' => 'No se realizaron cambios.']);
        exit;
    }

    // Intentar actualizar el vehículo
    try {
        $updateResult = $collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id)],
            ['$set' => $updateData]
        );

        // Responder según el resultado de la actualización
        if ($updateResult->getModifiedCount() > 0) {
            echo json_encode(['status' => 'success', 'message' => 'El vehículo ha sido actualizado con éxito.']);
        } else {
            echo json_encode(['status' => 'info', 'message' => 'No se realizaron cambios.']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el vehículo: ' . $e->getMessage()]);
    }
}
?>
