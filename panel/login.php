<?php
include "../app/init.php";
include "../utils/functions.php";
session_start();

// si esta logueado redirecciono a panel
if (estaAutenticado()) {
    header('Location: /panel/panel.php');
}

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los valores ingresados en el formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $isValid = $userRepository->validateUserCredentials($usuario, $contrasena);

    // Verificar si los valores ingresados coinciden con los datos definidos
    if ($isValid) {
        // Inicio de sesión exitoso
        $_SESSION['usuario'] = $usuario;
        // redirecciona a panel
        header('Location: /panel/panel.php');
    } else {
        // Credenciales incorrectas
        echo 'Usuario o contraseña incorrectos';
    }
} ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e6e6e6;
        }

        .card {
            width: 350px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card">
            <div class="card-body text-center">
                <h1 class="card-title mb-4">Iniciar sesión</h1>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario:</label>
                        <input type="text" id="usuario" name="usuario" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña:</label>
                        <input type="password" id="contrasena" name="contrasena" class="form-control" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



