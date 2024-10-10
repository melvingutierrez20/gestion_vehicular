<?php
require_once '../conexion_db/conexion.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar los datos enviados desde el formulario
    $vehiculo_id = $_POST['vehiculo_id'];
    $descripcion = $_POST['descripcion'];
    $monto = (float) $_POST['monto'];
    $estado = $_POST['estado'];

    // Validaciones del lado del servidor
    if (empty($vehiculo_id) || empty($descripcion) || empty($monto) || empty($estado)) {
        echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    // Verificar el ID del vehículo
    try {
        // Convertir el ID recibido a ObjectId para MongoDB
        $vehiculoObjectId = new MongoDB\BSON\ObjectId($vehiculo_id);
    } catch (Exception $e) {
        error_log("Error de ObjectId: " . $e->getMessage());  // Log para verificar si el ID es el problema
        echo json_encode(['status' => 'error', 'message' => 'El ID del vehículo no es válido.']);
        exit;
    }

    try {
        // Conectar a la base de datos
        $dbConn = new DatabaseConnection();
        $db = $dbConn->Connect();
        $collection = $db->esquelas;

        // Insertar la nueva esquela en MongoDB
        $insertResult = $collection->insertOne([
            'vehiculo_id' => $vehiculoObjectId,
            'descripcion' => $descripcion,
            'monto' => $monto,
            'estado' => $estado
        ]);

        // Verificar si la inserción fue exitosa
        if ($insertResult->getInsertedCount() === 1) {
            echo json_encode(['status' => 'success', 'message' => 'Esquela agregada con éxito.']);
        } else {
            error_log("Inserción fallida: No se pudo insertar la esquela.");
            echo json_encode(['status' => 'error', 'message' => 'No se pudo agregar la esquela.']);
        }
    } catch (Exception $e) {
        error_log("Error al insertar en MongoDB: " . $e->getMessage());
        echo json_encode(['status' => 'error', 'message' => 'Error al insertar la esquela: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
}
