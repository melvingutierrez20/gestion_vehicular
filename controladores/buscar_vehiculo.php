<?php
require_once '../conexion_db/conexion.php';

header('Content-Type: application/json');

if (isset($_GET['placa'])) {
    $placa = $_GET['placa'];

    try {
        $dbConn = new DatabaseConnection();
        $db = $dbConn->Connect();
        
        // Utilizamos el agregado con lookup para obtener el vehículo y sus esquelas
        $resultado = $db->vehiculos->aggregate([
            [
                '$match' => [ 'placa' => $placa ]
            ],
            [
                '$lookup' => [
                    'from' => 'esquelas',  // Nombre de la colección de esquelas
                    'localField' => '_id',  // ID del vehículo
                    'foreignField' => 'vehiculo_id',  // ID en la colección de esquelas
                    'as' => 'esquelas'  // Alias para las esquelas obtenidas
                ]
            ]
        ]);

        $vehiculo = iterator_to_array($resultado);

        if (count($vehiculo) > 0) {
            // Si el vehículo existe, retorna el vehículo y las esquelas

            //aqui se agerga quipoidgdfgdfg
            echo json_encode(['status' => 'success', 'data' => $vehiculo[0]]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se encontró el vehículo con esa placa.']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error al buscar vehículo: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Falta el parámetro de placa.']);
}
?>


