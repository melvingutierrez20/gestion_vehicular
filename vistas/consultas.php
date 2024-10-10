<?php
require_once '../conexion_db/conexion.php'; // Conexión a MongoDB

$dbConn = new DatabaseConnection();
$db = $dbConn->Connect();

// Contar la cantidad total de cada colección
$totalVehiculos = $db->vehiculos->countDocuments();
$totalPersonas = $db->persona->countDocuments();
$totalEsquelas = $db->esquelas->countDocuments();
$totalUsuarios = $db->usuarios->countDocuments(); // Asumiendo que tienes una colección de usuarios

// Devolver los valores al frontend (si lo necesitas en formato JSON)
$data = [
    'vehiculos' => $totalVehiculos,
    'personas' => $totalPersonas,
    'esquelas' => $totalEsquelas,
    'usuarios' => $totalUsuarios
];

echo json_encode($data);
?>
