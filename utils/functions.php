<?php
    // Función para verificar si el usuario está autenticado
    function estaAutenticado()
    {
        return isset($_SESSION['usuario']);
    }
