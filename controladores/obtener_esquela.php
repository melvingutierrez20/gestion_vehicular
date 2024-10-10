<?php
require_once '../conexion_db/conexion.php';

header('Content-Type: application/json');

if (isset($_GET['vehiculo_id'])) {
    $vehiculo_id = $_GET['vehiculo_id'];

    try {
        $dbConn = new DatabaseConnection();
        $db = $dbConn->Connect();
        $collection = $db->esquelas;

        // Busca las esquelas usando el ID del vehículo
        $esquelas = $collection->find(['vehiculo_id' => new MongoDB\BSON\ObjectId($vehiculo_id)]);

        $esquelasArray = iterator_to_array($esquelas); // Convierte los resultados en un array

        if (count($esquelasArray) > 0) {
            // Retorna las esquelas encontradas
            echo json_encode(['status' => 'success', 'esquelas' => $esquelasArray]);
        } else {
            // Si no hay esquelas, devuelve este mensaje
            echo json_encode(['status' => 'error', 'message' => 'No se encontraron esquelas para este vehículo.']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error al obtener esquelas: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Falta el ID del vehículo.']);
}
?>
