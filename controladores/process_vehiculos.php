<?php
require_once '../conexion_db/conexion.php';

header('Content-Type: application/json'); // Asegurar que la respuesta sea JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar los datos enviados desde el formulario
    $placa = trim($_POST['placa']);
    $marca = trim($_POST['marca']);
    $modelo = trim($_POST['modelo']);
    $anio = trim($_POST['anio']);
    $tipo = trim($_POST['tipo']);
    $clase = trim($_POST['clase']);
    $numero_chasis = trim($_POST['numero_chasis']);
    $numero_motor = trim($_POST['numero_motor']);
    $propietario_id = trim($_POST['propietario_id']);  // El ID del propietario debe ser enviado como string

    // Validaciones del lado del servidor
    if (empty($placa) || empty($marca) || empty($modelo) || empty($anio) || empty($tipo) || empty($clase) || empty($numero_chasis) || empty($numero_motor) || empty($propietario_id)) {
        echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    if (!is_numeric($anio) || $anio < 1900 || $anio > 2100) {
        echo json_encode(['status' => 'error', 'message' => 'El año debe ser un número válido entre 1900 y 2100.']);
        exit;
    }

    try {
        // Convertir el propietario_id a ObjectId antes de insertarlo en MongoDB
        $propietarioObjectId = new MongoDB\BSON\ObjectId($propietario_id);

        // Conexión a la base de datos
        $dbConn = new DatabaseConnection();
        $db = $dbConn->Connect();
        $collection = $db->vehiculos;  // Cambia a la colección correcta si es necesario

        // Intentar insertar el nuevo vehículo
        $insertResult = $collection->insertOne([
            'placa' => $placa,
            'marca' => $marca,
            'modelo' => $modelo,
            'anio' => intval($anio),  // Convertir el año a número
            'tipo' => $tipo,
            'clase' => $clase,
            'numero_chasis' => $numero_chasis,
            'numero_motor' => $numero_motor,
            'propietario_id' => $propietarioObjectId  // Guardar el ObjectId en la base de datos
        ]);

        // Respuesta de éxito si la inserción fue exitosa
        echo json_encode(['status' => 'success', 'message' => 'El vehículo ha sido agregado con éxito.']);
    } catch (MongoDB\Driver\Exception\BulkWriteException $e) {
        // Capturar errores de duplicación de clave
        if ($e->getCode() == 11000) {  // Código de error de MongoDB para claves duplicadas
            echo json_encode(['status' => 'error', 'message' => 'El vehículo con esta placa ya existe.']);
        } else {
            // Capturar otros errores de validación
            echo json_encode(['status' => 'error', 'message' => 'Error de validación: ' . $e->getMessage()]);
        }
    } catch (Exception $e) {
        // Capturar cualquier otro tipo de error
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
    }
}
?>
