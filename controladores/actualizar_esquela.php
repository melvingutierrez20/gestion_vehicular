<?php
require_once '../conexion_db/conexion.php';
header('Content-Type: application/json');

// Verificar si se envió la solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar los datos enviados
    $id = $_POST['id'];
    $nuevoEstado = $_POST['estado'];

    // Validar que los datos no estén vacíos
    if (empty($id) || empty($nuevoEstado)) {
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos.']);
        exit;
    }

    try {
        // Convertir el ID en ObjectId
        $esquelaId = new MongoDB\BSON\ObjectId($id);

        // Conectar a la base de datos
        $dbConn = new DatabaseConnection();
        $db = $dbConn->Connect();
        $esquelasCollection = $db->esquelas;

        // Obtener el estado actual de la esquela
        $esquela = $esquelasCollection->findOne(['_id' => $esquelaId]);

        // Verificar si la esquela ya está "pagada"
        if ($esquela && $esquela['estado'] === 'pagada') {
            echo json_encode(['status' => 'error', 'message' => 'La esquela ya está pagada y no puede ser modificada.']);
            exit;
        }

        // Actualizar el estado de la esquela solo si no está pagada
        $updateResult = $esquelasCollection->updateOne(
            ['_id' => $esquelaId],
            ['$set' => ['estado' => 'pagada']]
        );

        // Verificar si la actualización fue exitosa
        if ($updateResult->getModifiedCount() > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Estado actualizado con éxito.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo actualizar el estado.']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
}
?>
