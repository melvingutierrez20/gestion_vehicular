<?php
require_once '../conexion_db/conexion.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; // Capturamos el ID enviado desde el AJAX

    // Conexión a la base de datos
    $dbConn = new DatabaseConnection();
    $db = $dbConn->Connect();
    $collection = $db->motos; // Cambiar a la colección de vehículos

    try {
        // Eliminar el documento con el ID proporcionado
        $deleteResult = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);

        if ($deleteResult->getDeletedCount() === 1) {
            // Responder con éxito si el vehículo fue eliminado
            echo json_encode(['status' => 'success', 'message' => 'El vehículo ha sido eliminado con éxito.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo encontrar el vehículo.']);
        }
    } catch (Exception $e) {
        // Manejar cualquier error que ocurra al eliminar el vehículo
        echo json_encode(['status' => 'error', 'message' => 'Error al eliminar: ' . $e->getMessage()]);
    }
}
?>