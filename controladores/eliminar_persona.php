<?php
require_once '../conexion_db/conexion.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $dbConn = new DatabaseConnection();
    $db = $dbConn->Connect();
    $collection = $db->persona;

    try {
        $deleteResult = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        
        if ($deleteResult->getDeletedCount() === 1) {
            echo json_encode(['status' => 'success', 'message' => 'El registro ha sido eliminado con éxito.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo encontrar el registro.']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error al eliminar: ' . $e->getMessage()]);
    }
}
?>
