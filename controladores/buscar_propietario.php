<?php
require_once '../conexion_db/conexion.php'; 

// Conexión a la base de datos
$dbConn = new DatabaseConnection();
$db = $dbConn->Connect();
$collection = $db->persona; // Cambia a 'persona' si esa es la colección correcta

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $regex = new MongoDB\BSON\Regex($query, 'i'); // Búsqueda insensible a mayúsculas/minúsculas

    $result = $collection->find([
        '$or' => [
            ['nombre' => $regex],
            ['apellido' => $regex]
        ]
    ]);

    // Verifica si hay resultados
    if ($result) {
        // Mostrar los resultados como una lista de sugerencias con data-id
        foreach ($result as $persona) {
            echo '<div class="suggestion-item" data-id="' . $persona['_id'] . '">' . $persona['nombre'] . ' ' . $persona['apellido'] . '</div>';
        }
    } else {
        echo '<div class="suggestion-item">No se encontraron resultados</div>';
    }
} else {
    echo 'Error: No se recibió ninguna consulta';
}
?>
