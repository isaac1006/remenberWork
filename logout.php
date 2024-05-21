<?php
session_start(); // Inicia la sesión si no está iniciada aún

// Destruye la sesión
session_destroy();

// Redirige al usuario a la página de inicio
header("Location: index.html");
exit; // Asegúrate de que el script se detenga después de redirigir
?>