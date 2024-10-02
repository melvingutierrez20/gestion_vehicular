<?php
session_start();

// Verificar si hay un mensaje de error en la sesión y almacenarlo en una variable
$error = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : '';
// Borrar el mensaje de error para la próxima vez
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="login-background">
        <div class="login-form-container text-center">
            <img src="../assets/images/logo.png" alt="Logo" class="img-fluid mb-4" style="max-width: 150px;">
            <h2 class="text-center">Iniciar Sesión</h2>
            
            <!-- Mostrar mensaje de error si las credenciales son incorrectas -->
            <?php if ($error): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="../controladores/procesar_login.php" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Usuario o Correo" required>
                </div>
                <div class="mb-3 position-relative">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
