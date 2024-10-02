<?php
session_start();
require '../conexion_db/conexion.php'; // Incluir el archivo de conexión

// Crear una instancia de la clase DatabaseConnection
$dbConnection = new DatabaseConnection();
$baseDeDatos = $dbConnection->Connect(); // Conectar a la base de datos

// Verificar si la conexión es válida
if ($baseDeDatos instanceof MongoDB\Database) {
    // Seleccionar la colección 'usuarioss'
    $coleccion = $baseDeDatos->usuarios;

    // Obtener los datos del formulario
    $usernameOrEmail = $_POST['username'];
    $password = $_POST['password'];

    // Buscar al usuario por nombre de usuario o correo electrónico
    $usuario = $coleccion->findOne([
        '$or' => [
            ['nombre_usuario' => $usernameOrEmail],
            ['correo' => $usernameOrEmail]
        ]
    ]);

    if ($usuario && $usuario['password'] === $password) {
        // Si las credenciales son correctas, crear la sesión
        $_SESSION['username'] = $usuario['nombre_usuario'];
        
        // Redirigir al dashboard
        header('Location: ../vendor/almasaeed2010/adminlte');
        exit();
    } else {
        // Si las credenciales son incorrectas, guardar un mensaje de error en la sesión
        $_SESSION['login_error'] = "Usuario, correo o contraseña incorrectos.";
        // Redirigir al formulario de login
        header('Location: ../vistas/login.php'); // Ajusta esta ruta si es necesario
        exit();
    }
} else {
    // Si no hay conexión, mostrar un mensaje de error
    $_SESSION['login_error'] = "Error de conexión a la base de datos.";
    header('Location: ../vistas/login.php'); // Ajusta esta ruta si es necesario
    exit();
}
