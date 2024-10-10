<?php
require_once '../conexion_db/conexion.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; // Capturar el ID del usuario

    // Conexión a la base de datos
    $dbConn = new DatabaseConnection();
    $db = $dbConn->Connect();
    $collection = $db->usuarios; // Cambia a la colección correcta si es necesario

    try {
        // Eliminar el usuario con el ID proporcionado
        $deleteResult = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);

        // Verificar si la eliminación fue exitosa
        if ($deleteResult->getDeletedCount() === 1) {
            echo json_encode(['status' => 'success', 'message' => 'El usuario ha sido eliminado con éxito.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se encontró el usuario para eliminar.']);
        }
    } catch (Exception $e) {
        // Mostrar el error exacto que está ocurriendo
        echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el usuario: ' . $e->getMessage()]);
    }
}
?>
