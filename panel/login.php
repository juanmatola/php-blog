<?php
include "../utils/functions.php";
session_start();

// Definir los datos de inicio de sesión en una constante
define('USUARIO', 'usuario');
define('CONTRASENA', 'contrasena');

// si esta logueado redirecciono a panel
if (estaAutenticado()) {
    header('Location: /panel/panel.php');
}

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los valores ingresados en el formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Verificar si los valores ingresados coinciden con los datos definidos
    if ($usuario === USUARIO && $contrasena === CONTRASENA) {
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
</head>
<body>
    <h1>Iniciar sesión</h1>
    <form method="POST" action="">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required><br><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br><br>

        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>